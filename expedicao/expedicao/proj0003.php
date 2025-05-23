<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p11 = "";
$p2 = "";
if (isset($m_desp)){
	if ($m_desp <> "" ){
        if(!is_numeric($m_desp)){
		     $p1 = " or a.descri_estudo like '%" . $m_desp ."%'" ; 
	         $p11 = " and c.desc_paramestd like '%". $m_desp ."%'";}
		 else{
			 $p2 = " and a.id_estdparam = '" . $m_desp ."'" ; }
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


$habilita = 0;
		 $id_paramestd  = '';
		// $id_veiculo     = '';
		 $descri_estudo   = '';
 	     $data_estudo     = '';

//DATEDIFF(t.data_conserto,CURDATE())
	  

$rs33 = mysql_query("select a.* from tb_projeto a order by a.id_projeto");				  	
$rs34 = mysql_query("select a.* from tb_paramestd a order by a.desc_paramestd");				  	
$obs_projeto = '';
if (isset($id) ){
   
    $rs1 = mysql_query("SELECT a.*,b.*,c.* FROM tb_estdparam a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd 
      where a.id_estdparam = '". $id . "' order by a.id_estdparam");
			
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilita = 1;		 
		 $id_estdparam   = $id;
		 $id_projeto     = $row33a['id_projeto'];
		 $id_paramestd   = $row33a['id_paramestd'];
		 $descri_estudo  = $row33a['descri_estudo'];
 	     $data_estudo    = strftime("%d/%m/%Y", strtotime($row33a['data_estudo']));   
		 $obs_projeto    =  $row33a['obs_projeto'];

	  }else{
		  //$id_veiculo = '';
	  }
 }
////////////


 $rs2 = mysql_query("SELECT a.*,b.descr_projeto,c.desc_paramestd,
     DATE_FORMAT(a.data_estudo, '%d/%m/%Y') data_estudof
     FROM tb_estdparam a
	 inner join tb_projeto b on b.id_projeto = a.id_projeto
	 inner join tb_paramestd c on c.id_paramestd = a.id_paramestd  " . $p11 ."
     where a.id_estdparam > 0 " .$p1 .$p2 .
	 " order by a.id_estdparam desc ");				  
	 	 
 
 // echo($habilita);

////////////////
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
	<title>Proj0003 - Análise de Parâmetros</title>
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
		  document.form1.lote.value = "";
		  document.form1.id_projeto.value = "";

   	   	  document.form1.action="proj0003.php";
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

<table width="99%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>P &amp; D - Analise de Par&acirc;metros  
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      </table>
<table width="99%" border="0">
      <tr>
        <th align="right">Projeto</th>
        <th align="left"><select name="id_projeto" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="document.form1.submit();" class="search-input5" >
          <option value="">Selecione o Projeto</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php print($row33['id_projeto'])?>"
				  <? if($row33['id_projeto'] == $id_projeto ) {?>selected <? 
				  		 $obs_projeto    =  $row33['obs_projeto'];
						 $lote = $row33['lote'];

				  
				  } ?>	
                  			
				 ><?php print($row33['id_projeto'] . " - " . $row33['descr_projeto'] );?></option>
          <?php }?>
        </select></th>
                <th align="right">Lote
        <input type="text" id = "lote"  name="lote"  maxlength="40" size="45" placeholder="informe o lote"  
        value="<?php echo($lote); ?>" class="search-input5" ></th>

      </tr>
      <tr>
        <th align="right">&nbsp;</th>
        <th colspan="2" align="left"><font size="3"><?php echo($obs_projeto);?></font></th>
      </tr>
      <tr>
        <th align="right">Par&acirc;metro de Estudo</th>
        <th colspan="2" align="left"><select name="id_paramestd" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> class="search-input5" >
          <option value="">Selecione Item </option>
          <?php while($row34=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php print($row34['id_paramestd'])?>"
				  <? if($row34['id_paramestd'] == $id_paramestd ) {?>selected <? } ?>				
				 ><?php print($row34['desc_paramestd']);?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Data</th>
        <th colspan="2" align="left"><input type="text" name="data_estudo" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" 
        value="<?php echo $data_estudo ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" 
        onBlur="verifica_data(this.value,data_estudo);" onChange="verifica_data(this.value,data_estudo);" class="search-input5" /></th>
      </tr>
      <tr>
        <th align="right">Resultados</th>
        <th colspan="2" align="left"><input type="text" id = "descri_estudo"  name="descri_estudo"  maxlength="200" size="150" placeholder="informe Observacao"  
        value="<?php echo($descri_estudo); ?>" class="search-input5" ></th>
      </tr>
      <tr>
        <th colspan="4" align="center">
       
          <input type="button" name="gravar"   onClick="validaparamestd();" value="Gravar"   class="search-submit2" />
          <input type="button" name="button" id="button" value="Novo" onclick="resetForm();"   class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluirparamestd(<?php echo($id); ?>);" value="Excluir"   class="search-submit2" />
          <input type="button" onClick="sair();" value="Sair"   class="search-submit2">
        </th>
        </tr>
            <tr bgcolor="#9D9DFF">
              <th colspan="4" align="center">Itens Cadastrados</th>
            </tr>
            <tr >
              <th colspan="4" align="center">Par&acirc;metro
                <input type="text" name="m_desp" id="m_desp" maxlenght="50" size=50   class="search-input5"/> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="4" align="center">
              <br>
              <table width="99%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >Projeto</th>
                  <th >Par&acirc;metro</th>
                  <th >Data</th>
                  <th >Resultados</th>
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

           <td align="center" >
           <a href="proj0003.php?id=<?php echo ($row['id_estdparam']);?>"><?php echo ($row['id_estdparam']);?></a></td>
           <td align="left" ><?php echo($row['descr_projeto']);?></td>
           <td align="left" ><?php echo($row['desc_paramestd']);?></td>
           <td align="center" ><?php echo($row['data_estudof']);?></td>
           <td align="left" ><?php echo($row['descri_estudo']);?></td>
           </tr>
          <?php 
		   } 
		  ?>      
         </table>
              <br>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
