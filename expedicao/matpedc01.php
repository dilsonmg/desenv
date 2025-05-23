<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();
$data2 = date("Y-m-d");

function formata_data($data)  
 {  
	  if ($data <> ""){
		  //recebe o par?metro e armazena em um array separado por -  
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
		  //recebe o par?metro e armazena em um array separado por -  
		  $data = explode('/', $data);  
		  //armazena na variavel data os valores do vetor data e concatena /  
		  $data = $data[2].'/'.$data[1].'/'.$data[0];  
		  //retorna a string da ordem correta, formatada  
		  }
	  return $data;  
 }  

$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_saida);
$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$lgd = 0;
$opcm = 0;
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

}
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;

$id = $_GET ["id"];

$habilit = "S";
$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";

if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p1 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p2 = " and b.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 
		 
//DATEDIFF(t.data_conserto,CURDATE())
					
					
$rs2 = mysql_query("SELECT a.*,b.descr_prod ,
          DATE_FORMAT(a.data_ped, '%d/%m/%Y') data_ped1, c.nome_cli,c.nm_fantasi,d.nome_usu
          FROM tb_peddia a
		  inner join tb_cliente c on c.codigo_cli = a.codigo_cli
		  inner join tb_usuario d on d.id_usuario = a.id_usuped
          inner join tb_produto b on a.cod_prod = b.cod_prod ".$p1 . $p2 . 
		  " where a.id_peddia > 0  and a.data_ped = '" . $data_ped . "' " .		            
		  " order by a.data_ped desc, a.id_peddia desc");				  
$b=1;
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
<!--[if lt IE 9]>
<script src="//html5shim.googlecod.com/svn/trunk/html5.js">
</script>
<![endif]-->
	<title>MATPEDC01 - LANCAMENTOS DE PEDIDOS</title>
    <link rel="stylesheet" href="../css/qreal.css">

	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
	*/		
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="matpedc01.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

function gravar1(id,linha,acao) {

if (linha == 0) {
	var qtdinf = document.form1.quantid.value;
}else{
	var qtdinf = document.form1.quantid[linha].value;
}
	if(eval( qtdinf < 0)) { alert("A quantidade de Saida e maior que a quantidade disponivel para venda deste lote ou o valor e menor que zero!");
	  return false;
	 }
    
	
	
	document.form1.action='matpedgr1.php?gravar='+acao+'&id='+id+"&quantid="+qtdinf;
	document.form1.submit();  
	return true;
	//
}

</script>
    
</head> 
<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 

<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Consulta Previs&atilde;o  de Sa&iacute;das de Pedidos : <?php echo($hoje); ?></h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      <tr>
        <th colspan="3" align="center"  bgcolor="#8080FF">Filtros de Pesquisa</th>
      </tr>
      <tr>
        <th colspan="3" align="center">Produto
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" ></th>
      </tr>
      <tr>
        <th colspan="4" align="center">
          <input type="submit"  name="gravar"   value="Filtrar" class="search-submit2"  />
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2" >
        </th>
        </tr>
         <tr align="center">
              <td colspan="4" align="center">
              <table width="90%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Codigo</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >N. Lote</th>
                  <th >Qtd. Sa&iacute;da</th>
                  <th >Data</th>
                  <th >N. Pedido</th>
                  <th >Cliente</th>
                  <th >Usu&aacute;rio</th>
                  <th >A&ccedil;&atilde;o</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	 }
	 $pesototal = 0.000;
	 $ttlin = 0;
	 
	  while($row=mysql_fetch_array($rs2)){ 
	      if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
		   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>
                <tr>
                  <td align='center'><?php echo ($row['cod_prod']);?></td>
                <td ><?php echo ($row['descr_prod']);?></td>
                <td  align="right"><?php echo ($row['num_lote']);?></td>
                <td  align="center">
				<input type="text" name="quantid" value="<?php echo (number_format($row['quantid'],0,',','.'));?>" size="10" maxlength="10" style="text-align:right"  >
				</td>
                <td  align="right"><?php echo ($row['data_ped1']);
				?></td>
                <td  align="center"><?php echo ($row['num_pedido']);?></td>
                <td  align="left"><?php echo ($row['nome_cli'] . " - " . $row['nm_fantasi']);?></td>
                <td  align="center"><?php echo ($row['nome_usu']);?></td>
                <td  align="center">
                <a href="javascript:void(0)" onclick="gravar1('<?php echo($row['id_peddia']."','".$ttlin."'") ?>,'r');">Gravar</a>
                | 
                <a href="javascript:void(0)" onclick="gravar1('<?php echo($row['id_peddia']."','".$ttlin."'") ?>,'E');">Excluir</a></td>
                </tr>   

          <?php 
		  $ttlin++;
		}
		
	  ?>      
         </table></td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
