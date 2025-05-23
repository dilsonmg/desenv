 <meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

<?php
session_start();
$anodf = date("Y");
include 'conectabco.php';

$vrgr = $_GET ["vrgr"];
$cddp = $_GET ["cd"];
$anod = $_GET ["an"];

$mes = array( 1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez' );

$rs2 = mysql_query("SELECT  a.*,b.descr_despreal,
                   e.val_custoreal,(a.val_prevdespr - e.val_custoreal) variacao
                   FROM tb_prevdespr a
 					inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
                    left outer join tb_custoreal e on e.cod_sidespreal = a.cod_sidespreal
                            and e.mes_custoreal = a.mes_prevdespr
                            and e.ano_custoreal = a.ano_prevdespr
                    where a.cod_sidespreal = ".$cddp . " and ano_prevdespr = " . $anod . "
					group by a.ano_prevdespr,a.mes_prevdespr,a.cod_sidespreal
					order by 2,3,4 ");

$var_graf = '';
$prev =0;
$real = 0;
$var = 0;
					
while($row=mysql_fetch_array($rs2)){ 
         $prev =   $row['val_prevdespr'];
		 if ($prev == null){ $prev = 0;}
		 $real =   $row['val_custoreal'];
		 if ($real == null){ $real = 0;}
		 $var =   $row['variacao'];
		 if ($var == null){ $var = 0;}
		 
		 $despesa = $row['descr_despreal'];
		   
		  $var_graf = $var_graf . "['".$mes[$row['mes_prevdespr']]. "'," . $prev. "," . $real. "," . $var."]," ;


}

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
	
	/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
 google.charts.load('current', {'packages':['corechart']});

 google.charts.setOnLoadCallback(drawVisualization);

 function drawVisualization() {
 
	      var data = google.visualization.arrayToDataTable([
          ['Mes', 'Previsto', 'Realizado','Variação'],<?php echo($var_graf);?>]);

        var options = {
          title : 'Previsto x Realizado da despesa : <?php echo($despesa) ?>' ,
          vAxis: {title: 'Totais'},
          hAxis: {title: 'Meses'},
		  legendFontSize:12,
          seriesType: 'bars',
          series: {4: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    ///////////
	  
    </script>

  </head>
  <body>
  <table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h4>Despesas - Previsto x Realizado- Ano de Referencia : <?php echo($anod); ?></h4></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br /> 
        <?php echo($hoje);?><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
      </tr>
      </table>
    <div id="chart_div" style="width: 700px; height: 300px;"></div>
  </body>
</html>
