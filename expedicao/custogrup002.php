<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }

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

$responsavel = "dilson magalhaes";
$descr_grupocc =  '';

$id = $_GET ["id"];

$habilit = "S";
$p4 = "";
if (isset($id_grupocusto2)){
	if ($id_grupocusto2 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_grupocusto = '" . $id_grupocusto2 ."'" ; 
		 }}
		 

  	 
$rs2 = mysql_query("select a.*, b.descr_grupocc, c.descr_centcustind
             from tb_vinccusto a
			 inner join tb_grupoccusto b on a.id_grupocusto = b.id_grupocusto
			 inner join tb_centcustoind c on a.id_centcustoind = c.id_centcustoind
             where a.id_grupocusto > 0 " . $p4 . "
  order by a.id_grupocusto desc,c.descr_centcustind");				  
    $b = mysql_num_rows($rs2);
					  
		  	
$rs34 = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	
$rs34a = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_vinccusto a where a.id_vinccusto = '". $id . "'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         //$rs1 = mysql_query("SELECT a.* FROM tb_grupoccusto a where a.id_grupocusto =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);
		 //$id_grupocusto        = $id;
		 $id_grupocusto        = $row1['id_grupocusto'];
 	     //$descr_grupocc        = $row1['descr_grupocc'];  
		 $id_centcustoind      = $row1['id_centcustoind'];
		 
	  }
	 
 }
 
 
 
 
 $rs33 = mysql_query("select a.* from tb_centcustoind a order by a.descr_centcustind");	


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
	<title>custogrup002 - Cadastro de linhas de Custos</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
	<script type='text/javascript' src="../js/funcgrc.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
 //   if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_grupocusto.value="";
		  document.form1.id_centcustoind.value="";
   	   	  document.form1.action="custogrup002.php";
		  document.form1.submit();  
		  return true;
		//  }

}

function atualiza(){
   resetForm();
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


<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>Vinculac&atilde;o de Linhas de Custos Indiretos- 
    
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
  </table>
 <table width="98%" border="0">
 
          <th align="left">Linha  de Custo</th>
        <th align="left"><select name="id_grupocusto"   class="search-input3">
          <option value="">Selecione o Grupo</option>
          <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php echo($row33['id_grupocusto']);?>"
				  <? if($row33['id_grupocusto'] == $id_grupocusto ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_grupocc']);?></option>
          <?php }?>
        </select>        </th>
      </tr>    <tr>
            <th align="left">Item de Custo</th>
            <th align="left"><select name="id_centcustoind" class="search-input2" <?php if($habilita ==1) echo(" disabled ");?> >
              <option value="">Selecione o Custo</option>
              <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
              <option value="<?php echo($row33['id_centcustoind'])?>"
				  <? if($row33['id_centcustoind'] == $id_centcustoind ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_centcustind'] . " - " . $row33['id_centcustoind'] )?></option>
              <?php }?>
            </select></th>
          </tr>    
          <tr>
            <th align="left">&nbsp;</th>
            <th align="left">&nbsp;</th>
          </tr>
      <tr>
        <th align="center" colspan="2">
        <?php if ($btn == 's'){ ?>

          <input type="button" name="gravar"  onClick="validagrcc2();" value="Gravar" class="search-submit2" />
          <input type="reset" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluirgrcc20(<?php echo($id); ?>);" value="Excluir"  class="search-submit2"/>
       <?php } ?>
         <input type="button" onClick="sair1();" value="Sair" class="search-submit2">
        </th>
        </tr>
        
              <tr bgcolor="#9D9DFF">
        <th align="center" colspan="2"><font color="#000000">LInhas  de Custos Cadastrados</font></th>
      </tr>
      <tr>
        <th  align="left" colspan="2">Selecione o LInha de Custo
          <select name="id_grupocusto2"  onChange="atualiza();"  class="search-input3">
            <option value="">Selecione o Grupo</option>
            <?php while($row33=mysql_fetch_assoc($rs34a)){ ?>
            <option value="<?php echo($row33['id_grupocusto']);?>"
				  <? if($row33['id_grupocusto'] == $id_grupocusto2 ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_grupocc']);?></option>
            <?php }?>
        </select></th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td align="center"  colspan="2">
              <table width="80%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >LInha de Custo</th>
                  <th >Item de Custo</th>
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
              
       <td >
           <a href="custogrup002.php?id=<?php echo ($row['id_vinccusto']);?>"><?php echo ($row['id_grupocusto']);?></a></td>
                <td ><?php echo ($row['descr_grupocc']);?></td>
                <td ><?php echo ($row['id_centcustoind'] . " - " .$row['descr_centcustind']);?></td>

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
