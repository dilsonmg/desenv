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
		//$id_projeto     = '';
		 $descri_estudo   = '';
 	     $data_estudo     = '';
		 $descri_ambiente   = '';
		 $fermentacao = "";
         $cor_param = '';
		 $semana  = '';
		 $fung_bact = '';
		 $class_param = '';
		// $id_projeto = '';

//DATEDIFF(t.data_conserto,CURDATE())
	  

$rs33 = mysql_query("select a.* from tb_projeto a order by a.id_projeto");				  	
$rs34 = mysql_query("select a.* from tb_paramestd a order by a.desc_paramestd");				  	
$rs35 = mysql_query("select a.* from tb_ambiente a order by a.descr_ambiente");				  	

$obs_projeto = '';

if (isset($semana) and $semana != ''){
   $ps = " and a.semana like '%" .$semana . "%'";
}
if (isset($id) ){
  if($id != ""){	  
	  
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
		 //$id_projeto     = $row33a['id_projeto'];
		 $id_paramestd   = $row33a['id_paramestd'];
		 $semana         = $row33a['semana'];
 		 $fermentacao     = $row33a['fermentacao'];
		 $fung_bact      = $row33a['fung_bact'];
		 $cor_param      = $row33a['cor_param'];
		 $obs_param      = $row33a['obs_param'];
		 $class_param    = $row33a['class_param'];
		 $id_ambiente    = $row33a['id_ambiente'];
		 
		 
		
	  }else{
		//header("Location: proj0007.php");
	  }
	  
  }
 }
////////////
//$p0 = " and a.id_projeto = '" . $id_projeto . "'";
	 
$rs2 = mysql_query("SELECT a.*,b.descr_projeto,c.desc_paramestd,d.descr_ambiente
     FROM tb_estudosp a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto" . $p11 ."
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd 
	 inner join tb_ambiente d on a.id_ambiente = d.id_ambiente
     where a.id_estudosp > 0 " .$p0 . $ps . 
	 " order by a.id_estudosp desc,a.id_projeto ");
	 
 
 // echo($habilita);
$rs33p = mysql_query("select a.* from tb_ambiente a order by a.descr_ambiente ");				  	

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
        <th ><img src="../imagens/logoqrred.jpg" border="0" align="left"></th>
         <th align="center"><h1>P &amp; D - Acompanhamento Semanal de Projetos 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th>
        <th  align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>      
<table width="99%" border="0">
      <tr>
        <th align="right">Projeto</th>
        <th align="left"><select name="id_projeto"  <?php if($habilita ==1) echo(" disabled ");?> onChange="document.form1.submit();" class="search-input5">
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
        <th colspan="3" align="center"><input type="button" onClick="sair();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr bgcolor="#9D9DFF">
              <th colspan="3" align="center">Itens Cadastrados</th>
            </tr>
            <tr >
              <th colspan="3" align="center">Projeto
                <input type="text" name="m_desp" id="m_desp" maxlenght="50" size=50 class="search-input5" /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
              </th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <br>
              <table width="99%" border="0">
                 <tr bgcolor="#D2D2FF" >
                  <th colspan="11" ><h2>Projeto :<?php echo($projetop);?></h2></th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Projeto</th>
                  <th  >Ambiente</th>
                  <th  >Semana</th>
                  <th >Par&acirc;metro</th>
                  <th  >Fementa&ccedil;&atilde;o</th>
                  <th  >Fungos/Bacterias</th>
                  <th  >Cor</th>
                  <th  >Separa&ccedil;&atilde;o</th>
                  <th  >Odor</th>
                  <th  >Observa&ccedil;ao</th>
                  <th  >Classifica&ccedil;&atilde;o</th>
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

    if ($row['class_param'] < 5){
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
             <td align="left" ><?php echo($row['descr_projeto']);?></td>
             <td align="center" >
           <a href="projc007.php?id=<?php echo ($row['id_estudosp']);?>"><?php echo ($row['descr_ambiente']);?></a></td>
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
