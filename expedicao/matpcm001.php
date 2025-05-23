<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<?php

/*
    ///////////// Media de saida de matéria prima por ano ////////////////////////

		$rs_del = "drop table tmp_mediasaida ";					   
		$tmp =  mysql_query( $rs_del );

		$rs_tmp1 = "create table tmp_mediasaida as 
		           (select a.cod_prod,max(year(a.data_saida)) ano_saida, 
		                  sum(a.quantid_said) total_saida,avg(a.quantid_said) media_ano,
						  b.unid_mat
						from tb_saidmatp a
						inner join tb_produto b on a.cod_prod = b.cod_prod
						group by a.cod_prod)";
							
		$tmp =  mysql_query( $rs_tmp );

  ///////////////////////////////////////////////////////////////////////////////
 */



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
if(isset($codigo_x) && $codigo_x > 0 ){
    $codigo_x = str_replace("'", "", $codigo_x);	
    $p01 = " and a.cod_prod = '" . $codigo_x ."'";
}

		 
if (isset($descricao2)){
	if ($descricao2 <> "" ){
		 $descricao2 = str_replace("'", "", $descricao2);
		 $p02 = " and b.descr_prod like '%" . $descricao2 ."%'" ; 
		 }}
  $p33 = "";
  $p34 = "";
if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p33 = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
	 }
else{
	$p1 = " and year(a.data_saida) = '" . $anodf ."'";
 }
}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p34 = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 }}
		 
if(isset($ano_i) && $ano_i > 0 ){
	//$anodf = $ano_i; 
    $p1 = " and year(a.data_saida) = '" . $ano_i ."'";
}	
	
if($mes_i > 0){
	$p2 = " and month(a.data_saida) = '" .$mes_i ."'";
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
	
	$cabec[0] = "Codigo / Grupo";
	$cabec[1] = "Produto";	
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
	$cabec[16] = "Saldo";
	$cabec[17] = "Pto_min";
	$cabec[18] = "Unid";
	$cabec[19] = "Meses Suprimento";

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

$meses = array (1 => "Jan", 2 => "Fev", 3 => "Mar", 4 => "Abr", 5 => "Mai", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Set", 10 => "Out", 11 => "Nov", 12 => "Dez");
$rs2a= mysql_query("select a.linha from tb_produto a where a.linha in ('m.primas','embalagem') group by a.linha");

if ($p != 99){
	//$a = $_GET ["S"];
}
if(isset($_POST["botao"])){
	
		$rs_tmp = "create table tmp_saldoprd as (SELECT a.cod_prod, sum(if(a.tt_saidalote is NULL,
		           a.tt_entradalote,(a.tt_entradalote - a.tt_saidalote))) saldo_prod 
				   FROM tv_ttsaidalote a
				   group by cod_prod
				   order by cod_prod )";
							
		$tmp =  mysql_query( $rs_tmp );
		
		//SELECT  year(a.data_saida) ano FROM tb_saidmatp a group by year(a.data_saida)
		
		if (isset($linha_prod)){
			if($linha_prod != ""){
				 $p02a = " and b.linha ='" . $linha_prod ."'" ;
			}
		}
		/*
echo("SELECT a.cod_prod,b.descr_prod,b.linha, year(a.data_saida) ano, month(a.data_saida) mes ,
							sum(a.quantid_said) tt_mes,b.saldo_prod, b.unid_mat,b.ponto_min FROM tb_saidmatp a
							inner join tb_produto b on a.cod_prod = b.cod_prod ". $p02 . $p02a . "
							left outer join tmp_saldoprd c on a.cod_prod = c.cod_prod
							where a.cod_prod > 0 " . $p01 . $p1 . $p2 . $p33 . $p34 ." and a.cod_prod not in (100010,100011,100012) 
							group by a.cod_prod, year(a.data_saida), month(a.data_saida)
							order by year(a.data_saida)  desc,a.cod_prod, month(a.data_saida) ");			 
			 
		*/
		$rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod,b.linha, year(a.data_saida) ano, month(a.data_saida) mes ,
							sum(a.quantid_said) tt_mes,b.saldo_prod, b.unid_mat,b.ponto_min FROM tb_saidmatp a
							inner join tb_produto b on a.cod_prod = b.cod_prod ". $p02 . $p02a . "
							left outer join tmp_saldoprd c on a.cod_prod = c.cod_prod
							where a.cod_prod > 0 " . $p01 . $p1 . $p2 . $p33 . $p34 ." and a.cod_prod not in (100010,100011,100012) 
							group by a.cod_prod, year(a.data_saida), month(a.data_saida)
							order by a.cod_prod, month(a.data_saida) ");			 
			 

		$rscons = mysql_query("select a.cod_prod,b.descr_prod, year(a.data_saida) ano,
							sum(a.quantid_said) consumo_ano,avg(a.quantid_said) media_cons,b.saldo_prod,b.ponto_min
							FROM tb_saidmatp a
							inner join tb_produto b on a.cod_prod = b.cod_prod ". $p02 . $p02a . " and b.ponto_min > 0
							left outer join tmp_saldoprd c on a.cod_prod = c.cod_prod
							where a.cod_prod > 0 " . $p01 . $p1 . $p2 . $p33 . $p34 .
							" and a.cod_prod not in (100010,100011,100012) 
							group by a.cod_prod, year(a.data_saida)
							order by consumo_ano desc,year(a.data_saida)  desc,a.cod_prod ");			 

		
		
		
		//$rs_del = "drop table tmp_saldoprd ";					   
		$tmp =  mysql_query( $rs_del );

}


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
$hoje = date("d/m/Y");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/qreal.css">
<!--link rel="stylesheet" href="../css/qreal2.css"-->


