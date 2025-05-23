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
	     $id_entprodac     = "";
         $cod_prod         = "";	 
		 $embalagem        = "";
		 $num_lote         = "";
		 $data_fabr        = "";
		 $data_venc        = "";
		 $data_prevlib     = "";
		 $data_liblote     = "";
		 $quant_fabr       = "0.00";

		 $msg_lote         = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
$rs2 = mysql_query("select a.* ,
DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib,
DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
b.descr_prod
from tb_entprodac a
 inner join tb_produto b on a.cod_prod = b.cod_prod 
 order by a.id_entprodac desc");				  
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("select a.* from tb_produto a order by a.descr_prod");				  	
$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_entprodac a where a.id_entprodac =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         $rs1 = mysql_query("SELECT a.* FROM tb_entprodac a where a.id_entprodac =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_prevlib    = strftime("%d/%m/%Y", strtotime($row1['data_prevlib']));
	     $data_liblote    = strftime("%d/%m/%Y", strtotime($row1['data_liblote']));
		 
		 $id_entprodac     = $id;
		 $cod_prod         = $row1['cod_prod'];
		 $embalagem        = $row1['embalagem'];
		 $num_lote         = $row1['num_lote'];
		 $data_fabr        = $row1['data_fabr'];
		 $data_venc        = $row1['data_venc'];
		 $data_liblote     = $row1['data_liblote'];
		 $quant_fabr       = $row1['quant_fabr'];
		 $tp_entrada       = $row1['tp_entrada'];
		 $msg_lote         = $row1['msg_lote'];
		 
		 
		 
		  $rscpv = mysql_query("select a.* from tb_contraprov a where  a.cod_prod = '" .$cod_prod . "' and  a.num_lote = '" . $num_lote . "'");
		  $rowcpv = mysql_fetch_assoc($rscpv);
		  
		  $localizacao = $rowcpv['localizacao'];

		  

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
echo 'A data 1 é maior que a data 2.';
}
elseif(strtotime($data1) == strtotime($data2))
{
echo 'A data 1 é igual a data 2.';
}
else
{
echo 'A data 1 é menor a data 2.'.strtotime($data1);
}


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
	<title>Matpac001- ENTRADAS DE PRODUTOS ACABADOS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
		
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.localizacao.value = "";
   	   	  document.form1.action="matpac001.php";
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
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="cod_prod2" value="<?php echo("$cod_prod");?>">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
         <th height="45" colspan="5" align="center"><h1>Entrada de Produtos Acabados- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
 <table width="98%" border="0">
     
      <tr>
        <th align="right">Produto</th>
        <th align="left"><select name="cod_prod" class="search-input5" <?php if($habilita ==1) echo(" disabled ");?>>
            <option value="">Selecione o Produto</option>
            <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php print($row33['cod_prod'])?>"
				  <? if($row33['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row33['descr_prod'] . " - " . $row33['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">N. Lote</th>
        <th colspan="2" align="left"><input type="text" id = "num_lote" required name="num_lote"  maxlength="20" size="20" placeholder="informe N.lote"  value="<?php echo($num_lote); ?>" class="search-input5"></th>
      </tr>
      <tr>
        <th align="right">Fabrica&ccedil;&atilde;o</th>
        <th align="left"><input type="text" id = "data_fabr" required name="data_fabr"  maxlength="20" size="20" placeholder="informe fabricacao"  value="<?php echo($data_fabr); ?>" class="search-input5" 
        onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_fabr);" onChange="verifica_data(this.value,data_fabr);"></th>
        <th align="right">Vencimento</th>
        <th colspan="2" align="left"><input type="text" id = "data_venc" required name="data_venc"  maxlength="20" size="20" placeholder="informe vencimento"  value="<?php echo($data_venc); ?>" class="search-input5"
      onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_venc);" onChange="verifica_data(this.value,data_venc);"></th>
</th>
      </tr>
      <tr>
        <th align="right">Qtd. Fabricada</th>
        <th align="left"><input type="text" id = "quant_fabr" required name="quant_fabr"  maxlength="10" size="10" placeholder="informe o ativo"  value="<?php echo($quant_fabr); ?>" class="search-input3" > 
          Embalagem 
          <input type="text" id = "embalagem" required name="embalagem"  maxlength="10" size="10" placeholder="inf. embalagem"  value="<?php echo($embalagem); ?>" class="search-input3"></th>
        <th colspan="2" align="left">Prev. Libera&ccedil;&atilde;o
        <input type="text" name="data_prevlib" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_prevlib ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_prevlib);" onChange="verifica_data(this.value,data_prevlib);" class="search-input5"/></th>
        <th align="left">Tipo de Entrada<br>
          <select name="tp_entrada" class="search-input" >
            <option value="1" <?php if($tp_entrada == "1" ){ echo(" selected "); }?>>Produção</option>
            <option value="2" <?php if($tp_entrada == "2" ){ echo(" selected "); }?>>Devolução</option> 
            <option value="3" <?php if($tp_entrada == "3" ){ echo(" selected "); }?>>Reprocesso</option> 
            
          </select>
          
        </th>
      </tr>
       <tr>
        <th align="right">Obs. Lote</th>
        <th colspan="4" align="left">  
              <input readonly type=hidden name=x size=3 maxlength=3 value="250">

          <textarea name="msg_lote" cols="105" rows="3"  onchange="textCounter(this.form.msg_lote,this.form.x,330);"  onKeyDown="textCounter(this.form.msg_lote,this.form.x,330);"  ><?php echo($msg_lote) ?></textarea></td>
        <input type="submit" name="gravaobs"  value="Gravar Obs"  class="search-submit2" /></th>
      </tr>
       <tr>
         <th align="right">Localiza&ccedil;&atilde;o <br>
         Contraprova</th>
         <th colspan="4" align="left"><input type="text" id = "localizacao" required name="localizacao"  maxlength="150" size="100" placeholder="Localizacão"  value="<?php echo($localizacao); ?>" class="search-input" ></th>
       </tr>
      <tr>
        <th colspan="5" align="center"  bgcolor="#8080FF">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="6" align="center">
          <input type="button" name="gravar"  onClick="validamatpacb();" value="Gravar"  class="search-submit2" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();"  class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluirmatpacb(<?php echo($id); ?>);" value="Excluir"  class="search-submit2" />
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2">
        </th>
        </tr>
            <tr >
              <th colspan="6" align="center"><h1>Produtos Liberados</h1></th>
            </tr>
            <tr align="center">
              <td colspan="6" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Produto</th>
                  <th >Lote</th>
                  <th >Fabrica&ccedil;&atilde;o</th>
                  <th >Vencimento</th>
                  <th >Qtd.Frabricada</th>
                  <th >Embalagem</th>
                  <th >Prev.Libera&ccedil;&atilde;o</th>
                  <th >Dt. Libera&ccedil;&atilde;o</th>
                  <th >TP.Entrada</th>
                  <th >Obs</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

                <tr>
                  <td >
                
           <?php  if ($row['data_liblote'] == "00/00/0000" ||$row['data_liblote'] == "" || $_SESSION['permi'] == '999') { ?>  
                   <a href="matpac001.php?id=<?php echo ($row['id_entprodac']);?>"><?php echo ($row['cod_prod'] ." - " .$row['descr_prod']); ?></a>
           
           <?php } else { ?>
           
                 <?php echo ($row['cod_prod'] ." - " .$row['descr_prod']); 
		   } ?>
           </td>

           <td  alingn="left"> <?php  echo ($row['num_lote']);?></td>
           <td  align="center"><?php echo ($row['data_fabr']);?></td>
           <td  align="center"><?php echo ($row['data_venc']);?></td>
           <td  align="center"><?php echo ($row['quant_fabr']);?></td>
           <td  align="center"><?php echo ($row['embalagem']);?></td>
           <td  align="center"><?php echo ($row['data_prevlib']);?></td>
           <td  align="center"><?php echo ($row['data_liblote']);?></td>
           <td  align="center"><?php 
		   switch ($row['tp_entrada']) {
			case 1:
				echo "Produção";
				break;
			case 2:
				echo "Devolução";
				break;
			case 3:
				echo "Reprocesso";
				break;

			}
		   ?></td>
           <td  align="center"><?php echo ($row['msg_lote']);?></td>
                </tr>
          <?php 
		   } 
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
