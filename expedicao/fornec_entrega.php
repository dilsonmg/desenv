<?php
session_start();
$bg = 0;
$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("Você não esta logado !!");
              	header("Location: login.php"); 

}
$tt_fornec = 0;

header("Content-Type: text/html; charset=UTF-8",true);
include 'conectabco.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");
$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p5 = "";
$p6 = "";
$p7 = "";
$p8 = "";
$id_fornec = $_GET ["id_fornec"];

		 $p1 = " and b.id_fornec = " . $id_fornec  ; 

$p8 = " order by a.data_receb desc ,a.id_avlfornec  desc limit 0,30" ; //";
				  
$rs0 = mysql_query("SELECT distinct a.*,b.rz_social,c.descr_prod,
                 (a.especificacao + a.pontualidade + a.integridade + a.quantidade) as ponto_fornec
                  FROM tb_avlfornec a
  		          inner join tb_fornecedor b on a.id_fornec = b.id_fornec
				  inner join tb_produto c on a.cod_prod = c.cod_prod
                  where a.id_avlfornec > 0 " . $p1 . $p8 );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>SGQ - Check-list para recebimento de Insumos</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>

<script language="javascript">

 function expand() {  

 for(x = 0; x < 50; x++) {  

 window.moveTo(screen.availWidth * -(x - 1) / 100, screen.availHeight * -(x - 1) / 90);  

 window.resizeTo(screen.availWidth * x / 1, screen.availHeight * x / 1);  
 }
 }
 
 </script>

<link rel="stylesheet" href="../css/qreal.css">
</head>
<body>

<form name="form1" method="post"  enctype="multipart/form-data">

<center>
<table width="98%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="left"><img src="../imagens/logoqrred.jpg"  border="0"></td>
<td align="right"><img src="../imagens/tecladoclaro.png" /> <a href="javascript:voltar();">
<img src="../images/back_f2.png" width="32" height="32"  border="0"  alt="Voltar ao Menu"/></a></td>
</tr>
</table>

</center>

<table width="98%" border="1" cellspacing="0"   align="center"  >
<tr align="center"  >
  <td colspan="6"  bgcolor="#9D9DFF" >Recebimentos por Fornecedor</td>
  </tr>
<tr align="center" bgcolor="#CCCCCC" >
	<td >Fornecedor</td>
	<td>Pontuação</td>
	<td >Recebimento</td>
	<td >Pedido</td>
	<td >Nota Fiscal</td>
	<td >Produto</td>
    </tr>
     <?php while($row=mysql_fetch_array($rs0)){ 
	 $tt_fornec ++;
	     if($bg == 1){
		    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?> 
  
        <th >
      <a onClick="window.open(this.href, this.target, 'width=1200,height=600'); return false;" href="dados_entrega.php?id=<?php echo $row['id_avlfornec']?>&s=0"   target="_blank" ><?php echo $row['rz_social']?></a>
      </th>
        <th align="center" ><?php echo $row['ponto_fornec']?></th>
      <th align="center" >
      <?php echo strftime("%d/%m/%Y", strtotime($row['data_receb']));?>
      </th>
      <th align="center" >
      <?php echo $row['pedido']?>
      </th>
      <th align="center" >
      <?php echo $row['nfiscal']?>
      </th>
      <th >
      <?php echo $row['descr_prod']?>
      </th>
  </tr>     
<?php
	 }
	 ?>
        <tr>
          <th colspan="6" >Total de recebimentos .......:<?php echo($tt_fornec);?></th>
        </tr>
  </table>

</form>
</body>
</html>
