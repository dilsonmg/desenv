<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


include 'conectabco.php';

/*
SELECT b.linha, sum(a.quantid) totquant, sum(a.quantid * a.val_unit) tot_venda,
a.id_consult  from tb_saidaprodac a
  inner join tb_produto b on a.cod_prod = b.cod_prod
 where a.id_saidaprodac > 0 and a.id_consult > 1
and year(a.data_nf) = 2023 and a.id_consult is not null and a.id_consult > 1
and a.id_consult = '89' and a.data_nf >= '2023/03/01' and a.data_nf <= '2023/03/21'
group by a.id_consult,b.linha
order by a.id_consult,tot_venda desc, b.linha limit 1000
*/


mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$p1 = "";
$p100 = "";
$p101 = "";
$p200 = "";
$p201 = "";
$p300 = "";

$p2 = "";
$pc = "";

if (isset($id_consult)){
	if ($id_consult <> "" ){
		 $pc = " and a.id_consult = '" . $id_consult ."'" ; 
	 }
}

if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p100 = " and a.data_nf >= '" . formata_data2($data_1) ."'" ; 
	 }
}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p101 = " and a.data_nf <= '" . formata_data2($data_2) ."'" ; 
	 }
}

if (isset($clie_p)){
	if ($clie_p <> "" ){
        if(!is_numeric($clie_p)){
            $rsc_cli = mysql_query("Select c.* from tb_cliente c where c.nome_cli like '%". $clie_p ."%' limit 1"  );
	        $rowc_cli = mysql_fetch_assoc($rsc_cli);
	        $p201 = " and a.codigo_cli = '" . $rowc_cli['codigo_cli'] ."'" ; 
		 }			 
		 else{
			 $p201 = " and a.codigo_cli = '" . $clie_p ."'" ; }
	}
}

$p300t = "";

if(isset($trans_p)){
   if ($trans_p <> "" ){

	if(!is_numeric($trans_p <> "" )){
			 
	  $rs_fort = mysql_query("Select d.* from tb_fornecedor d where d.id_fornec > 100000 and  d.rz_social like '%" . $trans_p ."%' limit 1");
	  $row_fort = mysql_fetch_assoc($rs_fort);
	  $cod_fornect = $row_fort['cod_fornec'];

	  $p300t = " and a.cod_fornec =  '" . $cod_fornect ."'" ; 
	 }else {
		 $p300t = " and a.cod_fornec =  '" . $trans_p ."'" ; 
	 
	 }
    }
}

if(isset($nf_p)){
	if ($nf_p <> "" ){
			 $p400 = " and a.num_nf = '" . $nf_p ."'" ; 
	 }
}
		 
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
			
			 $rs_prdc = mysql_query("Select b.* from tb_produto b where b.descr_prod like '%". $m_primapesq ."%'  limit 1"  );
          	 $row_prdc = mysql_fetch_assoc($rs_prdc);
			 
			 $p1a = " and a.cod_prod like '%" . $row_prdc['cod_prod'] ."'" ;} 
		 else{
			 $p1a = " and a.cod_prod like '%" . $m_primapesq ."%'" ; }
	}
}

if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.num_lote = '" . $lote_fabr2 ."'" ; 
	 }
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
	     $id_saidaprodac    = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $unidade         = "";
		 $quantid         = "";
		 $num_pedido      = "";
         $num_nf          = "";
         $data_nf         = "";
         //$codigo_cli      = "";
		 $data_fabr       = "";
		 $data_venc       = "";
		 $data_liblote    = "";
		 $data_fatura     = "";
		 $transport       = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())


