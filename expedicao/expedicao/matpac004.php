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

$p2 = "";

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
	
$rs2 = mysql_query("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
      FROM tb_saidaprodac a
	   where a.id_saidaprodac > 0 " . $p1a . $p2 .$p100 .$p101 . $p201 . $p400 .  $p300t . "	
	 order by  a.data_nf desc, CAST(num_nf AS DECIMAL) desc limit 650");		 		  


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
        <th align="center" ><h1>Consulta Sa&iacute;das de Produtos Acabados- 
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
              <th colspan="3" align="left">
              Produto
                  <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="20" size=10 /> 
              Lote 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="20" size="8" placeholder="informe o lote !"  value="">
              NF 
              <input type="text" id = "nf_p"  name="nf_p"  maxlength="10" size="10" placeholder="informe a NF !"  value="">
              Cliente 
              <input type="text" id = "clie_p"  name="clie_p"  maxlength="25" size="22" placeholder="informe o cliente"  value="">
              
              Transportadora 
              <input type="text" id = "trans_p"  name="trans_p"  maxlength="25" size="20" placeholder="informe a transportadora"  value="">
       Período 
          <input type="text" name="data_1" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              <input type="button" onClick="sair();" value="Sair"></th>
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
                  <th >Transportadora</th>
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
           <a href="#?id=<?php echo ($row['id_saidaprodac']);?>"><?php echo ($row['cod_prod'] . " - " . $descr_prod);?></a></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($row['quantid'],0,',',''));?></td>
           <td align="center" ><?php echo strtoupper ( ($row['unidade']));?></td>
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
