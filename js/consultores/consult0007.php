<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }


$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
          if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voce nao esta logado !!");
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
 //        $id_itemmanu      = "";	 
//		 $id_consult         = "";
		 $id_chkman        = "";
		 $data_serv        = "";	
		 $obs_chk	 	= "";  
$responsavel = "dilson magalhaes";


		if (!isset($id_consult2)){
		 		 $id_evento      = "";
		}


$id = $_GET ["id"];

$habilit = "S";

$rs330 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome ");		


$p4 = "";
$p41 = "";

$p44 = "";
$p45 = "";

//echo($id_itemmanu22);
if (isset($id_consult)){
	if ($id_consult <> "" ){
          $id_consult2 = $id_consult;
		 }}		 
		 
if (isset($id_consult2)){
	if ($id_consult2 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p4 = " and a.id_consult = '" . $id_consult2 ."'" ; 

		 }}

if (isset($tipo2)){
	if($tipo2 <> ""){
		$p41 = " and a.tipo = '".$tipo2 . "'";
	}
}		 

$rs2 = mysql_query("select a.*,b.nome,
					  DATE_FORMAT(a.data_compr, '%d/%m/%Y') data_compr1
					  from tb_repcompr  a
					  inner join tb_consultor b on b.id_consult = a.id_consult
					  where a.id_consult > 0 ". $p4 . $p41 . "
			          order by a.id_repcompr desc,b.nome");

    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome");		

						  	
if (isset($id)){

    $rs1 = mysql_query("SELECT a.*,
	                	  DATE_FORMAT(a.data_compr, '%d/%m/%Y') data_compr1
						  FROM tb_repcompr a where a.id_repcompr ='". $id."'");

    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
//         $habilit = "N";
     	 $row1 = mysql_fetch_assoc($rs1);

         $id_consult      = $row1['id_consult'];	 
		 $descr_compr     = $row1['descr_compr'];
		 $data_compr      = $row1['data_compr1'];
		 $arq_foto        = $row1['arq_foto'];
		 $tipo            = $row1['tipo'];
		 
		 
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
	<title>CONSULT0007 - Vinculação de Documentos por Representantes </title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcconsult.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
		//	window.opener.location.reload();
	}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_consult.value ='';
		  document.form1.descr_compr.value = '';
		  document.form1.tipo.value = "";
   	   	  document.form1.action="consult0007.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function atualiza(){
   document.form1.submit();	
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
        <th align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th >
        <h1>Vincula&ccedil;&atilde;o de Documentos por Representante - 
        <?php
	// echo($_SESSION['id_consult']);
		  ?>
      </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br><?php echo($hoje);?></th>
      </tr>
</table>
<table width="95%" border="0">
      
      <tr>
      <th  colspan="2" align="center"></th></tr>
      <tr>
        <th align="right">Representante</th>
        <th align="left" ><select name="id_consult" onChange="atualiza();" class="search-input2">
          <option value="">Selecione o Representante</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult ) {?>selected <? } ?>				
				 ><?php echo($row33['nome'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th  align="right">Descri&ccedil;&atilde;o</th>
        <th align="left" ><input type="text" id = "descr_compr" name="descr_compr" maxlength="60" size="60"  value="<?php echo($descr_compr); ?>" class="search-input6" > 
        Tipo 
          <select name="tipo"  class="search-input3">
            <option value="C" <?php if ($tipo == 'C'){echo(" selected ");}?>>Contratos</option>
            <option value="O" <?php if ($tipo == 'O'){echo(" selected ");}?>>Comprovantes</option>
            <option value="T" <?php if ($tipo == 'T'){echo(" selected ");}?>>Termos</option>
            <option value="D" <?php if ($tipo == 'D'){echo(" selected ");}?>>Documentos Diversos</option>

        </select></th>
      </tr>
      <tr>
        <th  align="right">Data</th>
        <th align="left" ><input type="text" name="data_compr" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" value="<?php echo($data_compr); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_compr);" onChange="verifica_data(this.value,data_compr);" class="search-input3"/></th>
      </tr>
      <tr>
        <th  align="right">Documento</th>
        <th align="left" >   <input type="file" id="arq_instr" name="arq_instr"  class="search-submit2" accept="*" onChange="pegaArquivo(this.files)"  />
          <a href="javascript:ver_foto('<?php  echo($arq_foto);?>')">
          <?php  echo($arq_foto);?>
- ver Documento </a></th>
      </tr>
      <tr>
        <th colspan="2" align="center">
        <?php if ($btn == 's'){ ?>

          <input type="button" name="gravar"  onClick="valida_comprovr();" value="Gravar" class="search-submit2"  />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluir_comprovr(<?php echo($id); ?>);" value="Excluir" class="search-submit2" />
       <?php } ?>
          <input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th colspan="2" align="center">Registros Cadastrados</th>
      </tr>
      <tr>
        <th colspan="2" align="left">Funcion&aacute;rio 
          <select name="id_consult2"  onChange="atualiza();"  class="search-input6">
            <option value="">Selecione o Representante</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult2 ) {?>selected <? } ?>				
				 ><?php echo($row33['nome']  );?></option>
            <?php }?>
        </select>
        
         Tipo 
          <select name="tipo2" onChange="atualiza();" class="search-input3">
            <option value = ""> Selecione o Tipo</option>           
            <option value="C" <?php if ($tipo2 == 'C'){echo(" selected ");}?>>Contratos</option>
            <option value="O" <?php if ($tipo2 == 'O'){echo(" selected ");}?>>Comprovantes</option>
            <option value="T" <?php if ($tipo2 == 'T'){echo(" selected ");}?>>Termos</option>
            <option value="D" <?php if ($tipo2 == 'D'){echo(" selected ");}?>>Documentos Diversos</option>
            
          </select>
        
        </th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td colspan="2" align="center">
              <table width="80%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >Representante</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >Data</th>
                  <th >Documento</th>
                  <th >Tipo</th>
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
             <td  align="left">
           <a href="consult0007.php?id=<?php echo ($row['id_repcompr']);?>"><?php echo ($row['id_repcompr']);?></a></td>
           <td align="left"><?php echo ($row['nome']);?></td>
           <td align="left"><?php echo ($row['descr_compr']);?></td>
           <td align="left"><?php echo ($row['data_compr1']);?></td>
           <td align="left"><a href="javascript:ver_foto('<?php  echo($row['arq_foto']);?>')"><?php  echo($row['arq_foto']);?></a></td>
           <td align="left"><?php
		   
		switch ($row['tipo']) {
        case 'C':
           echo "Contratos";
            break;
        case 'O':
           echo "Comprovantes";
            break;
        case 'T':
           echo "Termos";
            break;
        case 'D':
           echo "Documentos Diversos";
            break;
}
		
?>
</td>
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
