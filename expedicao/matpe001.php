<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

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
$lp = $_GET["lp"];
if($lp == 'S'){
	     $id_entmatp       = "";
         $data_entrada     = "";	 
		 $cod_fornec       = "";
    	// $cod_prod         = "";
		 $unidade          = "";
		 $num_nf           = "";
		 $data_nf          = "";
		 $num_lote         = "";
		 $data_fab         = "";
		 $data_venc        = "";
		 $quantid_ent      = "0.00";
		 $msg_lote         = "";  
		 $nm_fabric        = "";  
		 $motivo_ent       = "";   
		// $lp = '';
}
$id = $_GET ["id"];
$p3="";
$p31="";

$p4="";


if (isset($mprimapsx)){
	if ($mprimapsx <> "" ){
		if (is_numeric($mprimapsx)){
			$p3 = " and a.cod_prod = '" . $mprimapsx . "'"; }
		else{
		    $p4 = " and b.descr_prod like '%" . $mprimapsx ."%'" ; }
    }
}	

if (isset($id_subgrupo1)){
	if ($id_subgrupo1 <> "" ){
			$p31 = " and a.id_subgrupo = '" . $id_subgrupo1 . "'"; }
}	
$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())


///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
	
		  
	
	$rs2 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
				DATE_FORMAT(a.data_entrada, '%d/%m/%Y') data_entrada1,
				DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
				DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
				DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,b.cod_prod,c.cod_fornec,c.rz_social ,year(a.data_venc) ano_venc  , d.descr_subgr
				from tb_entmatp a
				 inner join tb_produto b on a.cod_prod = b.cod_prod " .$p4 ."
				 inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
				 left outer join tb_subgrupo    d on d.id_subgrupo = a.id_subgrupo 
				 where a.cod_prod > 0 " .$p3  .$p31 . "
				  order by a.id_entmatp desc");				  
		$b = mysql_num_rows($rs2);
	
}


$rs33 = mysql_query("select a.* from tb_produto a order by a.descr_prod");				  	
$rs34 = mysql_query("select a.* from tb_fornecedor a order by a.rz_social");

$rs14 = mysql_query("select a.* from tb_subgrupo a order by a.id_subgrupo");
$rs141 = mysql_query("select a.* from tb_subgrupo a order by a.id_subgrupo");


$rs340 = mysql_query("select a.num_lote from tb_avlfornec a where a.nfiscal = '".$num_nf."'");
$a1 =  mysql_num_rows($rs340);
   
     if ($a1 > 0 ) {
       $rownf = mysql_fetch_assoc($rs340);
       $num_lote = $rownf['num_lote'];
	 }


/*					  	
$rs34 = mysql_query("select a.id_fornec, b.rz_social,b.cod_fornec from tb_avlfornec a
    inner join tb_fornecedor b on a.id_fornec = b.cod_fornec
	where a.cod_prod = '".$cod_prod . "' group by b.cod_fornec");
*/
	
$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_entmatp a where a.id_entmatp =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         $rs1 = mysql_query("SELECT a.* FROM tb_entmatp a where a.id_entmatp =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_entrada    = strftime("%d/%m/%Y", strtotime($row1['data_entrada']));
	     $data_fab        = strftime("%d/%m/%Y", strtotime($row1['data_fab']));
		 if($row1['data_venc'] == "0000-00-00" || $row1['data_venc'] == ""){
			 $data_venc = "";}
	     else{
	         $data_venc       = strftime("%d/%m/%Y", strtotime($row1['data_venc']));
		 }
	     $data_nf         = strftime("%d/%m/%Y", strtotime($row1['data_nf']));
		 
		 $id_entmatp       = $id;
		 $cod_fornec       = (int) $row1['cod_fornec'];
		 $cod_prod         = $row1['cod_prod'];
		 $unidade          = $row1['unidade'];
		 $num_nf           = $row1['num_nf'];
		 $num_lote         = $row1['num_lote'];
		 $quantid_ent      = $row1['quantid_ent'];
		 $atv_kamoran      = $row1['atv_kamoran'];
		 $msg_lote         = $row1['msg_lote'];
		 $nm_fabric        = $row1['nm_fabric'];
         $motivo_ent       = $row1['motivo_ent'];
		 $id_subgrupo      = $row1['id_subgrupo'];
		 

         $rslocal = mysql_query("select a.* from tb_contraprovm a where a.cod_prod = '" .$cod_prod . "' and  a.num_lote = '" . $num_lote . "'");
    	 $row1oc = mysql_fetch_assoc($rslocal);
  	     
		 $localizacao = $row1oc['localizacao'];


	  }
	 
 }