if(isset($_POST["Pesquisar"]) && isset($data_1) && $data_1 != ''){
	
$rs2 = mysql_query("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
      FROM tb_saidaprodac a
	   where a.id_saidaprodac > 0
	     and a.id_consult != ''
    	 and a.id_consult > 1
         and year(a.data_nf) = 2023
	     and a.id_consult is not null
         and a.id_consult > 1
	   " . $pc. $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
	 order by a.id_consult, a.data_nf desc, num_nf desc  limit 1000");		 	
	 
  


/*
$rs2 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,d.rz_social
      FROM tb_saidaprodac a
      inner join tb_produto b on b.cod_prod = a.cod_prod " . $p1 . "
	  inner join tb_cliente c on c.codigo_cli = a.codigo_cli " . $p200 . "
	  inner join tb_fornecedor d on d.cod_fornec = a.cod_fornec " . $p300 .
	  " where a.id_saidaprodac > 0 " . $p2 .$p100 .$p101 . $p201 . $p400 . "	
	 order by  a.data_nf desc, CAST(num_nf AS DECIMAL) desc limit 650");		 		  

*/ 
    $b = mysql_num_rows($rs2);
}
$rsc = mysql_query("SELECT a.id_consult,a.nome,a.id_cargo FROM tb_consultor a
					where a.id_cargo in(304) and a.situacao is null
					order by a.nome");	
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
	<title>MATPAC004r - CONSULTA Vendas por Representante</title>
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
   	   	  document.form1.action="matpac004r.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
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
        <th align="center" ><h1>Consulta Vendas por Representante- <?php echo($data_1 ." a " . $data_2) ?> 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
    </table>
      <table width="99%" border="0">

      
            <tr >
              <th colspan="3" align="center">
              Representante 
                <select name="id_consult" class="search-input6";?>>
                  <option value="">Selecione</option>
                  <?php while($rowr=mysql_fetch_assoc($rsc)){ ?>
                  <option value="<?php echo($rowr['id_consult'])?>"
				  <? if($rowr['id_consult'] == $id_consult ) {?>selected <? } ?>				
				 ><?php echo($rowr['nome'] );?></option>
                  <?php }?>
                </select>
Produto
<input type="text" name="m_primapesq" id="m_primapesq" maxlenght="20" size=10 /> 
              Lote 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="20" size="8" placeholder="informe o lote !"  value="">
              NF 
              <input type="text" id = "nf_p"  name="nf_p"  maxlength="10" size="10" placeholder="informe a NF !"  value="">
              <br>Cliente 
              <input type="text" id = "clie_p"  name="clie_p"  maxlength="25" size="22" placeholder="informe o cliente"  value="">
              
              Transportadora 
              <input type="text" id = "trans_p"  name="trans_p"  maxlength="25" size="20" placeholder="informe a transportadora"  value="">
       Período 
          <input type="text" name="data_1" size="8" maxlength="10"  title="Obrigatório - Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="8" maxlength="10"  title="Obrigatório - Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
              <input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
              <input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto</th>
                  <th  >Linha</th>
                  <th >N. Lote</th>
                  <th>Dt Fatura</th>
                  <th>Quantidade</th>                  
                  <th>Unidade</th>
                  <th>Vlr. Unit</th> 
                  <th>Total. Unit</th>
                  <th >N. Pedido</th>
                  <th >N. NF</th>
                  <th >Data NF</th>
                  <th >Cliente</th>
                  <th >Transportadora</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $ttquant = 0;
	  $tt_ltprod = 0;
	  
	  $repres = '';
	  $id_consult = '';
	  $tot_rep =0;
	  
if(isset($_POST["Pesquisar"])){

	  $cont = 0;
	  while($row=mysql_fetch_array($rs2)){ 
	  
	  if ($id_consult != $row['id_consult']){
		  
		  
		    ////// faz resumo dos itens por representante ////////////
            ///// totais por linha de representante ///////////////////////////////////////////////////////
			$rs_lin = mysql_query("SELECT b.linha, sum(a.quantid) totquant, sum(a.quantid * a.val_unit) tot_venda,
										a.id_consult  from tb_saidaprodac a
  										inner join tb_produto b on a.cod_prod = b.cod_prod
										where a.id_saidaprodac > 0 and a.id_consult > 0
									 		and a.id_consult != ''
									 		and a.id_consult > 1
									 		and a.id_consult is not null
									 		and a.id_consult = '". $id_consult . "'"
									 . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
									 group by a.id_consult,b.linha
									 order by a.id_consult,tot_venda desc, b.linha limit 1000 ");		  
	


			$rs_res = mysql_query("SELECT a.cod_prod, sum(a.quantid) totquant, sum(a.quantid * a.val_unit) tot_venda,a.id_consult
			                        from tb_saidaprodac a
									where a.id_saidaprodac > 0
									 and a.id_consult != ''
									 and a.id_consult > 1
									 and a.id_consult is not null
									 and a.id_consult = '". $id_consult . "'"
									 . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
									   group by a.id_consult,a.cod_prod
									 order by a.id_consult, tot_venda desc, a.cod_prod  limit 1000 ");		  
		  
	 		$rs_rep = mysql_query("Select b.* from tb_consultor b where b.id_consult = '" . $row['id_consult'] . "'");
	        $row_rep = mysql_fetch_assoc($rs_rep);
	        $id_consult   = $row_rep['id_consult'];
	 	    $repres       = $row_rep['nome'];
            
			if ($tot_rep > 0){
			    echo("<tr><td colspan=7 align=center>Total do Representante</td>");
			    echo ("<td align='right'>" . number_format($tot_rep,2,",",".")."</td><td colspan=5>&nbsp;</td></tr");
			    $tot_rep = 0;
			
			echo("</tr><tr><td colspan=13><h1>Resumo por item</h1></td></tr>");
            echo("<tr><td colspan=6 align = center><table border = 0 width=70%>");
		    echo("<tr bgcolor=#ECD9FF><td>Produto</td><td align = right>Quantidade</td><td align = right>Vlr Total</td></tr>");
			while($row1=mysql_fetch_array($rs_res)){ 
			
			  $rs_prd1       = mysql_query("Select b.* from tb_produto b where b.cod_prod = '" . $row1['cod_prod'] . "'" );
	          $row_prd1      = mysql_fetch_assoc($rs_prd1);
	          $descr_prod1   = $row_prd1['descr_prod'];

	  	      echo("<tr><th align=left>".$row1['cod_prod'] ." - " . $descr_prod1 ."</th>"); 
			  echo("<th align=right>".number_format($row1['totquant'],2,",",".")."</th>");
			  echo("<th align=right>".number_format($row1['tot_venda'],2,",",".")."</th></tr>");
	
			}
			echo("</table></td>");
			$cont++;
				    /////////////////////////////////////////////////////////////////////////////////
			echo("<td  colspan=7><table border = 0 width=30%>");
		    echo("<tr bgcolor=#ECD9FF><td>Linha</td><td align = right>Quantidade</td><td align = right>Vlr Total</td></tr>");
			$var_graf = "";
			while($row2=mysql_fetch_array($rs_lin)){ 
			  $var_graf = $var_graf ."['".$row2['linha'] ."',".$row2['tot_venda']."],";
	  	      echo("<tr><th align=left>".$row2['linha'] ."</th>"); 
			  echo("<th align=right>".number_format($row2['totquant'],2,",",".")."</th>");
			  echo("<th align=right>".number_format($row2['tot_venda'],2,",",".")."</th></tr>");
	
			}
			echo("</td><td colspan = 3>");	

      ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	   var data = google.visualization.arrayToDataTable([
		  ['Linha', 'Total Venda'],<?php echo($var_graf); ?>]);
        var options = {
          title: 'Totais de valores por linha',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d<?php echo($cont);?>'));
        chart.draw(data, options);
      }
    </script>

    <div align="center"id="piechart_3d<?php echo($cont);?>" style="width: 500px; height: 100px;"></div>
				
	<?php			
			echo("</td></tr></table>");	

			
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			echo("</tr><tr><td colspan=13><h1>".$repres."</h1></td></tr>");

	  }
	  
	  
		  $tt_ltprod ++;
	  $descr_linha = "";	  
      $rs_prd = mysql_query("Select b.* from tb_produto b where b.cod_prod = '" . $row['cod_prod'] . "'" . $p1 );
	  $row_prd = mysql_fetch_assoc($rs_prd);
	  $descr_prod   = $row_prd['descr_prod'];
	  $descr_linha  = $row_prd['linha'];


     //echo("Select c.* from tb_cliente c where c.codigo_cli = '" . $row['codigo_cli'] . "'" . $p200 );
      $rs_cli = mysql_query("Select c.* from tb_cliente c where c.codigo_cli = '" . $row['codigo_cli'] . "'" . $p200 );
	  $row_cli = mysql_fetch_assoc($rs_cli);
	  $nome_cli = $row_cli['nome_cli'];

      $rs_for = mysql_query("Select d.* from tb_fornecedor d where d.cod_fornec = '" . $row['cod_fornec'] . "'"  );
	  $row_for = mysql_fetch_assoc($rs_for);
	  $rz_social = $row_for['rz_social'];

	  	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              
                <td >
                <?php //matpac003.php ?>
           <?php echo ($row['cod_prod'] . " - " . $descr_prod);?></td>
           <td align="left"><?php echo ($descr_linha);?></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($row['quantid'],0,',',''));?></td>
           <td align="center" ><?php echo strtoupper ( ($row['unidade']));?></td>
           <td align="right" ><?php echo (number_format($row['val_unit'],2,",","."));?></td>
           <td align="right" ><?php echo (number_format(($row['quantid']*$row['val_unit']),2,",","."));
		            $tot_rep = $tot_rep + ($row['quantid']*$row['val_unit']);   ?></td>
           <td align="center" ><?php echo ($row['num_pedido']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli); ?></td>
           <td align="left"><?php echo ($rz_social); ?></td>
              </tr>
          <?php 
		   } 
 ?>
               <tr>
                <td align="right" >Total de Lotes</td>
                <td align="right" ><?php echo($tt_ltprod); ?></td>
                <td align="right" colspan=2 >Quantidade Total</td>

           <td align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($ttquant,0,',',''));?></td>
           <td align="center" colspan = 7 >&nbsp;</td>
              </tr>
         <?php
          /////////total do representante /////////////
           if ($tot_rep > 0 ) {
			    echo("<tr><td colspan=7 align=center>Total do Representante</td>");
			    echo ("<td align='right'>" . number_format($tot_rep,2,",",".")."</td><td colspan=5>&nbsp;</td></tr");
				
						echo("</tr><tr><td colspan=13><h1>Resumo por item</h1></td></tr>");
            echo("<tr><td colspan=6 align = center><table border = 0 width=70%>");
		    echo("<tr bgcolor=#ECD9FF><td>Produto</td><td align = right>Quantidade</td><td align = right>Vlr Total</td></tr>");
			
			$rs_res = mysql_query("SELECT a.cod_prod, sum(a.quantid) totquant, sum(a.quantid * a.val_unit) tot_venda,a.id_consult
			                        from tb_saidaprodac a
									where a.id_saidaprodac > 0
									 and a.id_consult != ''
									 and a.id_consult > 1
									 and a.id_consult is not null
									 and a.id_consult = '". $id_consult . "'"
									 . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
									   group by a.id_consult,a.cod_prod
									 order by a.id_consult, tot_venda desc, a.cod_prod  limit 1000 ");		  
	

            ///// totais por linha de produto ///////////////////////////////////////////////////////
					$rs_lin = mysql_query("SELECT b.linha, sum(a.quantid) totquant, sum(a.quantid * a.val_unit) tot_venda,
										a.id_consult  from tb_saidaprodac a
  										inner join tb_produto b on a.cod_prod = b.cod_prod
										where a.id_saidaprodac > 0 and a.id_consult > 0
									 		and a.id_consult != ''
									 		and a.id_consult > 1
									 		and a.id_consult is not null
									 		and a.id_consult = '". $id_consult . "'"
									 . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
									 group by a.id_consult,b.linha
									 order by a.id_consult,tot_venda desc, b.linha limit 1000 ");		  
	
			/////////////////////////////////////////////////////////////////////////////////////////

			while($row1=mysql_fetch_array($rs_res)){ 
			
			  $rs_prd1       = mysql_query("Select b.* from tb_produto b where b.cod_prod = '" . $row1['cod_prod'] . "'" );
	          $row_prd1      = mysql_fetch_assoc($rs_prd1);
	          $descr_prod1   = $row_prd1['descr_prod'];

	  	      echo("<tr><th align=left>".$row1['cod_prod'] . " - ". $descr_prod1 ."</th>"); 
			  echo("<th align=right>".number_format($row1['totquant'],2,",",".")."</th>");
			  echo("<th align=right>".number_format($row1['tot_venda'],2,",",".")."</th></tr>");
	
			}
		   }
			echo("</table></td>");
	    /////////////////////////////////////////////////////////////////////////////////
			echo("<td  colspan=7><table border = 0 width=30%>");
		    echo("<tr bgcolor=#ECD9FF><td>Linha</td><td align = right>Quantidade</td><td align = right>Vlr Total</td></tr>");
			
			$var_graf = "";
			while($row2=mysql_fetch_array($rs_lin)){ 
			  $var_graf = $var_graf ."['".$row2['linha'] ."',".$row2['tot_venda']."],";
	  	  
	  	      echo("<tr><th align=left>".$row2['linha'] ."</th>"); 
			  echo("<th align=right>".number_format($row2['totquant'],2,",",".")."</th>");
			  echo("<th align=right>".number_format($row2['tot_venda'],2,",",".")."</th>");
	
			}
echo("</tt><tr><td colspan = 3>");	

      ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	   var data = google.visualization.arrayToDataTable([
		  ['Linha', 'Total Venda'],<?php echo($var_graf); ?>]);
        var options = {
          title: 'Totais de valores por linha',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

    <div align="center"id="piechart_3d" style="width: 500px; height: 100px;"></div>
				
	<?php			
			echo("</tdh></tr></table>");	
				
				
		
			    $tot_rep = 0;
			///////////////////////


         }
		  ?>      
         </table>
              
         </td>
         </tr>
           
     <?php		   
	     }
		  ?>     
    </table>     
</form> 
</center>
</body>
</html>
