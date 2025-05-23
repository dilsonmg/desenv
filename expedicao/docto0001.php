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
		 $id_consult       = '';
		 
$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$p4 = "";
if (isset($tipo_doc2) && $tipo_doc2 != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.tipo_doc = '" . $tipo_doc2 ."'" ; 
		 }
		 
$p5 = "";
if (isset($descrdcto2) && $descrdcto2 != ""){
		 $p5 = " and a.descr_docto like '%" . $descrdcto2 ."%'" ; 
}
		 
$rs2 = mysql_query("select a.* ,
                    DATE_FORMAT(a.data_emis, '%d/%m/%Y') data_emis1,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
                    DATE_FORMAT(a.data_elab, '%d/%m/%Y') data_elab1,
                    DATE_FORMAT(a.data_verif, '%d/%m/%Y') data_verif1,
                    DATE_FORMAT(a.data_autor, '%d/%m/%Y') data_autor1,
                    DATE_FORMAT(a.data_rev, '%d/%m/%Y') data_rev1				
                  from tb_documentos a where a.id_documento > 0 " . $p4 . $p5 . " order by a.id_documento desc");				  
$b = mysql_num_rows($rs2);

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
	<title>DOCTO0001 - Cadastro de Documentos</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcdocs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
  //  if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="docto0001.php";
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
<?php 
  if ($_SESSION['permi'] == '111') {
	  
	  echo("<input type='button' onClick='sair();' value='Sair'>");
  }else {
  ?>
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="nome_doc1"  id="nome_doc1" value="<?php echo("$nome_doc");?>">

<table width="100%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th colspan="4" align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
  <tr>
      <th height="45" colspan="5" align="center"><h1>Cadastro de Documentos- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>       
      </h1>
      <br> Atencao ! Os arquivos tem que possuir no maximo 1.2 mb !</th></tr>
      <tr>
        <th align="right">Descri&ccedil;&atilde;o</th>
        <th align="left"><input type="text" id = "descr_docto" name="descr_docto" maxlength="100" size="100"  value="<?php echo($descr_docto); ?>" ></th>
        <th align="right">Tipo de Documento</th>
        <th colspan="2" align="left">
        <select name="tipo_doc" style="font-size:10">
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
          
          
          
        </select></th>
     
      </tr>
      <tr>
        <th align="right">Nome Documento</th>
        <th align="left"><input type="file" id="arq_instr" name="arq_instr" accept="*" onChange="pegaArquivo(this.files)" />    
              <a href="javascript:ver_foto('<?php  echo($nome_doc);?>')"> Ver - <?php  echo($nome_doc);?> </a></th>
        <th align="right">Vers&atilde;o</th>
        <th colspan="2" align="left"><input type="text" id = "versao_doc" name="versao_doc" maxlength="50" size="15"  value="<?php echo($versao_doc); ?>" ></th>
      </tr>
      <tr>
        <th align="right">Setor Documento</th>
        <th align="left"> 
        <select name="setor_doc" style="font-size:10">
          <option value="1" <?php if ($setor_doc ==  1){echo(" selected ");}?>>Fabrica</option>
          <option value="2" <?php if ($setor_doc ==  2){echo(" selected ");}?>>RH</option>
          <option value="3" <?php if ($setor_doc ==  3){echo(" selected ");}?>>TI</option>
          <option value="4" <?php if ($setor_doc ==  4){echo(" selected ");}?>>Compras</option>
          <option value="5" <?php if ($setor_doc ==  5){echo(" selected ");}?>>Comercial</option>
          <option value="6" <?php if ($setor_doc ==  6){echo(" selected ");}?>>Financeiro</option>
          <option value="7" <?php if ($setor_doc ==  7){echo(" selected ");}?>>Contabilidade</option>
          <option value="8" <?php if ($setor_doc ==  8){echo(" selected ");}?>>Qualidade</option>
          <option value="9" <?php if ($setor_doc ==  9){echo(" selected ");}?>>Outros</option>
          <option value="10" <?php if ($setor_doc ==  10){echo(" selected ");}?>>Representantes</option>
          
        </select></th>
        <th align="right">N. Paginas</th>
        <th colspan="2" align="left"><input type="text" name="num_paginas" size="8" placeholder="Informe num" maxlength="10" value="<?php echo $num_paginas ?>" title="Informe num. paginas" /></th>
      </tr>
      <tr>
        <th align="right">Data Emissao</th>
        <th align="left"><input type="text" name="data_emis" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_emis ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_emis);" onChange="verifica_data(this.value,data_emis);"/></th>
        <th align="right">Vencimento</th>
        <th colspan="2" align="left"><input type="text" name="data_venc" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_venc ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_venc);" onChange="verifica_data(this.value,data_venc);"/></th>
      </tr>
      <tr>
        <th align="right">Elaborado Por</th>
        <th align="left"><input type="text" id = "elab_por"  name="elab_por" placeholder="Informe o nome !" maxlength="80" size="80"  value="<?php echo($elab_por); ?>" ></th>
        <th align="right">Data</th>
        <th colspan="2" align="left"><input type="text" name="data_elab" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_elab ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_elab);" onChange="verifica_data(this.value,data_elab);"/></th>
      </tr>
      <tr>
        <th align="right">Verificado  Por</th>
        <th align="left"><input type="text" id = "verif_por"  name="verif_por" placeholder="Informe o nome !" maxlength="80" size="80"  value="<?php echo($verif_por); ?>" ></th>
        <th align="right">Data</th>
        <th colspan="2" align="left"><input type="text" name="data_verif" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_verif ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_verif);" onChange="verifica_data(this.value,ddata_verif);"/></th>
      </tr>
      <tr>
        <th align="right">Autorizado  Por</th>
        <th align="left"><input type="text" id = "auto_por"  name="auto_por" placeholder="Informe o nome !" maxlength="80" size="80"  value="<?php echo($auto_por); ?>" ></th>
        <th align="right">Data</th>
        <th colspan="2" align="left"><input type="text" name="data_autor" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_autor ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_autor);" onChange="verifica_data(this.value,data_autor);"/></th>
      </tr>
      <tr>
        <th align="right">Revisado  Por</th>
        <th align="left"><input type="text" id = "revis_por"  name="revis_por" placeholder="Informe o nome !" maxlength="80" size="80"  value="<?php echo($revis_por); ?>" ></th>
        <th align="right">Data</th>
        <th colspan="2" align="left"><input type="text" name="data_rev" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo $data_rev ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_rev);" onChange="verifica_data(this.value,data_rev);"/></th>
      </tr>
      <tr>
        <th align="right">Obs</th>
        <th align="left"><input type="text" id = "obs_doc"  name="obs_doc" placeholder="Informe a observacao !" maxlength="150" size="90"  value="<?php echo($obs_doc); ?>" ></th>
        <th align="right">Consultor</th>
        <th colspan="2" align="left">
          <select name="id_consult" style="font-size:12">
            <option value="0">Selecione o consultor</option>
            <?php while($row1=mysql_fetch_assoc($rs88)){ ?>
            <option value="<?php print($row1['id_consult'])?>"
				     <? if($row1['id_consult'] == $id_consult ) {?>selected <? } ?>				
				 ><?php print($row1['nome'] )?></option>
            <?php }//end if ?>
          </select>
        </th>
      </tr>
      <tr>
        <th colspan="6" align="center">
          <?php 
		  
		  if (isset($m)){ ?>
             <input type="button" onClick="javascript:self.close();" value="Sair">
		  <?php }else { ?>
          <input type="button" name="gravar"  onClick="validaform();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Novo Documento" onclick="resetForm();" >
          <input type="button" name="Submit4"  onclick="excluir_docto(<?php echo($id); ?>);" value="Excluir Documento" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
	  
          <?php }?>

        </th>
        
        </tr>
            <tr bgcolor="#9D9DFF">
              <td height="15" colspan="6" align="center">Documentos Cadastrados</td>
            </tr>
                    </tr>
      <tr>
        <th colspan="6" align="left">Selecione tipo de Documento 
          <select name="tipo_doc2" style="font-size:10" onChange="atualiza();">
            <option value ="">Todos os Documentos</option>
            <option value="1" <?php if ($tipo_doc2 ==  1){echo(" selected ");}?>>Procedimento</option>
            <option value="2" <?php if ($tipo_doc2 ==  2){echo(" selected ");}?>>Instru&ccedil;&atilde;o Normativa</option>
            <option value="3" <?php if ($tipo_doc2 ==  3){echo(" selected ");}?>>Manuais</option>
            <option value="4" <?php if ($tipo_doc2 ==  4){echo(" selected ");}?>>Fispqs</option>
            <option value="5" <?php if ($tipo_doc2 ==  5){echo(" selected ");}?>>Fets</option>
            <option value="6" <?php if ($tipo_doc2 ==  6){echo(" selected ");}?>>Fichas de Emergencia</option>
            <option value="7" <?php if ($tipo_doc2 ==  7){echo(" selected ");}?>>Certificados</option>
            <option value="8" <?php if ($tipo_doc2 ==  8){echo(" selected ");}?>>Licencas</option>
            <option value="9" <?php if ($tipo_doc2 ==  9){echo(" selected ");}?>>Contratos</option>
            <option value="10" <?php if ($tipo_doc2 == 10){echo(" selected ");}?>>Alvaras</option>
            <option value="11" <?php if ($tipo_doc2 == 11){echo(" selected ");}?>>Listas</option>
            <option value="12" <?php if ($tipo_doc2 == 12){echo(" selected ");}?>>Formularios</option>
            <option value="13" <?php if ($tipo_doc2 == 13){echo(" selected ");}?>>Laudos Tecnicos</option>
            <option value="14" <?php if ($tipo_doc2 == 14){echo(" selected ");}?>>Outros</option>
            <option value="15" <?php if ($tipo_doc2 == 15){echo(" selected ");}?>>Certidoes</option>
            <option value="16" <?php if ($tipo_doc2 == 16){echo(" selected ");}?>>Reg. Marcas e Patentes</option>
            
          
        </select>
            Descri&ccedil;&atilde;o 
        <label for="descrdcto2"></label>
        <input type="text" name="descrdcto2" id="descrdcto2" tabindex="40" size="40" maxlength="40" onChange="atualiza();"></th>        

        
        </th>
      </tr>

            <tr align="center">
              <td colspan="6" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th>Id</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >Tipo</th>
                  <th >Nome</th>
                  <th >Vers&atilde;o</th>
                  <th >Elaborado por</th>
                  <th >Autorizado por</th>
                  <th >Verificado por</th>
                  <th >Revisado por</th>
                  <th >Pertencente ao Setor</th>
                  <th >Num. Paginas</th>
                  <th >Emiss&atilde;o</th>
                  <th>Autoriza&ccedil;&atilde;o</th>
                  <th>Vencimento</th>
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

             
 
                  <td >
           <a href="docto0001.php?id=<?php echo ($row['id_documento']);?>"><?php echo ($row['id_documento']);?></a></td>

           <td ><?php echo ($row['descr_docto']);?></td>
           <td  align="center">
		   <?php 
		       switch ($row['tipo_doc']){
			   case "1":
					echo ("Procedimento");
					break;
			   case "2":
					echo ("Instrução Normativa");
					break;
			   case "3":
					echo ("Manuais");
					break;
			   case "4":
					echo ("Fispq");
					break;
			   case "5":
					echo ("Fet");
					break;
			   case "6":
					echo ("Ficha de Emergência");
					break;
			   case "7":
					echo ("Certificados");
					break;
			   case "8":
					echo ("Licenças");
					break;
			   case "9":
					echo ("Contratos");
					break;
			   case "10":
					echo ("Alvarás");
					break;
			   case "11":
					echo ("Listas");
					break;
			   case "12":
					echo ("Formularios");
					break;
			   case "13":
					echo ("Laudos Tecnicos");
					break;
			   case "14":
					echo ("Outros");
					break;
			   case "15":
					echo ("Certidoes");
					break;
			   case "16":
					echo ("Reg. Marcas e Patentes");
					break;

			   }		   
			   
			   ?>
           
           </td>
           <td  align="left"><?php echo ($row['nome_doc']);?></td>
           <td  align="center"><?php echo ($row['versao_doc']);?></td>
           <td  align="center"><?php echo ($row['elab_por']);?></td>
           <td  align="center"><?php echo ($row['auto_por']);?></td>
           <td  align="center"><?php echo ($row['verif_por']);?></td>
           <td  align="center"><?php echo ($row['revis_por']);?></td>
           <td  align="center">
		    <?php switch ($row['setor_doc']){
			   case "1":
					echo ("Fábrica");
					break;
			   case "2":
					echo ("RH");
					break;
			   case "3":
					echo ("TI");
					break;
			   case "4":
					echo ("Compras");
					break;
			   case "5":
					echo ("Comercial");
					break;
			   case "6":
					echo ("Financeiro");
					break;
			   case "7":
					echo ("Contabilidade");
					break;
			   case "8":
			   		echo ("Qualidade");
					break;
			   case "9":
					echo ("Outros");
					break; 
			   case "10":
					echo ("Representantes");
					break; 
				  }
				  ?>
           
           </td>
           <td align="center" ><?php echo ($row['num_paginas']);?></td>
           
           <td align="center"><?php echo ($row['data_emis1']);?></td>
           <td align="center"><?php echo ($row['data_autor1']);?></td>
           <td align="center"><?php echo ($row['data_venc1']);?></td>

          </tr>
          <?php 
		   } 
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
