<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/> 
 <?php 

$data=date("d/m/Y");
//echo $data;
$anots = date("Y");
echo $ano;

// Abre ou cria o arquivo data.txt
// "a" representa que o arquivo ? aberto para ser escrito
//$fp = fopen("data.xml", "w");

// Escreve "exemplo de escrita" no bloco1.txt
//$escreve = fwrite($fp, "<?xml version='1.0' encoding='UTF-8'" ."\n");
//$escreve = fwrite($fp, "<pie>" ."\n");

include 'conectabco.php';

function formata_data1($data)  
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
//--------------------------------------parametros de consulta--------------------------------------------
$p0 = '';
$p1 = '';
$p2 = '';
$p3 = '';
$p4 = '';
$p5 = '';
/*
 $a = $_GET ["id_consult"];
 $b = $_GET ["data_i"];
 $c = $_GET ["data_f"];
 $d = $_GET ["id_produto"];
 $e = $_GET ["tipo"];

  
$cons1=explode(";",$_GET ["id_consult"]); */
	 
//----------------------------------------------------------------------------------------------------------------------

$p11 = "";
$p1 = " and year(a.data_pr) = '".$ano."'";
$p11 = " and year(a.data_fat) = '".$ano."'";

$p2 = "";
$p33 = "";
if ($cod_prod != "") {
   $p2 = " and a.cod_prod = '". $cod_prod . "'"; }
$p3 = "";
if($mes != ""){
  $p3 = " and month(a.data_pr) = '" .$mes ."'";	
  $p33 = " and month(a.data_fat) = '" .$mes ."'";	

}
$p4 = "";
$p5 = "  order by a.data_pr limit 60" ; //limit 0,3";     

  
$rs0 = mysql_query("select a.cod_prod,b.descr_prod, sum(a.kg_previsto) kg_previsto, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prod = b.cod_prod
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . "group by a.cod_prod , month(data_pr) , year(data_pr) order by a.cod_prod,ano,mes ");

$rs1 = mysql_query("select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prodr = b.cod_prod
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . " and a.lote_realizado <> '' group by a.cod_prod , month(data_pr) , year(data_pr) order by a.cod_prod,ano,mes ");
/*
echo("select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prodr = b.cod_prod
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . " and a.lote_realizado <> '' group by a.cod_prod , month(data_pr) , year(data_pr) order by a.cod_prod,ano,mes ");				
*/
/*echo("select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prodr = b.cod_prod
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . " and a.lote_realizado <> '' group by a.cod_prod , month(data_pr) , year(data_pr) order by b.descr_prod,ano,mes ");
echo("SELECT id_prevprod,
                   a.cod_prod, b.descr_prod,a.ano,a.prev1,a.prev2,a.prev3,a.prev4,a.prev5,a.prev6,a.prev7
                  ,a.prev8,a.prev9,a.prev10,a.prev11,a.prev12
                  FROM tb_prevprod a
                  inner join tb_produto b on a.cod_prod = b.cod_prod
                  where a.id_prevprod > 0 and a.ano = " . $ano ." order by b.descr_prod");
					
*/



