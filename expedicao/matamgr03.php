<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
//$dt1=explode("/",$data_saida);
//$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quant_it == ''){
	$quant_it = 0.00;
}

$quant_it    = str_replace(",",".",$quant_it);


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($id_grpamostra);
$aResult = gravarreg($id,$id_grpamostra,$cod_prod,$unid_amostra,$quant_it,$a);

unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6);
header("Location: matam0003.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6){
	 
	  if ($cp6 <> "E") {   
           echo("SELECT * FROM tb_compgrp where id_compgrp = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_compgrp where id_compgrp = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				echo("SELECT max(id_compgrp) + 1 as id_compgrp FROM tb_compgrp ");
				   $rs1000       = mysql_query("SELECT max(id_compgrp) + 1 as id_compgrp FROM tb_compgrp");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_compgrp'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_compgrp(id_compgrp,id_grpamostra,cod_prod,unid_amostra,quant_it)
							values('$cp1','$cp2','$cp3','$cp4','$cp5')";
							
				   echo("insert into tb_compgrp(id_compgrp,id_grpamostra,cod_prod,unid_amostra,quant_it)
							values('$cp1','$cp2','$cp3','$cp4','$cp5')");			
														
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

               echo("update tb_compgrp set unid_amostra = '"   . $cp4 . "', quant_it = '".$cp5 ."' where id_compgrp = '".$cp1."'");

		       $sqlins = "update tb_compgrp set unid_amostra = '"   . $cp4 . "', quant_it = '".$cp5 ."'  where id_compgrp = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp6 == "E") {   
	       
		  echo("delete from tb_compgrp where id_compgrp = '". $cp1 ."'");
	      $sqlins = "delete from tb_compgrp where id_compgrp = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
