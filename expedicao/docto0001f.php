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

	     $descr_docto      = '';
	     $tipo_doc         = '';
		 $data_emis        = '';
	 
//		 $id_eqpto         = '';
		 $data_venc        = '';
		 $setor_doc        = '';
		 $elab_por         = '';
		 $verif_por        = '';
		 $auto_por         = '';
		 $revis_por        = '';
		 $data_elab        = '';
		 $data_verif       = '';
		 $data_autor       = '';
		 $data_rev         = '';
		 $versao_doc       = '';
		 $nome_doc         = '';
		 $num_paginas      = '';
		 $obs_doc          = '';
		 
$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$p4 = "";




$rs88 = mysql_query("SELECT * FROM quimicareal.tb_consultor where id_cargo > 0  order by nome");



if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_documentos a 
	    where a.id_documento =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
		 
		 $data_venc  = "00/00/0000";
		 $data_emis  = "00/00/0000";
         $data_elab  = "00/00/0000";
         $data_veri  = "00/00/0000";
         $data_autor = "00/00/0000";
         $data_rev   = "00/00/0000";
         $data_verif = "00/00/0000";


    	 $row1 = mysql_fetch_assoc($rs1);
         if($data_emis != ""){
	         $data_emis      = strftime("%d/%m/%Y", strtotime($row1['data_emis']));
		 }
		 if(strftime("%Y", strtotime($row1['data_venc'])) != "1969"){
	        $data_venc      = strftime("%d/%m/%Y", strtotime($row1['data_venc']));
		 }
		 if(strftime("%Y", strtotime($row1['data_elab'])) != "1969"){
		   $data_elab      = strftime("%d/%m/%Y", strtotime($row1['data_elab']));
		 }
		 if(strftime("%Y", strtotime($row1['data_verif'])) != "1969"){
		    $data_verif     = strftime("%d/%m/%Y", strtotime($row1['data_verif']));
		 }
		 if(strftime("%Y", strtotime($row1['data_autor'])) != "1969"){
		    $data_autor     = strftime("%d/%m/%Y", strtotime($row1['data_autor']));
		 }
		 if(strftime("%Y", strtotime($row1['dat_rev'])) != "1969"){
    		$dat_rev        = strftime("%d/%m/%Y", strtotime($row1['data_rev']));
		 }
		 
		 $descr_docto      = $row1['descr_docto'];
		 $tipo_doc         = $row1['tipo_doc'];
		 $setor_doc        = $row1['setor_doc'];
		 $elab_por         = $row1['elab_por'];
		 $verif_por        = $row1['verif_por'];
		 $auto_por         = $row1['auto_por'];
		 $revis_por        = $row1['revis_por'];
		 $versao_doc       = $row1['versao_doc'];
		 $nome_doc         = $row1['nome_doc'];
		 $num_paginas      = $row1['num_paginas'];
		 $obs_doc          = $row1['obs_doc'];
		 $id_consult       = $row1['id_consult'];
		 $codigo_si        = $row1['codigo_si'];
		 
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
	<title>DOCTO0001f - Cadastro de Documentos - Inclusão do codigo de Materia Prima</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcdocs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}
function atualiza(){
   document.form1.submit();	
}


function gravar_cdsi(){
	   	 document.form1.action="doctogr01f.php";
		 document.form1.submit();  
		 return true;
	
}
</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="nome_doc1"  id="nome_doc1" value="<?php echo("$nome_doc");?>">

<table width="100%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h3>Cadastro de Documentos-
        <?php
	echo($_SESSION['id_entmatp']);
		  ?></h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
       
        </th>
      </tr>
      
</table>
<table width="100%" border="0">
      <tr>
        <th align="right">Descri&ccedil;&atilde;o</th>
        <th  align="left"><input type="text" id = "descr_docto" name="descr_docto" maxlength="150" size="80"  value="<?php echo($descr_docto); ?>" ></th>
      </tr>
      <tr>
        <th align="right">Tipo de Documento</th>
        <th  align="left"><select name="tipo_doc"  disabled>
          <option value="1" <?php if ($tipo_doc ==  1){echo(" selected ");}?>>Procedimento</option>
          <option value="2" <?php if ($tipo_doc ==  2){echo(" selected ");}?>>Instru&ccedil;&atilde;o Normativa</option>
          <option value="3" <?php if ($tipo_doc ==  3){echo(" selected ");}?>>Manuais</option>
          <option value="4" <?php if ($tipo_doc ==  4){echo(" selected ");}?>>Fispqs</option>
          <option value="5" <?php if ($tipo_doc ==  5){echo(" selected ");}?>>Fets</option>
          <option value="6" <?php if ($tipo_doc ==  6){echo(" selected ");}?>>Fichas de Emergencia</option>
          <option value="7" <?php if ($tipo_doc ==  7){echo(" selected ");}?>>Certificados</option>
          <option value="8" <?php if ($tipo_doc ==  8){echo(" selected ");}?>>Licencas</option>
          <option value="9" <?php if ($tipo_doc ==  9){echo(" selected ");}?>>Contratos</option>
          <option value="10" <?php if ($tipo_doc == 10){echo(" selected ");}?>>Alvaras</option>
          <option value="11" <?php if ($tipo_doc == 11){echo(" selected ");}?>>Listas</option>
          <option value="12" <?php if ($tipo_doc == 12){echo(" selected ");}?>>Formularios</option>
          <option value="13" <?php if ($tipo_doc == 13){echo(" selected ");}?>>Laudos Tecnicos</option>
          <option value="14" <?php if ($tipo_doc == 14){echo(" selected ");}?>>Outros</option>
          <option value="15" <?php if ($tipo_doc == 15){echo(" selected ");}?>>Certidoes</option>
          <option value="16" <?php if ($tipo_doc == 16){echo(" selected ");}?>>Reg. Marcas e Patentes</option>
          <option value="17" <?php if ($tipo_doc == 17){echo(" selected ");}?>>Termos</option>
          <option value="18" <?php if ($tipo_doc == 18){echo(" selected ");}?>>Documentos de Produ&ccedil;&atilde;o</option>
        </select></th>
      </tr>
      <tr>
        <th align="right">C&oacute;digo SI</th>
        <th  align="left"><input type="text" id = "codigo_si" name="codigo_si" maxlength="10" size="10"  value="<?php echo($codigo_si); ?>" ></th>
      </tr>
    
   
      <tr>
        <th colspan="2" align="center">
          
		  
          <input type="button" onClick="javascript:self.close();" value="Sair">
		  
          <input type="button" name="gravar"  onClick="gravar_cdsi();" value="Gravar"  />
         
	  
      

        </th>
        
        </tr>
         

       
 
           
    </table>     
</form> 
</center>
</body>
</html>
