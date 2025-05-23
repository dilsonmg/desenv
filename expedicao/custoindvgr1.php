<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$data_saida);
$data_saida="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid_said == ''){
	$quantid_said = 0.00;
}

$obs_custoind  = str_replace("'","",$obs_custoind);
$val_custoind = str_replace(",",".",$val_custoind);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

$aResult = gravarreg($id,$id_centcustoind,$mes_custoind,$ano_custoind,$val_custoind,$obs_custoind,$a);
header("Location: custoindv001.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7){
	 
	  if ($cp7 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_customind where id_customind  = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
				   
				   $sqlins = "insert into tb_customind(id_centcustoind,mes_custoind,ano_custoind,val_custoind,obs_custoind)
							values('$cp2','$cp3','$cp4','$cp5','$cp6')";		
echo( $sqlins );												
				   $ins=mysql_query( $sqlins );
						 
			       if( $ins===FALSE ){
				       $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

                   $sqlins = "update tb_customind set mes_custoind = '"   . $cp3 . "',".
						  "ano_custoind = '" . $cp4 . "',  val_custoind = '" . $cp5 ."', obs_custoind = '" . $cp6 . "' where id_customind = '".$cp1."'";
echo( $sqlins );
	    	      $ins=mysql_query( $sqlins );
					   
   	              if( $ins===FALSE ){
				    $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		   }
	  }
	  if ($cp7 == "E") {   
	       
		  echo("delete from tb_customind where id_customind = '". $cp1 ."'");
	      $sqlins = "delete from tb_customind where id_customind = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
