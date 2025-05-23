<?php
include 'conectabco.php';

$a = $_GET ["id"];


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

	       
		  echo("delete from tb_saidaprodac where id_saidaprodac = '". $a ."'");
	      $sqlins = "delete from tb_saidaprodac where id_saidaprodac = '". $a ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			

		unset( $a );
header("Location: matpac003.php");
?>
