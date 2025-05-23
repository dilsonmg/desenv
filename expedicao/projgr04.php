<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_estudo);
$data_estudo="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

ini_set("max_execution_time", 3600);
ini_set("memory_limit","256M");
$soma_sn = "N";
if ($perc_param != ""){ $soma_sn = "S"; }else {$perc_param = "0.00";}

echo($id_despveic);
$perc_param=str_replace(",",".",$perc_param);

if ($kg_param == ''){$kg_param=1;}

$aResult = gravarreg($id,$id_projeto,$cod_prod,$id_paramestd,$perc_param,$kg_param,$a,$soma_sn,$lote,$obs_item);

		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10);
header("Location: proj0004.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10){
	 
	  if ($cp7 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_estudform where id_estdform = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_estdform) + 1 as id_estdform FROM tb_estudform");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_estdform'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
							
				   if ($cp6 == ''){$cp6 = 1;}
				   $sqlins = "insert into tb_estudform(id_estdform,id_projeto,cod_prod,id_paramestd,perc_param,kg_param,soma_sn,lote,obs_item)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp8','$cp9','$cp10')";
					echo($sqlins);
							
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
							
    	            $sqlins = "update tb_estudform set perc_param = '"   . $cp5
					        . "', kg_param = '" . $cp6
					        . "', soma_sn = '" . $cp8
							. "', lote = '" . $cp9
							. "', obs_item = '" . $cp10
							. "'  where id_estdform = '".$cp1."'" ;
					echo($sqlins);		
	    	       $ins=mysql_query( $sqlins );					   
   	               if( $ins===FALSE ){
		         		$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		           }
	  }
	  if ($cp7 == "E") {   
	       
	      $sqlins = "delete from tb_estudform where id_estdform = '". $cp1 ."'";
		  echo($sqlins);
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
