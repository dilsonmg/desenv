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

$nped = $_GET ["nped"];
$cli  = $_GET ["cli"];
$nnf  = $_GET ["nnf"];



$rs200 = mysql_query("SELECT a.* 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,DATE_FORMAT(b.data_entrega, '%d/%m/%Y') dt_entreg
      FROM tb_saidaprodac a
	   left outer join tb_infocarga b on b.num_pedido = a.num_pedido
	   where a.num_pedido = '".$nped ."' order by  a.data_nf desc limit 650");		 		  


    $b = mysql_num_rows($rs200);




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

$rs_cli = mysql_query("SELECT a.*,c.nome FROM tb_cliente a
			  inner join tb_regvenda b on b.cod_regiao = a.cod_regiao
			  inner join tb_consultor c on c.id_consult = b.id_consult
			 where codigo_cli = '" . $cli ."'");
$row_cle = mysql_fetch_assoc($rs_cli);
$repres   = $row_cle['nome'];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())

$rs2 = mysql_query("SELECT *,DATE_FORMAT(a.dt_emis, '%d/%m/%Y') dt_emis2 ,DATE_FORMAT(a.dt_fat, '%d/%m/%Y') dt_fat2,DATE_FORMAT(a.data_entrega, '%d/%m/%Y') dt_entreg2 
,DATE_FORMAT(a.dt_preventr, '%d/%m/%Y') dt_preventr2 
FROM tb_infocarga a
where a.num_pedido = '" . $nped
 	 . "' and  a.num_nf= '".$nnf ."'");		 		  

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
			window.opener.location.reload(true);}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'

   	   	  document.form1.action="matpac500.php?nped=<?php echo($nped);?>&cli=<?php echo($cli)?>&nnf=<?php echo($nnf);?>";
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
<form name="form1" method="post" enctype="multipart/form-data" > 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<input type="hidden" name="num_pedido" value="<?php echo($nped);?>">
<input type="hidden" name="num_nf" value="<?php echo($nnf);?>">


<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Informa&ccedil;&otilde;es do Pedido :-  <?php echo($nped);?>
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
          <br>
          Representante :<?php echo($repres); ?>
          
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br>
        <?php echo($hoje);?>
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
    </table>
      <table width="99%" border="0">

      
          
    <tr align="center">
              <th colspan="6" align="center">
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
                  <th >Data Entrega</th>
                </tr>
     <?php
