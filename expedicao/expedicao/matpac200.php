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
$lm = 0;

	    // $id_entprodac     = "";
         //$cod_prod         = "";	 
		 $embalagem        = "";
		 $num_lote         = "";
		 $data_fabr        = "";
		 $data_venc        = "";
		 $data_prevlib     = "";
		 $data_liblote     = "";
		 $quant_fabr       = "0.00";
		 

$id = $_GET ["id"];
if($id == ""){$id = $id_entprodac ;}else{ $id_entprodac = $id; }

//echo("id=".$id );		 

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
$rs2 = mysql_query("select a.* ,
DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib,
DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
b.descr_prod
from tb_entprodac a
 inner join tb_produto b on a.cod_prod = b.cod_prod
 where data_liblote is null 
 order by a.id_entprodac desc");				  
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("SELECT a.*,b.descr_prod,DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib2  FROM tb_entprodac a
 					 inner join tb_produto b on b.cod_prod = a.cod_prod
					 where a.data_liblote is null
					 order by a.num_lote asc");				  	
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
		 
		 $cod_prod         = $row1['cod_prod'];
		 $embalagem        = $row1['embalagem'];
		 $num_lote         = $row1['num_lote'];
		 $data_fabr        = $row1['data_fabr'];
		 $data_venc        = $row1['data_venc'];
		 $data_liblote     = $row1['data_liblote'];
		 $quant_fabr       = $row1['quant_fabr'];
         $data_prevlib     = $row1['data_previlib2'];
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
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
function atualiza(){
   document.form1.submit();	
}			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_entprodac.value = '';
   	   	  document.form1.action="matpac200.php";
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
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th ><h1>Libera&ccedil;&atilde;o de Produtos Acabados- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      
      </table>
     <table width="95%" border="0">
      <tr>
        <th colspan="2" align="right">Produto</th>
        <th align="left"><select name="id_entprodac" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?>  onChange="atualiza();">
            <option value="">Selecione o Produto</option>
            <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php print($row33['id_entprodac'])?>"
				  <? if($row33['id_entprodac'] == $id_entprodac) {
					     $id = $row33['id_entprodac'];
					     $num_lote   = $row33['num_lote'];
						 $data_fabr  = $row33['data_fabr'];
						 $data_venc  = $row33['data_venc'];
						 $quant_fabr = $row33['quant_fabr'];
						 $embalagem  = $row33['embalagem'];
					     $data_prevlib = $row33['data_prevlib2'];
						 $cod_prod   = $row33['cod_prod'];
						 $rs340 = mysql_query("SELECT * FROM tb_limitprod where cod_prod = ".$cod_prod);
                         $lm = mysql_num_rows($rs340);					  
					  ?>selected <? } ?>				
				 ><?php print($row33['descr_prod'] . " - " . $row33['cod_prod'] . " - Lote >> " .$row33['num_lote'])?></option>
            <?php }?>
        </select></th>
        <th align="right">N. Lote 
        <input  type="hidden" name="ttanlises" value="<?php echo($lm); ?>">
        </th>
        <th align="left"><input type="text" id = "num_lote" required name="num_lote"  maxlength="10" size="10" placeholder="informe N.lote"  value="<?php echo($num_lote); ?>" disabled ></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Fabrica&ccedil;&atilde;o</th>
        <th align="left"><input type="text" id = "data_fabr" required name="data_fabr"  maxlength="20" size="20" placeholder="informe fabricacao"  value="<?php echo($data_fabr); ?>" disabled ></th>
        <th align="right">Vencimento</th>
        <th align="left"><input type="text" id = "data_venc" required name="data_venc"  maxlength="20" size="20" placeholder="informe vencimento"  value="<?php echo($data_venc); ?>"  disabled></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Qtd. Fabricada</th>
        <th align="left"><input type="text" id = "quant_fabr" required name="quant_fabr"  maxlength="10" size="10" placeholder="informe o ativo"  value="<?php echo($quant_fabr); ?>" disabled > 
          Embalagem 
          <input type="text" id = "embalagem" required name="embalagem"  maxlength="10" size="10" placeholder="inf. embalagem"  value="<?php echo($embalagem); ?>"  disabled></th>
        <th align="right">Prev. Libera&ccedil;&atilde;o</th>
        <th align="left"><input type="text" name="data_prevlib" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_prevlib ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_prevlib);" onChange="verifica_data(this.value,data_prevlib);" disabled/></th>
      </tr>
      <tr>
        <th colspan="5" align="center" bgcolor="#8080FF">Dados Para a Liberacao</th>
      </tr>
      <tr>
        <th colspan="2" align="right">Data da Libera&ccedil;&atilde;o</th>
        <th align="left"><input type="text" name="data_liblote" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_liblote ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_liblote);" onChange="verifica_data(this.value,data_liblote);"  />
        </th>
        <th align="right">&nbsp;</th>
        <th align="left">&nbsp;</th>
      </tr>
      <tr>
        <td colspan="5" align="center"><h3>Certificado de An&aacute;lise</h3></td>
      </tr>
      <tr>
        <th colspan="5" align="center"><table width="95%" border="0">
          <tr bgcolor="#8080FF">
            <td align="center">An&aacute;lise</td>
            <td align="center">Resultados</td>
            <td align="center">Limites</td>
          </tr>
          
               <?php
//echo($b);
	 if ($lm > 0){
       $bg = 0;
	  $li = 0;
	  while($row=mysql_fetch_array($rs340)){ 
	  $li++;
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
    	   echo('<tr ' . $bgc .'>');?>
                <td><?php echo ($row['descr_analise']); ?> </td>
		        <td align="center">
                <input type="text" id = "resultado<?php echo ($li);?>" required name="resultado<?php echo ($li);?>"  maxlength="45" size="45" placeholder="informe o Resultado"  value="<?php echo($resultado); ?>" >
                </td>
                <td><?php echo ($row['limite_analise']); ?></td>
               </tr>
          <?php } 
	   }
	?>
          
        </table></th>
      </tr>
      <tr>
        <th colspan="2" align="right">&nbsp;</th>
        <th align="left">&nbsp;</th>
        <th align="right">&nbsp;</th>
        <th align="left">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="6" align="center">
          <input type="button" name="gravar"  onClick="validamatpacb2('a');" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" >
          <input type="button" name="Submit4"  onclick="validamatpacb2(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="6" align="center"><h1>Produtos para Libera&ccedil;&atilde;o</h1></th>
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

                <td >
                
           <?php  if ($row['data_liblote'] == "") { ?>  
                   <a href="matpac200.php?id=<?php echo ($row['id_entprodac']);?>"><?php echo ($row['cod_prod'] ." - " .$row['descr_prod']); ?></a>
           
           <?php } else { ?>
           
                 <?php echo ($row['descr_prod']); 
		   } ?>
           </td>

           <td  alingn="left"> <?php  echo ($row['num_lote']);?></td>
           <td  align="center"><?php echo ($row['data_fabr']);?></td>
           <td  align="center"><?php echo ($row['data_venc']);?></td>
           <td  align="center"><?php echo ($row['quant_fabr']);?></td>
           <td  align="center"><?php echo ($row['embalagem']);?></td>
           <td  align="center"><?php echo ($row['data_prevlib']);?></td>
           <td  align="center"><?php echo ($row['data_liblote']);?></td>
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
