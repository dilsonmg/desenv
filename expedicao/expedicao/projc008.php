<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

//Prevent page caching
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header("Cache-Control: no-cache");
 header("Pragma: no-cache");
 
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
/*
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

}

*/
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;

	     $documento      = '';
	     $descricao      = '';
		 $data_doc       = '';
	 
//		 $id_eqpto         = '';
		 $resp_doc       = '';
		 
$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$p4 = "";

$rs33 = mysql_query("select a.*,
DATE_FORMAT(a.data_abertura, '%d/%m/%Y') data_abertura1,
DATE_FORMAT(a.data_fechamento, '%d/%m/%Y') data_fechamento1
from tb_projeto a order by a.id_projeto");				  	
$p1= "";
if (isset($id_projeto) && $id_projeto != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p1 = " and a.id_projeto = '" . $id_projeto ."'" ; 
		 }

if (isset($descpro) && $descpro != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and b.descr_projeto like '%" . $descpro ."%'" ; 
		 }
		 
$rs2 = mysql_query("select a.* ,b.descr_projeto,
                    DATE_FORMAT(a.data_doc, '%d/%m/%Y') data_doc1, b.doc_abertura,b.doc_fecha,b.data_abertura,b.data_fechamento
					 from tb_docsprojeto a 
					 inner join tb_projeto b on a.id_projeto = b.id_projeto " . $p4 . 
					 " where a.id_projeto > 0 " . $p1 . "  order by a.id_projeto desc");		
/*					 
echo("select a.* ,b.descr_projeto,
                    DATE_FORMAT(a.data_doc, '%d/%m/%Y') data_doc1, b.doc_abertura,b.doc_fecha,b.data_abertura,b.data_fechamento
					 from tb_docsprojeto a 
					 inner join tb_projeto b on a.id_projeto = b.id_projeto " . $p4 . 
					 " where a.id_projeto > 0 " . $p1 . "  order by a.id_projeto desc");
	*/				 			 		  
$b = mysql_num_rows($rs2);

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_docsprojeto a where a.id_docsprojeto = '". $id ."'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
		 
		 $data_doc     = "00/00/0000";
  
    	 $row1 = mysql_fetch_assoc($rs1);
  
         $data_doc      = strftime("%d/%m/%Y", strtotime($row1['data_doc']));
		 if(strftime("%Y", strtotime($row1['data_doc'])) != "1969"){
	        $data_doc      = strftime("%d/%m/%Y", strtotime($row1['data_doc']));
		 }
		 
		 $id_projeto  = $row1['id_projeto'];
		 $descr_doc   = $row1['descr_doc'];
		 $nome_doc    = $row1['nome_doc'];
		 $resp_doc	  = $row1['resp_doc'];
		 } 
 }

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
	<title>PROJ0008 - Cadastro de Documentos dos Projetos</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcprojs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
  //  if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="proj0008.php";
		  document.form1.submit();  
		  return true;
	//	  }
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
<input type=hidden name="nome_doc1"  id="nome_doc1" value="<?php echo("$nome_doc");?>">

<table width="99%" border="0">
      <tr>
        <th align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h1>P &amp; D - Cadastro de Documentos dos Projetos- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
<table width="99%" border="0">      
 
      <tr>
        <th align="right">Projeto</th>
        <th align="left"><select name="id_projeto" <?php if($habilita ==1) echo(" disabled ");?> onChange="document.form1.submit();" class="search-input5">
          <option value="">Selecione o Projeto</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php print($row33['id_projeto'])?>"
				  <? if($row33['id_projeto'] == $id_projeto ) {?>selected <?
				     $projetop = $row33['descr_projeto'];
					 $doc_abertura = $row33['doc_abertura'];
					 $doc_fecha = $row33['doc_fecha'];
					 $data_abertura1 = $row33['data_abertura1'];
					 $data_fechamento1 = $row33['data_fechamento1'];
				   } ?>	
                  			
				 ><?php print($row33['id_projeto'] . " - " . $row33['descr_projeto'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th colspan="3" align="center">
          <?php 
		  
		  if (isset($m)){ ?>
             <input type="button" onClick="javascript:self.close();" value="Sair" class="search-submit2">
		  <?php }else { ?>
		  <input type="button" onClick="sair();" value="Sair" class="search-submit2">
	  
          <?php }?>

        </th>
        
      <tr>
        <td colspan="3" align="left">Projeto 
          <input type="text" id = "descpro" name="descpro" maxlength="60" size="60"  value=""  onChange="document.form1.submit();"  class="search-input5"  ></td>
      </tr>

            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                   <th colspan="6" ><h2>Projeto :<?php echo($projetop);?></h2></th>

                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th colspan="6" >
                  <table width="100%" border="0">
                  <tr bgcolor="#B7B7FF">
                  <th align="left">
                  Doc. Abertura :<a href="javascript:ver_foto(<?php  echo("'".$doc_abertura."',".$id_projeto);?>)">
                    <?php  echo($doc_abertura);?>
                   </a></th>
                   <th align="left">Data Abertura :   <?php  echo($data_abertura1);?></th>
                   <th align="left">
                  Doc. Fechamento<a href="javascript:ver_foto(<?php  echo("'".$doc_fecha."',".$id_projeto);?>)">
                    <?php  echo($doc_fecha);?></a></th>
                    <th align="left">Data Fechamento:<?php  echo($data_fechemento1);?>
                  </th>
                </tr>
                </table>
                <tr bgcolor="#9D9DFF" >
                  <td colspan="6" align="center">Documentos dos Projetos Cadastrados</td>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Id</th>
                  <th >Projeto</th>
                  <th >Descricao Doc</th>
                  <th >Documento</th>
                  <th >Data</th>
                  <th >Responsavel</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#e2e2e2";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

             
 
                  <tr>
                    <td >
                    <a href="projc008.php?id=<?php echo ($row['id_docsprojeto']);?>"><?php echo ($row['id_docsprojeto']);?></a></td>
                    <td  align="left"><?php echo($row['descr_projeto']); ?></td>

           <td  align="left"><?php echo ($row['descr_doc']);?></td>
           <td  align="left">
		   <a href="javascript:ver_foto1(<?php  echo("'".$row['nome_doc']."',".$row['id_projeto']);?>)"> <?php  echo($row['nome_doc']);?></a>
           </td>
           <td  align="center"><?php echo ($row['data_doc1']);?></td>
           <td  align="left"><?php echo ($row['resp_doc']);?></td>
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