//echo($b);
       $bg = 0;
	  $ttquant = 0;
	  $tt_ltprod = 0;
	  $tot_nota = 0;
	  $tot_peso = 0;
	  
	  while($row1=mysql_fetch_array($rs200)){ 
	  
		  $tt_ltprod ++;
/*
      $rs_infcarg = mysql_query("Select a.* ,DATE_FORMAT(a.dt_emis, '%d/%m/%Y') dt_emis2  
	                                   ,DATE_FORMAT(a.dt_fat, '%d/%m/%Y') dt_fat2
									   ,DATE_FORMAT(a.data_entrega, '%d/%m/%Y') dt_entreg2  
	  							from tb_infocarga a where a.num_pedido = '" . $nped . "' and a.num_nf='" . $nnf ."'" );
	  $row_carga = mysql_fetch_assoc($rs_infcarg);
	  */
	  

		  
      $rs_prd = mysql_query("Select b.* from tb_produto b where b.cod_prod = '" . $row1['cod_prod'] . "'" . $p1 );
	  $row_prd = mysql_fetch_assoc($rs_prd);
	  $descr_prod   = $row_prd['descr_prod'];

      $rs_cli = mysql_query("Select c.* from tb_cliente c where c.codigo_cli = '" . $row1['codigo_cli'] . "'" . $p200 );
	  $row_cli = mysql_fetch_assoc($rs_cli);
	  $nome_cli = $row_cli['nome_cli'];
 	  $cidade_cli = $row_cli['cidade'];
	  $uf_cli = $row_cli['uf'];


      $rs_for = mysql_query("Select d.* from tb_fornecedor d where d.cod_fornec = '" . $row1['cod_fornec'] . "'"  );
	  $row_for = mysql_fetch_assoc($rs_for);
	  $rz_social = $row_for['rz_social'];

	  	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <th >
              <?php echo ($row1['cod_prod'] . " - " . $descr_prod);?></th>

           <th align="center"><?php echo ($row1['num_lote']);?></th>
           <th align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row1['data_fatura'])));?></th>
           <th align="right" ><?php
		     $ttquant =  $ttquant + $row1['quantid'];
		    echo(number_format($row1['quantid'],0,',',''));?></th>
           <th align="center" ><?php echo strtoupper ( ($row1['unidade']));?></th>
           <th align="center" >
		            <?php
			   $lnk = $row1['num_pedido'] ;
                      echo($lnk);
			?>
		   </th>
           <th align="center" ><?php echo ($row1['num_nf']);?></th>
           <th align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row1['data_nf'])));?></th>
           <th align="left"><?php echo ($row1['codigo_cli'] ." - " . $nome_cli . " cidade: " .$cidade_cli . " - " . $uf_cli  ); ?></th>
           <th align="left"><?php echo ($rz_social); ?></th>
           <th align="center"><?php echo ($row1['dt_entreg']);?></th>
           </tr>
          <?php 
		    $tot_nota = $tot_nota + $row1['tot_nota'];
			$tot_peso = $tot_peso + $row1['peso_bruto'];
		   } 
		   
		   
	  ?>
               <tr bgcolor="#E4E4E4">
                <th align="right" >Total de Lotes</th>
                <th align="right" ><?php echo($tt_ltprod); ?></th>
                <th align="right" >Quantidade Itens</th>

           <th align="right" ><?php
		   
		   
		     $ttquant =  $ttquant + $row1['quantid'];
		    echo(number_format($ttquant,0,',',''));?></th>
           <th align="center" >&nbsp;</th>
           <th colspan="2" align="right" >Valor da Nota</th>
           <th colspan="2" align="center" ><?php
		    echo(number_format($tot_nota,2,',','.'));?></th>
           <th align="left">Peso Bruto</th>
           <th align="left"><?php
		    echo(number_format($tot_peso,3,',',''));?></th>
           </tr>
           </table>
               <tr>
                 <th colspan="6" align="Center" bgcolor="#DDDDFF"  ><h2>Dados do Transporte</h2></th>
                </tr>
                <?php
		  		  $row=mysql_fetch_array($rs2);
					  $val_fret      = $row['val_fret'];
					  $aliq_icms     = $row['aliq_icms'];
					  $num_conhec    = $row['num_conhec'];
					  $dt_emis       = $row['dt_emis2'];
					  $dt_preventr   = $row['dt_preventr2'];
					  $dt_fat        = $row['dt_fat2'];
					  $val_fat       = $row['val_fat'];
					  $num_fat       = $row['num_fat'];
					  $data_entrega  = $row['dt_entreg2'];
					  $hora_entrega  = $row['hora_entrega'];
					  $transp_redesp = $row['transp_redesp'];
					  $contat_cli    = $row['contat_cli'];
					  $tel_contat    = $row['tel_contat'];
					  $situa_canhot  = $row['situa_canhot'];
					  $obs_transp    = $row['obs_transp'];
					  $email         = $row['email'];
					  $peso_qr       = $row['peso_qr'];
					  $sit_fatura       = $row['sit_fatura'];
					  
				?>
                
                
               <tr>
                 <th align="right" >Valor do Frete</th>
                 <th align="left" ><input type="text" name="val_fret" id="val_fret" maxlenght="20" size=10  value="<?php echo($val_fret); ?>" autofocus /></th>
                 <th align="right" >% Aliquota</th>
                 <th align="left" ><input type="text" name="aliq_icms" id="aliq_icms" maxlenght="20" size=10 value="<?php echo($aliq_icms);?>" /></th>
                 <th align="right" >N. Conhecimento</th>
                 <th align="left" ><input type="text" name="num_conhec" id="num_conhec" maxlenght="20" size=10  value="<?php echo($num_conhec);?>"/> 
                 Peso QR:
                 <input type="text" name="peso_qr" id="peso_qr" maxlenght="20" size=10  value="<?php echo($peso_qr);?>"/></th>
               </tr>
               <tr>
                 <th align="right" >Emis&atilde;o</th>
                 <th align="left" ><input type="text" name="dt_emis" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,dt_emis);" value="<?php echo($dt_emis);?>"/></th>
                 <th align="right" >Prev. Entrega</th>
                 <th align="left" ><input type="text" name="dt_preventr" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,dt_preventr);" value="<?php echo($dt_preventr);?>"/></th>
                 <th align="Center" >E-Mail</th>
                 <th align="left" ><input  type="text" name="email" id="email" maxlenght="100" size=60 value="<?php echo($email);?>"/></th>
               </tr>
               <tr>
                 <th align="right" >Venc. Fatura</th>
                 <th align="left" ><input type="text" name="dt_fat" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,dt_fat);" value="<?php echo($dt_fat);?>"/></th>
                 <th align="right" >Valor Fatura</th>
                 <th align="left" ><input type="text" name="val_fat" id="val_fat" maxlenght="20" size=10 value="<?php echo($val_fat);?>"/></th>
                 <th align="right" >N. Fatura</th>
                 <th align="left" ><input type="text" name="num_fat" id="num_fat" maxlenght="20" size=10 value="<?php echo($num_fat)?>" />
                   <select name="sit_fatura" class="search-input6" >
                     <option value="" >Situa&ccedil;&atilde;o da fatura</option>
                     <option value="A"<?php if($sit_fatura == 'A' ) {?> selected <?php }?>>Aberta</option>
                     <option value="F"<?php if($sit_fatura == 'F' ) {?> selected <?php }?>>Fechada</option>
                     <option value="P"<?php if($sit_fatura == 'P' ) {?> selected <?php }?>>Pendente</option>
                 </select></th>
               </tr>
               <tr>
                 <th colspan="6" align="Center" bgcolor="#DFDFDF" ><h2>Dados da Entrega</h2></th>
                </tr>
               <tr>
                 <th align="right" >Contato</th>
                 <th colspan="3" align="left" ><input type="text" name="contat_cli" id="contat_cli" maxlenght="80" size=80 value="<?php echo($contat_cli)?>"/></th>
                 <th align="right" >Telefone</th>
                 <th align="left" ><input type="text" name="tel_contat" id="tel_contat" maxlenght="40" size=40 value="<?php echo($tel_contat);?>"/></th>
               </tr>
               <tr>
                 <th align="right" >Data Entrega</th>
                 <th colspan="3" align="left" ><input type="text" name="data_entrega" size="8" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_entrega);" value="<?php echo($data_entrega);?>"/></th>
                 <th align="right" >Hora Entrega</th>
                 <th align="left" ><input type="text" name="hora_entrega" id="hora_entrega" maxlenght="20" size=10 value="<?php echo($hora_entrega);?>" /></th>
               </tr>
               <tr>
                 <th align="right" >Transp. Redespacho</th>
                 <th colspan="3" align="left" ><input type="text" name="transp_redesp" id="transp_redesp" maxlenght="20" size=60 value="<?php echo($transp_redesp);?>"/></th>
                 <th align="right" >Situa&ccedil;&atilde;o Canhoto</th>
                 <th align="left" >  
                  <select name="situa_canhot" class="search-input" >
                      <option value="" >Selecione a Situação</option>
                      <option value="1"<?php if($situa_canhot == 1 ) {?> selected <?php }?>>Ok</option>
                      <option value="2"<?php if($situa_canhot == 2 ) {?> selected <?php }?>>Pendente</option>
                      <option value="3"<?php if($situa_canhot == 3 ) {?> selected <?php }?>>Outros</option>
        		</select>
        </th>
                </tr>
               <tr>
                 <th align="right" >Observa&ccedil;&otilde;es</th>
                 <th colspan="5" align="left" ><textarea name="obs_transp" cols="150" rows="2"    class="search-input5"  ><?php echo($obs_transp) ?></textarea></th>
               </tr>
               <tr>
                 <th colspan="6" align="left" >&nbsp;</th>
               </tr>
               <tr>
                 <th colspan="6" align="Center" >
                  <input type="button" name="gravar"  onClick="valida_frete();" value="Gravar" class="search-submit2" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();"  class="search-submit2" >
          <input type="button" name="Submit4"  onclick="excluir_frete()(<?php echo($id); ?>);" value="Excluir"  class="search-submit2" />
          <input type="button" value="Sair"  onClick="javascript:self.close();" class="search-submit2">
                 
                 </th>
                </tr>
          <?php		   
	//     }
		  ?>      
         </table>
              
</th>
         </tr>
           
    </table>    
     
</form> 
</center>
</body>
</html>
