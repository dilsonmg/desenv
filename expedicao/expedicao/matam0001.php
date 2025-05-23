<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if (isset($m_grupo)){
	if ($m_grupo <> "" ){
        if(!is_numeric($m_grupo)){
		     $p1 = " and a.descr_grpam like '%" . $m_grupo ."%'" ; }
		 else{
			 $p1 = " and a.id_grpamostra = '" . $m_grupo ."'" ; }
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
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $descr_grpam      = "";
		 $qtd_kits = "";
//$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
	  
 $rs2 = mysql_query("SELECT a.*
     FROM tb_grpamostra a
      where a.id_grpamostra > 0 " . $p1 ." 
	  order by a.descr_grpam ");				  
	  
$b = mysql_num_rows($rs2);
    	
		
$rs320 = mysql_query("select a.*  from tb_grpamostra a 
					  order by a.descr_grpam ");			
$ms = 0;
if (isset($id)){
    $habilita = 0;
	
	//echo("SELECT a.* FROM tb_grpamostra a where a.id_grpamostra =". $id);
	
    $rs1a = mysql_query("SELECT a.* FROM tb_grpamostra a where a.id_grpamostra = '". $id ."'");
	
	
	
if(mysql_num_rows($rs1a) == FALSE){
     $a=0;
}else{
      $a = 1;
} 
	
	$id_grpamostra  = $id;
		
   // $a = mysql_num_rows($rs1a);

    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1a);
        $habilit = "N";		 
		 $id_grpamostra = $id;
		 $descr_grpam   = $row33a['descr_grpam'];
		 $qtd_kits = $row33a['qtd_kits'];
		 
	//	 echo($qtd_kits);
	  }
	  
	  $ms = 1;
	  
	  
	   $rs200 = mysql_query("SELECT a.*,d.descr_prod,c.descr_grpam FROM tb_compgrp a
					inner join tb_grpamostra c on a.id_grpamostra = c.id_grpamostra
					left outer join tb_itemprocessado b on b.cod_prod = a.cod_prod
					inner join tb_produto d on d.cod_prod = a.cod_prod 
					where a.id_compgrp > 0 and a.id_grpamostra = '" . $id_grpamostra ."'   order by d.descr_prod");

	  
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
	<title>MATAM0001 - Grupos de Amostras</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>  

function click() {
	if (event.button==2||event.button==3) {
	oncontextmenu='return false';
	}
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")


if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
	
	   	  document.form1.action="matam0001.php?id=''";
		  document.form1.submit();  
		  return true;
	//	  }

}

function validatransp(){
       nm_grupo    = document.form1.nm_grupo.value;
	   uf           = document.form1.uf.options[document.form1.uf.selectedIndex].value;

       if (nm_grupo == ""){
		   alert("Informe o nome da Transportadora ");
		   return false;
	   }
	   if (uf == "") {
		  alert("Selecione a UF da transportadora ");  
		  return false; 
	   }
	   
	   	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "mattrg001.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}

	   
	   
}

function excluirtransp(){
    	 document.form1.action = "mattrg001.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	
}


function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head>
<body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 

<!--body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false' onkeydown="return false"--> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
      <th height="45" colspan="2" align="center"><h1>Gerar Kits de Amostras- 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th></tr>
      <tr>
        <th align="right">Kit</th>
        <th align="left">
        <input type="hidden" id = "descr_grpam"  name="descr_grpam"  autofocus="autofocus"  
        maxlength="80" size="80" placeholder="informe o nome"  value="<?php echo($descr_grpam); ?>" >
        
        <select name="id" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
          <option value="">Selecione o Grupo</option>
          <?php while($row320=mysql_fetch_assoc($rs320)){ ?>
          <option value="<?php print($row320['id_grpamostra'])?>"
				  <? if($row320['id_grpamostra'] == $id_grpamostra ) {?>selected <? } ?>				
				 ><?php print($row320['descr_grpam'])?></option>
          <?php }?>
        </select>
        </th>
      </tr>
      <tr>
        <th align="right">Quantidade de Kits</th>
        <th align="left"><input type="text" id = "qtd_kits"  name="qtd_kits"   
        maxlength="15" size="20" placeholder="informe a quantidade de Kits"  value="<?php echo($qtd_kits); ?>" ></th>
      </tr>
      <tr>
        <th colspan="2" align="center"><input type="button" name="gravar"  onClick="validagrpam();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onClick="ResetFormValues('matam0001.php');" >
          <!--input type="button" name="Submit4"  onClick="excluirgrpam(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" /-->
        <input type="button" onClick="sair();" value="Sair"></th>
      </tr>
      
      <?php if ( $ms > 0) { ?>
      <tr>
        <td colspan="3" align="center"> 
          <h2>Itens do Kit</h2>
          <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Grupo</th>
                  <th  >Itens do Kit</th>
                  <th >Quant.</th>
                  <th >Unidade</th>
            </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs200)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td ><?php echo ($row['descr_grpam']);?></td>
                <td ><?php echo ( $row['descr_prod']);?></td>
                <td align="center"><?php echo ($row['quant_it']);?></td>

           <td align="center"><?php echo ($row['unid_amostra']);?></td>
           </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>
         
              
         </td>
      </tr>
           
    </table>     
</th>
<?php } ?>
      </tr>
      <tr>
        <th colspan="3" align="center">&nbsp;</th>
    </tr>
          
            <tr >
              <th colspan="3" align="center">
                <p>Grupo
  <input type="text" name="m_grupo" id="m_grupo" maxlenght="50" size=50 /> 
                  </h1>
                  <input name="Pesquisar" type="submit" value="Pesquisar">
              </p>
              <p>Kits Cadastrados</p></th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="60%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Kits Amostra</th>
                  <th> Qtd. Disponivel </th>
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
           <a href="matam0001.php?id=<?php echo ($row['id_grpamostra']);?>"><?php echo ( $row['descr_grpam']);?></a></td>
           <td align="right"><?php echo ( $row['qtd_kits']);?></td> 
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
