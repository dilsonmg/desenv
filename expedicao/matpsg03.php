<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$data_nf);
$data_nf="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";


$dt1=explode("/",$data_fatura);
$data_fatura="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid_said == ''){
	$quantid_said = 0.00;
}

$cod_prod       = str_replace("'","",$cod_prod);
$num_lote       = str_replace("'","",$num_lote);
$quantid        = str_replace(",",".",$quantid);
$numpedido      = str_replace(",",".",$numpedido);
$num_nf         = str_replace(",",".",$num_nf);
$saldo_anterior = str_replace(",",".",$ttestoq);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");


echo($codigo_cli);


$aResult = gravarreg($id,$cod_prod,$unidade,$num_lote,$quantid,$num_pedido,$num_nf,$data_nf,$codigo_cli,$data_fatura,$cod_fornec,$a);

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12){
	 
	  if ($cp12 <> "E") {   
           echo("SELECT * FROM tb_saidaprodac where id_saidaprodac = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_saidaprodac where id_saidaprodac = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_saidaprodac) + 1 as id_saidaprodac FROM tb_saidaprodac");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_saidaprodac'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = " insert into tb_saidaprodac(id_saidaprodac,cod_prod,unidade,num_lote,quantid,num_pedido,num_nf,data_nf,codigo_cli,data_fatura,cod_fornec )
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11')";
							
				echo(" insert into tb_saidaprodac(id_saidaprodac,cod_prod,unidade,num_lote,quantid,num_pedido,num_nf,data_nf,codigo_cli,data_fatura,cod_fornec )
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11')");								
							
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
		    	 $row1 = mysql_fetch_assoc($rs1);
           		 $entrada_ant          = $row1['quantid_ent'];	 

echo("update tb_saidaprodac set quantid = '" . $cp5 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "unidade = '" . $cp3 . "',".
						  "num_pedido = '" . $cp6 . "',".
						  "num_nf     = '" . $cp7 . "',".
						  "data_nf    = '" . $cp8 . "',".
						  "codigo_cli = '" . $cp9 . "',".
						  "data_fatura = '" . $cp10 . "',".
						  "cod_fornec = '" . $cp11 .  "'  where id_saidaprodac = '".$cp1."'");

		        $sqlins = "update tb_saidaprodac set quantid = '" . $cp5 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "unidade = '" . $cp3 . "',".
						  "num_pedido = '" . $cp6 . "',".
						  "num_nf     = '" . $cp7 . "',".
						  "data_nf    = '" . $cp8 . "',".
						  "codigo_cli = '" . $cp9 . "',".
						  "data_fatura = '" . $cp10 . "',".
						  
						  "cod_fornec = '" . $cp11 .  "'  where id_saidaprodac = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp12 == "E") {   
	       
		  echo("delete from tb_saidaprodac where id_saidaprodac = '". $cp1 ."'");
	      $sqlins = "delete from tb_saidaprodac where id_saidaprodac = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
header("Location: matpac003.php");
?>
