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




$p8 = " order by a.data_receb desc ,a.id_avlfornec  desc limit 0,30" ; //";

				  
				  
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
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>SGQ - Check-list para recebimento de Insumos</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>


<script type='text/javascript'>
<!--
function fechar1(){
window.opener = window
 window.close("#")

}
 -->
 </script>

<style type="text/css"></style></head>

<body>

<style type="text/css">

<!--


bordaum {background:#cccccc url(smile.gif);}

bordaum td {background:#f0ffff; border:10px solid #87ceeb;}

table.bordasimples {border-collapse: collapse;}

table.bordasimples tr td {border:1px solid #9D9DFF;font-size: 12px;}

-->

</style>
<form name="form1" method="post"  enctype="multipart/form-data">
<table width="98%" border="1" cellspacing="0"  class="bordasimples" align="center"  background="../imagens/fundoriscadiagonal.gif" >
  <tr>
    <td colspan="9" align="center" bgcolor="#B0B0FF"><img src="../imagens/bannerquimica.jpg" width="775" height="95" /></td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#9D9DFF" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; font-weight: bold;">Recebimento de Insumos</td>
    <td align="center" bgcolor="#9D9DFF" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight:">
      Registro:<?php print($nvid);?>
      <input type="hidden" name="id_avlfornec" value="<?php print($nvid);?>" />
      </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Fonecedor : 
       <select name="id_fornec" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs01)){ ?>
        <option value="<?php print($row1['id_fornec'])?>"
				     <? if($row1['id_fornec'] == $id_fornec ) {?>selected <? } ?>				
				 ><?php print($row1['rz_social'] . " - " .$row1['id_fornec'])?></option>
        <?php }//end if ?>
      </select>
     </td>
    <td width="8%" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Data</td>
    <td width="20%" bgcolor="#CCCCCC"><input type="text" name="data_receb" size="10" maxlength="10" value="<?php echo formata_data($data_receb) ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_receb);"/></td>
    <td width="23%" bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;">Insumo :</span></td>
    <td width="14" colspan="3" bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;"><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="cod_prod" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs10)){ ?>
        <option value="<?php print($row1['cod_prod'])?>"
				     <? if($row1['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row1['cod_prod'] . " - " .$row1['descr_prod'])?></option>
        <?php }//end if ?>
      </select>
    </font></span></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Nota Fiscal :     </td>
    <td bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><input type="text" name="nfiscal" size="30" maxlength="20"  value="<?php echo($nfiscal) ?>"/></td>
    <td bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Pedido      </td>
    <td colspan="5" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><input type="text" name="pedido" size="20" maxlength="15" value="<?php echo($pedido) ?>" /></td>
    </tr>
  <tr>
    <td colspan="9" align="center" bgcolor="#9D9DFF" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Especifica&ccedil;&atilde;o / Documenta&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Identifica&ccedil;&atilde;o do Funcion&aacute;rio</td>
    <td colspan="2" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif;">
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
    <td bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Obs</td>
    <td colspan="3" style="font-family: Arial, Helvetica, sans-serif;">
    <input type="text" name="obs_func" size="40" maxlength="40"  value="<?php echo($obs_func) ?>" /></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Documentos fiscais(Quantidade,data de emiss&atilde;o, destinat&aacute;rio, n&uacute;mero de vias)?</td>
    <td colspan="2" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif;"><input type="radio" name="docs_fiscais" 
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
    <td bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">
      Obs:      </td>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><input type="text" name="obs_fiscai" size="80" maxlength="80" value="<?php echo($obs_fiscai) ?>" /></td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Certificado de An&aacute;lise </td>
    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;">
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
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Produto Conforme ?</td>
    <td style="font-family: Arial, Helvetica, sans-serif;"><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="especificacao" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs111)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $especificacao ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
    </font></td>
  </tr>
  <tr>
    <td colspan="9" align="center" bgcolor="#9D9DFF" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Transporte / Entrega</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Integridade f&iacute;sica do ve&iacute;culo ?</td>
    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif;">
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
      N&atilde;o </span></td>
    <td colspan="2" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif; font-weight:">Obs</span></td>
    <td colspan="2"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="text" name="obs_veic" size="80" maxlength="80" value="<?php echo($obs_veic) ?>"  />
    </span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Ve&iacute;culo est&aacute; limpo ?</td>
    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif;">
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
      N&atilde;o </span></td>
    <td colspan="2" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif; font-weight:">Obs</span></td>
    <td colspan="2"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="text" name="obs_limpo" size="80" maxlength="80" value="<?php echo($obs_limpo) ?>" />
    </span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Aus&ecirc;ncia de Vetores e pragas ?</td>
    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif;">
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
      N&atilde;o </span></td>
    <td colspan="2" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif; font-weight:">Obs</span></td>
    <td colspan="2"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="text" name="obs_vet" size="80" maxlength="80" value="<?php echo($obs_vet) ?>"/>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Apropriado ao tipo de carga ?</td>
    <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif;">
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
      N&atilde;o </span></td>
    <td colspan="2" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><span style="font-family: Arial, Helvetica, sans-serif; ">Obs</span></td>
    <td colspan="2"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="text" name="obs_aprop" size="80" maxlength="80" value="<?php echo($obs_aprop) ?>"/>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Prazo de Entrega</td>
    <td colspan="6" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;"><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="pontualidade" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs112)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $pontualidade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
    </font></td>
    </tr>
  <tr>
    <td colspan="9" align="center" bgcolor="#9D9DFF"><span style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Insumos</span></td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#CCCCCC"  style="font-family: Arial, Helvetica, sans-serif;" size=3 >Integridade do produto(produto e embalagens danificadas, limpeza das embalagens, identifica&ccedil;&atilde;o do r&oacute;tulo) ?<br />      <span style="font-family: Arial, Helvetica, sans-serif;">O r&oacute;tulo deve conter nome, composi&ccedil;&atilde;o,data de fabrica&ccedil;&atilde;o, validade e lote</span></td>
    <td colspan="2" bgcolor="#CCCCCC"  style="font-family: Arial, Helvetica, sans-serif;" size=3 ><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="integridade" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs113)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $integridade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
    </font></td>
  </tr>
  <tr>
    <td width="9%" height="23" bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;">Quantidade</span></td>
    <td width="19%" bgcolor="#CCCCCC"><font size="2" face="Arial, Helvetica, sans-serif">
      <select name="quantidade" style="font-size:12">
        <?php while($row1=mysql_fetch_assoc($rs114)){ ?>
        <option value="<?php print($row1['id_criterio'])?>"
				     <? if($row1['id_criterio'] == $quantidade ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'] . " - " .$row1['id_criterio'])?></option>
        <?php }//end if ?>
        </select>
      </font></td>
    <td colspan="6" bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;">Quando aplic&aacute;vel an&aacute;lises organol&eacute;pticas(aspecto,cor,odor e textura)</span></td>
    <td bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="radio" name="analise" 
      	  <?php 
	   if ($analise == "S" ) {
		   print("Checked='checked'  ");
	   }
	   ?>  value="S" />
      Ok
  <input type="radio" name="analise"
  <?php 
	   if ($analise == "N" ) {
		   print("Checked='checked'  ");
	   }
	   ?>  
       value="N" />
      N&atilde;o </span></td>
  </tr>
  <tr>
    <td height="23" bgcolor="#CCCCCC" style="font-family: Arial, Helvetica, sans-serif;">Observa&ccedil;&otilde;es</td>
    <td colspan="8" bgcolor="#CCCCCC"><span style="font-family: Arial, Helvetica, sans-serif;">
      <input type="text" name="obs_analise" size="80" maxlength="80" value="<?php echo($obs_analise) ?>" />
      </span></td>
  </tr>
  
  <?php
     if ($a == "") { ?>
  <tr>
    <td height="23" colspan="9" align="center" bgcolor="#9D9DFF">
      <input type="button" name="Submit2" onclick="javascript:novo();" value="Novo" />
      <input type="button" name="Submit"  onclick="validaform();" value="Gravar" style="font:color="#006600"-size:8" />
      <input type="button" name="Submit3"  onclick="excluir();" value="Excluir" style="font:color="#006600"-size:8" />
      <input type="button" name="Submit4"  onclick="javascript:voltar();" value="Sair" style="font:color="#006600"-size:8 "/>
    </td>
  </tr>
  
  <?php } ?>
  
   <?php
     if ($a == "") { ?>
  <tr>
    <td height="23" colspan="9" align="rigth" bgcolor="#9D9DFF">Produto:
      <label for="descr_prod2"></label>
      <input type="text" name="descr_prod2" id="descr_prod2" maxlenght="50" size=50 /> 
      | Per&iacute;odo 
      <input type="text" name="data_receb2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      a 
      <input type="text" name="data_receb3" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      | Fornecedor :
      <input type="text" name="rz_social2" id="rz_social2" maxlenght="50" size="50" /> 
      | <font size="2" face="Arial, Helvetica, sans-serif">
      <input type="submit" name="Submit5"   value="Filtrar" style="font:color='#006600'-size:8" />
      </font></td>
  </tr>
  <?php } ?>
</table>
  <?php
     if ($a == "") { ?>
<table width="98%" border="1" cellspacing="0"  class="bordasimples" align="center"  background="../imagens/fundoriscadiagonal.gif" >
<tr align="center" bgcolor="#3B5998" style="color: #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
	<td>Fornecedor</td>
	<td>Recebimento</td>
	<td>Pedido</td>
	<td>Nota Fiscal</td>
	<td>Produto</td>
    </tr>
     <?php while($row=mysql_fetch_array($rs0)){ ?>
   
   <tr>
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <a href="dados_entrega.php?id=<?php echo $row['id_avlfornec']?>&P=99"><?php echo $row['rz_social']?></a>
      </td>
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo strftime("%d/%m/%Y", strtotime($row['data_receb']));?>
      </td>
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo $row['pedido']?>
      </td>
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo $row['nfiscal']?>
      </td>
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo $row['descr_prod']?>
      </td>
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