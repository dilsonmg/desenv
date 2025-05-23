<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

//$descr_evento  = str_replace("'","",$descr_evento);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");
$dt1=explode("/",$data_realiz);
$data_realiz1="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$obs_acomp   = str_replace("'","",$obs_acomp);



$aResult = gravarreg($id,$id_consult,$id_pericontr,$data_realiz1,$a,$obs_acomp );

header("Location: consult0006.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6){
	  if ($cp5 <> "E") {   
           echo("SELECT * FROM tb_acompcontr where id_acompcontr = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_acompcontr where id_acompcontr ='". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
					 echo("insert into tb_acompcontr(id_consult,id_pericontr,data_realiz,obs_acomp)  values('$cp2','$cp3','$cp4','$cp6')");
						  
    		   $sqlins = "insert into tb_acompcontr(id_consult,id_pericontr,data_realiz,obs_acomp)  values('$cp2','$cp3','$cp4','$cp6')";
	    	   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		     } else { 
                 echo("update tb_acompcontr set id_consult = '" .$cp2 .  "', id_pericontr = '" .$cp3 .  "', data_realiz = '" .$cp4 . "',obs_acomp = '".$cp6 . 
				           "'  where id_acompcontr = '".$cp1."'");
						
		        $sqlins = "update tb_acompcontr set id_consult = '" .$cp2 .  "', id_pericontr = '" .$cp3 .  "', data_realiz = '" .$cp4 ."',obs_acomp = '".$cp6 .
				           "'  where id_acompcontr = '".$cp1."'";
	    	   $ins=mysql_query( $sqlins );

		    }
	  }


	  if ($cp5 == "E") {   
	         echo("delete from tb_acompcontr where id_acompcontr = '". $cp1 ."'");
	        $sqlins = "delete from tb_acompcontr where id_acompcontr = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
	  }
	  
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
