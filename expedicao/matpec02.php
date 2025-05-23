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
	<title>MATPEc02 - SAIDA DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
    
<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
$p21 = "";

$ord = $_GET ["ord"];
$anp = $_GET ["anp"];
$mp  = $_GET ["mp"];

if($anp != ""){
	$anop = $anp;
}

if($mp != ""){
	$m_primapesq = $mp;
}

if($ltf != ""){
	$lote_fabr2 = $ltf;
}

if (isset($data_1)){
	if ($data_1 <> "" ){
		
		
		 $p3s = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p4s = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 }}


$ordx = " order by a.id_saidmat desc,a.num_lote ";

switch ($ord) {
    case 1:
        $ordx = " order by a.num_lote desc,a.data_saida desc ";
        break;
    case 2:
        $ordx = " order by DATE_FORMAT(data_fab,'%Y/%m/%d') desc,a.data_saida desc ";
        break;
    case 3:
        $ordx = " order by DATE_FORMAT(data_venc,'%Y/%m/%d') desc,a.data_saida desc ";
        break;
    case 4:
        $ordx = " order by a.data_saida desc ";
        break;		
}

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
if(isset($motivo2)){
	if ($motivo2 <> "" ){
			 $p21 = " and a.motivo like '%" . $motivo2 ."%'" ; 
	 }
}

$p1a = '';
if(isset($anop)){
	if ($anop <> "" ){
			 $p1a = " and year(a.data_saida) = '" . $anop ."'" ; 
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
 $fab = "";
 $venc = "";

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){

 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc,c.atv_kamoran
 FROM tb_saidmatp a 
     inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
	  where a.id_saidmat > 0 " . $p2 . $p21 . $p1a . $p3s . $p4s ."
	  group by a.id_saidmat	". $ordx . " LIMIT 400");	
	  
}

$pcd = '';

$lm = "";					
    	
$habilia = 0;
?>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
	
	//alert("Entrou ");
	
	anop    = document.form1.anop.value;
	if (anop == '') {
		alert("Informe o ano a ser pesquisado !");
		document.form1.anop.focus();
		return false;
	}else{	
      document.form1.submit();	
	}
}


function atualiza1(){
	
//	alert(<?php echo($sald_lote);?>);
   document.form2.submit();	
}			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matpe002.php";
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
<input type="hidden" name="sald_lote" value="<?php echo("$sald_lote");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>Sa&iacute;das de Mat&eacute;rias Primas- 
        <?php echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
      
<table  width="99%" >
      <tr>
        <th colspan="3" align="right">&nbsp;</th>
      </tr>

            <tr >
              <th colspan="3" align="center">
                Ano
                  <input type="text" name="anop" id="anop" maxlenght="4" size=10  />
M.Prima
<input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 class="search-input3" /> 
             Lote Fabricado 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="" class="search-input3">
              
  Data Saída
               <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
              Motivo
              <select name="motivo2" class="search-input3" >
                  <option value="" >Selecione o Motivo</option>
                  <option value="1"<?php if($motivo2 == 1 ) {?> selected <?php }?>> Producão </option>
                  <option value="2"<?php if($motivo2 == 2 ) {?> selected <?php }?>> Perda </option>
                  <option value="3"<?php if($motivo2 == 3 ) {?> selected <?php }?>> Outros </option>
                    <option value="4"<?php if($motivo2 == 4 ) {?> selected <?php }?>> Paletizacão </option>
                
                </select>
              <br>
<input type="submit" name="Pesquisar" value="Pesquisar"  class="search-submit2" >
              <input type="button" onClick="sair();" value="Sair"   class="search-submit2" ></th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Mat&eacute;ria Prima</th>
                  <th >% ativo</th>
                  <th ><a href="matpec02.php?ord=1&anp=<?php echo($anop);?>&mp=<?php echo($m_primapesq);?>&ltf=<?php echo($lote_fabr2);?>" title="Ordenar pelo N. Lote ! ">N. Lote</a></th>
                  <th><a href="matpec02.php?ord=2&anp=<?php echo($anop);?>&mp=<?php echo($m_primapesq);?>&ltf=<?php echo($lote_fabr2);?>" title="Ordenar por Dt. Fabr. ! ">Dt. Fab.
                  </a></th>
                  <th><a href="matpec02.php?ord=3&anp=<?php echo($anop);?>&mp=<?php echo($m_primapesq);?>&ltf=<?php echo($lote_fabr2);?>" title="Ordenar por Dt. Venc. ! ">Dt. Venc
                  </a></th>
                  <th><a href="matpec02.php?ord=4&anp=<?php echo($anop);?>&mp=<?php echo($m_primapesq);?>&ltf=<?php echo($lote_fabr2);?>" title="Ordenar por Dt. Saída ! ">Dt. Sa&iacute;da</a></th>
                  <th >Sd. Anterior</th>
                  <th >Quantidade</th>
                  <th >Unidade</th>
                  <th >Saldo Atual</th>
                  <th >Lote Fabricado</th>
                  <th >Motivo</th>
                  <th >Obs</th>
                </tr>
     <?php
