<?php
include 'conectabco.php';

$a = $_GET ["gravar"];

$dt1=explode("/",$dt_emis);
$data_emis="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$dt_fat);
$data_fat="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$data_entrega);
$data_entrega="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$dt1=explode("/",$dt_preventr);
$data_preventrega="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";


if ($val_fat == ''){
	$val_fat = 0.00;
}

$obs_transp   = str_replace("'","",$obs_transp);
$val_fret     = str_replace(",",".",$val_fret);
$val_fat      = str_replace(",",".",$val_fat);
$peso_qr      = str_replace(",",".",$peso_qr);

ini_set("max_execution_time", 30600);
ini_set("memory_limit","128M");

$aResult = gravarreg(
$id,
$num_pedido,
$num_nf,
$val_fret,
$aliq_icms,
$num_conhec,
$data_emis,
$data_preventrega,
$data_fat,
$val_fat,
$num_fat,
$data_entrega,
$hora_entrega,
$transp_redesp,
$contat_cli,
$tel_contat,
$situa_canhot,
$obs_transp,
$a,
$email,
$peso_qr,
$sit_fatura);

header("Location: matpac500.php?nped=".$num_pedido."&nnf=".$num_nf);

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17,$cp18,$cp19,$cp20,$cp21,$cp22){
	 
	  if ($cp19 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_infocarga where num_pedido = '". $cp2 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
	      if ($a == 0){
				   
				   $sqlins = "insert into tb_infocarga(
				   num_pedido,
				   num_nf,
				   val_fret,
				   aliq_icms,
				   num_conhec,
				   dt_emis,
				   dt_preventr,
				   dt_fat,
				   val_fat,
				   num_fat,
				   data_entrega,
				   hora_entrega,
				   transp_redesp,
				   contat_cli,
				   tel_contat,
				   situa_canhot,
				   obs_transp,
				   email,
				   peso_qr,
				   sit_fatura)
				   values('$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12','$cp13','$cp14','$cp15','$cp16','$cp17','$cp18','$cp20','$cp21','$cp22')";		
echo( $sqlins );												
				   $ins=mysql_query( $sqlins );
						 
			       if( $ins===FALSE ){
				       $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

                   $sqlins = "update tb_infocarga set num_pedido = '"   . $cp2 . "',".
						  "num_nf = '" . $cp3 . "',  val_fret = '" . $cp4 ."', aliq_icms = '" . $cp5 .
						  "',num_conhec = '" . $cp6 . "',  dt_emis = '" . $cp7 ."', dt_preventr = '" . $cp8 .
						  "',dt_fat = '" . $cp9 . "',  val_fat = '" . $cp10 ."', num_fat = '" . $cp11 .
						  "',data_entrega = '" . $cp12 . "', hora_entrega = '" . $cp13 ."', transp_redesp = '" . $cp14 .
						  "',contat_cli = '" . $cp15 . "',  tel_contat = '" . $cp16 ."', situa_canhot = '" . $cp17 . "', email = '" . $cp20  . "', peso_qr = '" . $cp21 . "', sit_fatura = '" . $cp22 .
						  "',obs_transp = '" . $cp18 . "' where num_pedido = '".$cp2."'";
echo( $sqlins );
	    	      $ins=mysql_query( $sqlins );
					   
   	              if( $ins===FALSE ){
				    $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		   }
	  }
	  if ($cp19 == "E") {   
	       
		  echo("delete from tb_infocarga where id_infocarga = '". $cp1 ."'");
	      $sqlins = "delete from tb_infocarga where id_infocarga = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>

