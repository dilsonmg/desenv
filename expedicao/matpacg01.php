<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$data_saida);
$data_saida="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid_said == ''){
	$quantid_said = 0.00;
}

$cod_prod       = str_replace("'","",$cod_prod);
$descr_analise  = str_replace("'","",$descr_analise);
$limite_analise = str_replace(",",".",$limite_analise);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

$aResult = gravarreg($id,$cod_prod,$descr_analise,$limite_analise,$a);

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5){
	 
	  if ($cp5 <> "E") {   
           echo("SELECT * FROM tb_limitprod where id_limit = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_limitprod where id_limit  = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_limit) + 1 as id_limit FROM tb_limitprod");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_limit'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_limitprod(id_limit,cod_prod,descr_analise,limite_analise)
							values('$cp1','$cp2','$cp3','$cp4')";
							
				   echo("insert into tb_limitprod(id_limit,cod_prod,descr_analise,limite_analise)
							values('$cp1','$cp2','$cp3','$cp4')");			
							
							
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

     echo("update tb_limitprod set descr_analise = '"   . $cp3 . "',".
						  "limite_analise = '" . $cp4 . "'  where id_limit = '".$cp1."'");

		        $sqlins = "update tb_limitprod set descr_analise = '"   . $cp3 . "',".
						  "limite_analise = '" . $cp4 . "'  where id_limit = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp5 == "E") {   
	       
		  echo("delete from tb_limitprod where id_limit = '". $cp1 ."'");
	      $sqlins = "delete from tb_limitprod where id_limit = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
header("Location: matpac100.php");
?>
