<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and d.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and d.cod_prod like '%" . $m_primapesq ."%'" ; }
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
$a = 0;
$b = 0;
	    // $id_itproc         = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $descr_analise    = "";
		 $limite_analise   = "";
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
   					 
$rs32 = mysql_query("select a.*,b.descr_prod,max(a.data_ent) ultentrada from tb_entitproc a
                     inner join tb_produto b on a.cod_prod = b.cod_prod
                     group by a.cod_prod
                     order by b.descr_prod");					  

$rs320 = mysql_query("select a.*  from tb_grpamostra a 
					  order by a.descr_grpam ");			
					  
					  

 $rs2 = mysql_query("SELECT a.*,d.descr_prod,c.descr_grpam FROM tb_compgrp a
					inner join tb_grpamostra c on a.id_grpamostra = c.id_grpamostra
					left outer join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto d on d.cod_prod = a.cod_prod " . $p1 ."
					where a.id_compgrp > 0 and a.id_grpamostra = '" . $id_grpamostra ."'   order by d.descr_prod");
					  		  
 
$fab = "";
$venc = "";
 
$lm = "";					
    	
$habilia = 0;
 $quant_it         = "";
 $unid_amostra = "";
if (isset($id)){
	
	
						
    $rs1 = mysql_query("SELECT a.*,d.descr_prod,c.descr_grpam FROM tb_compgrp a
					inner join tb_grpamostra c on a.id_grpamostra = c.id_grpamostra
					left outer join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto d on d.cod_prod = a.cod_prod
					where a.id_compgrp > 0 and a.id_compgrp = '" . $id ."'   order by d.descr_prod");
	
	
	
					
    $a = mysql_num_rows($rs1);
	
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilita = 1;
		 $id_compgrp       = $id;
		 $id_grpamostra    = $row33a['id_grpamostra'];
		 //$id_itproc        = $row33a['id_itproc'];
		 $cod_prod         = $row33a['cod_prod'];
		 $unid_amostra     = $row33a['unid_amostra'];
		 $quant_it         = $row33a['quant_it'];


//echo($cod_prod);

 $rs2 = mysql_query("SELECT a.*,d.descr_prod,c.descr_grpam FROM tb_compgrp a
					inner join tb_grpamostra c on a.id_grpamostra = c.id_grpamostra
					left outer join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto d on d.cod_prod = a.cod_prod " . $p1 ."
					where a.id_compgrp > 0 and a.id_grpamostra = '" . $id_grpamostra ."'   order by d.descr_prod");
					
					
					
	  				  

	  }
 }
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
	<title>MATAM003 - Composicao de Grupos</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" ></th>
       <th align="center"><h1>Composi&ccedil;&atilde;o Kits- </h1>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="95%" border="0">

      <tr>
        <th align="right">Grupo Amostra</th>
        <th align="left"><select name="id_grpamostra" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();" class="search-input5">
          <option value="">Selecione o Grupo</option>
          <?php while($row320=mysql_fetch_assoc($rs320)){ ?>
          <option value="<?php print($row320['id_grpamostra'])?>"
				  <? if($row320['id_grpamostra'] == $id_grpamostra ) {?>selected <? } ?>				
				 ><?php print($row320['descr_grpam'])?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Produto</th>
        <th align="left"><select name="cod_prod" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();" class="search-input5">
            <option value="">Selecione o Produto</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Quantidade</th>
        <th align="left"><input type="text" id = "quant_it"  name="quant_it"  maxlength="15" size="15" placeholder="informe a quantidade"  value="<?php echo($quant_it); ?>" class="search-input4" ></th>
      </tr>
      <tr>
        <th align="right">Unidade</th>
        <th align="left"><input type="text" id = "unid_amostra"  name="unid_amostra"  maxlength="15" size="15" placeholder="informe a unidade"  value="<?php echo($unid_amostra); ?>" class="search-input4" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center">
          <input type="button" name="gravar"  onClick="validacompgrp();" value="Gravar" class="search-submit2"  />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="ResetFormValues('matam0003.php?id=');" class="search-submit2" >
          <input type="button" name="Submit4"  onclick="excluircompgrp(<?php echo($id); ?>);" value="Excluir"  class="search-submit2"/>
          <input type="button" onClick="sair();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr >
              <td colspan="3" align="center" bgcolor="#A6A6FF">Itens Cadastrados</td>
            </tr>
            <tr >
              <th colspan="3" align="center">
                Produto
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              </th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Grupo</th>
                  <th  >Itens do Kit</th>
                  <th >Quant.</th>
                  <th >Unidade</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td > <a href="matam0003.php?id=<?php echo ($row['id_compgrp']);?>"><?php echo ($row['descr_grpam']);?></a></td>
                <td ><?php echo ( $row['descr_prod']);?></a></td>
                <td align="center"><?php echo ($row['quant_it']);?></td>

           <td align="center"><?php echo ($row['unid_amostra']);?></td>
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
