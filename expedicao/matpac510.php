<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

include 'conectabco.php';

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
$p111 = "";
$p2 = "";
$p2a = " left outer join tb_infocarga b on b.num_pedido = a.num_pedido ";


if (isset($npedido2)){
	if ($npedido2 <> "" ){
		 $p111 = " and a.num_pedido = '" . $npedido2 ."'" ; 
	 }
}
	
if (isset($sit_fat)){
	if ($sit_fat <> "" ){
		 $p2a = " inner join tb_infocarga b on b.num_pedido = a.num_pedido and b.sit_fatura = '" . $sit_fat ."'" ; 
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
/*
echo("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,DATE_FORMAT(b.data_entrega, '%d/%m/%Y') dt_entreg
					,DATE_FORMAT(b.dt_preventr, '%d/%m/%Y') dt_preventr2,
					b.tel_contat,b.email,b.num_conhec,b.sit_fatura
      FROM tb_saidaprodac a
	   left outer join tb_infocarga b on b.num_pedido = a.num_pedido " . $p2a . "
	   where a.id_saidaprodac > 0 " . $p1a . $p2 .$p100 .$p111 .$p101 . $p201 . $p400 .  $p300t . "	
	 order by  a.data_nf desc limit 650");		 		  
*/
	
$rs2 = mysql_query("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,DATE_FORMAT(b.data_entrega, '%d/%m/%Y') dt_entreg
					,DATE_FORMAT(b.dt_preventr, '%d/%m/%Y') dt_preventr2,
					b.tel_contat,b.email,b.num_conhec,b.sit_fatura
      FROM tb_saidaprodac a " . $p2a . "
	   where a.id_saidaprodac > 0 " . $p1a . $p2 .$p100 .$p111 .$p101 . $p201 . $p400 .  $p300t . "	
	 order by  a.data_nf desc limit 650");		 		  



    $b = mysql_num_rows($rs2);

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
	<title>MATPAC004 - CONSULTA SAIDAS DE PRODUTOS ACABADOS</title>
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
		janela = 	window.open (app,"mywindow1","menubar=0,top=50,left=10,scrollbars=yes,resizable=1,width=1200,status=yes,height=600"); 
		
		//janela.captureEvents(Event.RESIZE);
		//janela.onresize=informar;
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

<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Informa&ccedil;&otilde;es de Fretes - 
        <?php
	echo($hoje);
	if($data_1 !="" || $data_2 != ""){
		echo("<br> Período Pesquisado : ".$data_1 . " a " . $data_2 );
	}
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
    </table>
      <table width="100%" border="0">

      
            <tr >
              <th colspan="3" align="center">
              Produto
                  <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="20" size=10 />
                  N.pedido
                  <input type="text" name="npedido2" id="npedido2" maxlenght="20" size=10 autofocus /> 
              
              NF 
              <input type="text" id = "nf_p"  name="nf_p"  maxlength="10" size="10" placeholder="informe a NF !"  value="">
              Lote
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="20" size="8" placeholder="informe o lote !"  value=""><br>
              Cliente 
              <input type="text" id = "clie_p"  name="clie_p"  maxlength="25" size="22" placeholder="informe o cliente"  value="">
              
              Transportadora 
              <input type="text" id = "trans_p"  name="trans_p"  maxlength="25" size="20" placeholder="informe a transportadora"  value="">
       Período 
          <input type="text" name="data_1" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
Situação Fatura
<select name="sit_fat" class="search-input3" >
  <option value="" >Situa&ccedil;&atilde;o da fatura</option>
  <option value="A"<?php if($sit_fat == 'A' ) {?> selected <?php }?>>Aberta</option>
  <option value="F"<?php if($sit_fat == 'F' ) {?> selected <?php }?>>Fechada</option>
  <option value="P"<?php if($sit_fat == 'P' ) {?> selected <?php }?>>Pendente</option>
</select>
<input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto</th>
                  <th >N. Lote</th>
                  <th>Dt Fatura</th>
                  <th>Quantidade</th>
                  <th>Unidade</th>
                  <th >N. Pedido</th>
                  <th >N. NF</th>
                  <th >Data NF</th>
                  <th >Cliente</th>
                  <th >CTE</th>
                  <th >Transportadora</th>
                  <th >Tel.</th>
                  <th >E-mail</th>
                  <th >Prev.Entrega</th>
                  <th >Data Entrega</th>
                  <th >Fatura</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $ttquant = 0;
	  $tt_ltprod = 0;
	  while($row=mysql_fetch_array($rs2)){ 
	  
		  $tt_ltprod ++;
		  
      $rs_prd = mysql_query("Select b.* from tb_produto b where b.cod_prod = '" . $row['cod_prod'] . "'" . $p1 );
	  $row_prd = mysql_fetch_assoc($rs_prd);
	  $descr_prod   = $row_prd['descr_prod'];


     //echo("Select c.* from tb_cliente c where c.codigo_cli = '" . $row['codigo_cli'] . "'" . $p200 );
      $rs_cli = mysql_query("Select c.* from tb_cliente c where c.codigo_cli = '" . $row['codigo_cli'] . "'" . $p200 );
	  $row_cli = mysql_fetch_assoc($rs_cli);
	  $nome_cli = $row_cli['nome_cli'];
	  $cidade_cli = $row_cli['cidade'];
	  $uf_cli = $row_cli['uf'];
	  
	  
      $rs_for = mysql_query("Select d.* from tb_fornecedor d where d.cod_fornec = '" . $row['cod_fornec'] . "'"  );
	  $row_for = mysql_fetch_assoc($rs_for);
	  $rz_social = $row_for['rz_social'];

	  	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td >
                <?php //matpac003.php ?>
               <?php echo ($row['cod_prod'] . " - " . $descr_prod);?></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php 
		         $ano = date("Y", $row['data_fatura']);
		         if ($ano > 0){
    		        echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));
				 }
		   ?></td>
           <td align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($row['quantid'],0,',',''));?></td>
           <td align="center" ><?php echo strtoupper ( ($row['unidade']));?></td>
           <td align="center" >
		            <?php
			   $lnk = "<a href=javascript:ver_entrada('matpac500.php?nped=".$row['num_pedido']."&cli=".$row['codigo_cli']."&nnf=".$row['num_nf']."')>".$row['num_pedido']."<img src='../imagens/transporte.JPG' title='Dados do Transporte da Carga' ></a>" ;
                      echo($lnk ." - ");
			?>
		   </td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli  ." - Cidade : " .$cidade_cli . " - " . $uf_cli); ?></td>
           <td align="left"><?php echo ($row['num_conhec']); ?></td>
           <td align="left"><?php echo ($rz_social); ?></td>
           <td align="center"><?php echo ($row['tel_contat']); ?></td>
           <td align="left"><?php echo ($row['email']); ?></td>
           <td align="center"><?php echo ($row['dt_preventr2']);?></td>
           <td align="center"><?php echo ($row['dt_entreg']);?></td>
           <td align="center"><?php 
		   if ($row['sit_fatura'] == 'A'){
		       echo ("Aberta");}
		   if ($row['sit_fatura'] == 'F'){
		       echo ("Fechada");}
		   if ($row['sit_fatura'] == 'P'){
		       echo ("Pendente");}
			   
		   
		   ?></td>
              </tr>
          <?php 
		   } 
          ?>
               <tr>
                <td align="right" >Total de Lotes</td>
                <td align="right" ><?php echo($tt_ltprod); ?></td>
                <td align="right" >Quantidade Total</td>

           <td align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($ttquant,0,',',''));?></td>
           <td align="center" >&nbsp;</td>
           <td align="center" >&nbsp;</td>
           <td align="center" >&nbsp;</td>
           <td align="center" >&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
           <td align="left">&nbsp;</td>
               </tr>
          <?php		   
	     }
		  ?>      
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
