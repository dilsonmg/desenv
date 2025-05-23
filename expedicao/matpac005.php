<?php

/*
   gera a tv dos principios ativos
   
   
select a.cod_prod, a.num_lote, a.lote_fabricado, b.atv_kamoran
  from tb_saidmatp a
  inner join tb_entmatp b on a.cod_prod = b.cod_prod and
                b.num_lote  = a.num_lote
                and b.atv_kamoran > 0
group by a.lote_fabricado
  order by a.lote_fabricado


*/
header('Content-type: text/html; charset=ISO-8859-1');
session_start();
include 'conectabco.php';

$p1 = "";
$p100 = "";
$p11 = "";
$p200 = "";
$p201 = "";
$p300 = "";
$data_do_dia = date("Y-m-d");
$p2 = "";

$saldo_anterior =0;
$p110 = '';
if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p1 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p2 = " and a.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 

$p11l = '';
$p111c = '';
if(isset($linha_prod)){
	if ($linha_prod <> ""){
		 $p11l = " and e.linha like '%".$linha_prod ."%'";
		 $p11lc = " and c.linha like '%".$linha_prod ."%'";

	}
}


$rs3000 = mysql_query("SELECT DATE_FORMAT(a.data_liblote, '%d/%m/%Y')data_entrada, a.data_liblote FROM tb_entprodac a
                       group by a.data_liblote order by a.data_liblote desc limit 20");

$rs4000 = mysql_query("SELECT DATE_FORMAT(a.data_nf, '%d/%m/%Y')data_saida,a.data_nf FROM tb_saidaprodac a
                       group by a.data_nf order by a.data_nf desc limit 20");


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

function formata_data3($data)  
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

$lgd = 0;
$opcm = 0;
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   
   }else{
         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 
}



mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())

$p11 = " and d.data_nf = str_to_date(curdate(),'%Y-%m-%d') ";
$p110 = " and a.tt_lote > 0 "; 


if (isset($data_1)){
	if ($data_1 <> "" ){
//		 $p1 = " and a.data_venc >= '" . formata_data2($data_1) ."'" ; 
		 //$p11 = " and d.data_nf >= '" . formata_data2($data_1) ."'" ; 
		 $p110 = ""; 
	
	
		 }
	}else {
		 $p11 = " and d.data_nf = '" . date("Y-m-d") . "'";
		 $p110 = " and a.tt_lote > 0 "; 
	}
					
//			and d.data_nf = str_to_date(curdate(),'%Y-%m-%d')