$rs100 = mysql_query("SELECT id_prevprod,
                   a.cod_prod, b.descr_prod,a.ano,a.prev1,a.prev2,a.prev3,a.prev4,a.prev5,a.prev6,a.prev7
                  ,a.prev8,a.prev9,a.prev10,a.prev11,a.prev12
                  FROM tb_prevprod a
                  inner join tb_produto b on a.cod_prod = b.cod_prod
                  where a.id_prevprod > 0 and a.ano = " . $ano .$p2.  " order by a.cod_prod");



/*echo("select b.descr_prod, year(a.data_fat) ano, month(a.data_fat) mes, sum(a.volume) volume, a.cod_prod
                    from tb_mvvend a
       inner join tb_produto b on a.cod_prod = b.cod_prod
	   inner join tb_prevprod c on a.cod_prod = c.cod_prod	   
       where a.id_venda > 0 " . $p11 . $p33 . "
       group by year(a.data_fat), month(a.data_fat),b.descr_prod
       order by  year(a.data_fat),a.cod_prod,month(a.data_fat)");	
	   
	   
*/	   

	   
	   
  $rs3 = mysql_query("select b.descr_prod, year(a.data_fat) ano, month(a.data_fat) mes, sum(a.volume) volume, a.cod_prod
                    from tb_mvvend a
       inner join tb_produto b on a.cod_prod = b.cod_prod
       where a.id_venda > 0 " . $p11 . $p33 . "
	   and a.cod_prod < 800000 " .$p2 .$p33. "
       group by year(a.data_fat), month(a.data_fat),b.descr_prod
       order by  year(a.data_fat),a.cod_prod,month(a.data_fat)");	     
	   



	$totalprod = array();
	$cabecpr = array();
	$headerpr = array();
	
	$cabecpr[0] = "Produto";
	$x = 1;
		  
    for ($i = 0; $i < 14; $i++){
	      $headerpr[$i] = 0; }  
	
	for ($i = 0; $i < 15; $i ++){
	      $totalprod[$i] = 0.00 ; }
	
	$i = 1;
	$cabec[0] = "Produto";
	$cabec[1] = "Janeiro";
	$cabec[2] = "Fevereiro";
	$cabec[3] = "Mar?o";
	$cabec[4] = "Abril";
	$cabec[5] = "Maio";
	$cabec[6] = "Junho";
	$cabec[7] = "Julho";
	$cabec[8] = "Agosto";
	$cabec[9] = "Setembro";
	$cabec[10] = "Outubro";
	$cabec[11] = "Novembro";
	$cabec[12] = "Dezembro";
	$cabec[13] = "Total";

  
 
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="../css/qreal.css">

<head>
<meta http-equiv="Page-Enter" content="revealTrans(Duration=1.0,Transition=23)" />

<script>
//window.moveTo(0,0);
//window.scroll(0,0);
</script>
<title>Consulta producao</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body background="imagens/fundoriscadiagonal.gif"  id="top" >

<table width="100%">
<tr>
    <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
    <th align="center" ><h2>Previs&atilde;o de Produc&atilde;o / Vendas</h2></th>
    <th align="right" >
    <img src="../imagens/tecladoclaro.png" >
    <a href="menu_prevprod.php"><img src="../images/back_f2.png" width="32" height="32" border="0" /></a><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
  </tr>
</table>

<br />
<table border = 0 width="100%">
<tr align="center">
<td>
  <table width="100%" border="1" cellspacing="0"  align="left"  >
    <tr><td colspan = 14>
    <font size="3" face="Arial, Helvetica, sans-serif">Volume previsto de produção em Kg por Ano
	<?php echo($ano);?>	</font>
    </td></tr>
	<?php  
		$cabec2[1] = "Nome";

		 echo('<tr align="center" bgcolor="#3B5998" style="color: #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
');
         $i = 0;
  	     for($i=0;$i<14;$i++){   
              echo('<td align="center" ><font size="1" face="Arial, Helvetica, sans-serif">' .$cabec[$i]  .'</font></td>');  
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
		 while($row=mysql_fetch_assoc($rs0)){
  	         $totalprod[$row['mes'] ] =  $totalprod[$row['mes'] ] + $row['kg_previsto'];
			 
          if ($nomei == $row['descr_prod'] ){
		  	  $headerpr[$row['mes']  ] = $row['kg_previsto'];
			  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;
			  
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

			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],0,",",".") ."</font></td>" );
					}  
			}
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,0,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;
			  			  
              echo("</tr>");
	  		 $total_l = 0;

			  }
		 for ($i=0;$i < 15; $i++) {
			     $headerpr[$i] = 0.00; }

	  	  $headerpr[$row['mes']  ] = $row['kg_previsto'];
		  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;


         $nomei = $row['descr_prod'];

		  }
		  // print_r($header);
         }
	
		  		 if($bg == 1){
			    	    $bgc = "bgcolor=#FFFFFF";  $bg = 0;}
				  else{ $bgc = ""; $bg = 1;}
		  
		       echo('<tr ' . $bgc .' >');

	
		  	  for ($i=0;$i < 13; $i++) {
			       if($i < 1){
			         echo("<td align='left'><font size=1 face='Arial, Helvetica, sans-serif'>" . $headerpr[$i] ."</b></font></td>" );
				   }
				   else{
   				     $total_l = $total_l + $headerpr[$i];
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],0,",",".") ."</font></td>" );
					}  
				   
			  }
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,0,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;
///////////////////
              echo("</tr>");
			  
      echo('<tr  bgcolor="#E8E8E8">');
		  	  for ($i=0;$i < 14; $i++) {
			       if($i < 1){
			         echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>T o t a i s  </b></font></td>" );
				   }
				   else{
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($totalprod[$i],0,",",".") ."</font></td>" );
					}  
				   
			  }

////////// totais das colunas

			  
			  
		//	  echo("</tr></table>");

?>
  </tr>

