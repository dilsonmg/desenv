 <meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<?php

 /*
 CREATE TABLE `tb_produto` (
  `id_prod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_prod` int(10) unsigned NOT NULL,
  `descr_prod` varchar(60) NOT NULL,
  `linha` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id_prod`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=utf8;

certo====>>>>>
CREATE TABLE `quimicareal`.`tb_produto` (
  `id_prod` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `cod_prod` INTEGER UNSIGNED NOT NULL,
  `descr_prod` VARCHAR(60) NOT NULL,
  `linha` VARCHAR(65),
  PRIMARY KEY (`id_prod`)
)
ENGINE = InnoDB;

====>>>>>
 
 */
 



session_start();
//$anodf = date("Y");
$anodf = "";
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
$p22 = "";	
			 
if(isset($ano_i) && $ano_i > 0 ){
	$anodf = $ano_i; }
    $p1 = " and year(a.data_saida) = '" . $anodf ."'";
	
	
if($mes_i > 0){
	$p2 = " and month(a.data_saida) = '" .$mes_i ."'";
}
	
	
	
if (isset($lote_fabricado) && $lote_fabricado !=""){
	$p3 = " and a.lote_fabricado = '". $lote_fabricado . "'";
}


if (isset($descricao2)){
	if ($descricao2 <> "" ){
		 $descricao2 = str_replace("'", "", $descricao2);
		 $p22 = " and b.descr_prod like '%" . $descricao2 ."%'" ; 
		 }}
	
	
    $cabec   = array();
	$cabec3 = array();
	$header  = array();
	$header2  = array();
	$header3 = array();
	
	$ttcol    = array();
	$ttcolm    = array();
	$ttcoli    = array();
	
	
	$resumo  = array();
/*
      $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $ttcol[$i] = ""; 
		 $resumo[$i] = "";
     }
*/	
	$cabec[0] = "Insumo / Matéria Prima";	
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


	$cabec3[0] = "Item de Custo Indireto";	
	$cabec3[1] = "Janeiro";
	$cabec3[2] = "Fevereiro";
	$cabec3[3] = "Março";
	$cabec3[4] = "Abril";
	$cabec3[5] = "Maio";
	$cabec3[6] = "Junho";
	$cabec3[7] = "Julho";
	$cabec3[8] = "Agosto";
	$cabec3[9] = "Setembro";
	$cabec3[10] = "Outubro";
	$cabec3[11] = "Novembro";
	$cabec3[12] = "Dezembro";
	$cabec3[13] = "Total";

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

if ($p != 99){
	//$a = $_GET ["S"];
}


