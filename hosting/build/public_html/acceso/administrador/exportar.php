<?php
declare(strict_types=1);
require __DIR__.'/bootstrap.php'; admin_require();
[$where,$params]=admin_filters();
$q=reg_db()->prepare('SELECT a.student_name,a.student_id,a.grade,a.section,a.activity_title,a.id,a.completed_at,r.* FROM attempts a JOIN responses r ON r.attempt_id=a.id'.$where.' ORDER BY a.started_at,a.id,r.question_index,r.try_number'); $q->execute($params);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="respuestas-ie82661-'.gmdate('Y-m-d').'.csv"');
$out=fopen('php://output','wb'); fwrite($out,"\xEF\xBB\xBF");
function csv_safe($value): string { $s=(string)$value; return preg_match('/^[\s]*[=+\-@]|^[\t\r\n]/u',$s) ? "'".$s : $s; }
fputcsv($out,['Estudiante','Código','Grado','Sección','Actividad','Registro','Estado','Pregunta N.°','Pregunta','Intento','Respuesta','Respuesta correcta','Resultado','Fecha y hora (Perú)'],';', '"', '');
while($r=$q->fetch()) {
    $fields=[$r['student_name'],substr($r['student_id'],0,10),$r['grade'],$r['section'],$r['activity_title'],$r['attempt_id'],$r['completed_at']?'Completada':'En curso',(int)$r['question_index']+1,$r['question'],$r['try_number'],$r['numerator'].'/'.$r['denominator'],$r['expected'],$r['correct']?'Correcta':'Incorrecta',reg_date($r['answered_at'])];
    fputcsv($out,array_map('csv_safe',$fields),';','"','');
}
fclose($out);
