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

include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 

$p1 = "";
$p2 = "";
$p21 = "";

$ord = $_GET ["ord"];
$anp = $_GET ["anp"];
$mp  = $_GET ["mp"];

if($anp != ""){
	$anop = $anp;
}

$p1 = "";

if (isset($cod_prodp)){
	if ($cod_prodp <> "" ){
		 $p1 = " and a.cod_prod = '" . $cod_prodp ."'" ; 
	 }
}


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
if(isset($motivo2)){
	if ($motivo2 <> "" ){
			 $p21 = " and a.motivo like '%" . $motivo2 ."%'" ; 
	 }
}

$p1a = '';
if(isset($anop)){
	if ($anop <> "" ){
		 $p1a = " and year(a.data_saida) = '" . $anop ."'" ; 
	 }else{
		 $p1a = " and year(a.data_saida) = '" . $anp ."'" ; 	 
	 }
	$rs1 = mysql_query("select a.cod_prod, b.descr_prod from tb_saidmatp a
						inner join tb_produto b on a.cod_prod = b.cod_prod
						where a.motivo = 2 " . $p1a . "
						group by a.cod_prod
						order by b.descr_prod");		 
									
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
/*	
SELECT a.cod_prod,b.descr_prod,month(a.data_saida)mes_said,year(a.data_saida)ano_said,
 sum(quantid_said) tot_perda,
(SELECT sum(quantid_said) tot_saidaperd from tb_saidmatp b where b.motivo =1
     and b.cod_prod = a.cod_prod
     and month(a.data_saida) = month(b.data_saida)
     and year(a.data_saida) = year(b.data_saida)) tot_prod
 FROM tb_saidmatp a
 inner join tb_produto b on a.cod_prod = b.cod_prod
 where a.id_saidmat > 0  and year(a.data_saida) = '2022' and a.motivo = 2
group by a.cod_prod,month(a.data_saida),year(a.data_saida),a.motivo
order by b.descr_prod, month(a.data_saida) asc,year(a.data_saida)
	
	
	  
SELECT a.cod_prod,b.descr_prod,month(a.data_saida)mes_said,year(a.data_saida)ano_said,sum(quantid_said) tot_saida,a.motivo
 FROM tb_saidmatp a
 inner join tb_produto b on a.cod_prod = b.cod_prod and b.cod_prod like '%190105%'
 where a.id_saidmat > 0  and year(a.data_saida) = '2022' and a.motivo in (1,2)
group by  a.motivo,a.cod_prod,month(a.data_saida),year(a.data_saida)
order by  a.motivo asc,month(a.data_saida) asc,year(a.data_saida)
limit 400
	
	*** itens com perda
	
	select a.cod_prod, b.descr_prod from tb_saidmatp a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.motivo = 2
group by a.cod_prod
order by b.descr_prod;
	
	*/

								  
								  
	 $rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod,month(a.data_saida)mes_said,year(a.data_saida)ano_said,
							 sum(quantid_said) tot_saida,a.motivo
							 FROM tb_saidmatp a
							 inner join tb_produto b on a.cod_prod = b.cod_prod 
							 where a.id_saidmat > 0  " .$p1 . $p1a .
							 " and a.motivo in (1,2)
							group by  a.motivo,a.cod_prod,month(a.data_saida),year(a.data_saida)
							order by  a.cod_prod,a.motivo asc,month(a.data_saida) asc,year(a.data_saida)  ");	
}


$pcd = '';
    	
$habilia = 0;
?>
   
<script>    
if (window.opener && !window.opener.closed) {
		//	window.opener.location.reload();
		}

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

		
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matpe002b.php";
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
        <th  align="center"><h1>Consulta Perda de M. Primas / Insumos - 
        <?php echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
      
<table  width="99%" >
    <tr >
     <th colspan="3" align="center">
                Ano
                  <input type="text" name="anop" id="anop" maxlenght="4" size=10  
                  onchange="atualiza();" value = "<?php echo($anop); ?>" />
M.Prima
<select name="cod_prodp"  class="search-input6">
  <option value="">Selecione</option>
  <?php while($row33a=mysql_fetch_assoc($rs1)){ ?>
  <option value="<?php echo($row33a['cod_prod']);?>"
				  <? if($row33a['cod_prod'] == $cod_prodp) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33a['descr_prod'] . " - " . $row33a['cod_prod']); ?></option>
  <?php }?>
