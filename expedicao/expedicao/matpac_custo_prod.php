<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");
$gera_saida = "N";

/***********************************gera a linhas a serem selecionadas por ano *** 1   ************

SELECT  b.linha
FROM tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by  b.linha
order by b.linha

--------saida--------
linha

/****************** gera cod e descricao de produtos por linha do ano selecionado **************

SELECT a.cod_prod, b.descr_prod, b.linha
FROM tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by a.cod_prod, b.linha
order by b.linha,b.cod_prod

------------- saida-------------
cod_prod - descr_prod - linha

/////////////////////////////////gera o numero da ordem do produto na linha ///////////////
SET @n = 0;
drop table tmp_prod_linha

create table tmp_prod_linha as (
SELECT a.cod_prod, b.descr_prod, b.linha,@n := @n+1 AS ordem
FROM tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha like "%ELANCO%"
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by a.cod_prod, b.linha
order by b.linha,b.cod_prod)


--------------saida -------

cod_prod - descr_prod - linha - ordem

/******************* gera view tv_totprodlin do total em kilo produzidos por linha de produto  *** 2

SELECT year(a.data_pr) ano_prod, month(a.data_pr) mes_prod,a.cod_prod, b.descr_prod, b.linha, sum(a.kg_realizado) total_kg
FROM tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by a.cod_prod, b.linha,year(a.data_pr),month(a.data_pr)
order by year(a.data_pr) desc,month(a.data_pr),b.linha,b.cod_prod

-----------------saida--------------------------
ano_prod - mes_prod - cod_prod - descr_prod - linha - total_kg


///////////////////////////////   gera saidas das materias primas mensais  cod(1,2) = 10 por linha selecionada **********

select a.cod_prod as cd_matprima,a.data_saida,(sum(a.quantid_said)) * d.valor_custo total_custo ,
       b.cod_prod, b.descr_prod,e.linha
from tb_saidmatp a
inner join tv_lotefabric b on a.lote_fabricado = b.lote_fabricado
inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = 2020 and d.mes_custo = 03
inner join tb_produto e on e.cod_prod = b.cod_prod  and trim(e.linha) like '%ELANCO%'
where year(data_saida)=2020 and month(data_saida) = 03
and mid(a.cod_prod,1,2)  = 10
group by a.cod_prod,b.cod_prod
order by a.cod_prod, year(a.data_saida), month(a.data_saida),b.cod_prod

------------------saida --------------------------

cd_matprima - data_saida - total_custo - cod_prod - descr_prod - linha


////////////   gera saidas das insumos  mensais  por produto fabricado cod(1,2) <> 10  *************** valor do custo ***************


select a.cod_prod as cd_matprima,a.data_saida,((sum(a.quantid_said)) * d.valor_custo)*1000 total_custo ,
       b.cod_prod, b.descr_prod,e.linha
from tb_saidmatp a
inner join tv_lotefabric b on a.lote_fabricado = b.lote_fabricado
inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = 2020 and d.mes_custo = 03
inner join tb_produto e on e.cod_prod = b.cod_prod  and trim(e.linha) like '%ELANCO%'
where year(data_saida)=2020 and month(data_saida) = 03
and mid(a.cod_prod,1,2)  <> 10
group by a.cod_prod,b.cod_prod
order by a.cod_prod, year(a.data_saida), month(a.data_saida),b.cod_prod

------------------saida --------------------------

cd_matprima - data_saida - total_custo - cod_prod - descr_prod - linha

*************************************************************************************/

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

//DATEDIFF(t.data_conserto,CURDATE())
	
/*
$rs2 = mysql_query("SELECT year(DATE_FORMAT(STR_TO_DATE(a.data_fabr, '%d/%m/%Y'), '%Y-%m-%d')) ano_fab,
        a.cod_prod, count(a.cod_prod) num_produz
					FROM tb_entprodac a
group by year(DATE_FORMAT(STR_TO_DATE(a.data_fabr, '%d/%m/%Y'), '%Y-%m-%d')), a.cod_prod
					order by year(DATE_FORMAT(STR_TO_DATE(a.data_fabr, '%d/%m/%Y'), '%Y-%m-%d')) desc, num_produz desc, limit 650");		 		  
*/
$ano_1 = "";

$dolar_mes = 0.00;

