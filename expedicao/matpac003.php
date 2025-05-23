<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<?php

header('Content-type: text/html; charset=ISO-8859-1');
session_start();
set_time_limit(0);

include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");
  //shell_exec("killall -11 httpd");

/////////////////////


///////////////////



$p1 = "";
$p2 = "";
$p1a =  "";
$p3a =  "";

if (isset($pedido)){
	if ($pedido <> "" ){
        if(!is_numeric($pedido)){
		     $p3a = " and a.num_pedido like '%". $pedido ."%'" ; 			 
			 //$p100 = " inner join tb_cliente c on c.codigo_cli = a.codigo_cli and  c.nome_cli  like '%". $lote_fabr2 ."%'";
			 }
		 else{
			 $p3a = " and cast(a.num_pedido as unsigned) = '" . $pedido ."'" ; 
             //$p100 = " inner join tb_cliente c on c.codigo_cli = a.codigo_cli and c.codigo_cli = '". $lote_fabr2 . "'" ;

			 }
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


if (isset($cli_filtro)){
	if ($cli_filtro <> "" ){
        if(!is_numeric($cli_filtro)){
		   	$p559 = " and a.grupo_cli like '%".$cli_filtro . "%'" . " or a.nome_cli like '%".$cli_filtro .
			 "%'"  . " or a.nm_fantasi like '%".$cli_filtro . "%'";
         }
		 else{
			 $p559 = " and a.codigo_cli = '" . $cli_filtro ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.num_lote ='" . $lote_fabr2 ."'" ; 
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
		//$msg_lote        = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())


/*	 
$rs2 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,d.rz_social
      FROM tb_saidaprodac a
      inner join tb_produto b on b.cod_prod = a.cod_prod " . $p1 . "
	  inner join tb_cliente c on c.codigo_cli = a.codigo_cli
	  inner join tb_fornecedor d on d.cod_fornec = a.cod_fornec
	  where a.id_saidaprodac > 0   " . $p2 . "	
	 order by id_saidaprodac desc limit 400 ");		 		  
*/

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){


$rs2 = mysql_query("SELECT a.*
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
      FROM tb_saidaprodac a
	  where a.id_saidaprodac > 0   " . $p2 . $p1a . $p3a ."	
	 order by a.data_nf desc limit 700 ");		 		  

	 
    $b = mysql_num_rows($rs2);
	
	
}
////////////////////fim pesquisar ////////////////////////
/*	
$rs299 = mysql_query ("SELECT * FROM tb_fornecedor where rz_social like '%transp%' 
or rz_social like '%viacao%' or rz_social like '%logistica%' or rz_social like '%livia%' 
or rz_social like '%tormes%' or rz_social like '%ODETE%' or rz_social like '%CLIENTE%' or rz_social like '%KOCH%'
or rz_social like '%RODOVIARIO%' 
 group by trim(rz_social) order by rz_social ");
 */
 
 $rs299 = mysql_query ("SELECT a.* FROM tb_fornecedor a where a.cod_fornec > 101000 and a.cod_fornec < 150000
 group by trim(a.rz_social) order by a.rz_social ");

 
 
/* 
 $rs320 = mysql_query("select a.codigo_cli,a.nome_cli from tb_cliente a  where a.codigo_cli > 0 " .$p559 . " order by a.nome_cli "); 
*/
 $rs320 = mysql_query("select a.codigo_cli,a.nome_cli from tb_cliente a  where a.codigo_cli > 0 order by a.nome_cli "); 


 $rs32 = mysql_query("SELECT a.*,b.tt_lote ,c.descr_prod FROM tb_entprodac a
					  inner join tv_saldoltprac b on b.cod_prod = a .cod_prod and b.num_lote = a.num_lote
					  inner join tb_produto c on c.cod_prod = a.cod_prod
					  and b.tt_lote > 0
					  where b.tt_lote > 0  group by a.cod_prod");
					  
					  //where a.data_liblote is not null  group by a.cod_prod");
					  

 $rs33 = mysql_query("SELECT a.*,sum(b.tt_lote) tt_lote,  DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote1,sum(a.quant_fabr) quant_fabr2   FROM tb_entprodac a
					  inner join tv_saldoltprac b on b.cod_prod = a .cod_prod and b.num_lote = a.num_lote
					  and b.tt_lote > 0
					  where  a.cod_prod = '" . $cod_prod . "'
					  group by a.cod_prod, a.num_lote
					  order by a.num_lote ");			
					  
					   // where a.data_liblote is not null  
					 // and a.cod_prod = '" . $cod_prod . "'	
			  					   
 $fab = "";
 $venc = "";
 
$lm = "";					
					
$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
	$rs1 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli ,d.msg_lote
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf,DATE_FORMAT(a.data_fatura, '%d/%m/%Y') dt_fat,d.*
					,  DATE_FORMAT(d.data_liblote, '%d/%m/%Y') data_liblote1
                    FROM tb_saidaprodac a
                    inner join tb_produto b on a.cod_prod = b.cod_prod 
	                inner join tb_cliente c on c.codigo_cli = a.codigo_cli
					inner join tb_entprodac d on a.cod_prod = d.cod_prod and a.num_lote = d.num_lote
	                where a.id_saidaprodac = '" . $id . "'");									
																
    $a = mysql_num_rows($rs1);

    if ($a > 0 ) {
		
        $row33a = mysql_fetch_assoc($rs1);
		$cod_prod    = $row33a['cod_prod'];
		$unidade     = $row33a['unidade'];
		$num_lote    = $row33a['num_lote'];
		$codigo_cli  = $row33a['codigo_cli'];
		$quantid     = $row33a['quantid'];
		$num_pedido  = $row33a['num_pedido'];
		$num_nf      = $row33a['num_nf'];
		$data_nf     = $row33a['dt_nf'];
		$data_fatura = $row33a['dt_fat'];
		//$msg_lote    = $row33a['msg_lote'];
	    //$transport   = $row33a['transport'];
		$cod_fornec  = $row33a['cod_fornec'];		 			  

		$data_fabr    = $row33a['data_fabr'];
		$data_venc    = $row33a['data_venc'];
		$data_liblote = $row33a['data_liblote1'];
		$msg_lote     = $row33a['msg_lote'];
							  
	    $rs33 = mysql_query("SELECT a.* FROM tv_saldoltprac a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");				


        $row33a = mysql_fetch_assoc($rs33);
    	$sald_lote = $row33a['tt_lote'];	
		

		$lm = "N"; 	
	  }
  
 }

//echo("lote=".$num_lote);
if (isset($_POST['msg_lote'])){
//&&  $_POST['msg_lote'] <> ''
	if (!is_null( $_POST['msg_lote']) ){
		if(isset($_POST["gravaobs"])){
           echo "botão foi clicado";
	        $sqlins = "update tb_entprodac set msg_lote = '"   . $_POST['msg_lote'] . "'  where cod_prod = '".$cod_prod."' and num_lote = '" . $num_lote . "'";
	//    	  echo($sqlins);
			   $updt=mysql_query( $sqlins );
			   }
//echo($sqlins);
		   
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
	<title>MATPAC003 - SAIDAS DE PRODUTOS ACABADOS</title>
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
		  document.form1.cod_fornec.value = '';
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



<!-- EXIBE O CONTADOR -->

</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Sa&iacute;das de Produtos Acabados- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br>
        <?php echo($_SESSION['nome_usu']);?>
        </th>
      </tr>
</table> 
 <table width="95%" border="0">
     <tr>
        <th colspan="2" align="right">Produto</th>
        <th colspan="2" align="left"><select name="cod_prod" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
            <option value="">Selecione o Produto</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">Lote</th>
        <th colspan="2" align="left">
        
<input type=hidden name="lm" value="<?php echo($lm); ?>">

<?php 
//  
//		
      if ($lm == "") { ?>
        <select name="num_lote" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();" >
         <option value="" >Selecione o Lote</option>
          <?php 
		  $sald_lote = 0;

		  while($row33=mysql_fetch_assoc($rs33) ){ 
		     if( $row33['tt_lote'] > 0.000){
		  ?>
          <option value="<?php print($row33['num_lote'])?>"
				  <?php if($row33['num_lote'] == $num_lote ) {?>selected 
				  <?php  
				  		  $rs33x = mysql_query("SELECT a.* FROM tv_saldoltprac a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");				
                          $row33x = mysql_fetch_assoc($rs33x);

				         $sald_lote = $row33x['tt_lote']; 
				         $data_fabr    = $row33['data_fabr'];
						 $data_venc    = $row33['data_venc'];
						 $data_liblote = $row33['data_liblote1'];
                         
						 $rs33x1 = mysql_query("SELECT a.* FROM tb_entprodac a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $row33['num_lote'] . "'");				
                         $row33x1 = mysql_fetch_assoc($rs33x1);
						 $msg_lote = $row33x1['msg_lote'];
						 
						 
				  }?>				
				 ><?php print($row33['num_lote']);?></option>
          <?php }}?>
        </select>
        <?php 
	}
		else{
		    ?><input type="text" name="num_lote" value="<?php echo($num_lote);?>" disabled> <?php 
		}
		 ?>
        </th>
      </tr>
      <tr>
        <th colspan="2" align="right">Quantidade em Estoque</th>
        <th align="left"><font size="4"><?php echo(number_format($sald_lote,2,',','')); ?> </font></th>
        <input type="hidden" name="ttestoq" value="<?php echo($sald_lote); ?>">
        <th align="left">Fabrica&ccedil;&atilde;o:<?php echo($data_fabr);?></th>
        <th align="left"><p> Vencimento:<?php echo($data_venc);?></p></th>
        <th colspan="2" align="left">Data Libera&ccedil;&atilde;o :<?php echo($data_liblote);?></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Obs. Lote</th>
        <th colspan="5" align="left">  
              <input readonly type=hidden name=x size=3 maxlength=3 value="250">

          <textarea name="msg_lote" cols="105" rows="3"  onchange="textCounter(this.form.msg_lote,this.form.x,330);"  onKeyDown="textCounter(this.form.msg_lote,this.form.x,330);"  ><?php echo($msg_lote) ?></textarea></td>
        <input type="submit" name="gravaobs"  value="Gravar Obs"/></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Filtro Cliente</th>
        <th colspan="5" align="left">    <input type="text" name="cli_filtro" id="textfield" size="80" maxlength="80"  placeholder="informe Nome ou Codigo"  />
          <input type="submit" name="Submit"  value="Filtrar"/></th>
      </tr>
      <tr>
        <th colspan="7" align="center"  bgcolor="#8080FF">Dados da Saida</th>
      </tr>
      <tr>
        <th colspan="2" align="right">Cliente</th>
        <th colspan="3" align="left">
          <select name="codigo_cli"  <?php if($habilita ==1) ?> >
            <option value="">Selecione o Cliente</option>
            <?php while($row320=mysql_fetch_assoc($rs320)){ ?>
            <option value="<?php print($row320['codigo_cli'])?>"
				  <? if($row320['codigo_cli'] == $codigo_cli ) {?>selected <? } ?>				
				 ><?php print($row320['nome_cli']. " - " . $row320['codigo_cli']  )?></option>
            <?php }?>
        </select></th>
        <th align="right">N. Pedido        </th>
        <th align="left"><input type="text" id = "num_pedido"  name="num_pedido"  maxlength="15" size="12" placeholder="informe o Numero do pedido!"  value="<?php echo($num_pedido); ?>"></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Quantidade</th>
        <th align="left"><input type="text" id = "quantid"  name="quantid"  maxlength="10" size="10" placeholder="informe a Quantidade"  value="<?php echo(number_format($quantid,3,'.',','));  ?>" ></th>
        <th align="right">Unidade</th>
        <th align="left"><input type="text" id = "unidade"  name="unidade"  maxlength="10" size="10" placeholder="informe a unidade"  value="<?php echo($unidade); ?>" ></th>
        <th align="right">Data Fatura</th>
        <th align="left"><input type="text" name="data_fatura" size="8" maxlength="10"  placeholder="Informe Data" 
        value="<?php echo ($data_fatura); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_fatura);" onChange="verifica_data(this.value,data_fatura);"/></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Num. NF</th>
        <th align="left"><input type="text" id = "num_nf"  name="num_nf"  maxlength="15" size="12" placeholder="informe a NF !"  value="<?php echo($num_nf); ?>"></th>
        <th align="right">Data NF</th>
        <th align="left"><input type="text" name="data_nf" size="8" maxlength="10"  placeholder="Informe Data" 
        value="<?php echo ($data_nf); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_nf);" onChange="verifica_data(this.value,data_nf);"/></th>
        <th align="right">&nbsp;</th>
        <th align="left">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="2" align="right">Transportadora</th>
        <th colspan="5" align="left"><select name="cod_fornec" style="font-size:10">
          <option value="">Selecione Transportadora</option>
          <?php while($row299=mysql_fetch_assoc($rs299)){ ?>
          <option value="<?php print($row299['cod_fornec'])?>"
				  <? if($row299['cod_fornec'] == $cod_fornec ) {?>selected <? } ?>				
				 ><?php print( $row299['rz_social']  . " - " .$row299['cod_fornec'])?></option>
          <?php }?>
          </select>
        </th>
      </tr>
      <tr>
        <th colspan="2" align="right">&nbsp;</th>
        <th colspan="5" align="left">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="8" align="center">
        <?php 
		if ($_SESSION['permi'] == 999 ||  $_SESSION['id_setor'] == 23){ 
		
		?>
          <input type="button" name="gravar"  onClick="validasaidaprodc();" value="Gravar"  class="search-submit2"/>
          <?php 
	 }
		  ?>
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();"  class="search-submit2">
        <?php
		 if ($_SESSION['permi'] == 999){ ?>
          <input type="button" name="Submit4"  onclick="excluirsaidaprodac(<?php echo($id); ?>);" value="Excluir"  class="search-submit2"/>
          <?php 
		 }
		  ?>
 
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2">
        </th>
        </tr>
            <tr >
              <th colspan="8" align="center"><h1>Registros de Sa&iacute;das Produtos Acabados</h1></th>
            </tr>
            <tr >
              <th colspan="8" align="center">
                Produto
                  <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>Lote 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="">
              Pedido
               <input type="text" id = "pedido"  name="pedido"  maxlength="25" size="32" placeholder="informe codigo ou o nome"  value="" autofocus>
              <input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
              </th>
            </tr>
            <tr align="center">
              <td colspan="8" align="center">
              
              
  <?php
  
  
///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
	
	?>
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
	  
	  while($row=mysql_fetch_array($rs2)){ 

 		  
      $rs_prd = mysql_query("Select * from tb_produto a where a.cod_prod = '" . $row['cod_prod'] . "'");
	  $row_prd = mysql_fetch_assoc($rs_prd);
	  $descr_prod = $row_prd['descr_prod'];

      $rs_cli = mysql_query("Select * from tb_cliente a where a.codigo_cli = '" . $row['codigo_cli'] . "'");
	  $row_cli = mysql_fetch_assoc($rs_cli);
	  $nome_cli = $row_cli['nome_cli'];


      $rs_for = mysql_query("Select * from tb_fornecedor a where a.cod_fornec = '" . $row['cod_fornec'] . "'");
	  $row_for = mysql_fetch_assoc($rs_for);
	  $rz_social = $row_for['rz_social'];

						 

       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td >
                
                <?php 
				$bxx = 0;
	   
				$rsxx = mysql_query("SELECT a.* FROM tv_saldoltprac a 
	           where a.cod_prod = '" . $row['cod_prod'] . "' and a.num_lote = '" .$row['num_lote'] . "' 	
	           order by a.cod_prod desc limit 1 ");		 		  
	 
	
              $bxx = mysql_num_rows($rsxx);
				
				?>
                
           <a href="matpac003.php?id=<?php echo ($row['id_saidaprodac']);?>"><?php echo ($row['cod_prod'] . " - " . $descr_prod);
		    
		   ?></a> 
		   <?php  
           
 	if ($_SESSION['permi'] == 999){ 
		
		
		   	if($bxx == 0){echo("<b> <font color = red> * EXCLUIR * ");
				//	if ($_SESSION['permi'] != 300){ 
				         echo(" <a href='matpacd03.php?id=". $row['id_saidaprodac'] ."'>* EXCLUIR *</a> </font> <b>");
		   		 //   }
		    } 
         }   
            ?>
           
           </td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" ><?php echo(number_format($row['quantid'],2,',',''));?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_pedido']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli); ?></td>
           <td align="left"><?php echo ($rz_social); ?></td>
              </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>
         
  <?php
   }
     /////////////////////fim pesquisar //////////////
	 
?>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
