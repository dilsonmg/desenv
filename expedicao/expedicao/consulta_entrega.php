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


//header("Content-Type: text/html; charset=ISO-8859-1",true) ;
header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");
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


$p8 = " order by a.data_receb desc ,a.id_avlfornec  desc limit 0,300" ; //";
	  
				  
$rs0 = mysql_query("SELECT distinct a.*,b.rz_social,c.descr_prod
                  FROM tb_avlfornec a
  		          inner join tb_fornecedor b on a.id_fornec = b.id_fornec
				  inner join tb_produto c on a.cod_prod = c.cod_prod
                  where a.id_avlfornec > 0 " . $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p7 . $p8 );
				  				  			  
$rs01 = mysql_query("select a.id_fornec, a.rz_social from tb_fornecedor a order by a.rz_social");		

$rs10 = mysql_query("select a.cod_prod, a.descr_prod from tb_produto a order by a.descr_prod");		

		  
						   
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

 function expand() {  

 for(x = 0; x < 50; x++) {  

 window.moveTo(screen.availWidth * -(x - 1) / 100, screen.availHeight * -(x - 1) / 90);  

 window.resizeTo(screen.availWidth * x / 1, screen.availHeight * x / 1);  
 }
 }
 -->
 </script>


<body>
<link rel="stylesheet" href="../css/qreal.css">
<center>
<table width="98%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center"><img src="../imagens/logoqrred.jpg"  border="0"></td>
<td align="center"><img src="../imagens/tecladoclaro.png" /> <a href="javascript:voltar();"><img src="../images/back_f2.png" width="32" height="32"  border="0"  alt="Voltar ao Menu"/></a></td>
</tr>
</table>
</center>
<form name="form1" method="post"  enctype="multipart/form-data">
<table width="98%" border="1" cellspacing="0"   align="center"  >
  
  <?php
     if ($a == "") { ?>
  
  <?php } ?>
  
   <?php
     if ($a == "") { ?>
  <tr>
    <td  align="rigth" bgcolor="#9D9DFF">Produto:
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
<table width="98%" border="1" cellspacing="0"   align="center"  >
<tr align="center" bgcolor="#3B5998" >
	<td>Fornecedor</td>
	<td>Recebimento</td>
	<td>Pedido</td>
	<td>Nota Fiscal</td>
	<td>Produto</td>
    </tr>
     <?php while($row=mysql_fetch_array($rs0)){ 
   
     if($bg == 1){
		    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>
  
      <td >
      <a onClick="window.open(this.href, this.target, 'width=1200,height=600'); return false;" href="dados_entrega.php?id=<?php echo $row['id_avlfornec']?>&s=0"   target="_blank" ><?php echo $row['rz_social']?></a>

      </td>
      <td >
      <?php echo strftime("%d/%m/%Y", strtotime($row['data_receb']));?>
      </td>
      <td >
      <?php echo $row['pedido']?>
      </td>
      <td >
      <?php echo $row['nfiscal']?>
      </td>
      <td >
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