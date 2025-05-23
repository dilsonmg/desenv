<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$p1 = "";
$p100 = "";
$p101 = "";
$p200 = "";
$p201 = "";
$p300 = "";

$p2 = "";


if (isset($ano_2)){
	if ($ano_2 <> "" ){
		 $p1 = " and year(a.data_liblote) = '" . $ano_2 ."'" ; 
	 }
	 
	 //echo($ano_2);
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



$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;


$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
	
/*
$rs2 = mysql_query("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
      FROM tb_saidaprodac a
	   where a.id_saidaprodac > 0 " . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
	 order by  a.data_nf desc, CAST(num_nf AS DECIMAL) desc limit 650");		 		  
*/

$rs2 = mysql_query("SELECT year(a.data_liblote) ano_fab, a.cod_prod, b.descr_prod, count(a.cod_prod) num_produz
					FROM tb_entprodac a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					where data_liblote is not null " . $p1 . "
					group by year(a.data_liblote), a.cod_prod
					order by year(a.data_liblote) desc, num_produz desc");

/*
$rs2 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,d.rz_social
      FROM tb_saidaprodac a
      inner join tb_produto b on b.cod_prod = a.cod_prod " . $p1 . "
	  inner join tb_cliente c on c.codigo_cli = a.codigo_cli " . $p200 . "
	  inner join tb_fornecedor d on d.cod_fornec = a.cod_fornec " . $p300 .
	  " where a.id_saidaprodac > 0 " . $p2 .$p100 .$p101 . $p201 . $p400 . "	
	 order by  a.data_nf desc, CAST(num_nf AS DECIMAL) desc limit 650");		 		  

*/ 
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
	<title>MATPAC004L - CONSULTA TOTAIS DE LOTES PRODUZIDOS POR ANO</title>
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
   	   	  document.form1.action="matpac004l.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

  function sair2()
  {	      // document.location.href='excluieq.asp'
			document.form1.action="menu_prevprod.php";
			document.form1.submit();  
			return true;
  
  }

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Consulta Totais de Lotes Produzidos por Ano- 
        <?php
	echo($ano_2);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        <br> <?php echo($hoje);?>
        </th>
      </tr>
    </table>
      <table width="99%" border="0">

      
            <tr >
              <th  align="center">
              Ano
                  <input type="text" name="ano_2" id="ano_2" maxlenght="4" size=10 /> 
              <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>
            <tr align="center">
              <td  align="center">
              <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Ano</th>
                  <th >Produto</th>
                  <th>Total de Lotes</th>
                
                </tr>
     <?php
//echo($b);

	  while($row=mysql_fetch_array($rs2)){ 
  	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

             
               <td align="center"> <?php echo ($row['ano_fab']);?>  </td>
               <td align="left"> <?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
               <td align="center" ><?php echo($row['num_produz']);?></td>
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
