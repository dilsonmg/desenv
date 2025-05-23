<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$descr_despreal  = str_replace("'","",$descr_despreal);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");


$aResult = gravarreg($id,$descr_despreal,$a);

//header("Location: custoindr001.php");


function gravarreg($cp1,$cp2,$cp3){
	  if ($cp3 <> "E") {   
           echo("SELECT * FROM tb_despreal where id_despreal = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_despreal where id_despreal ='". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
					 echo("insert into tb_despreal(descr_despreal)  values('$cp2')");
						  
    		   $sqlins = "insert into tb_despreal(descr_despreal) values('$cp2')";
	    	   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		  } else { 
                 echo("update tb_despreal set descr_despreal = '" .$cp2 . "' where id_despreal = '".$cp1."'");
						 
						 // id_eqpto = '" .$cp2 . "',".

		        $sqlins = "update tb_despreal set descr_despreal = '" .$cp2 .  "'   where id_despreal = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp3 == "E") {   
	echo("delete from tb_despreal where id_despreal = '". $cp1 ."'");
	        $sqlins = "delete from tb_despreal where id_despreal = '". $cp1 ."'";
	       // $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
