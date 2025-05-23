<?php
session_start();

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("Você não esta logado !!");
              	header("Location: login.php"); 

}

include 'conectabco.php';
echo $a;
/*
echo $_POST ["nome"];



$a = $_POST ["gravar"];
*/
$a = $_GET ["gravar"];

//if ($a = "I"){
$dt1=explode("/",$data_receb);
$data_receb="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";


echo("especificacao=".$especificao);
	
if($num_lote == "") {
	$num_lote = $nfiscal ."/" . $dt1[2];
}

	$aResult = gravarreg( $id_avlfornec, $id_fornec,$cod_prod,$data_receb,$sequencial,$pedido,$nfiscal,$especificacao,$pontualidade,$integridade,
	$quantidade,$id_func,str_replace("'","",$obs_func),$docs_fiscais,str_replace("'","",$obs_fiscai),$certif_analise,
	$integr_veic,str_replace("'","",$obs_veic),$limpo,str_replace("'","",$obs_limpo),$ausenc_vet,str_replace("'","",$obs_vet),
	$aprop_carga,str_replace("'","",$obs_aprop),$analise,str_replace("'","",$obs_analise),$a,$num_lote,$espec_cor,str_replace("'","",$obs_cor)
	,$espec_aparencia,str_replace("'","",$obs_aparencia),$espec_ph,str_replace("'","",$obs_ph));

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17,$cp18,
      $cp19,$cp20,$cp21,$cp22,$cp23,$cp24,$cp25,$cp26,$a,$cp27,$cp28,$cp29,$cp30,$cp31,$cp32,$cp33)
	  
{

	  $ttl = 0 ;
  	  if ($a == "I"){
	 
			$rs1 = mysql_query("SELECT id_avlfornec FROM tb_avlfornec where id_avlfornec =". $cp1);
            $ttl = mysql_num_rows($rs1);
	
	         if ($ttl == 0){
     
	     		   $sqlins = "insert into  tb_avlfornec(id_avlfornec,id_fornec,cod_prod,
				   data_receb,sequencial,pedido,nfiscal,especificacao,pontualidade,integridade,quantidade,
				   id_func,obs_func,docs_fiscais,obs_fiscai,certif_analise,integr_veic,
				   obs_veic,limpo,obs_limpo,ausenc_vet,obs_vet,aprop_carga,
				   obs_aprop,analise,obs_analise,num_lote,espec_cor,obs_cor,espec_aparencia,obs_aparencia,espec_ph,obs_ph) 
	               values('$cp1','$cp2','$cp3','$cp4','$cp1','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12',
	  '$cp13','$cp14','$cp15','$cp16','$cp17','$cp18', '$cp19','$cp20','$cp21','$cp22','$cp23','$cp24','$cp25','$cp26','$cp27'
	  ,'$cp28','$cp29','$cp30','$cp31','$cp32','$cp33')";
		  // printf($sqlins);
	    	   $ins=mysql_query( $sqlins );
	         }
             else {
			    $sqlins = "update tb_avlfornec 
				           set id_fornec = '" .$cp2 . "',".
				          "cod_prod = '"   . $cp3 . "',".
						  "data_receb = '" . $cp4 . "',".
						  "sequencial = '" . $cp1 . "',".
						  "pedido = '" . $cp6 . "',".
						  "nfiscal = '" . $cp7 . "',".
						  "especificacao = '" . $cp8 . "',".
						  "pontualidade = '" . $cp9 . "',".
						  "integridade = '" . $cp10 . "',".
  						  "quantidade = '" . $cp11 . "',".
  						  "id_func = '" . $cp12 . "',".
  						  "obs_func = '" . $cp13 . "',".
  						  "docs_fiscais = '" . $cp14 . "',".
  						  "obs_fiscai = '" . $cp15 . "',".
  						  "certif_analise = '" . $cp16 . "',".
  						  "integr_veic = '" . $cp17 . "',".
  						  "obs_veic = '" . $cp18 . "',".
  						  "limpo = '" . $cp19 . "',".
  						  "obs_limpo = '" . $cp20 . "',".
						  "ausenc_vet = '" . $cp21 . "',".						  						  						  					   						  "obs_vet = '" . $cp22 . "',".
  						  "aprop_carga = '" . $cp23 . "',".
  						  "obs_aprop = '" . $cp24 . "',".
  						  "analise = '" . $cp25 . "',".						  						  						 
						  "num_lote = '" . $cp27 . "',".						  						  						  
  					  "espec_cor = '" . $cp28 . "',".						  						  						  
  					  "obs_cor = '" . $cp29 . "',".						  						  						  
  					  "espec_aparencia = '" . $cp30 . "',".						  						  						  
  					  "obs_aparencia = '" . $cp31 . "',".						  						  						  
  					  "espec_ph = '" . $cp32 . "',".						  						  						  
  					  "obs_ph = '" . $cp33 . "',".						  						  						  
    						  "obs_analise = '" . $cp26  . "'  where id_avlfornec = '".$cp1."'";
              //    echo($sqlins);
				  $ins=mysql_query( $sqlins );	   
		   }
		  //verifica se o resultado dado é falso
		  if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}
		  else{
				$msg= "Foi inserida " . mysql_affected_rows( ) . " linha <br/>";
				//destrói as variáveis criadas para receber os dados
		  }
	  }
	 if ($a == "E") {
	        $sqlins = "delete from tb_avlfornec where id_avlfornec = $cp1";	
	      // echo($sqlins);  
		    $ins=mysql_query( $sqlins );
      }

			unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17,$cp18
			,$cp19,$cp20,$cp21,$cp22,$cp23,$cp24,$cp25,$cp26,$cp27,$cp28,$cp29,$cp30,$cp31,$cp32,$cp33);

	
}
header("Location: dados_entrega.php");
?>