//SELECT a.id_eqpto, a.dt_garantiafab ,ADDDATE(a.dt_garantiafab,INTERVAL 3 year) nvdata FROM tb_equipamento a;
//


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

// Comparando as Datas
/*

/// Diferenca em dias de uma data para a data atual.
SELECT t.*,DATEDIFF(t.data_conserto,CURDATE()) FROM tb_mvtoeq t;
/////////////////////////////////////////////////////////////////

if(strtotime($data1) > strtotime($data2))
{
echo 'A data 1 ? maior que a data 2.';
}
elseif(strtotime($data1) == strtotime($data2))
{
echo 'A data 1 ? igual a data 2.';
}
else
{
echo 'A data 1 ? menor a data 2.'.strtotime($data1);
}

HTML

<input type="checkbox" name="cor[]" value="Azul" />
<input type="checkbox" name="cor[]" value="Vermelho" />
<input type="checkbox" name="cor[]" value="Verde" />

No php

<?php

foreach($_POST['cor'] as $cor_selecionada)
{
    echo $cor_selecionada."<br />"
}
?>
////////////////

<form action="checkbox.php" method="post">
<B>Escolha os numeros de sua prefer?ncia:</B><br>
<input type=checkbox name="numeros[]" value=10> 10<br>
<input type=checkbox name="numeros[]" value=100> 100<br>
<input type=checkbox name="numeros[]" value=1000> 1000<br>
<input type=checkbox name="numeros[]" value=10000> 10000<br>
<input type=checkbox name="numeros[]" value=90> 90<br>
<input type=checkbox name="numeros[]" value=50> 50<br>
<input type=checkbox name="numeros[]" value=30> 30<br>
<input type=checkbox name="numeros[]" value=15> 15<br><BR>
<input type=checkbox name="news" value=1> <B>Receber
Newsletter?</B><br><BR>
<input type=submit>
</form>

Listagem 10: checkbox.php

<?php
// Verifica se usuario escolheu algum n?mero
if(isset($_POST["numeros"]))
{
    echo "Os n?meros de sua prefer?ncia s?o:<BR>";
    
    // Faz loop pelo array dos numeros
    foreach($_POST["numeros"] as $numero)
    {
        echo "- " . $numero . "<BR>";
    }
}


////////////
*/

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
	<title>MATPE001 - ENTRADAS DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
	*/		
	
function rec_pag(){
	document.form1.action="matpe001.php";
	document.form1.submit();
	return true;
}

function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='matpe001.asp'
		  document.form1.localizacao.value = "";
		  document.form1.action="matpe001.php?lp=S";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

///////////
function valida_numlote(){
var data_nf     = document.form1.data_nf.value;
var num_nf      = document.form1.num_nf.value;
var num_lote    = document.form1.num_lote.value;
	//alert("entrou");
	
if (num_lote == "" || eval(num_lote == 0)){
    //alert("Informe o numero do lote !");
	document.form1.num_lote.value= num_nf + "/" + data_nf.substring(6);
	document.form1.num_lote.focus(); 
	return false;
	}	
	
}

