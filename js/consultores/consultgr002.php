<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$descr_itcontr   = str_replace("'","",$descr_itcontr);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");


$aResult = gravarreg($id,$descr_itcontr,$a);
header("Location: consult0002.php");

function gravarreg($cp1,$cp2,$cp3){
	 
	  if ($cp3 <> "E") {   
           echo("SELECT * FROM tb_itcontr where id_itcontr = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_itcontr where id_itcontr = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){ 

				echo("insert into tb_itcontr(descr_itcontr)
  			              values('$cp2')");
						  			  
    		   $sqlins = "insert into tb_itcontr(descr_itcontr)
  			              values('$cp2')";
	    	   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		  } else { 

echo("update tb_itcontr set descr_itcontr = '"   . $cp2 .  "'  where id_itcontr = '".$cp1."'");

		        $sqlins = "update tb_itcontr set descr_itcontr = '"   . $cp2 . "'  where id_itcontr = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp3 == "E") {   
	echo("delete from tb_itcontr where id_itcontr = '". $cp1 ."'");
	        $sqlins = "delete from tb_itcontr where id_itcontr = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5);
?>