</table>
<!----------------------------------------------------------->
</td>
</tr>
<tr>
<td>
 <table width="100%" border="1" cellspacing="0"  align="left"  background="../imagens/fundoriscadiagonal.gif" >
    <tr><td colspan="14"><font size="3" face="Arial, Helvetica, sans-serif">Volume realizado de produção em Kg por Ano
	<?php echo($ano);?>	</font></td></tr>
	
	<?php  

	for ($i = 0; $i < 15; $i ++){
	      $totalprod[$i] = 0.00 ; }
	

		$cabec2[1] = "Nome";

		 echo('<tr align="center" bgcolor="#3B5998" style="color: #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
 ');
         $i = 0;
  	     for($i=0;$i<14;$i++){   
              echo('<td align="center" ><font size="1" face="Arial, Helvetica, sans-serif">' .$cabec[$i]  .'</font></td>');  
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
		 while($row=mysql_fetch_assoc($rs1)){
  	         $totalprod[$row['mes'] ] =  $totalprod[$row['mes'] ] + $row['kg_realizado'];
			 
          if ($nomei == $row['descr_prod'] ){
		  	  $headerpr[$row['mes']  ] = $row['kg_realizado'];
			  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;
			  
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

			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],2,",",".") ."</font></td>" );
					}  
			}
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,2,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;
			  			  
              echo("</tr>");
	  		 $total_l = 0;

			  }
		 for ($i=0;$i < 15; $i++) {
			     $headerpr[$i] = 0.00; }

	  	  $headerpr[$row['mes']  ] = $row['kg_realizado'];
		  $headerpr[0] = $row['cod_prod'] . " - " . $row['descr_prod'] ;


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
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($headerpr[$i],2,",",".") ."</font></td>" );
					}  
				   
			  }
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,2,",",".") ."</font></td>" );
  	         $totalprod[13] =  $totalprod[13] + $total_l;
///////////////////
              echo("</tr>");
			  
      echo('<tr  bgcolor="#E8E8E8">');
		  	  for ($i=0;$i < 14; $i++) {
			       if($i < 1){
			         echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>T o t a i s  </b></font></td>" );
				   }
				   else{
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($totalprod[$i],2,",",".") ."</font></td>" );
					}  
				   
			  }

////////// totais das colunas

			  
			  
	//		  echo("</tr></table>");


?>
  </tr>

