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
if (isset($ctep)){
	if ($ctep <> "" ){
		 $p111 = " and a.num_conhec in (" . $ctep .")" ; 
	 }
}
	
if (isset($npedido2)){
	if ($npedido2 <> "" ){
		 $p112 = " and a.num_pedido in (" . $npedido2 .")" ; 
	 }
}
			
		
if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p100 = " and a.dt_emis >= '" . formata_data2($data_1) ."'" ; 
	 }
}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p101 = " and a.dt_emis <= '" . formata_data2($data_2) ."'" ; 
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

	  $p300t = " and b.cod_fornec =  '" . $cod_fornect ."'" ; 
	 }else {
		 $p300t = " and b.cod_fornec =  '" . $trans_p ."'" ; 
	 
	 }
    }
}

if(isset($nf_p)){
	if ($nf_p <> "" ){
			 $p400 = " and a.num_nf = '" . $nf_p ."'" ; 
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
$escolha = '';
$p00 = '';

if (isset($_POST['autoriz'])) {
    $escolha = $_POST['autoriz'];
} 


switch ($escolha) {
    case 1:
        $p00 = " and a.autorizac = 'S' ";
        break;
    case 2:
        $p00 = " and a.autorizac != 'S' ";
        break;
}




$rs2 = mysql_query("select a.*
					,DATE_FORMAT(a.data_entrega, '%d/%m/%Y') data_entrega2
					,DATE_FORMAT(a.dt_preventr, '%d/%m/%Y') dt_preventr2,
					b.cod_prod,b.unidade,b.num_lote,b.quantid,
					b.codigo_cli,b.num_nf,b.data_nf,b.tot_nota,b.peso_bruto
					,DATE_FORMAT(b.data_fatura, '%d/%m/%Y') data_fatura
					,DATE_FORMAT(a.data_autori, '%d/%m/%Y') data_autori2
					,b.cod_fornec,b.msg_lote,b.obs_bonif,b.sigla_bonifi,b.val_unit,b.tot_nota
					from tb_infocarga a
					inner join tb_saidaprodac b on a.num_pedido = b.num_pedido " .$p300t ."
					inner join tv_percfret c on a.num_conhec = c.num_conhec and c.perc_fretfr > 4
					where a.id_infocarga > 0 ".$p00 . $p1a .$p100 .$p111 .$p112 .$p101 . $p201 . $p400 .   "
					group by a.num_conhec,a.num_nf
					order by a.num_conhec desc
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
	<title>MATPA512 - Fretes para aprovação</title>
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
		janela = 	window.open (app,"mywindow1","menubar=0,top=50,left=10,scrollbars=yes,resizable=1,width=1200,status=yes,height=400"); 
		
		//janela.captureEvents(Event.RESIZE);
		//janela.onresize=informar;
				 // return true;

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
        <th align="center" ><h1>Fretes acima de 4% para aprova&ccedil;&atilde;o
          - <?php
	echo($hoje);
	if($data_1 !="" || $data_2 != ""){
		echo("<br> Período Pesquisado : ".$data_1 . " a " . $data_2 );
	}

		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a><br>
        <h4><?php echo($_SESSION['nome_usu'])?></h4>
        </th>
      </tr>
    </table>
      <table width="99%" border="0">

      
            <tr >
              <th colspan="3" align="center">
              CTE
                  <input type="text" name="ctep" id="ctep" maxlenght="40" size=40 />
                  N.pedido
                  <input type="text" name="npedido2" id="npedido2" maxlenght="20" size=10 /> 
              
              NF 
              <input type="text" id = "nf_p"  name="nf_p"  maxlength="10" size="10" placeholder="informe a NF !"  value="">
              
              Cliente 
              <input type="text" id = "clie_p"  name="clie_p"  maxlength="25" size="22" placeholder="informe o cliente"  value="">
              <br>
              Transportadora 
              <input type="text" id = "trans_p"  name="trans_p"  maxlength="25" size="20" placeholder="informe a transportadora"  value="">
       Período 
          <input type="text" name="data_1" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
Situa&ccedil;&atilde;o
			  <input type="radio" name="autoriz" id="autoriz" value="1">
              <label for="autorz">Autorizados</label>
              <input type="radio" name="autoriz" id="autoriz" value="2">
              <label for="autorz">Em Aberto</label>
              <input type="radio" name="autoriz" id="autoriz" value="3">
              <label for="autorz">Todos</label>

              <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              <input type="button" onClick="sair2();" value="Sair" class="search-submit2"></th>
        </tr>
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
                  <th >CTE</th>
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
  
	  while($row=mysql_fetch_array($rs2)){ 
	  
		  $tt_ltprod ++;
		  		  
		  echo($nmaut);
		  
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
		  
         $totg_fret = $totg_fret + $tot_fr;
		 $totg_nf   = $totg_nf + $tot_nf;

		 
		 
	//	 $icms    = ($tot_fr * $aliq_icms) / 100 ;
	//	 $percfat = ($tot_fr / $tot_nf) * 100 ;
		 if ($percfat > 4 ){
			 $bl = "<img src='../imagens/bolinha_vermelha.jpg'>";
		     if ($autorizac == "S"){
				 $bl = "<img src='../imagens/pend_ok.PNG'> Autorizado " ;	 
			 }
		 }

		 
		 echo ("<tr bgcolor=#E9E9E9 valign='middle'>
		 <th colspan=2><h3> N. CTE:".$cte_l . "</h3></th>
         <th colspan=2><h3> Total NF:".number_format($tot_nf,2,',','.') . "</h3></th>
         <th colspan=2><h3> Total Frete:".number_format($tot_fr,2,',','.') . "</h3></th>
		 <th colspan=2><h3> % ICMS:".number_format($aliq_icms,2,',','.') . "%</h3></th>
		 <th colspan=1><h3> Valor ICMS:".number_format($icms,2,',','.') . "</h3></th>
		 <th colspan=5><h3> % Frete:".number_format($percfat,2,',','.') . "% " . $bl . "</h3></th>
		 <th ><h3>" . $lnk1 . "</h3></th>
		 
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
           <th align="center" ><?php 
		   	   if ($row['dt_fat'] != '0000-00-00'){
    		        echo($row['data_fatura']);
			   }
		   
		   ?></th>
           <th align="right" ><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($row['quantid'],0,',',''));?></th>
           <th align="center" ><?php echo strtoupper ( ($row['unidade']));?></th>
           <th align="center" >
		            <?php
			    $lnk = "<a href=javascript:ver_entrada('matpac500a.php?cte=".$row['num_conhec']."')>".$row['num_pedido']."<img src='../imagens/transporte.JPG' title='Dados do Transporte da Carga' ></a>" ;
                      echo($lnk ." - ");
	

			?>
		   </th>
           <th align="center" ><?php echo ($row['num_nf']);?></th>
           <th align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></th>
           <th align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli  ." - Cidade : " .$cidade_cli . " - " . $uf_cli); ?></th>
           <th align="left"><?php echo ($row['num_conhec']); ?></th>
           <th align="left"><?php echo ($rz_social); ?></th>
           <th align="center"><?php echo ($row['tel_contat']); ?></th>
           <th align="left"><?php echo ($row['email']); ?></th>
           <th align="center"><?php echo ($row['dt_preventr2']);?></th>
           <th align="center"><?php echo ($row['data_entrega2']);?></th>
           </tr>
          <?php 
		  			 $cte_l      = $row['num_conhec'];

		  		  $rs_frt = mysql_query("Select d.* from tv_percfret d where d.num_conhec = '" . $cte_l . "'"  );
		  $row_frt = mysql_fetch_assoc($rs_frt);

		  		  $autorizac = $row_frt['autorizacfr'];

		     if ($_SESSION['permi'] == 222  || $_SESSION['permi'] == 999){
		  	    $lnk1 = "<a href=javascript:ver_entrada('matpac500a.php?cte=".$row['num_conhec']."')> Analisar<img src='../imagens/transporte.JPG' title='Dados do Transporte da Carga' ></a>" ;
			 }

		   } 
		   
		   	 if ($percfat > 4 ){
			     $bl = "<img src='../imagens/bolinha_vermelha.jpg'>";
		         if ($autorizac == "S"){
				      $bl = "<img src='../imagens/pend_ok.PNG'> - Autorizado ";	 
			     }
		     }

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
				 $bl = "<img src='../imagens/pend_ok.PNG'> Autorizado " ;	 
			 }
		 }
         $totg_fret = $totg_fret + $tot_fr;
		 $totg_nf   = $totg_nf + $tot_nf;
		 $percg_fret = ($totg_fret /  $totg_nf) * 100;
		 
		 echo ("<tr bgcolor=#E9E9E9 valign='middle'>
		 <th colspan=2><h3> N. CTE:".$cte_l . "</h3></th>
         <th colspan=2><h3> Total NF:".number_format($tot_nf,2,',','.') . "</h3></th>
         <th colspan=2><h3> Total Frete:".number_format($tot_fr,2,',','.') . "</h3></th>
		 <th colspan=2><h3> % ICMS:".number_format($aliq_icms,2,',','.') . "%</h3></th>
		 <th colspan=1><h3> Valor ICMS:".number_format($icms,2,',','.') . "</h3></th>
		 <th colspan=5><h3> % Frete:".number_format($percfat,2,',','.') . "% " . $bl . "</h3></th>
		 <th ><h3>" . $lnk1 . "</h3></th>
		 </tr>");
          ?>
          
                    <tr><td align="center" colspan="15">
           <table>
               <tr>
                <th align="right" ><h3>Total de Lotes:</h3></th>
                <th align="right" ><h3><?php echo($tt_ltprod); ?></h3></th>
                <th align="center" >&nbsp;</th>
                <th align="right" ><h3>Quantidade Total:</h3></th>
           <th align="right" ><h3><?php
		     $ttquant =  $ttquant + $row['quantid'];
		    echo(number_format($ttquant,0,',',''));?></h3></th>
            <th align="center" >&nbsp;</th>
           <th align="center" ><h3>Total Fretes:</h3></th>
           <th align="center" ><h3><?php echo(number_format($totg_fret,2,',','.'));?> </h3></th>
           <th align="left">&nbsp;</th>
           <th align="left"><h3>Total NFs:</h3></th>
           <th align="left"><h3><?php echo(number_format($totg_nf,2,',','.'));?> </h3></th>
           <th align="left">&nbsp;</th>
           <th align="left"><h3>% Frete:<h3></th>
           <th align="left"><h3><?php echo(number_format($percg_fret,2,',','.'));?>% </h3></th>
           <th align="left">&nbsp;</th>
           </tr>
           </table>
           </td></tr>


          <?php		   
	     }
		  ?>      
         </table>
              
         </th>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
