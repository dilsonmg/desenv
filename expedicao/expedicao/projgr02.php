<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_saida);
$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid == ''){
	$quantid = 0.00;
}

ini_set("max_execution_time", 3600);
ini_set("memory_limit","256M");

echo($id_paramestd);
$aResult = gravarreg($id,$desc_paramestd,$a);

		unset( $cp1,$cp2,$cp3);
header("Location: proj0002.php");

function gravarreg($cp1,$cp2,$cp3){
	 
	  if ($cp3 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_paramestd where id_paramestd = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_paramestd) + 1 as id_paramestd FROM tb_paramestd");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_paramestd'];
				   
				   if ($cp1  == ""){   $cp1 = 1;}  
							
				   echo("insert into tb_paramestd(id_paramestd,desc_paramestd)
							values('$cp1','$cp2')");
							
				   $sqlins = "insert into tb_paramestd(id_paramestd,desc_paramestd)
							values('$cp1','$cp2')";
							
				   $ins=mysql_query( $sqlins );
						 
			       if( $ins===FALSE ){
				        $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			       } else { 
    	                 $sqlins = "update tb_paramestd set desc_paramestd = '"   . $cp2 . "'  where id_paramestd = '".$cp1."'" ;
	    	             $ins=mysql_query( $sqlins );
					     if( $ins===FALSE ){
				               $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		           }
	  }
	  if ($cp3 == "E") {   
	       
		  echo("delete from tb_paramestd where id_paramestd = '". $cp1 ."'");
	      $sqlins = "delete from tb_paramestd where id_paramestd = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
