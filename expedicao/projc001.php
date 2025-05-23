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

	     $descr_projeto    = '';
	     $solicitante      = '';
		 $data_abertura    = '';
	 
//		 $id_eqpto         = '';
		 $doc_abertura     = '';
		 $data_prevtermino = '';
		 $data_fechamento  = '';
		 $doc_fecha        = '';
		 $obs_projeto      = '';
		 
$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$p4 = "";
if (isset($id_projeto) && $id_projeto != ""){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_projeto = '" . $id_projeto ."'" ; 
		 }

if (isset($situacao) && $situacao != ""){
		 $p4a = " and a.situacao = '" . $situacao ."'" ; 
		 }


				  
$rs2 = mysql_query("select a.* ,
                    DATE_FORMAT(a.data_abertura, '%d/%m/%Y') data_abertura1,
                    DATE_FORMAT(a.data_prevtermino, '%d/%m/%Y') data_prevtermino1,
                    DATE_FORMAT(a.data_fechamento, '%d/%m/%Y') data_fechamento1,
					DATEDIFF(CURDATE(),a.data_abertura) dias_em_aberto,
					DATEDIFF(a.data_abertura,a.data_fechamento) dias_conclusao
                  from tb_projeto a where a.descr_projeto != '' " . $p4 . $p4a . " order by a.id_projeto desc");				  
$b = mysql_num_rows($rs2);
$rs33 = mysql_query("select a.* from tb_projeto a order by a.id_projeto");				  	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_projeto a 
	    where a.id_projeto = '". $id ."'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
		 
		 $data_abertura     = "00/00/0000";
		 $data_prevtermino  = "00/00/0000";
         $data_fechamento   = "00/00/0000";
  
    	 $row1 = mysql_fetch_assoc($rs1);
  
         if($data_abertura != ""){
	         $data_abertura      = strftime("%d/%m/%Y", strtotime($row1['data_abertura']));
		 }
		 if(strftime("%Y", strtotime($row1['data_abertura'])) != "1969"){
	        $data_abertura      = strftime("%d/%m/%Y", strtotime($row1['data_abertura']));
		 }
		 
		 if(strftime("%Y", strtotime($row1['data_prevtermino'])) != "1969"){
		   $data_prevtermino      = strftime("%d/%m/%Y", strtotime($row1['data_prevtermino']));
		 }
		 if(strftime("%Y", strtotime($row1['data_prevtermino'])) != "1969"){
		    $data_prevtermino     = strftime("%d/%m/%Y", strtotime($row1['data_prevtermino']));
		 }
		 
		 if(strftime("%Y", strtotime($row1['data_fechamento'])) != "1969"){
		    $data_fechamento     = strftime("%d/%m/%Y", strtotime($row1['data_fechamento']));
		 }
		 if(strftime("%Y", strtotime($row1['data_fechamento'])) != "1969"){
    		$data_fechamento        = strftime("%d/%m/%Y", strtotime($row1['data_fechamento']));
		 }
		 
		 $descr_projeto    = $row1['descr_projeto'];
		 $solicitante      = $row1['solicitante'];
		 $doc_abertura     = $row1['doc_abertura'];
		 
		 $doc_fecha        = $row1['doc_fecha'];
		 $obs_projeto      = $row1['obs_projeto'];
		 
		 
	  } 
 }
// $id_projeto      = '';

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
	<title>PROJ0001 - Cadastro de Projetos</title>
<link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcprojs.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
  //  if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="proj0001.php";
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
<input type=hidden name="doc_abertura1"  id="doc_abertura1" value="<?php echo("$doc_abertura");?>">
<input type=hidden name="doc_fecha"  id="doc_fecha" value="<?php echo("$doc_fecha");?>">

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>P &amp; D - Consulta Cadastro de Projetos- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <br> <?php echo($hoje); ?>
        </th>
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
           <th align="left">
              Situa&ccedil;&atilde;o :
      <select name="situacao" onChange="document.form1.submit();" class="search-input5">
        <option value="" >Selecione </option>
        <option value="1" <? if($situacao == 1) {?>selected <? } ?>>Aprovado</option>
        <option value="2" <? if($situacao == 2) {?>selected <? } ?>>Aprovado com Observação</option>
        <option value="3" <? if($situacao == 3) {?>selected <? } ?>>Reprovado</option>
        <option value="4" <? if($situacao == 4) {?>selected <? } ?>>Reprovado com Observação</option>
        <option value="5" <? if($situacao == 5) {?>selected <? } ?>>Resultado Inconclusivo</option>
      </select>
          </th>
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
        
        </tr>
            <tr bgcolor="#9D9DFF">
              <td height="15" colspan="3" align="center">Projetos Cadastrados</td>
            </tr>
                    </tr>

            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th width="4%">Id</th>
                  <th width="7%" >Projeto</th>
                  <th width="8%" >Solicitante</th>
                  <th width="4%" >Abertura</th>
                  <th width="13%" >Doc. Abertura</th>
                  <th width="6%" >Prev.Termino</th>
                  <th width="4%" >Termino</th>
                  <th width="8%" >Dias Conclus&atilde;o</th>
                  <th width="18%" >Doc. Fechamento</th>
                  <th width="10%" >Situa&ccedil;&atilde;o</th>
                  <th width="68%" >Obs</th>
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
           <a href="projc001.php?id=<?php echo ($row['id_projeto']);?>"><?php echo ($row['id_projeto']);?></a></td>

           <td ><?php echo ($row['descr_projeto']);?></td>
           <td  align="left"><?php echo ($row['solicitante']);?></td>
           <td  align="left"><?php echo ($row['data_abertura1']);?></td>
           <td  align="center">
		   <a href="javascript:ver_foto('<?php  echo($row['doc_abertura']);?>')"> <?php  echo($row['doc_abertura']);?></a>
           </td>
           <td  align="center"><?php echo ($row['data_prevtermino1']);?></td>
           <td  align="center"><?php echo ($row['data_fechamento1']);?></td>
           <td  align="center">
           <?php if ($row['data_fechamento1'] == '00/00/0000' ) {
			        echo($row['dias_em_aberto'] . " dias em aberto");			   
		   }
		   else{
			        echo("Concluido em " .$row['dias_conclusao'] * -1 . " dias");			   
			   
		   }
		   ?>
           
           </td>
           <td  align="center"><a href="javascript:ver_foto('<?php  echo($row['doc_fecha']);?>')"> <?php  echo($row['doc_fecha']);?></a></td>
           <td  align="left"><?php 
		$situa = $row['situacao'];
		//echo $situa;
		switch ($situa) {
				case "1":
					echo ("<img src=../imagens/bola_verde.png> - Aprovado");
					break;
				case "2":
					echo ("<img src=../imagens/bola_azul.png> - Aprovado com Obs");
					break;
				case "3":
					echo ("<img src=../imagens/bola_vermelha.png> - Reprovado");
					break;
				case "4":
					echo ("<img src=../imagens/bola_laranja.png> - Reprovado com Obs");
					break;
				case "5":
					echo ("<img src=../imagens/bola_amarela.png> - Resultado Inconclusivo");
					break;

		}
		
		?></td>
           <td  align="center"><?php echo ($row['obs_projeto']);?></td>
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