if (isset($ano_2)){
	if($ano_2 > 0){
        $rs33 = mysql_query("SELECT  b.linha FROM tb_producao a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					where a.kg_realizado > 0 and year(a.data_pr) = '" .$ano_2 . "' 
					group by  b.linha
					order by b.linha");
					$ano_1 = $ano_2;					
	}
}

if (isset($linha_prod)){
	if($linha_prod != ""){
       //$seta_var = "SET @n= 0";
	  // mysql_query($seta_var);
	  // $rs_drop = "drop table tmp_prod_linha";
	   $rs_drop = "truncate table tmp_prod_linha";

	   mysql_query($rs_drop);
	   
	   /*
	   $rs_tbtemp = "create table tmp_prod_linha as (
					SELECT a.cod_prod, b.descr_prod, b.linha,@n := @n+1 AS ordem
					FROM tb_producao a
					inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha = '" . $linha_prod . "'
					where a.kg_realizado > 0 and year(a.data_pr) = '" . $ano_2 . "'
					group by a.cod_prod, b.linha
					order by b.linha,b.cod_prod) "; 
		echo($rs_tbtemp);			
		
		ALTER TABLE `quimicareal`.`tmp_prod_linha` DROP PRIMARY KEY;
		
		ALTER TABLE `quimicareal`.`tmp_prod_linha` DROP PRIMARY KEY, ADD PRIMARY KEY (`ordem`);
			
		*/

		mysql_query("ALTER TABLE `quimicareal`.`tmp_prod_linha` DROP PRIMARY KEY");
		
		mysql_query("ALTER TABLE `quimicareal`.`tmp_prod_linha` DROP PRIMARY KEY, ADD PRIMARY KEY (`ordem`)");

		
		$rs_tbtemp = "INSERT INTO tmp_prod_linha (cod_prod, descr_prod, linha) (
					SELECT a.cod_prod, b.descr_prod, b.linha
					FROM tb_producao a
					inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha = '" . $linha_prod . "'
					where a.kg_realizado > 0 and year(a.data_pr) = '" . $ano_2 . "'
					group by a.cod_prod, b.linha
					order by b.linha,b.cod_prod)";
					
					
	   mysql_query($rs_tbtemp);
	   
	   $rs_linhas = mysql_query("select * from tmp_prod_linha ") ;
	   $tt_prl = mysql_num_rows($rs_linhas);
	   /*--------------saida -------
				
		  cod_prod - descr_prod - linha - ordem				
									
	   */	
       if ($mes_i > 0) {
	   	   $rs_drop2 = "drop table tmp_totkgprod";
	       mysql_query($rs_drop2);

		   $rs_tbtemp2 = "create table tmp_totkgprod as (
		   				  SELECT year(a.data_pr) ano_prod, month(a.data_pr) mes_prod,a.cod_prod, b.descr_prod, b.linha, sum(a.kg_realizado) total_kg
						  FROM tb_producao a
						  inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha like '%" . $linha_prod . "%'
						  where a.kg_realizado > 0
						  and year(a.data_pr) = '". $ano_2 . "'
						  and month(a.data_pr) = '" . $mes_i . "'
						  group by a.cod_prod, b.linha,year(a.data_pr),month(a.data_pr)
						  order by year(a.data_pr) desc,month(a.data_pr),b.linha,b.cod_prod  )";
          // echo($rs_tbtemp2);						  
	       mysql_query($rs_tbtemp2);
		  $rs_totkg = mysql_query("select * from tmp_totkgprod ") ;

		   // saida
		   // ano_prod - mes_prod - cod_prod - descr_prod - linha - total_kg
		   
		   
		   ///////////////////////////////   gera saidas das materias primas mensais  cod(1,2) = 10 por linha selecionada **********
		   
		   /*
		   select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida, month(a.data_saida) mes_saida ,
(sum(a.quantid_said)) * d.valor_custo total_custo , b.cod_prod, b.descr_prod,e.linha ,a.motivo,d.valor_custo from tb_saidmatp a
inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '2020' and d.mes_custo = '6'
inner join tb_produto e on e.cod_prod = b.cod_prod and e.linha = 'ELANCO- '
where year(data_saida)='2020' and month(data_saida) = '6' and mid(a.cod_prod,1,2) = 10 and a.motivo != 3
group by a.cod_prod,b.cod_prod order by a.cod_prod, year(a.data_saida), month(a.data_saida),b.cod_prod
		   
		   
		   */

           $rs_saidas_mat = "select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
		                     ,(sum(a.quantid_said)) * d.valor_custo total_custo ,
       						 b.cod_prod, b.descr_prod,e.linha
							 from tb_saidmatp a
							 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
							 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '" . $ano_2 . "' and d.mes_custo = '" . $mes_i . "'
							 inner join tb_produto e on e.cod_prod = b.cod_prod  and e.linha = '" . $linha_prod . "'
							 where year(data_saida)='" . $ano_2 . "' and month(data_saida) = '" . $mes_i . "'
							 and mid(a.cod_prod,1,2)  = 10 and a.motivo != 3
							 group by a.cod_prod,b.cod_prod
							 order by a.cod_prod, year(a.data_saida), month(a.data_saida),b.cod_prod ";
							 
//echo($rs_saidas_mat);							 
							 
							 
							 
           $saidas_mat = mysql_query($rs_saidas_mat);
		   
           /*------------------saida --------------------------

           cd_matprima - ano_saida - mes_saida - total_custo - cod_prod - descr_prod - linha
		   
           */		   
		   
	       $rs_saidas_insumos = "select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida,
		                         month(a.data_saida) mes_saida,((sum(a.quantid_said)) * d.valor_custo) total_custo ,
      							 b.cod_prod, b.descr_prod,e.linha
								 from tb_saidmatp a
								 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
								 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '" . $ano_2 . "' and d.mes_custo = '" . $mes_i . "'
								 inner join tb_produto e on e.cod_prod = b.cod_prod  and e.linha = '" . $linha_prod . "'
								 where year(a.data_saida)= '" . $ano_2 . "' and month(a.data_saida) = '" . $mes_i . "'
								 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
								 group by a.cod_prod,b.cod_prod
								 order by a.cod_prod, year(a.data_saida), month(a.data_saida),b.cod_prod ";	 
								 
//echo($rs_saidas_insumos);							  

           $saidas_insumos = mysql_query($rs_saidas_insumos);								 
		   /*
		   						
			------------------saida --------------------------
						
			cd_matprima - data_saida - total_custo - cod_prod - descr_prod - linha
		  */		   
		  
		  $gera_saida = "S";

        $rs_dolar = mysql_query(" select a.valor_dolar from tb_dolarmes a where a.mes_dolar = '".$mes_i ."' and a.ano_dolar = '" .$ano_2 . "'");		
	    $rowd=mysql_fetch_array($rs_dolar);
        $dolar_mes = $rowd['valor_dolar'];

        $rs_totcustoindmes = mysql_query(" select a.tot_custoindmesano from tv_ttcustoindmes a where a.mes_custoind  = '".$mes_i ."' and a.ano_custoind = '" .$ano_2 . "'");		
	    $rowtotcustoindmesano=mysql_fetch_array($rs_totcustoindmes);
        $total_custoindmesano = $rowtotcustoindmesano['tot_custoindmesano'];

        $rs_totpesomesano = mysql_query(" select a.tt_realizadomes from tv_totkgmesano a where a.mes_prod  = '".$mes_i ."' and a.ano_prod = '" .$ano_2 . "'");		
	    $rowpesomesano=mysql_fetch_array($rs_totpesomesano);
        $total_pesomesano = $rowpesomesano['tt_realizadomes'];

	
		if ($dolar_mes == ""){$dolar_mes = 1;}

        $rs_custoind = mysql_query(" select a.tot_custoindmesano from tv_ttcustoindmes a where a.mes_custoind = '".$mes_i 
		."' and a.ano_custoind = '" .$ano_2 . "'");	
		

			
	    $rowcind=mysql_fetch_array($rs_custoind);
        $totalcind = $rowcind['tot_custoindmesano'];

		   
	   } 
				
								
	}
}
	
	
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
	<title>MATPAC_custo_prod - Custo total por linha de produto produzido por ano/mes</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>   
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
		  document.form1.codigo_cli.value = '';
   	   	  document.form1.action="matpac004l.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

  function sair2()
  {	      // document.location.href='excluieq.asp'
			document.form1.action="menu_exped.php";
			document.form1.submit();  
			return true;
  
  }