</table>
<!----------------------------------------------------------->
</td>
</tr>
<tr>
<td>

  <table width="100%" border="1" cellspacing="0"  align="left"  background="../imagens/fundoriscadiagonal.gif" >
      <tr>
        <td colspan="14"><font size="3" face="Arial, Helvetica, sans-serif">
 Previs&atilde;o de Vendas para o Ano : <?php echo($ano);?></font></td></tr>
     <tr align="center" bgcolor="#3B5998" style="color: #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">

              <!--td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Ano</font></td -->

        <td align="center" ><font size="1" face="Arial, Helvetica, sans-serif">Produto</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Janeiro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Fevereiro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Mar?o</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Abril</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Maio</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Junho</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Julho</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Agosto</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Setembro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Outubro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Novembro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Dezembro</font></td>
        <td align="center"><font size="1" face="Arial, Helvetica, sans-serif">Total</font></td>
      </tr>
      
          <?php 
		  $tot = 0;
		  $totalc1 = 0;
		  $totalc2 = 0;
		  $totalc3 = 0;
		  $totalc4 = 0;
		  $totalc5 = 0;
		  $totalc6 = 0;
		  $totalc7 = 0;
		  $totalc8 = 0;
		  $totalc9 = 0;
		  $totalc10 = 0;
		  $totalc11 = 0;
		  $totalc12 = 0;
		  $totalc13 = 0;
		  $xx=10;
		  $aa = 'prev';
		  while($row=mysql_fetch_array($rs100)){ 
//s		  echo($row[$aa.$xx]);
		  $tot = $tot + $row['prev1'] + $row['prev2'] + $row['prev3'] + $row['prev4'] + $row['prev5'] + $row['prev6'] +
		                $row['prev7'] + $row['prev8'] + $row['prev9'] + $row['prev10'] + $row['prev11'] + $row['prev12'];
		  $totalc1 = $totalc1 + $row['prev1'];			
		  $totalc2 = $totalc2 + $row['prev2'];			
		  $totalc3 = $totalc3 + $row['prev3'];			
		  $totalc4 = $totalc4 + $row['prev4'];			
		  $totalc5 = $totalc5 + $row['prev5'];			
		  $totalc6 = $totalc6 + $row['prev6'];			
		  $totalc7 = $totalc7 + $row['prev7'];			
		  $totalc8 = $totalc8 + $row['prev8'];			
		  $totalc9 = $totalc9 + $row['prev9'];			
		  $totalc10 = $totalc10 + $row['prev10'];			
		  $totalc11 = $totalc11 + $row['prev11'];			
		  $totalc12 = $totalc12 + $row['prev12'];			
		  $totalc13 = $totalc13 + $tot;		
		  
  		 if($bg == 1){
	    	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
		  else{ $bgc = ""; $bg = 1;}	
		  
       echo('<tr ' . $bgc .' >');

						
		  ?>
     
            <!--td align="left" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php //echo $row['ano']?></font></td -->
<td align="left" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo $row['cod_prod'] . ' - ' . $row['descr_prod']?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev1'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev2'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev3'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev4'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev5'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev6'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev7'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev8'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev9'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev10'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev11'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($row['prev12'],0,",",".");?></font></td>
      <td align="right" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($tot,0,",",".");?></font></td>
      
     </tr>


<?php 
     $tot = 0;
}?>
    <tr> 
      <td  align="center" bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif"><strong>T o t a i s </strong></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc1,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc2,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc3,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc4,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc5,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc6,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc7,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc8,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc9,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc10,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc11,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc12,0,",",".")?></font></td>
      <td align="right" bgcolor="#CCCCCC" ><font size="1" face="Arial, Helvetica, sans-serif"> <?php echo number_format($totalc13,0,",",".")?></font></td>
      
     </tr>


   </table>

<!----------------------------------------------------------->
</td>
</tr>
<tr>
<td>
<?php
	for ($i = 0; $i < 15; $i ++){
	      $totalprod[$i] = 0.00 ; }
	
	$i = 1;
	$cabec[0] = "Ano";
	$cabec[1] = "Janeiro";
	$cabec[2] = "Fevereiro";
	$cabec[3] = "Mar?o";
	$cabec[4] = "Abril";
	$cabec[5] = "Maio";
	$cabec[6] = "Junho";
	$cabec[7] = "Julho";
	$cabec[8] = "Agosto";
	$cabec[9] = "Setembro";
	$cabec[10] = "Outubro";
	$cabec[11] = "Novembro";
	$cabec[12] = "Dezembro";
	$cabec[13] = "Total";

	$header2  = array();
    $cabec2    = array();
	$cabec2[0] = "Ano";
	$cabec2[1] = "Produto";
	$cabec2[2] = "Janeiro";
	$cabec2[3] = "Fevereiro";
	$cabec2[4] = "Mar?o";
	$cabec2[5] = "Abril";
	$cabec2[6] = "Maio";
	$cabec2[7] = "Junho";
	$cabec2[8] = "Julho";
	$cabec2[9] = "Agosto";
	$cabec2[10] = "Setembro";
	$cabec2[11] = "Outubro";
	$cabec2[12] = "Novembro";
	$cabec2[13] = "Dezembro";
	$cabec2[14] = "Total";
	
?>
<!----------------------------------------------totais produtos por volume de vendas---------------------------------------------------->
<!----------------------------------------------------------->
</td>
</tr>
<tr>
<td>
  <table width="100%" border="1" cellspacing="0"  align="left"  background="../imagens/fundoriscadiagonal.gif" >
    <tr><td colspan="14">
    <font size="3" face="Arial, Helvetica, sans-serif">Realizado volume de vendas no ano :<?php echo($ano);?>
	  </font>
    </td></tr>
		<?php  
	
		 echo('<tr align="center" bgcolor="#3B5998" style="color: #FFF; font-weight: bold; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
');
         $i = 0;
  	     for($i=1;$i<15;$i++){   
              echo('<td align="center" ><font size="1" face="Arial, Helvetica, sans-serif">' .$cabec2[$i]  .'</font></td>');  
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
		 $prodi = '';		 		 
		 $header2 = array();
		 
		 for ($i=0;$i < 15; $i++) {
			     $header2[$i] = 0.00; }
		 
		 while($row=mysql_fetch_assoc($rs3)){
	         $totalprod[$row['mes'] + 1 ] = $totalprod[$row['mes'] + 1 ] + $row['volume'];	 

// faz somatorio das colunas ////////////////
		if($anoi == $row['ano']){
		    // $totalprod[0] = $row['ano'];
		     $totalprod[1] = "T O T A I S ";
	//	     $totalprod[$row['mes'] + 1 ] = $totalprod[$row['mes'] + 1 ] + $row['volume'];			
        }
/////////////////////////////////////////////

          if ($prodi == $row['descr_prod'] ){
		  	  $header2[$row['mes'] + 1 ] = $row['volume'];
			  //$header2[0] = $row['ano'];
			  $header2[1] = $row['cod_prod'] . ' - ' .$row['descr_prod'];
			  
    	  }else{  

		  		if($bg == 0){
			    	    $bgc = "bgcolor=#FFFFFF";  $bg = 1;
						}
				  else{ $bgc = ""; $bg = 0;}
		  
		if ($prodi != $row['descr_prod'] and $header2[0] != 0){
		    echo('<tr ' . $bgc .' >');
		  	for ($i=1;$i < 14; $i++) {
			       if($i < 2){
			         echo("<td align='left'><font size=1 face='Arial, Helvetica, sans-serif'>" . $header2[$i] ."</font></td>" );
					 $ano_s =  $header2[$i] ;//.",";
					 }
				   else{
				     $total_l = $total_l + $header2[$i];
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($header2[$i],0,",",".") ."</font></td>" );
					}  
			}
	        echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,0,",",".") ."</font></td>" );
            $ano_v = $ano_v . number_format($total_l,2,",",".") ."|"; 
	        echo("</tr>");
		    $total_l = 0;

		    for ($i=2;$i < 15; $i++) {
			     $header2[$i] = 0.00; }

		}
		 for ($i=2;$i < 15; $i++) {
			     $header2[$i] = 0.00; }

// imprime totais das colunas /////////////////////////////		
		if($anoi != $row['ano']  and $totalprod[0] != 0){
	        echo("<tr bgcolor='#FFC2A6'>");

		    $total_l2 = 0.00;
		  	for ($i=1;$i < 14; $i++) {
			       if($i < 2){
			         echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>" . $totalprod[$i] ."</font></td>" );
					 }
				   else{
				     $total_l2 = $total_l2 + $totalprod[$i];
			         echo("<td align='right'><b><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($totalprod[$i],0,",",".") ."</font></td>" );
					}  
			}
	        echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l2,0,",",".") ."</font></b></td>" );
	        echo("</tr>");
		    $total_l2 = 0;
		    for ($i=2;$i < 15; $i++) {
			     $totalprod[$i] = 0.00; }
      //  $totalprod[$row['mes'] + 1 ] = $totalprod[$row['mes'] + 1 ] + $row['volume'];	 
		}     

////////////////////////////////////////////////////////////////////
		 $anoi = $row['ano'];
         $prodi = $row['descr_prod'];
  		 $header2[$row['mes'] + 1] = $row['volume'];
		 $header2[$row['mes'] + 1 ] = $row['volume'];
	     $header2[0] = $row['ano'];
		 $header2[1] = $row['cod_prod'] . ' - ' .$row['descr_prod'];
		 
		  }
		  // print_r($header);
         }
       if($bg == 0){
    	    $bgc = "bgcolor=#FFFFFF";  $bg = 1;
		}
 	  else{ $bgc = ""; $bg = 0;}
	  
		    echo('<tr ' . $bgc .' >');
		 for ($i=1;$i < 14; $i++) {
			       if($i < 2){
			         echo("<td align='left'><font size=1 face='Arial, Helvetica, sans-serif'>" . $header2[$i] ."</font></td>" );
					 $ano_s = $header2[$i] ;}

				   else{
   				     $total_l = $total_l + $header2[$i];
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($header2[$i],0,",",".") ."</font></td>" );
					}  
			  }
	          echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l,0,",",".") ."</font></td>" );
              $ano_v = $ano_v . number_format($total_l,2,",","."); 
              $ano_e = $ano_e . $total_l; 

              echo("</tr>");
			  
// imprime totais das colunas /////////////////////////////		
		if($anoi != $row['ano'] ){
	        echo("<tr bgcolor='#CCCCCC'>");

		    $total_l2 = 0.00;
			//$totalprod[0] = "";
            //$totalprod[0] = $anoi;
		  	for ($i=1;$i < 14; $i++) {
			       if($i < 2){
			         echo("<td align='center'><font size=1 face='Arial, Helvetica, sans-serif'>" . $totalprod[$i] ."</font></td>" );
					 }
				   else{
				     $total_l2 = $total_l2 + $totalprod[$i];
			         echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($totalprod[$i],0,",",".") ."</font></td>" );
					}  
			}
	        echo("<td align='right'><font size=1 face='Arial, Helvetica, sans-serif'>" . number_format($total_l2,0,",",".") ."</font></td>" );
	        echo("</tr>");
		    $total_l2 = 0;
		    for ($i=2;$i < 15; $i++) {
			     $totalprod[$i] = 0.00; }
		}     
////////////////////////////////////////////////////////////////////
			  
   ?>
   
  </tr>
</table>
<!----------------------------------------------------------->
</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>
</center>
</body>
</html>
