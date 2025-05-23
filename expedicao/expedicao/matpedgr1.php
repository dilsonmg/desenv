<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
$id = $_GET["id"];
$cod_prod = $_GET["cod_prod"];
$num_lote = $_GET["num_lote"];
$quantid  = $_GET["quantid"];

echo($a);

$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_saida);
$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid == ''){
	$quantid = 0.00;
}

$cod_prod       = str_replace("'","",$cod_prod);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($cod_prod);
echo($num_lote);
echo($quantid);
echo($data_ped);

$aResult = gravarreg($id,$cod_prod,$num_lote,$quantid,$data_ped,$a);

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6){
	 
	  if ($cp6 <> "E") {   
           echo("SELECT * FROM tb_peddia where id_peddia = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_peddia where id_peddia = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_peddia) + 1 as id_peddia FROM tb_peddia");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_peddia'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_peddia(id_peddia,cod_prod,num_lote,quantid,data_ped)
							values('$cp1','$cp2','$cp3','$cp4','$cp5')";
							
				   echo("insert into tb_peddia(id_peddia,cod_prod,num_lote,quantid,data_ped)
							values('$cp1','$cp2','$cp3','$cp4','$cp5')");			
														
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

               echo("update tb_peddia set quantid = '"   . $cp4 . "'  where id_peddia = '".$cp1."'");

		        $sqlins = "update tb_peddia set quantid = '"   . $cp4 . "'  where id_peddia = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp6 == "E") {   
	       
		  echo("delete from tb_peddia where id_peddia = '". $cp1 ."'");
	      $sqlins = "delete from tb_peddia where id_peddia = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
header("Location: matped001.php");
?>
