 <meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
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
    $p1 = " and year(a.data_pr) = '" . $anodf ."'";
	
	
if($mes_i > 0){
	$p2 = " and month(a.data_pr) = '" .$mes_i ."'";
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
	$cabec[1] = "Janeiro";
	$cabec[2] = "Fevereiro";
	$cabec[3] = "Março";
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
header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';
mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");




$rs2 = mysql_query("select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel,
                    month(data_pr) mes, year(data_pr) ano
                    from tb_producao a
                    inner join tb_produto b on a.cod_prodr = b.cod_prod
                    where a.cod_prod > 0 ".$p1 . $p2 .$p3 . " and a.lote_realizado <> '' group by a.cod_prod , 
					month(data_pr) , year(data_pr) order by a.cod_prod,ano,mes ");
					
					
					

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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>matpcm011 - Producao mensal de produtos acabados</title>
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
        <th  align="center"><h3>Producão Mensal de Produtos Acabados - Ano de Referencia : <?php echo($anodf); ?> </h3></th>
        <th align="right">
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        <img src="../imagens/tecladoclaro.png" ><a href="menu_exped.php"><img src="../images/back_f2.png" width="32" height="32" border="0" alt="Voltar ao menu" /></a></th>
      </tr>
      </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >

  <tr>
    <th  align="center" valign="top" >Mes : <select name="mes_i"  cl class="search-input3">
            <option value="0">Selecione o Mes </option>
            <option value="1">Janeiro</option>            
            <option value="2">Fevereiro</option>            
            <option value="3">Marco</option>            
            <option value="4">Abril</option>            
            <option value="5">Maio</option>            
            <option value="6">Junho</option>            
            <option value="7">Julho</option>            
            <option value="8">Agosto</option>            
            <option value="9">Setembro</option>            
            <option value="10">Outubro</option>            
            <option value="11">Novembro</option>            
            <option value="12">Dezembro</option>            
            </select>     </th>
  <th  align="center" valign="top">Ano: <input type="text" name="ano_i" maxlength="4" size="6" onChange="document.form1.submit();"  class="search-input2" /></th>
    <th  align="center" valign="top"><input type="submit" name="button" id="button" value="Filtrar" class="search-submit"/></th>
  </tr>
  </table>

 <table width="100%" border="1" cellspacing="0"  align="left"  background="../imagens/fundoriscadiagonal.gif" >
   
	
	<?php  

	for ($i = 0; $i < 15; $i ++){
	      $totalprod[$i] = 0.00 ; }
	

		$cabec2[1] = "Nome";

		 echo('<tr align="center" bgcolor="#003366"  style=" font-size: 12px;">
 ');
         $i = 0;
  	     for($i=0;$i<14;$i++){   
              echo('<td align="center" ><font size="1" color="#FFFFFF"  face="Arial, Helvetica, sans-serif">' .$cabec[$i]  .'</font></td>');  
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
		 while($row=mysql_fetch_assoc($rs2)){
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
  </center>
      
</form>
</body>
</html>
