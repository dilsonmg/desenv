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

if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p1 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p2 = " and a.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 
		 
//DATEDIFF(t.data_conserto,CURDATE())
					
$rs2 = mysql_query("SELECT a.* FROM tv_saldomprima a where a.tt_lote > 0 " . $p1 . $p2);				  


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
	<title>MATPCV002 - SALDO DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="matpcv002.php";
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
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center">
          <input type="submit"  name="gravar"   value="Filtrar" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="3" align="center"><h1>Saldo de Mat&eacute;rias Primas em : <?php echo($hoje); ?></h1> </th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Codigo</th>
                  <th >Descricao</th>
                  <th >Saldo em KG</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	 }
	 $pesototal = 0.000;
	  while($row=mysql_fetch_array($rs2)){ 
	      if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
		   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>
                <td align='center'><?php echo ($row['cod_prod']);?></td>
                <td ><?php echo ($row['descr_prod']);?></td>
                <td  align="right"><?php echo (number_format($row['tt_lote'],3,',','.'));
				$pesototal = $pesototal + $row['tt_lote'];
				?></td>
            </tr>   

          <?php 
		}
		
	  ?>
       <tr>
                  <td colspan="2" align='center'>Peso Total ===============&gt;&gt;&gt;</td>
                  <td  align="right"><?php echo (number_format($pesototal,3,',','.'));?></td>
                </tr>      
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
