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

echo($id_despveic);
$aResult = gravarreg($id,$id_projeto,$id_paramestd,$descri_estudo,$data_estudo,$a);

		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9);
header("Location: proj0003.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6){
	 
	  if ($cp6 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_estdparam where id_estdparam = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_estdparam) + 1 as id_estdparam FROM tb_estdparam");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_estdparam'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
							
							
				   $sqlins = "insert into tb_estdparam(id_estdparam,id_projeto,id_paramestd,descri_estudo,data_estudo)
							values('$cp1','$cp2','$cp3','$cp4','$cp5')";
					echo($sqlins);
							
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
							
    	            $sqlins = "update tb_estdparam set id_projeto = '"   . $cp2
					        . "', id_paramestd = '" . $cp3 
							. "', descri_estudo = '". $cp4
							. "', data_estudo = '" . $cp5
							. "'  where id_estdparam = '".$cp1."'" ;
					echo($sqlins);		
	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp6 == "E") {   
	       
	      $sqlins = "delete from tb_despveic where id_estdparam = '". $cp1 ."'";
		  echo($sqlins);
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
