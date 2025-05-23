<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];
echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
if ($data_descart != ''){
    $dt1=explode("/",$data_descart);
    $data_descart="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
}
else {$data_descart = NULL; }

$observ    = str_replace("'"," ",$observ);



ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($id_contraprov);
$aResult = gravarreg($id,$cod_prod,$num_lote,$localizacao,$data_descart,$observ,$situacao,$a);

		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8);
header("Location: matcpm01.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8){
	 
	  if ($cp8 <> "E") {   
           echo("SELECT a.* FROM tb_contraprovm a where a.cod_prod = '". $cp2."' and a.num_lote = '" .$cp3 . "'");	
		  
		  $rs1 = mysql_query("SELECT a.* FROM tb_contraprovm a where a.cod_prod = '". $cp2."' and a.num_lote = '" .$cp3 . "'");
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				echo " Registro nao encontrado !";
			} else { 

               echo("update tb_contraprovm set localizacao = '"   . $cp4 . "', data_descart  = '" .$cp5 ."', observ = '" .$cp6 .
			   "', situacao = '".$cp7 ."' where cod_prod = '".$cp2."' and num_lote = '" .$cp3 ."'");

             if ($cp5 != NULL) {
		        $sqlins = "update tb_contraprovm set localizacao = '"   . $cp4 . "', data_descart  = '" .$cp5 ."', observ = '" .$cp6 .
			   "', situacao = '".$cp7 ."' where cod_prod = '".$cp2."' and num_lote = '" .$cp3 ."'";}
			 else{
			  $sqlins = "update tb_contraprovm set localizacao = '"   . $cp4 . "', observ = '" .$cp6 .
			   "', situacao = '".$cp7 ."' where cod_prod = '".$cp2."' and num_lote = '" .$cp3 ."'";
			 }
echo($sqlins);
	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp8 == "E") {   
	       
		  echo("delete from tb_contraprovm where cod_prod = '".$cp2."' and num_lote = '" .$cp3 ."'");
	      $sqlins = "delete from tb_contraprovm where cod_prod = '".$cp2."' and num_lote = '" .$cp3 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
