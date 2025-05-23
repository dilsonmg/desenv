
<?php
$cabec   = array();

$nmeses = 12;
$ttmes = 0;



$meses = array (1 => "Jan", 2 => "Fev", 3 => "Mar", 4 => "Abr", 5 => "Mai", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Set", 10 => "Out", 11 => "Nov", 12 => "Dez");

///////////////////   teste dif datas ////////////////////////
$data1text = '2017-10-01';
$data2text = '2018-05-01';



$date1 = new DateTime($data1text);
$date2 = new DateTime($data2text);

$ttmes = (int)$nmeses - (int)$date1->format('m') +1;
$mesi = (int)$date1->format('m') -1;
$mesf = (int)$date2->format('m') ;

echo("mesf".$mesf);

echo ("dif meses = " . $ttmes);

$x=0;
for ($i = 1;$i <= $ttmes; $i++){
	$cabec[$i] = $meses[$mesi + $i];	
	echo($cabec[$i]);
	$x++;
}
for ($i = 1;$i <= $mesf; $i++){
	$cabec[$i] = $meses[$i];	
	echo($cabec[$i]);
	$x++;
}

echo ("o tamanho do cabecalho e ". $x);

//Repare que inverto a ordem, assim terei a subtração da ultima data pela primeira.
//Calculando a diferença entre os meses
$meses = ((int)$date2->format('m') - (int)$date1->format('m'))
//    e somando com a diferença de anos multiplacado por 12
    + (((int)$date2->format('y') - (int)$date1->format('y')) * 12);

echo $meses;//2
?>