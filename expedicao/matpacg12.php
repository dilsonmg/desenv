<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
echo($a);

$dt1=explode("/",$data_prevlib);
$data_prevlib="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

echo($data_prevlib);

$dt1=explode("/",$data_liblote);


if($cod_prod2 <> "") {
	$cod_prod = $cod_prod2;}
	
	
echo($cod_prod);	

if ($quant_fabr == ''){
	$quant_fabr = 0.00;
}

echo($cod_prod);

$msg_lote = str_replace("'","",$msg_lote);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");
$aResult = gravarreg($id,$msg_lote);


if (isset($prg)){
	header("Location: matpac201.php");
}else{
	header("Location: matpac001.php");
}

function gravarreg($cp1,$cp2){
	
		        $sqlins = "update tb_entprodac set msg_lote  = '" . $cp2 . "'   where id_entprodac = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins  );
			   
					   
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
