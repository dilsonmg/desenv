<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

   header('Content-type: text/html; charset=UTF-8');
   session_start();
   
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

}



$p1 = "";
$p100 = "";
$p11 = "";
$p200 = "";
$p201 = "";
$p300 = "";
$data_do_dia = date("Y-m-d");
$p2 = "";

$saldo_anterior =0;
$p110 = '';
if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p1 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p2 = " and a.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 


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

//DATEDIFF(t.data_conserto,CURDATE())

$p11 = " and d.data_nf = str_to_date(curdate(),'%Y-%m-%d') ";
$p110 = " and a.tt_lote > 0 "; 


if (isset($data_1)){
	if ($data_1 <> "" ){
//		 $p1 = " and a.data_venc >= '" . formata_data2($data_1) ."'" ; 
		 $p11 = " and d.data_nf = '" . formata_data2($data_1) ."'" ; 
		 $p110 = ""; 
	
	
		 }
	}else {
		 $p11 = " and d.data_nf = '" . date("Y-m-d") . "'";
		 $p110 = " and a.tt_lote > 0 "; 
	}
					
$rs2000a = mysql_query("SELECT a.*,b.id_grpamostra,b.descr_grpam,b.qtd_kits,c.descr_prod,d.quant_disp, e.quant_it,e.unid_amostra FROM tb_compgrp a
						inner join tb_grpamostra b on a.id_grpamostra = b.id_grpamostra
						inner join tb_compgrp e   on a.cod_prod   = e.cod_prod
						inner join tb_itemprocessado d on a.cod_prod = d.cod_prod
						inner join tb_produto c on d.cod_prod = c.cod_prod");
						
						
						
//$row2000a = mysql_fetch_assoc($rs2000a);

$cd_prodini = $row33a['cod_prod'];					
	 

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
	<title>MATPAC006 - SALDO DOS KITS DE AMOSTRAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
		  document.form1.codigo_cli.value = '';
   	   	  document.form1.action="matpac003.php";
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
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" ></th>
           <th  align="center"><h2>Consulta Saldo dos Kits de Amostras-   </h2>
       </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><?php echo($hoje); ?>
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>        </th>
      </tr>
</table>
<table width="95%" border="0">
      
            <tr >
              <th colspan="3" align="center"><input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
            </tr>
            <tr >
           
            </tr>
            <tr align="center">
              <td align="center"><p><h2>Amostras</h2></p></td>
         </tr>
         <tr align="center"> <td  colspan="2">
         
              <table width="60%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th  >Kit Amostra</th>
                  <th  >Padr&atilde;o</th>
                  <th  >Qtd. Kits</th>
                  <th  >Itens do Kit</th>
                  <th  align="right" >Saldo GR</th>
                </tr>
             <?php
			 $idgrp = 0;
			 $mqtd = "N";
         	  while($row=mysql_fetch_array($rs2000a)){ 
			    if ($idgrp !=  $row['id_grpamostra']){
				    echo("<tr><td colspan=4>&nbsp;</td></tr>");
					$mqtd = "S";

				}		
			  ?>
                 <tr bgcolor="#eeeeee">
                    <th align="left"> <?php if ($mqtd == "S") {  echo($row['descr_grpam']); }?></th>
                    <th align="center"><?php echo($row['quant_it'] . " - " . $row['unid_amostra'] ); ?></th>
                    <th align="center">
                    <?php if ($mqtd == "S") { echo(number_format($row['qtd_kits'],0,',','')); } ?></th>
                    <th align="left"> <?php echo("Processado " . $row['descr_prod']); ?></th>
                   <th align="right"> <?php echo($row['quant_disp']); ?></th>
                   
                </tr>
              <?php 
			  //                   <th align="right"> <?php echo(number_format(($row['quant_disp'] /$row['quant_it']),0,',','')); </th>

			      $idgrp =  $row['id_grpamostra'];
				  			 $mqtd = "N";

			  } ?>  
			</table>	          
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
