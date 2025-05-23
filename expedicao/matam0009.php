<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
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
	     $id_itproc         = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $descr_analise    = "";
		 $limite_analise   = "";
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())

 $rs2 = mysql_query("SELECT a.*,b.descr_prod,  DATE_FORMAT(a.data_said, '%d/%m/%Y') data_said1
     FROM tb_saiditproc a
      inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  where a.id_saiditproc > 0 
	  order by  a.id_saiditproc desc,a.data_said desc ");				  
$b = mysql_num_rows($rs2);
$rs32 = mysql_query("select a.* from tb_produto a , tb_itemprocessado b where a.cod_prod = b.cod_prod order by a.descr_prod ");					  
 
$quant_it       = "";
$data_said       = "";
$obs_said        = "";
 
$lm = "";					
    	
$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* FROM tb_saiditproc a where a.id_saiditproc =". $id);
		    
	$a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilit = "N";		 
		 $id_saiditproc   = $id;
		 $cod_prod       = $row33a['cod_prod'];
		 $quant_it       = $row33a['quant_it'];
		 $data_said      = formata_data($row33a['data_said']);
         $obs_said       = $row33a['obs_said'];
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
	<title>MATAM009 - Saida de Itens de Processados</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th colspan="3" align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
      <th height="45" colspan="4" align="center"><h1>Saida de  Processados- 
        <?php
	echo($_SESSION['id_itproc']);
		  ?>
      </h1></th></tr>
      <tr>
        <th align="right">Produto</th>
        <th colspan="3" align="left"><select name="cod_prod" style="font-size:10" <?php if($habilita ==1) echo(" READONLY ");?> onChange="atualiza();">
            <option value="">Selecione o Produto</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
      </tr>
      <tr>
        <th align="right">Quantidadel</th>
        <th align="left"><input type="text" id = "quant_it"  name="quant_it"  maxlength="15" size="15" placeholder="informe a quantidade" 
         value="<?php echo($quant_it); ?>" ></th>
        <th align="left">Data</th>
        <th align="left"><input type="text" name="data_said" size="8" maxlength="10" value="<?php if ($data_said <> "" ){echo ($data_said); }?>" 
          title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_said);"
           onChange="verifica_data(this.value,data_said);" placeholder="informe a Data"/></th>
      </tr>
      <tr>
        <th align="right">Observacao</th>
        <th colspan="3" align="left"><input type="text" size="100" maxlength="200" name="obs_said" value ="<?php echo($obs_said); ?>"></th>
      </tr>
      <tr>
        <th align="right">&nbsp;</th>
        <th colspan="3" align="left">&nbsp;</th>
      </tr>
      <tr>
        <th colspan="5" align="center">
          <input type="button" name="gravar"  onClick="validasaiditproc();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="ResetFormValues('matam0009.php');" >
          <input type="button" name="Submit4"  onclick="excluirsaiditproc(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <td colspan="5" align="center" bgcolor="#A6A6FF">Saidas de Processados</td>
            </tr>
            <tr >
              <th colspan="5" align="center">
                Produto
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td  colspan="5" align="center">
              <table width="70%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th >Produto Processado</th>
                  <th >Dt. Saida</th>
                  <th >Quantidade (GR)</th>
                  <th >Obs</th>
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
           <a href="matam0009.php?id=<?php echo ($row['id_saiditproc']);?>"><?php echo ("Processado " . " - " . $row['descr_prod']);?></a></td>
                <td align="center"><?php echo ($row['data_said1']);?></td>

           <td align="center"><?php echo ($row['quant_it']);?> Gr</td>
           <td align="left"><?php echo ($row['obs_said']);?></td>
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
