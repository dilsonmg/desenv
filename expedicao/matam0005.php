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
	    // $id_itproc         = "";
		// $cod_prod         = "";
		 $obs_saida         = "";
		 $num_nf    = "";
		 $data_nf   = "";
		 
$id = $_GET ["id"];
$id1 = $_GET ["id1"];
$id2 = $_GET ["id2"];


$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
   					 
$rs200=mysql_query("SELECT a.*,b.descr_prod,d.num_nf,d.obs_saida, DATE_FORMAT(d.data_nf, '%d/%m/%Y') data_nf,
f.descr_grpam,e.unid_amostra FROM tb_itsaidalt a
inner join tb_itemprocessado a1 on a1.cod_prod = a.cod_prod
inner join tb_produto b on b.cod_prod = a1.cod_prod " . $p1 ."
inner join tb_saidaam d on d.id_saidaam = a.id_saidaam
inner join tb_compgrp e on e.cod_prod  = a.cod_prod
inner join tb_grpamostra f on f.id_grpamostra = e.id_grpamostra
order by d.data_nf desc,d.num_nf desc,a.id_itsaidalt desc, a.num_lote desc");
/*
*/				  		  
 
$fab = "";
$venc = "";
 
$lm = "";					
    	
$habilia = 0;

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
	<title>MATAM005 - Saidas de Kits de Amostras</title>
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
<body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="id2" value="<?php echo("$id2");?>">

<input type="hidden" name="cd_itens" id="cd_itens" value="">
<input type="hidden" name="qtd_itens" id="qtd_itens" value="">
<input type="hidden" name="cd_lotes"  id="cd_lotes" value="">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg"border="0"></th>
        <th align="center"><h1>Consulta Saidas dos Kits de Amostras- </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <?php echo($hoje); ?>
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      <tr>
    </tr>

     <?php
//echo($b);
       $bg = 0;
	  
		  ?>
        <th colspan="3" align="center">Produto
          <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50  />  
          <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">          
          <input type="button" onClick="sair();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr >
              <td colspan="3" align="center" bgcolor="#A6A6FF">Itens dos Kits Enviados</td>
            </tr>
            <tr >
              <th colspan="3" align="center"></h1></th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="70%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th  >NF</th>
                  <th  >Data</th>
                  <th> Grupo </th>
                  <th >Produto</th>
                  <th >N. Lote</th>
                  <th >Cliente</th>
                  <th >Qtd.Amostra</th>
                </tr>
     <?php
//echo($b);
	 
       $bg = 125;
	   $idgrp = 0;
	  while($row=mysql_fetch_array($rs200)){ 
        if ($idgrp !=  $row['num_nf']){
		    echo("<tr><td colspan=8>&nbsp;</td></tr>");
			$mqtd = "S";

				}		
			  
	   echo('<tr bgcolor="#eeeeee">');?>
               
                <td ><?php echo ($row['num_nf']);?></td>
                <td align="center" ><?php echo ( $row['data_nf']);?></td>
                <td align="left"><?php echo ($row['descr_grpam']);?></td>
                <td align="left"><?php echo ($row['descr_prod']);?></td>
                <td align="center"><?php echo ($row['num_lote']);?></td>
                <td align="left"><?php echo ($row['obs_saida']);?></td>
                <td align="right"><?php echo ($row['quant_said']);?></td>
                </tr>
          <?php 
		 //  $bg = $row['num_nf'];
		      $idgrp =  $row['num_nf'];
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
