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

if (isset($cod_prods)){
	if($cod_prods <> ""){
		$p11a = " and a.cod_prod in (".$cod_prods.") ";
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
							 sum(quantid_said) tot_saida,a.motivo,b.unid_mat
							 FROM tb_saidmatp a
							 inner join tb_produto b on a.cod_prod = b.cod_prod 
							 where a.id_saidmat > 0  " .$p1 .$p11a . $p1a .
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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

    
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
        <th  align="center"><h1>Perdas x Produ&ccedil;&otilde;es - 
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
 C&oacute;digos 
 <input type="text" name="cod_prods" id="cod_prods" maxlenght="50" size=35 placeholder="informe os c&oacute;digos separados por v&iacute;rgula !"/>
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
	//$cod_prodp = '';
	$total = 0.00;
  	echo('<tr bgcolor="#B3B3FF">');
    for($i=0;$i<15;$i++){   
           echo('<th  align=center>' .$cabec[$i]  .'</th>');  
    }
	echo('</tr>');
$nmtv = '';  

$cod_prod = '';

        $totalprod = 0;
		$totalperd = 0;
		$totproduni = 0;
		$cont = 0;
		
          $mes = array( 1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
		                7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez' );
		
		$var_grafx = '';
		$prod =0;
		$perd = 0;
		$var = 0;
		
		
		
while($row=mysql_fetch_array($rs2)){ 
	   $cont++;
	   		 
       if($bg == 1){
	   	    $bgc = "bgcolor=#eee";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  	   
	   if ($motivo != $row['motivo']){
	       if($motivo != ''){
			    $totlote = 0.00;
				echo("<tr>");		   
									 
				for ($i=0;$i<14;$i++){			   
				   if($i > 1){
					  echo("<td align=right>" . number_format($detalhe[$i],3,',','.') . "</td>");   
					  $total = $total + $detalhe[$i];
    		         // $detprod[$i] =  $detalhe[$i];
					      $totproduni = $totproduni + + $detalhe[$i]; 
			
					 if($nmtv == "Produção"){
						  $totalprod =  $totalprod + $detalhe[$i]; 
					 }else{
						$totalperd = $totalperd +  $detalhe[$i];
					 }
					 
				   }else{
					  echo("<td align=left>" . $detalhe[$i] . " - " . $nmtv  . " </td>");      
				   }
				}
				echo("<td align=right>" . number_format($total,3,',','.') . "</td>");   
			//if ($cod_prodp <> "" ){
				    $total = 0; 
			//	}
				for($i=0;$i<14;$i++){
					$detalhe[$i]=0;
				}
	
				echo("</tr>");		
				
				///////////codigo do produto diferente ///////////
				if ($cod_prod != $row['cod_prod']){
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
						 echo("<td align=right>" . number_format($perc,2,',','.')  . "%</td>");   
						 $perc = 0;
					}    
					if($totalprod > 0){
						 $ttpercg = ($totalperd / $totalprod) * 100;
					 }
					 echo("<td align=right>" . number_format($ttpercg,2,',','.') . "%</td>");   
					echo("</tr>");
										
					$rs3a = mysql_query("SELECT a.cod_prod,b.descr_prod,month(a.data_saida)mes_said,year(a.data_saida)ano_said,
											sum(quantid_said) tot_perda,
											(SELECT sum(quantid_said) tot_saidaperd from tb_saidmatp b where b.motivo =1
												 and b.cod_prod = a.cod_prod
												 and month(a.data_saida) = month(b.data_saida)
												 and year(a.data_saida) = year(b.data_saida)) tot_prod
										 FROM tb_saidmatp a
										 inner join tb_produto b on a.cod_prod = b.cod_prod
										 where a.id_saidmat > 0  ".$p1a .$p11a ." and a.motivo = 2
										 and a.cod_prod = '".$cod_prod ."' group by a.cod_prod,month(a.data_saida),year(a.data_saida),a.motivo
										 order by b.descr_prod, month(a.data_saida) asc,year(a.data_saida)");

                    $prod = 0;
					$perd = 0;
					$var  = 0;
					$var_grafx = '';
					
                    while($rowx=mysql_fetch_array($rs3a)){ 
                       $nmprod = $rowx['descr_prod'];
					   
					   if($rowx['tot_prod'] != null && $rowx['tot_prod'] > 0){
						 $var = ($rowx['tot_perda'] / $rowx['tot_prod'])*100 ;  
					   }else{$var = 0 ;}
					   
	   				   $var_grafx = $var_grafx . "['".$mes[$rowx['mes_said']]. "'," . $rowx['tot_prod'] . "," . $rowx['tot_perda'] . "," . $var."]," ;
	   				
					}
										
					
   ?>
    <script type="text/javascript">
    	/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
		 google.charts.load('current', {'packages':['corechart']});
		 google.charts.setOnLoadCallback(drawVisualization);
		
		 function drawVisualization() {
		 
				  var data = google.visualization.arrayToDataTable([
				  ['Mes', 'Produção', 'Perda','Variação'],<?php echo($var_grafx);?>]);
				  		 
				var options = {
				  title : 'Produções x Perdas '  ,
				  vAxis: {title: 'Totais'},
				  hAxis: {title: 'Meses'},
				  legendFontSize:12,
				  seriesType: 'bars',
				  series: {4: {type: 'line'}}
				};
		
				var chart = new google.visualization.ComboChart(document.getElementById('chart_div<?php echo($cont);?>'));
				chart.draw(data, options);
			  }
			///////////
    </script>
   <tr><td colspan=15  align="center" >
   <table width="60%"   cellpadding="0" cellspacing="0" >
	<tr align="center">
  		<th  align="center" id="chart_div<?php echo($cont)?>"></th>
	</tr>
	</table>
	</td></tr>
    <?php
		      //echo("<tr><td colspan=15><div id=chart_div".$cont." style=width: 1000px; height: 300px;></div></td></tr>");    				
				}				
				//////////////////////////////////////////////////
		   }
		}
	    $motivo = $row['motivo'];
	    $cod_prod = $row['cod_prod'];
		
		$detalhe[0] =  $row['cod_prod'];	    
		$detalhe[1] =  $row['descr_prod'] . " - " . $row['unid_mat'];
		$detalhe[$row['mes_said']+1] =  $row['tot_saida'];
		if ($row['motivo'] == 1){
    		 $nmtv = "Produção";
		     $detprod[$row['mes_said']+1] =  $row['tot_saida'];
	//		 $totalprod =  $totalprod + $row['tot_saida'];
		}
		if ($row['motivo'] == 2){
			$nmtv = "Perda";
	   		$detperd[$row['mes_said']+1] =  $row['tot_saida'];			
	//		$totalperd =  $totalperd + $row['tot_saida'];
		}
 }
 		echo("<tr>");		   
		$detalhe[1] =  $detalhe[1] ;
		$totalp = 0;
	//	$totalprod = 0;
		$totalperd = 0;
		
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
				for($i=0;$i<14;$i++){
					$detalhe[$i]=0;
				}
	
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
			 echo("<td align=right>" . number_format($perc,2,',','.')   ."%</td>");   
			 $perc = 0;
		}   
		if($totproduni > 0){
		    $ttpercg = ($totalp / $totproduni) * 100;
		}
		echo("<td align=right>" . number_format($ttpercg,2,',','.') . "%</td>");   
        echo("</tr>");
}

//////////////////////////////////////////////////////
					$rs3a = mysql_query("SELECT a.cod_prod,b.descr_prod,month(a.data_saida)mes_said,year(a.data_saida)ano_said,
											sum(quantid_said) tot_perda,
											(SELECT sum(quantid_said) tot_saidaperd from tb_saidmatp b where b.motivo =1
												 and b.cod_prod = a.cod_prod
												 and month(a.data_saida) = month(b.data_saida)
												 and year(a.data_saida) = year(b.data_saida)) tot_prod
										 FROM tb_saidmatp a
										 inner join tb_produto b on a.cod_prod = b.cod_prod
										 where a.id_saidmat > 0  ".$p1a .$p11a . " and a.motivo = 2
										 and a.cod_prod = '".$cod_prod ."' group by a.cod_prod,month(a.data_saida),year(a.data_saida),a.motivo
										 order by b.descr_prod, month(a.data_saida) asc,year(a.data_saida)");

                    $prod = 0;
					$perd = 0;
					$var  = 0;
					$var_grafx = '';
					
                    while($rowx=mysql_fetch_array($rs3a)){ 
                       $nmprod = $rowx['descr_prod'];
					   
					   if($rowx['tot_prod'] != null && $rowx['tot_prod'] > 0){
						 $var = ($rowx['tot_perda'] / $rowx['tot_prod'])*100 ;  
					   }else{$var = 0 ;}
					   
	   				   $var_grafx = $var_grafx . "['".$mes[$rowx['mes_said']]. "'," . $rowx['tot_prod'] . "," . $rowx['tot_perda'] . "," . $var."]," ;
  
					
					}

   ?>
    <script type="text/javascript">
    	/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
		 google.charts.load('current', {'packages':['corechart']});
		 google.charts.setOnLoadCallback(drawVisualization);
		
		 function drawVisualization() {
		 
				  var data = google.visualization.arrayToDataTable([
				  ['Mes', 'Produção', 'Perda','Variação'],<?php echo($var_grafx);?>]);
				  		 
				var options = {
				  title : 'Produções x Perdas '  ,
				  vAxis: {title: 'Totais'},
				  hAxis: {title: 'Meses'},
				  legendFontSize:12,
				  seriesType: 'bars',
				  series: {4: {type: 'line'}}
				};
		
				var chart = new google.visualization.ComboChart(document.getElementById('chart_div<?php echo($cont);?>'));
				chart.draw(data, options);
			  }
			///////////
    </script>
      <tr><td colspan=15  align="center" >
   <table width="60%"   cellpadding="0" cellspacing="0" >
	<tr align="center">
  		<th  align="center" id="chart_div<?php echo($cont)?>"></th>
	</tr>
	</table>
	</td></tr>
    <?php
		      //echo("<tr><td colspan=15><div id=chart_div".$cont." style=width: 1000px; height: 300px;></div></td></tr>");    				

/////////////////////////////////////////////////////


?>
</table>
              
     
</form> 
</center>
</body>
</html>