<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>matpcm001 - Consumo medio de materias primas</title>
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

<!--body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'-->

<body>

<META content="text/css" http-equiv="Content-Style-Type">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo( $_SESSION['nome_usu']); ?>
<form name="form1" method="post" enctype="multipart/form-data"> 

<input type="hidden" name="monen_res" value="-1" />

<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>Consumo Mensal de Materias-primas / Embalagens - Ano de Referencia : <?php echo($anodf); ?> - <?php echo($data_1); ?> a <?php echo($data_2); ?>  </h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><a href="menu_exped.php"><img src="../images/back_f2.png" width="32" height="32" border="0" alt="Voltar ao menu" /></a>
        <br /> <?php echo($hoje);?><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
      </tr>
      </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >

  <tr>
    <th  align="center" valign="top" >Código:
      <input type="text" name="codigo_x" maxlength="6" size="6"  class="search-input7" /></th>
    <th  align="center" valign="bottom" >Descrição:
    <input type="text" name="descricao2" maxlength="20" size="15"  class="search-input3" /> 
    Período: 
       <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_2);"/>
<select name="linha_prod"  onchange="atualiza();" class="search-input3">
        <option value="">Selecione a Linha</option>
        <?php while($row33a=mysql_fetch_assoc($rs2a)){ ?>
        <option value="<?php echo($row33a['linha']);?>"
				  <? if($row33a['linha'] == $linha_prod) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33a['linha']); ?></option>
        <?php }?>
      </select>
          
      Mes :
