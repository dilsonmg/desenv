 <meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php header("Content-Type: text/html; charset=ISO-8859-1",true) ?>

<?php
session_start();
$anodf = date("Y");
$p1 = "";
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
if(isset($ano_i) && $ano_i > 0 ){
	$anodf = $ano_i; }
  //  $p1 = " and year(a.data_fabr) = '" . $anodf ."'";
	 $p1 = " and year(str_to_date(a.data_fabr, '%d/%m/%Y')) = '" .$anodf ."'";

	
if($mes_i > 0){
//	$p2 = " and month(a.data_fabr) = '" .$mes_i ."'";
	 $p2 = " and month(str_to_date(a.data_fabr, '%d/%m/%Y')) = '" .$mes_i ."'";
}
	
    $cabec   = array();
	$header  = array();
	$header2  = array();
	$ttcol    = array();
	

	$totalprod = array();
	$cabecpr = array();
	$headerpr = array();
	
	$cabecpr[0] = "Produto";	
	$resumo  = array();

      $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $ttcol[$i] = ""; 
     }

	 $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $resumo[$i] = ""; 
     }
	
	$cabec[0] = "Produto";
	$cabec[1] = "Jan";
	$cabec[2] = "Fev";
	$cabec[3] = "Mar";
	$cabec[4] = "Abr";
	$cabec[5] = "Mai";
	$cabec[6] = "Jun";
	$cabec[7] = "Jul";
	$cabec[8] = "Ago";
	$cabec[9] = "Set";
	$cabec[10] = "Out";
	$cabec[11] = "Nov";
	$cabec[12] = "Dez";
	$cabec[13] = "Total";
	$cabec[14] = "Média";
    $cabec[15] = "Unid.";

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

   }else{

         echo("Você não esta logado !!");
              	header("Location: loginx.php"); 

}



//header("Content-Type: text/html; charset=ISO-8859-1",true) ;

/*
$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
 $hoje = getdate();
 $dia = $hoje["mday"];
 $mes = $hoje["mon"];
 $nomemes = $meses[$mes];
 $ano = $hoje["year"];
 $diadasemana = $hoje["wday"];
 $nomediadasemana = $diasdasemana[$diadasemana];
 echo "$nomediadasemana, $dia de $nomemes de $ano";

SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano, month(a.data_saida) mes ,
sum(a.quantid_said) tt_mes FROM tb_saidmatp a
inner join tb_produto b on a.cod_prod = b.cod_prod
group by a.cod_prod, year(a.data_saida), month(a.data_saida)
order by year(a.data_saida) desc,a.cod_prod, month(a.data_saida)

*/
//header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';
mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$p1n = "";

$p11a ="";

/**/
$linhap='';
if(isset($_POST["Pesquisar"])){ 	
	$ttl =0;
	if($_REQUEST['linha_prod'] != ''){
	
		foreach ($_REQUEST['linha_prod'] as $selectedOption){
		   //  echo $selectedOption."<br>";
		   $linhap = $linhap . "'".trim($selectedOption)."',";
		   $ttl++;
		 }
	}
}

if(isset($linha_prod) && $ttl > 0){
	if($_REQUEST['linha_prod']  <> ""){
		//$p11a = " and b.linha = '" . $linha_prod . "'";
		$p11a = " and trim(b.linha) in (" . $linhap . "'')";
	}
}
 		 
if (isset($prodpesq)){
	if ($prodpesq <> "" ){
       // if(!is_numeric($prodpesq)){
		//     $p1n = " and b.descr_prod like '%". $prodpesq ."%'" ; }
		// else{
			 $p1n = " and b.cod_prod in (" . $prodpesq .")" ; 
	//	}
	}
}

/*					
$rs2 = mysql_query("select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prodr = b.cod_prod ". $p1n  .$p11a  ."
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . " and a.lote_realizado <> '' group by a.cod_prod , 
					month(data_pr) , year(data_pr) order by a.cod_prod,ano,mes ");
*/

											
					
