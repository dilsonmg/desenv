<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

include 'conectabco.php';

set_time_limit(99999999);

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");
$gera_saida = "N";


	
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

$ano_1 = "";

$dolar_mes = 0.00;
$gera_saida = "";
$imp = "";
$p01 = '';
$p02 = '';
$p03 = '';
$p04 = '';


//echo("$mes_i = ". $mes_i);
$imp = "S";

if (isset($ano_2)){
	if($ano_2 > 0){
								
        $rs2 = mysql_query("SELECT  a.* from tv_ttcustoindmes a where a.ano_custoind = '" .$ano_2 . "'");
		$b = mysql_num_rows($rs2);
  	    $imp = "S";				
	
	
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
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
	<title>MATPAC_custo_prod_anua2d - Totais Custos Indiretos por Ano</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>   
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function atualiza(){
	//$_POST["Pesquisar"]
	document.getElementById(Pesquisar).value='S';
   document.form1.submit();	
}
			

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

  function sair2()
  {	      // document.location.href='excluieq.asp'
			document.form1.action="menu_custo.php";
			document.form1.submit();  
			return true;
  
  }

function ver_lancamentos(app)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=700,status=yes,height=650"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
}


</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  
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
        <th align="center" ><h1>Totais Custos Indiretos Mensais por Ano -
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
       
              <th  align="center">Ano                <input type="text" name="ano_2" id="ano_2" maxlenght="4" size=8  value = "<?php echo($ano_2);?>"  class="search-input3"  onChange="atualiza();"/></th>

              <th  align="center">
              <input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>           
    </table>     


    
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
$linha_prod = "";
$mes_soma = '';


if(isset($_POST["Pesquisar"])){
		  
	$val_mes     = array();			  
	$cabec = array( 1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez');

		for($x=1;$x<13;$x++){
			$val_mes[$x] = 0.00;
		}
		  echo("<table width='95%'><tr  bgcolor='#D2D2FF' >");	  
		  echo("<tr bgcolor=#DDDDFF>" );
		  
		  for($i=1;$i<13;$i++){
			  echo("<td align=right>"); ?>
			  <a href="javascript:ver_lancamentos('custoindvc01a.php?mc=<?php echo($i.'&ac='.$ano_2); ?>');"><?php echo($cabec[$i] ); ?></a>
		  <?php 
			  
			  //echo("<td align=right>".$cabec[$i]."</td>");	
			  echo("</td>");		  
		  }
		  echo("<td align=right>Total</td>");
		  echo("<td align=right>Média Ano</td>");

		  echo("</tr>");	  
	
  $bg =0;
  $totg_ano = 0.00;
  $var_graf = "";
  $cont = 0;
  $tt_md = 0;
  while($row=mysql_fetch_array($rs2)){ 
 	  $val_mes[$row['mes_custoind']] = $row['tot_custoindmesano'];
	  $totg_ano = $totg_ano + $row['tot_custoindmesano'];
	  $cont++;
  }
  $tt_md = $totg_ano / $cont;
   
   
  echo("<tr>"); 	
  for ($i=1;$i<13;$i++){
	  echo("<td align=right>".number_format($val_mes[$i],2,",",".") . "</td>");
	  $var_graf = $var_graf . "['".$cabec[$i] . "'," .$val_mes[$i] . ",".$tt_md.  "],";

	  
  }
  echo("<td align=right>".number_format($totg_ano,2,",",".") . "</td>");
  echo("<td align=right>".number_format($tt_md,2,",",".") . "</td>");

  echo('</tr ' . $bgc .'>');
			
  echo($msg);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

if(isset($_POST["Pesquisar"])){

?>
</table>
<br />  
  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

 function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Mes', 'Custo Mes', 'Média ano'],
               <?php echo($var_graf); ?>
        ]);

       var options = {
          title : 'Custos Mensais por ano - <?php echo($ano_2);?> ',
          vAxis: {title: 'Custos'},
          hAxis: {title: 'Meses'},
          seriesType: 'bars',
          series: {6: {type: 'line'}}
		  
        };


        var chart = new google.charts.Bar(document.getElementById('chartDiv1'));


        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
	
//////////

</script>
<center>
<br>
 <table width="100%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <!--th align="center" class="esquerda" id="chartDiv1"  style="width: 620px; height: 200px;" > </th --> 
  <th>
    <div id="chartDiv1" style="width: 700px; height: 300px;"></div>
  </th>

</tr>
</table>
 </center>   
<?php } ?>    
    
</form> 
</center>
</body>
</html>
