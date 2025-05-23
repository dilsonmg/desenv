 <meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

<?php
session_start();
$anodf = date("Y");

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


$p01 = "";
$p1 = "";
$p01x = "";

$p02 = "";
$p02a = "";

$p2 = "";
$p3 = "";
$p4 = "";
$p4a = "";
$p4b = "";

$p5 = "";
$p6 = "";
$p7 = "";
$p8 = "";
$p11 = "";
$p12 = "";
$p13 = "";
$p14 = "";

$p12 = "";
$p13 = "";
$p14y = "";			

	 
if(isset($linha_desp) ){
	if ($linha_desp <> "" ){
  		  $linha_desp = str_replace("'", "", $linha_desp);	
  		  $p01x = " and c.id_grupocusto = '" . $linha_desp ."' ";
	}
}

	 
if(isset($codigo2) && $codigo2 > 0 ){
    $codigo2 = str_replace("'", "", $codigo2);	
    $p01 = " and a.cod_sidespreal in(" . $codigo2 .") ";
}

		 
if (isset($descricao2)){
	if ($descricao2 <> "" ){
		 $descricao2 = str_replace("'", "", $descricao2);
		 $p02 = " and b.descr_despreal like '%" . $descricao2 ."%' " ; 
		 }}
  $p33 = "";
  $p34 = "";


		 
if(isset($ano_i) && $ano_i > 0 ){
	$anodf = $ano_i; }
    $p1 = " and ano_custoreal = '" . $anodf ."' ";
	
	
if($mes_i > 0){
	$p2 = " and mes_custoreal >= '" .$mes_i ."' ";
}
if($mes_f > 0){
	$p2a = " and mes_custoreal <='" .$mes_f ."' ";
}
	
    $cabec   = array();
	$header  = array();
	$header2  = array();
	$ttcol    = array();
	
	
	$resumo  = array();

      $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $ttcol[$i] = ""; 
     }

	 $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $resumo[$i] = ""; 
     }
	
	$cabec[0] = "Codigo";
	$cabec[1] = "Despesa";	
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
	$cabec[15] = "Media";

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

   }else{

         echo("Você não esta logado !!");
              	header("Location: loginx.php"); 
   
}
header("Content-Type: text/html; charset=ISO-8859-1",true);

include 'conectabco.php';
mysql_query("SET NAMES 'ISO-8859-1'");
mysql_query("SET character_set_connection=ISO-8859-1");
mysql_query("SET character_set_client=ISO-8859-1");
mysql_query("SET character_set_results=ISO-8859-1");

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

$rs2a= mysql_query("SELECT a.* FROM tb_grupoccusto a order by a.descr_grupocc");

if ($p != 99){
	//$a = $_GET ["S"];
}
if(isset($_POST["botao"])){
	
		$rs_del = "drop table tmp_mediareal ";					   
		$tmp =  mysql_query( $rs_del );
					  
		$rs_tmp = "create table tmp_mediareal as (SELECT a.cod_sidespreal,b.descr_despreal, sum(val_custoreal) tot_desp,avg(val_custoreal)media_desp
		           , c.id_grupocusto,d.descr_grupocc
                   FROM tb_custoreal a
                   inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
				   	inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal " . $p01x . "
                             inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto
                   where a.ano_custoreal = '". $anodf ."'". $p1 . $p01 .$p2 .$p2a .  "
					 group by a.cod_sidespreal
                     order by b.descr_despreal )";
							
		$tmp =  mysql_query( $rs_tmp );
				
		if (isset($linha_prod)){
			if($linha_prod != ""){
				 $p02a = " and b.linha ='" . $linha_prod ."'" ;
			}
		}
		
		$rs2 = mysql_query("SELECT a.*,b.descr_despreal,e.media_desp,c.id_grupocusto,d.descr_grupocc  FROM tb_custoreal a
 							inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
							inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal " . $p01x . "
                             inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto
							inner join tmp_mediareal e on e.cod_sidespreal = a.cod_sidespreal
							where a.cod_sidespreal > 0 " . $p1 . $p2 .$p2a . $p01. $p01x .
							"group by a.ano_custoreal,a.mes_custoreal,a.cod_sidespreal
                            order by c.id_grupocusto,b.descr_despreal,a.ano_custoreal,a.mes_custoreal ");
							
		$rscons = mysql_query("SELECT a.* from tmp_mediareal a order by a.tot_desp desc ");

}


  if($_GET ["P"] == 99){
	  
	  $a="";
	  
  }
$hoje = date("d/m/Y");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/qreal.css">
<link rel="stylesheet" href="../css/qreal2.css">

<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>desprealc001 - Consulta despesas realizadas por ano</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>


<script type='text/javascript'>
<!--
function fechar1(){
window.opener = window
 window.close("#")

}

 function expand() {  

 for(x = 0; x < 50; x++) {  

 window.moveTo(screen.availWidth * -(x - 1) / 100, screen.availHeight * -(x - 1) / 90);  

 window.resizeTo(screen.availWidth * x / 1, screen.availHeight * x / 1);  
 }
 }
 -->
 </script>

