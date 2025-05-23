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
		if (is_numeric($descrdcto2)){
		   $descrdcto2 = intval($descrdcto2);
	}
		 $p5 = " and a.descr_docto like '%" . $descrdcto2 ."%'" ; 
}
$tipo_doc         = 1;
$setor_doc        = 13;

if (isset($setor_doc2) && $setor_doc2 != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p3 = " and a.setor_doc = '" . $setor_doc2 ."'" ; 
		 }

//if (isset($tipo_doc2) && $tipo_doc2 != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.tipo_doc in (7,13,18) " ; 
//		 }
		 
 if ($_SESSION['permi'] == '300' || $_SESSION['permi'] == '111' ) { 
		 $p3 = " and a.setor_doc = '1'" ; 
}
		 		 
$rs2 = mysql_query("select a.* ,
                    DATE_FORMAT(a.data_emis, '%d/%m/%Y') data_emis1,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
                    DATE_FORMAT(a.data_elab, '%d/%m/%Y') data_elab1,
                    DATE_FORMAT(a.data_verif, '%d/%m/%Y') data_verif1,
                    DATE_FORMAT(a.data_autor, '%d/%m/%Y') data_autor1,
                    DATE_FORMAT(a.data_rev, '%d/%m/%Y') data_rev1, DATEDIFF(a.data_venc,CURDATE()) dias_avencer				
                  from tb_documentos a where id_documento > 0  and year(a.data_autor) > 0 and a.auto_por is not null " . 
				  $p3 . $p4 . $p5 . " order by a.tipo_doc ,a.id_documento desc, a.descr_docto ");				  
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
//		 $tipo_doc         = $row1['tipo_doc'];
//		 $setor_doc        = $row1['setor_doc'];
		 $elab_por         = $row1['elab_por'];
		 $verif_por        = $row1['verif_por'];
		 $auto_por         = $row1['auto_por'];
		 $revis_por        = $row1['revis_por'];
		 $versao_doc       = $row1['versao_doc'];
		 $nome_doc         = $row1['nome_doc'];
		 $num_paginas      = $row1['num_paginas'];
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
	<title>DOCTO00E4 - Consulta Laudos</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcdocs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
    if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="docto0001.php";
		  document.form1.submit();  
		  return true;
		  }
}

function sair_e(){
   	   	  document.form1.action="<?php echo($_SESSION['volta_menu']);?>";
		  document.form1.submit();  
		  return true;
}
function sair1(){
   	   	  document.form1.action="menu_exped.php";
		  document.form1.submit();  
		  return true;
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

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
  <tr>
      <th height="45" colspan="2" align="center"><h1>Consulta Laudos- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th></tr>
      <tr>
        <th colspan="3" align="center">
          <?php 
		  
		  if (isset($m)){ ?>
             <input type="button" onClick="javascript:self.close();" value="Sair">
		  <?php }else { 
		         if (isset($_SESSION['volta_menu'])){ ?>
		           <input type="button" onClick="sair_e();" value="Sair">
			  <?php }else {?>
		          <input type="button" onClick="sair1();" value="Sair">	  
          <?php }}?>

        </th>
        
        </tr>
            <tr bgcolor="#9D9DFF">
              <td height="15" colspan="3" align="center">Documentos Cadastrados</td>
            </tr>
                    </tr>
      <tr>
        <th colspan="3" align="left">        Descri&ccedil;&atilde;o 
        <label for="descrdcto2"></label>
        <input type="text" name="descrdcto2" id="descrdcto2" tabindex="40" size="40" maxlength="40" onChange="atualiza();"></th>        
      </tr>

            <tr align="center">
              <td colspan="3" align="center">
              <?php if ($descrdcto2 != "") { ?>
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th>Id</th>
                  <th >Descri&ccedil;&atilde;o</th>
                  <th >Tipo</th>
                  <th >Nome</th>
                  <th >Vers&atilde;o</th>
                  <th >Pertencente ao Setor</th>
                  <th >Num. Paginas</th>
                  <th >Emiss&atilde;o</th>
                  <th>Vencimento</th>
                  <th>Autoriza&ccedil;&atilde;o</th>
                  <th>Dias a Vencer</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	   $tipo_doc = 0;
	  while($row=mysql_fetch_array($rs2)){ 
	      if ($tipo_doc !=  $row['tipo_doc']){
		    echo("<tr><td colspan=10>&nbsp;</td></tr>");
			$mqtd = "S";

				}		
			  
	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   //echo('<tr ' . $bgc .'>');

 	   echo('<tr bgcolor="#DFDFFF">');
?>
        
                  <td >
         <?php if ($_SESSION['permi'] != '300' && $_SESSION['permi'] != '111' && $_SESSION['permi'] != '10' ) { ?>
           <a href="docto0001.php?id=<?php echo ($row['id_documento']);?>"><?php echo ($row['id_documento']);?></a>
           <?php }else { echo ($row['id_documento']); }?>
           
           
           </td>

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
               case	"17":				
                    echo("Termos");
					break;
			 case "18":
				    echo ("Documentos de Produ&ccedil;&atilde;o");
					break;

			   }		   
			   
			   ?>
           
           </td>
           <td  align="left"><a href="javascript:ver_foto2('<?php  echo($row['nome_doc']);?>','<?php  echo($row['setor_doc']);?>' )"> Ver - <?php  echo($row['nome_doc']);?></td>
           <td  align="center"><?php echo ($row['versao_doc']);?></td>
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
           <td align="center"><?php echo ($row['data_venc1']);?></td>
           <td align="center"><?php echo ($row['data_autor1']);?></td>
           <td align="center"><?php
		      if ($row['dias_avencer'] < 0){
		          echo ('<b><font color="#FF0000"> - Vencido a  </font></b>');
			  }			
			echo ($row['dias_avencer']);
			?>            
            </td>

              </tr>
          <?php 
		    $tipo_doc =  $row['tipo_doc'];

		   } 
	     }
		  ?>      
         </table><?php }?>
         
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
