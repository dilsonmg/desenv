<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$data_saida);
$data_saida="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid_said == ''){
	$quantid_said = 0.00;
}

$cod_prod       = str_replace("'","",$cod_prod);
$num_lote       = str_replace("'","",$num_lote);
$quantid_said   = str_replace(",",".",$quantid_said);
$saldo_anterior = str_replace(",",".",$saldo_anterior);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

$aResult = gravarreg($id,$cod_prod,$num_lote,$data_saida,$quantid_said,$lote_fabricado,$saldo_anterior,$unidade,$a,$obs,$motivo);

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11){
	 
	  if ($cp9 <> "E") {   
           echo("SELECT * FROM tb_saidmatp where id_saidmat = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_saidmatp where id_saidmat = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_saidmat) + 1 as id_saidmat FROM tb_saidmatp");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_saidmat'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
					   
				   $rsndpl = mysql_query("SELECT * FROM tb_saidmatp where cod_prod = '". $cp2 ."' and num_lote = '".$cp3 .
				   "' and data_saida = '".$cp4 ."' and quantid_said = '" . $cp5 . "' and lote_fabricado = '" .$cp6 ."'" );
                   $andp = mysql_num_rows($rsndp);

					if ($andp == 0){   
									
				      $sqlins = "insert into tb_saidmatp(id_saidmat,cod_prod,num_lote,data_saida,quantid_said,lote_fabricado,saldo_anterior,unidade,obs,motivo )
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp10','$cp11')";
							
				        echo("insert into tb_saidmatp(id_saidmat,cod_prod,num_lote,data_saida,quantid_said,lote_fabricado,saldo_anterior,unidade.obs,motivo )
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp10','$cp11')");			
							
							
				        $ins=mysql_query( $sqlins );
					}
					//"Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
		    	 $row1 = mysql_fetch_assoc($rs1);
           		 $entrada_ant          = $row1['quantid_ent'];	 

echo("update tb_saidmatp set data_saida = '"   . $cp4 . "',".
						  "quantid_said = '" . $cp5 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "lote_fabricado = '" . $cp6 . "',".
						  "unidade = '" . $cp8 .  "'  where id_saidmat = '".$cp1."'");

		        $sqlins = "update tb_saidmatp set data_saida = '"   . $cp4 . "',".
						  "quantid_said = '" . $cp5 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "lote_fabricado = '" . $cp6 . "',".
						   "obs = '" . $cp10 . "',".
						    "motivo = '" . $cp11 . "',".
						  "unidade = '" . $cp8 .  "'  where id_saidmat = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp9 == "E") {   
	       
		  echo("delete from tb_saidmatp where id_saidmat = '". $cp1 ."'");
	      $sqlins = "delete from tb_saidmatp where id_saidmat = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
header("Location: matpe002.php");
?>