<select name="mes_i" class="search-input3" >
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
            </select>     </th>
  <th  align="center" >Ano: <input type="text" name="ano_i" maxlength="4" size="6"  class="search-input7" /></th>
    <th  align="center" valign="top"><input type="submit" name="botao"  value="Filtrar" class="search-submit2"  /></th>
  </tr>
  </table>

    <table width="100%"  border="0" cellpadding=0 cellspacing=0 >
     <?php 
	// $bg=1;
	 $cd_prod = 0;
	 $i = 0;
	 for ($i=0;$i < 19; $i++) {
	     $header2[$i] = ''; 
     }
	 $i = 0;
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<20;$i++){   
              echo('<th>' .$cabec[$i]  .'</th>');  
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
	   $ressupr = 0;
	   //echo('<tr ' . $bgc .'>');
       if ( $row['cod_prod']	!= $cd_prod){
		  ++ $ttcli ; 		  
          if($bg == 1){
			   	    $bgc = "bgcolor=#D9FFD9";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
    	  echo('<tr ' . $bgc .'>');
	      if ($ttm > 0){
  			  //$header2[14] = number_format(($totv),3,",",".");
	          $header2[14] = $totv;
	          
			  $header2[15] = ($totv / $ttm);
			  //$header2[17] = 'Kg';
		  }
		  else { $header2[15] = '';}
		  
		  if ( (float)$ptmim >  $sald){
			   $header2[18] =   $header2[18] . "<img src=../imagens/bola_vermelha.png>";
		  }
	  
	   	  for ($i=0;$i < 19; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if ($i>1 && $i<18 && $header2[$i] > 0){   
			     if ($i==17 && $header2[$i] > 0){ 
				    if ($cd_prod == '190105'){
						  $header2[17] = $header2[17] * 1000;
					}
			        echo("<th" . $alg . ">" . number_format($header2[$i],0,",",".") ."</th>" );
				 }else{
           			  if($i == 16 && $cd_prod == '190105'){
						   	echo("<th" . $alg . ">" . number_format($header2[$i]*1000,3,",",".") ."</th>" );}
                      else{
			                echo("<th" . $alg . ">" . number_format($header2[$i],3,",",".") ."</th>" );}
			         }
			  }else{
				 echo("<th" . $alg . ">" . $header2[$i] ."</th>" );    	    
			  }
    	  }
		  if (rtrim($row['linha']) == "M.PRIMAS" or $row['unid_mat'] != "UN"){

  			if ($row['unid_mat'] == "CM"){
				  $ttcol[16] = $ttcol[16] + ($row['saldo_prod'] );
				  $sald = ($row['saldo_prod'] );
				  $ptmin = $row['ponto_min'] ;
			}else{
				  $ttcol[16] = $ttcol[16] + ($row['saldo_prod'] / 1000);
				  $sald = ($row['saldo_prod'] / 1000);
				  $ptmin = $row['ponto_min'] / 1000;
			}

		  }else{
		      $ttcol[16] = $ttcol[16] + $row['saldo_prod'];
              $sald = $row['saldo_prod'] ;	
    		  $ptmin = $row['ponto_min'];
			  	  
		  }
	   
	      if ($header2[16] > 0 ){
			 if($header2[15] > 0 ) {
				 if ($cd_prod == '190105'){
						  $header2[16] = $header2[16] * 1000;
					}
				 
			     $ressupr = intval($header2[16] / $header2[15]);

				 
				 if ($ressupr < 1){
					 $ressupr = 0;
				 }				 
			 }
		  }
	   if($ressupr > 0 && $ressupr < 13){
  			$var_graf = $var_graf . "['".substr(trim($header2[1]),0,35). "'," . $ressupr. ",'" . $ressupr. "']," ;
	   }
	   /// zera tabela
	   	  for ($i=0;$i < 19; $i++) {
	        $header2[$i] = ''; 
            $ttm = 0;          
			$totv = 0;
		  }
		  echo("<th align=center>" . $ressupr . "</th");
		  
		 echo("</tr>");
	  }
	  $header2[0] = $row['cod_prod'] . " - " . $row['linha'];
	  $header2[1] = $row['descr_prod'] ;   
	  //$header2[17]= number_format(($row['ponto_min']),3,",",".");   

	  if (rtrim($row['linha']) == "M.PRIMAS" or $row['unid_mat'] != "UN"){
          if ($row['unid_mat'] == "CM"){
    	      $header2[17]= $row['ponto_min'] ;   
		  }else{
			  $header2[17]= $row['ponto_min'] / 1000;   }
	  }else {
    	  $header2[17]= $row['ponto_min'];   
	  }
	  $header2[18]= $row['unid_mat'];   
	  		
	  if (rtrim($row['linha']) == "M.PRIMAS" or $row['unid_mat'] != "UN"){
            if ($row['unid_mat'] == "CM"){
    		  $header2[16] = $row['saldo_prod']; }
			else{
			  $header2[16] = $row['saldo_prod']/1000; 	
			}
 	  }else{
    	  $header2[16] = $row['saldo_prod'];
	  }
	  
 	  $header2[$row['mes']+1] = $row['tt_mes'];
	 
	  $ttcol[$row['mes']+1] = $ttcol[$row['mes']+1] + $row['tt_mes'];
	  
	  $ttm++;
	  $totv = $totv +  $row['tt_mes'];
	  $cd_prod = $row['cod_prod'];
   }	

     if($bg == 1){
		$bgc = "bgcolor=#D9FFD9";  $bg = 0;}
	 else{ $bgc = ''; $bg = 1;}	

	 echo('<tr ' . $bgc .'>');
	   
   	   if ($ttm > 0){
  			  //$header2[14] = number_format(($totv),3,",",".");
	          $header2[14] = $totv;
	          
			  $header2[15] = ($totv / $ttm);
			  //$header2[17] = 'Kg';
			  }
	   	for ($i=0;$i < 19; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
    			  if ($i>1 && $i<18 && $header2[$i] > 0){   
					 if ($i==17 && $header2[$i] > 0){   
						echo("<th" . $alg . ">" . number_format($header2[$i],0,",",".") ."</th>" );
					 }else{
						echo("<th" . $alg . ">" . number_format($header2[$i],3,",",".") ."</th>" );}
				  }else{
					 echo("<th" . $alg . ">" . $header2[$i] ."</th>" );    	    
			  	  }
		}
	 
	 	//$ttcli ++;
	$ressupr = 0;
	    if ($header2[16] > 0 ){
			 if($header2[15] > 0 ) {
			     $ressupr = intval($header2[16] / $header2[15]);
				 if ($ressupr < 1){
					 $ressupr = 0;
				 }				 
			 }
		  }
	   
	   
	   /// zera tabela
	   
	    if($ressupr > 0 && $ressupr < 13 ){
  			$var_graf = $var_graf . "['".substr(trim($header2[1]),0,35). "'," . $ressupr. ",'" . $ressupr. "']," ;
	   }
	  
	   	  for ($i=0;$i < 19; $i++) {
	        $header2[$i] = ''; 
            $ttm = 0;          
			$totv = 0;
		  }
		  echo("<th align=center>" . $ressupr . "</th");

	 
		 echo("</tr>");
	 echo("<tr>");
	 $md = 0;
	  for ($i=0;$i < 19; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if($i < 14){
			      $ttcol[14] = $ttcol[14] + $ttcol[$i];
				 if($ttcol[$i] > 0){
			
					  $md++;
			       
					 $ttcol[15] = number_format(($ttcol[14] /  $md),3,",",".");
	
				  }
			  
			  }
		  
			    echo("<th" . $alg . " >" );
				if($ttcol[$i] > 0){
				  echo(number_format(($ttcol[$i]),3,",",".")); 
				}
				 echo("</th>" );
	            
			 }
	 	//$ttcli ++;
		 echo("</tr>");
	 
/*	 
	 while($rowc=mysql_fetch_array($rscons)){ 
	 
		$var_graf = $var_graf . "['".trim($rowc['descr_prod']). "'," . $rowc['consumo_ano']."]," ;
	 }
*/	 
		//$var_graf = $var_graf . "['".trim($rowc['descr_prod']). "'," . $rowc['consumo_ano']. "," .$rowc['saldo_prod']. ",".$rowc['ponto_min']."]" ;
	 
}
      ?>    
     
  </table>
  </center>
      
