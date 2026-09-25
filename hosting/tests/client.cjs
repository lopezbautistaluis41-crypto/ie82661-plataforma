// Logic tests for the worksheet's pending-send lifecycle; no browser required.
const fs = require('node:fs');
const vm = require('node:vm');
const assert = require('node:assert/strict');
const { webcrypto } = require('node:crypto');
const source = fs.readFileSync(require('node:path').join(__dirname,'../build/public_html/acceso/seguimiento/ficha.js'),'utf8');
const flush = async () => { for(let i=0;i<8;i++) await new Promise(resolve=>setImmediate(resolve)); };
const state = current => ({csrf:'csrf-value',student:{name:'Prueba',grade:4,section:'A'},attempt:{id:'a'.repeat(32),title:'Fracciones',total:50,current,correct:current,completed:false,tries:0,question:[2,5,'+',1,5]}});
const saved = current => ({...state(current),saved:true,response:{question:current-1,try:1,correct:true,terminal:true,expected:'3/4'}});
function fixture(queue, initialPending=null) {
  const elements=new Map(), stored=new Map(), calls=[];
  if(initialPending)stored.set('ie82661:respuesta:student',JSON.stringify(initialPending));
  function element(id) {
    if(!elements.has(id))elements.set(id,{value:'',hidden:false,disabled:false,textContent:'',listeners:{},children:[],
      addEventListener(name,fn){this.listeners[name]=fn;},replaceChildren(){this.children=[];},append(e){this.children.push(e);},setAttribute(){},focus(){}});
    return elements.get(id);
  }
  const document={getElementById:element,querySelector:selector=>({content:selector.includes('student-id')?'student':'csrf-value'}),createElement:()=>({children:[],append(e){this.children.push(e);}})};
  const sandbox={document,window:{addEventListener(){}},sessionStorage:{getItem:key=>stored.get(key),setItem:(k,v)=>stored.set(k,v),removeItem:k=>stored.delete(k)},crypto:webcrypto,AbortController,setTimeout,clearTimeout,
    fetch:async(url,options)=>{calls.push(options);const next=queue.shift();if(next instanceof Error)throw next;const result=typeof next==='function'?await next():next;return{ok:!result.error,status:result.status||200,json:async()=>result};}};
  vm.runInNewContext(source,sandbox);
  const click=async id=>element(id).listeners.click({currentTarget:element(id)});
  const submit=async()=>element('respuesta').listeners.submit({preventDefault(){}});
  return{element,stored,calls,click,submit};
}
(async()=>{
  let release;
  const wait=new Promise((resolve,reject)=>release={resolve,reject});
  const f=fixture([state(0),()=>wait,saved(1)]);await flush();
  f.element('numerador').value='3';f.element('denominador').value='4';
  const sending=f.submit();await flush();
  assert(f.element('comprobar').disabled);assert.equal(f.stored.size,1);
  await f.submit();assert.equal(f.calls.length,2,'Double submit must not send twice');
  release.reject(new Error('Connection lost'));await sending;
  assert.equal(f.element('reintentar').hidden,false);assert.equal(f.stored.size,1);
  await f.click('reintentar');
  assert.equal(JSON.parse(f.calls[1].body).request_id,JSON.parse(f.calls[2].body).request_id,'Retry must use same id');
  assert.equal(f.stored.size,0);assert.equal(f.element('siguiente').hidden,false);
  await f.click('siguiente');assert.equal(f.element('contador').textContent,'Ejercicio 2 de 50');
  const pending={action:'answer',attempt_id:'a'.repeat(32),request_id:'b'.repeat(32),question:0,numerator:3,denominator:4};
  const reload=fixture([state(1),saved(1)],pending);await flush();
  assert.equal(reload.stored.size,0);assert.equal(reload.element('contador').textContent,'Ejercicio 2 de 50');
  assert.equal(reload.element('siguiente').hidden,true,'Reload must display next question, not old feedback');
  const expired=fixture([state(0),{error:'Vuelve a ingresar',status:401}],pending);await flush();
  assert.equal(expired.stored.size,1);assert.equal(expired.element('volver').hidden,false);
  const done={...saved(50),attempt:{...state(50).attempt,completed:true,question:null,correct:49}};
  const final=fixture([done,done],{...pending,question:49});await flush();
  assert.equal(final.element('final').hidden,false);assert.equal(final.element('puntaje').textContent,'49 / 50');assert.equal(final.stored.size,0);
  console.log('Passed: send locking, idempotent retry, pending recovery, expired session and completed attempt recovery.');
})().catch(error=>{console.error(error);process.exitCode=1;});
