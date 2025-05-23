<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }

/*
update tb_consultor set situacao = "I"
  where id_consult not in (1,98,100,90,94,103,66,104,92,96,93,99,89,4,67,97);

*/
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
 //        $id_itemmanu      = "";	 
//		 $id_consult         = "";
		 $id_chkman        = "";
		 $data_serv        = "";	
		 $obs_chk	 	= "";  
$responsavel = "dilson magalhaes";


		if (!isset($id_consult2)){
		 		 $id_evento      = "";
		}


$id = $_GET ["id"];

$habilit = "S";

$rs330 = mysql_query("SELECT a.* FROM tb_consultor a
					 where situacao is null and id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome ");		

$rs340 = mysql_query("select a.* from tb_formprof a
					  where a.id_formprof > 0 order by a.descr_formprof");	

$p4 = "";
$p44 = "";
$p45 = "";

//echo($id_itemmanu22);

if (isset($id_consult2)){
	if ($id_consult2 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p4 = " and a.id_consult = '" . $id_consult2 ."'" ; 
		 }}


if (isset($id_formprof22)){
	if ($id_formprof22 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p45 = " and a.id_formprof = '" . $id_formprof22 ."'" ; 
		 }}


$rs2 = mysql_query("select a.*,b.nome,c.descr_formprof
					  from tb_funcform  a
					  inner join tb_consultor b on b.id_consult = a.id_consult
					  inner join tb_formprof c on c.id_formprof = a.id_formprof
					  where a.id_funcform > 0 ". $p4 . $p45 ."
			          order by b.nome");

    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("SELECT a.* FROM tb_consultor a
					 where situacao is null and id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome");		

						  	
$rs34 = mysql_query("select a.* from tb_formprof a order by a.descr_formprof ");	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_funcform a where a.id_funcform ='". $id."'");

    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
//         $habilit = "N";
     	 $row1 = mysql_fetch_assoc($rs1);

         $id_consult      = $row1['id_consult'];	 
		 
		 $id_formprof        = $row1['id_formprof'];
		 
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
	<title>Consult004 - Consultour / Formação</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcconsult.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
		//	window.opener.location.reload();
	}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_consult.value ='';
		  document.form1.id_formprof.value = '';
   	   	  document.form1.action="consult0004.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function atualiza(){
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


<table width="95%" border="0">
      <tr>
        <th align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th >
        <h1>Consultor / Forma&ccedil;&atilde;o - 
        <?php
	// echo($_SESSION['id_consult']);
		  ?>
      </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br><?php echo($hoje);?></th>
      </tr>
</table>
<table width="95%" border="0">
      
      <tr>
      <th  colspan="2" align="center"></th></tr>
      <tr>
        <th align="right">Consultor</th>
        <th align="left" ><select name="id_consult" onChange="atualiza();" class="search-input5">
          <option value="">Selecione o consultor</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult ) {?>selected <? } ?>				
				 ><?php echo($row33['nome'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th  align="right">Forma&ccedil;&atilde;o</th>
        <th align="left" ><select name="id_formprof"  class="search-input3">
          <option value="">Selecione</option>
          <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php echo($row33['id_formprof']);?>"
				  <? if($row33['id_formprof'] == $id_formprof ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_formprof'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th colspan="2" align="center">
        <?php if ($btn == 's'){ ?>

          <input type="button" name="gravar"  onClick="validaconform();" value="Gravar" class="search-submit2"  />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluirconform(<?php echo($id); ?>);" value="Excluir" class="search-submit2" />
       <?php } ?>
          <input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th colspan="2" align="center">Registros Cadastrados</th>
      </tr>
      <tr>
        <th colspan="2" align="left">Consultor 
          <select name="id_consult2"  onChange="atualiza();"  class="search-input5">
            <option value="">Selecione o consultor</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult2 ) {?>selected <? } ?>				
				 ><?php echo($row33['nome']  );?></option>
            <?php }?>
        </select>
          Forma&ccedil;&atilde;o
          <select name="id_formprof22" onChange="atualiza();" class="search-input3">
             <option value="">Selecione</option>
             
             <?php while($row333=mysql_fetch_assoc($rs340)){ ?>
             <option value="<?php echo($row333['id_formprof']);?>"
				  <? if($row333['id_formprof'] == $id_formprof22 ) {?>selected <? } ?>		
       				 ><?php echo($row333['descr_formprof'] . " - Periodicidade -  " . $row333['periodic'] ." dias ");?></option>
		             <?php }?>
        </select></th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td colspan="2" align="center">
              <table width="80%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >Funcionário</th>
                  <th >Forma&ccedil;&atilde;o</th>
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

           <td  align="left">
           <a href="consult0004.php?id=<?php echo ($row['id_funcform']);?>"><?php echo ($row['id_funcform']);?></a></td>
           <td align="left"><?php echo ($row['nome']);?></td>
           <td align="left"><?php echo ($row['descr_formprof']);?></td>
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