$p11b = "";
if (isset($data_2)){
	if ($data_2 <> "" ){
		// $p11b = " and d.data_nf <= '" . formata_data2($data_2) ."'" ; 	
		 }
}
$rs20 = mysql_query("select b.cod_prod, a.descr_prod, a.num_lote, (a.tt_lote) tt_lote, b.embalagem ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote ,
			b.embalagem,DATE_FORMAT(b.data_prevlib, '%d/%m/%Y') data_prevlib ,b.data_fabr,b.data_venc,
			DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,d.tt_quantid tt_saidaprac,b.quant_fabr
			from tv_saldoltprac a
			inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
			left outer join tv_saidaacdiapac d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
			" . $p11 . $p11b . " where a.cod_prod > 0"  . $p1 . $p2 . $p110 . "  
                    group by a.cod_prod, a.num_lote
					order by a.cod_prod, a.num_lote asc");		 	
/*					
echo("select b.cod_prod, a.descr_prod, a.num_lote, (a.tt_lote) tt_lote, b.embalagem ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote ,
			b.embalagem,DATE_FORMAT(b.data_prevlib, '%d/%m/%Y') data_prevlib ,b.data_fabr,b.data_venc,
			DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,d.tt_quantid tt_saidaprac,b.quant_fabr
			from tv_saldoltprac a
			inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
			left outer join tv_saidaacdiapac d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
			" . $p11 . " where a.cod_prod > 0"  . $p1 . $p2 . $p110 . " 
                    group by a.cod_prod, a.num_lote
					order by a.cod_prod, a.num_lote asc");
					
	*************** view agrupamento total por mes e ano quantidade fabricada *******************
	
	select a.cod_prod , year(str_to_date(a.data_fabr, '%d/%m/%Y')) ano_fabr,
       month(str_to_date(a.data_fabr, '%d/%m/%Y')) mes_fabr, sum(a.quant_fabr) tot_fabr
 from tb_entprodac a
group by a.cod_prod , ano_fabr,mes_fabr
order by a.cod_prod,ano_fabr desc, mes_fabr desc
 ;				
					
					
	*/			
	


if($data_1==''   && $data_2==''){
	

    $rs2 = mysql_query("select b.cod_prod, a.descr_prod,e.linha, a.num_lote, (a.tt_lote) tt_lote, b.embalagem ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote ,
			b.embalagem,DATE_FORMAT(b.data_prevlib, '%d/%m/%Y') data_prevlib ,b.data_fabr,b.data_venc,b.msg_lote,
			DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,d.tt_quantid tt_saidaprac,b.quant_fabr,e1.atv_kamoran
			from tv_saldoltprac a
			inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
			inner join tb_produto e on e.cod_prod = a.cod_prod " . $p11l . "
			left outer join tv_atvkamoran e1 on e1.lote_fabricado = a.num_lote
			left outer join tv_saidaacdiapac d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
			" . $p11  . $p11b . " where a.cod_prod > 0"  . $p1 . $p2 . $p110 . " 
                    group by a.cod_prod, a.num_lote
					order by e.linha desc, a.descr_prod, a.num_lote asc");	
											
}else{
	
	$data_1 = formata_data3($data_1);
	if ($data_2 == "") { $data_2 = "31/12/2999"; }
	else{
	    $data_2 = formata_data3($data_2);
	}



					
 $rs2 = mysql_query("select b.cod_prod, a.descr_prod,e.linha, a.num_lote, (a.tt_lote) tt_lote, b.embalagem ,
            DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote ,
			b.embalagem,DATE_FORMAT(b.data_prevlib, '%d/%m/%Y') data_prevlib ,b.data_fabr,b.data_venc,b.msg_lote,
			DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,d.tt_quantid tt_saidaprac,b.quant_fabr,e1.atv_kamoran
			from tv_saldoltprac a
			inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote 
			and str_to_date(b.data_venc, '%d/%m/%Y')  >= str_to_date('" . $data_1 . "', '%d/%m/%Y')
            and str_to_date(b.data_venc, '%d/%m/%Y')  <= str_to_date('" . $data_2 . "', '%d/%m/%Y')
			inner join tb_produto e on e.cod_prod = a.cod_prod " . $p11l . "
			left outer join tv_atvkamoran e1 on e1.lote_fabricado = a.num_lote
			left outer join tv_saidaacdiapac d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
			" . $p11  . $p11b . " where a.cod_prod > 0 and a.tt_lote > 0 "  . $p1 . $p2 . $p110 . " 
                    group by a.cod_prod, a.num_lote
					order by e.linha, a.descr_prod, a.num_lote asc");	
					



  /*
   $rs2 = mysql_query("select b.cod_prod, a.descr_prod,e.linha, a.num_lote, (a.tt_lote) tt_lote, b.embalagem ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote ,
			b.embalagem,DATE_FORMAT(b.data_prevlib, '%d/%m/%Y') data_prevlib ,b.data_fabr,b.data_venc,b.msg_lote,
			DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,d.tt_quantid tt_saidaprac,b.quant_fabr,e1.atv_kamoran
			from tv_saldoltprac a
			inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
			inner join tb_produto e on e.cod_prod = a.cod_prod " . $p11l . "
			inner join tv_saidaacdiapac d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
			left outer join tv_atvkamoran e1 on e1.lote_fabricado = a.num_lote
			" . $p11  . $p11b . " where a.cod_prod > 0"  . $p1 . $p2 . $p110 . " 
                    group by a.cod_prod, a.num_lote
					order by e.linha, a.descr_prod, a.num_lote asc");
					
*/					
							
}
		
		
					
$row33a = mysql_fetch_assoc($rs20);

/*
$rs2000a = mysql_query("SELECT a.*,b.id_grpamostra,b.descr_grpam,b.qtd_kits,c.descr_prod,d.quant_disp ,c.linha ,
                        DATE_FORMAT(e.data_ent, '%d/%m/%Y') data_ent1,e.num_lote,f.data_fabr ,g.quant_it as quant_itg,
					    g.unid_amostra as unid_amostrag FROM tb_compgrp a
						inner join tb_grpamostra b on a.id_grpamostra = b.id_grpamostra
						inner join tb_itemprocessado d on a.cod_prod = d.cod_prod
						inner join tb_compgrp g   on a.cod_prod   = g.cod_prod						
						inner join tb_entitproc e on a.cod_prod = e.cod_prod	
					    left outer join tb_entprodac f on a.cod_prod = f.cod_prod and f.num_lote = e.num_lote											
						inner join tb_produto c on d.cod_prod = c.cod_prod ". $p11lc . " group by e.num_lote ");
						
*/

 $rs2000a =mysql_query("SELECT a.id_entitproc,a.cod_prod,a.num_lote,a.quant_it,b.descr_prod, b.linha, DATE_FORMAT(a.data_ent, '%d/%m/%Y') data_ent1,
     DATEDIFF(str_to_date(c.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,c.data_fabr,c.data_venc,d.quant_disp,a.obs_ent
     FROM tb_entitproc a
	    inner join tb_entprodac c on a.cod_prod = c.cod_prod
      inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  left outer join tb_itemprocessado d on d.cod_prod = a.cod_prod
	  where a.id_entitproc = (select max(b.id_entitproc) from tb_entitproc b where b.cod_prod = a.cod_prod  )
	   group by a.cod_prod
	  order by b.linha,a.data_ent desc, a.id_entitproc desc");
						
		
							
//$row2000a = mysql_fetch_assoc($rs2000a);

$cd_prodini = $row33a['cod_prod'];					
	 
$b = mysql_num_rows($rs2);

$msglotes = "";

$rs500a = mysql_query("SELECT  b.linha FROM tb_producao a
					inner join tb_produto b on a.cod_prod = b.cod_prod
					where a.kg_realizado > 0 and year(a.data_pr) >= '2015'
					group by  b.linha
					order by b.linha");


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
	<title>MATPAC005 - SALDO DE PRODUTOS ACABADOS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
  
<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
function varitext(text){
text=document.form1
print(text)
}
//  End -->
</script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function atualiza(){
   	  linha  = document.form1.linha_prod.options[document.form1.linha_prod.selectedIndex].text;
	  document.form1.nome_lin.value = linha;

// document.write(linha);
   document.form1.submit();	
   
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
		  document.form1.codigo_cli.value = '';
   	   	  document.form1.action="matpac003.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

function ver_entrada(app)
{
	
		//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
		var janela;
		janela = 	window.open (app,"mywindow1","menubar=0,top=100,left=150,scrollbars=yes,resizable=1,width=1250,status=yes,height=520"); 
		
		//janela.captureEvents(Event.RESIZE);
		//janela.onresize=informar;
}
</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input type="hidden" name="nome_lin" >
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<!-- INPUT NAME="print" TYPE="button" VALUE="Imprimir!"
ONCLICK="varitext()"-->

<table width="100%" border="1">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="right"><h1><?php echo($hoje); 
		 
		if ($nome_lin == "Selecione a Linha" || $nome_lin == "" ){
			 $nome_lin = "Todas as Linhas";
		}
	
		
		?> - 
        Controle de Vencimentos Produto Acabado- <?php echo($nome_lin . "  " .$data_1); if ($data_1 !="") { echo(" a ");} echo($data_2); ?> 
        
        </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><?php echo($hoje); ?> <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
      </tr>
         <tr>
        <th colspan="3" align="left">Produto
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="20" class="search-input4" > 
          LInha
          <select name="linha_prod"  onChange="atualiza();" class="search-input3">
            <option value="">Selecione a Linha</option>
            <?php while($row33=mysql_fetch_assoc($rs500a)){ ?>
            <option value="<?php echo($row33['linha']);?>"
				  <? if($row33['linha'] == $linha_prod) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33['linha']); ?></option>
            <?php }?>
          </select>
Periodo
<input type="date" name="data_1" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/> a 
<input type="date" name="data_2" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
<input type="submit"  name="gravar"   value="Filtrar" class="search-submit2" />
<input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>

      </tr>
      <tr  bgcolor="#B3B3D9">
           <th align="left" ><b>Entradas</b></th>
           <th align="left" colspan="2">
            <?php
			  while($row=mysql_fetch_array($rs3000)){ 
			   $lnk = "<a href=javascript:ver_entrada('matpac221.php?dtp1=" .$row['data_liblote'] ."')>".$row['data_entrada']."</a>" ;
                      echo($lnk ." - ");
						}
			?>
            </th>
       </tr>
       <tr  bgcolor="#B3B3D9">
           <th align="left" ><b>Saidas</b></th>
           <th align="left" colspan="2">
            <?php
			  while($row=mysql_fetch_array($rs4000)){ 
			   $lnk = "<a href=javascript:ver_entrada('matpac231.php?dtp1=" .$row['data_nf'] ."')>".$row['data_saida']."</a>" ;
                      echo($lnk ." - ");
						}
			?>
            </th>
       </tr>
      
            <tr >
              <th colspan="4" align="center"><!--input type="button" name="print" value="Imprimir" onClick="javascript:window.print()" -->
              </th>
              
            </tr>
            <tr >
              <th colspan="4" align="center">
              <?php
	echo($_SESSION['id_entmatp']);
		  ?></th>
            </tr>
            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="0">
                <tr bgcolor="#DBB7FF" >
                  <th width="2%"  >Codigo</th>
                  <th width="8%"  >Produto</th>
                  <th width="2%"  >% Ativo</th>
                  <th width="4%"  >Embalagem</th>
                  <th width="4%"  >Linha</th>
                  <th width="2%" >N. Lote</th>
                  <th width="4%">Fabrica&ccedil;&atilde;o</th>
                  <th colspan="2">Vencimento</th>
                  <th width="5%">Prev. Libera&ccedil;&atilde;o</th>
                  <th width="5%">Libera&ccedil;&atilde;o</th>
                  <th width="3%">Inicial</th>
                  <th width="2%">Entrada</th>
                  <th width="4%">Saida Dia</th>
                  <th width="4%">Saldo</th>
                  <th width="68%">Obs.</th>

                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $tot_prod = 0.00;
	  $t0 = 0.00;
	  $t1 = 0.00;
	  $t2 = 0.00;
	  $tg0 = 0.00;
	  $tg1 = 0.00;
	  $tg2 = 0.00;
	  $tg3 = 0.00;
	  
	  $num_lote = "";
	  $cod_prod = "";
	  $linha_p = '';
	  $ps = 0;
	  $cd_prodini = '';
	  
	  while($row=mysql_fetch_array($rs2)){
		  $saldo_anterior = 0; 
          $entrada_dia = 0;
		
         if ($row['cod_prod'] != $cd_prodini  && $cd_prodini != '' ){  ?>
                <tr bgcolor="#C4C4FF">
                  <td colspan="11" align="right" >T O T A L  .</td>
                  <td align="right" ><b><?php echo (number_format($t0,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($t1,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($t2,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($tot_prod,2,',',''));
                  $tg0 = $tg0 + $t0;
				  $tg1 = $tg1 + $t1;
				  $tg2 = $tg2 + $t2;
				  $tg3 = $tg3 + $tot_prod;
				  $t0 = 0.00; $t1 = 0.00; $t2 = 0.00;
				  ?></b></td>
                  <td align="right" >&nbsp;</td>
                </tr>
          <?php 
			   $tot_prod = 0.00;
			}
			
	  		       $cd_prodini = $row['cod_prod'] ;

	  if ($linha_p <> $row['linha']){
			  $linha_p = $row['linha'];
			  ?>                
			    <tr bgcolor="#E1E1FF">
                  <td colspan="16" align="left" bgcolor="#E1E1FF"><h1><?php echo($linha_p);?></h1></td></tr>
                
		  <?php	  
		  }
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

        
                <tr>
                  <td><?php 
				  $cod_prod = $row['cod_prod']; 
				  
				  echo($row['cod_prod']); ?></td>
                  <td >
           <a href="matpac005.php?id=<?php echo ($row['id_saidaprodac']);?>"><?php echo ( $row['descr_prod'] );?> </a><?php
		   if ($row['msg_lote'] <> ""){ $msglotes =  $msglotes . "<br> <font color=#000000 align = left> Lote :" .$row['num_lote'] . " - " . $row['msg_lote'] . "</font><br>";}
		   ?></td>
                  <td align="center"><?php echo($row['atv_kamoran']); ?></td>
                  <td><?php echo($row['embalagem']); ?></td>

           <td align="center"><?php
		   $tot_prod = $tot_prod + $row['tt_lote'] ;
//		    echo (substr($row['cod_prod'],0,2));
		/*	
			switch (substr($row['cod_prod'],0,2)) {
				case 13:
					echo "Quimica Real";
					break;
				case 15:
					echo "Quimica Real";
					break;
				case 32:
					echo "Elanco";
					break;
				case 42:
					echo "Elanco";
					break;
	
				case 70:
					echo "Naturais";
					break;
				case 10:
					echo "Antiespumante";
					break;
		
	
}*/
				echo($row['linha']);
			?></td>
           <td align="center"><?php 
		     		$num_lote = $row['num_lote']; 
		   			echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo($row['data_fabr']);?></td>
           <td width="3%" align="center" ><?php echo($row['data_venc']);?></td>
           <td width="7%" align="center" ><?php 	
		   		
			 if($row['dias_avencer'] <= 1800 and $row['dias_avencer'] > 0 ) {
		      	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>');
			 }
			 if($row['dias_avencer'] < 0  ) {
		      	echo ('<b><font color="red"> - Vencido a  ' . $row['dias_avencer'].' dias </font>');
			 }

             if($row['data_liblote'] == $data_do_dia){		   				
				$entrada_dia = $row['quant_fabr'];}

             $saldo_anterior = ($row['tt_lote'] - $entrada_dia) + $row['tt_saidaprac'];
			 
             
			?></td>

           <td align="center" ><?php echo($row['data_prevlib']);?></td>
           <?php 
		       $bgc1 ="";
		       if ($row['data_liblote'] == ""){
				   $bgc1 = 'bgcolor="#FFFFB9"';
			   }
			?>
            
           <td align="center" <?php  echo($bgc1); ?> ><?php 
		            if ($row['data_liblote'] == ""){
						echo("<font color='#FF0000'>Em análise !</font>"); }
					else{
						echo($row['data_liblote']);}?></td>
           <td align="right" ><?php echo(number_format($saldo_anterior,2,',',''));
		      $t0 = $t0 + $saldo_anterior;
		   ?></td>
           <td align="right" ><?php 
		             if($row['data_liblote'] == $data_do_dia){		   				
						echo(number_format($row['quant_fabr'],2,',',''));
						$t1 = $t1 + $row['quant_fabr'];}
					  else{
						echo(0); }
						
						?></td>
           <td align="right" ><?php echo(number_format($row['tt_saidaprac'],2,',',''));
		      $t2 = $t2 + $row['tt_saidaprac'];
			


		   ?></td>
           <td align="right" ><?php echo(number_format($row['tt_lote'],2,',',''). " " );?></td>
           <td align="left" valign="top" ><?php 
		   
	             $rs33a = mysql_query("SELECT a. msg_lote from tb_entprodac a where a.cod_prod = '". $cod_prod . "' and a.num_lote = '" .$num_lote . "'");
            
				  while($row=mysql_fetch_array($rs33a)){
		
					  echo($row['msg_lote'] . "<br>"); 
				  } 
		  	   
		   ?></td>

   <?php
   	   } 
	     }
		  ?>
                          <tr bgcolor="#C4C4FF">
                 <td colspan="11" align="right">T O T A L  .</td>
                  <td align="right" ><b><?php echo (number_format($t0,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($t1,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($t2,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($tot_prod,2,',',''));
				  $tg0 = $tg0 + $t0;
				  $tg1 = $tg1 + $t1;
				  $tg2 = $tg2 + $t2;
				  $tg3 = $tg3 + $tot_prod;
				  $t0 = 0.00; $t1 = 0.00; $t2 = 0.00;
				  ?></b></td>
                  <td align="right" >&nbsp;</td>
                  </tr>
                <tr bgcolor="#6A6AFF">
                  <td colspan="11" align="right"  >Fechamento </td>
                  <td align="right" ><b><?php echo (number_format($tg0,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($tg1,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($tg2,2,',',''));?></b></td>
                  <td align="right" ><b><?php echo (number_format($tg3,2,',',''));
				  $t0 = 0.00; $t1 = 0.00; $t2 = 0.00;
				  ?></b></td>
                  <td align="right" >&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="16" align="left"><?php 
		       //echo($msglotes);
		  //if ($mprimaps == "" & $linha2 == "" & $data_1 == "") {
			  
			  ?></td>
                </tr>

              </table>
              <p><h2>Amostras</h2></p></td>
         </tr>
         <tr align="center"> <td  colspan="3">
         
              <table width="60%" border="0">
                         <tr bgcolor="#D2D2FF" >
                  <th >Linha</th>
                  <th >Produto Processado</th>
                  <th >Lote</th>
                  <th >Dt. Entrada</th>
                  <th >Quantidade (GR)</th>
                  <th >Saldo</th>
                  <th >Obs</th>
                </tr>
             <?php
			 $idgrp = 0;
			 $mqtd = "N";
         	  while($row=mysql_fetch_array($rs2000a)){ 
	  if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              
                <th align="left" ><?php echo ($row['linha']);?></th>
                <th align="left" >
                <?php echo ("Processado " . " - " . $row['descr_prod']);?></th>
                <th align="center" ><?php echo ($row['num_lote']);?></th>
                <th align="center"><?php echo ($row['data_ent1']);?></th>

           <th align="center"><?php echo ($row['quant_it']);?> Gr</th>
             

           <th align="right"><?php echo ($row['quant_disp']);?></th>
           <th align="left"><?php echo ($row['obs_ent']);?></th>
              </tr>
           <?php 
			  } ?>  
			</table>	
            
            <?php 
			 //}
			  ?>          
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