</script>
    
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
        <th align="center" ><h1>Consulta Custo Mensal por Linha de Produto- 
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
              <th  align="center">Mes
                <select name="mes_i"  class="search-input3" >
                  <option value="0" >Selecione o Mes </option>
                  <option value="1" <? if($mes_i == 1) {	?>selected <? } ?>>Janeiro</option>
                  <option value="2" <? if($mes_i == 2) {	?>selected <? } ?>>Fevereiro</option>
                  <option value="3" <? if($mes_i == 3) {	?>selected <? } ?>>Março</option>
                  <option value="4" <? if($mes_i == 4) {	?>selected <? } ?>>Abril</option>
                  <option value="5" <? if($mes_i == 5) {	?>selected <? } ?>>Maio</option>
                  <option value="6" <? if($mes_i == 6) {	?>selected <? } ?>>Junho</option>
                  <option value="7" <? if($mes_i == 7) {	?>selected <? } ?>>Julho</option>
                  <option value="8" <? if($mes_i == 8) {	?>selected <? } ?>>Agosto</option>
                  <option value="9" <? if($mes_i == 9) {	?>selected <? } ?>>Setembro</option>
                  <option value="10" <? if($mes_i == 10) {	?>selected <? } ?>>Outubro</option>
                  <option value="11" <? if($mes_i == 11) {	?>selected <? } ?>>Novembro</option>
                  <option value="12" <? if($mes_i == 12) {	?>selected <? } ?>>Dezembro</option>
                </select>
