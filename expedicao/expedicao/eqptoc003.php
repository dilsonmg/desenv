<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
          if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

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
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;

	     $data_aquisi        = '';
	     $data_instal        = '';
		 $dt_garantia        = '';
	 
//		 $id_eqpto         = '';
		 $codigo_eqpto      = '';
		 $descr_eqpto      = '';
		 $modelo_eqpto     = '';
		 $localizacao      = '';
		 $fabricante       = '';
		 $situacao         = '';
		 $custo_eqpto      = '0,00';
		 $inf_adic         = '';
		 $resp_eqpto       = '';
		 $arq_foto         = '';
		 $id_categ         = '';

$id = $_GET ["id"];

$habilit = "S";
$p4 = "";
$p5 = "";

if (isset($id_eqpto1)){
	if ($id_eqpto1 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_eqpto = '" . $id_eqpto1 ."'" ; 
		 }}
if (isset($id_fornec1)){
	if ($id_fornec1 <> "" ){
		 $p5 = " and a.id_fornec = '" . $id_fornec1 ."'" ; 
		 }}

$rs2 = mysql_query("select a.* from tb_equipamento a  where a.id_eqpto > 0 " . $p4 . $p5 . " order by a.descr_eqpto ");				  
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("select a.* from tb_categoria a order by a.descr_cat");				  	

if (isset($id)){


    $rs1 = mysql_query("SELECT a.* FROM tb_equipamento a 
	    where a.id_eqpto =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";

    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_aquisi        = strftime("%d/%m/%Y", strtotime($row1['data_aquisi']));
	     $data_instal        = strftime("%d/%m/%Y", strtotime($row1['data_instal']));
		 $dt_garantiafab     = strftime("%d/%m/%Y", strtotime($row1['dt_garantiafab']));
	 
		 $id_eqpto         = $row1['id_eqpto'];
		 $codigo_eqpto      = $row1['codigo_eqpto'];
		 $descr_eqpto      = $row1['descr_eqpto'];
		 $modelo_eqpto     = $row1['modelo_eqpto'];
		 $localizacao      = $row1['localizacao'];
		 $fabricante       = $row1['fabricante'];
		 $situacao         = $row1['situacao'];
		 $custo_eqpto      = $row1['custo_eqpto'];
		 $inf_adic         = $row1['inf_adic'];
		 $resp_eqpto       = $row1['resp_eqpto'];
		 $arq_foto         = $row1['arq_foto'];
		 $id_categ         = $row1['id_categ'];
		 		  
	  }
	 
 }
$rs33 = mysql_query("select a.* from tb_equipamento a order by a.descr_eqpto");				  	
$rs34 = mysql_query("select a.* from tb_fornecedor a  group by a.rz_social order by a.rz_social");				  	

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
	<title>EQPTO0001 - Cadastro de Equipamentos</title>
    <link rel="stylesheet" href="equipamento.css">
	<script type='text/javascript' src="funcequipamento.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
			
function resetForm(){
    if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="eqpto0001.php";
		  document.form1.submit();  
		  return true;
		  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}
function atualiza(){
   document.form1.submit();	
}
</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="data_req" value="<?php echo("$data_req");?>">
<input type=hidden name="arq_foto"  id="arq_foto" value="<?php echo("$arq_foto");?>">

<table width="95%" border="1"  bordercolor="#CCCCCC">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="2" ><h1>Equipamentos Cadastrados</h1></th>
      </tr>
      <tr>
        <td height="23" colspan="2" align="rigth" bgcolor="#9D9DFF"> Equipamento :
        <select name="id_eqpto1" style="font-size:10" onChange="atualiza();">
            <option value="">Selecione o Equipamento</option>
        <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php print($row33['id_eqpto'])?>"
				  <? if($row33['id_eqpto'] == $id_eqpto1 ) {?>selected <? } ?>				
				 ><?php print($row33['descr_eqpto'] )?></option>
            <?php }?>
          </select>
<font size="2" face="Arial, Helvetica, sans-serif">
    <input type="submit" name="Submit5"   value="Filtrar" style="font:color='#006600'-size:8" />
    <input type="button" onClick="sair();" value="Sair">
  </font></td>

            <tr align="center">
              <td colspan="2" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th>Id</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >Localiza&ccedil;&atilde;o</th>
                  <th >Respons&aacute;vel</th>
                  <th >Fabricante</th>
                  <th>Situa&ccedil;&atilde;o</th>
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

              <td >
               <a href="eqpto0001.php?id=<?php echo ($row['id_eqpto']);?>&m='n'" 
               onClick="window.open(this.href, this.target, ' resizable = no,width=1200,height=500, toolbar = no '); return false;" target="_blank" >
			   <?php echo ($row['id_eqpto']);?></a></td>

           <td ><?php echo ($row['descr_eqpto']);?></td>
           <td  align="left"><?php echo ($row['localizacao']);?></td>
           <td align="left" ><?php echo ($row['resp_eqpto']);?></td>
           <td><?php echo ($row['fabricante']);?></td>
           <td align="center">
		   <?php 
		   switch ($row['situacao']) {
				case "1":
					echo ("Ativo");
					break;
				case "2":
					echo ("Inativo");
					break;
				case "3":
					echo ("Em Manutenção");
					break;
				case "4":
					echo ("Alugado");
					break;
				case "5":
					echo ("Baixado");
					break;
}
		   
		   ?></td>

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