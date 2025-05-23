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
    $p1 = " and year(a.data_nf) = '" . $anodf ."'";
	
	
if($mes_i > 0){
	$p2 = " and month(a.data_nf) = '" .$mes_i ."'";
}
	
    $cabec   = array();
	$header  = array();
	$header2  = array();
	
	$resumo  = array();

	 $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $resumo[$i] = ""; 
     }
	
	$cabec[0] = "Codigo";
	$cabec[1] = "Produto";	
	$cabec[2] = "Janeiro";
	$cabec[3] = "Fevereiro";
	$cabec[4] = "Março";
	$cabec[5] = "Abril";
	$cabec[6] = "Maio";
	$cabec[7] = "Junho";
	$cabec[8] = "Julho";
	$cabec[9] = "Agosto";
	$cabec[10] = "Setembro";
	$cabec[11] = "Outubro";
	$cabec[12] = "Novembro";
	$cabec[13] = "Dezembro";
	$cabec[14] = "Total";
	$cabec[15] = "Media";
	$cabec[16] = "Saldo";
	$cabec[17] = "Und";
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

SELECT a.cod_prod,b.descr_prod, year(a.data_nf) ano, month(a.data_nf) mes ,
sum(a.quantid) tt_mes FROM tb_saidaprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
group by a.cod_prod, year(a.data_nf), month(a.data_nf)
order by year(a.data_nf) desc,a.cod_prod, month(a.data_nf)


*/
header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';
mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

if ($p != 99){
	//$a = $_GET ["S"];
}

$rs_tmp = "create table tmp_saldoprdac as (SELECT a.cod_prod, sum(tt_lote) saldo_prodac
			FROM tv_saldoltprac a
			group by a.cod_prod
			order by a.cod_prod)";

$tmp =  mysql_query( $rs_tmp );		 
					
$rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod, year(a.data_nf) ano, month(a.data_nf) mes ,
					sum(a.quantid) tt_mes, a.unidade ,c.saldo_prodac FROM tb_saidaprodac a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					left outer join tmp_saldoprdac c on a.cod_prod = c.cod_prod
					where a.cod_prod > 0 " . $p1 . $p2 ."
					group by a.cod_prod, year(a.data_nf), month(a.data_nf)
					order by year(a.data_nf)  desc,a.cod_prod, month(a.data_nf) ");	
						
$rs_del = "drop table tmp_saldoprdac ";					   
$tmp =  mysql_query( $rs_del );						 

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
 <title>matpacm01 - Saidas Mensais de Produtos Acabados</title>
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
<table width="100%" border="1" cellspacing="0"   align="center"   >
  <tr>
     <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
   <th align="center"><h3>Saidas Mensais de Produtos Acabados - Ano de Referencia : <?php echo($anodf); ?> </h3></th>
    <th   align="right" valign="top">
    <img src="../imagens/tecladoclaro.png"  /> 
        <a href="menu_exped.php">
 <img src="../images/back_f2.png" width="32" height="32" border="0" alt="Voltar ao menu" /> </a>
    
    <b><?php echo($_SESSION['id_consultlg'] . " - " . $_SESSION['nome_usu']); ?></b>
     
      </th>
  </tr>
  </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >
  
  <tr>
    <th  align="center" valign="top" >Mes : <select name="mes_i"  style="font-size:12">
            <option value="0">Selecione o Mes </option>
            <option value="1">Janeiro</option>            
            <option value="2">Fevereiro</option>            
            <option value="3">Março</option>            
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
  <th  align="center" valign="top">Ano: <input type="text" name="ano_i" maxlength="4" size="6" onChange="document.form1.submit();" /></th>
    <th  align="center" valign="top"><input type="submit" name="button" id="button" value="Filtrar" /></th>
  </tr>
  </table>
 <center>
</center>
    <table width="100%"  border="1" >
     <?php 
	// $bg=1;
	 $cd_prod = 0;
	 $i = 0;
	 for ($i=0;$i < 18; $i++) {
	     $header2[$i] = ''; 
     }
	 $i = 0;
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<18;$i++){   
              echo('<th>' .$cabec[$i]  .'</th>');  
         }
	 echo('</tr>');
	$bg = 0; 
	$totv = 0;
	$tots = 0;
	$ttcli = 0;
	$ttm = 0;
	 while($row=mysql_fetch_array($rs2)){ 
			  
			  
	   //echo('<tr ' . $bgc .'>');
       if ( $row['cod_prod']	!= $cd_prod){
		  ++ $ttcli ; 		  
          if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
    	  echo('<tr ' . $bgc .'>');

	      if ($ttm > 0){
			  $header2[15] = number_format(($totv / $ttm),3,",",".");
			  $header2[14] = number_format(($totv),0,",",".");
		  
			  //$header2[15] = 'Kg';
			  }
		  else { $header2[15] = '';}
		  
	   	  for ($i=0;$i < 18; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  echo("<th" . $alg . ">" . $header2[$i] ."</th>" );
    		 }
	   
	   /// zera tabela
	   	 for ($i=0;$i < 18; $i++) {
	        $header2[$i] = ''; 
            $ttm = 0;          
			$totv = 0;
		 }
		 echo("</tr>");
	  }
	  $header2[0] = $row['cod_prod'] ;
	  $header2[1] = $row['descr_prod'];  
	  $header2[16] = number_format(($row['saldo_prodac']),0,",",".");
	  $header2[17] = $row['unidade'];      
	  $header2[$row['mes']+1] = number_format($row['tt_mes'],0,",",".");
	  $ttm++;
	  $totv = $totv +  $row['tt_mes'];
	   $cd_prod = $row['cod_prod'];
      
	 }	
     if($bg == 1){
	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
	  else{ $bgc = ''; $bg = 1;}	

	   echo('<tr ' . $bgc .'>');
   	   if ($ttm > 0){
		   	  $header2[14] = number_format(($totv),0,",",".");
	          $header2[15] = number_format(($totv / $ttm),3,",",".");
      }
	  	          //$header2[15] = $row['unidade'];      

	   for ($i=0;$i < 18; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  echo("<th" . $alg . " >" . $header2[$i] ."</th>" );
			 }
	 
	 	//$ttcli ++;
		 echo("</tr>");
	 
      ?>    
     
  </table>
  </center>
      
</form>
</body>
</html>
