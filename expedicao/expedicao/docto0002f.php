<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

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
$m=1;

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
		 
$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$p3 = "";
$p4 = "";
$p5 = "";
if (isset($descrdcto2) && $descrdcto2 != ""){
		 $p5 = " and a.descr_docto like '%" . $descrdcto2 ."%'" ; 
}

if (isset($setor_doc2) && $setor_doc2 != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p3 = " and a.setor_doc = '" . $setor_doc2 ."'" ; 
		 }

if (isset($tipo_doc2) && $tipo_doc2 != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.tipo_doc = '" . $tipo_doc2 ."'" ; 
		 }
		 
		 
$rs2 = mysql_query("select a.* ,
                    DATE_FORMAT(a.data_emis, '%d/%m/%Y') data_emis1,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
                    DATE_FORMAT(a.data_elab, '%d/%m/%Y') data_elab1,
                    DATE_FORMAT(a.data_verif, '%d/%m/%Y') data_verif1,
                    DATE_FORMAT(a.data_autor, '%d/%m/%Y') data_autor1,
                    DATE_FORMAT(a.data_rev, '%d/%m/%Y') data_rev1				
                  from tb_documentos a where a.id_documento > 0 " . $p3 . $p4 . $p5 . " order by a.id_documento desc");				  
$b = mysql_num_rows($rs2);

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
	<title>DOCTO0002f - Lista Mestra de Documentos Fabrica</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcdocs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
		//	window.opener.location.reload();
		}
			
function resetForm(){
    if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="docto0001.php";
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

function alterar_codsi(app)
{
	
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=850,status=yes,height=220"); 


}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 

<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="nome_doc1"  id="nome_doc1" value="<?php echo("$nome_doc");?>">

<table width="95%" border="0">
      <tr>
        <th  align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>Lista de  Documentos- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
         <a href="javascript:atualiza();"><img src="../imagens/atualizar.jpg" title="Atualizar Tabela !" ></a>
        </th>
      </tr>
      <tr>
        <th colspan="4" align="center">
          <?php 
		  $setor_doc2 =  1;
		  
		  if (isset($m)){ ?>
             <input type="button" onClick="javascript:self.close();" value="Sair">
		  <?php }else { ?>
		  <input type="button" onClick="sairex();" value="Sair">
	  
          <?php }?>

        </th>
        
        </tr>
            <tr bgcolor="#9D9DFF">
              <td height="15" colspan="4" align="center">Documentos Cadastrados</td>
            </tr>
                    </tr>
      <tr>
        <th colspan="4" align="left">Setor do Documento 
          <select name="setor_doc2" style="font-size:10" onChange="atualiza();">
            <option value = "">Todos os setores </option>
            <option value="1" <?php if ($setor_doc2 ==  1){echo(" selected ");}?>>Fabrica</option>
            <option value="2" <?php if ($setor_doc2 ==  2){echo(" selected ");}?>>RH</option>
            <option value="3" <?php if ($setor_doc2 ==  3){echo(" selected ");}?>>TI</option>
            <option value="4" <?php if ($setor_doc2 ==  4){echo(" selected ");}?>>Compras</option>
            <option value="5" <?php if ($setor_doc2 ==  5){echo(" selected ");}?>>Comercial</option>
            <option value="6" <?php if ($setor_doc2 ==  6){echo(" selected ");}?>>Financeiro</option>
            <option value="7" <?php if ($setor_doc2 ==  7){echo(" selected ");}?>>Contabilidade</option>
            <option value="8" <?php if ($setor_doc2 ==  8){echo(" selected ");}?>>Qualidade</option>
            <option value="9" <?php if ($setor_doc2 ==  9){echo(" selected ");}?>>Outros</option>
        </select>          Selecione tipo de Documento 
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
          <option value="17" <?php if ($tipo_doc == 17){echo(" selected ");}?>>Termos</option>
         <option value="18" <?php if ($tipo_doc == 18){echo(" selected ");}?>>Documentos de Produ&ccedil;&atilde;o</option>


        </select>
        Descri&ccedil;&atilde;o 
        <label for="descrdcto2"></label>
        <input type="text" name="descrdcto2" id="descrdcto2" tabindex="40" size="40" maxlength="40" onChange="atualiza();"></th>        
      </tr>

            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th height="16">Id</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >Tipo</th>
                  <?php 
				     if ($tipo_doc2  == 4) {?>
                  <th >C&oacute;digo SI</th> 
			     <?php  } ?>
					 
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
                     <?php 
				     if ($tipo_doc2  == 4) {?>
                  <th>Ac&atilde;0</th>
                  <?php } ?>
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
                  <td >
           <a href="#<?php 
		   //docto0001.php?
		   //echo ($row['id_documento']);?>"><?php echo ($row['id_documento']);?>
           </a></td>

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

               case "17":
			        echo ("Termos");
					break;
					
	           case "18":
				    echo ("Documentos de Produ&ccedil;&atilde;o");
					break;
					
			   }		   
			   
			   ?>
           
           </td>
         	 <td  align="center"><?php echo ($row['codigo_si']);?></td>	   
           <td  align="left"><a href="javascript:ver_foto2('<?php  echo($row['nome_doc']);?>','<?php  echo($row['setor_doc']);?>' )"> 
           Ver - <?php  echo($row['nome_doc']);?></td>
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
				  }
				  ?>
           
           </td>
           <td align="center" ><?php echo ($row['num_paginas']);?></td>
           
           <td align="center"><?php echo ($row['data_emis1']);?></td>
           <td align="center"><?php echo ($row['data_autor1']);?></td>
           <td align="center"><?php echo ($row['data_venc1']);?></td>
             <?php 
				     if ($tipo_doc2  == 4) {?>
           <td align="center">
           
           <a href="javascript:alterar_codsi('docto0001f.php?id=<?php echo ($row['id_documento']);?>');">Alterar</a></td>
           <?php } ?>

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