</form>
<br />  

  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
//google.charts.load('current', {'packages':['bar']});
//google.charts.setOnLoadCallback(drawChart);
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);


function drawChart() {
        var data = google.visualization.arrayToDataTable([
   //       ['Item', 'consumo','Saldo','Pto Min'],
            ['Item', 'Meses Suprimento', { role: 'style' }], 

	           <?php echo($var_graf);?>     ]);
   var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

    var options = {
          title : 'Ressuprimento em até 12 meses - Ano de Referencia : <?php echo($anodf  . " - " . $linha_prod); ?>' ,
		  titleTextStyle: {
          fontSize: 12
          },
		  chartArea: { width: '48%' },
          vAxis: {title: 'Itens'},
          hAxis: {title: 'Meses'},
          seriesType: 'bars',
		  fontSize: 8,
		  fontScale: 15,
		  legend: { position: "none" },
		  bars: 'horizontal', // Required for Material Bar Charts.
 		  bar: { groupWidth: '80%' },
		  isStacked: true,
 		  width: 950,
 		  height: 650,
		  // Allow multiple
		  //  simultaneous selections.
	    // selectionMode: 'multiple',
		 //   Trigger tooltips
		 // on selections.
        // tooltip: {trigger: 'selection'},
		 //   Group selections
		 // by x-value.
		// aggregationTarget: 'category',
		  
};
  
      var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
      chart.draw(view, options);
  }
    </script>
 
  <center>
<br>
 <table width="100%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <th>
    <div id="chart_div" style="width: 950px; height: 650px;"></div>
  </th>

</tr>
</table>
 </center>
</body>
</html>
