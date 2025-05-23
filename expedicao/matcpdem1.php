<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
	 }
}

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
	     $id_saidmat       = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $data_saida       = "";
		 $quantid_said    = "";
		 $lote_fabricado   = "";
          $unidade         = "";
$id = $_GET ["id"];

$habilit = "S";


//DATEDIFF(t.data_conserto,CURDATE())
					   
 $fab = "";
 $venc = "";
 
$lm = "";					
$p01 = "";
$p1 = "";
$p2 = "";
$p1a = "";
$p1b = "";


if(isset($lt_fabr2)){
	$p01 = " and a.num_lote like '%" . $lt_fabr2 ."%'";
	
}

if(isset($pa_pesq)){
	$p2 = " and b.descr_prod like '%" . $pa_pesq ."%'";
	
}

if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p1a = " and a.data_descart >= '" . formata_data2($data_1) ."'" ; 
	}
}
					
//			and d.data_nf = str_to_date(curdate(),'%Y-%m-%d')
$p11b = "";
if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p1b = " and a.data_descart <= '" . formata_data2($data_2) ."'" ; 	
		 }
}
    	
$habilia = 0;


if($cod_prod == ""){$p1 = "";}

 $rs2 = mysql_query("select a.*,b.descr_prod
					,DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
					 DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
					 DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
					 DATE_FORMAT(a.venci_retencao, '%d/%m/%Y') venci_retencao1
					from tb_contraprovm a
					inner join tb_produto b on a.cod_prod = b.cod_prod " . $p2 . 
					"where a.id_contraprovm > 0 " . $p1 . $p01 . $p1a . $p1b ."  and a.situacao = 'D' order by a.data_descart desc");				  
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
	<title>MATCPDEM1 - CONSULTA de DESCARTADOS - CONTRAPROVA Materia Prima</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
//if (window.opener && !window.opener.closed) {
//			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formul�rio  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matcp001.php";
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
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>Consulta Descartados - Contraprova - Materia Prima- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
      <table width="95%" border="0">
      <tr>
        <th colspan="3" align="center"><input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="3" align="center"  bgcolor="#8080FF">Registros Arquivados</th>
            </tr>
            <tr >
              <th colspan="3" align="center">M.P
                <input type="text" name="pa_pesq" id="pa_pesq" maxlenght="50" size=50 /> 
              </h1>Lote M.P 
              <input type="text" id = "lt_fabr2"  name="lt_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="">
              Periodo
              <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/><input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Materia Prima</th>
                  <th >N. Lote</th>
                  <th>Fabricacao</th>
                  <th>Vencimento</th>
                  <th>Venc. Retencao</th>
                  <th >Observacao</th>
                  <th >Descarte</th>
                  <th >Situacao</th>
                  <th >Quantidade</th>
                  <th >Unidade</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td >
         <?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
     
           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo($row['data_fabr1']);?></td>
           <td align="center" ><?php echo($row['data_venc1']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['venci_retencao'])));?></td>
           <td align="left" ><?php echo ($row['observ']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_descart'])));?></td>
           <td align="center" >Descartado</td>
           <td align="center"><?php echo (number_format($row['quantidade'],3,",","")); ?></td>
           <td align="center"><?php echo ($row['unidade']);?></td>
           </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
