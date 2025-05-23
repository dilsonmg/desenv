<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p2 = "";
$p3 = "";

$tt_custo = 0.00;

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
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;
	     $id_customind     = "";
		 $id_centcustoind  = "";
		// $mes_custoind     = "";
		// $ano_custoind     = "";
		 $val_custoind     = "";
		 $obs_custoind     = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,

/*
individual por item
select a.* ,b.descr_centcustind,b.id_centcustoind,d.descr_grupocc
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind
           left outer join tb_vinccusto c on a.id_centcustoind = c.id_centcustoind
           left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto
					 where a.id_customind > 0
					 order by  a.ano_custoind asc,a.mes_custoind asc,d.descr_grupocc
					 
toral dos itens por grupo
					 
select a.id_customind,a.id_centcustoind,a.ano_custoind,sum(val_custoind) tot_item
       ,b.descr_centcustind,b.id_centcustoind,d.descr_grupocc
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind
           left outer join tb_vinccusto c on a.id_centcustoind = c.id_centcustoind
           left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto
					 where a.id_customind > 0
group by a.id_centcustoind,a.ano_custoind
					 order by  a.ano_custoind asc,d.descr_grupocc,b.descr_centcustind				
					 

mkt

select a.id_eventomkt,b.descr_eventomkt, a.ano_saida, sum(a.quantid*a.vlr_unit) total_saida
    from tb_saidvbmkt a
    inner join tb_eventomkt b on a.id_eventomkt = b.id_eventomkt
   group by a.id_eventomkt
order by  a.ano_saida,a.id_eventomkt
					 	 

*/

$rs34 = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");

if(isset($id_centcustoind2)){
	if($id_centcustoind2 != ""){
		$p1 = " and a.id_centcustoind = '" .$id_centcustoind2 . "'";
	}
}
$p1a = '';
$p2a = '';
$p2 = '';
$p3 = '';
$p3a = '';

$pr2a = '';
$pr2 = '';
$pr3 = '';
$pr3a = '';


$pc2a = '';
$pc2 = '';
$pc3 = '';
$pc3a = '';


$p4= '';

//str_pad('100' , 4 , '0' , STR_PAD_LEFT);
$data_i = "'".$ano_custoind."-".$mes_custoind."-01'";
$data_f = "'".$ano_custoindf."-".$mes_custoindf."-31'";

$anomesi = $ano_custoind . str_pad($mes_custoind,2,'0',STR_PAD_LEFT);
$anomesf = $ano_custoindf . str_pad($mes_custoindf,2,'0',STR_PAD_LEFT);

if (isset($id_grupocusto)){
	if($id_grupocusto != ""){
		$p4 = " and c.id_grupocusto = '" .$id_grupocusto . "'";
	}
}
	

if(isset($mes_custoind)){
	if($mes_custoind != ""){
		//$p2 = " and a.mes_custoind >= " .$mes_custoind . "";
		$p2 = " and concat(a.ano_custoind,lpad(a.mes_custoind,2,0)) >= " .$anomesi;
		
		$pr2 = " and a.data_inic >= " .$data_i . "";
	//	$pc2 = " and a.mes_rdv <= " .$mes_custoind . "";
		$pc2 = " and concat(a.ano_custoind,lpad(a.mes_custoind,2,0)) >= " .$anomesi;
		$pc3 = " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0)) >= " .$anomesi ;
		$pr3 = " and a.data_inic <= " .$data_f . " and a.ano_saida >= " .$ano_custoind;

	}      

}
$p1w = '';
$p1y = '';