</select>
<br>
<input type="submit" name="Pesquisar" value="Pesquisar"  class="search-submit2" >
              <input type="button" onClick="sair();" value="Sair"   class="search-submit2" ></th>
            </tr>
 </table>
 <table width="100%" border="1">
        
     <?php
//echo($b);
 //if($anop > 0)
 
 if(isset($_POST["Pesquisar"]))  {

    $cabec   = array();
    $detalhe = array();

    $detprod = array();
    $detperd = array();
    $percperd = array();

	$cabec[0] = "Codigo";
	$cabec[1] = "Item";	
	$cabec[2] = "Jan";
	$cabec[3] = "Fev";
	$cabec[4] = "Mar";
	$cabec[5] = "Abr";
	$cabec[6] = "Mai";
	$cabec[7] = "Jun";
	$cabec[8] = "Jul";
	$cabec[9] = "Ago";
	$cabec[10] = "Set";
	$cabec[11] = "Out";
	$cabec[12] = "Nov";
	$cabec[13] = "Dez";
	$cabec[14] = "Total";

    $bg = 0;
	  
	$motivo = '';
	$cod_prodp = '';
	$total = 0.00;
  	echo('<tr bgcolor="#B3B3FF">');
    for($i=0;$i<15;$i++){   
           echo('<th  align=center>' .$cabec[$i]  .'</th>');  
    }
	echo('</tr>');
$nmtv = '';  
while($row=mysql_fetch_array($rs2)){ 
	  		 
       if($bg == 1){
	   	    $bgc = "bgcolor=#eee";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
//	   echo('<tr ' . $bgc .'>');
	   
	   if ($motivo != $row['motivo']){
	       if($motivo != ''){
			    $totlote = 0.00;
				echo("<tr>");		   
									 
				for ($i=0;$i<14;$i++){			   
				   if($i > 1){
					  echo("<td align=right>" . number_format($detalhe[$i],3,',','.') . "</td>");   
					  $total = $total + $detalhe[$i];
    		          $detprod[$i] =  $detalhe[$i];

				   }else{
					  echo("<td align=left>" . $detalhe[$i] . " - " . $nmtv  . " </td>");      
				   }
				}
				echo("<td align=right>" . number_format($total,3,',','.') . "</td>");      
				echo("</tr>");		  
		   }
		}
	       $motivo = $row['motivo'];
	    
		$detalhe[0] =  $row['cod_prod'];	    
		$detalhe[1] =  $row['descr_prod'] ;
		$detalhe[$row['mes_said']+1] =  $row['tot_saida'];

		if ($row['motivo'] == 1){
			$nmtv = "Produção";}
		if ($row['motivo'] == 2){
			$nmtv = "Perda";}

 }
 		echo("<tr>");		   
		$detalhe[1] =  $detalhe[1] ;
		$totalp = 0;
		for ($i=0;$i<14;$i++){			   
			 if($i > 1){
			   echo("<td align=right>" . number_format($detalhe[$i],3,',','.') . "</td>");   
			   $totalp = $totalp + $detalhe[$i];
	   		   $detperd[$i] =  $detalhe[$i];
			 }else{
				  echo("<td align=left>" . $detalhe[$i] . " - " .$nmtv . "</td>");      
			 }
		}
		echo("<td align=right>" . number_format($totalp,3,',','.') . "</td>");      
		echo("</tr>");			
		echo("<tr bgcolor=#E2E2F1>");
		echo("<td colspan=2 align=center> Percentual de perda / produção </td>");
		$perc = 0;
		$ttperc = 0;
		$ttpercg = 0;
		for ($i=2;$i<14;$i++){		
		     if($detprod[$i]	> 0){
	           $perc = ($detperd[$i] / $detprod[$i] ) * 100;
			   $ttperc = $ttperc + $perc;
			 }
			 echo("<td align=right>" . number_format($perc,2,',','.') . "%</td>");   
			 $perc = 0;
		}    
		     if($total > 0){
				 $ttpercg = ($totalp / $total) * 100;
			 }
			 echo("<td align=right>" . number_format($ttpercg,2,',','.') . "%</td>");   
        echo("</tr>");
}
?>
</table>
              
     
</form> 
</center>
</body>
</html>