////////

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">
<input type=hidden name="cod_prod2" value="<?php echo("$cod_prod");?>">
<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" colspan="2" ><h1>Entrada de Mat&eacute;ria Prima-
        <?php
	echo($_SESSION['id_entmatp']);
		  ?></h1></th>
        <th colspan="2" align="right"><img src="../imagens/tecladoclaro.png" >
         <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
      
        </th>
      </tr>
      </table>

      <table width="100%" border="0">

      <tr>
        <th align="right">Mat&eacute;ria Prima</th>
        <th align="left"><select name="cod_prod" class="search-input5" <?php if($habilita ==1) echo(" protected ");?> onChange="document.form1.submit();" >
            <option value="">Selecione a Materia Prima</option>
            <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php echo($row33['cod_prod'])?>"
				  <? if($row33['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_prod'] . " - " . $row33['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">Fornecedor</th>
        <th align="left"><select name="cod_fornec" class="search-input5">
         <option value="">Selecione o Fornecedor</option>
          <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php echo($row33['cod_fornec'])?>"
				  <? if($row33['cod_fornec'] == $cod_fornec ) {?>selected <? } ?>				
				 ><?php echo($row33['rz_social']."-".$row33['cod_fornec'] )?></option>
          <?php }?>
        </select></th>
        <th align="left"><select name="id_subgrupo" class="search-input">
         <option value="">Tipo M.prima</option>
          <?php while($row23=mysql_fetch_assoc($rs14)){ ?>
          <option value="<?php echo($row23['id_subgrupo'])?>"
				  <? if($row23['id_subgrupo'] == $id_subgrupo ) {?>selected <? } ?>				
				 ><?php echo($row23['id_subgrupo']."-".$row23['descr_subgr'] )?></option>
          <?php }?>
        </select></th>

      </tr>
      <tr>
        <th align="right">Data Entrada</th>
        <th align="left"><input type="text" name="data_entrada" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_entrada ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_entrada);" onChange="verifica_data(this.value,data_entrada);" class="search-input6"/></th>
        <th align="right">Fabricante</th>
        <th colspan="3" align="left"><input type="text" id = "nm_fabric" class="search-input5"  name="nm_fabric"  maxlength="100" size="80" placeholder="informe o fabricante"   value="<?php echo($nm_fabric); ?>" ></th>
      </tr>
      <tr>
        <th align="right">Localizac&atilde;o<br> contraprova</th>
         <th colspan="4" align="left"><input type="text" id = "localizacao"  name="localizacao"  maxlength="150" size="100" placeholder="Localizacão"  value="<?php echo($localizacao); ?>" class="search-input" ></th>
       </tr>
        
        
      <tr>
        <th colspan="5" align="center"  bgcolor="#D2D2FF">Dados da Nota Fiscal</th>
      </tr>
      <tr>
        <th align="right">Num. NF</th>
        <th align="left"><input type="text" id = "num_nf"  name="num_nf"  maxlength="20" size="20" placeholder="informeo numero NF"  
        onChange="javascript:rec_pag();" value="<?php echo($num_nf); ?>" class="search-input3" ></th>
        <th align="right">Data NF</th>
        <th align="left" colspan="2"><input type="text" name="data_nf" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_nf ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_nf);" onChange="verifica_data(this.value,data_nf);" class="search-input3"/></th>
      </tr>
      <tr>
        <th  align="right">Quantidade</th>
        <th align="left"><input type="text" id = "quantid_ent"  name="quantid_ent"  maxlength="10" size="10" placeholder="informe a Quantidade"  value="<?php echo($quantid_ent); ?>" class="search-input5" ></th>
        <th align="right">Unidade</th>
        <th align="left" colspan="2"><input type="text" id = "unidade"  name="unidade"  maxlength="10" size="10" placeholder="informe a unidade"  value="<?php echo($unidade); ?>" class="search-input3" >
          Motivo Entrada
          <select name="motivo_ent" class="search-input2" >
            <option value="" >Selecione o Motivo</option>
            <option value="1"<?php if($motivo_ent == 1 ) {?> selected <?php }?>> Compra </option>
            <option value="2"<?php if($motivo_ent == 2 ) {?> selected <?php }?>> Devolução </option>
            <option value="3"<?php if($motivo_ent == 3 ) {?> selected <?php }?>> Bonificação </option>
        </select></th>
      
      </tr>
      <tr>
        <th colspan="5" align="center"  bgcolor="#D2D2FF">Dados do Lote</th>
      </tr>
      <tr>
        <th  align="right">Num. Lote/NF</th>
        <th colspan="4" align="left"><input type="text" id = "num_lote"  name="num_lote"  maxlength="45" size="32" 
        placeholder="informe o Numero do lote !"  value="<?php echo($num_lote); ?>"<?php if($habilita ==1) echo(" readonly ");?>
         onblur="valida_numlote();" class="search-input3"
        > 
          Data Fabricacao 
          <input type="text" name="data_fab" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_fab ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_fab);" onChange="verifica_data(this.value,data_fab);"
          class="search-input3"/>
           Data de Vencimento 
          <input type="text" name="data_venc" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_venc ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_venc);" onChange="verifica_data(this.value,data_venc);"
          class="search-input3"/>
          Ativo Kamoran
          <input type="text" id = "atv_kamoran"  name="atv_kamoran"  maxlength="10" size="10" placeholder="informe o ativo"  value="<?php echo($atv_kamoran); ?>" class="search-input3" ></th>
      </tr>
      <tr>
        <th align="right">Obervacoes. </th>
        <th colspan="4" align="left">
          <input readonly type=hidden name=x size=3 maxlength=3 value="250">
          
        <textarea name="msg_lote" cols="150" rows="2"  onchange="textCounter(this.form.msg_lote,this.form.x,330);"  onKeyDown="textCounter(this.form.msg_lote,this.form.x,330);"  class="search-input5"  ><?php echo($msg_lote) ?></textarea></td></th>
      </tr>
      <tr>
        <th colspan="5" align="center">
          <input type="button" name="gravar"  onClick="validamatpe();" value="Gravar"  class="search-submit2" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2" >
          <input type="button" name="Submit4"  onclick="excluirentmat(<?php echo($id); ?>);" value="Excluir" class="search-submit2"  /> 
          <input type="button" onClick="sair();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr >
              <th colspan="5" align="center" bgcolor="#EAEAFF"><h1>Lan&ccedil;amentos Cadastrados</h1></th>
            </tr>
            <tr >
              <th colspan="5" align="left">
              M. Prima
          <input type="text" id = "mprimapsx" name="mprimapsx"  maxlength="40" size="50" class="search-input4" >
          <select name="id_subgrupo1" class="search-input2">
            <option value="">Tipo M.prima</option>
            <?php while($row123=mysql_fetch_assoc($rs141)){ ?>
            <option value="<?php echo($row123['id_subgrupo'])?>"
				  <? if($row123['id_subgrupo'] == $id_subgrupo1 ) {?>selected <? } ?>				
				 ><?php echo($row123['id_subgrupo']."-".$row123['descr_subgr'] )?></option>
            <?php }?>
          </select>
          <input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2" >
          </th>
            </tr>
            <tr align="center">
              <td colspan="5" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Dt.Entrada</th>
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Fabricante</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="3"  bgcolor="#009999">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#00FF66">Lote / Partida</th>
                  <th>Especificacao</th>
                  <th rowspan="2">Obs</th>
                  <th rowspan="2">Motivo</th>
                  <th rowspan="2">Tipo</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >Quantidade</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                  <th>&nbsp;</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
	 
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td ><?php echo($row['data_entrada1']);?></td>
                <td >
           <a href="matpe001.php?id=<?php echo ($row['id_entmatp']);?>"><?php echo ($row['rz_social']);?></a></td>
                <td ><?php echo($row['nm_fabric']);?></td>

           <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
           <td  align="center"><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo ($row['data_nff']);?></td>
           <td align="center" ><?php echo ($row['quantid_ent']);?></td>
           <td align="center"><?php echo ($row['num_lote']);?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));
		  
		   ?></td>
           <td align="center">
		   <?php 
		  // echo(strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   
		   if($row['ano_venc'] == 0 || $row['ano_venc'] == ''){
			   echo("<b><font color='#0000FF'> Indeterminado </font></b>"); } 
		   else{
		   		echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   		if(strtotime($row['data_venc']) < strtotime($data2)){
                	echo ('<b><font color="#FF0000"> - Vencido a ' . $row['dias_avencer'].' dias </font>');}
          		else {
			    	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>'); 
		  		}
		   }
		   ?></td>
           <td align="center"><?php echo ($row['atv_kamoran']); 
		   		   
		   ?></td>
           <td align="left"><?php echo ($row['msg_lote']); 
		   		   
		   ?></td>
           <td align="left">
           <?php 
		   switch ($row['motivo_ent']) {
			case 1:
				echo("Compra");
				break;
			case 2:
				echo("Devolucão");
				break;
			case 3:
				echo("Bonificacão");
				break;
		  }
		  ?>
           
           </td>
           <td align="left"><?php echo ($row['descr_subgr']); 
		   		   
		   ?></td>
              </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>
 <?php
	 }
	 
    ///////////////// fim pesquisar
	
?>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
