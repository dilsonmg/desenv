<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if (isset($m_transp)){
	if ($m_transp <> "" ){
        if(!is_numeric($m_transp)){
		     $p1 = " and a.nm_transp like '%" . $m_transp ."%'" ; }
		 else{
			 $p1 = " and a.id_transp = '" . $m_transp ."'" ; }
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
		 $descr_analise    = "";
		 $limite_analise   = "";
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
	  
 $rs2 = mysql_query("SELECT a.*
     FROM tb_transportadora a
      where a.id_transp > 0 " . $p1 ." 
	  order by a.nm_transp ");				  


	  
$b = mysql_num_rows($rs2);
$rs32 = mysql_query("select a.* from tb_uf a order by a.uf ");					  
    	
$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* FROM tb_transportadora a where a.id_transp =". $id);
		
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilit = "N";		 
		 $id_transp    = $id;
		 $nm_transp    = $row33a['nm_transp'];
		 $enderec      = $row33a['enderec'];
		 $bairro       = $row33a['bairro'];
		 $cidade       = $row33a['cidade'];
		 $uf           = $row33a['uf'];
		 $cep          = $row33a['cep'];
		 $telef        = $row33a['telef'];
		 $contato      = $row33a['contato'];
		 $email        = $row33a['email'];
		 $obs          = $row33a['obs'];


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
		  document.form1.nm_transp.value = '';
		  document.form1.enderec.value = '';
		  document.form1.bairro.value = '';
		  document.form1.cidade.value = '';
		  document.form1.uf.value = '';
		  document.form1.cep.value = '';
		  document.form1.telef.value = '';
		  document.form1.contato.value = '';
		  document.form1.email.value = '';
		  document.form1.obs.value = '';
	
	   	  document.form1.action="mattr0001.php?id=''";
		  document.form1.submit();  
		  return true;
	//	  }

}

function validatransp(){
       nm_transp    = document.form1.nm_transp.value;
	   uf           = document.form1.uf.options[document.form1.uf.selectedIndex].value;

       if (nm_transp == ""){
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
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" width="152" height="80"border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
        <th align="center">&nbsp;</th>
        <th align="center">&nbsp;</th>
      </tr>
      <tr>
      <th height="45" colspan="4" align="center"><h1>Transportadoras- 
        <?php
	echo($_SESSION['id_limit']);
		  ?>
      </h1></th></tr>
      <tr>
        <th align="right">Transportadora</th>
        <th align="left"><input type="text" id = "nm_transp"  name="nm_transp"  maxlength="80" size="80" placeholder="informe o nome"  value="<?php echo($nm_transp); ?>" ></th>
        <th align="left">&nbsp;</th>
        <th align="left">&nbsp;</th>
      </tr>
      <tr>
        <th align="right">Endere&ccedil;o</th>
        <th align="left"><input type="text" id = "enderec"  name="enderec"  maxlength="80" size="80" placeholder="informe o endereco"  value="<?php echo($enderec); ?>" ></th>
        <th align="left">Bairro</th>
        <th align="left"><input type="text" id = "bairro"  name="bairro"  maxlength="40" size="40" placeholder="informe o bairro"  value="<?php echo($bairro); ?>" ></th>
      </tr>
      <tr>
        <th align="right">cidade</th>
        <th align="left"><input type="text" id = "cidade"  name="cidade"  maxlength="80" size="80" placeholder="informe a cidade"  value="<?php echo($cidade); ?>" ></th>
        <th align="left">UF</th>
        <th align="left"><select name="uf" style="font-size:10" <?php //if($habilita ==1) echo(" disabled ");?> >
          <option value="">Selecione a UF</option>
          <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
          <option value="<?php print($row32['uf'])?>"
				  <? if($row32['uf'] == $uf ) {?>selected <? } ?>				
				 ><?php print($row32['uf'])?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">CEP</th>
        <th colspan="3" align="left"><input type="text" id = "cep"  name="cep"  maxlength="8" size="8" placeholder="informe o cep"  value="<?php echo($cep); ?>" > 
          Telefones
          <input type="text" id = "telef"  name="telef"  maxlength="100" size="100" placeholder="informe os telefones"  value="<?php echo($telef); ?>" ></th>
      </tr>
      <tr>
        <th align="right">Contato</th>
        <th align="left"><input type="text" id = "contato"  name="contato"  maxlength="60" size="60" placeholder="informe os contatos"  value="<?php echo($contato); ?>" ></th>
        <th align="left">Email</th>
        <th align="left"><input type="text" id = "email"  name="email"  maxlength="50" size="50" placeholder="informe a descricao"  value="<?php echo($email); ?>" ></th>
      </tr>
      <tr>
        <th align="right">Obs</th>
        <th colspan="3" align="left"><input type="text" id = "obs"  name="obs"  maxlength="100" size="100" placeholder="informe a descricao"  value="<?php echo($obs); ?>" ></th>
      </tr>
      <tr>
        <th colspan="5" align="center">
       
          <input type="button" name="gravar"  onClick="validatransp();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button"  name="button" id="button" value="Limpar Formulario" onclick="resetForm();" >
          <input type="button" name="Submit4"  onclick="excluirtransp(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="5" align="center"><h1>Itens Cadastrados</h1></th>
            </tr>
            <tr >
              <th colspan="5" align="center">
                Transportadora
                  <input type="text" name="m_transp" id="m_transp" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="5" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Transportadora</th>
                  <th >Cidade</th>
                  <th>UF</th>
                  <th>Contato</th>
                  <th>Email</th>
                  <th>Telefone</th>
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
           <a href="mattr0001.php?id=<?php echo ($row['id_transp']);?>"><?php echo ($row['id_transp'] . " - " . $row['nm_transp']);?></a></td>

           <td align="left" ><?php echo($row['cidade']);?></td>
           <td align="left" ><?php echo($row['uf']);?></td>
           <td align="left" ><?php echo($row['contato']);?></td>
           <td align="left" ><?php echo($row['email']);?></td>
           <td align="left" ><?php echo($row['telefone']);?></td>
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