<style type="text/css"></style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<META content="text/css" http-equiv="Content-Style-Type">
<link rel="stylesheet" href="../css/qreal.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo( $_SESSION['nome_usu']); ?>
<form name="form1" method="post" enctype="multipart/form-data"> 

<input type="hidden" name="monen_res" value="-1" />

<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>Despesas Realizadas- Ano de Referencia : <?php echo($anodf); ?> - <?php echo($data_1); ?> a <?php echo($data_2); ?>  </h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><a href="menu_custo.php"><img src="../images/back_f2.png" width="32" height="32" border="0" alt="Voltar ao menu" /></a>
        <br /> <?php echo($hoje);?><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
      </tr>
      </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >

  <tr>
    <th  align="left" valign="bottom" >C&oacute;digos:
    <input type="text" name="codigo2" maxlength="20" size="45"  class="search-input3" title="Informe os codios separados por vírgulas" />
    <select name="linha_desp"  onchange="atualiza();" class="search-input3">
      <option value="">Selecione a Linha</option>
        <?php while($row33a=mysql_fetch_assoc($rs2a)){ ?>
        <option value="<?php echo($row33a['id_grupocusto']);?>"
				  <? if($row33a['id_grupocusto'] == $linha_desp) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33a['descr_grupocc']); ?></option>
        <?php }?>
    </select>
    <select name="mes_i" class="search-input3" >
      <option value="0">Selecione o Mes Inicial </option>
            <option value="1"  <?php if ($mes_i == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>            
            <option value="2"  <?php if ($mes_i == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>            
            <option value="3"  <?php if ($mes_i == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>            
            <option value="4"  <?php if ($mes_i == 4){ echo ( " selected=selected ");} ?>>Abril</option>            
            <option value="5"  <?php if ($mes_i == 5){ echo ( " selected=selected ");} ?>>Maio</option>            
            <option value="6"  <?php if ($mes_i == 6){ echo ( " selected=selected ");} ?>>Junho</option>            
            <option value="7"  <?php if ($mes_i == 7){ echo ( " selected=selected ");} ?>>Julho</option>            
            <option value="8"  <?php if ($mes_i == 8){ echo ( " selected=selected ");} ?>>Agosto</option>            
            <option value="9"  <?php if ($mes_i == 9){ echo ( " selected=selected ");} ?>>Setembro</option>            
            <option value="10"  <?php if ($mes_i == 10){ echo ( " selected=selected ");} ?>>Outubro</option>            
            <option value="11"  <?php if ($mes_i == 11){ echo ( " selected=selected ");} ?>>Novembro</option>            
            <option value="12"  <?php if ($mes_i == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>            
            </select> 
    <select name="mes_f" class="search-input3" >
             <option value="0">Selecione o Mes Final </option>
             <option value="1" <?php if ($mes_f == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>
             <option value="2" <?php if ($mes_f == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>
             <option value="3" <?php if ($mes_f == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>
             <option value="4" <?php if ($mes_f == 4){ echo ( " selected=selected ");} ?>>Abril</option>
             <option value="5" <?php if ($mes_f == 5){ echo ( " selected=selected ");} ?>>Maio</option>
             <option value="6" <?php if ($mes_f == 6){ echo ( " selected=selected ");} ?>>Junho</option>
             <option value="7" <?php if ($mes_f == 7){ echo ( " selected=selected ");} ?>>Julho</option>
             <option value="8" <?php if ($mes_f == 8){ echo ( " selected=selected ");} ?>>Agosto</option>
             <option value="9" <?php if ($mes_f == 9){ echo ( " selected=selected ");} ?>>Setembro</option>
             <option value="10" <?php if ($mes_f == 10){ echo ( " selected=selected ");} ?>>Outubro</option>
             <option value="11" <?php if ($mes_f == 11){ echo ( " selected=selected ");} ?> >Novembro</option>
             <option value="12" <?php if ($mes_f == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>
           </select>
  Ano: <input type="text" name="ano_i" maxlength="4" size="4"  class="search-input3" /></th>
    <th  align="center" valign="top"><input type="submit" name="botao"  value="Filtrar" class="search-submit2"  /></th>
  </tr>
  </table>

    <table width="100%"  border="1" >
     <?php 
	// $bg=1;
	 $cd_real = 0;
	 $i = 0;
	 for ($i=0;$i < 19; $i++) {
	     $header2[$i] = ''; 
     }
	 $i = 0;
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<19;$i++){   
              echo('<th  align=right>' .$cabec[$i]  .'</th>');  
         }
	 echo('</tr>');
	$bg = 0; 
	$totv = 0;
	$ttcli = 0;
	$ttm = 0;
if(isset($_POST["botao"])){
     $sald = 0;
	 $ptmin = 0;
	 $var_graf = '';
	 while($row=mysql_fetch_array($rs2)){ 
			  
	   //echo('<tr ' . $bgc .'>');
       if ( $row['cod_sidespreal']	!= $cd_real){
		  ++ $ttcli ; 		  
          if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
    	  echo('<tr ' . $bgc .'>');
	      if ($ttm > 0){
  			  $header2[14] = $totv;
		  }
		  else { $header2[15] = '';}
		  
		  
	   	  for ($i=0;$i < 16; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if ($header2[$i] > 0 && $i > 1) {
			      echo("<th" . $alg . ">" . number_format($header2[$i],2,",",".") ."</th>" );
			  }else{
			         echo("<th" . $alg . ">" . $header2[$i] ."</th>" );
				  }
    	  }
	   	  for ($i=0;$i < 19; $i++) {
	        $header2[$i] = ''; 
            $ttm = 0;          
			$totv = 0;
		  }
		 echo("</tr>");
	  }
	  $header2[0] = $row['cod_sidespreal'] ;
	  $header2[1] = $row['descr_despreal'] . " - " . $row['descr_grupocc'];   
	  $header2[15] = $row['media_desp'];   
	  
 	  $header2[$row['mes_custoreal']+1] = $row['val_custoreal'];
	 
	  $ttcol[$row['mes_custoreal']+1] = $ttcol[$row['mes_custoreal']+1] + $row['val_custoreal'];
	  
	  $ttm++;
	  $totv = $totv +  $row['val_custoreal'];
	   $cd_real = $row['cod_sidespreal'];
      
      
	 }	

     if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
	  else{ $bgc = ''; $bg = 1;}	

	   echo('<tr ' . $bgc .'>');
	   
   	   if ($ttm > 0){
  			  $header2[14] = number_format(($totv),2,",",".");
	          $header2[15] = number_format(($totv / $ttm),2,",",".");
			  //$header2[17] = 'Kg';
			  }
	   for ($i=0;$i < 19; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  echo("<th" . $alg . " >" . $header2[$i] ."</th>" );
			 }
	 
	 	//$ttcli ++;
		 echo("</tr>");
	 echo("<tr bgcolor=#D2D2FF>");
	 $md = 0;
	
	  for ($i=0;$i < 19; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if($i < 14){
			      $ttcol[14] = $ttcol[14] + $ttcol[$i];
				 if($ttcol[$i] > 0){
			
					  $md++;
			       
					 $ttcol[15] = ($ttcol[14] /  $md);
	
				  }
			  
			  }
		  
			    echo("<th" . $alg . " >" );
				if($ttcol[$i] > 1){
				  echo(number_format($ttcol[$i],2,",",".")); 
				}else {
					 $ttcol[1] = " T o t a i s ======> ";
					 echo($ttcol[$i]); 
				}
				 echo("</th>" );
	            
			 }
	 
	 	//$ttcli ++;
		 echo("</tr>");
	 
	 
	 while($rowc=mysql_fetch_array($rscons)){ 
	 
		$var_graf = $var_graf . "['".trim($rowc['descr_despreal']). "'," . $rowc['tot_desp']."]," ;
	 }
	 
}
      ?>    
     
  </table>
  </center>
      
</form>
 

  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
/*
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
*/

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

/*
function drawChart() {
        var data = google.visualization.arrayToDataTable([
*/

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([		
   //       ['Item', 'consumo','Saldo','Pto Min'],
            ['Despesa', 'Totais'], 
	           <?php echo($var_graf);?>     ]);

     var options = {
 
 		fontName: 'arial',
		margin:0,
		fontSize:8,
		padding:150,
		legendFontSize:10,
		titleFontSize:15,
		tooltipFontSize:18,
        title: 'Totais de despesas realizadas mensais',
		chartArea: {width: '50%'},
		annotations: {
    textStyle: {
      fontName: 'Times-Roman',
      fontSize: 18,
	  legendFontSize:15,
      bold: true,
      italic: true,
      // The color of the text.
      color: '#871b47',
      // The color of the text outline.
      auraColor: '#d799ae',
      // The transparency of the text.
      opacity: 0.8
    }
            },
        hAxis: {
          title: 'Totais',
          minValue: 0,
		   titleTextStyle: {
            color: "#000",
            fontName: "sans-serif",
            fontSize: 10,
            bold: true,
            italic: false
        }
        },
        vAxis: {
          title: 'Despesas',
		   titleTextStyle: {
            color: "#000",
            fontName: "sans-serif",
            fontSize: 10,
            bold: true,
            italic: false
        }
        },
		 annotations: {
        alwaysOutside: true,
        textStyle: {
            fontSize: 18,
            auraColor: 'none'
        }
    }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }			   

/*
        var options = {
          title : 'Totais de despesas realizadas mensais -',
          vAxis: {title: 'Totais'},
          hAxis: {title: 'Despesa'},
          seriesType: 'bars',
		  trendlines: {
    0: {
      type: 'linear',
      color: 'green',
      lineWidth: 3,
      opacity: 0.3,
      showR2: true,
      visibleInLegend: true
    }
  },
		  axes: {
            x: {
              1: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));
       chart.draw(data, google.charts.Bar.convertOptions(options));

      }
	  
*/
	  ///////////////////////////////////////////////////

	  /////////////////////////////////////////////////
    </script>
 
  <center>
 <table width="100%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <th valign="top">
    <div id="chart_div" style="width: 1080px; height: 950px;" align="center"   class="linha1" ></div>
  </th>

</tr>
</table>
 </center>
</body>
</html>
