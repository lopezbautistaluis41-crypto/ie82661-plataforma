"""Integration tests against the real PHP endpoints, using fictitious accounts only."""
from pathlib import Path
import csv, hashlib, hmac, io, json, os, re, shutil, socket, sqlite3, subprocess, tempfile, time, uuid, zipfile
import urllib.request, urllib.error
from http.cookies import SimpleCookie

BASE = Path(__file__).resolve().parents[1]
PHP = os.environ.get('PHP_BIN', str(BASE/'runtime/php/usr/bin/php8.3'))
INI = os.environ.get('PHP_INI', str(BASE/'runtime/php.ini'))
BUILD = BASE/'build'
FIXTURES = BASE/'tests/fixtures'
CHECKS = []

def check(value, label):
    if not value: raise AssertionError(label)
    CHECKS.append(label)

class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args): return None

class Response:
    def __init__(self, response):
        self.status_code=response.code; self.headers=response.headers; self.content=response.read()
        self.text=self.content.decode('utf-8',errors='replace')
    def json(self): return json.loads(self.content)

class Client:
    def __init__(self, url): self.url, self.cookies = url, {}
    def request(self, method, path, **kwargs):
        headers=kwargs.get('headers',{}).copy(); data=None
        if self.cookies: headers['Cookie']='; '.join(k+'='+v for k,v in self.cookies.items())
        if 'json' in kwargs: data=json.dumps(kwargs['json']).encode(); headers['Content-Type']='application/json'
        elif 'data' in kwargs:
            data=kwargs['data']
            if isinstance(data,dict): data=urllib.parse.urlencode(data).encode(); headers['Content-Type']='application/x-www-form-urlencoded'
            elif isinstance(data,str): data=data.encode()
        req=urllib.request.Request(self.url+path,data=data,headers=headers,method=method)
        try: response=urllib.request.build_opener(NoRedirect).open(req,timeout=20)
        except urllib.error.HTTPError as e: response=e
        for cookie in response.headers.get_all('Set-Cookie',[]):
            parsed=SimpleCookie(); parsed.load(cookie)
            for key,value in parsed.items(): self.cookies[key]=value.value
        return Response(response)
    def get(self, path): return self.request('GET', path)
    def post(self, path, **kwargs): return self.request('POST', path, **kwargs)

def csrf(response):
    return re.search(r'name="csrf" value="([a-f0-9]+)"', response.text).group(1)