$rs3 = mysql_query("select num_lote,cod_prod, descr_prod from tv_saldoltprac
					group by num_lote
					order by num_lote");

/*
$rs_tmp = "create table tmp_saldoprd as (SELECT a.cod_prod, sum(if(a.tt_saidalote is NULL,a.tt_entradalote,(a.tt_entradalote - a.tt_saidalote))) saldo_prod
           FROM tv_ttsaidalote a
           group by cod_prod
           order by cod_prod )";
					
$tmp =  mysql_query( $rs_tmp );
*/

//SELECT  year(a.data_saida) ano FROM tb_saidmatp a group by year(a.data_saida)

/*

SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano_said,month(a.data_saida) mes_saida,
                    sum(a.quantid_said) tt_saida,a.unidade,a.lote_fabricado
                    FROM tb_saidmatp a
                    inner join tb_produto b on b.cod_prod = a.cod_prod
						where year(a.data_saida) > 2018
					group by ano_said, mes_saida,a.cod_prod
					order by  ano_said, mes_saida,a.lote_fabricado limit 0,3000

	
						   					
$rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano_said,month(a.data_saida) mes_saida,
                    sum(a.quantid_said) tt_saida,a.unidade,d.cod_prod codprod_fabr, d.descr_prod prod_fabr
                    FROM tb_saidmatp a
                    inner join tb_produto b on b.cod_prod = a.cod_prod
					inner join tv_lotefabric d on d.lote_fabricado = a.lote_fabricado " .  $p3 . "
					where year(a.data_saida) > 2018 " . $p1 . $p2 . "
					group by ano_said, mes_saida,a.cod_prod
					order by codprod_fabr,a.cod_prod,ano_said, mes_saida");			 






echo("SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano_said,month(a.data_saida) mes_saida,
                    sum(a.quantid_said) tt_saida,a.unidade,a.lote_fabricado , c.valor_custo
                    FROM tb_saidmatp a
                    inner join tb_produto b on b.cod_prod = a.cod_prod " . $p22 . "
					left outer join tb_custoprod c on c.mes_custo = month(a.data_saida) and
					                                  c.ano_custo = year(a.data_saida)  and
													  c.cod_prod  =  a.cod_prod
					where year(a.data_saida) > 2018 " . $p1 . $p2 . $p3 ." 
					group by ano_said, mes_saida,a.cod_prod
					order by a.cod_prod,ano_said, mes_saida");			 



echo("SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano_said,month(a.data_saida) mes_saida,
                    sum(a.quantid_said) tt_saida,a.unidade ,b.unid_mat
                    FROM tb_saidmatp a
                    inner join tb_produto b on b.cod_prod = a.cod_prod " . $p22 . "
					where year(a.data_saida) > 2018 " . $p1 . $p2 . $p3 ." 
					group by ano_said, mes_saida,a.cod_prod
					order by a.cod_prod,ano_said, mes_saida");
					
*/					
$rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod, year(a.data_saida) ano_said,month(a.data_saida) mes_saida,
                    sum(a.quantid_said) tt_saida,a.unidade ,b.unid_mat,b.linha
                    FROM tb_saidmatp a
                    inner join tb_produto b on b.cod_prod = a.cod_prod " . $p22 . "     and b.flag_calccust != 'N' 
					where year(a.data_saida) > 2018 " . $p1 . $p2 . $p3 ." 
					group by ano_said, mes_saida,a.cod_prod
					order by a.cod_prod,ano_said, mes_saida");	
					

					
$rs21 = mysql_query("SELECT a.*, b.descr_centcustind  FROM tb_customind a
					left outer join tb_centcustoind b on b.id_centcustoind = a.id_centcustoind
					where a.ano_custoind = '".$anodf."'
					order by a.id_centcustoind,a.ano_custoind,a.mes_custoind");					


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
<link rel="stylesheet" href="../css/qreal.css">

<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>matpcmf001 - Consumo mensal de materias primas / Insumos por produto Fabricado</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>


<script type='text/javascript'>
<!--
function fechar1(){
window.opener = window
 window.close("#")

}
/*
 function expand() {  

 for(x = 0; x < 50; x++) {  

      window.moveTo(screen.availWidth * -(x - 1) / 100, screen.availHeight * -(x - 1) / 90);  

    window.resizeTo(screen.availWidth * x / 1, screen.availHeight * x / 1);  
   }
 }
 */
 -->
   function sair2()
  {	      // document.location.href='excluieq.asp'
			document.form1.action="menu_custo.php";
			document.form1.submit();  
			return true;
  
  }
 </script>

<style type="text/css"></style>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>

<META content="text/css" http-equiv="Content-Style-Type">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo( $_SESSION['nome_usu']); ?>

<form name="form1" method="post"  enctype="multipart/form-data">
<input type="hidden" name="monen_res" value="-1" />

<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>Custo Mensal de Materias Primas / Insumos - Ano de Referencia : <?php echo($anodf); ?> </h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><a href="javascript:sair2();"><img src="../images/back_f2.png" border="0" alt="Voltar ao menu" /></a>
          <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >

  <tr>
    <th  align="center" valign="top" >
  
        Descrição:
    <input type="text" name="descricao2" maxlength="20" size="20"  class="search-input6" />
    
    </th>
    <th  align="center" valign="top" ><select name="mes_i"  style="font-size:12" class="search-input5" >
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
      </select></th>
  <th  align="center" valign="top">Ano: <input type="text" name="ano_i" maxlength="4" size="6" onChange="document.form1.submit();" class="search-input5"  /></th>
    <th  align="center" valign="top"><input type="submit" name="button" id="button" value="Filtrar"   class="search-submit2" /></th>
  </tr>
  </table>

    <table width="100%"  border="1" >
     <?php 
	// $bg=1;
	 $cd_prod = 0;
	 $i = 0;
	 /*
	 for ($i=0;$i < 18; $i++) {
	     $header2[$i] = ''; 
     }
	 $i = 0;
	 */
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<18;$i++){   
              echo('<th>' .$cabec[$i]  .'</th>');  
         }
	 echo('</tr>');
	$bg = 0; 
	$totit = 0.000;
	$ttcli = 0;
	$ttm = 0;
	$toti = 0;
	
if ($anodf != ""){	
	
?>
<script>
var i = setInterval(function () {
    
    clearInterval(i);
  
    // O código desejado é apenas isto:
    document.getElementById("loading").style.display = "none";
    document.getElementById("conteudo").style.display = "inline";

}, 7000);
</script>
<div id="loading" style="display: block">
 <img src="../imagens/aguarde.gif"  />
</div>

<!-- COLOQUE A DIV "loading" ACIMA DE TODO O CONTEUDO DO SITE (ABAIXO DA <body>) -->

<div id="conteudo" style="display: none">
<?php	
	
	 while($row=mysql_fetch_array($rs2)){ 
			  
			  
	   //echo('<tr ' . $bgc .'>');
       if ( $row['cod_prod']	!= $cd_prod && $cd_prod != ""){
		  ++ $ttcli ; 
		  $header2[13] = $toti; 		  
          if($bg == 1){
			  $bgc = "bgcolor=#F3F3F3";
			  $bg = 0;
		  }
		  else{ 
		      $bgc = ''; 
		      $bg = 1;
		  }	
    	  echo('<tr ' . $bgc .'>');
	  	  for ($i=0;$i < 13; $i++) {
			  if($i==0){$alg = " align=left ";}else{$alg=" align=right ";}
			  if($header2[0] != "") {
				  if ($i > 0 && $i < 14){
					 echo("<th" . $alg . " >" . number_format($header2[$i] ,3,',','.')."</th>" );
					 $toti = $toti + $header2[$i];
				  }else {
					 echo("<th" . $alg . " >" . $header2[$i] ."</th>" );
				  }
			
			  }
    		 }
		//	 if ($header2[1] != ''){
				 echo("<th" . $alg . " >" . number_format($toti,3,',','.') ."</th>" );
			$ai=0;	 
			for($ai=1;$ai<13;$ai++){
				$header2[$ai]=0.00;
			}
				 
				 
			// }
         $toti = 0;
	   
	   /// zera tabela
	   	 for ($i==0;$i < 15; $i++) {
	        $header2[$i] = 0; 
			}
            $ttm = 0;          
			//$toti = 0.000;
		 
		 echo("</tr>");
	  }
	  $header2[0] = $row['cod_prod'] . " - " .$row['descr_prod'] . " - ". $row['unid_mat'];      
	  
	  $rs_lotefab = mysql_query(" select a.* from tv_saldoltprac a where a.num_lote = '".$row['lote_fabricado'] ."'");		
	  //$rowd=mysql_fetch_array($rs_lotefab);
     // $prod_fabr = $rowd['descr_prod'];
	  
	  //$header2[14] = $row['lote_fabricado'] . " - " .$prod_fabr;      

	$rs_custo = mysql_query ("select c.* from tb_custoprod c where  c.mes_custo = '".$row['mes_saida']."' and
					                                  c.ano_custo = '".$row['ano_said'] ."'  and
													  c.cod_prod  = '" .$row['cod_prod'] ."'");											  
	  $rowd=mysql_fetch_array($rs_custo);
      $valor_custo = $rowd['valor_custo'] * 1;
/*
      if ($row['unid_mat'] = "GR" || $row['unid_mat'] = "ML"){
		  if(trim($row['linha']) != "M.PRIMAS"){
		      $valor_custo = $rowd['valor_custo'] * 1000;
		  }
	  }
*/	  
    if(trim($row['linha']) != "M.PRIMAS"){

	  if (($row['cod_prod'] > 99999 && $row['cod_prod'] < 170000)
	      || ($row['cod_prod'] > 179999 && $row['cod_prod']< 190000)
		  || ($row['cod_prod'] > 300000 && $row['cod_prod'] < 300999)
	   ){
		      $valor_custo = $rowd['valor_custo'] / 1000;
		   
	   }
	}
	  $header2[$row['mes_saida']] = $row['tt_saida'] * $valor_custo;
	  
	  
	  $ttcolm[$row['mes_saida']] = $ttcolm[$row['mes_saida']] +  $header2[$row['mes_saida']];
	 
	  $ttcol[$row['mes_saida']] = $ttcol[$row['mes_saida']] + $row['mes_saida'];
	  
	  $ttm++;
	  $toti = $toti +  $row['tt_saida'] * $row['valor_custo'];;
	  $cd_prod = $row['cod_prod'];
      
      
	 }	

     if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
	  else{ $bgc = ''; $bg = 1;}	

	   echo('<tr ' . $bgc .'>');
	   		  $header2[14] = $toti; 		  

   	
	   for ($i=0;$i < 13; $i++) {
			  if($i==0){$alg = " align=left ";}else{$alg=" align=right ";}
			  if ($i > 0 && $i < 15){
			     echo("<th" . $alg . " >" . number_format($header2[$i] ,3,',','.')."</th>" );
				 $toti = $toti + $header2[$i];

			  }else {
			     echo("<th" . $alg . " >" . $header2[$i] ."</th>" );
			  }
		}
	 		 echo("<th" . $alg . " >" . number_format($toti,3,',','.') ."</th>" );
		$ai=0;	
		for($ai=1;$ai<13;$ai++){
			$header2[$ai]=0.00;
		}
				
	 	//$ttcli ++;
		 echo("</tr><tr  bgcolor='#B3B3FF' >");
		 echo("<th align='center'> Totais </th>");
		 $ttcol = 0;
         for ($i=1;$i < 13; $i++) {
		     echo("<th  align='right' >" . number_format($ttcolm[$i] ,3,',','.')."</th>" );
			 $ttcol = $ttcol + $ttcolm[$i];
		 }
		 echo("<th align='right'>"  . number_format($ttcol ,3,',','.')."</th>" );
		 echo("</tr></table>");
		
		
/////////////////////////////////////////imprime custos indiretos///////////////////////////////////////////////

	echo('<br><table width="100%" border="1" cellspacing="0">  <tr bgcolor="#B3B3FF">');
	for($i=0;$i<14;$i++){   
	    if($i == 0){
              echo('<th align="left">' .$cabec3[$i]  .'</th>');  
		}else{
		     echo('<th align="right">' .$cabec3[$i]  .'</th>'); 	
		}
    }
	echo('</tr>');
	$header3[0] = "";
	$id_centcustoind = "";
	 
 	while($rowc=mysql_fetch_array($rs21)){
	     if($id_centcustoind <> $rowc['id_centcustoind'] && $header3[0] != "" ){
			 echo('<tr>');
			 $toti3 = 0.00;
			 $i=0;
			 for ($i=0;$i < 13; $i++) {
				  if ($i > 0 && $i < 14){
					 echo("<th align='right' >" . number_format($header3[$i] ,2,',','.')."</th>" );
					 $toti3 = $toti3 + $header3[$i];
				  }else {
					 echo("<th align='left'>" . $header3[$i] ."</th>" );
				  }
	    	 $ttcoli[$i] = $ttcoli[$i] + $header3[$i];
    		 }
			 echo("<th align='right' >" . number_format($toti3,2,',','.') ."</th></tr>" );	
			 for ($i=0;$i<13;$i++){
					  $header3[$i] = 0;
			 }			  
	     }
		 $header3[0] = $rowc['descr_centcustind'];
		 $header3[$rowc['mes_custoind']] = $rowc['val_custoind'];
		 $id_centcustoind = $rowc['id_centcustoind'];
	}		
	echo('<tr>');
	$toti3 = 0.00;
	$i=0;
	for ($i=0;$i < 13; $i++) {
	  if ($i > 0 && $i < 14){
		 echo("<th align='right' >" . number_format($header3[$i] ,2,',','.')."</th>" );
		 $toti3 = $toti3 + $header3[$i];
	  }else {
		 echo("<th align='left'>" . $header3[$i] ."</th>" );
	  }
	$ttcoli[$i] = $ttcoli[$i] + $header3[$i];
    }
	echo("<th align='right' >" . number_format($toti3,2,',','.') ."</th></tr>" );				  
	
	$header3[0] = $rowc['descr_centcustind'];
	$header3[$rowc['mes_custoind']] = $rowc['val_custoind'];
	$id_centcustoind = $rowc['id_centcustoind'];

   echo("<tr  bgcolor='#B3B3FF' >");
   echo("<th align='center'> Totais </th>");
   $ttcol = 0;
   for ($i=1;$i < 13; $i++) {
	   echo("<th  align='right' >" . number_format($ttcoli[$i] ,2,',','.')."</th>" );
		 $ttcol = $ttcol + $ttcoli[$i];
   }
   echo("<th align='right'>"  . number_format($ttcol ,2,',','.')."</th>" );
   echo("</tr>");
   echo('</table>');
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
		 
}
      ?>    
     
  </table>
  </center>

	</div>

</body>
      
</form>
</body>
</html>
