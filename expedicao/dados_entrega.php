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


/*
SELECT
   a.id_fornec,a.data_receb,a.especificacao,a.pontualidade,a.integridade,a.quantidade,
   sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) tot_receb, 20 totmax,
   ((sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) / 20)* 100) percreceb
 FROM tb_avlfornec a group by a.id_avlfornec order by a.id_fornec, data_receb asc;
 
 
 SELECT
   a.id_fornec,a.data_receb,a.especificacao,a.pontualidade,a.integridade,a.quantidade,
   sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) tot_receb, 20 totmax,
   ((sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) / 20)* 100) percreceb,
   count(a.id_fornec) tt_fornec
 FROM tb_avlfornec a group by a.id_fornec order by a.id_fornec, data_receb asc;
 
 
 
 
 SELECT a.id_fornec, b.rz_social,
   sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) pontuacao, 20 totmax,
   ((sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) / 20)* 100) percreceb,
   count(a.id_fornec) tt_receb
 FROM tb_avlfornec a
 inner join tb_fornecedor b on a.id_fornec = b.id_fornec
 group by a.id_fornec
 order by percreceb asc
 
 
*/

//header("Content-Type: text/html; charset=ISO-8859-1",true) ;
header("Content-Type: text/html; charset=UTF-8",true);

/*
session_start();

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("vc nao passou pelo arquivo anterior");

}

*/
include 'conectabco.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");
/*

session_start();

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("vc nao passou pelo arquivo anterior");

}
		 
*/
if ($p != 99){
	//$a = $_GET ["S"];
}

$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p5 = "";
$p6 = "";
$p7 = "";
$p8 = "";

if (isset($a)){
	$a=0; }
else{
    $a="";}	

if (isset($data_receb2)){
	if ($data_receb2 <> "" ){
		 $p2 = " and a.data_receb >= '" . formata_data2($data_receb2) ."'" ; 
		 }}
if (isset($data_receb3)){
	if ($data_receb3 <> "" ){
		 $p3 = " and a.data_receb <= '" . formata_data2($data_receb3) ."'" ; 
		 }}
if (isset($rz_social2)){
	if ($rz_social2 <> "" ){
		 $p4 = " and b.rz_social like '%" . $rz_social2 ."%'" ; 
		 }}
if (isset($pedido2)){
	if ($pedido2 <> "" ){
		 $p5 = " and a.pedido = '" . $pedido2 ."'" ; 
		 }}
if (isset($nfiscal2)){
	if ($nfiscal2 <> "" ){
		 $p6 = " and a.nfiscal = '" . $nfiscal2 ."'" ; 
		 }}
if (isset($descr_prod2)){
	if ($descr_prod2 <> "" ){
		 $p7 = " and c.descr_prod like '%" . $descr_prod2 ."%'" ; 
		 }}




$p8 = " order by  a.data_receb desc ,a.id_avlfornec desc,a.id_avlfornec  desc limit 0,30" ; //";

				  
				  
