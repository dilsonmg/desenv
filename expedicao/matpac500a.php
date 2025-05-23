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


$ctep = $_GET ["cte"];

if (isset($ctep)){
	if ($ctep <> "" ){
		 $p111 = " and a.num_conhec in (" . $ctep .")" ; 
	 }
}

$p300t = "";

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

$rs2 = mysql_query("select a.*
					,DATE_FORMAT(a.data_entrega, '%d/%m/%Y') data_entrega2
					,DATE_FORMAT(a.dt_preventr, '%d/%m/%Y') dt_preventr2,
					b.cod_prod,b.unidade,b.num_lote,b.quantid,
					b.codigo_cli,b.num_nf,b.data_nf,b.tot_nota,b.peso_bruto
					,DATE_FORMAT(b.data_fatura, '%d/%m/%Y') data_fatura
					,b.cod_fornec,b.msg_lote,b.obs_bonif,b.sigla_bonifi,b.val_unit,b.tot_nota
					from tb_infocarga a
					inner join tb_saidaprodac b on a.num_pedido = b.num_pedido " .$p300t ."
					inner join tv_percfret c on a.num_conhec = c.num_conhec and c.perc_fretfr > 4
					where a.id_infocarga > 0 ". $p1a .$p100 .$p111 .$p112 .$p101 . $p201 . $p400 .   "
					group by a.num_conhec,a.num_nf
					order by a.num_conhec
					limit 650");		 		  

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
/**/
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
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
<input type="hidden" name="num_conhec" value = "<?php echo($ctep) ?>">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Aprova&ccedil;&atilde;o de Fretes acima de 4%
          - 
          <?php
	echo($hoje);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
    </table>
      <table width="99%" border="0">

            <tr align="center">
              <th colspan="3" align="center">
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
                  <th >Tel.</th>
                  <th >E-mail</th>
                  <th >Prev.Entrega</th>
                  <th >Data Entrega</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $ttquant = 0;
	  $tt_ltprod = 0;
	  $cte_l = '';
	  $tot_nf = 0.00;
	  $tot_fr = 0.00;
	  $val_fret = 0.00;
	  $aliq_icms = 0.00;
	  
	 $icms    = 0.00 ;
	 $percfat = 0.00 ;
	  
	  
      $nnf ='';
	  $autorizac = "";

	while($row=mysql_fetch_array($rs2)){ 
	  
      $rs_frt = mysql_query("Select d.* from tv_percfret d where d.num_conhec = '" . $ctep . "'"  );
	  $row_frt = mysql_fetch_assoc($rs_frt);

	  $tot_nf    = $row_frt['tot_notafr'];
	  $tot_fr    = $row_frt['val_fretfr']; 	 
	  $aliq_icms = $row_frt['aliq_icmsfr'];	 
	  $icms      = $row_frt['icmsfretfr'];
	  $percfat	 = $row_frt['perc_fretfr'];
	  $autorizac = $row_frt['autorizacfr'];

	  
    	  $nm_autori = $row['nm_autori'];
		  $data_autori = $hoje;
		  
		  if($row['data_autori'] != "" and $row['data_autori'] != "0000-00-00" ){		  
			  $data_autori = strftime("%d/%m/%Y", strtotime($row['data_autori']));
		  }
		  $autorizac = $row['autorizac'] ;
	      
		  if($nm_autori == ''){
			  $nm_autori = $_SESSION['nome_usu'];
		  }
	  
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
     if($nnf = ''){
		 $nnf = $row['num_nf'];
	 }
	 
     if ($cte_l == "") {
		 $cte_l      = $row['num_conhec'];
	 }
	 
     $bl = "";
     if ($cte_l != $row['num_conhec']){
      $rs_frt = mysql_query("Select d.* from tv_percfret d where d.num_conhec = '" . $cte_l . "'"  );
	  $row_frt = mysql_fetch_assoc($rs_frt);

	  $tot_nf    = $row_frt['tot_notafr'];
	  $tot_fr    = $row_frt['val_fretfr']; 	 
	  $aliq_icms = $row_frt['aliq_icmsfr'];	 
	  $icms      = $row_frt['icmsfretfr'];
	  $percfat	 = $row_frt['perc_fretfr'];
	  $autorizac = $row_frt['autorizacfr'];
	  
		 
	//	 $icms    = ($tot_fr * $aliq_icms) / 100 ;
	//	 $percfat = ($tot_fr / $tot_nf) * 100 ;
		 if ($percfat > 4 ){
			 $bl = "<img src='../imagens/bolinha_vermelha.jpg'>";
		     if ($autorizac == "S"){
				 $bl = "<img src='../imagens/pend_ok.PNG'>";	 
			 }
		 }
		 
		 echo ("<tr bgcolor=#E9E9E9 valign='middle'>
		 <th colspan=2><h3> N. CTE:".$cte_l . "</h3></th>
         <th colspan=2><h3> Total NF:".number_format($tot_nf,2,',','.') . "</h3></th>
         <th colspan=2><h3> Total Frete:".number_format($tot_fr,2,',','.') . "</h3></th>
		 <th colspan=2><h3> % ICMS:".number_format($aliq_icms,2,',','.') . "%</h3></th>
		 <th colspan=1><h3> % ICMS:".number_format($icms,2,',','.') . "</h3></th>
		 <th colspan=6><h3> % Frete:".number_format($percfat,2,',','.') . "% " . $bl . "</h3></th>
		 </tr>");
		 
         
		 $cte_l = $row['num_conhec'];	
	 }
	  	  
       if($bg == 1){
   	       $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <th >
                <?php //matpac003.php ?>
               <?php echo ($row['cod_prod'] . " - " . $descr_prod);?></th>

           <th align="right"><?php echo ($row['num_lote']);?></th>
           <th align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></th>
           <th align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($row['quantid'],0,',',''));?></th>
           <th align="center" ><?php echo strtoupper ( ($row['unidade']));?></th>
           <th align="center" >
		    <?php
			   $lnk = "<a href=javascript:ver_entrada('matpac500a.php?nped=".$row['num_pedido']."&cli=".$row['codigo_cli']."&nnf=".$row['num_nf']."')>".$row['num_pedido']."<img src='../imagens/transporte.JPG' title='Dados do Transporte da Carga' ></a>" ;
                      echo($lnk ." - ");
	
			?>
		   </th>
           <th align="center" ><?php echo ($row['num_nf']);?></th>
           <th align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></th>
           <th align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli  ." - Cidade : " .$cidade_cli . " - " . $uf_cli); ?></th>
           <th align="left"><?php echo ($rz_social); ?></th>
           <th align="center"><?php echo ($row['tel_contat']); ?></th>
           <th align="left"><?php echo ($row['email']); ?></th>
           <th align="center"><?php echo ($row['dt_preventr2']);?></th>
           <th align="center"><?php echo ($row['data_entrega2']);?></th>
           </tr>
          <?php 
		   } 
		   
		   	 if ($percfat > 4 ){
			 $bl = "<img src='../imagens/bolinha_vermelha.jpg'>";
		     if ($autorizac == "S"){
				 $bl = "<img src='../imagens/pend_ok.PNG'>";	 
			 }
		 }
		 
		 echo ("<tr bgcolor=#E9E9E9 valign='middle'>
		 <th colspan=2><h3> N. CTE:".$cte_l . "</h3></th>
         <th colspan=2><h3> Total NF:".number_format($tot_nf,2,',','.') . "</h3></th>
         <th colspan=2><h3> Total Frete:".number_format($tot_fr,2,',','.') . "</h3></th>
		 <th colspan=2><h3> % ICMS:".number_format($aliq_icms,2,',','.') . "%</h3></th>
		 <th colspan=1><h3> % ICMS:".number_format($icms,2,',','.') . "</h3></th>
		 <th colspan=6><h3> % Frete:".number_format($percfat,2,',','.') . "% " . $bl . "</h3></th>
		 </tr>");
          ?>
               <tr>
                <th align="right" >Total de Lotes</th>
                <th align="right" ><?php echo($tt_ltprod); ?></th>
                <th align="right" >Quantidade Total</th>

           <th align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($ttquant,0,',',''));?></th>
           <th align="center" >&nbsp;</th>
           <th align="center" >&nbsp;</th>
           <th align="center" >&nbsp;</th>
           <th align="center" >&nbsp;</th>
           <th align="left">&nbsp;</th>
           <th align="left">&nbsp;</th>
           <th align="left">&nbsp;</th>
           <th align="left">&nbsp;</th>
           <th align="left">&nbsp;</th>
           <th align="left">&nbsp;</th>
           </tr>
          <?php		   
	     }
		  ?>  
              
         </table>
              
         </th>
         </tr>
            <tr align="center">
              <th colspan="3" align="center">Respons&aacute;vel: 
                <input type="text" name="nm_autori" id="nm_autori" maxlenght="80" size=60  readonly value="<?php echo($nm_autori);?>" class="search-input2"/>
              Data
              <input type="text" name="data_autori" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" readonly class="search-input4" value="<?php echo($data_autori);?>"/> 
              Aprova&ccedil;&atilde;o : 
           <select name="autorizac" class="search-input2" >
                      <option value="" >Selecione a Autorização</option>
                      <option value="S"<?php if($autorizac == 'S' ) {?> selected <?php }?>>Autorizado</option>
                      <option value="N"<?php if($autorizac == 'N' ) {?> selected <?php }?>>Não Autorizado</option>
              	</select>
              
              </th>
             </tr>          
              <tr>
                    <th colspan="3" align="Center" >
                  <input type="button" name="gravar"  onClick="javascript:valida_autorizfr();" value="Gravar" class="search-submit2" />
                  <input type="button" value="Sair"  onClick="javascript:self.close();" class="search-submit2">
                 
                 </th>
    </table>     
</form> 
</center>
</body>
</html>
