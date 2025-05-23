    <link rel="stylesheet" href="../css/qreal.css">

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
$p61 = "";

$p7 = "";
$p8 = "";
$tt_rec = 0;
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
if (isset($id_fornec)){
	if ($id_fornec <> "" ){
		 $p4 = " and a.id_fornec = '" . $id_fornec ."'" ; 
		 }}
if (isset($pedido2)){
	if ($pedido2 <> "" ){
		 $p5 = " and a.pedido = '" . $pedido2 ."'" ; 
		 }}
if (isset($nfiscal2)){
	if ($nfiscal2 <> "" ){
		 $p6 = " and a.nfiscal = '" . $nfiscal2 ."'" ; 
		 }}
		 
if (isset($lote_a)){
	if ($lote_a <> "" ){
		 $p61 = " and a.num_lote like '%" . $lote_a ."%'" ; 
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
                  where a.id_avlfornec > 0 " . $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p61 . $p7 . $p8 );
				  				  			  
$rs01 = mysql_query("select a.id_fornec, a.rz_social from tb_fornecedor a 
                     inner join tb_avlfornec b on a.id_fornec = b.id_fornec 
                     group by b.id_fornec order by a.rz_social");		

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

<!DOCTYPE html>
<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
<center>
<table width="99%" border="0" >
<tr>
<th align="left"><img src="../imagens/logoqrred.jpg"  border="0"></th>
<th align="center"><h3>Consulta Recebimentos por Fornecedor</h3></th>
<th align="right"><img src="../imagens/tecladoclaro.png" /><a href="javascript:voltar();">
<img src="../images/back_f2.png"  border="0"  alt="Voltar ao Menu"/></a></th>
</tr>
</table>

<form name="form1" method="post"  enctype="multipart/form-data">
<table width="98%" border="0" style="border:#0F9"  >
  
  
   <?php
     if ($a == "") { ?>
  <tr>
    <th  align="rigth" bgcolor="#9D9DFF"> Fornecedor 
      <select name="id_fornec" style="font-size:12">
             <option value=''>Selecione o fornecedor</option>
        <?php while($row1=mysql_fetch_assoc($rs01)){ ?>
        <option value="<?php print($row1['id_fornec'])?>"
				     <? if($row1['id_fornec'] == $id_fornec ) {?>selected <? } ?>				
				 ><?php print($row1['rz_social'] . " - " .$row1['id_fornec'])?></option>
        <?php }//end if ?>
      </select>
      Produto:
<label for="descr_prod2"></label>
      <input type="text" name="descr_prod2" id="descr_prod2" maxlenght="50" size=20 /> 
      | Per&iacute;odo 
      <input type="text" name="data_receb2" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      a 
      <input type="text" name="data_receb3" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_receb);"/> 
      |Lote 
      <input type="text" name="lote_a" id="lote_a" maxlenght="50" size="20" />
      <font size="2" face="Arial, Helvetica, sans-serif">
      <input type="submit" name="Submit5"   value="Filtrar" style="font:color='#006600'-size:8" />
      </font></th>
  </tr>
  <?php } ?>
</table>
  <?php
     if ($a == "") { ?>
<table width="98%" border="1"  >
<tr align="center" bgcolor="#C6C6FF" >
	<th>Fornecedor</th>
	<th>Data Recebimento</th>
	<th>N&ordm; Pedido</th>
	<th>Nota Fiscal</th>
	<th>Lote</th>
	<th>Produto</th>
    </tr>
     <?php while($row=mysql_fetch_array($rs0)){ 
     $tt_rec ++;
     if($bg == 1){
		    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>
  
      
        <td align="left" >
      <a onClick="window.open(this.href, this.target, 'width=1200,height=600'); return false;" href="dados_entrega.php?id=<?php echo $row['id_avlfornec']?>&s=0"   target="_blank" ><?php echo $row['rz_social']?></a>

      </td>
      <td align="center" >
      <?php echo strftime("%d/%m/%Y", strtotime($row['data_receb']));?>
      </td>
      <td align="right" >
      <?php echo $row['pedido']?>
      </td>
      <td align="right" >
      <?php echo $row['nfiscal']?>
      </td>
      <td align="right" ><?php echo $row['num_lote']?></td>
      <td align="left" >
      <?php echo $row['descr_prod']?>
      </td>
  </tr>   
  <?php
     $a="";
	 }
	 ?>
 <tr>
        <th colspan="6"  align="center">Total de Recebimentos.....: <?php echo ($tt_rec);?></th>
      </tr>
   
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
