<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

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
	     $id_entmatp       = "";
         $data_entrada     = "";	 
		 $cod_fornec       = "";
		 $cod_prod         = "";
		 $unidade          = "";
		 $num_nf           = "";
		 $data_nf          = "";
		 $num_lote         = "";
		 $data_fab         = "";
		 $data_venc        = "";
		 $quantid_ent      = "0.00";

$id = $_GET ["id"];

$habilit = "S";

if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.num_lote ='" . $lote_fabr2 ."'" ; 
	 }
}


if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p3 = " and a.data_nf >= '" . formata_data2($data_1) ."'" ; 
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p4 = " and a.data_nf <= '" . formata_data2($data_2) ."'" ; 
		 }}
if (isset($num_nfp)){
	if ($num_nfp <> "" ){
		 $p5 = " and a.num_nf = '" . $num_nfp ."'" ; 
		 }}
if (isset($motivo_ent1)){
	if ($motivo_ent1 <> "" ){
		 $p51 = " and a.motivo_ent = '" . $motivo_ent1 ."'" ; 
		 }}



//DATEDIFF(t.data_conserto,CURDATE())
$rs2 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
DATE_FORMAT(a.data_entrada, '%d/%m/%Y') data_entrada1,
DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,year(a.data_venc) ano_venc,
DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,b.cod_prod,c.cod_fornec,c.rz_social
from tb_entmatp a
 inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
 inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
 where a.id_entmatp > 0 " . $p2. $p3. $p4 .$p5 .$p51 . "
  order by a.id_entmatp desc limit 200");				  
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("select a.* from tb_produto a order by a.descr_prod");				  	
$rs34 = mysql_query("select a.* from tb_fornecedor a  group by a.rz_social order by a.rz_social");				  	
$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_entmatp a where a.id_entmatp =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         $rs1 = mysql_query("SELECT a.* FROM tb_entmatp a where a.id_entmatp =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_entrada    = strftime("%d/%m/%Y", strtotime($row1['data_entrada']));
	     $data_fab        = strftime("%d/%m/%Y", strtotime($row1['data_fab']));
	     $data_venc       = strftime("%d/%m/%Y", strtotime($row1['data_venc']));
	     $data_nf         = strftime("%d/%m/%Y", strtotime($row1['data_nf']));
		 
		 $id_entmatp       = $id;
		 $cod_fornec       = $row1['cod_fornec'];
		 $cod_prod         = $row1['cod_prod'];
		 $unidade          = $row1['unidade'];
		 $num_nf           = $row1['num_nf'];
		 $num_lote         = $row1['num_lote'];
		 $quantid_ent      = $row1['quantid_ent'];

	  }
	 
 }
//SELECT a.id_eqpto, a.dt_garantiafab ,ADDDATE(a.dt_garantiafab,INTERVAL 3 year) nvdata FROM tb_equipamento a;
//


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

// Comparando as Datas
/*

/// Diferenca em dias de uma data para a data atual.
SELECT t.*,DATEDIFF(t.data_conserto,CURDATE()) FROM tb_mvtoeq t;
/////////////////////////////////////////////////////////////////

if(strtotime($data1) > strtotime($data2))
{
echo 'A data 1 ? maior que a data 2.';
}
elseif(strtotime($data1) == strtotime($data2))
{
echo 'A data 1 ? igual a data 2.';
}
else
{
echo 'A data 1 ? menor a data 2.'.strtotime($data1);
}


*/

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
	<title>MATPE001 - ENTRADAS DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>  
/*  
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
	*/		
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
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

<table width="100%" border="0">
      <tr>
        <th  align="left"><img src="../imagens/logoqrred.jpg" ></th>
        <th ><h1>Consulta Entradas de Mat&eacute;rias Primas-
        <?php
	echo($_SESSION['id_entmatp']);
		  ?> </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        
        </th>
      </tr>
      <tr>
        <th colspan="3" align="center"  bgcolor="#8080FF">Dados do Lote</th>
      </tr>
   <tr >
              <th colspan="4" align="center">
                M.Prima
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=20 /> 
              </h1>Num. NF
              <input type="text" id = "num_nfp"  name="num_nfp"  maxlength="45" size="10" placeholder="informe a NF !"  value="">
              Lote  
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="22" placeholder="informe o lote !"  value="">
               Data NF de
               <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
Motivo Entrada
           <select name="motivo_ent1" >
          <option value="" >Selecione o Motivo</option>
          <option value="1"<?php if($motivo_ent1 == 1 ) {?> selected <?php }?>> Compra </option>
		  <option value="2"<?php if($motivo_ent1 == 2 ) {?> selected <?php }?>> Devolução </option>
		  <option value="3"<?php if($motivo_ent1 == 3 ) {?> selected <?php }?>> Bonificação </option>
        </select>

<input name="Pesquisar" type="submit" value="Pesquisar">
              <input type="button" onClick="sair();" value="Sair"></th>
            </tr>
           
            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Data Entrada</th>
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Fabricante</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Obs.Fab</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="3"  bgcolor="#009999">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#00FF66">Lote / Partida</th>
                  <th>Especificacao</th>
                  <th>&nbsp;</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >Quantidade</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                  <th>&nbsp;</th>
                  <th>Motivo</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $tot_ent = 0;
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td ><?php echo($row['data_entrada1']);?></td>
                <td >
           <a href="#?id=<?php echo ($row['id_entmatp']);?>"><?php echo ($row['rz_social']);?></a></td>
                <td ><?php echo ($row['nm_fabric']);?></td>

           <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
           <td  align="left"><?php echo ($row['msg_lote'] . " - " . $row['descr_prod']);?></td>
           <td  align="center"><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo ($row['data_nff']);?></td>
           <td align="right" ><?php
		      $tot_ent = $tot_ent + $row['quantid_ent']; 
		    echo ($row['quantid_ent']);?></td>
           <td align="center"><?php echo ($row['num_lote']);?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));
		  
		   ?></td>
           <td align="center"><?php 
		     if($row['ano_venc'] == 0 || $row['ano_venc'] == ''){
			   echo("<b><font color='#0000FF'> Indeterminado </font></b>"); } 
		   else{
		   		echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   		if(strtotime($row['data_venc']) < strtotime($data2)){
                	echo ('<b><font color="#FF0000"> - Vencido a ' . $row['dias_avencer'].' dias </font>');}
          		else {
			    	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>'); 
		  		}
		   }
		   ?></td>
           <td align="center"><?php echo ($row['atv_kamoran']); 
		   		   
		   ?></td>
           <td align="left">
            <?php 
		   switch ($row['motivo_ent']) {
			case 1:
				echo("Compra");
				break;
			case 2:
				echo("Devolucão");
				break;
			case 3:
				echo("Bonificacão");
				break;
		  }
		  ?>
           
           </td>
              </tr>
       
          <?php 
		   } 
	     }
		     ?>  
              <tr>
                <td colspan="8" align="right" >Total de Entradas:</td>
                <td align="right" ><?php echo(number_format($tot_ent,3,'.',''));?></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
		       
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