Ano
<input type="text" name="ano_2" id="ano_2" maxlenght="4" size=8 onChange="atualiza()"  value = "<?php echo($ano_2);?>"  class="search-input3" /></th>
              <th  align="center"> Linha de Produto
                <select name="linha_prod"  onChange="atualiza();" class="search-input2">
                  <option value="">Selecione a Linha</option>
                  <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
                  <option value="<?php echo($row33['linha']);?>"
				  <? if($row33['linha'] == $linha_prod) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33['linha']); ?></option>
                  <?php }?>
              </select></th>
              <th  align="center"><input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>           
    </table>     
    <?php if ($gera_saida == "S"){ 
    
				  $cabec      = array();	
				  $header     = array();
				  $header2    = array();
				  $subtotmat  = array();
				  $tt_custod  = array();
				  $total_kg   = array();
				  $tt_custoind = array();
				  $tt_prodl    = array();
				  $rateio_it   = array();
				  $custogeral   = array();
				  

      echo("<table width='95%'><tr><td>");	  
	  echo("Taxa do dolar em: " . $mes_i . "/" . $ano_2 . " -->> " . $dolar_mes );
	  echo("</td></tr></table>");	  
	  
	  $cabec[0] = "Produção";
	  $i=1;
	  $tot_custod = 0;
	  $tot_custodir = 0;
	  ///////////imprime o 1o cabecalho //////////////////////////////////////////////////
	  while($row=mysql_fetch_array($rs_linhas)){ 
		  $cabec[$i] = $row['cod_prod'] . " - " . $row['descr_prod'] ;
		  $i++;
	  }
	  
	  $totcol = count($cabec);
	  echo($linha_prod);
	 // echo($totcol);
	  
	  echo ("<table width='95%'> <tr>");
	  $i=0;
	  for ($i=0;$i< $totcol;$i++) {
	  
		  echo("<td align='center'>" . $cabec[$i] . "</td>");
	  }
	  echo("<td align='center'> Total </td>");
	  echo("</tr>");
	  
	  ////////////////////////////////imprime o total em kilos por produto//////////////////////////
	  
	  for ($i=0;$i<$totcol+1; $i++) {
          $header[$i] = '';		  
		  $subtotmat[$i] = 0.00;
		  $tt_custod[$i] = 0.00;
		  $total_kg[$i] = 0.00;
		  $tt_custoind[$i] = 0.00;
		  $rateio_it[$i] = 0.00;
		  $custogeral[$i] = 0.00;
		  
		  $tt_prodl = 0.00;

	  }
	  $header[0] = "Mes - " . $mes_i . "/" . $ano_2 ;
       $cc = 0;
	   $tt_kg = 0.00;
	  while($row=mysql_fetch_array($rs_totkg)){ 
	     $cd_prod = $row['cod_prod'];
		 
		$rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $cd_prod . "'") ;
		
	    $row1=mysql_fetch_array($rs_ordem);
        $cc = $row1['ordem'] ;
		$header[$cc] =  $row['total_kg'];
		
		//echo($header[$cc]);
		$tt_kg = $tt_kg + $row['total_kg'];
	  }
	  echo("<tr bgcolor='#E8E8FF'>");
	  echo("<td align='center'>" . $header[0] . "</td>");
	  
	  for ($i=1;$i< $totcol;$i++) {
	  		  echo("<td align='center'>" . number_format($header[$i],3,",",".") . "</td>");
			  $total_kg[$i] =  $total_kg[$i] + $header[$i];
			  $tt_custoind[$i] = $header[$i];
	  
	  }
  	  echo("<td align='center'>" . number_format(($tt_kg),3,",",".")  . "</td>");

	  echo("</tr>");

	  ////////////////////////////////imprime o total de valores das materias primas usadas//////////////////////////
	  
	  for ($i=0;$i<$totcol+1; $i++) {
          $header[$i] = '';		
		  $subtotmat[$i] =  0.00;
	  }
	  $header[0] = "Mes - " . $mes_i . "/" . $ano_2 ;
       $cc = 0;
	   $tt_ct = 0.00;
	  $header[0] = '';
	  $imp = "N";
	  $mat_prim = "";
	  $ini = 0;
      $mat_inic = '';

