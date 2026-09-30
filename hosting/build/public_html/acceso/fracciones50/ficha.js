'use strict';
(() => {
  const $ = id => document.getElementById(id);
  const student = document.querySelector('meta[name="student-id"]').content;
  const pendingKey = `ie82661:fracciones50:respuesta:${student}`;
  let csrf = document.querySelector('meta[name="csrf-token"]').content;
  let state = null, pending = null, sending = false, storage = true;
  let visibleOptions = [];
  try { pending = JSON.parse(sessionStorage.getItem(pendingKey) || 'null'); } catch { storage = false; }
  const remember = () => {
    try { if (pending) sessionStorage.setItem(pendingKey, JSON.stringify(pending)); else sessionStorage.removeItem(pendingKey); }
    catch { storage = false; }
  };
  const message = text => { $('error').textContent = text; $('error').hidden = !text; };
  const lock = value => { $('alternativas').disabled = value; $('numerador').disabled = value; $('denominador').disabled = value; $('comprobar').disabled = value; };
  const setState = data => { state = data; csrf = data.csrf; };
  const request = async body => {
    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(), 15000);
    try {
      const response = await fetch('api.php', { method: body ? 'POST' : 'GET', credentials: 'same-origin', cache: 'no-store',
        headers: body ? { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf } : {},
        body: body ? JSON.stringify(body) : undefined, signal: controller.signal });
      const data = await response.json();
      if (!response.ok) { const error = new Error(data.error || 'No se pudo confirmar el guardado.'); error.status = response.status; throw error; }
      return data;
    } finally { clearTimeout(timer); }
  };
  const showError = error => {
    const text = error.status ? error.message : 'No se pudo confirmar el guardado. Revisa tu conexión y vuelve a intentar.';
    message(text);
    $('guardado').textContent = pending ? 'Respuesta pendiente de confirmación. Mantén abierta esta página.' : 'No se pudo recuperar tu actividad.';
    $('volver').hidden = error.status !== 401;
    $('recargar').hidden = ![403,404,409].includes(error.status) && !!pending;
    if (pending) {
      $('reintentar').hidden = [401,403,404,409].includes(error.status);
      $('reintentar').disabled = false;
    }
  };
  const fraction = values => {
    const node = document.createElement('span'); node.className = 'fraction';
    for (const value of values) { const span = document.createElement('span'); span.textContent = String(value); node.append(span); }
    node.setAttribute('aria-label', `${values[0]} sobre ${values[1]}`); return node;
  };
  const focusChoice = () => $('opciones').querySelector('input')?.focus();
  const operation = question => {
    visibleOptions = question.options;
    $('imagen-ejercicio').src = question.image;
    $('imagen-ejercicio').alt = question.visual_alt;
    $('feedback').className = 'feedback';
    $('tema').textContent = question.category;
    $('consigna').textContent = question.prompt;
    const [a,b,op,c,d] = question.operation;
    $('operacion').replaceChildren(fraction([a,b]));
    if (op) {
      const sign = document.createElement('span'); sign.textContent = op === '-' ? '−' : '+';
      $('operacion').append(sign, fraction([c,d]));
    }
    $('operacion').setAttribute('aria-label', op ? `${a} sobre ${b} ${op === '+' ? 'más' : 'menos'} ${c} sobre ${d}` : `${a} sobre ${b}`);
    $('opciones').replaceChildren();
    question.options.forEach((value,index) => {
      const label = document.createElement('label'); label.className = 'option';
      const radio = document.createElement('input'); radio.type = 'radio'; radio.name = 'alternativa'; radio.value = String(index); radio.required = true;
      radio.addEventListener('change', () => { $('numerador').value = String(value[0]); $('denominador').value = String(value[1]); });
      const letter = document.createElement('span'); letter.className = 'option-letter'; letter.textContent = 'ABCD'[index];
      const status = document.createElement('span'); status.className = 'option-result';
      label.append(radio,letter,fraction(value),status); $('opciones').append(label);
    });
  };
  const markOption = (value, correct) => {
    visibleOptions.forEach((option,index) => {
      if (option[0] * value[1] !== value[0] * option[1]) return;
      const label = $('opciones').children[index];
      label.className = `option ${correct ? 'answer-correct' : 'answer-wrong'}`;
      label.children[3].textContent = correct ? '✓ Correcta' : '✕ Incorrecta';
    });
  };
  const paintFeedback = (response, submitted) => {
    markOption([submitted.numerator, submitted.denominator], response.correct);
    $('feedback').className = `feedback ${response.correct ? 'feedback-correct' : 'feedback-wrong'}`;
    if (response.terminal && response.expected) markOption(response.expected.split('/').map(Number), true);
  };
  const render = () => {
    message(''); $('volver').hidden = true; $('recargar').hidden = true;
    const a = state.attempt;
    $('inicio').hidden = !!a; $('juego').hidden = !a || a.completed; $('final').hidden = !a || !a.completed;
    $('guardado').textContent = 'Conectado. Tu docente podrá ver las respuestas que envíes.';
    if (!a) { $('comenzar').disabled = false; $('comenzar').textContent = 'Comenzar actividad'; return; }
    if (a.completed) { $('puntaje').textContent = `${a.correct} / ${a.total}`; $('guardado').textContent = 'Actividad guardada en el registro de tu docente.'; return; }
    $('contador').textContent = `Ejercicio ${a.current + 1} de ${a.total}`;
    $('aciertos').textContent = `${a.correct} aciertos`;
    $('barra').max = a.total; $('barra').value = a.current;
    $('intentos').textContent = `Intento ${a.tries + 1} de 2. Elige una de las cuatro alternativas.`;
    operation(a.question);
    for (const choice of a.choices || []) markOption([Number(choice.numerator), Number(choice.denominator)], Boolean(Number(choice.correct)));
    $('numerador').value = ''; $('denominador').value = '';
    $('feedback').textContent = a.tries ? 'Tu primer intento está guardado. Puedes volver a responder.' : '';
    $('siguiente').hidden = true; $('comprobar').hidden = false; $('reintentar').hidden = true; lock(false);
  };
  const sendPending = async (recovering = false) => {
    if (!pending || sending) return;
    sending = true; lock(true); $('reintentar').disabled = true; message('');
    $('guardado').textContent = 'Guardando tu respuesta…';
    try {
      const submitted = pending;
      const data = await request(pending);
      if (!data.saved) throw new Error('Falta confirmar el guardado.');
      pending = null; remember(); setState(data);
      if (recovering === true) { render(); $('guardado').textContent = '✓ Respuesta recuperada y guardada para tu docente.'; return; }
      const response = data.response;
      paintFeedback(response, submitted);
      $('guardado').textContent = '✓ Respuesta guardada para tu docente.';
      $('reintentar').hidden = true;
      $('feedback').textContent = response.correct ? `¡Correcto! ${response.explanation || ''}` : response.terminal ? `La respuesta correcta es ${response.expected}. ${response.explanation || ''}` : 'Aún no es correcto. Revisa las fracciones e inténtalo una vez más.';
      if (response.terminal) {
        $('comprobar').hidden = true; $('siguiente').hidden = false;
        $('siguiente').textContent = data.attempt.completed ? 'Ver mi resultado' : 'Siguiente ejercicio';
        $('siguiente').focus();
      } else { lock(false); $('intentos').textContent = 'Intento 2 de 2'; focusChoice(); }
    } catch (error) { showError(error); }
    finally { sending = false; }
  };
  const load = async () => {
    $('recargar').hidden = true;
    try {
      setState(await request()); render();
      if (pending) {
        if (!state.attempt || pending.attempt_id !== state.attempt.id) {
          message('Hay un envío pendiente de una actividad anterior. Se comprobará antes de continuar.');
        }
        // The same request ID makes a retry safe even if the server saved it before the connection failed.
        await sendPending(true);
      }
    } catch (error) { showError(error); }
  };
  const start = async event => {
    event.currentTarget.disabled = true;
    try { setState(await request({ action: 'start' })); render(); focusChoice(); }
    catch (error) { showError(error); }
    finally { $('comenzar').disabled = false; $('reiniciar').disabled = false; }
  };
  $('respuesta').addEventListener('submit', async event => {
    event.preventDefault(); if (sending || pending || !state?.attempt) return;
    const numerator = Number($('numerador').value), denominator = Number($('denominador').value);
    if (!$('numerador').value.trim() || !$('denominador').value.trim() || !Number.isInteger(numerator) || !Number.isInteger(denominator) || denominator === 0 || Math.abs(numerator) > 10000 || Math.abs(denominator) > 10000) { message('Selecciona una alternativa antes de enviar.'); return; }
    const bytes = crypto.getRandomValues(new Uint8Array(16));
    const requestId = Array.from(bytes, b => b.toString(16).padStart(2, '0')).join('');
    pending = { action: 'answer', attempt_id: state.attempt.id, request_id: requestId, question: state.attempt.current, numerator, denominator };
    remember();
    if (!storage) message('Conserva esta página abierta hasta que se confirme el guardado.');
    await sendPending();
  });
  $('comenzar').addEventListener('click', start); $('reiniciar').addEventListener('click', start);
  $('siguiente').addEventListener('click', () => { render(); if (!state.attempt.completed) focusChoice(); });
  $('reintentar').addEventListener('click', sendPending);
  $('recargar').addEventListener('click', async () => {
    // Reconcile a changed tab/session with the authoritative server state; keep unconfirmed sends unless conflict is explicit.
    try {
      if (pending) {
        const fresh = await request(); csrf = fresh.csrf;
        try { const data = await request(pending); if (data.saved) { pending = null; remember(); } }
        catch (e) { if (e.status === 409 || e.status === 404) { pending = null; remember(); } else throw e; }
      }
      await load();
    } catch (e) { showError(e); }
  });
  window.addEventListener('beforeunload', event => { if (pending) { event.preventDefault(); event.returnValue = ''; } });
  load();
})();
