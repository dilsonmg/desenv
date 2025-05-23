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

if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p1 = " and a.data_venc >= '" . formata_data2($data_1) ."'" ; 
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p2 = " and a.data_venc <= '" . formata_data2($data_2) ."'" ; 
		 }}
if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p3 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p4 = " and b.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 
		 
//DATEDIFF(t.data_conserto,CURDATE())
					
					
					
$rs2 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
                    DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
                    DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,c.cod_fornec,c.rz_social,
                    d.tt_entradalote,d.tt_saidalote,d.sald_lote,
                    if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote
                    from tb_entmatp a  
                    inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . "
                    inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
                    inner join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
					 where a.id_entmatp > 0 " .$p1 . $p2 . $p3 . "
					 group by a.cod_prod, a.num_lote
                    order by a.cod_prod asc");				  
    $b = mysql_num_rows($rs2);

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
	<title>MATPCV001 - CONSULTA VENCIMENTOS DE MATERIAS PRIMAS</title>
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
   	   	  document.form1.action="matpe001.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body> 
<center>

<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="2" align="center"  bgcolor="#8080FF">Filtros de Pesquisa</th>
      </tr>
      <tr>
        <th colspan="2" align="center">M. Prima
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" >
          Vencimento de
          <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/></th>
      </tr>
      <tr>
        <th colspan="3" align="center">
          <input type="submit"  name="gravar"   value="Filtrar" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="3" align="center"><h1>Vencimentos de Mat&eacute;rias Primas em : <?php echo($hoje); ?></h1></th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="3"  bgcolor="#009999">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#00FF66">Lote / Partida</th>
                  <th>Especificacao</th>
                  <th>Saldo KG</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >Quantidade</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $tt_soma = 0;
	  while($row=mysql_fetch_array($rs2)){ 
	  
	  if($row['tt_lote'] > 0 ){
	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td >
           <a href="matpe001.php?id=<?php echo ($row['id_entmatp']);?>"><?php echo ($row['rz_social']);?></a></td>

           <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
           <td  align="center"><?php echo ($row['unidade']);?></td>
           <td align="center" >		   
		   <?php 
		       $cdprod = $row['cod_prod'];
			   $cdlote = $row['num_lote'];
		   //echo ($row['num_nf']);
		   $rs2000 = mysql_query("select a.cod_prod,a.num_lote,a.num_nf,a.data_nf from tb_entmatp a
                               where a.cod_prod = '" . $cdprod .  "' and a.num_lote = '" .$cdlote . "' order by a.cod_prod,a.num_lote ");
	  	  while($row2000=mysql_fetch_array($rs2000)){ 
               echo($row2000['num_nf'] . "<br>");
		  }
		   ?></td>
           <td align="center" ><?php echo ($row['data_nff']);?></td>
           <td align="center" ><?php echo ($row['quantid_ent']);?></td>
           <td align="center"><?php echo ($row['num_lote']);?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));
		  
		   ?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   if(strtotime($row['data_venc']) < strtotime($data2)){
                echo ('<b><font color="#FF0000"> - Vencido a ' . $row['dias_avencer'].' dias </font>');}
          else {
			    echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>'); 
		  }
		   ?></td>
           <td align="center"><?php echo ($row['atv_kamoran']); 
		   		   
		   ?></td>
           <td align="right"><?php echo ($row['tt_lote']); 
		   		   $tt_soma = $tt_soma + $row['tt_lote']; 
		   ?></td>
              </tr>
          <?php 
		   } 
	      }
	     }
		  ?>     
               <tr>
                <td colspan="9" >&nbsp;</td>
                <td align="center">Total</td>
                <td align="right"><?php echo ($tt_soma);?></td>
              </tr>
 
         </table>
              
         </td>
         </tr>
           
    </table>     
    
</form> 
</center>
</body>
</html>