//echo($totcol);

	  while($row = mysql_fetch_array($saidas_mat)){ 
	  
	    if ($mat_inic == '') {
				$cd_prod = $row['cod_prod'];		 
				$rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $cd_prod . "'") ;
				$mat_prim = $row['cd_matprima'];
				
				$row1=mysql_fetch_array($rs_ordem);
				
				$cc = $row1['ordem'];
				$header[$cc] =  $row['total_custo'];
				$mat_inic = $row['cd_matprima'];

				$rs_mprima = mysql_query("select a.* from tb_produto a where a.cod_prod = '" . $row['cd_matprima'] . "'") ;
				$row1m=mysql_fetch_array($rs_mprima);
	
				$header[0] =  $row['cd_matprima'] ;
				$mprim = " - " . $row1m['descr_prod'];
				
		}
		
		if( $mat_inic != $row['cd_matprima']){
			
					echo("<tr>");
					echo("<td align='left'> " . $header[0] . $mprim . "</td>");
					for ($i=1;$i< $totcol;$i++) {
						  echo("<td align='right'>" . number_format(($header[$i]),3,",",".") . "</td>");
						  $subtotmat[$i] = $subtotmat[$i] + $header[$i];
						  $tt_ct = $tt_ct + $header[$i];
						  
					 }
					echo("<td align='right'>" . number_format(($tt_ct),3,",",".")  . "</td>");
			
					echo("</tr>");
					$mat_prim = $row['cd_matprima'];
					$imp = "N";
					$tt_ct = 0;
					for($i=1;$i<$totcol;$i++){
						$header[$i] = 0.00;
					}
					
					$rs_mprima = mysql_query("select a.* from tb_produto a where a.cod_prod = '" . $row['cd_matprima'] . "'") ;
					$row1m=mysql_fetch_array($rs_mprima);
	
					$header[0] =  $row['cd_matprima'] ;
					$mprim = " - " . $row1m['descr_prod'];
					$mat_prim = $row['cd_matprima'];

				    $cd_prod = $row['cod_prod'];		 
					$rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $cd_prod . "'") ;
							$mat_prim = $row['cd_matprima'];
				
				
					$row1=mysql_fetch_array($rs_ordem);
				
					$cc = $row1['ordem'];
					$header[$cc] =  $row['total_custo'];

					$mat_inic = $row['cd_matprima'];

		}
		else{
			
				$cd_prod = $row['cod_prod'];		 
				$rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $cd_prod . "'") ;
				$mat_prim = $row['cd_matprima'];
								
				$row1=mysql_fetch_array($rs_ordem);
				
				$cc = $row1['ordem'];
				$header[$cc] =  $row['total_custo'];
				$mat_inic = $row['cd_matprima'];
			
		}
	}
	$tt_ct = $tt_ct + $row['total_custo'];

	echo("<tr>");
	echo("<td align='left'> " . $header[0] . $mprim . "</td>");
	for ($i=1;$i< $totcol;$i++) {
		  echo("<td align='right'>" . number_format(($header[$i]),3,",",".") . "</td>");
		  $tt_ct = $tt_ct + $header[$i];
		  $subtotmat[$i] = $subtotmat[$i] + $header[$i];
	}
	echo("<td align='right'>" . number_format(($tt_ct),3,",",".")  . "</td>");
			
	echo("</tr>");
							
	echo("<tr bgcolor='#DFDFFF'>");
    echo("<td align='right'>  Subtotal de Materias-Primas</td>");
	$tt_subm = 0.00;
	for ($i=1;$i< $totcol;$i++) {
				  echo("<td align='right'> " . number_format(($subtotmat[$i]),3,",",".") . "</td>");
				  $tt_subm = $tt_subm + $subtotmat[$i];
				  $tt_custod[$i] = $tt_custod[$i] + $subtotmat[$i]  ;
		
   	}
	echo("<td align='right'>" . number_format(($tt_subm),3,",",".")  . "</td>");
	echo("</tr>");
	
	////////////////////////////////////////////////////////////////////////////////////////////////
     
    echo("</table>");
    for ($i=0;$i<$totcol+1; $i++) {
          $header[$i] = '';	
	  }
	////////////////////////////////imprime o total de valores das embalagens usadas//////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	