def run():
    for p in BUILD.rglob('*.php'):
        result = subprocess.run([PHP,'-c',INI,'-l',str(p)], capture_output=True, text=True)
        check(result.returncode == 0, 'PHP syntax: '+str(p.relative_to(BUILD)))
    with tempfile.TemporaryDirectory(prefix='ie82661-test-') as folder:
        home = Path(folder); web=home/'public_html'; private=home/'private_ie82661'; private.mkdir()
        shutil.copytree(BUILD/'public_html',web)
        for f in ['auth_common.php','logout.php']:
            shutil.copy2(FIXTURES/f,web/'acceso'/f)
        pepper='fictional-test-pepper'; token='fictional-one-time-setup-token'; password='Frase ficticia de prueba 2026!'
        (private/'config.php').write_text("<?php return "+"['pepper'=>'fictional-test-pepper','platform_url'=>'https://example.org','school_name'=>'Escuela de prueba'];")
        digest=lambda x:hmac.new(pepper.encode(),x.encode(),hashlib.sha256).hexdigest()
        (private/'students.php').write_text("<?php return ["+
            "['g'=>4,'u'=>'PRUEBA_A','p'=>'"+digest('test-a-secret')+"','n'=>'Estudiante A','s'=>'A'],"+
            "['g'=>5,'u'=>'PRUEBA_B','p'=>'"+digest('test-b-secret')+"','n'=>'=SUM(1,1)<script>alert(1)</script>','s'=>'B']];")
        (private/'administrador_instalacion.php').write_text("<?php return ['token_hash'=>'"+hashlib.sha256(token.encode()).hexdigest()+"'];")
        sessions=home/'sessions'; sessions.mkdir()
        router=home/'test-router.php'
        router.write_text("<?php $_SERVER['HTTPS']='on'; $path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); if(preg_match('~^/[1-6]$~',$path)){$_GET['grado']=(int)substr($path,1);require __DIR__.'/public_html/acceso/index.php';return true;}return false;")
        with socket.socket() as sock: sock.bind(('127.0.0.1',0)); port=sock.getsockname()[1]
        url=f'http://127.0.0.1:{port}'
        log=open(home/'server.log','w+')
        def start():
            proc=subprocess.Popen([PHP,'-c',INI,'-d','session.save_path='+str(sessions),'-S',f'127.0.0.1:{port}','-t',str(web),str(router)],stdout=log,stderr=log)
            for _ in range(100):
                try:
                    urllib.request.urlopen(url+'/acceso/seguimiento/registro.css',timeout=.2); return proc
                except (urllib.error.URLError,TimeoutError): time.sleep(.03)
            raise RuntimeError('Test server did not start')
        server=start()
        try:
            guest=Client(url)
            check(guest.get('/acceso/seguimiento/api.php').status_code==401,'Anonymous API denied')
            check(guest.get('/acceso/administrador/exportar.php').status_code==302,'Anonymous export denied')
            check(guest.get('/acceso/administrador/detalle.php?id=anything').status_code==302,'Anonymous detail denied')
            setup=Client(url); response=setup.get('/acceso/administrador/configurar.php'); setup_csrf=csrf(response)
            cookie=response.headers.get('Set-Cookie','')
            check(all(word.lower() in cookie.lower() for word in ['Secure','HttpOnly','SameSite=Strict']), 'Administrator session cookie security')
            payload={'csrf':setup_csrf,'activacion':'wrong','usuario':'admin','clave':password,'repetir':password}
            check('no es válido' in setup.post('/acceso/administrador/configurar.php',data=payload).text,'Setup rejects wrong activation token')
            payload['activacion']=token
            check(setup.post('/acceso/administrador/configurar.php',data={**payload,'csrf':''}).status_code==200 and 'sesión' in setup.post('/acceso/administrador/configurar.php',data={**payload,'csrf':''}).text,'Setup rejects empty CSRF')
            response=setup.post('/acceso/administrador/configurar.php',data=payload)
            check(response.status_code==302,'One-time administrator setup')
            check(not (private/'administrador_instalacion.php').exists(),'Activation hash removed after setup')
            check(setup.get('/acceso/administrador/configurar.php').status_code==302,'Setup cannot overwrite existing account')
            db=sqlite3.connect(private/'seguimiento/respuestas.sqlite'); db.row_factory=sqlite3.Row
            account=db.execute('SELECT * FROM administrators').fetchone()
            check(account['password_hash']!=password and account['password_hash'].startswith('$2y$'),'Only password hash is stored')
            check((private/'seguimiento').stat().st_mode & 0o077==0,'Private database folder permissions')
            check((private/'seguimiento/respuestas.sqlite').stat().st_mode & 0o077==0,'Private database file permissions')
            admin=Client(url); login_page=admin.get('/acceso/administrador/'); old_cookie=admin.cookies.get('IE82661ADMIN')
            response=admin.post('/acceso/administrador/',data={'csrf':csrf(login_page),'usuario':'admin','clave':password})
            check(response.status_code==302,'Administrator password login')
            check(admin.cookies.get('IE82661ADMIN')!=old_cookie,'Administrator session ID rotates on login')
            def student_login(name, secret, grade):
                client=Client(url); page=client.get('/acceso/?grado='+str(grade))
                r=client.post('/acceso/login.php',data={'csrf':csrf(page),'grado':grade,'usuario':name,'clave':secret})
                check(r.status_code==302,'Student login '+name); return client
            student=student_login('PRUEBA_A','test-a-secret',4); other=student_login('PRUEBA_B','test-b-secret',5)
            check(student.get('/acceso/administrador/exportar.php').status_code==302,'Student session cannot export responses')
            check(student.get('/acceso/seguimiento/ficha.php').status_code==200,'Authenticated worksheet loads')
            check(student.get('/acceso/panel.php').status_code==200,'Student panel links registered worksheet')
            state=student.get('/acceso/seguimiento/api.php').json(); api_csrf=state['csrf']
            api='/acceso/seguimiento/api.php'
            def send(body, client=student, token=api_csrf): return client.post(api,json=body,headers={'X-CSRF-Token':token})
            check(student.post(api,json={'action':'start'}).status_code==403,'Missing API CSRF denied')
            state=send({'action':'start'}).json(); attempt=state['attempt']['id']
            check(send({'action':'start'}).json()['attempt']['id']==attempt,'Starting twice resumes one open attempt')
            def answer(index,n,d,**extra): return {'action':'answer','attempt_id':attempt,'request_id':uuid.uuid4().hex,'question':index,'numerator':n,'denominator':d,**extra}
            first=answer(0,0,1,correct=True,student_id='forged',grade=1,score=100)
            r=send(first).json()
            check(r['saved'] and not r['response']['correct'] and 'expected' not in r['response'],'First incorrect answer saved without exposing answer key')
            check(r['student']['grade']==4 and r['student']['name']=='Estudiante A','Student identity and grade are server owned')
            check(send(first).json()['saved'] and db.execute('SELECT COUNT(*) FROM responses').fetchone()[0]==1,'Retry does not duplicate response')
            check(send({**first,'numerator':3,'denominator':4}).status_code==409,'Request ID cannot replace original answer')
            second=send(answer(0,6,8)).json()
            check(second['response']['correct'] and second['attempt']['correct']==1 and second['attempt']['current']==1,'Equivalent fractions accepted and scored on server')
            check(send(answer(0,3,4)).status_code==409,'Closed question cannot be answered again')
            other_state=other.get(api).json()
            check(send(answer(1,3,5),client=other,token=other_state['csrf']).status_code==404,'Other student cannot submit to this attempt')
            check(other.get(api+'?attempt_id='+attempt).json()['attempt'] is None,'Other student cannot read this attempt')
            check(send(answer(1,1,0)).status_code==422,'Zero denominator rejected')
            check(send(answer(1,1.5,2)).status_code==422,'Decimal integers rejected')
            check(send(answer(1,10001,2)).status_code==422,'Oversized answer rejected')
            check(student.post(api,data='{bad',headers={'Content-Type':'application/json','X-CSRF-Token':api_csrf}).status_code==400,'Malformed JSON rejected')
            check(send(answer(1,0,1)).json()['saved'],'Second question first incorrect saved')
            check(send(answer(1,0,1)).json()['response']['terminal'],'Second incorrect closes question')
            questions=json.loads(subprocess.check_output([PHP,'-c',INI,'-r',"require '"+str(web/'acceso/seguimiento/common.php')+"'; echo json_encode(reg_activity()['questions']);"],text=True))
            for i,q in enumerate(questions[2:],2):
                a,b,op,c,d=q; n=a*d+(1 if op=='+' else -1)*c*b
                final_body=answer(i,n,b*d); result=send(final_body)
                check(result.status_code==200 and result.json()['saved'],f'Question {i+1} persisted')
            last=result.json()
            check(last['attempt']['completed'] and last['attempt']['correct']==49,'Completion and final score are server owned')
            check(db.execute('SELECT COUNT(*) FROM responses').fetchone()[0]==52,'All first and second attempts retained')
            check(send(final_body).json()['saved'] and db.execute('SELECT COUNT(*) FROM responses').fetchone()[0]==52,'Final answer retry idempotent')
            new=send({'action':'start'}).json()['attempt']['id']
            check(new!=attempt and db.execute('SELECT COUNT(*) FROM attempts').fetchone()[0]==2,'New practice keeps previous history')
            other_attempt=send({'action':'start'},client=other,token=other_state['csrf']).json()['attempt']['id']
            check(send({**answer(0,3,4),'attempt_id':other_attempt},client=other,token=other_state['csrf']).status_code==200,'Second student answer saved separately')
            page=admin.get('/acceso/administrador/')
            check('Estudiante A' in page.text and '&lt;script&gt;' in page.text and '<script>alert(1)</script>' not in page.text,'Admin table escapes student text')
            filtered=admin.get('/acceso/administrador/?grado=4')
            check('Estudiante A' in filtered.text and '=SUM' not in filtered.text,'Grade filter isolates records')
            check('Estudiante A' in admin.get('/acceso/administrador/?buscar=Estudiante').text,'Student search works')
            check('Estudiante A' not in admin.get('/acceso/administrador/?buscar=%27%20OR%201=1--').text,'Search is parameterized')
            detail=admin.get('/acceso/administrador/detalle.php?id='+attempt)
            check(detail.status_code==200 and detail.text.count('<tr>')==53 and 'Incorrecta' in detail.text,'Admin sees every response in detail')
            exported=admin.get('/acceso/administrador/exportar.php')
            rows=list(csv.reader(io.StringIO(exported.content.decode('utf-8-sig')),delimiter=';'))
            check(len(rows)==54,'CSV includes all 53 responses plus header')
            check(any(row[0].startswith("'=SUM") for row in rows[1:]),'CSV neutralizes spreadsheet formulas')
            check(len(list(csv.reader(io.StringIO(admin.get('/acceso/administrador/exportar.php?grado=4').content.decode('utf-8-sig')),delimiter=';')))==53,'CSV uses same grade filter')
            check('no-store' in exported.headers.get('Cache-Control',''),'Private results are not cached')
            check(guest.get('/private_ie82661/seguimiento/respuestas.sqlite').status_code==404,'Database not served from public root')
            server.terminate(); server.wait(); server=start()
            check(student.get(api).json()['attempt']['id']==new,'Responses and unfinished attempt survive server restart')
            for i in range(9):
                attacker=Client(url); p=attacker.get('/acceso/administrador/')
                blocked=attacker.post('/acceso/administrador/',data={'csrf':csrf(p),'usuario':'attack_test','clave':'incorrect password'})
            check(blocked.status_code==429,'Login rate limit survives fresh sessions')
            change=admin.get('/acceso/administrador/clave.php'); change_csrf=csrf(change)
            check('sesión cambió' in admin.post('/acceso/administrador/clave.php',data={'actual':password,'nueva':password+'2','repetir':password+'2'}).text,'Password change requires CSRF')
            response=admin.post('/acceso/administrador/clave.php',data={'csrf':change_csrf,'actual':password,'nueva':password+'2','repetir':password+'2'})
            check('se actualizó' in response.text,'Administrator can change password')
            check('Tu espacio de administrador' in setup.get('/acceso/administrador/').text,'Password change revokes other administrator sessions')
            check(admin.get('/acceso/administrador/salir.php').status_code==403,'GET cannot log administrator out')
            check(admin.post('/acceso/administrador/salir.php',data={'csrf':csrf(response)}).status_code==302,'Administrator logout works')
            check(admin.get('/acceso/administrador/exportar.php').status_code==302,'Logged out administrator cannot export')
            log.flush(); log.seek(0); output=log.read()
            check(not re.search(r'PHP (Fatal|Warning|Deprecated|Parse)',output),'No PHP errors, warnings or deprecations')
        finally:
            server.terminate(); server.wait(); log.close()
    print(json.dumps({'passed':len(CHECKS),'checks':CHECKS},ensure_ascii=False,indent=2))

if __name__=='__main__': run()
