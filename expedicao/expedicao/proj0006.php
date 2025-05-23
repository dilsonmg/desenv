<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p2 = "";
if (isset($m_desp)){
	if ($m_desp <> "" ){
        if(!is_numeric($m_desp)){
		     $p1 = " and a.descr_ambiente like '%" . $m_desp ."%'" ; }
		 else{
			 $p1 = " and a.id_ambiente = '" . $m_desp ."'" ; }
    }
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
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
	  
 $rs2 = mysql_query("SELECT a.*
     FROM tb_ambiente a
      where a.id_ambiente > 0 " . $p1 ." 
	  order by a.id_ambiente desc ");				  


$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* FROM tb_ambiente a where a.id_ambiente = '". $id ."'");
			
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilit = "N";		 
		 $id_ambiente    = $id;
		 $descr_ambiente       = $row33a['descr_ambiente'];

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
	<title>Proj0006 - Cadastro Ambientes de Estudo</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcprojs.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function resetForm(){
  //  if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.descr_ambiente.value = "";
   	   	  document.form1.action="proj0006.php";
		  document.form1.submit();  
		  return true;
	//	  }
}
</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="89%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>P &amp; D - Cadastro de Ambientes de Estudo- 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th> 
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="89%" border="0">
      
      <tr>
</tr>
      <tr>
        <th align="right">Ambiente</th>
        <th align="left"><input type="text" id = "descr_ambiente"  name="descr_ambiente"  maxlength="80" size="80" placeholder="informe a descricao"  
        value="<?php echo($descr_ambiente); ?>" class="search-input" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center">
       
          <input type="button" name="gravar"  onClick="validaambiente();" value="Gravar" class="search-submit2" />
          <input type="button"  name="button" id="button" value="Limpar Formulario" onclick="resetForm();"  class="search-submit2"/>
          <input type="button" name="Submit4"  onclick="excluirambiente(<?php echo($id); ?>);" value="Excluir"  class="search-submit2"/>
          <input type="button" onClick="sair();" value="Sair"  class="search-submit2"/>
        </th>
        </tr>
            <tr bgcolor="#9D9DFF">
              <th colspan="3" align="center">Itens Cadastrados</th>
            </tr>
            <tr >
              <th colspan="3" align="center">Ambiente
                <input type="text" name="m_desp" id="m_desp" maxlenght="50" size=50   class="search-input5"  /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <br>
              <table width="60%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th  >Codigo</th>
                  <th >Descricao</th>
                  
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	 }
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#e0e0e0";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              
                <td >
           <a href="proj0006.php?id=<?php echo ($row['id_ambiente']);?>"><?php echo ($row['id_ambiente']);?></a></td>
           <td align="left" ><?php echo($row['descr_ambiente']);?></td>

              </tr>
          <?php 
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