$rs2 = mysql_query("select a.cod_prod,b.descr_prod,sum(a.quant_fabr) kg_realizado, count(a.num_lote) qtde_lote_rel,
 					month(str_to_date(a.data_fabr, '%d/%m/%Y')) mes,year(str_to_date(a.data_fabr, '%d/%m/%Y')) ano,b.unid_mat
                    from tb_entprodac a
					inner join tb_produto b on a.cod_prod = b.cod_prod ". $p1n  .$p11a ."
                    where  a.cod_prod > 0 "  .$p1 . $p2 .$p3 . 
                    " group by  a.cod_prod,mes,ano
                    order by  a.cod_prod,ano,mes ");					
					
					

if ($p != 99){
	//$a = $_GET ["S"];
}


//$rs_del = "drop table tmp_saldoprd ";					   
//$tmp =  mysql_query( $rs_del );




/*

$rs_tmp = "create table tmp_numcliref as (SELECT a.id_consult, count(b.codigo_cli) ttclie from tb_regvenda a
left outer join tb_cliente b on a.cod_regiao = b.cod_regiao
group by a.id_consult)";

$tmp =  mysql_query( $rs_tmp );
						   
$rs_del = "drop table tmp_numcliref ";					   
$tmp =  mysql_query( $rs_del );

*/
						   
//$rs331=mysql_query("SELECT a.* FROM tb_contrato a
//                     order by a.id_contrato desc limit 0,3");



  if($_GET ["P"] == 99){
	  
	  $a="";
	  
  }

$rs33 = mysql_query("SELECT  b.linha FROM tb_produto b where  b.linha in 
                    ('basf','elanco-','filter','i.acabado','inovacao','natural','phibro','qreal')  
					group by  b.linha
					order by b.linha");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>matpcm011 - Producao mensal de produtos acabados</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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

</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<META content="text/css" http-equiv="Content-Style-Type">
 <link rel="stylesheet" href="../css/qreal.css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo( $_SESSION['nome_usu']); ?>
<form name="form1" method="post"  enctype="multipart/form-data">
<input type="hidden" name="monen_res" value="-1" />


<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>Produc&atilde;o Mensal - Produtos Acabados - Ano de Referência : <?php echo($anodf); ?> <br />
        <?php echo ($linhap); ?>
        </h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><a href="menu_prevprod.php"><br />
  <?php
	$voltar = "menu_prevprod.php";
	//echo($_SESSION['id_setor']);
	
	switch ($_SESSION['id_setor']) {
   case '18':
       $voltar = "../visitatecnica/menu_visita.php";
       break;
   case '15':
       $voltar = "../expedicao/menu_exped.php";
       break;
   case '23':
       $voltar = "../expedicao/menu_exped.php";
       break;
}
       $voltar = "../expedicao/menu_exped.php";

?>

    <a href=<?php echo($voltar) ?>><img src="../images/back_f2.png" width="32" height="32" border="0" /></a>

        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir" /></a></th>
      </tr>
      <tr valign="top">
        <th colspan="3" align="center"  >Produto
          <input type="text" name="prodpesq" id="prodpesq" maxlenght="50" size="40" title="Informe os codigos separados por vírgulas"/>
Linha
<select name="linha_prod[]"  multiple="multiple" onChange="atualiza();" class="search-input4" title="Segure a tecla CTRL para selecionar mais de uma linha !">
  <option value="">Selecione a Linha</option>
  <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
  <option value="<?php echo($row33['linha']);?>"
				  <? if($row33['linha'] == $linha_prod) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33['linha']); ?></option>
  <?php }?>
</select>
Mes :
<select name="mes_i"  cl class="search-input4">
  <option value="0">Selecione o Mes </option>
  <option value="1">Jan</option>
  <option value="2">Fev</option>
  <option value="3">Mar</option>
  <option value="4">Abr</option>
  <option value="5">Mai</option>
  <option value="6">Jun</option>
  <option value="7">Jul</option>
  <option value="8">Ago</option>
  <option value="9">Set</option>
  <option value="10">Out</option>
  <option value="11">Nov</option>
  <option value="12">Dez</option>
</select>
Ano:
<input type="text" name="ano_i" maxlength="4" size="6"  class="search-input4" value="<?php echo($ano_i); ?>"/>
<!--input type="submit" name="button" id="button" value="Filtrar" class="search-submit2"/-->
<input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2" />

</th>
      </tr>
</table>