//echo($b);
 //if($anop > 0)
 
 if(isset($_POST["Pesquisar"]))  {



       $bg = 0;
	  
	  $nlote = '';
	  $totlote = 0.00;
	  while($row=mysql_fetch_array($rs2)){ 
	  
    	 $msk = "S";
		 if(strtoupper($row['unidade']) != "KG" &&  strtoupper($row['unidade']) != "LT" && strtoupper($row['unidade']) != "GR" ){
						 $msk = "N";
		 }
		 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');
	   
	   if ($nlote != $row['num_lote']){
	       if($nlote != ''){
			   /*
			   echo("<tr><th colspan = 7 align=right>Totais</th>");
			   echo ("<th align='right'>" . number_format($totlote,3,',','.') . "<th></tr>");
			   */
			   $totlote = 0.00;
		   }
		   $nlote = $row['num_lote'];
	  }
	  $totlote = $totlote +  $row['quantid_said'];
	   ?>
       
           <th align="left" >
           <?php echo ($row['cod_prod'] . " - " . $row['descr_prod'] );?></th>
           <th align="right"><?php echo($row['atv_kamoran']);?></th>
           <th align="right"><?php echo ($row['num_lote']);?></th>
           <th align="center" ><?php echo($row['data_fab']);?></th>
           <th align="center" ><?php echo($row['data_venc']);?></th>
           <th align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_saida'])));?></th>
           <th align="right" ><?php
		   if ($msk == "S") {
				      echo (number_format($row['saldo_anterior'],3,',','.'));
				  }else{
				      echo (number_format($row['saldo_anterior'],3,',',''));					  
				  }
		    		  
		   ?></th>
           <th align="right" >
		     <?php
			  $tt_said = $tt_said + $row['quantid_said'];
			  
			  if ($msk == "S") {
				      echo (number_format($row['quantid_said'],3,',','.'));
				  }else{
				      echo (number_format($row['quantid_said'],3,',',''));					  
				  }
		    ?>
           </th>
           <th align="center" ><?php echo ($row['unidade']);?></th>
           <th align="right"><?php 
		     if ($msk == "S") {
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",","."));
				  }else{
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",",""));;					  
				  }
		  // echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",","")); 
		   
		   ?></th>
           <th align="center"><?php echo ($row['lote_fabricado']);?></th>
           <th align="left">
		   <?php 
		   switch ($row['motivo']) {
			case 1:
				echo("Producão");
				break;
			case 2:
				echo("Perda");
				break;
			case 3:
				echo("Outros");
				break;
			case 4:
				echo("Paletizacão");
				break;
			
		  }
		  ?>
           
           
           </th>
           <th align="left"><?php echo ($row['obs']);?></th>
              </tr>
              
          <?php 

		  ?>

		  <?php
		  //////////////////////////////////////////////////////////////////////
		  
		   } 
		   	  /*   
			   echo("<tr><td colspan = 7 align=right>Totais</td>");
			   echo ("<td align='right'>" . number_format($totlote,3,',','.') . "<td></tr>");
              */
		   ?>
           
                 <tr>
                <td colspan="7"  align="right">Total de Sa&iacute;da</td>
                <td align="right" >
                 <?php
			  
			  if ($msk == "S") {
				      echo (number_format($tt_said,3,',','.'));
				  }else{
				      echo (number_format($tt_said,0,'',''));					  
				  }
		    ?>
                </td>
                <td align="center" >&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr> 
           
           <?php
	     }
		  ?>  
          
       
         </table>
              
     
</form> 
</center>
</body>
</html>
