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

$rs330 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome ");		

$rs2 = mysql_query("select a.*,b.nome,
					  DATE_FORMAT(a.data_compr, '%d/%m/%Y') data_compr1
					  from tb_repcompr  a
					  inner join tb_consultor b on b.id_consult = a.id_consult
					  where a.id_consult > 0 ". $p4 . $p41 . "
			          order by a.id_repcompr desc,b.nome");

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
	<title>CONSULT0007 - Vinculação de Documentos por Representantes </title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcconsult.js"   charset="ISO-8859-1"></script>
   
<script>    

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
      </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br><?php echo($hoje);?></th>
      </tr>
</table>
<table width="95%" border="0">
      
      <tr>
      <th align="center"></th></tr>
      <tr>
        <th align="center"><input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th align="center">Registros Cadastrados</th>
      </tr>
      <tr>
        <th align="left">Funcion&aacute;rio 
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
            <tr align="center">
              <td align="center">
              <table width="90%" border="1" bordercolor="#CCCCCC">
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
           <th  align="left"><?php echo ($row['id_repcompr']);?></th>
           <th align="left"><?php echo ($row['nome']);?></th>
           <th align="left"><?php echo ($row['descr_compr']);?></th>
           <th align="left"><?php echo ($row['data_compr1']);?></th>
           <th align="left"><a href="javascript:ver_foto('<?php  echo($row['arq_foto']);?>')"><?php  echo($row['arq_foto']);?></a></th>
           <th align="left"><?php
		   
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
</th>
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