echo("Insumos");
  
	  echo("<table width='95%'> <tr>");
	  $cabec[0] = " Produto ";
	  for ($i=0;$i< $totcol;$i++) {
	  
		  echo("<td align='center'>" . $cabec[$i] . "</td>");
	  }
	  echo("<td align='center'> Total </td>");
	  echo("</tr>");
	  
	  
	  for ($i=0;$i<$totcol+1; $i++) {
          $header[$i] = '';	
		  $subtotmat[$i] = 0;	  
	  }
	  $header[0] = "Mes - " . $mes_i . "/" . $ano_2 ;
       $cc = 0;
	   $tt_ct = 0.00;
	  $header[0] = '';
	  $imp = "N";
	  $minsumo = "";
      $cd_prod = '';
	  $mprim = '';
//////////////////////
	  while($row = mysql_fetch_array($saidas_insumos)){ 
	    
	    if ($minsumo == ""){
		    $rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $row['cod_prod']. "'") ;
	        $row1=mysql_fetch_array($rs_ordem);
            $cc = $row1['ordem'];
     		$header[$cc] =  $row['total_custo'];
			$minsumo = $row['cd_matprima'];
			
		}
		

		if ($minsumo != $row['cd_matprima']){
	         echo("<tr>");
		     echo("<td align='left'> " . $header[0] . $mprim . "</td>");
			 for ($i=1;$i< $totcol;$i++) {
				  echo("<td align='right'> " . number_format(($header[$i]),2,",",".") . "</td>");
	              $subtotmat[$i] = $subtotmat[$i] + $header[$i];
				  		$tt_ct = $tt_ct   + $header[$i]; 
			 }
			 for($i=1;$i<$totcol;$i++){
					  $header[$i] = 0.00;				 	
			 }				
			 echo("<td align='right'>" . number_format(($tt_ct),2,",",".")  . "</td>");
	         for($i=1;$i<$totcol;$i++){
					  $header[$i] = 0.00;				 	
			 }
			 $tt_ct - 0.00;				
			 echo("</tr>");
			 $mprim = " - " . $row1m['descr_prod'];
			 
			 for($i=1;$i<$totcol;$i++){ 
			    $header[$i] = "";
			 }
			 $tt_ct = 0;
			 for($i=1;$i<$totcol;$i++){
					$header[$i] = 0.00;
			 }
    	     $rs_mprima = mysql_query("select a.* from tb_produto a where a.cod_prod = '" . $row['cd_matprima'] . "'") ;
	         $row1m=mysql_fetch_array($rs_mprima);
		     $header[0]   =  $row['cd_matprima'] ;
    		 $minsumo     =  $row['cd_matprima'] ;

		     $mprim       = " - " . $row1m['descr_prod'];
		}
		
		$rs_ordem = mysql_query("select a.* from tmp_prod_linha a where a.cod_prod = '" . $row['cod_prod']. "'") ;
	    $row1=mysql_fetch_array($rs_ordem);
        $cc = $row1['ordem'];
        
		$rs_mprima = mysql_query("select a.* from tb_produto a where a.cod_prod = '" . $row['cd_matprima'] . "'") ;
	    $row1m=mysql_fetch_array($rs_mprima);
        
		$header[0]   =  $row['cd_matprima'] ;
	    $mprim       = " - " . $row1m['descr_prod'];
		
		if ($row['cd_matprima'] == 190045 || $row['cd_matprima'] == 190105){
     		$header[$cc] =  $row['total_custo'] * 1000;	
		}
		else {
				$header[$cc] =  $row['total_custo'];
		}
    	$minsumo     =  $row['cd_matprima'] ;
	    $cd_prod     = $row['cod_prod'];		 
	  }
