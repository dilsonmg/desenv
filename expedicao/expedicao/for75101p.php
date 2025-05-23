<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";

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

//DATEDIFF(t.data_conserto,CURDATE())

	
	//	  group by a.cod_prod, a.num_lote,a.quantid_said , a.data_saida ,a.lote_fabricado

 $rs32 = mysql_query("select a.* from tb_produto a order by a.descr_prod ");



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
	<title>FOR75101P - Gera Solicitacão de Insumos</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.lote_fabricado.value = '';
   	   	  document.form1.action="for75101p.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}
function gera75101(app){
	
	//1) RECUPERA O VALUE DO ITEM SELECIONADO

var e = document.getElementById("cod_prod");
var itemSel = e.options[e.selectedIndex].value;

//alert(itemSel);

//2) RECUPERA O TEXTO DO ITEM SELECIONADO

//var e = document.getElementById("cod_prod");
//var descritemSel = e.options[e.selectedIndex].text;
	
	var n_lote = document.form1.lote_fabricado.value ;
    if (n_lote == "") {
		alert("Informe o Lote !");
		document.form1.lote_fabricado.focus();
		return false;}
	else{
	
	//alert(document.form1.lote_fabricado.value);
	app1 = app+"?lt="+document.form1.lote_fabricado.value;
	app1 = app1 + "&prd="+itemSel;
	
	newwindow=window.open (app1,'',"toolbar=0,menubar=0,scrollbars=yes,location=0,titlebar=0,resizable=1,width=1110,status=0,height=550"); 
	      //newwindow.moveTo(150,150);
	}
}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>Gerar FOR751-01 - Solicitac&atilde;o de Insumos e Embalagens para Formulac&atilde;o / Produc&atilde;o
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
      <table align="center" width="95%" >
      <tr>
        <th align="right">Produto</th>
        <th align="left"><select id="cod_prod" name="cod_prod" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
            <option value="">Selecione o produto</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">Lote Produzido</th>
        <th align="left"><input type="text" id = "lote_fabricado"  name="lote_fabricado"  maxlength="15" size="12" placeholder="informe o Numero do lote !"  value="<?php echo($lote_fabricado); ?>"></th>
      </tr>
      <tr>
        <th colspan="5" align="center">
          <input type="button" name="gerar"  onClick="javascript:gera75101('for75101online.php');" value="Gerar"  />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" >
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