if(isset($ano_custoind)){
	if($ano_custoind != ""){
		$p1w = " and a.ano_custoind >= " .$ano_custoind . "";

		//$pc3 = " and a.ano_rdv >= " .$ano_custoind ;

	}
}
if(isset($mes_custoindf)){
	if($mes_custoindf != ""){
		$p2a = " and concat(a.ano_custoind,lpad(a.mes_custoind,2,0)) <= " .$anomesf;
		$pr2a = " and a.data_inic <= " .$data_f . "";
		$pc2a = " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0)) <= " .$anomesf ;

	}
}
if(isset($ano_custoindf)){
	if($ano_custoindf != ""){
		$p1y = " and a.ano_custoind <= " .$ano_custoindf . "";
		$pr3a = " and a.data_inic <= " .$data_f . "";
		//$pc3a =  " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0))a.ano_rdv <= " .$anomesf ;

	}
}

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){


/////////////////////////////////////// totais de producao e materias primas - arquivos temporarios ////////////////

	   $rs_drop = "drop table tmp_totcustmprim";
	
		   mysql_query($rs_drop);
							 
			$rs_tbtempmprim = "CREATE TABLE tmp_totcustmprim AS		 
				select distinct year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
											 ,(sum(a.quantid_said)) * d.valor_custo total_customp ,
											 b.cod_prod, b.descr_prod,e.linha
											 from tb_saidmatp a
											 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
											 inner join tb_custoprod d on d.cod_prod = a.cod_prod 
							   and d.mes_custo = month(a.data_saida) and d.ano_custo = year(a.data_saida)
											 inner join tb_produto e on e.cod_prod = b.cod_prod 
											 where a.data_saida >= "  . $data_i ." and a.data_saida <=" .  $data_f . "
											 and mid(a.cod_prod,1,2)  = 10 and a.motivo != 3
											 group by a.cod_prod,b.cod_prod,year(a.data_saida), month(a.data_saida)
											 order by year(a.data_saida), month(a.data_saida),b.cod_prod	";
				
		   mysql_query($rs_tbtempmprim);
		   
		   
		   /////////////faz somatorio das materias primas no periodo /////////////////////////////////
		   
			$rs2tc = mysql_query("select 999,99,sum(a.total_customp) tot_customp,'Custo matéria prima',99,4,'Producão'
								 from tmp_totcustmprim a ");				  
			$row1x = mysql_fetch_assoc($rs2tc);
			$total_cust_mp  = $row1x['tot_customp'];
		   ////////////////////////////////////////////////////////////////////////////////////////////
	
	      $rs_drop = "drop table tmp_totcustinsu";
	
		   mysql_query($rs_drop);
							 
			$rs_tbtempins = "CREATE TABLE tmp_totcustinsu AS		 
				select distinct year(a.data_saida) ano_saida, month(a.data_saida) mes_saida
											 ,(sum(a.quantid_said)) * d.valor_custo total_custoin ,
											 b.cod_prod, b.descr_prod,e.linha
											 from tb_saidmatp a
											 inner join tv_saldoltprac b on a.lote_fabricado = b.num_lote
											 inner join tb_custoprod d on d.cod_prod = a.cod_prod 
							   and d.mes_custo = month(a.data_saida) and d.ano_custo = year(a.data_saida)
											 inner join tb_produto e on e.cod_prod = b.cod_prod 
											 where a.data_saida >= "  . $data_i ." and a.data_saida <=" .  $data_f . "
											 and mid(a.cod_prod,1,2)  != 10 and a.motivo != 3
											 group by a.cod_prod,b.cod_prod,year(a.data_saida), month(a.data_saida)
											 order by year(a.data_saida), month(a.data_saida),b.cod_prod	";
				
		   mysql_query($rs_tbtempins);
	
		   /////////////faz somatorio das insumos no periodo /////////////////////////////////
		   
			$rs2tc = mysql_query("select 999,99,sum(a.total_custoin) total_custoin,'Custo Insumos',99,4,'Producão'
								 from tmp_totcustinsu a ");				  
			$row1x = mysql_fetch_assoc($rs2tc);
			$total_cust_in  = $row1x['total_custoin'];
		   ////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
					 
					 
$rs2t = mysql_query("select sum(a.val_custoind) tot_custo
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind " . $p1a . "
					 where a.id_customind > 0 " . $p1 . $p1w . $p1y . $p2 .$p3 . $p2a .$p3a . 
					 " order by b.descr_centcustind ");				  
$bx = mysql_num_rows($rs2t);

$row1x = mysql_fetch_assoc($rs2t);
$tot_custog  = $row1x['tot_custo'];


$rs2 = mysql_query("select a.id_customind,a.id_centcustoind,sum(val_custoind) tot_item
                     ,b.descr_centcustind,b.id_centcustoind,d.id_grupocusto,d.descr_grupocc
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind
                     inner  join tb_vinccusto c on a.id_centcustoind = c.id_centcustoind " . $p4 . "
                     left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto 
		 where a.id_customind > 0" . $p1 . $p1w . $p1y . $p2 . $p2a .$p3 .$p3a . 
					 " group by a.id_centcustoind
					 union
					 select 999,99,sum(a.total_customp) tot_customp,'Custo matéria prima',99,4,'Producão'
													 from tmp_totcustmprim a
					 union
					 select 999,99,sum(a.total_custoin) total_custoin,'Custo Insumos',99,4,'Producão'
													 from tmp_totcustinsu a
					 order by 7,tot_item desc
 ");				  
$b = mysql_num_rows($rs2);


$rs2mkt = mysql_query("select a.id_eventomkt,b.descr_eventomkt, a.ano_saida, sum(a.quantid*a.vlr_unit) total_saida
                       from tb_saidvbmkt a 
					   inner join tb_eventomkt b on a.id_eventomkt = b.id_eventomkt
					   where a.id_saidvbmkt > 0 " . $pr2 . $pr2a .$pr3 .$pr3a . "
					   group by a.id_eventomkt
					   order by  a.ano_saida,a.id_eventomkt");
				   
$rs2com = mysql_query("select a.coditem_si,b.descr_item, a.ano_rdv, sum(a.val_rdv) total_saida
                       from tb_vlritrdv a 
					   inner join tb_itemrdv b on a.coditem_si = b.coditem_si
					   where a.id_vlritrdv > 0 " .$pc3 .$pc2a . "
					   group by a.coditem_si
					   order by  a.ano_rdv,a.mes_rdv,a.coditem_si");

}
///////////////fim pesquisar ////////////////////


$rs33 = mysql_query("select a.* from tb_centcustoind a order by a.descr_centcustind");				  	
$rs331 = mysql_query("select a.* from tb_centcustoind a order by a.descr_centcustind");				  	

$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_customind a where a.id_customind ='". $id. "'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
	 
         $rs1 = mysql_query("SELECT a.* FROM tb_customind a where a.id_customind = '". $id . "'");
    	 $row1 = mysql_fetch_assoc($rs1);

		 $id_customind     = $id;
		 $id_centcustoind  = $row1['id_centcustoind'];
		 $mes_custoind     = $row1['mes_custoind'];
		 $ano_custoind     = $row1['ano_custoind'];
		 $val_custoind     = $row1['val_custoind'];
		 $obs_custoind     = $row1['obs_custoind'];

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
	<title>Custoindv001- Consulta Custos por Linha</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="custoindvc01.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="cod_prod2" value="<?php echo("$cod_prod");?>">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
         <th align="center"><h1>Consulta  Custos Indiretos - Linhas
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
         <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      </table>
 <table width="98%" border="0">
 <tr>
    <th colspan="2" align="center">
                 
              
  Mes inicial                     
    <select name="mes_custoind" class="search-input4" >
                  <option value="">Selecione o Mês</option>
                  <option value="01" <?php if($mes_custoind == "01" ){ echo(" selected "); }?>>Jan</option>
                  <option value="02" <?php if($mes_custoind == "02" ){ echo(" selected "); }?>>Fev</option>
                  <option value="03" <?php if($mes_custoind == "03" ){ echo(" selected "); }?>>Mar</option>
                  <option value="04" <?php if($mes_custoind == "04" ){ echo(" selected "); }?>>Abr</option>
                  <option value="05" <?php if($mes_custoind == "05" ){ echo(" selected "); }?>>Mai</option>
                  <option value="06" <?php if($mes_custoind == "06" ){ echo(" selected "); }?>>Jun</option>
                  <option value="07" <?php if($mes_custoind == "07" ){ echo(" selected "); }?>>Jul</option>
                  <option value="08" <?php if($mes_custoind == "08" ){ echo(" selected "); }?>>Ago</option>
                  <option value="09" <?php if($mes_custoind == "09" ){ echo(" selected "); }?>>Set</option>
                  <option value="10" <?php if($mes_custoind == "10" ){ echo(" selected "); }?>>Out</option>
                  <option value="11" <?php if($mes_custoind == "11" ){ echo(" selected "); }?>>Nov</option>
                  <option value="12" <?php if($mes_custoind == "12" ){ echo(" selected "); }?>>Dez</option>
              </select>
Ano Inicial
<input type="text" id = "ano_custoind" required name="ano_custoind"  maxlength="4" size="10" 
   placeholder="informe o ano inicial"  value="<?php echo($ano_custoind); ?>" class="search-input4">
Mes Final
<select name="mes_custoindf" class="search-input4" >
  <option value="">Selecione o M&ecirc;s</option>
  <option value="01" <?php if($mes_custoindf == "01" ){ echo(" selected "); }?>>Jan</option>
  <option value="02" <?php if($mes_custoindf == "02" ){ echo(" selected "); }?>>Fev</option>
  <option value="03" <?php if($mes_custoindf == "03" ){ echo(" selected "); }?>>Mar</option>
  <option value="04" <?php if($mes_custoindf == "04" ){ echo(" selected "); }?>>Abr</option>
  <option value="05" <?php if($mes_custoindf == "05" ){ echo(" selected "); }?>>Mai</option>
  <option value="06" <?php if($mes_custoindf == "06" ){ echo(" selected "); }?>>Jun</option>
  <option value="07" <?php if($mes_custoindf == "07" ){ echo(" selected "); }?>>Jul</option>
  <option value="08" <?php if($mes_custoindf == "08" ){ echo(" selected "); }?>>Ago</option>
  <option value="09" <?php if($mes_custoindf == "09" ){ echo(" selected "); }?>>Set</option>
  <option value="10" <?php if($mes_custoindf == "10" ){ echo(" selected "); }?>>Out</option>
  <option value="11" <?php if($mes_custoindf == "11" ){ echo(" selected "); }?>>Nov</option>
  <option value="12" <?php if($mes_custoindf == "12" ){ echo(" selected "); }?>>Dez</option>
</select>
Ano Final
<input type="text" id = "ano_custoindf" required name="ano_custoindf"  maxlength="4" size="10" placeholder="informe o ano"  
value="<?php echo($ano_custoindf); ?>" class="search-input4">
<input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
<input type="button" onClick="sair1();" value="Sair"  class="search-submit2"></th>
            </tr>
            <tr align="center">
              <td colspan="2" align="center">
 
<?php            
///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
              
?>
              
   <table width="80%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Custo</th>
                  <th align=right>Total</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;

      $grcusto = '';
	  $totgrupo = 0.00;
	  $totcustop = 0.00;

	  $var_graf = '';
	  while($row=mysql_fetch_array($rs2)){ 
          if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
	      else{ $bgc = ''; $bg = 1;}	
			  
	     // echo('<tr ' . $bgc .'>');
		   
		  if ($grcusto == '' ){
			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha:".$row['id_grupocusto'] . " - ".$row['descr_grupocc']."</td></tr>");
			   $grcusto = $row['descr_grupocc'];
  
		  }
		  
		  if ($grcusto != $row['descr_grupocc']){
			  	  $var_graf = $var_graf . "['".$grcusto . "'," .$totgrupo.  "],";
			  
			   echo("<tr  bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
			   echo(number_format($totgrupo,2,",",".")."</td></tr>"); 

			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha:".$row['id_grupocusto'] . " - ".$row['descr_grupocc']."</td></tr>");

  			   $grcusto = $row['descr_grupocc'];
			  $totcustop = $totcustop  + $totgrupo;

			   $totgrupo = 0.00;
		   }  
		   ?>
         
           <tr>
             <td  alingn="center"> <?php  echo ($row['id_centcustoind'] . " - " . $row['descr_centcustind']);?></td>
           <td  align="right"><?php echo (number_format($row['tot_item'],2,",","."));
		   $tt_custo = $tt_custo + $row['tot_item'];
		   $totgrupo = $totgrupo  + $row['tot_item'];
		   ?></td>
  
    
          <?php 
		  			 //  $grcusto = $row['descr_grupocc'];

		   } 
	     }
		 ?>  
          </tr>
          <?php
		   // $grcusto = $row['descr_grupocc'];
			$totgrupo = $totgrupo + $row['tot_item'];
  		    $var_graf = $var_graf . "['".$grcusto . "'," .$totgrupo.  "],";

		       echo("<tr bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
			   echo(number_format($totgrupo,2,",",".")."</td></tr>"); 

			  // echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linhaxxx:".$row['descr_grupocc']."</td><tr>");

  			   //$grcusto = $row['descr_grupocc'];
			   			  $totcustop = $totcustop  + $totgrupo;

			   $totgrupo = 0.00;
			   
		/////////////////////////////////////////////////// dados do Marketing /////////////////////////////////
	    $grcusto = '';
		$totgrupo = 0;
		$tt_custo = 0;
	    while($row=mysql_fetch_array($rs2mkt)){ 
		  if ($grcusto == '' ){
			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha: Marketing </td></tr>");
			   $grcusto = 'Marketing';  
		  }
		  	  
		   ?>
         
           <tr>
             <td  alingn="center"> <?php  echo ($row['id_eventomkt'] . " - " . $row['descr_eventomkt']);?></td>
             <td  align="right"><?php echo (number_format($row['total_saida'],2,",","."));
		   $tt_custo = $tt_custo + $row['total_saida'];
		   ?></td>
           </tr>

		    <?php
		
		}
			echo("<tr bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
		    echo(number_format($tt_custo,2,",",".")."</td></tr>"); 

			  $totcustop = $totcustop  + $totgrupo;

			  	  $var_graf = $var_graf . "['".$grcusto . "'," .$totgrupo.  "],";
	$totgrupo = 0;
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
				/////////////////////////////////////////////////// dados do comercial /////////////////////////////////
	    $grcusto = '';
		$totgrupo = 0;
		$tt_custo= 0;
	    while($row=mysql_fetch_array($rs2com)){ 
		  if ($grcusto == '' ){
			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha: Comercial </td></tr>");
			   $grcusto = 'Comercial';  
		  }
		  	  
		   ?>
         
           <tr>
             <td  alingn="center"> <?php  echo ($row['coditem_si'] . " - " . $row['descr_item']);?></td>
             <td  align="right"><?php echo (number_format($row['total_saida'],2,",","."));
		   $tt_custo = $tt_custo + $row['total_saida'];
		   ?></td>
        </tr>

		    <?php
		
		}
			echo("<tr bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
		    echo(number_format($tt_custo,2,",",".")."</td>");
			echo("</tr>"); 

					  $totcustop = $totcustop  + $totgrupo;

			  	  $var_graf = $var_graf . "['".$grcusto . "'," .$tt_custo.  "]";
				 // $tt_custo = $tt_custo  + $totgrupo;
			$totgrupo = 0;
	
		////////////////////////////////////////////////////////////////////////////////////////////////////////


		
		

		?>

          
          <tr  bgcolor="#D2D2FF">
             <th  align="right">Total dos Custos</th>
             <th  align="right"><?php echo (number_format($totcustop,2,",","."));?></th>
           </tr>    
         </table>
 <?php
}
/////////////////fim pesquisar ///////////////


?>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
<br />  
  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

 function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Linha', 'Custo'],
               <?php echo($var_graf); ?>
        ]);

       var options = {
          title : 'Custos Mensais por linha - Período :  <?php echo($mes_custoind . "/". $ano_custoind . " a " .$mes_custoindf . "/". $ano_custoindf );?> ',
          vAxis: {title: 'Total'},
          hAxis: {title: 'Linha'},
          seriesType: 'bars',
          series: {6: {type: 'line'}}
		  
        };


        var chart = new google.charts.Bar(document.getElementById('chartDiv1'));


        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
	
//////////

</script>
<center>
<br>
 <table width="100%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <!--th align="center" class="esquerda" id="chartDiv1"  style="width: 620px; height: 200px;" > </th --> 
  <th>
    <div id="chartDiv1" style="width: 700px; height: 300px;"></div>
  </th>

</tr>
</table>

</body>
</html>
