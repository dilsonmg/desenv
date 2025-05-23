<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p11 = "";
$p2 = "";


if (isset($m_desp)){
	if ($m_desp <> "" ){
        if(!is_numeric($m_desp)){
		     $p1 = " or a.descri_estudo like '%" . $m_desp ."%'" ; 
	         $p11 = " and b.descr_projeto like '%". $m_desp ."%'";}
		 else{
			 $p2 = " and a.id_estdparam = '" . $m_desp ."'" ; }
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
	     $id_limit         = "";
$id = $_GET ["id"];


$habilita = 0;
		 $id_paramestd  = '';
		// $id_veiculo     = '';
		 $descri_estudo   = '';
 	     $data_estudo     = '';
 	     $lote            = '';
 	     $obs_item        = '';

//DATEDIFF(t.data_conserto,CURDATE())
	  

$rs33 = mysql_query("select a.* from tb_projeto a order by a.id_projeto");				  	
$rs34 = mysql_query("select a.* from tb_paramestd a order by a.desc_paramestd");				  	

$obs_projeto = '';
if (isset($id) ){
   
    $rs1 = mysql_query("SELECT a.*,b.*,c.* FROM tb_estudform a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd 
      where a.id_estdform = '". $id . "' order by a.id_estdform");

    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilita = 0;		 
		 $id_estdform    = $id;
		 $id_projeto     = $row33a['id_projeto'];
		 $id_paramestd   = $row33a['id_paramestd'];
		 $cod_prod       = $row33a['cod_prod'];
 		 $perc_param     = $row33a['perc_param'];
		 $kg_param       = $row33a['kg_param'];
		 $soma_sn        = $row33a['soma_sn'];
		 $basekgform     = $row33a['basekgform'];
         $lote           = $row33a['lote'];
         $obs_item       = $row33a['obs_item'];

	  }else{
		  //$id_veiculo = '';
	  }
 }
////////////
$p0 = " and a.id_projeto = '" . $id_projeto . "'";


 $rs2 = mysql_query("SELECT a.*,b.descr_projeto,c.desc_paramestd,d.descr_prod
     FROM tb_estudform a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto" . $p11 ."
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd 
	 inner join tb_produto d  on d.cod_prod = a.cod_prod 
     where a.id_estdform> 0 " .$p0 .
	 " order by a.id_estdform desc,a.id_projeto ");				  
	 	 
 
 // echo($habilita);
$rs33p = mysql_query("select a.* from tb_produto a order by a.descr_prod");				  	
////////////////
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
	<title>Proj0004 - Estudo - Formulacao</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcprojs.js"   charset="ISO-8859-1"></script>
<script>   
/* 
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/

function resetForm(){
  //  if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="proj0004.php";
		  document.form1.submit();  
		  
		  return true;
	//	  }
}


function calcucaval(){
    var perc = document.form1.perc_param.value;
	perc = perc.replace(",",".")
	var basekgform = document.form1.basekgform.value;
	
	var kg_param = (perc * basekgform) / 100;
	
	var arredondado = parseFloat(kg_param.toFixed(3));

	
//	alert(arredondado);

	document.form1.kg_param.value = arredondado;
	return true;	
}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>P &amp; D - Estudo Formula&ccedil;&atilde;o 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th>
        <th  align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="99%" border="0">
      
      <tr>
      </tr>
      <tr>
        <th align="right">Projeto</th>
        <th colspan="5" align="left"><select name="id_projeto" <?php if($habilita ==1) echo(" disabled ");?> onChange="document.form1.submit();" class="search-input5" >
          <option value="">Selecione o Projeto</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php print($row33['id_projeto'])?>"
				  <? if($row33['id_projeto'] == $id_projeto ) {?>selected <?
				     $projetop = $row33['descr_projeto'];
				   } ?>	
                  			
				 ><?php print($row33['id_projeto'] . " - " . $row33['descr_projeto'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">M. Prima</th>
        <th colspan="2" align="left"><select name="cod_prod" <?php if($habilita ==1) echo(" disabled ");?> class="search-input5" >
          <option value="">Selecione a Materia Prima</option>
          <?php while($row33p=mysql_fetch_assoc($rs33p)){ ?>
          <option value="<?php print($row33p['cod_prod'])?>"
				  <? if($row33p['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row33p['descr_prod'] . " - " . $row33p['cod_prod'] )?></option>
          <?php }?>
        </select></th>
        <th align="right">Lote</th>
        <th colspan="2" align="left"><input type="text" id = "lote"  name="lote"  maxlength="40" size="45" placeholder="informe o lote"  
        value="<?php echo($lote); ?>" class="search-input5" ></th>
      </tr>
      <tr>
        <th align="right">Par&acirc;metro de Estudo</th>
        <th colspan="5" align="left"><select name="id_paramestd" <?php if($habilita ==1) echo(" disabled ");?> class="search-input5" >
          <option value="">Selecione Item </option>
          <?php while($row34=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php print($row34['id_paramestd'])?>"
				  <? if($row34['id_paramestd'] == $id_paramestd ) {?>selected <? } ?>				
				 ><?php print($row34['desc_paramestd']);?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Percecual</th>
        <th align="left"><input type="text" id = "perc_param"  name="perc_param"  maxlength="12" size="15" placeholder="informe o %"  
        value="<?php echo($perc_param); ?>" class="search-input5" ></th>
        <th align="right">Base de Calculo em KG</th>
        <th align="left"><input type="text" id = "basekgform"  name="basekgform"  onChange="javascript:calcucaval();"  onBlur="javascript:calcucaval();" maxlength="12" size="15" placeholder="informe em kg"  
        value="<?php echo($basekgform); ?>" class="search-input5" ></th>
        <th align="right">Total Kg</th>
        <th align="left"><input type="text" id = "kg_param"  name="kg_param"  maxlength="12" size="15" placeholder="informe valor em kg"  
        value="<?php echo($kg_param); ?>" class="search-input5"  ></th>
      </tr>
      <tr>
        <th align="right">Observacao</th>
        <th colspan="5" align="left"><input type="text" id = "obs_item"  name="obs_item"  maxlength="120" size="120" placeholder="informe a Observacao"  
        value="<?php echo($obs_item); ?>" class="search-input"  ></th>
      </tr>
      <tr>
        <th colspan="7" align="center">
       
          <input type="button" name="gravar"   onClick="validaformula();" value="Gravar"   class="search-submit2"/>
          <input type="button" name="button" id="button" value="Novo" onclick="resetForm();"  class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluirformula(<?php echo($id); ?>);" value="Excluir"  class="search-submit2" />
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2">
        </th>
        </tr>
            <tr bgcolor="#9D9DFF">
              <th colspan="7" align="center">Itens Cadastrados</th>
            </tr>
            <tr >
              <th colspan="7" align="center">Projeto
                <input type="text" name="m_desp" id="m_desp" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="7" align="center">
              <br>
              <table width="89%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th colspan="6" ><h2>Projeto :<?php echo($projetop);?></h2></th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >M.Prima</th>
                  <th >Lote</th>
                  <th >Par&acirc;metro</th>
                  <th >Percentural</th>
                  <th >KG</th>
                  <th >Obs</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	 }
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

           <tr>
             <td align="center" >
           <a href="proj0004.php?id=<?php echo ($row['id_estdform']);?>"><?php echo ($row['descr_prod']);?></a></td>
             <td align="left" ><?php echo($row['lote']);?></td>
           <td align="left" ><?php echo($row['desc_paramestd']);?></td>
           <td align="right" ><?php echo($row['perc_param']);?> %</td>
           <td align="right" ><?php echo($row['kg_param']);?></td>
           <td align="left" ><?php echo($row['obs_item']);?></td>
           </tr>
          <?php 
		   } 
		  ?>      
         </table>
              <br>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