$rs0 = mysql_query("SELECT distinct a.*,b.rz_social,c.descr_prod
                  FROM tb_avlfornec a
  		          inner join tb_fornecedor b on a.id_fornec = b.id_fornec
				  inner join tb_produto c on a.cod_prod = c.cod_prod
                  where a.id_avlfornec > 0 " . $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p7 . $p8 );
				  				  			  
$rs01 = mysql_query("select a.id_fornec, a.rz_social from tb_fornecedor a order by a.rz_social");		

$rs10 = mysql_query("select a.cod_prod, a.descr_prod from tb_produto a order by a.descr_prod");		

		  
$rs111 = mysql_query("select a.id_criterio, a.descricao from tb_criterio a where a.tipo_crit = 1 order by a.descricao");				  
$rs112 = mysql_query("select a.id_criterio, a.descricao from tb_criterio a where a.tipo_crit = 2 order by a.descricao");				  
$rs113 = mysql_query("select a.id_criterio, a.descricao from tb_criterio a where a.tipo_crit = 3 order by a.descricao");				  
$rs114 = mysql_query("select a.id_criterio, a.descricao from tb_criterio a where a.tipo_crit = 4 order by a.descricao");				  

if (isset($id)){
	
     $rs1 = mysql_query("SELECT * FROM tb_avlfornec where id_avlfornec =". $id);
//print($id);
   //  $row = mysql_fetch_array($rs1, MYSQL_BOTH);
    $a = mysql_num_rows($rs1);
	//printf($a);
   
	 $row1 = mysql_fetch_assoc($rs1);
	 
	      $data_receb        = strftime("%Y-%m-%d", strtotime($row1['data_receb']));

	 
     $nvid            = $row1['id_avlfornec'];
	 $id_fornec       = $row1['id_fornec'];
     $data_receb      = $row1['data_receb'];
	 $sequencial      = $row1['sequencial'];
	 $pedido          = $row1['pedido'];
	 $nfiscal         = $row1['nfiscal'];
	 $especificacao   = $row1['especificacao'];
	 $pontualidade    = $row1['pontualidade'];
	 $integridade     = $row1['integridade'];
	 $quantidade      = $row1['quantidade'];
	 $id_func         = $row1['id_func'];
	 $obs_func        = $row1['obs_func'];
	 $docs_fiscais    = $row1['docs_fiscais'];
	 $obs_fiscai      = $row1['obs_fiscai'];
	 $certif_analise  = $row1['certif_analise'];
     $integr_veic     = $row1['integr_veic'];		 
     $obs_veic        = $row1['obs_veic'];		 
     $limpo           = $row1['limpo'];		 
     $obs_limpo       = $row1['obs_limpo'];		 
     $ausenc_vet      = $row1['ausenc_vet'];		 
     $obs_vet         = $row1['obs_vet'];		 
     $aprop_carga     = $row1['aprop_carga'];		 
     $obs_aprop       = $row1['obs_aprop'];		 
     $analise         = $row1['analise'];		 
     $obs_analise     = $row1['obs_analise'];
	 $cod_prod        = $row1['cod_prod'];		 
 	 $num_lote        = $row1['num_lote'];		 

 	 $espec_cor       = $row1['espec_cor'];		 
 	 $obs_cor         = $row1['obs_cor'];		 

 	 $espec_aparencia = $row1['espec_aparencia'];		 
 	 $obs_aparencia   = $row1['obs_aparencia'];		 

 	 $espec_ph        = $row1['espec_ph'];		 
 	 $obs_ph          = $row1['obs_ph'];		 

     }
else{
   //  print("passei 1");
	 $rs1       = mysql_query("SELECT max(id_avlfornec) + 1 as id_avlfornec FROM tb_avlfornec");
	 $row1      = mysql_fetch_assoc($rs1);
	 $nvid      = $row1['id_avlfornec'];
     if ($nvid  == ""){
		  $nvid = 1;}
	 $id_fornec       = '';
     $data_receb      = '';
	 $sequencial      = '';
	 $pedido          = '';
	 $nfiscal         = '';
	 $id_func         = '';
	 $obs_func        = '';
	 $docs_fiscais    = '';
	 $obs_fiscal      = '';
	 $certif_analise  = '';
     $integr_veic     = '';
     $obs_veic        = '';
     $limpo           = '';
     $obs_limpo       = '';
     $ausenc_vet      = '';
     $obs_vet         = '';
     $aprop_carga     = '';
     $obs_aprop       = '';
     $analise         = '';
     $obs_analise     = '';
	 $id_avlfornec    = $nvid ;
	 $num_lote        = '';		 
	 
 	 $espec_cor       = '';		 
 	 $obs_cor         = '';		 

 	 $espec_aparencia = '';		 
 	 $obs_aparencia   = '';		 

 	 $espec_ph        = '';		 
 	 $obs_ph          = '';		 

	 		 

}
	
						   
//$rs331=mysql_query("SELECT a.* FROM tb_contrato a
//                     order by a.id_contrato desc limit 0,3");


function formata_data($data)  
 {  
	  if ($data <> ""){
		  //recebe o parâmetro e armazena em um array separado por -  
		  $data = explode('-', $data);  
		  //armazena na variavel data os valores do vetor data e concatena /  
		  $data = $data[2].'/'.$data[1].'/'.$data[0];  
		  //retorna a string da ordem correta, formatada  
		  }
	  return $data;  
 }  


function formata_data2($data)  
 {  
	  if ($data <> ""){
		  //recebe o parâmetro e armazena em um array separado por -  
		  $data = explode('/', $data);  
		  //armazena na variavel data os valores do vetor data e concatena /  
		  $data = $data[2].'/'.$data[1].'/'.$data[0];  
		  //retorna a string da ordem correta, formatada  
		  }
	  return $data;  
 }  


  if($_GET ["P"] == 99){
	  
	  $a="";
	  
  }


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../css/qreal.css">

<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>SGQ - Check-list para recebimento de Insumos</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>


<script type='text/javascript'>

//////////////
function ver_fotoxx(foto){ 
        //  var setor_doc = document.form1.setor_doc.value
		  
		  subdir = "Fabrica";

		  
	      urln = '../documentos/arquivos/'+subdir +"/"+foto;
		  		    //alert(setor_dc);

          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}


///////////
function valida_numlote(){
var data_receb     = document.form1.data_receb.value;
var nfiscal        = document.form1.nfiscal.value;
var num_lote       = document.form1.num_lote.value;
	//alert("entrou");
	
if (num_lote == "" || eval(num_lote == 0)){
    //alert("Informe o numero do lote !");
	document.form1.num_lote.value= nfiscal + "/" + data_receb.substring(6);
	document.form1.num_lote.focus(); 
	return false;
	}	
	
}

////////


<!--
function fechar1(){
window.opener = window
 window.close("#")

}
 -->
 </script>

<style type="text/css"></style></head>

<body>


<form name="form1" method="post"  enctype="multipart/form-data">
<table width="100%" border="1" cellspacing="0"  align="center" >
  <tr>
    <td colspan="2" align="lefth" ><img src="../imagens/logoqrred.jpg"  border="0"></td>
    <td align="center" >
            <table width="80%" border="1">
              <tr>
                <td colspan="2" align="center" bgcolor="#EEEEEE">Tabela de especifica&ccedil;&otilde;es QTA</td>
              </tr>
              <tr>
                <td>Especifica&ccedil;&otilde;es de Embalagens</td>
                <td><a href="javascript:ver_fotoxx('<?php  echo("espec_embalagem.pdf");?>')"> Especifica&ccedil;&otilde;es </a></td>
              </tr>
              <tr>
                <td>Fornecedores Servi&ccedil;os Laborat&oacute;rios</td>
                <td><a href="javascript:ver_fotoxx('<?php  echo("fornec_prestserv.pdf");?>')"> Laborat&oacute;rios </a></td>
              </tr>
              <tr>
                <td>Fornecedores M.primas</td>
                <td><a href="javascript:ver_fotoxx('<?php  echo("fornec_mprima.pdf");?>')"> M.primas </a></td>
              </tr>
              <tr>
                <td>Fornecedores Embalagens</td>
                <td><a href="javascript:ver_fotoxx('<?php  echo("fornec_embalagem.pdf");?>')"> Embalagens </a></td>
              </tr>
              <tr>
                <td>Par&acirc;metros Kamoran(Lauril / S&iacute;lica)</td>
                <td><a href="javascript:ver_fotoxx('<?php  echo("Param contr mat prim utili prod Kamoran e derivs - 03_06_2020.pdf");?>')">Par&acirc;metros</a></td>
              </tr>
            </table>
      </td>
    <td align="right" ><img src="../imagens/tecladoclaro.png" /></td>
  </tr>
  </table>
  
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center"  bgcolor="#F2F2CC" ><b>Recebimento de Insumos -  Registro:<?php print($nvid);?>
      <input type="hidden" name="id_avlfornec" value="<?php print($nvid);?>" /></b> </td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Fonecedor : 
       <select name="id_fornec" >
        <?php while($row1=mysql_fetch_assoc($rs01)){ ?>
        <option value="<?php print($row1['id_fornec'])?>"
				     <? if($row1['id_fornec'] == $id_fornec ) {?>selected <? } ?>				
				 ><?php print($row1['rz_social'] . " - " .$row1['id_fornec'])?></option>
        <?php }//end if ?>
      </select>
     </td>
    <td  >Data
      <input type="text" name="data_receb" size="10" maxlength="10" value="<?php echo formata_data($data_receb) ?>" title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/></td>
    <td  >Insumo
      <select name="cod_prod" >
        <?php while($row1=mysql_fetch_assoc($rs10)){ ?>
        <option value="<?php print($row1['cod_prod'])?>"
				     <? if($row1['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row1['cod_prod'] . " - " .$row1['descr_prod'])?></option>
        <?php }//end if ?>
      </select></td>

  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Nota Fiscal
      <input type="text" name="nfiscal" size="30" maxlength="20"  value="<?php echo($nfiscal) ?>"/></td>
    <td  >Pedido
      <input type="text" name="pedido" size="20" maxlength="15" value="<?php echo($pedido) ?>" /></td>
    <td  >Num. Lote
      <input type="text" name="num_lote" size="20" maxlength="15" value="<?php echo($num_lote) ?>"  onblur="valida_numlote();"/></td>

  </tr>
   
    <!--tr>
  <td colspan="9" align="center" bgcolor="#F2F2CC" ><b>Especifica&ccedil;&atilde;o / Produto</b></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#EEEEEE" >Cor</td>
    <td colspan="2" bgcolor="#FFFFFF" >
    <input type="radio" name="espec_cor"  onblur="valida_numlote();"
	<?php 
	   if ($espec_cor == "S" ) {
		  // print("Checked='checked'  ");
	   }
	   ?>
	 value='S' />Ok
    <input type="radio" name="espec_cor" 
    	<?php 
	   if ($espec_cor == "N" ) {
		//   print("Checked='checked'  ");
	   }
	   ?>

     value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" >Obs</td>
    <td colspan="3" >
    <input type="text" name="obs_cor" size="80" maxlength="80"  value="<?php echo($obs_cor) ?>" /></td>
  </tr-->
  <!--tr>
    <td bgcolor="#EEEEEE" >Apar&egrave;ncia</td>
    <td bgcolor="#FFFFFF" ><input type="radio" name="espec_aparencia" 
    	<?php 
	   if ($espec_aparencia == "S" ) {
		//   print("Checked='checked'  ");
	   }
	   ?>
    value="S" />
      Ok
      <input type="radio" name="espec_aparencia"  value="N"     
	<?php 
	   if ($espec_aparencia == "N" ) {
		  // print("Checked='checked'  ");
	   }
	   ?>
 />
      N&atilde;o</td>
    <td bgcolor="#EEEEEE" >
      Obs:      
      <input type="text" name="obs_aparencia" size="50" maxlength="80" value="<?php //echo($obs_aparencia) ?>" /></td>
   
    </tr>
    <tr>
    <td bgcolor="#EEEEEE" >Ph - Maximo  = 9 (Tixosil)</td>
    <td bgcolor="#FFFFFF" ><input type="radio" name="espec_ph" 
    	<?php 
	   if ($espec_ph == "S" ) {
		  // print("Checked='checked'  ");
	   }
	   ?>
    value="S" />
      Ok
      <input type="radio" name="espec_ph"  value="N"     
	<?php 
	   if ($espec_ph == "N" ) {
		   //print("Checked='checked'  ");
	   }
	   ?>
 />
      N&atilde;o</td>
    <td bgcolor="#EEEEEE" >
      Obs:      
      <input type="text" name="obs_ph" size="50" maxlength="80" value="<?php //echo($obs_ph) ?>" /></td>
   
    </tr -->
  
  <tr>
    <td colspan="4" align="center" bgcolor="#F2F2CC" ><b> Documenta&ccedil;&atilde;o</b></td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Identifica&ccedil;&atilde;o do Funcion&aacute;rio</td>
    <td bgcolor="#FFFFFF" >
    <input type="radio" name="id_func" 
	<?php 
	   if ($id_func == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
	 value='S' />Ok
    <input type="radio" name="id_func" 
    	<?php 
	   if ($id_func == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>

     value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" >Obs
      <input type="text" name="obs_func" size="40" maxlength="40"  value="<?php echo($obs_func) ?>" /></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Documentos fiscais(Quantidade,data de emiss&atilde;o, destinat&aacute;rio, n&uacute;mero de vias)?</td>
    <td bgcolor="#FFFFFF" ><input type="radio" name="docs_fiscais" 
    	<?php 
	   if ($docs_fiscais == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
    value="S" />
      Ok
      <input type="radio" name="docs_fiscais"  value="N"     
	<?php 
	   if ($docs_fiscais == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
 />
      N&atilde;o</td>
    <td bgcolor="#EEEEEE" >
      Obs:      
      <input type="text" name="obs_fiscai" size="50" maxlength="80" value="<?php echo($obs_fiscai) ?>" /></td>
   
    </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Certificado de An&aacute;lise </td>
    <td >
      <input type="radio" name="certif_analise"     	<?php 
	   if ($certif_analise == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
 value="S" />
      Sim
      <input type="radio" name="certif_analise"  value="N" 
      <?php 
	   if ($certif_analise == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
      />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" >Produto Conforme ?
      <select name="especificacao" >
        <?php while($row1=mysql_fetch_assoc($rs111)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $especificacao ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
      </select></td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#F2F2CC" ><b>Transporte / Entrega</b></td>
  </tr>
  <tr>
    <td  bgcolor="#EEEEEE" >Integridade f&iacute;sica do ve&iacute;culo ?</td>
    <td >
      <input type="radio" name="integr_veic" 
	  <?php 
	   if ($integr_veic == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
        value="S" />
      Ok
      <input type="radio" name="integr_veic"  
      	  <?php 
	   if ($integr_veic == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
      value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" ><span style="font-family: Arial, Helvetica, sans-serif; font-weight:">Obs
      <input type="text" name="obs_veic" size="50" maxlength="80" value="<?php echo($obs_veic) ?>"  /></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Ve&iacute;culo est&aacute; limpo ?</td>
    <td >
      <input type="radio" name="limpo" 
      	  <?php 
	   if ($limpo == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
       value="S" />
      Ok
      <input type="radio" name="limpo"  
   	  <?php 
	   if ($limpo == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
      value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" >Obs
      <input type="text" name="obs_limpo" size="50" maxlength="80" value="<?php echo($obs_limpo) ?>" /></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Aus&ecirc;ncia de Vetores e pragas ?</td>
    <td >
      <input type="radio" name="ausenc_vet"   	  <?php 
	   if ($ausenc_vet == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?> value="S" />
      Ok
      <input type="radio" name="ausenc_vet" 
       <?php 
	   if ($ausenc_vet == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
        value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" ><span style="font-family: Arial, Helvetica, sans-serif; font-weight:">Obs
      <input type="text" name="obs_vet" size="50" maxlength="80" value="<?php echo($obs_vet) ?>"/></td>
    </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Apropriado ao tipo de carga ?</td>
    <td >
      <input type="radio" name="aprop_carga"  
	  <?php 
	   if ($aprop_carga == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?> 
       value="S" />
      Ok
      <input type="radio" name="aprop_carga"  
      	  <?php 
	   if ($aprop_carga == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>
      value="N" />
      N&atilde;o </td>
    <td bgcolor="#EEEEEE" >Obs
      <input type="text" name="obs_aprop" size="50" maxlength="80" value="<?php echo($obs_aprop) ?>"/></td>
    </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Prazo de Entrega</td>
    <td bgcolor="#EEEEEE" >
      <select name="pontualidade" >
        <?php while($row1=mysql_fetch_assoc($rs112)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $pontualidade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
    </td>
    </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#F2F2CC"><b>Insumos</b></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#EEEEEE"   size=3 >Integridade do produto(produto e embalagens danificadas, limpeza das embalagens, identifica&ccedil;&atilde;o do r&oacute;tulo) ?
      <select name="integridade">
        <?php while($row1=mysql_fetch_assoc($rs113)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $integridade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
      </select>
      <br />O r&oacute;tulo deve conter nome, composi&ccedil;&atilde;o,data de fabrica&ccedil;&atilde;o, validade e lote</td>
  
  </tr>
  <tr>
    <td bgcolor="#EEEEEE">Quantidade</td>
    <td bgcolor="#EEEEEE">
      <select name="quantidade" >
        <?php while($row1=mysql_fetch_assoc($rs114)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $quantidade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
      </td>
    <td bgcolor="#EEEEEE" colspan="1">
    <!--
    Quando aplic&aacute;vel an&aacute;lises organol&eacute;pticas(aspecto,cor,odor e textura)<br />
      <input type="radio" name="analise" 
      	  <?php 
	   if ($analise == "S" ) {
		//   print("Checked='checked'  ");
	   }
	   ?>  value="S" />
Ok
<input type="radio" name="analise"
  <?php 
	   if ($analise == "N" ) {
		  // print("Checked='checked'  ");
	   }
	   ?>  
       value="N" />
N&atilde;o 
-->
&nbsp;

</td>
  
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" >Observa&ccedil;&otilde;es</td>
    <td colspan="3" bgcolor="#EEEEEE">
      <input type="text" name="obs_analise" size="50" maxlength="80" value="<?php echo($obs_analise) ?>" />
      </td>
  </tr>
  
  <?php
     if ($a == "") { ?>
  <tr>
    <th  colspan="4" align="center">
      <input type="button" name="Submit2" onclick="javascript:novo();" value="Novo" class="search-submit2" />
      <input type="button" name="Submit"  onclick="validaform();" value="Gravar"  class="search-submit2"/>
      <input type="button" name="Submit3"  onclick="excluir();" value="Excluir"  class="search-submit2"/>
      <input type="button" name="Submit4"  onclick="javascript:voltar();" value="Sair" class="search-submit2"/>
    </th>
  </tr>
  
  <?php } ?>
  
   <?php
     if ($a == "") { ?>
  <tr>
    <td colspan="4" align="rigth" bgcolor="#9D9DFF">Produto:
      <label for="descr_prod2"></label>
      <input type="text" name="descr_prod2" id="descr_prod2" maxlenght="50" size=30 /> 
      | Per&iacute;odo 
      <input type="text" name="data_receb2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      a 
      <input type="text" name="data_receb3" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      | Fornecedor :
      <input type="text" name="rz_social2" id="rz_social2" maxlenght="50" size="30" /> 
      | <font size="2" face="Arial, Helvetica, sans-serif">
      <input type="submit" name="Submit5"   value="Filtrar" class="search-submit2" />
      </font></td>
  </tr>
  <?php } ?>
</table>
  <?php
     if ($a == "") { ?>
<table width="100%" border="1" cellspacing="0" align="center"  >
<tr align="center"  bgcolor="#F2F2F2" >
	<td>Fornecedor</td>
	<td>Recebimento</td>
	<td>Pedido</td>
	<td>Nota Fiscal</td>
	<td>Produto</td>
	<td>Lote</td>
    </tr>
     <?php 
	 $bg = 0;
	 while($row=mysql_fetch_array($rs0)){
       if($bg == 1){
		    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>
      
        <th align="left" >
      <a href="dados_entrega.php?id=<?php echo $row['id_avlfornec']?>&P=99"><?php echo $row['rz_social']?></a>
      </th>
      <th>
      <?php echo strftime("%d/%m/%Y", strtotime($row['data_receb']));?>
      </th>
      <th>
      <?php echo $row['pedido']?>
      </th>
      <th>
      <?php echo $row['nfiscal']?>
      </th>
      <th align="left">
      <?php echo $row['descr_prod']?>
      </th>
      <th align="left"><?php echo $row['num_lote']?></th>
    </tr>
<?php
     $a="";
	 }
	 ?>
  </table>
  <?php }
  else {  
  ?>
  
<input type="button" name="fechar" value="Fechar" onclick="javascript:fechar1();">
	  
  <?php }
   ?>
</form>
</body>
</html>