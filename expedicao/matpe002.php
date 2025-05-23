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
	<title>MATPE002 - SAIDA DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
    
<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
$p21 = "";

if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p3s = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p4s = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 }}

if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.lote_fabricado = '" . $lote_fabr2 ."'" ; 
	 }
}
if(isset($motivo2)){
	if ($motivo2 <> "" ){
			 $p21 = " and a.motivo like '%" . $motivo2 ."%'" ; 
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
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 

$dt1=explode("/",$hoje);
$hoje_inv ="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";


$a = 0;
$b = 0;
	     $id_saidmat       = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $data_saida       = "";
		 $quantid_said    = "";
		// $lote_fabricado   = "";
          $unidade         = "";
$id = $_GET ["id"];

$habilit = "S";
 $fab = "";
 $venc = "";
 

//DATEDIFF(t.data_conserto,CURDATE())

///////////////////inicio pesquisar //////////////////


/* lotes liberados 
SELECT a.id_entprodac,
     a.num_lote,a.cod_prod,b.descr_prod,a.data_fabr,
STR_TO_DATE(a.data_fabr, '%d/%m/%Y') data_fabconv
 FROM tb_entprodac a
 inner join tb_produto b on b.cod_prod = a.cod_prod
where a.data_liblote is not null
group by a.num_lote
order by STR_TO_DATE(a.data_fabr, '%d/%m/%Y') desc limit 350


select
    b.cnpj," " insc, b.nome_cli,b.grupo_cli,b.cep_cli,b.uf,b.cidade," " endereco,b.tel_contato,
    " " email, DATE_FORMAT(a.data_nf, '%d%m%Y') data_oper,e.cod_prod,a.quantid,
    (a.quantid * a.val_unit) vlr_venda,a.id_consult,c.nome," " BU_elanco,
    d.descricao classificacao," " cpadic1," " cpadic2,"Agroindustria" tipo_loja,
    " " cpadic3," " cpadic4," " cpadic5," " cpadic6," " cpadic7," " cpadic8," " cpadic9," " cpadic10,
    " " cpadic11,a.num_lote,a.num_nf,DATE_FORMAT(a.data_nf, '%d%m%Y') data_nf,a.cfop
from quimicareal.tb_saidaprodac a
    inner join quimicareal.tb_cliente b on a.codigo_cli = b.codigo_cli
    inner join quimicareal.tb_consultor c on c.id_consult = a.id_consult
    inner join quimicareal.tb_tiposaidpa d on d.sigla = a.sigla_bonifi
    inner join quimicareal.tb_produto e on e.cod_prod = a.cod_prod and e.linha in ("elanco-","qreal")
  where a.data_nf >= '2023-10-24'
   order by a.data_nf

*/

$rslib = mysql_query("SELECT a.id_entprodac,
						    a.num_lote,a.cod_prod,b.descr_prod,a.data_fabr,
					        STR_TO_DATE(a.data_fabr, '%d/%m/%Y') data_fabconv
					        FROM tb_entprodac a
					            inner join tb_produto b on b.cod_prod = a.cod_prod
					            where a.data_liblote is not null
					        group by a.num_lote
					        order by STR_TO_DATE(a.data_fabr, '%d/%m/%Y') desc limit 350");

if(isset($_POST["Pesquisar"])){
	
	
	

 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc
					 FROM tb_saidmatp a 
						 inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
						  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
						  where a.id_saidmat > 0 " . $p2 . $p21 . $p3s .$p4s ."
						  group by a.id_saidmat		  
						 order by a.id_saidmat desc LIMIT 80");				  
    $b = mysql_num_rows($rs2);
	
}else {
	 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc
					 FROM tb_saidmatp a 
						 inner join tb_produto b on a.cod_prod = b.cod_prod 
						  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
						  where a.id_saidmat > 0 and a.data_saida =  '" . $hoje_inv . "'
						  group by a.id_saidmat		  
						 order by a.id_saidmat desc LIMIT 80");				  
    $b = mysql_num_rows($rs2);
	
	$_POST["Pesquisar"] = 'S';
	
}
///////////fim pesquisa //////////


	
	//	  group by a.cod_prod, a.num_lote,a.quantid_said , a.data_saida ,a.lote_fabricado
	
$pcd = '';

if (isset($cod_prod) && $cod_prod != ""){
	$pcd = " and a.cod_prod = '".$cod_prod . "'";
}
	

 $rs32 = mysql_query("select a.* from tb_produto a  where a.saldo_prod > 0 and a.linha in ('M.PRIMAS','EMBALAGEM') " . $pcd . " order by a.descr_prod ");

/*
$rs32 = mysql_query("select a.* from tb_produto a
        where a.cod_prod in (SELECT a1.cod_prod
        FROM tv_ttsaidalote a1 where a1.sald_lote > 0)
        order by a.descr_prod ");
*/



 if (isset($cod_prod)){


 	//$rs33 = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
    //                  FROM tv_ttsaidalote a where   a.cod_prod ='".$cod_prod."' and (a.tt_entradalote - a.tt_saidalote) > 0");		
					  
//$rs33=mysql_query(" select a.*, (a.quantid_ent - a.quant_said) saldo
	//			 from tmp_said a where (a.quantid_ent - a.quant_said) > 0");

					  		

 
 $deleta_tab = "drop table tmp_said";
  
 mysql_query($deleta_tab);
 
 $cria_tab = " create table tmp_said as
				select a.cod_prod, a.num_lote, sum(a.quantid_ent) quantid_ent,
				     DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc,
				(select sum(b.quantid_said)
					from tb_saidmatp b where b.cod_prod = '".$cod_prod."' and b.num_lote = a.num_lote
				group by b.cod_prod,b.num_lote) quant_said
				from tb_entmatp a where a.cod_prod = '".$cod_prod."'  group by a.cod_prod,a.num_lote";
				 
 mysql_query($cria_tab);
 }
 
  
$rs33=mysql_query(" select a.*, if(a.quant_said is null,a.quantid_ent,(a.quantid_ent - a.quant_said)) saldo
				 from tmp_said a where a.cod_prod > 0 ") ;
//				 (a.quantid_ent - a.quant_said) > 0");
 
 

$lm = "";					
 if (!isset($id)){
				/*	
				   $rs33a = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
                            , DATE_FORMAT(b.data_fab, '%d/%m/%Y') data_fab,
							DATE_FORMAT(b.data_venc, '%d/%m/%Y') data_venc
							FROM tv_ttsaidalote a
							inner join tb_entmatp b on b.cod_prod = a.cod_prod and b.num_lote = a.num_lote
				    		where a.cod_prod ='".$cod_prod. "' and a.num_lote = '" .$num_lote ."' group by a.cod_prod, a.num_lote");	
					
					echo("select a.* ,
					       if(a.quant_said is null,a.quantid_ent,(a.quantid_ent - a.quant_said)) saldo
					       from tmp_said a where a.cod_prod = '".$cod_prod. "' and a.num_lote = '" .$num_lote . "'");
					*/	   	
					$rs33a = mysql_query("select a.* ,
					       if(a.quant_said is null,a.quantid_ent,(a.quantid_ent - a.quant_said)) saldo
					       from tmp_said a where a.cod_prod = '".$cod_prod. "' and a.num_lote = '" .$num_lote . "'");			  	
                    $row33a = mysql_fetch_assoc($rs33a);
					$sald_lote = $row33a['saldo'];	
	
				if ($sald_lote == NULL ) { $sald_lote = $row33a['tt_entradalote']; }
	
	   $fab  = "Fabricação:" .$row33a['data_fab'];
	   $venc = "Vencimento:" .$row33a['data_venc'];
										
	
                        
 }
    	
$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* ,  DATE_FORMAT(b.data_fab, '%d/%m/%Y') data_fab,
                       DATE_FORMAT(b.data_venc, '%d/%m/%Y') data_venc 	
					   FROM tb_saidmatp a
                       inner join tb_entmatp b on b.cod_prod = a.cod_prod and b.num_lote = a.num_lote
                       where a.id_saidmat =". $id);
	
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $fab  = "Fabricação :" .$row33a['data_fab'];
	    $venc = "Vencimento :" .$row33a['data_venc'];
        $habilit = "N";
        $rs1 = mysql_query("SELECT a.*,DATEDIFF(CURDATE(),a.data_saida)dias_saida FROM tb_saidmatp a where a.id_saidmat =". $id);
     	$row1 = mysql_fetch_assoc($rs1);
//dias_saida serve para bloquear o botoes de gravar e excluir.
	     $data_saida    = strftime("%d/%m/%Y", strtotime($row1['data_saida']));
		 
		 $id_saidmat       = $id;
		 $cod_prod         = $row1['cod_prod'];
		 $num_lote         = $row1['num_lote'];
		 //$data_saida       = $row1['data_saida'];
		 $quantid_said     = $row1['quantid_said'];
		 $lote_fabricado   = $row1['lote_fabricado'];
		 $saldo_anterior   = $row1['saldo_anterior'];
         $unidade          = $row1['unidade'];
		 $motivo           = $row1['motivo'];
		 $obs              = $row1['obs'];
		 
		 			  
		 // $rs33 = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
           //           FROM tv_ttsaidalote a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");	
		   
		   
		   
 $deleta_tab = "drop table tmp_said";
  
 mysql_query($deleta_tab);
 
 $cria_tab = " create table tmp_said as
				select a.cod_prod, a.num_lote, sum(a.quantid_ent) quantid_ent,
					DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fab,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc,
				(select sum(b.quantid_said)
					from tb_saidmatp b where b.cod_prod = '".$cod_prod."' and b.num_lote =  '". $num_lote . "' 
				group by b.cod_prod,b.num_lote) quant_said
				from tb_entmatp a where a.cod_prod = '".$cod_prod."' and a.num_lote = '". $num_lote . "' 
				 group by a.cod_prod,a.num_lote
				";
				 
 mysql_query($cria_tab);
 
 
 
$rs33=mysql_query(" select a.*,  if(a.quant_said is null,a.quantid_ent,(a.quantid_ent - a.quant_said)) saldo
				 from tmp_said a where a.cod_prod > 0 ");
//				 (a.quantid_ent - a.quant_said) > 0");
 
			
  if($num_lote != "") {
           $row33a = mysql_fetch_assoc($rs33);
    			
		   $fab  = "Fabricação :" .$row33a['data_fab'];
		   $venc = "Vencimento :" .$row33a['data_venc'];
		   $sald_lote = $row33a['saldo'];	
		  // $sald_lote = $saldo_anterior;
  }
           $lm = "N"; 
		   
		   
		   
		   //echo($sald_lote);

	  }
	  

	  
 }

$tt_said = 0;
?>


   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}


function atualiza1(){
	
//	alert(<?php echo($sald_lote);?>);
   document.form2.submit();	
}			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matpe002.php";
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
<input type="hidden" name="sald_lote" value="<?php echo("$sald_lote");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>Sa&iacute;da de Mat&eacute;ria Prima- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table align="center" width="100%" >
      <tr>
        <th align="right">Mat&eacute;ria Prima</th>
        <th align="left"><select name="cod_prod"  class="search-input7" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
            <option value="">Selecione a Materia Prima</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php echo($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? 			  
				  } ?>				
				 ><?php echo($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">Lote M. Prima</th>
        <th align="left">
        
<input type=hidden name="lm" value="<?php echo($lm); ?>">

<?php 
//  
//		
      if ($lm == "") { ?>
        <select name="num_lote"  <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();" class="search-input6">
         <option value="" >Selecione o Lote</option>
          <?php while($row33=mysql_fetch_assoc($rs33) ){ 
		     if( $row33['saldo'] > 0){  ?>
                 <option value="<?php echo($row33['num_lote']);?>"
				  <?php 
				         if($row33['num_lote'] == $num_lote ) {?>
                           selected <?php  $sald_lote = $row33['saldo'];  
						 }
				  ?>	
				 ><?php echo($row33['num_lote'] . ' - Quant.' . $row33['saldo'] . ' Dt.Venc.' . $row33['data_venc']);?></option>
          <?php 
		   }
		  }?>
        </select>
        <?php 
	  }
	  else{
		    ?><input type="text" name="num_lote" value="<?php echo($num_lote);?>"  readonly> <?php 
	  }
		 ?>
        </th>
      </tr>
      <tr>
        <th align="left">Quantidade em Estoque</th>
        <th align="left"><font size="4"><?php echo(number_format($sald_lote,3,',','')); ?> </font>
        <input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>" disabled >
        </th>
        <th align="left"><?php echo($fab);?></th>
        <th align="center"><?php echo($venc);?></th>
      </tr>
      <tr>
        <th colspan="4" align="center"  bgcolor="#8080FF">Dados da Saida</th>
      </tr>
      <tr>
        <th align="right">Lote Produzido</th>
        <th align="left"><input type="text" name="lote_fabricado" onChange="atualiza();" value="<?php echo($lote_fabricado);?>" class="search-input"></th>
        <th align="left" colspan="2">
        <select name="lote_fabricado1"  onChange="atualiza();" class="search-input" >
         <option value="" >Selecione o Lote</option>
          <?php
		   while($row33x=mysql_fetch_assoc($rslib) ){ ?>
                 <option value="<?php echo($row33x['num_lote']);?>"
				  <?php 
				         if($row33x['num_lote'] == $lote_fabricado ) {?>
                           selected <?php  $data_saida = $row33x['data_fabr'];  
						 }
				   ?>
					><?php echo($row33x['num_lote'] . " - " . $row33x['descr_prod']);?> </option>
		    <?php
		   }
		   ?>
        </select>

        </th>
        </tr>      
      
      <tr>
        <th align="right">Data Saida</th>
        <th align="left"><input type="text" name="data_saida" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" 
        value="<?php echo ($data_saida); ?>" title="Informe no Formato 99/99/9999" 
        onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_saida);" 
        onChange="verifica_data(this.value,data_saida);" class="search-input6"  /></th>
        <th align="right">Quantidade</th>
        <th align="left"><input type="text" id = "quantid_said"  name="quantid_said"  maxlength="10" size="10" placeholder="informe a Quantidade"  value="<?php echo($quantid_said); ?>" class="search-input6" ></th>
      </tr>
      <tr>
        <th align="right">Unidade</th>
        <th align="left"><input type="text" id = "unidade"  name="unidade"  maxlength="10" size="10" placeholder="informe a unidade"  value="<?php echo($unidade); ?>" class="search-input6" ></th>
         
         </th>
      </tr>
      <tr>
        <th align="right">Motivo</th>
        <th align="left">
        <select name="motivo" class="search-input" >
          <option value="" >Selecione o Motivo</option>
          <option value="1"<?php if($motivo == 1 ) {?> selected <?php }?>> Producão </option>
		  <option value="2"<?php if($motivo == 2 ) {?> selected <?php }?>> Perda </option>
		  <option value="3"<?php if($motivo == 3 ) {?> selected <?php }?>> Outros </option>
 		  <option value="4"<?php if($motivo == 4 ) {?> selected <?php }?>> Paletizacão </option>
         
        </select>
        </th>
        <th align="right">Obs:</th>
        <th align="left"><input type="text" id = "obs"  name="obs"  maxlength="80" size="80" placeholder="Observacao"  value="<?php echo($obs); ?>" ></th>
      </tr>
      <tr>
        <th colspan="4" align="center">
          <input type="button" name="gravar"  onClick="validamatps();" value="Gravar"  class="search-submit2" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();"   class="search-submit2"  >
          <input type="button" name="Submit4"  onclick="excluirsaidmat(<?php echo($id); ?>);" value="Excluir"   class="search-submit2"  />
          <input type="button" onClick="sair('e');" value="Sair"   class="search-submit2" >
        </th>
        </tr>
            <tr >
              <th colspan="4" align="center"><h1>Registros de Sa&iacute;das</h1></th>
            </tr>
            <tr >
              <th colspan="4" align="center">
                M.Prima
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 class="search-input3" /> 
              </h1>Lote Fabricado 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="" class="search-input3">
               Data Saída
               <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
              
              Motivo
              <select name="motivo2" class="search-input3" >
                  <option value="" >Selecione o Motivo</option>
                  <option value="1"<?php if($motivo2 == 1 ) {?> selected <?php }?>> Producão </option>
                  <option value="2"<?php if($motivo2 == 2 ) {?> selected <?php }?>> Perda </option>
                  <option value="3"<?php if($motivo2 == 3 ) {?> selected <?php }?>> Outros </option>
                </select>
              
<input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
              </th>
            </tr>
            <tr align="center">
              <td colspan="4" align="center">

<?php 
///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
	
?>
  
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Mat&eacute;ria Prima</th>
                  <th >N. Lote</th>
                  <th>Dt. Fab.</th>
                  <th>Dt. Venc</th>
                  <th>Dt. Sa&iacute;da</th>
                  <th >Sd. Anterior</th>
                  <th >Quantidade</th>
                  <th >Unidade</th>
                  <th >Saldo Atual</th>
                  <th >Lote Fabricado</th>
                  <th >Motivo</th>
                  <th >Obs</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  
	  while($row=mysql_fetch_array($rs2)){ 
	  
    	 $msk = "S";
		 if(strtoupper($row['unidade']) != "KG" &&  strtoupper($row['unidade']) != "LT" && strtoupper($row['unidade']) != "GR" ){
						 $msk = "N";
		 }
		 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

             
                <td >
           <a href="matpe002.php?id=<?php echo ($row['id_saidmat']);?>"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod'] );?></a></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo($row['data_fab']);?></td>
           <td align="center" ><?php echo($row['data_venc']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_saida'])));?></td>
           <td align="right" ><?php
		   if ($msk == "S") {
				      echo (number_format($row['saldo_anterior'],3,',','.'));
				  }else{
				      echo (number_format($row['saldo_anterior'],3,',',''));					  
				  }
		    		  
		   ?></td>
           <td align="right" >
		     <?php
			  $tt_said = $tt_said + $row['quantid_said'];
			  
			  if ($msk == "S") {
				      echo (number_format($row['quantid_said'],3,',','.'));
				  }else{
				      echo (number_format($row['quantid_said'],3,',',''));					  
				  }
		    ?>
           </td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="right"><?php 
		     if ($msk == "S") {
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",","."));
				  }else{
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",",""));;					  
				  }
		  // echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",","")); 
		   
		   ?></td>
           <td align="center"><?php echo ($row['lote_fabricado']);?></td>
           <td align="left">
		   <?php 
		   switch ($row['motivo']) {
			case 1:
				echo("Producão");
				break;
			case 2:
				echo("Perda");
				break;
			case 3:
				echo("Outros");
				break;
			case 4:
				echo("Paletizacão");
				break;
				
		  }
		  ?>
           
           
           </td>
           <td align="left"><?php echo ($row['obs']);?></td>
              </tr>
              
          <?php 
		   } 
		   ?>
           
                 <tr>
                <td colspan="6"  align="right">Total de Sa&iacute;da</td>
                <td align="right" >
                 <?php
			  
			  if ($msk == "S") {
				      echo (number_format($tt_said,3,',','.'));
				  }else{
				      echo (number_format($tt_said,0,'',''));					  
				  }
		    ?>
                </td>
                <td align="center" >&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="left">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr> 
           
           <?php
	     }
		  ?>  
          
       
         </table>
 <?php
  ///////////////////////fim pesquisar
}
 ?>
             
     
</form> 
</center>
</body>
</html>
