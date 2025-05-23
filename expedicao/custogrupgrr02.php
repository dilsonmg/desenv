<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$id_grupocusto  = str_replace("'","",$id_grupocusto);
$cod_sidespreal  = str_replace("'","",$cod_sidespreal);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");


$aResult = gravarreg($id,$id_grupocusto,$cod_sidespreal,$a);

header("Location: custogrupr002.php");


function gravarreg($cp1,$cp2,$cp3,$cp4){
	  if ($cp4 <> "E") {   
           echo("SELECT * FROM tb_vinccustor where id_vinccustor = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_vinccustor where id_vinccustor ='". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
					 echo("insert into tb_vinccustor(id_grupocusto,cod_sidespreal)  values('$cp2','$cp3')");
						  
    		   $sqlins = "insert into tb_vinccustor(id_grupocusto,cod_sidespreal)  values('$cp2','$cp3')";
	    	   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		  } else { 
                 echo("update tb_vinccustor set id_grupocusto = '" .$cp2 .  ",
				                              cod_sidespreal = '" . $cp3 . "' where id_vinccustor = '".$cp1."'");
						 
						 // id_eqpto = '" .$cp2 . "',".

		        $sqlins = "update tb_vinccustor set id_grupocusto = '" .$cp2 .  ",
				                              cod_sidespreal = '" . $cp3 ."'   where id_vinccustor = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp4 == "E") {   
			echo("delete from tb_vinccustor where id_vinccustor = '". $cp1 ."'");
	        $sqlins = "delete from tb_vinccustor where id_vinccustor = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
