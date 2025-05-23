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

$mes_a = array( 1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez');

/***********************************gera a linhas a serem selecionadas por ano *** 1   ************
drop table tmp_totmprim
CREATE TABLE tmp_totmprim AS		 
select distinct year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
		                     ,(sum(a.quantid_said)) * d.valor_custo total_custo ,
       						 b.cod_prod, b.descr_prod,e.linha
							 from tb_saidmatp a
							 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
							 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '2020'
               and d.mes_custo = month(a.data_saida) and d.ano_custo = year(a.data_saida)
							 inner join tb_produto e on e.cod_prod = b.cod_prod
							 where year(a.data_saida)='2020'
							 and mid(a.cod_prod,1,2)  = 10 and a.motivo != 3
							 group by a.cod_prod,b.cod_prod,year(a.data_saida), month(a.data_saida)
							 order by year(a.data_saida), month(a.data_saida),b.cod_prod		


SELECT a,b,a+b INTO OUTFILE '/tmp/result.txt'
  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
  LINES TERMINATED BY '\n'
  FROM test_table;


drop table tmp_resumocusto
CREATE TABLE tmp_resumocusto AS
select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida,
		                         month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo) total_custo ,
      							 b.cod_prod
								 from tb_saidmatp a
								 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
								 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
								 where year(a.data_saida)= 2020 and month(a.data_saida) = month(a.data_saida)
                 and a.cod_prod not in (190045,190105)
								 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
								 group by a.cod_prod,year(a.data_saida), month(a.data_saida),b.cod_prod
union all
select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida,
		                         month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo)*1000 total_custo ,
      							 b.cod_prod
								 from tb_saidmatp a
								 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
								 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
									 where year(a.data_saida)= 2020 and month(a.data_saida) = month(a.data_saida)
                 and a.cod_prod in (190045,190105)
								 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
								 group by a.cod_prod,year(a.data_saida), month(a.data_saida),b.cod_prod
								 
SELECT mes_saida,ano_saida,cod_prod,sum(total_custo) totcusto FROM tmp_resumocusto
group by cod_prod,mes_saida,ano_saida
order by mes_saida,ano_saida,cod_prod

SELECT year(a.data_pr) ano_prod, month(a.data_pr) mes_prod,a.cod_prod, b.descr_prod, b.linha, sum(a.kg_realizado) total_kgrealiz
FROM tb_producao1 a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.kg_realizado > 0
group by a.cod_prod, b.linha,year(a.data_pr),month(a.data_pr)
order by year(a.data_pr) desc,month(a.data_pr),b.linha,b.cod_prod			

/////// seleciona produtos por linha ////////////
SELECT a.cod_prod,b.descr_prod,b.linha FROM tb_producao1 a
inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha not in ('inovacao','m.primas')
group by a.cod_prod
order by b.linha,a.cod_prod


///////////// seleciona totais de materias primas por produto fabricado //////////////////
CREATE TABLE tmp_resumocusto AS
select year(a.data_saida) ano_saida,
		                         month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo) total_custo ,
      							 b.cod_prod
								 from tb_saidmatp a
								 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
								 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
								 where year(a.data_saida)= 2020 and month(a.data_saida) = month(a.data_saida)
                 and a.cod_prod not in (190045,190105)
								 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
								 group by year(a.data_saida), month(a.data_saida),b.cod_prod
union all
select year(a.data_saida) ano_saida,
		                         month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo)*1000 total_custo ,
      							 b.cod_prod
								 from tb_saidmatp a
								 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
								 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
									 where year(a.data_saida)= 2020 and month(a.data_saida) = month(a.data_saida)
                 and a.cod_prod in (190045,190105)
								 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
								 group by year(a.data_saida), month(a.data_saida),b.cod_prod
								 
////cria resumo do total de custo dos insumos por produto acabado mes ////								 
drop table tmp_ttins_pa
CREATE TABLE tmp_ttins_pa AS		 
	select a.ano_saida,a.mes_saida,sum(a.total_custo) tot_insumomes,a.cod_prod
	   from tmp_resumocusto a
	group by a.ano_saida,a.mes_saida,a.cod_prod
	order by a.ano_saida,a.mes_saida,a.cod_prod								 


select a.ano_saida,a.mes_saida,sum(a.total_custo) total_cmprim,
       a.cod_prod,a.descr_prod,a.linha,b.total_prod ,(sum(a.total_custo)/b.total_prod ) tot_mprimkg, c.tot_insumomes,
       (c.tot_insumomes / b.total_prod) totcusto_kg, d.valor_dolar , ((c.tot_insumomes / b.total_prod) / d.valor_dolar ) insumos_kg_dolar,
       ((sum(a.total_custo)/b.total_prod )/ d.valor_dolar ) tot_mprimkg_dolar,
       sum(a.total_custo) + (c.tot_insumomes) total_custo,
       (sum(a.total_custo) + (c.tot_insumomes)) / b.total_prod total_custo_kg_real,
       (((sum(a.total_custo) + (c.tot_insumomes)) / b.total_prod) / d.valor_dolar) total_custo_kg_dolar,
       f.tt_realizadomes,
       ((e.tt_customes / f.tt_realizadomes) * b.total_prod) custo_ind_prod,e.tt_customes
from tmp_totmprim a
inner join tv_totalprod b on a.cod_prod = b.cod_prod
           and b.ano_prod = a.ano_saida and b.mes_prod = a.mes_saida
left outer join tmp_ttins_pa c on c.cod_prod = a.cod_prod
           and c.ano_saida = a.ano_saida and c.mes_saida = a.mes_saida
left outer join tb_dolarmes d on d.ano_dolar = a.ano_saida and d.mes_dolar = a.mes_saida
left outer join tv_custoindmesano e on e.ano_custoind = a.ano_saida and e.mes_custoind = a.mes_saida
left outer join tv_totkgmesano f on f.ano_prod  = a.ano_saida and f.mes_prod = a.mes_saida
           group by a.ano_saida,a.mes_saida,a.cod_prod
order by a.ano_saida,a.mes_saida,a.cod_prod







////////////////////////////////////////////////////


 
		 
		 
select a.ano_saida,a.mes_saida,sum(a.total_custo) total_cmprim, a.cod_prod,a.descr_prod,a.linha
from tmp_totmprim a
group by a.ano_saida,a.mes_saida,a.cod_prod
order by a.ano_saida,a.mes_saida,a.cod_prod		 
		 
select a.ano_saida,a.mes_saida,sum(a.total_custo) total_cmprim,
       a.cod_prod,a.descr_prod,a.linha,b.total_prod ,(sum(a.total_custo)/b.total_prod ) tot_mprimkg
from tmp_totmprim a
inner join tv_totalprod b on a.cod_prod = b.cod_prod
           and b.ano_prod = a.ano_saida and b.mes_prod = a.mes_saida
group by a.ano_saida,a.mes_saida,a.cod_prod
order by a.ano_saida,a.mes_saida,a.cod_prod

SELECT a.ano_saida,a.mes_saida,sum(total_custo) total_insumo, a.cod_prod
 FROM tmp_resumocusto a
group by a.ano_saida,a.mes_saida,a.cod_prod
  ;		 
								 
//////////////////////	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////							 


SELECT  b.linha
FROM tb_producao1 a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by  b.linha
order by b.linha

--------saida--------
linha

/****************** gera cod e descricao de produtos por linha do ano selecionado **************

SELECT a.cod_prod, b.descr_prod, b.linha
FROM tb_producao1 a
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
FROM tb_producao1 a
inner join tb_produto b on a.cod_prod = b.cod_prod and b.linha like "%ELANCO%"
where a.kg_realizado > 0 and year(a.data_pr) = 2020
group by a.cod_prod, b.linha
order by b.linha,b.cod_prod)


--------------saida -------

cod_prod - descr_prod - linha - ordem

/******************* gera view tv_totprodlin do total em kilo produzidos por linha de produto  *** 2

SELECT year(a.data_pr) ano_prod, month(a.data_pr) mes_prod,a.cod_prod, b.descr_prod, b.linha, sum(a.kg_realizado) total_kg
FROM tb_producao1 a
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
			//mysql_query("ALTER TABLE `quimicareal`.`tmp_totmprim` DROP PRIMARY KEY");
			
			//mysql_query("ALTER TABLE `quimicareal`.`tmp_totmprim` DROP PRIMARY KEY, ADD PRIMARY KEY (`ano_saida`)");
	/*
				
				echo("select distinct year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
											 ,(sum(a.quantid_said)) * d.valor_custo total_custo ,
											 b.cod_prod, b.descr_prod,e.linha
											 from tb_saidmatp a
											 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
											 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '" . $ano_2 ."'
							   and d.mes_custo = month(a.data_saida) and d.ano_custo = year(a.data_saida)
											 inner join tb_produto e on e.cod_prod = b.cod_prod and e.linha = '" . $linha_prod . "'
											 where year(a.data_saida)= '"  . $ano_2 ."'" .  $p03 . "
											 and mid(a.cod_prod,1,2)  = 10 and a.motivo != 3
											 group by a.cod_prod,b.cod_prod,year(a.data_saida), month(a.data_saida)
											 order by year(a.data_saida), month(a.data_saida),b.cod_prod");
				
				
			*/								 
	
	
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

if(isset($mes_i)){
	if($mes_i > 0){
	   $p01 = " and month(a.data_pr) = '". $mes_i . "'";
	   $p02 = " and month(d.ano_custo) = '".$mes_i . "'";
	   $p03 = " and month(a.data_saida)= '".$mes_i . "'";
	   
	   
	}
}


if (isset($ano_2)){
	if($ano_2 > 0){
		
	/*
		echo("SELECT  b.linha FROM tb_producao1 a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					where a.kg_realizado > 0 and year(a.data_pr) = '" .$ano_2 . "'" .$p01 . "
					group by  b.linha
					order by b.linha");
					*/
					
        $rs33 = mysql_query("SELECT  b.linha FROM tb_producao1 a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					where a.kg_realizado > 0 and year(a.data_pr) = '" .$ano_2 . "'" .$p01 . "
					group by  b.linha
					order by b.linha");
					$ano_1 = $ano_2;					
	$imp = "S";				
	
	
	    $b = mysql_num_rows($rs33);
		$msg = "";
		if ($b == 0){
			
	      $imp = "N";
		  $msg = "<h1> Não houve produção no período ! </h1>";
		  
		}

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
	<title>MATPAC_custo_prod_anual - Custo total por linha de produto produzido por ano</title>
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
			document.form1.action="menu_custo.php";
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
        <th align="center" ><h1>Custo Linhas de Produtos por Ano -
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
              <th  align="center"><select name="mes_i" class="search-input3" >
                <option value="0">Selecione o Mes </option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Mar&ccedil;o</option>
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
              <th  align="center">Ano                <input type="text" name="ano_2" id="ano_2" maxlenght="4" size=8 onChange="atualiza()"  value = "<?php echo($ano_2);?>"  class="search-input3" /></th>

              <th  align="center"><input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>           
    </table>     


    
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
$linha_prod = "";
$mes_soma = '';

if ($mes_i != ""){
	
}

		 $ttger_ctind  = 0.00;
		$totgg_prod = 0.00;
		$totgg_mpr=0.00;
		$totgg_ins=0.00;
		$totgg_ctind=0.00;
		$totgg_cttot=0.00;
	    $totgg_cttot= 0.00;
		$totgg_prod=0.00;
 $totgg_custkg1= 0.00;
		$totgg_ins =0.00;


if ($imp == 'S'){	



	while($row33=mysql_fetch_assoc($rs33)){ 

		  $linha_prod = $row33['linha'];
		  	  $ttcustoins = 0.00;
		  $ttcustoind = 0.00;
		  $ttg_prod   = 0.00;
		  $ttg_mpr    = 0.00;
		  $ttg_mpr    = 0.00;
		  $ttg_ins    = 0.00;
		  $ttg_ctind  = 0.00;
		  $ttg_cttot  = 0.00;
		  $ttg_perct  = 0.00;
		  $ttg_kgre   = 0.00;
		  $ttg_kgus   = 0.00;
		  $tot_custkg1 = 0.00;

		  $totg_prod = 0.00;
		  
///////////////
		$totg_prod = 0.00;
		$totg_mpr=0.00;
		$totg_ins=0.00;
		$totg_ctind=0.00;
		$totg_cttot=0.00;
		$totg_ins =0.00;
		$tot_custkg1 =0.00;
		$tot_custkg1=0.00;
	    $totg_cttot= 0.00;
		$totg_prod=0.00;

		$tot_custkg1 =0.00;
		$tot_custkg1=0.00;


///////////////		  
	
		  echo("<h2>Linha : ".$linha_prod. "</h2>");
	
		   $rs_drop = "drop table tmp_totmprim";
	
		   mysql_query($rs_drop);
		   $gera_saida = "S";
	
		$rs_tbtemp = "CREATE TABLE tmp_totmprim AS		 
				select distinct year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
											 ,(sum(a.quantid_said)) * d.valor_custo total_custo ,
											 b.cod_prod, b.descr_prod,e.linha
											 from tb_saidmatp a
											 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
											 inner join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = '" . $ano_2 ."'
							   and d.mes_custo = month(a.data_saida) and d.ano_custo = year(a.data_saida)
											 inner join tb_produto e on e.cod_prod = b.cod_prod and e.linha = '" . $linha_prod . "'
											 where year(a.data_saida)= '"  . $ano_2 ."'" .  $p03 . "
											 and mid(a.cod_prod,1,2)  = 10 and a.motivo != 3
											 group by a.cod_prod,b.cod_prod,year(a.data_saida), month(a.data_saida)
											 order by year(a.data_saida), month(a.data_saida),b.cod_prod	";
				
		   mysql_query($rs_tbtemp);
	
		   
		   $rs_drop = "drop table tmp_resumocusto";
		   mysql_query($rs_drop);
	
		   $rs_resumocusto = "CREATE TABLE tmp_resumocusto AS
								select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida,
									 month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo) total_custo ,
									 b.cod_prod
									 from tb_saidmatp a
									 left outer join tv_saldoltprac b on a.lote_fabricado = b.num_lote
									 left outer join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
									 where year(a.data_saida)= '" . $ano_2 . "'". $p03 . " and month(a.data_saida) = month(a.data_saida)
					 and a.cod_prod not in (190045,190105)
									 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
									 group by a.cod_prod,year(a.data_saida), month(a.data_saida),b.cod_prod
					union all
					select a.cod_prod as cd_matprima,year(a.data_saida) ano_saida,
									 month(a.data_saida) mes_saida,sum(a.quantid_said * d.valor_custo)*1000 total_custo ,
									 b.cod_prod
									 from tb_saidmatp a
									 left outer join tv_saldoltprac b on a.lote_fabricado = b.num_lote
									 left outer join tb_custoprod d on d.cod_prod = a.cod_prod and d.ano_custo = year(a.data_saida) and d.mes_custo = month(a.data_saida)
										 where year(a.data_saida)= '" . $ano_2 . "'". $p03 . " and month(a.data_saida) = month(a.data_saida)
					 and a.cod_prod in (190045,190105)
									 and mid(a.cod_prod,1,2)  <> 10 and a.motivo != 3
									 group by a.cod_prod,year(a.data_saida), month(a.data_saida),b.cod_prod ";
		   
		   
			   mysql_query($rs_resumocusto);
	  
			 
		   
		   $rs_drop = "drop table tmp_ttins_pa";
	
		   mysql_query($rs_drop);
	
		   $rs_resumocusto = "CREATE TABLE tmp_ttins_pa AS		 
							   select a.ano_saida,a.mes_saida,sum(a.total_custo) tot_insumomes,a.cod_prod
								   from tmp_resumocusto a
								   group by a.ano_saida,a.mes_saida,a.cod_prod
								   order by a.ano_saida,a.mes_saida,a.cod_prod  ";
		   mysql_query($rs_resumocusto);
								
	
	
	/////////////Geração da saida para o custo mensal por linha pesquisada //////////////////////////////////////////////////////////////////
	
	
						
	$rs2 = mysql_query("select a.ano_saida,a.mes_saida,sum(a.total_custo) total_cmprim,
							   a.cod_prod,a.descr_prod,a.linha,b.total_prod ,(sum(a.total_custo)/b.total_prod ) tot_mprimkg, c.tot_insumomes,
							   (c.tot_insumomes / b.total_prod) totcusto_kg, d.valor_dolar , ((c.tot_insumomes / b.total_prod) / d.valor_dolar ) insumos_kg_dolar,
							   ((sum(a.total_custo)/b.total_prod )/ d.valor_dolar ) tot_mprimkg_dolar,
								sum(a.total_custo) + (c.tot_insumomes) + ((e.tt_customes / f.tt_realizadomes) * b.total_prod) total_custo,
							   (sum(a.total_custo) + (c.tot_insumomes) + ((e.tt_customes / f.tt_realizadomes) * b.total_prod)) / b.total_prod total_custo_kg_real,
							   (((sum(a.total_custo) + (c.tot_insumomes)) / b.total_prod)  / d.valor_dolar) total_custo_kg_dolar,
							   f.tt_realizadomes,
							   ((e.tt_customes / f.tt_realizadomes) * b.total_prod) custo_ind_prod,e.tt_customes
						from tmp_totmprim a
								inner join tv_totalprod b on a.cod_prod = b.cod_prod
										   and b.ano_prod = a.ano_saida and b.mes_prod = a.mes_saida
								left outer join tmp_ttins_pa c on c.cod_prod = a.cod_prod
										   and c.ano_saida = a.ano_saida and c.mes_saida = a.mes_saida
								left outer join tb_dolarmes d on d.ano_dolar = a.ano_saida and d.mes_dolar = a.mes_saida
								left outer join tv_custoindmesano e on e.ano_custoind = a.ano_saida and e.mes_custoind = a.mes_saida
								left outer join tv_totkgmesano f on f.ano_prod  = a.ano_saida and f.mes_prod = a.mes_saida
						group by a.ano_saida,a.mes_saida,a.cod_prod
						order by a.ano_saida,a.mes_saida,a.cod_prod ");
	
	
	
		
		if ($gera_saida == "S"){ 
		
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
					  
	
		  
		  $cabec[0] = "Produção";
		  $i=1;
		  $tot_custod = 0;
		  $tot_custodir = 0;
		  ///////////imprime o 1o cabecalho //////////////////////////////////////////////////
		  echo("<table width='95%'><tr  bgcolor='#D2D2FF' >");	  
		  echo("<td align='center'>Mes</td>" );
		  echo("<td align='center'>Ano</td>" );	  
		  echo("<td align='center'>Produto</td>" );	  
		  echo("<td align='center'>Linha</td>" );	  
		  echo("<td align='center'>Total Produzido</td>" );	 
		  echo("<td align='center'>Total M.Prima</td>" );	 
		  echo("<td align='center'>Total Insumo</td>" );
		  echo("<td align='center'>Custo Indireto</td>" );	 
		  echo("<td align='center'>Custo Total</td>" );	  
		  echo("<td align='center'>% Custo Ind</td>" );	  
		  echo("<td align='center'>C.Ind. Kg</td>" );	  
		  echo("<td align='center'>C.Direto Kg</td>" );	  
		  echo("<td align='center'>Tot.Cust.Kg R$</td>" );	  
		  echo("<td align='center'>Custo Kg U$</td>" );	  
		  echo("<td align='center'>U$ Mês</td>" );	   	  
		  echo("</tr>");	  
	
		  
		  ////////////////////////////////imprime o total em kilos por produto//////////////////////////
		  $bg =0;
		  $ttcustoins = 0.00;
		  $ttcustoind = 0.00;
		  $ttg_prod   = 0.00;
		  $ttg_mpr    = 0.00;
		  $ttg_mpr    = 0.00;
		  $ttg_ins    = 0.00;
		  $ttg_ctind  = 0.00;
		  $ttg_cttot  = 0.00;
		  $ttg_perct  = 0.00;
		  $ttg_kgre   = 0.00;
		  $ttg_kgus   = 0.00;
		  $tot_custkg1 = 0.00;
		
  
		  while($row=mysql_fetch_array($rs2)){
			  $custo_ind_prod = 0;
			
			   if($bg == 1){
				   $bgc = "bgcolor=#eeeeee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}
			   	
			  if ($mes_soma != $row['mes_saida']){
				  echo("<tr><td colspan=4 align=center>T o t a i s  d o  M ê s : ---->>>></td>
				  <td colspa= 11>&nbsp</td>
				  </tr>");
				  $mes_soma = $row['mes_saida']; 
				  
			  }
				
				   echo('<tr ' . $bgc .'>');
			   
			  echo("<td align='center'>" . $mes_a[$row['mes_saida']] . "</td>");
			  echo("<td align='center'>" . $row['ano_saida'] . "</td>");
			  echo("<td align='left'>" . $row['cod_prod'] . " - " . $row['descr_prod'] . "</td>");
			  echo("<td align='center'>" . $row['linha'] . "</td>");
			  echo("<td align='right'>" . number_format($row['total_prod'],3,",",".") . "</td>");
			  
			  $totg_prod = $totg_prod + $row['total_prod'];
			  $totgg_prod = $totgg_prod + $row['total_prod'];
			  
			  echo("<td align='right'>" . number_format($row['total_cmprim'],2,",",".") . "</td>");
	
			  $totg_mpr = $totg_mpr + $row['total_cmprim'];
			  $totgg_mpr = $totgg_mpr + $row['total_cmprim'];
			  
			  echo("<td align='right'>" . number_format($row['tot_insumomes'],2,",",".") . "</td>");		  
	
			  $totg_ins = $totg_ins + $row['tot_insumomes'];
			  $totgg_ins = $totgg_ins + $row['tot_insumomes'];
		  
			  $custo_ind_prod = ($row['total_cmprim'] + $row['tot_insumomes']) / $row['total_prod'];
			  
			  echo("<td align='right'>" . number_format($row['custo_ind_prod'],2,",",".") . "</td>");
			  
			  $totg_ctind = $totg_ctind + $row['custo_ind_prod'];
			  $ttger_ctind = $ttger_ctind + $row['custo_ind_prod'];
			  
			  echo("<td align='right'>" . number_format($row['total_custo'],2,",",".") . "</td>");
			  
			 // $ttcustoind = $ttcustoind + $row['custo_ind_prod'];
			  $ttcustoind = $ttcustoind + ($row['total_cmprim'] + $row['tot_insumomes'] );
			  
			  $totg_cttot = $totg_cttot + $row['total_custo'];
			  $totgg_cttot = $totgg_cttot + $row['total_custo'];
	
			  echo("<td align='right'>" . number_format((($row['custo_ind_prod'] / ($row['total_cmprim'] + $row['tot_insumomes'] )*100)) ,2,",",".") . "%</td>");
			  
	
			  echo("<td align='right'>" . number_format(($row['custo_ind_prod']/$row['total_prod']),2,",",".") . "</td>");
			  
			  $totg_kgre = $totg_kgre + $row['total_custo'];
			  echo("<td align='right'>" . number_format($custo_ind_prod ,2,",",".") . "</td>");
	
			  echo("<td align='right'>"); 
				if($row['total_custo_kg_real'] > 0){
					echo(number_format($row['total_custo_kg_real'],2,",","."));
				}
				else{
					$tt_custkg = ($row['custo_ind_prod'] + $custo_ind_prod);
					echo(number_format($tt_custkg,2,",","."));
					
				}
				$tot_custkg1 = $tot_custkg1 + $tt_custkg;
				//$totgg_custkg1 = $totgg_custkg1 + $tt_custkg;

				echo("</td>");
			  
				echo("<td align='right'>");
				if ($row['total_custo_kg_real'] > 0){
				  echo(number_format(($row['total_custo_kg_real'] / $row['valor_dolar']) ,2,",","."));
				}else{
				  echo(number_format(($tt_custkg / $row['valor_dolar']) ,2,",","."));
					
				}
				   echo("</td>");
	
			  $totg_kgus = $totg_kgus + $row['total_custo_kg_real'];		  
			  $totgg_kgus = $totgg_kgus + $row['total_custo_kg_real'];		  
			  
			  echo("<td align='right'>" . number_format($row['valor_dolar'],2,",",".") . "</td>");
	
			  echo("</tr>");
	
		}
		echo("<tr  bgcolor='#D2D2FF'>");
		echo("<td colspan='4' align='center'> Custos Totais --->>> </td>" );
		echo("<td align='right'>" . number_format($totg_prod,3,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_mpr,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_ins,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_ctind,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_cttot,2,",",".") . "</td>");
	
		
		echo("<td align='right'>" . number_format((($totg_ctind / ($totg_mpr + $totg_ins )*100)) ,2,",",".") . "%</td>");
		echo("<td >&nbsp;</td>");
		
		echo("<td align='right' colspan='2'>");
		 
			if ($tot_custkg1 > 0){
				echo (number_format(($tot_custkg1) ,2,",","."));
				$totgg_custkg1 = $totgg_custkg1 + $tot_custkg1;
				}
			else{	
			   echo(number_format(($totg_cttot/$totg_prod) ,2,",","."));
			   	$totgg_custkg1 = $totgg_custkg1 + ($totg_cttot/$totg_prod);

			   }
	
		echo("</td>");
	
	   // echo("<td align='right'>" . number_format($custo_ind_prod,2,",",".") . "</td>");
		echo("<td colspan='2'>&nbsp;</td>");
	  /*
		echo("<td align='right'>" . number_format($totg_kgre,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_kgus,2,",",".") . "</td>");
		*/
		echo("</tr></table>");
	}
  }
  		  echo("<table width='95%'>");	  

  
			echo("<tr  bgcolor='#D2D2FF'> <td colspan= 15 align=center>Resumo Geral</td></tr>");
		 echo("<tr  bgcolor='#DFFFDF' >");	  
		  echo("<td align='center' colspan='3'>Somatório ---->>></td>" );
		  echo("<td align='center'>Total Produzido</td>" );	 
		  echo("<td align='center'>Total M.Prima</td>" );	 
		  echo("<td align='center'>Total Insumo</td>" );
		  echo("<td align='center'>Custo Indireto</td>" );	 
		  echo("<td align='center'>Custo Total</td>" );	  
		  echo("<td align='center'>% Custo Ind</td>" );	  
		  echo("<td align='center'>C.Ind. Kg</td>" );	  
		  echo("<td align='center'>C.Direto Kg</td>" );	  
		  echo("<td align='center'>Tot.Cust.Kg R$</td>" );	  
		  echo("<td align='center'>Custo Kg U$</td>" );	  
		  echo("<td align='center'>U$ Mês</td>" );	   	  
		  echo("</tr><tr>");	  

			
		echo("<td align='left' colspan='3'> &nbsp; </td>" );
		echo("<td align='right'>" . number_format($totgg_prod,3,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totgg_mpr,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totgg_ins,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($ttger_ctind,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totgg_cttot,2,",",".") . "</td>");
	
		
		echo("<td align='right'>" . number_format((($ttger_ctind / ($totgg_mpr + $totgg_ins )*100)) ,2,",",".") . "%</td>");
		echo("<td >&nbsp;</td>");
		
		echo("<td align='right' colspan ='2'>");
		 
			//if ($tot_custkg1 > 0){
				echo (number_format(($totgg_custkg1) ,2,",","."));
				//}
			//else{	
			 //  echo(number_format(($totgg_cttot/$totgg_prod) ,2,",","."));}
	
		echo("</td>");
	
	   // echo("<td align='right'>" . number_format($custo_ind_prod,2,",",".") . "</td>");
		echo("<td >&nbsp;</td>");
	  /*
		echo("<td align='right'>" . number_format($totg_kgre,2,",",".") . "</td>");
		echo("<td align='right'>" . number_format($totg_kgus,2,",",".") . "</td>");
		*/
		echo("</tr></table>");

	

}
echo($msg);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
    
    
</form> 
</center>
</body>
</html>
