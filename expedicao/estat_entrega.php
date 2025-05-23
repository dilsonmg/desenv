<link rel="stylesheet" href="../css/qreal.css">
<?php
session_start();

$lgd = 0;
$opcm = 0;
$bg = 1;

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

$rs01 = mysql_query("select a.id_fornec, a.rz_social from tb_fornecedor a 
                     inner join tb_avlfornec b on a.id_fornec = b.id_fornec 
                     group by b.id_fornec order by a.rz_social");		


$p4 = "";

if (isset($id_fornec)){
	if ($id_fornec <> "" ){
		 $p4 = " and a.id_fornec = '" . $id_fornec ."'" ; 
		 }}  
				  
$rs0 = mysql_query(" SELECT a.id_fornec, b.rz_social,
                   sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) pontuacao, 20 totmax,
                   (((sum(a.especificacao + a.pontualidade+a.integridade+a.quantidade) / 20)* 100) / count(a.id_fornec))
				    percreceb,
                   count(a.id_fornec) tt_receb
                   FROM tb_avlfornec a
                   inner join tb_fornecedor b on a.id_fornec = b.id_fornec
				   where a.id_fornec > 0 " . $p4 . "
                   group by a.id_fornec
                   order by tt_receb desc,percreceb desc,a.data_receb desc" );


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>SGQ - Check-list para recebimento de Insumos</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>

<body>


<center>
<table width="99%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="left"><img src="../imagens/logoqrred.jpg"  border="0"></td>
<td align="center"><h2>Avalia&ccedil;&atilde;o de Recebimentos</h2></td>
<td align="right"><img src="../imagens/tecladoclaro.png" /> 
<a href="javascript:voltar();"><img src="../images/back_f2.png"   border="0"  alt="Voltar ao Menu"/></a></td>
</tr>
</table>

</center>
<form name="form1" method="post"  enctype="multipart/form-data">
  <table width="95%" border="1" cellspacing="0"   align="center" >

  <tr align="left" >
    <th colspan="4" >Fornecedor
      <select name="id_fornec" style="font-size:12">
        <option value="">Selecione o Fornecedor </option>
        <?php while($row1=mysql_fetch_assoc($rs01)){ ?>
        <option value="<?php print($row1['id_fornec'])?>"
				     <? if($row1['id_fornec'] == $id_fornec ) {?>selected <? } ?>				
				 ><?php print($row1['rz_social'] . " - " .$row1['id_fornec'])?></option>
        <?php }//end if ?>
      </select> <font size="2" face="Arial, Helvetica, sans-serif">
      <input type="submit" name="Submit5"   value="Filtrar" style="font:color='#006600'-size:8" />
      </font></th>
  </tr>
  <tr align="center" bgcolor="#CECEFF" >
	<td >Fornecedor</td>
	<td >Pontua&ccedil;&atilde;o</td>
	<td >Recebimentos</td>
	<td >% Avalia&ccedil;&atilde;o</td>
	</tr>
     <?php while($row=mysql_fetch_array($rs0)){ 
   
  
     if($bg == 1){
		    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>  	   
               
      <td style="font-family: Arial, Helvetica, sans-serif;">
      <a   href="fornec_entrega.php?id_fornec=<?php echo $row['id_fornec']?>"   target="_top" ><?php echo $row['rz_social']?></a>
      </td>
      <td align="right" style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo($row['pontuacao']);?>
      </td>
      <td align="right" style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo $row['tt_receb']?>
      </td>
      <td align="right" style="font-family: Arial, Helvetica, sans-serif;">
      <?php echo(number_format($row['percreceb'],2,",",".")) ;?>%
         
      </td>
    </tr>
<?php

	 }
	 ?>
</table>

</form>
</body>
</html>