<br />
 <table width="100%" border="1" cellspacing="0"  align="left"   >
   
	
	<?php  

	for ($i = 0; $i < 15; $i ++){
	      $totalprod[$i] = 0.00 ; }
	

		$cabec2[1] = "Nome";

		 echo('<tr align="center" bgcolor="#D9FFEC" >
 ');
         $i = 0;
  	     for($i=0;$i<16;$i++){   
              echo('<td align="center" >' .$cabec[$i]  .'</td>');  
         }	
	     $bg = 0;
	     $tr = 0;
		 echo('</tr>');
		 $anoi = 0;
		 $col = 0;
		 $l = 0;
		 $total_l = 0;
         $ano_s = '';
		 $ano_v = '';
         $ano_e = '';
		 $nomei = '';		 		 
		  
		 for ($i=0;$i < 14; $i++) {
			     $headerpr[$i] = 0.00; }
		 $bg = 0;
		 $ctmd = 0;
         $unid = "";
		 while($row=mysql_fetch_assoc($rs2)){
  	         $totalprod[$row['mes'] ] =  $totalprod[$row['mes'] ] + $row['kg_realizado'];
			 
          if ($nomei == $row['descr_prod'] ){
		  	  $headerpr[$row['mes']  ] = $row['kg_realizado'];
			  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;
			  $unid = $row['unid_mat'];
    	  }else{  

		  		 if($bg == 1){
			    	    $bgc = "bgcolor=#FFFFFF";  $bg = 0;}
				  else{ $bgc = ""; $bg = 1;}
		  
		      if ($headerpr[0] != 0){
		       echo('<tr ' . $bgc .' >');
		  	  for ($i=0;$i < 13; $i++) {
			       if($i < 1){
			         echo("<td align='left'><font size=1 face='Arial, Helvetica, sans-serif'>" . $headerpr[$i] ."</b></font></td>" );
					 }
				   else{
				     $total_l = $total_l + $headerpr[$i];
					 
					 if ($headerpr[$i] > 0){
						 $ctmd ++;
					 }

			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],2,",",".") ."</font></td>" );
					}  
			}
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,2,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;

	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format(($total_l / $ctmd),2,",",".") ."</font></td>" );
	          echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>" . $unid ."</font></td>" );

              $ctmd = 0;
			  			  
              echo("</tr>");
	  		 $total_l = 0;

			  }
		 for ($i=0;$i < 15; $i++) {
			     $headerpr[$i] = 0.00; }

	  	  $headerpr[$row['mes']  ] = $row['kg_realizado'];
		  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;
          $unid = $row['unid_mat'];

         $nomei = $row['descr_prod'];

		  }
		  // print_r($header);
         }
	

	
		      echo('<tr>');
		  	  for ($i=0;$i < 13; $i++) {
			       if($i < 1){
			         echo("<td align='left'><font size=1 face='Arial, Helvetica, sans-serif'>" . $headerpr[$i] ."</b></font></td>" );
				   }
				   else{
   				     $total_l = $total_l + $headerpr[$i];
			 
					 if ($headerpr[$i] > 0){
						 $ctmd ++;
					 }

			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],2,",",".") ."</font></td>" );
					}  
				   
			  }
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,2,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format(($total_l / $ctmd),2,",",".") ."</font></td>" );
              $ctmd = 0;
              echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>" . $unid ."</font></td>" );

///////////////////
              echo("</tr>");
			  
      echo('<tr  bgcolor="#E8E8E8">');
 		 $ini_lin  = "['";
		 $meio_lin = "";
		 $fim_lin  = "]";
		 $lingr = "";
		 $itensgr = "";

	  
		  	  for ($i=0;$i < 14; $i++) {
			       if($i < 1){
			         echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>T o t a i s  </b></font></td>" );
				   }
				   else{
					   if ($i < 13){
					     $anoi = $row['ano'];	
					     $ini_lin  = "['" . $cabec[$i] . "',"; 		
					     $meio_lin = $totalprod[$i] ;		  
   			   		     $lingr = $lingr . $ini_lin . $meio_lin . $fim_lin . ",";
						  if($totalprod[$i] > 0){
							  $ctmd ++;
						  }
						 
					   }		   
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($totalprod[$i],2,",",".") ."</font></td>" );
					}  
				   
			  }
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format(($totalprod[13] / $ctmd),2,",",".") ."</font></td>" );


?>
  </tr>

</table>


<br />  

  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'Total Produzido'],
               <?php echo($lingr); ?>
        ]);


        var options = {
          title : 'Totais Produzidos por Mês - ',
          vAxis: {title: 'Totais'},
          hAxis: {title: 'Ano  <?php echo($anodf); ?>  ' },
          seriesType: 'bars',
		  		  chartArea: { width: '48%' },
				  legend: { position: "none" },
            colors: ['#1b9e77', '#d95f02', '#7570b3', '#7570b3', '#7570b3'],
			 'is3D':true,
  'width':500,
  'height':180,
			      fontSize: 12,
		          fontScale: 15,
          series: {2: {type: 'line'}}
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));
       chart.draw(data, google.charts.Bar.convertOptions(options));

      }
	  ///////////////////////////////////////////////////

	  /////////////////////////////////////////////////
    </script>
 


 </table>     
 <center>
 <table width="70%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <th  align="center" id="chart_div">
  </th>

</tr>
</table>
  </center>
</form>
</body>
</html>
