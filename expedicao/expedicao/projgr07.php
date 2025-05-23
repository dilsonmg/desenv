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


echo("class_param = ".$class_param);

$aResult = gravarreg($id,$id_projeto,$id_paramestd,$id_ambiente,$semana,$fermentacao,$fung_bact,$cor_param,$obs_param,$class_param,$a,$separacao,$odor);

		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8);
header("Location: proj0007.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13){
	 
	  if ($cp11 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_estudosp where id_estudosp = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_estudosp) + 1 as id_estudosp FROM tb_estudosp");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_estudosp'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
							
							
				   $sqlins = "insert into tb_estudosp(id_estudosp,id_projeto,id_paramestd,id_ambiente,semana,fermentacao,fung_bact,cor_param,obs_param,
				            class_param,separacao,odor)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp12','$cp13')";
					echo($sqlins);
							
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
							
    	            $sqlins = "update tb_estudosp set semana = '"   . $cp5
							. "', id_paramestd = '" . $cp3
							. "', id_ambiente = '" . $cp4
					        . "', fermentacao = '" . $cp6
					        . "', fung_bact = '" . $cp7
					        . "', cor_param = '" . $cp8
	                        . "', obs_param = '" . $cp9
					        . "', class_param = '" . $cp10	
					        . "', separacao = '" . $cp12
							. "', odor = '" . $cp13																					
							. "'  where id_estudosp = '".$cp1."'" ;
					echo($sqlins);		
	    	       $ins=mysql_query( $sqlins );					   
   	               if( $ins===FALSE ){
		         		$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		           }
	  }
	  if ($cp11 == "E") {   
	       
	      $sqlins = "delete from tb_estudosp where id_estudosp = '". $cp1 ."'";
		  echo($sqlins);
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