//////////*******************************************///////////////////////////////////////////////////

		if ($minsumo != $row['cd_matprima']){
	         echo("<tr>");
		     echo("<td align='left'> " . $header[0] . $mprim . "</td>");
			 for ($i=1;$i< $totcol;$i++) {
				  echo("<td align='right'> " . number_format(($header[$i]),2,",",".") . "</td>");
	              $subtotmat[$i] = $subtotmat[$i] + $header[$i];
				  		$tt_ct = $tt_ct   + $header[$i]; 
			 }
			 for($i=1;$i<$totcol;$i++){
					  $header[$i] = 0.00;				 	
			 }				
			 echo("<td align='right'>" . number_format(($tt_ct),2,",",".")  . "</td>");
	         for($i=1;$i<$totcol;$i++){
					  $header[$i] = 0.00;				 	
			 }
			 $tt_ct - 0.00;				
			 echo("</tr>");
			 $mprim = " - " . $row1m['descr_prod'];
			 
			 for($i=1;$i<$totcol;$i++){ 
			    $header[$i] = "";
			 }
			 $tt_ct = 0;
			 for($i=1;$i<$totcol;$i++){
					$header[$i] = 0.00;
			 }
    	     $rs_mprima = mysql_query("select a.* from tb_produto a where a.cod_prod = '" . $row['cd_matprima'] . "'") ;
	         $row1m=mysql_fetch_array($rs_mprima);
		     $header[0]   =  $row['cd_matprima'] ;
    		 $minsumo     =  $row['cd_matprima'] ;
		     $mprim       = " - " . $row1m['descr_prod'];
		}
		

////////////*******************************************/////////////////////////////////////////////////	  
	  
////////////////////////////////////////////////////////////////////////////////////////////////////////	  
	echo("<tr bgcolor='#DFDFFF'>");
    echo("<td  align='right'>  Subtotal de Insumos</td>");
	for ($i=1;$i< $totcol;$i++) {
				  echo("<td align='right'>" . number_format(($subtotmat[$i]),2,",",".") . "</td>");
				  $tt_ct = $tt_ct + $subtotmat[$i];
				  $tt_custod[$i] = $tt_custod[$i]+ $subtotmat[$i]  ;

	}
	echo("<td align='right'>" . number_format(($tt_ct),2,",",".")  . "</td>");
	echo("</tr>");
	
////////////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////////////
   
	echo("<tr bgcolor='#DFDFFF'>");
    echo("<td  align='right'>  Total de Custos Diretos</td>");
	for ($i=1;$i< $totcol;$i++) {
				  echo("<td align='right'> " . number_format(($tt_custod[$i]),2,",",".") . "</td>");
				  $tot_custo = $tot_custo + $tt_custod[$i];
				  $custogeral[$i] = $custogeral[$i] + $tt_custod[$i];

	}
	echo("<td align='right'>" . number_format(($tot_custo),2,",",".")  . "</td>");
	echo("</tr>");
	


	echo("<tr bgcolor='#DFDFFF'>");
    echo("<td a align='right'>  Custo Direto Produto  /  KG  - R$</td>");
	for ($i=1;$i< $totcol;$i++) {
		         if($total_kg[$i] > 0){
				    echo("<td align='right'> " . number_format(($tt_custod[$i] / $total_kg[$i]),2,",",".") . "</td>");
				    $tot_custodir = $tot_custodir + ($tt_custod[$i] / $total_kg[$i]);
				 }else{echo("<td align='right'>0.00</td>");}

	}
	if($tt_kg > 0 ){
	          echo("<td align='right'>" . number_format(($tot_custo/$tt_kg),2,",",".")  . "</td>");
	} else{echo("<td align='right'0,00</td>");}
	echo("</tr>");

	echo("<tr bgcolor='#DFDFFF'>");
    echo("<td a align='right'>  Custo Direto Produto  /  KG  - U$</td>");
	for ($i=1;$i< $totcol;$i++) {
		         if($total_kg[$i] > 0){
				    echo("<td align='right'> " . number_format((($tt_custod[$i] / $total_kg[$i])/$dolar_mes),2,",",".") . "</td>");
				    $tot_custodir = $tot_custodir + ($tt_custod[$i] / $total_kg[$i]);
				 }else{echo("<td align='right'>0.00</td>");}

	}
	if($tt_kg > 0 ){
	          echo("<td align='right'>" . number_format((($tot_custo/$tt_kg)/$dolar_mes),2,",",".")  . "</td>");
	} else{echo("<td align='right'0,00</td>");}
	echo("</tr>");

