<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$data_entrada);
$data_entrada="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$data_nf);
$data_nf="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$data_fab);
$data_fab="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$data_venc);
$data_venc="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($data_venc == "--"){$data_venc = "0000-00-00";}

if ($quantid_ent == ''){
	$quantid_ent = 0.00;
}

$num_nf         = str_replace("'","",$num_nf);
$num_lote       = str_replace("'","",$num_lote);
$atv_kamoran    = str_replace("'","",$atv_kamoran);
$msg_lote       = str_replace("'","",$msg_lote);
$nm_fabric      = str_replace("'","",$nm_fabric);
$localizacao    = str_replace("'","",$localizacao);


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

$aResult = gravarreg($id,$data_entrada,$cod_fornec,$cod_prod,$unidade,$num_nf,$data_nf,$num_lote,$data_fab,
$data_venc,$quantid_ent,$atv_kamoran,$a,$msg_lote,$nm_fabric,$motivo_ent,$localizacao,$id_subgrupo);

header("Location: matpe001.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17,$cp18){

	 $cp12 = str_replace(",", ".", $cp12);
	 
     $dt11=explode("-",$cp10);
     $anomd1 = $dt11[0] + 1;
     $data_vencret1="{$anomd1}-{$dt11[1]}-{$dt11[2]}";

	 
	  if ($cp13 <> "E") {   
           echo("SELECT * FROM tb_entmatp where id_entmatp = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_entmatp where id_entmatp = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_entmatp) + 1 as id_entmatp FROM tb_entmatp");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_entmatp'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
					   
					   echo("insert into tb_entmatp(id_entmatp,data_entrada,cod_fornec,cod_prod,unidade,num_nf,data_nf,num_lote,data_fab,
							data_venc,quantid_ent,atv_kamoran,msg_lote,nm_fabric,motivo_ent,id_subgrupo)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12','$cp14','$cp15','$cp16','$cp17','$cp18')");
									
				 $sqlins = "insert into tb_entmatp(id_entmatp,data_entrada,cod_fornec,cod_prod,unidade,num_nf,data_nf,num_lote,data_fab,
							data_venc,quantid_ent,atv_kamoran,msg_lote,nm_fabric,motivo_ent,id_subgrupo)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12','$cp14','$cp15','$cp16','$cp17','$cp18')";
				 $ins=mysql_query( $sqlins );
 				 
				 // contraprova materia prima
				 
				 $sqlins2 = "insert into tb_contraprovm(cod_prod,num_lote,data_fabr,cod_fornec,data_venc,venci_retencao,situacao,
				             quantidade,unidade,nm_fabric,localizacao)
				            values('$cp4','$cp8','$cp9','$cp3','$cp10','$data_vencret1','A','0.200','$cp5','$cp15','$cp17')";
//echo($sqlins2);							
										 
				 $ins=mysql_query( $sqlins2 );
				 
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 
		    	 $row1 = mysql_fetch_assoc($rs1);
           		 $entrada_ant          = $row1['quantid_ent'];	 
echo("update tb_entmatp set data_entrada = '"   . $cp2 . "',".
						  "cod_fornec = '" . $cp3 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "unidade = '" . $cp5 . "',".
						  "num_nf = '" . $cp6 . "',".
						  "data_nf = '" . $cp7 . "',".
						 // "num_lote = '" . $cp8 . "',".
						  "data_fab = '" . $cp9 . "',".
   			              "data_venc = '" . $cp10 . "',".
						  "quantid_ent = '" . $cp11 . "',".
						  "msg_lote = '" . $cp14 . "',".
						  "nm_fabric = '" . $cp15 . "',".
						  "motivo_ent = '" . $cp16 . "',".
						  "id_subgrupo = '" . $cp18 . "',".
						  "atv_kamoran = '" . $cp12 .  "'  where id_entmatp = '".$cp1."'");



		        $sqlins = "update tb_entmatp set data_entrada = '"   . $cp2 . "',".
						  "cod_fornec = '" . $cp3 . "',".
						//  "cod_prod = '" . $cp4 . "',".
						  "unidade = '" . $cp5 . "',".
						  "num_nf = '" . $cp6 . "',".
						  "data_nf = '" . $cp7 . "',".
						 // "num_lote = '" . $cp8 . "',".
						  "data_fab = '" . $cp9 . "',".
   			              "data_venc = '" . $cp10 . "',".
						  "quantid_ent = '" . $cp11 . "',".
						  "msg_lote = '" . $cp14 . "',".
						  "nm_fabric = '" . $cp15 . "',".
						  "motivo_ent = '" . $cp16 . "',".
						  "id_subgrupo = '" . $cp18 . "',".
						  "atv_kamoran = '" . $cp12 .  "'  where id_entmatp = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );


		   	$sqlins1 = "update tb_contraprovm set 
			                cod_fornec = '" . $cp3 . "',".
				            "data_fabr = '" . $cp9 ."',".
							"data_venc = '" .$cp10 . "',".
							"nm_fabric = '" . $cp15 . "',".
   						    "localizacao = '" . $cp17 . "',".						  
							"venci_retencao = '" . $data_vencret1 ."', situacao = 'A' where cod_prod = '" .$cp4 . "' and  num_lote = '" . $cp8 . "'";
		echo( $sqlins1 );					
	 
				$ins2=mysql_query( $sqlins1 );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp13 == "E") {   
	       
		  echo("delete from tb_entmatp where id_entmatp = '". $cp1 ."'");
	      $sqlins = "delete from tb_entmatp where id_entmatp = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
