<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$data_p = $_GET ["dtp1"];


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
$lm = 0;

	    // $id_entprodac     = "";
         //$cod_prod         = "";	 
		 $embalagem        = "";
		 $num_lote         = "";
		 $data_fabr        = "";
		 $data_venc        = "";
		 $data_prevlib     = "";
		 $data_liblote     = "";
		 $quant_fabr       = "0.00";
		 
$p1 = '';
$p2 = '';
$p1 = " and a.data_liblote = '". $data_p ."'" ; 

		 

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
$rs2 = mysql_query("select a.* ,DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib,
					DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
					b.descr_prod
					from tb_entprodac a
					 inner join tb_produto b on a.cod_prod = b.cod_prod
					 where a.data_liblote is not null " .$p1. "
					 order by a.id_entprodac desc");				  
 
$b = mysql_num_rows($rs2);
			  	
$habilia = 0;



$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

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
	<title>Matpac221- CONSULTA PRODUTOS LIBERADOS</title>
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


function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="prg" value="matpac201.php">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>Consulta Entrada de Produtos Acabados em - 
        <?php	echo(formata_data($data_p));	  ?>
      </h1></th> 
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="95%" border="0">
      <tr>
        <th colspan="3" align="center"><input type="button" onClick="javascript:self.close();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Produto</th>
                  <th >Lote</th>
                  <th >Fabrica&ccedil;&atilde;o</th>
                  <th >Vencimento</th>
                  <th >Qtd.Frabricada</th>
                  <th >Embalagem</th>
                  <th >Prev.Libera&ccedil;&atilde;o</th>
                  <th >Dt. Libera&ccedil;&atilde;o</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $quant = 0;
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

           <td ><?php echo ($row['descr_prod']);  ?> </td>

           <td  alingn="left"> <?php  echo ($row['num_lote']);?></td>
           <td  align="center"><?php echo ($row['data_fabr']);?></td>
           <td  align="center"><?php echo ($row['data_venc']);?></td>
           <td  align="right"><?php
		         $quant = $quant + $row['quant_fabr'];
		    echo (number_format($row['quant_fabr'],2,',',''));
			?></td>
           <td  align="center"><?php echo ($row['embalagem']);?></td>
           <td  align="center"><?php echo ($row['data_prevlib']);?></td>
           <td  align="center"><?php echo ($row['data_liblote']);?></td>
           </tr>
          <?php 
		   } 
	     }
		  ?>      
          
              <tr>
                <td colspan="4" align="right" >Total de Itens</td>
                <td align="right" > <?php echo(number_format($quant,2,',',''));?></td>
                <td align="center" >&nbsp;</td>
                <td align="left">&nbsp;</td>
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
