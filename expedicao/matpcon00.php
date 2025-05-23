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
		 $p1 = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p2 = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 }}
if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p3 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p4 = " and b.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 
		 
//DATEDIFF(t.data_conserto,CURDATE())
					
$rs2 = mysql_query("SELECT a.cod_prod, b.descr_prod ,avg(a.quantid_said) med_cons,count(a.cod_prod) tt_saida, sum(a.quantid_said) tt_cons FROM 				 					tb_saidmatp a
					inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . "
					where a.id_saidmat > 0 " .$p1 . $p2 . $p3 . "  and a.cod_prod not in (100010,100011,100012) 
					group by a.cod_prod
					order by b.descr_prod");		
					
							  
    $ttb = mysql_num_rows($rs2);

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
	<title>MATPCON00 - CONSULTA CONSUMO MEDIO DE MATERIAS PRIMAS</title>
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

<table width="85%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Consumo M&eacute;dio de Mat&eacute;rias Primas de : <?php echo($data_1 . " a " . $data_2); ?></h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center"  bgcolor="#8080FF">Filtros de Pesquisa</th>
      </tr>
      <tr>
        <th colspan="3" align="center">M. Prima
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" >
          Per&iacute;odo de
          <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/></th>
      </tr>
      <tr>
        <th colspan="4" align="center">
          <input type="submit"  name="gravar"   value="Filtrar" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
      
            <tr align="center">
              <td colspan="4" align="center">
              <table width="75%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Materia Prima</th>
                  <th >Consumo Medio Kg</th>
                  <th >Saidas</th>
                  <th >Total Consumido Kg</th>
                </tr>
     <?php
//echo($b);
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
	  
	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

                <td >
           <a href="matpcon00.php?id=<?php echo ($row['id_entmatp']);?>"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>

           <td align="right" ><?php echo (number_format($row['med_cons'],3,",","."));?></td>
           <td  align="right"><?php echo ($row['tt_saida']);?></td>
           <td  align="right"><?php echo (number_format($row['tt_cons'],3,",","."));?></td>
           </tr>
          <?php 
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