/////////////////////////// imprime o rateio do custo do mes /////////////////////////////////////////////////////

	  echo("<tr bgcolor='#E8E8FF'>");
	  echo("<td align='right'>Total do Custo Indireto de Produção</td>");
	  $custotot = 0.00;
	  $rateio = 0.00;
	  
	  
	  for ($i=1;$i< $totcol;$i++) {
		     // if($total_pesomesano > 0){
		         $rateio = ($total_custoindmesano / $total_pesomesano) * $tt_custoind[$i];
			 // }
	  		  echo("<td align='right'>" . number_format($rateio,2,",",".") . "</td>");
			//  $total_kg[$i] =  $total_kg[$i] + $header[$i];
			 // $tt_prodl[$i] = $header[$i];
			 $rateio_it[$i] = $rateio;
			 $custotot = $custotot + $rateio;

	  }
  	  echo("<td align='right'>" . number_format(($custotot),2,",",".")  . "</td>");

	  echo("</tr>");


/////////////////////////// imprime o rateio do custo do mes / kg/////////////////////////////////////////////////////

	  echo("<tr>");
	  echo("<td align='right'>Custo Indireto de Produto / KG R$</td>");
	  for ($i=1;$i< $totcol;$i++) {   
	  	  $rateiokg = 0.00;
	      if ( $total_kg[$i] > 0){		  
		      $rateiokg = ($rateio_it[$i] / $total_kg[$i]);

		  }
		  $custogeral[$i] = $custogeral[$i] + $rateio_it[$i];

	  		  echo("<td align='right'>" . number_format($rateiokg,4,",",".") . "</td>");
			//  $total_kg[$i] =  $total_kg[$i] + $header[$i];
			 // $tt_prodl[$i] = $header[$i];
	  }
  	  echo("<td align='right'>");
	  if($tt_kg >0){
	      echo(number_format(($custotot/$tt_kg),4,",","."));
	  }
	  
	  echo("</td>");

	  echo("</tr>");


///////////////////////////////mostra o total geral dos custos em reais////////////////////////////////////
	  echo("<tr>");
	  echo("<td align='right'>Custo total Direto + Indireto</td>");
	  $totgeral = 0.00;

	  for ($i=1;$i< $totcol;$i++) {   
	  		  echo("<td align='right'>" . number_format($custogeral[$i],2,",",".") . "</td>");
			  $totgeral =  $totgeral + $custogeral[$i];
	  }
  	  echo("<td align='right'>" . number_format(($totgeral),2,",",".")  . "</td>");

	  echo("</tr>");

///////////////////////////////mostra o total geral dos custos por kg////////////////////////////////////
	  echo("<tr>");
	  echo("<td align='right'>Custo total por KG</td>");
	  $totgeraltt = 0.00;

	  for ($i=1;$i< $totcol;$i++) {   
         	  $custogeral2 = 0.00;
              if($total_kg[$i] > 0 ){
				 $custogeral2 =  $custogeral[$i]/$total_kg[$i];
			  }
	  		  echo("<td align='right'>" . number_format($custogeral2,4,",",".") . "</td>");
			  if($tt_kg > 0){
			     $totgeraltt =  ($totgeral/$tt_kg);
			  }
	  }
  	  echo("<td align='right'>" . number_format(($totgeraltt),4,",",".")  . "</td>");

	  echo("</tr>");
	  
///////////////////////////////mostra o total geral dos custos por Dolar do mes////////////////////////////////////
	  echo("<tr>");
	  echo("<td align='right'>Custo total KG / US$</td>");
	  $totgeraltt = 0.00;

	  for ($i=1;$i< $totcol;$i++) {  
	          $custogeral3 = 0.00;
              if ($total_kg[$i] > 0 ) {
				  $custogeral3 =($custogeral[$i]/$total_kg[$i])/$dolar_mes;
			  }
	  		  echo("<td align='right'>" . number_format($custogeral3,4,",",".") . "</td>");
			  if($tt_kg > 0){
			     $totgeraltt =  (($totgeral/$tt_kg)/$dolar_mes);
			  }
	  }
  	  echo("<td align='right'>" . number_format(($totgeraltt),4,",",".")  . "</td>");

	  echo("</tr>");
	  
	  
	  



	  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	  
	  echo("</table>");

	}
	?>
    
    
</form> 
</center>
</body>
</html>
