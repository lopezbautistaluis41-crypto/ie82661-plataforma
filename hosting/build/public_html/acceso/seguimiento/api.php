<?php
declare(strict_types=1);
require __DIR__.'/common.php';
reg_headers();
try {
    $student=reg_student(); $db=reg_db(); $activity=reg_activity();
    if ($_SERVER['REQUEST_METHOD']==='GET') {
        $q=$db->prepare('SELECT * FROM attempts WHERE student_id=? AND activity=? ORDER BY rowid DESC LIMIT 1');
        $q->execute([$student['id'],$activity['id']]); reg_json(reg_state($q->fetch() ?: null,$student));
    }
    if ($_SERVER['REQUEST_METHOD']!=='POST') { header('Allow: GET, POST'); reg_json(['error'=>'Método no permitido.'],405); }
    if (!reg_valid_csrf($_SERVER['HTTP_X_CSRF_TOKEN']??null)) reg_json(['error'=>'La sesión cambió. Recarga la página.'],403);
    if (strpos($_SERVER['CONTENT_TYPE']??'', 'application/json')!==0) reg_json(['error'=>'Formato no válido.'],415);
    $raw=file_get_contents('php://input',false,null,0,4097);
    if (strlen($raw)>4096) reg_json(['error'=>'Solicitud demasiado grande.'],413);
    $body=json_decode($raw,true,32,JSON_THROW_ON_ERROR);
    if (!is_array($body)) reg_json(['error'=>'Solicitud no válida.'],400);
    if (($body['action']??'')==='start') {
        $attempt=reg_transaction(function(PDO $db) use ($student,$activity): array {
            $q=$db->prepare('SELECT * FROM attempts WHERE student_id=? AND activity=? AND completed_at IS NULL');
            $q->execute([$student['id'],$activity['id']]); $row=$q->fetch();
            if ($row) return $row;
            $id=bin2hex(random_bytes(16)); $now=reg_now();
            $db->prepare('INSERT INTO attempts(id,student_id,student_name,grade,section,activity,activity_title,total,started_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)')
                ->execute([$id,$student['id'],$student['first'],$student['grade'],$student['section'],$activity['id'],$activity['title'],count($activity['questions']),$now,$now]);
            return reg_attempt($id,$student['id']);
        });
        reg_json(reg_state($attempt,$student));
    }
    if (($body['action']??'')!=='answer') reg_json(['error'=>'Acción no válida.'],400);
    foreach (['attempt_id','request_id'] as $key) if (!is_string($body[$key]??null) || !preg_match('/^[a-f0-9]{32}$/D',$body[$key])) reg_json(['error'=>'Identificador no válido.'],400);
    foreach (['question','numerator','denominator'] as $key) if (!is_int($body[$key]??null)) reg_json(['error'=>'Escribe números enteros.'],422);
    if ($body['denominator']===0 || abs($body['denominator'])>10000 || abs($body['numerator'])>10000) reg_json(['error'=>'Usa números entre −10000 y 10000 y un denominador distinto de cero.'],422);
    $event=reg_transaction(function(PDO $db) use ($body,$student,$activity): array {
        $attempt=reg_attempt($body['attempt_id'],$student['id']);
        $q=$db->prepare('SELECT * FROM responses WHERE request_id=?'); $q->execute([$body['request_id']]); $old=$q->fetch();
        if ($old) {
            if ($old['attempt_id']!==$attempt['id'] || (int)$old['question_index']!==$body['question'] || (int)$old['numerator']!==$body['numerator'] || (int)$old['denominator']!==$body['denominator']) throw new DomainException('Este envío ya tiene otra respuesta. Recarga la página.',409);
            return $old;
        }
        if ($attempt['completed_at']!==null || (int)$attempt['current_question']!==$body['question']) throw new DomainException('La actividad avanzó en otra pestaña. Recarga para continuar.',409);
        $i=$body['question']; $question=$activity['questions'][$i]; [$n,$d]=reg_expected($question);
        $q=$db->prepare('SELECT COUNT(*) FROM responses WHERE attempt_id=? AND question_index=?'); $q->execute([$attempt['id'],$i]); $try=(int)$q->fetchColumn()+1;
        if ($try>2) throw new DomainException('Esta pregunta ya está cerrada.',409);
        $correct=$body['numerator']*$d === $n*$body['denominator']; $terminal=$correct || $try===2;
        $now=reg_now(); $expected="$n/$d"; $text="$question[0]/$question[1] $question[2] $question[3]/$question[4]";
        $db->prepare('INSERT INTO responses(request_id,attempt_id,question_index,try_number,question,numerator,denominator,expected,correct,terminal,answered_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)')
            ->execute([$body['request_id'],$attempt['id'],$i,$try,$text,$body['numerator'],$body['denominator'],$expected,(int)$correct,(int)$terminal,$now]);
        $finished=$terminal && $i+1===(int)$attempt['total'];
        $db->prepare('UPDATE attempts SET current_question=current_question+?,correct_count=correct_count+?,updated_at=?,completed_at=? WHERE id=?')
            ->execute([(int)$terminal,(int)$correct,$now,$finished?$now:null,$attempt['id']]);
        return ['question_index'=>$i,'try_number'=>$try,'correct'=>(int)$correct,'terminal'=>(int)$terminal,'expected'=>$expected];
    });
    $result=reg_state(reg_attempt($body['attempt_id'],$student['id']),$student);
    $result['saved']=true;
    $result['response']=['question'=>(int)$event['question_index'],'try'=>(int)$event['try_number'],'correct'=>(bool)$event['correct'],'terminal'=>(bool)$event['terminal']];
    if ($event['terminal']) $result['response']['expected']=$event['expected'];
    reg_json($result);
} catch (DomainException $e) { reg_json(['error'=>$e->getMessage()], in_array($e->getCode(),[401,404,409],true)?$e->getCode():400); }
catch (JsonException $e) { reg_json(['error'=>'Solicitud no válida.'],400); }
catch (Throwable $e) { error_log('IE82661 seguimiento: error de almacenamiento o configuración.'); reg_json(['error'=>'No se pudo confirmar el guardado. Conserva esta página y vuelve a intentar.'],503); }
