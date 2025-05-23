<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
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
	    // $cod_prod         = "";
		// $cod_prod         = "";
		 $obs_saida         = "";
		 $num_nf    = "";
		 $data_nf   = "";
		 
$id = $_GET ["id"];
$id1 = $_GET ["id1"];
$id2 = $_GET ["id2"];


$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
   					 
$rs32 = mysql_query("select a.*,b.descr_prod from tb_itemprocessado a
                     inner join tb_produto b on a.cod_prod = b.cod_prod
                     order by b.descr_prod");					  

$rs320 = mysql_query("select a.*  from tb_grpamostra a 
					  order by a.descr_grpam ");			

 $rs2 = mysql_query("SELECT a.*,d.descr_prod,c.descr_grpam FROM tb_compgrp a
					inner join tb_grpamostra c on a.id_grpamostra = c.id_grpamostra
					inner join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto d on d.cod_prod = b.cod_prod 
					where a.id_compgrp > 0 and a.id_grpamostra = '" . $id_grpamostra ."'   order by d.descr_prod");
					


$rs200=mysql_query("SELECT a.*,b.descr_prod,d.num_nf,d.obs_saida, DATE_FORMAT(d.data_nf, '%d/%m/%Y') data_nf,
f.descr_grpam,e.unid_amostra FROM tb_itsaidalt a
inner join tb_itemprocessado a1 on a1.cod_prod = a.cod_prod
inner join tb_produto b on b.cod_prod = a1.cod_prod " . $p1 ."
inner join tb_saidaam d on d.id_saidaam = a.id_saidaam
inner join tb_compgrp e on e.cod_prod  = a.cod_prod
inner join tb_grpamostra f on f.id_grpamostra = e.id_grpamostra
order by d.data_nf desc,a.id_itsaidalt desc,d.num_nf,a.num_lote desc");
/*
*/				  		  
 
$fab = "";
$venc = "";
 
$lm = "";					
    	
$habilia = 0;

if (isset($id)){
						
						
    $rs1 = mysql_query("SELECT a.* , DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nf1 FROM tb_saidaam a
           where a.id_saidaam > 0 and a.id_saidaam = '" . $id ."'");
	
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilita = 1;
		 $id_saidaam       = $id;
		 $num_nf           = $row33a['num_nf'];
		 $data_nf          = $row33a['data_nf1'];
		 $id_grpamostra    = $row33a['id_grpamostra'];
		 $obs_saida        = $row33a['obs_saida'];

		// $data_nf = formata_data($row33a['data_nf']);


 $rs2 = mysql_query("SELECT a.*,c.descr_prod ,d.quant_it FROM tb_itsaidalt a
					inner join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto c on c.cod_prod = b.cod_prod
					inner join tb_compgrp d on d.cod_prod= a.cod_prod 
					where a.id_saidaam > 0 and a.id_saidaam = '" . $id ."'");
	  				  

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
	<title>MATAM004 - Saidas de Kits de Amostras</title>
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
<input type="hidden" name="id2" value="<?php echo("$id2");?>">
<input type="hidden" name="id_grpamostra2" value="<?php echo("$id_grpamostra");?>">

<input type="hidden" name="cd_itens" id="cd_itens" value="">
<input type="hidden" name="qtd_itens" id="qtd_itens" value="">
<input type="hidden" name="cd_lotes"  id="cd_lotes" value="">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th colspan="3" align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
      <th height="45" colspan="4" align="center"><h1>Saidas De Kits de Amostras- 
        <?php 
	echo($_SESSION['cod_prod']);
		  ?>
      </h1></th></tr>
      <tr>
        <th align="right">Kit Amostra</th>
        <th colspan="3" align="left"><select name="id_grpamostra" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
          <option value="">Selecione o kit</option>
          <?php while($row320=mysql_fetch_assoc($rs320)){ ?>
          <option value="<?php print($row320['id_grpamostra'])?>"
				  <? if($row320['id_grpamostra'] == $id_grpamostra ) {?>selected <? } ?>				
				 ><?php print($row320['descr_grpam'])?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">NF</th>
        <th align="left"><input type="text" id = "num_nf"  name="num_nf"  maxlength="15" size="15" placeholder="informe a NF"  
        value="<?php echo($num_nf); ?>" ></th>
        <th align="right">Data</th>
        <th align="left">
          <input type="text" name="data_nf" size="8" maxlength="10" value="<?php if ($data_nf <> "" ){echo ($data_nf); }?>" 
          title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_nf);"
           onChange="verifica_data(this.value,data_nf);" placeholder="informe a Data"/>
        </th>
      </tr>
      <tr>
        <th align="right">Cliente</th>
        <th align="left"><input type="text" size="80" maxlength="100" name="obs_saida" value ="<?php echo($obs_saida); ?>"></th>
        <th align="right">Qtd Kits</th>
        <th align="left"><input type="text" id = "quant_kits"  name="quant_kits"  maxlength="15" size="15" placeholder="informe a NF"  
        value="<?php echo($quant_kits); ?>" ></th>
      </tr>
      <tr>
        <td colspan="4" align="center"  bgcolor="#A6A6FF">Lotes dos Itens de Amostra da NF</td>
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
                <th  align="right" > 
                
                <input type="hidden" name="cod_prod" size = "15"  value="<?php echo ( $row['cod_prod']);?>"></th>
                <input type="hidden" name="quant_said" size = "15" value="<?php echo ( $row['quant_it']);?>"></th>

                <th><?php echo ( $row['descr_prod']);?></th>
                <th colspan="2" align="left">Num. Lote <input type="text" name="num_lote" size="15" maxlength="15"  value="<?php echo ( $row['num_lote']);?>"></th>
           </tr>
          <?php 
	      }
	     }
		  ?>
      <tr>
            <th colspan="5" align="center">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="5" align="center">
          <input type="button" name="gravar"  onClick="validasaidaam();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="ResetFormValues('matam0004.php?id=');" >
          <input type="button" name="Submit4"  onclick="excluirsaidaam(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <td colspan="5" align="center" bgcolor="#A6A6FF">Itens Cadastrados</td>
            </tr>
            <tr >
              <th colspan="5" align="center">
                Produto
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="5" align="center">
              <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >NF</th>
                  <th  >Data</th>
                  <th> Grupo </th>
                  <th >Produto</th>
                  <th >N. Lote</th>
                  <th >Cliente</th>
                  <th >Qtd.Amostra</th>
                  <th >Qtd Kits</th>
                </tr>
     <?php
//echo($b);
	 
       $bg = 0;
	  $idgrp = 0;
	  while($row=mysql_fetch_array($rs200)){ 
       if ($idgrp !=  $row['num_nf']){
		    echo("<tr><td colspan=8>&nbsp;</td></tr>");
			$mqtd = "S";

				}		
			  
	   echo('<tr bgcolor="#DFDFFF">');?>
                
                  <tr>
                    <td > <a href="matam0004.php?id=<?php echo ($row['id_saidaam']."&id2=".$row['id_itsaidalt']);?>"><?php echo ($row['num_nf']);?></a></td>
                <td align="center" ><?php echo ( $row['data_nf']);?></td>
                <td align="left"><?php echo ($row['descr_grpam']);?></td>
                <td align="left"><?php echo ($row['descr_prod']);?></td>
                <td align="center"><?php echo ($row['num_lote']);?></td>
                <td align="left"><?php echo ($row['obs_saida']);?></td>
                <td align="right"><?php echo ($row['quant_said']);?></td>
                <td align="right"><?php echo ($row['quant_kits']);?></td>
                </tr>
          <?php 
		         
		 //  $bg = $row['num_nf'];
		      $idgrp =  $row['num_nf'];
		      
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
