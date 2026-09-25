'use strict';
(() => {
  const $ = id => document.getElementById(id);
  const student = document.querySelector('meta[name="student-id"]').content;
  const pendingKey = `ie82661:respuesta:${student}`;
  let csrf = document.querySelector('meta[name="csrf-token"]').content;
  let state = null, pending = null, sending = false, storage = true;
  try { pending = JSON.parse(sessionStorage.getItem(pendingKey) || 'null'); } catch { storage = false; }
  const remember = () => {
    try { if (pending) sessionStorage.setItem(pendingKey, JSON.stringify(pending)); else sessionStorage.removeItem(pendingKey); }
    catch { storage = false; }
  };
  const message = text => { $('error').textContent = text; $('error').hidden = !text; };
  const lock = value => { $('numerador').disabled = value; $('denominador').disabled = value; $('comprobar').disabled = value; };
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
  const operation = values => {
    const [a,b,op,c,d] = values;
    $('operacion').replaceChildren();
    for (const item of [[a,b],op,[c,d]]) {
      const node = document.createElement('span');
      if (Array.isArray(item)) {
        node.className = 'fraction';
        for (const number of item) { const span = document.createElement('span'); span.textContent = String(number); node.append(span); }
      } else { node.textContent = item === '-' ? '−' : '+'; }
      $('operacion').append(node);
    }
    $('operacion').setAttribute('aria-label', `${a} sobre ${b} ${op === '+' ? 'más' : 'menos'} ${c} sobre ${d}`);
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
    $('intentos').textContent = `Intento ${a.tries + 1} de 2. Puedes escribir una fracción equivalente.`;
    operation(a.question);
    $('numerador').value = ''; $('denominador').value = '';
    $('feedback').textContent = a.tries ? 'Tu primer intento está guardado. Puedes volver a responder.' : '';
    $('siguiente').hidden = true; $('comprobar').hidden = false; $('reintentar').hidden = true; lock(false);
  };
  const sendPending = async (recovering = false) => {
    if (!pending || sending) return;
    sending = true; lock(true); $('reintentar').disabled = true; message('');
    $('guardado').textContent = 'Guardando tu respuesta…';
    try {
      const data = await request(pending);
      if (!data.saved) throw new Error('Falta confirmar el guardado.');
      pending = null; remember(); setState(data);
      if (recovering === true) { render(); $('guardado').textContent = '✓ Respuesta recuperada y guardada para tu docente.'; return; }
      const response = data.response;
      $('guardado').textContent = '✓ Respuesta guardada para tu docente.';
      $('reintentar').hidden = true;
      $('feedback').textContent = response.correct ? '¡Correcto! Muy buen trabajo.' : response.terminal ? `La respuesta correcta es ${response.expected}. Sigamos aprendiendo.` : 'Aún no es correcto. Revisa la operación e inténtalo una vez más.';
      if (response.terminal) {
        $('comprobar').hidden = true; $('siguiente').hidden = false;
        $('siguiente').textContent = data.attempt.completed ? 'Ver mi resultado' : 'Siguiente ejercicio';
        $('siguiente').focus();
      } else { lock(false); $('intentos').textContent = 'Intento 2 de 2'; $('numerador').focus(); }
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
    try { setState(await request({ action: 'start' })); render(); $('numerador').focus(); }
    catch (error) { showError(error); }
    finally { $('comenzar').disabled = false; $('reiniciar').disabled = false; }
  };
  $('respuesta').addEventListener('submit', async event => {
    event.preventDefault(); if (sending || pending || !state?.attempt) return;
    const numerator = Number($('numerador').value), denominator = Number($('denominador').value);
    if (!$('numerador').value.trim() || !$('denominador').value.trim() || !Number.isInteger(numerator) || !Number.isInteger(denominator) || denominator === 0 || Math.abs(numerator) > 10000 || Math.abs(denominator) > 10000) { message('Escribe números enteros y un denominador distinto de cero.'); return; }
    const bytes = crypto.getRandomValues(new Uint8Array(16));
    const requestId = Array.from(bytes, b => b.toString(16).padStart(2, '0')).join('');
    pending = { action: 'answer', attempt_id: state.attempt.id, request_id: requestId, question: state.attempt.current, numerator, denominator };
    remember();
    if (!storage) message('Conserva esta página abierta hasta que se confirme el guardado.');
    await sendPending();
  });
  $('comenzar').addEventListener('click', start); $('reiniciar').addEventListener('click', start);
  $('siguiente').addEventListener('click', () => { render(); if (!state.attempt.completed) $('numerador').focus(); });
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
