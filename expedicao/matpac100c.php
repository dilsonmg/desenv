<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
/*
if (isset($cod_prod)){
	$m_primapesq = $cod_prod ;}
	
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
    }
}
*/


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
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $descr_analise    = "";
		 $limite_analise   = "";
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())




$rs32 = mysql_query("select a.* from tb_produto a order by a.descr_prod ");					  
 
$fab = "";
$venc = "";
 
$lm = "";					
    	
$habilia = 0;

if (isset($id)){
    $habilita = 1;	
	
    $rs1 = mysql_query("SELECT a.* FROM tb_limitprod a where a.id_limit ='". $id . "'");
	
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        //$habilit = "N";		 
		 $id_limit         = $id;
		 $cod_prod         = $row33a['cod_prod'];
		 $descr_analise    = $row33a['descr_analise'];
		 $limite_analise    = $row33a['limite_analise'];
		 

	  }
 }
 
 if (isset($cod_prod)){
	if ($cod_prod <> "" ){
			 $p1 = " and b.cod_prod = '" . $cod_prod ."'" ; 
    }
}


 $rs2 = mysql_query("SELECT a.*,b.descr_prod
     FROM tb_limitprod a
      inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  where a.id_limit > 0 
	  order by a.cod_prod, a.id_limit ");				  
$b = mysql_num_rows($rs2);

        $habilit = "S";		 
unset($id);
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
	<title>MATPAC100 - Itens de Analise</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.descr_analise.value = '';
		  document.form1.limite_analise.value = '';
   	   	  document.form1.action="matpac100c.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
           <th  align="center"><h1>Consulta Par&acirc;metros de An&aacute;lise- 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
      
<table width="95%" border="0">
      <tr>
        <th align="center"><input type="button" onClick="sair();" value="Sair" class="search-submit2" >
        </th>
        </tr>
            <tr >
              <th align="center"><h1>Itens Cadastrados</h1></th>
            </tr>
            <tr >
              <th align="center">
                Produto
                  <select name="cod_prod" style="font-size:10"  class="search-input5">
                    <option value="">Selecione o Produto</option>
                    <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
                    <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
                    <?php }?>
                  </select>
</h1>
              <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2" >
              </th>
            </tr>
            <tr align="center">
              <td align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto</th>
                  <th >Item de Analise</th>
                  <th>Limites</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
if ($cod_prod <> "" ){
 
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

             
                <td >
           <a href="matpac100c.php?id=<?php echo ($row['id_limit']);?>"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>

           <td align="left"><?php echo ($row['descr_analise']);?></td>
           <td align="left" ><?php echo($row['limite_analise']);?></td>
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
