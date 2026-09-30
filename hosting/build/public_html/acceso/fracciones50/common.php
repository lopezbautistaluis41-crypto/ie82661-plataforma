<?php
declare(strict_types=1);

function reg_private(): string {
    $path = realpath(dirname(__DIR__, 3) . '/private_ie82661');
    $public = realpath(dirname(__DIR__, 2));
    if (!$path || !$public || $path === $public || strpos($path, $public . DIRECTORY_SEPARATOR) === 0) {
        throw new RuntimeException('La carpeta privada debe estar fuera de public_html.');
    }
    return $path;
}

function reg_headers(): void {
    header('Cache-Control: no-store, private');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: same-origin');
    header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self'; script-src 'self'; base-uri 'self'; frame-ancestors 'none'; form-action 'self'");
}

function reg_db(): PDO {
    static $db;
    if ($db instanceof PDO) return $db;
    if (!extension_loaded('pdo_sqlite')) throw new RuntimeException('Activa pdo_sqlite en la configuración PHP del hosting.');
    $folder = reg_private() . '/seguimiento';
    $previous = umask(0077);
    try {
        if (!is_dir($folder) && !mkdir($folder, 0700, true) && !is_dir($folder)) {
            throw new RuntimeException('No se pudo crear la carpeta de respuestas.');
        }
        $db = new PDO('sqlite:' . $folder . '/respuestas.sqlite', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        $db->exec('PRAGMA foreign_keys=ON; PRAGMA busy_timeout=10000;');
        $db->exec("CREATE TABLE IF NOT EXISTS administrators (
            id INTEGER PRIMARY KEY CHECK(id=1), username TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL, version INTEGER NOT NULL DEFAULT 1, created_at TEXT NOT NULL
        );
        CREATE TABLE IF NOT EXISTS attempts (
            id TEXT PRIMARY KEY, student_id TEXT NOT NULL, student_name TEXT NOT NULL,
            grade INTEGER NOT NULL CHECK(grade BETWEEN 1 AND 6), section TEXT NOT NULL,
            activity TEXT NOT NULL, activity_title TEXT NOT NULL, total INTEGER NOT NULL,
            current_question INTEGER NOT NULL DEFAULT 0, correct_count INTEGER NOT NULL DEFAULT 0,
            started_at TEXT NOT NULL, updated_at TEXT NOT NULL, completed_at TEXT
        );
        CREATE UNIQUE INDEX IF NOT EXISTS one_open_attempt ON attempts(student_id,activity) WHERE completed_at IS NULL;
        CREATE INDEX IF NOT EXISTS attempt_filter ON attempts(grade,started_at);
        CREATE TABLE IF NOT EXISTS responses (
            id INTEGER PRIMARY KEY AUTOINCREMENT, request_id TEXT NOT NULL UNIQUE,
            attempt_id TEXT NOT NULL REFERENCES attempts(id), question_index INTEGER NOT NULL,
            try_number INTEGER NOT NULL CHECK(try_number BETWEEN 1 AND 2), question TEXT NOT NULL,
            numerator INTEGER NOT NULL, denominator INTEGER NOT NULL CHECK(denominator<>0),
            expected TEXT NOT NULL, correct INTEGER NOT NULL CHECK(correct IN (0,1)),
            terminal INTEGER NOT NULL CHECK(terminal IN (0,1)), answered_at TEXT NOT NULL,
            UNIQUE(attempt_id,question_index,try_number)
        );
        CREATE INDEX IF NOT EXISTS response_attempt ON responses(attempt_id,question_index);
        CREATE TABLE IF NOT EXISTS fraction_quiz_layouts (attempt_id TEXT PRIMARY KEY REFERENCES attempts(id), options_json TEXT NOT NULL);
        CREATE TABLE IF NOT EXISTS rate_limits (scope TEXT PRIMARY KEY, count INTEGER NOT NULL, expires INTEGER NOT NULL);");
    } finally { umask($previous); }
    return $db;
}

function reg_now(): string { return gmdate('Y-m-d\TH:i:s\Z'); }
function reg_e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function reg_date(string $value): string {
    return (new DateTimeImmutable($value))->setTimezone(new DateTimeZone('America/Lima'))->format('d/m/Y H:i');
}
function reg_csrf(): string {
    if (empty($_SESSION['registro_csrf'])) $_SESSION['registro_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['registro_csrf'];
}
function reg_valid_csrf($value): bool {
    return is_string($value) && !empty($_SESSION['registro_csrf']) && hash_equals($_SESSION['registro_csrf'], $value);
}
function reg_transaction(callable $callback) {
    $db = reg_db();
    $db->exec('BEGIN IMMEDIATE');
    try { $result = $callback($db); $db->exec('COMMIT'); return $result; }
    catch (Throwable $e) { $db->exec('ROLLBACK'); throw $e; }
}
function reg_rate(string $scope, int $limit, int $seconds): bool {
    return reg_transaction(function(PDO $db) use ($scope, $limit, $seconds): bool {
        $now = time();
        $db->prepare('DELETE FROM rate_limits WHERE expires < ?')->execute([$now]);
        $q = $db->prepare('SELECT count FROM rate_limits WHERE scope=?');
        $q->execute([$scope]); $count = (int)$q->fetchColumn();
        if ($count >= $limit) return false;
        $db->prepare('INSERT INTO rate_limits(scope,count,expires) VALUES(?,1,?) ON CONFLICT(scope) DO UPDATE SET count=count+1')->execute([$scope, $now+$seconds]);
        return true;
    });
}
function reg_json(array $value, int $status=200): void {
    http_response_code($status); header('Content-Type: application/json; charset=utf-8');
    echo json_encode($value, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); exit;
}
function reg_student(): array {
    require_once dirname(__DIR__) . '/auth_common.php';
    auth_boot();
    $s = $_SESSION['student'] ?? [];
    if (!isset($s['id'], $s['first'], $s['grade'], $s['section']) || !preg_match('/^[a-f0-9]{64}$/D', (string)$s['id']) || $s['grade'] < 1 || $s['grade'] > 6) {
        throw new DomainException('Vuelve a ingresar con tu cuenta de estudiante para guardar tus respuestas.', 401);
    }
    return $s;
}
function reg_activity(): array {
    return ['id'=>'fracciones-50-opciones-v1', 'title'=>'Fracciones homogéneas, heterogéneas y equivalentes · 50 ejercicios', 'questions'=>require __DIR__.'/questions.php'];
}
function reg_expected(array $q): array { return $q['answer']; }
function quiz_shuffle(array $values): array {
    for ($i=count($values)-1; $i>0; --$i) { $j=random_int(0,$i); [$values[$i],$values[$j]]=[$values[$j],$values[$i]]; }
    return $values;
}
function quiz_make_plan(): array {
    // Balanced 13/13/12/12, without consecutive equal correct letters.
    $counts=quiz_shuffle([13,13,12,12]); $last=-1; $plan=[];
    foreach (reg_activity()['questions'] as $q) {
        $position=null;
        foreach (quiz_shuffle([0,1,2,3]) as $candidate) {
            if ($candidate===$last || !$counts[$candidate]) continue;
            $remaining=$counts; --$remaining[$candidate]; $total=array_sum($remaining);
            if (max($remaining) <= intdiv($total+1,2) && $remaining[$candidate] <= intdiv($total,2)) { $position=$candidate; break; }
        }
        if ($position===null) throw new RuntimeException('No se pudo distribuir las alternativas.');
        --$counts[$position]; $last=$position; $wrong=quiz_shuffle($q['wrong']); $options=[];
        for ($i=0;$i<4;++$i) $options[]=$i===$position ? $q['answer'] : array_shift($wrong);
        $plan[]=$options;
    }
    return $plan;
}
function quiz_plan(string $attempt): array {
    $db=reg_db();
    $q=$db->prepare('SELECT options_json FROM fraction_quiz_layouts WHERE attempt_id=?');
    $q->execute([$attempt]); $json=$q->fetchColumn();
    if (!$json) {
        $json=json_encode(quiz_make_plan(),JSON_THROW_ON_ERROR);
        $db->prepare('INSERT OR IGNORE INTO fraction_quiz_layouts(attempt_id,options_json) VALUES(?,?)')->execute([$attempt,$json]);
        $q->execute([$attempt]); $json=$q->fetchColumn();
    }
    return json_decode($json,true,512,JSON_THROW_ON_ERROR);
}
function quiz_public_question(array $attempt): array {
    $index=(int)$attempt['current_question']; $q=reg_activity()['questions'][$index];
    return ['category'=>$q['category'],'prompt'=>$q['prompt'],'operation'=>$q['operation'],'options'=>quiz_plan($attempt['id'])[$index]];
}
function reg_attempt(string $id, string $student): array {
    $q=reg_db()->prepare('SELECT * FROM attempts WHERE id=? AND student_id=?');
    $q->execute([$id,$student]); $row=$q->fetch();
    if (!$row || $row['activity']!==reg_activity()['id']) throw new DomainException('No se encontró esta actividad para tu cuenta.',404);
    return $row;
}
function reg_state(?array $attempt, array $student): array {
    $result=['student'=>['name'=>$student['first'],'grade'=>(int)$student['grade'],'section'=>$student['section']], 'csrf'=>reg_csrf(), 'attempt'=>null];
    if (!$attempt) return $result;
    $index=(int)$attempt['current_question']; $activity=reg_activity();
    $q=reg_db()->prepare('SELECT COUNT(*) FROM responses WHERE attempt_id=? AND question_index=?');
    $q->execute([$attempt['id'],$index]);
    $result['attempt']=['id'=>$attempt['id'],'title'=>$attempt['activity_title'],'total'=>(int)$attempt['total'], 'current'=>$index,
        'correct'=>(int)$attempt['correct_count'],'completed'=>$attempt['completed_at']!==null,'tries'=>(int)$q->fetchColumn(),
        'question'=>$attempt['completed_at']===null ? quiz_public_question($attempt) : null];
    return $result;
}
