<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p11 = "";
$p2 = "";



if (isset($id_projeto)){
	if ($id_projeto <> "" ){
        if(!is_numeric($id_projeto)){
		     $p1 = " or a.obs_param like '%" . $m_desp ."%'" ; 
	         $p11 = " and b.descr_projeto like '%". $m_desp ."%'";}
		 else{
			 $p11 = " and a.id_projeto = '" . $id_projeto ."'" ; }
    }	
}
if (isset($m_desp)){
	if ($m_desp <> "" ){
        if(!is_numeric($m_desp)){
		     $p1 = " or a.obs_param like '%" . $m_desp ."%'" ; 
	         $p11 = " and b.descr_projeto like '%". $m_desp ."%'";}
		 else{
			 $p11 = " and a.id_projeto = '" . $m_desp ."'" ; }
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
		 $descri_ambiente   = '';
		 $fermentacao = "";
         $cor_param = '';
		 $semana  = '';
		 $fung_bact = '';
		 $class_param = '';
		 $separacao = '';
		 $odor = '';

		// $id_projeto = '';

//DATEDIFF(t.data_conserto,CURDATE())
	  

$rs33 = mysql_query("select a.* from tb_projeto a order by a.id_projeto");				  	
$rs34 = mysql_query("select a.* from tb_paramestd a order by a.desc_paramestd");				  	
$rs35 = mysql_query("select a.* from tb_ambiente a order by a.descr_ambiente");				  	

$obs_projeto = '';
if (isset($id) ){
	  
	  
    $rs1 = mysql_query("SELECT a.*,b.*,c.*,d.descr_ambiente FROM tb_estudosp a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd
	 inner join tb_ambiente d on a.id_ambiente = d.id_ambiente
      where a.id_estudosp = '". $id . "' order by a.id_estudosp");

    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilita = 0;		 
		 $id_estudosp   = $id;
		 $id_projeto     = $row33a['id_projeto'];
		 $id_paramestd   = $row33a['id_paramestd'];
		 $semana         = $row33a['semana'];
 		 $fermentacao    = $row33a['fermentacao'];
		 $fung_bact      = $row33a['fung_bact'];
		 $cor_param      = $row33a['cor_param'];
		 $obs_param      = $row33a['obs_param'];
		 $class_param    = $row33a['class_param'];
		 $id_ambiente    = $row33a['id_ambiente'];
		 $separacao      = $row33a['separacao'];
		 $odor           = $row33a['odor'];
		 $lote           = $row33a['lote'];
		 
		
	  }else{
		  //$id_veiculo = '';
	  }
 }
////////////
//$p0 = " and a.id_projeto = '" . $id_projeto . "'";
	 
$rs2 = mysql_query("SELECT a.*,b.descr_projeto,c.desc_paramestd,d.descr_ambiente,b.lote
     FROM tb_estudosp a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto" . $p11 ."
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd 
	 inner join tb_ambiente d on a.id_ambiente = d.id_ambiente
     where a.id_estudosp > 0 " .$p0 .
	 " order by a.id_estudosp desc,a.id_projeto ");				  
 
 // echo($habilita);
$rs33p = mysql_query("select a.* from tb_ambiente a order by a.descr_ambiente ");				  	
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
	<title>Proj0007 - Acompanhamento Semanal de Projetos</title>
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
		  document.form1.id_projeto.value = '';
		  document.form1.lote.value = '';
		  document.form1.id_ambiente.value = '';
   	   	  document.form1.action="proj0007.php";
		  document.form1.submit();  
		  
		  return true;
	//	  }
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
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>P &amp; D - Acompanhamento Semanal de Projetos </h1></th>
        <th  align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
 </table>     
<table width="99%" border="0">
      
      <tr>
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th></tr>
      <tr>
        <th align="right">Projeto</th>
        <th colspan="5" align="left"><select name="id_projeto" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="document.form1.submit();" class="search-input5">
          <option value="">Selecione o Projeto</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php print($row33['id_projeto'])?>"
				  <? if($row33['id_projeto'] == $id_projeto ) {?>selected <?
				     $projetop = $row33['descr_projeto'];
					 $lote = $row33['lote'];
				   } ?>	
                  			
				 ><?php print($row33['id_projeto'] . " - " . $row33['descr_projeto'] );?></option>
          <?php }?>
        </select></th>
        <th align="right">Lote:</th>
        <th align="left"><input type="text" id = "lote"  name="lote"  maxlength="20" size="25" placeholder="lote"  
        value="<?php echo($lote); ?>" readonly class="search-input5"  ></th>
      </tr>
      <tr>
        <th align="right">Ambiente</th>
        <th colspan="7" align="left"><select name="id_ambiente"  <?php if($habilita ==1) echo(" disabled ");?> class="search-input5">
          <option value="">Selecione o Ambiente</option>
          <?php while($row33p=mysql_fetch_assoc($rs33p)){ ?>
          <option value="<?php print($row33p['id_ambiente'])?>"
				  <? if($row33p['id_ambiente'] == $id_ambiente ) {?>selected <? } ?>				
				 ><?php print($row33p['descr_ambiente'] )?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Par&acirc;metro de Estudo</th>
        <th colspan="7" align="left"><select name="id_paramestd" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> class="search-input5">
          <option value="">Selecione Item </option>
          <?php while($row34=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php print($row34['id_paramestd'])?>"
				  <? if($row34['id_paramestd'] == $id_paramestd ) {?>selected <? } ?>				
				 ><?php print($row34['desc_paramestd']);?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Semana</th>
        <th align="left"><input type="text" id = "semana"  name="semana"  maxlength="40" size="25" placeholder="informe a semana"  
        value="<?php echo($semana); ?>" class="search-input5"></th>
        <th align="right">Fermenta&ccedil;&atilde;o</th>
        <th colspan="3" align="left"><input type="text" id = "fermentacao"  name="fermentacao"  maxlength="40" size="45" placeholder="informe valor"  
        value="<?php echo($fermentacao); ?>"  class="search-input5"></th>
        <th align="right">Fungos / Bacterias&nbsp;</th>
        <th align="left"><input type="text" id = "fung_bact"  name="fung_bact"    maxlength="40" size="45" placeholder="informe os valores"  
        value="<?php echo($fung_bact); ?>" class="search-input5"></th>
      </tr>
      <tr>
        <th align="right">Cor</th>
        <th align="left"><input type="text" id = "cor_param"  name="cor_param"  maxlength="20" size="25" placeholder="informe a cor"  
        value="<?php echo( $cor_param); ?>" class="search-input5"></th>
        <th align="right">Separa&ccedil;&atilde;o</th>
        <th align="left"><input type="text" id = "separacao"  name="separacao"  maxlength="20" size="25" placeholder="informe se houve"  
        value="<?php echo( $separacao); ?>" class="search-input5"> </th>
        <th align="left">Odor</th>
        <th align="left"><input type="text" id = "odor"  name="odor"  maxlength="20" size="25" placeholder="informe se houve"  
        value="<?php echo( $odor); ?>" class="search-input5"></th>
        <th align="right">Classifica&ccedil;&atilde;o</th>
        <th align="left"><select name="class_param" class="search-input5">
          <option value="11">Nao se Aplica</option>
          <option value="0" <? if($class_param == 0 ) {?>selected <? }?>>0 - Ruim</option>
          <option value="1" <? if($class_param == 1 ) {?>selected <? }?>>1 - Ruim</option>
          <option value="2" <? if($class_param == 2 ) {?>selected <? }?>>2 - Ruim</option>
          <option value="3" <? if($class_param == 3 ) {?>selected <? }?>>3 - Ruim</option>
          <option value="4" <? if($class_param == 4 ) {?>selected <? }?>>4 - Ruim</option>
          <option value="5" <? if($class_param == 5 ) {?>selected <? }?>>5 - Razoavel</option>
          <option value="6" <? if($class_param == 6 ) {?>selected <? }?>>6 - Razoavel</option>
          <option value="7" <? if($class_param == 7 ) {?>selected <? }?>>7 - Razoavel</option>
          <option value="8" <? if($class_param == 8 ) {?>selected <? }?>>8 - Bom</option>
          <option value="9" <? if($class_param == 9 ) {?>selected <? }?>>9 - Bom</option>
          <option value="10" <? if($class_param == 10 ) {?>selected <? }?>>10 - Otimo</option>
        </select></th>
      </tr>
      <tr>
        <th align="right">Obs</th>
        <th colspan="7" align="left"><textarea name="obs_param" cols="100" rows="5" onKeyDown="textCounter(this.form.obs_param,this.form.x,540);" 
            onBlur="textCounter(this.form.obs_param,this.form.x,540);"   class="search-input"  ><?php echo($obs_param) ?></textarea></th>
      </tr>
      
      <tr>
        <th colspan="9" align="center">
       
          <input type="button" name="gravar"   onClick="validaacomp();" value="Gravar"  class="search-submit2" />
          <input type="button" name="button" id="button" value="Novo" onclick="resetForm();"  class="search-submit2" >
          <input type="button" name="Submit4"  onclick="excluiracomp(<?php echo($id); ?>);" value="Excluir"  class="search-submit2" />
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2" >
        </th>
        </tr>
            <tr bgcolor="#9D9DFF">
              <th colspan="9" align="center">Itens Cadastrados</th>
            </tr>
            <tr >
              <th colspan="9" align="center">Projeto
                <input type="text" name="m_desp" id="m_desp" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="9" align="center">
              <br>
              <table width="98%" border="0">
                 <tr bgcolor="#D2D2FF" >
                  <th colspan="11" ><h2>Projeto :<?php echo($projetop);?></h2></th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th width="4%" >ID-Proj.</th>
                  <th width="9%" >Ambiente</th>
                  <th width="12%" >Semana</th>
                  <th width="11%" >Par&acirc;metro</th>
                  <th width="6%" >Fementa&ccedil;&atilde;o</th>
                  <th width="8%" >Fungos/Bacterias</th>
                  <th width="4%" >Cor</th>
                  <th width="5%" >Separa&ccedil;&atilde;o</th>
                  <th width="4%" >Odor</th>
                  <th width="30%" >Observa&ccedil;ao</th>
                  <th width="7%" >Classifica&ccedil;&atilde;o</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	 }
	  while($row=mysql_fetch_array($rs2)){ 
	     $bgcp = ""; 
	      if ($row['class_param'] == 11){
             $msg_p =  "Não se aplica";
	}

    if ($row['class_param'] < 4){
		$bgcp = "bgcolor=#FF0000";
        $msg_p =  "Ruim";
	}
    if ($row['class_param'] > 4 && $row['class_param'] < 8 ){
	    $bgcp = "bgcolor=#00CC00";
        $msg_p =   "Razoavel";
	}
    if ($row['class_param'] > 7 && $row['class_param'] < 10 ){
	    $bgcp = "bgcolor=#33CCFF";		
        $msg_p =   "Bom";
	}
    if ($row['class_param'] == 10){
	    $bgcp = "bgcolor=#0000FF";		
        $msg_p =   "Otimo";
	}
       if($bg == 1){
			   	    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

           <tr>
             <td align="center" ><?php echo($row['id_projeto']);?></td>
             <td align="center" >
           <a href="proj0007.php?id=<?php echo ($row['id_estudosp']);?>"><?php echo ($row['descr_ambiente']);?></a></td>
             <td align="left" ><?php echo($row['semana']);?></td>
           <td align="left" ><?php echo($row['desc_paramestd']);?></td>
           <td align="left" ><?php echo($row['fermentacao']);?></td>
           <td align="left" ><?php echo($row['fung_bact']);?></td>
           <td align="left" ><?php echo($row['cor_param']);?></td>
           <td align="left" ><?php echo($row['separacao']);?></td>
           <td align="left" ><?php echo($row['odor']);?></td>
           <td align="left" ><?php echo($row['obs_param']);?></td>
           <td align="center" <?php echo($bgcp);?> ><?php  echo($row['class_param'] . " - " .$msg_p);?></td>
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
