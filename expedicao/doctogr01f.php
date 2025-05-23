<?php
include 'conectabco.php';

//$id = $_GET["id"];
//$codigo_si = $_GET["codigo_si"];

echo($id);
echo($codigo_si);

$aResult = gravarreg($id,$codigo_si);

header("Location: docto0001f.php?id=$id");


function gravarreg($cp1,$cp2){


				 echo("update tb_documentos set codigo_si = '" .$cp2 .						  
						   "'  where id_documento = '".$cp1."'"); 				
			  
						  
		        $sqlins = "update tb_documentos set codigo_si = '" .$cp2 . 						  
						   "'  where id_documento = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

		  
	  }
		unset( $cp1,$cp2,$cp3 );
?>
