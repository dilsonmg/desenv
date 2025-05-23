<?php

$horaA = '12:22:00';
$horaB = '18:02:00';

echo calculaTempo($horaA, $horaB);


function calculaTempo($hora_inicial, $hora_final) {
$i = 1;
$tempo_total;

$tempos = array($hora_final, $hora_inicial);

foreach($tempos as $tempo) {
$segundos = 0;

list($h, $m, $s) = explode(':', $tempo);

$segundos += $h * 3600;
$segundos += $m * 60;
$segundos += $s;

$tempo_total[$i] = $segundos;

$i++;
}
$segundos = $tempo_total[1] - $tempo_total[2];

$horas = floor($segundos / 3600);
$segundos -= $horas * 3600;
$minutos = str_pad((floor($segundos / 60)), 2, '0', STR_PAD_LEFT);
$segundos -= $minutos * 60;
$segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);

return "$horas:$minutos:$segundos";
}

?>
