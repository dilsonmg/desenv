<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$descr_evento  = str_replace("'","",$descr_evento);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");
$dt1=explode("/",$data_serv);
$data_serv="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";


/******  atualizar o registro ao inves de incluir
echo("SELECT * FROM tb_acompljm where id_eqpto = '". $id_eqpto."' and id_plmanut = '" . $id_plmanut . "'" );


$rs1000 = mysql_query("SELECT * FROM tb_acompljm where id_eqpto = '". $id_eqpto."' and id_plmanut = '" . $id_plmanut . "'" );	
$row1000 = mysql_fetch_assoc($rs1000);
$id     = $row1000['id_acompljm'];
*/

$aResult = gravarreg($id,$id_plmanut,$id_eqpto,$data_serv,$a);

header("Location: eqpto0012.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5){
	
	
	
	  if ($cp5 <> "E") {   
          // echo("SELECT * FROM tb_acompljm where id_acompljm = '". $cp1."'" );	
		  
		  echo("SELECT * FROM tb_acompljm where id_plmanut ='". $cp2 ."' and id_eqpto = '"  .$cp3 . "' and data_serv = '" . $cp4 . "'" );
		  
		  $rs1 = mysql_query("SELECT * FROM tb_acompljm where id_plmanut ='". $cp2 ."' and id_eqpto = '"  .$cp3 . "' and data_serv = '" . $cp4 . "'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
					 echo("insert into tb_acompljm(id_plmanut,id_eqpto,data_serv)  values('$cp2','$cp3','$cp4')");
						  
    		   $sqlins = "insert into tb_acompljm(id_plmanut,id_eqpto,data_serv) values('$cp2','$cp3','$cp4')";
	    	   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		  } else { 
                 echo("update tb_acompljm set id_plmanut = '" .$cp2 . "', id_eqpto = '" .$cp3 .
				          "',data_serv = '" . $cp4 . "'  where id_evento = '".$cp1."'");
						 
						 // id_eqpto = '" .$cp2 . "',".

		        $sqlins = "update tb_acompljm set id_plmanut = '" .$cp2 . "', id_eqpto = '" .$cp3 .
				          "',data_serv = '" . $cp4 . "'  where id_acompljm = '".$cp1."'";

	    	   //$ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp5 == "E") {   
	        echo("delete from tb_acompljm where id_acompljm = '". $cp1 ."'");
	        $sqlins = "delete from tb_acompljm where id_acompljm = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
	  }

		
	}
	
	
	
	
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
