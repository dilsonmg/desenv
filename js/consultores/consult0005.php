<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }


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

$rs340 = mysql_query("select a.* from tb_itcontr a
					  where a.id_itcontr > 0 order by a.descr_itcontr");	

$p4 = "";
$p44 = "";
$p45 = "";

//echo($id_itemmanu22);

if (isset($id_consult2)){
	if ($id_consult2 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p4 = " and a.id_consult = '" . $id_consult2 ."'" ; 
		 }}


if (isset($id_itcontr22)){
	if ($id_itcontr22 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p45 = " and a.id_itcontr = '" . $id_itcontr22 ."'" ; 
		 }}


$rs2 = mysql_query("select a.*,b.nome,c.descr_itcontr
					  from tb_pericontr  a
					  inner join tb_consultor b on b.id_consult = a.id_consult
					  inner join tb_itcontr c on c.id_itcontr = a.id_itcontr
					  where a.id_consult > 0 ". $p4 . $p45 ."
			          order by b.nome");

    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and a.id_consult != '1'
					order by a.nome");		

						  	
$rs34 = mysql_query("select a.* from tb_itcontr a order by a.descr_itcontr ");	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_pericontr a where a.id_pericontr ='". $id."'");


    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
//         $habilit = "N";
     	 $row1 = mysql_fetch_assoc($rs1);

         $id_consult      = $row1['id_consult'];	 
		 
		 $id_itcontr       = $row1['id_itcontr'];
		 $periodicid       = $row1['periodicid'];
		 
		 
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
	<title>consult0005 - Periodicidade - Controle de Documentos</title>
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
		  document.form1.id_itcontr.value = '';
  		  document.form1.periodicid.value = '';
   	   	  document.form1.action="consult0005.php";
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
        <h1>Periodicidade de Controle de Documentos- 
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
          <option value="">Selecione o Consultor</option>
          <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
          <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult ) {?>selected <? } ?>				
				 ><?php echo($row33['nome'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th  align="right">Documento</th>
        <th align="left" ><select name="id_itcontr"  onChange="atualiza();" class="search-input6">
          <option value="">Selecione</option>
          <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php echo($row33['id_itcontr']);?>"
				  <? if($row33['id_itcontr'] == $id_itcontr ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_itcontr'] );?></option>
          <?php }?>
        </select></th>
      </tr>
      <tr>
        <th  align="right">Periodicidade</th>
        <th align="left" ><input type text name="periodicid" value="<?php echo($periodicid);?>" size="20" maxlength="10" class="search-input3"> 
        mes(es)</th>
      </tr>
      <tr>
        <th colspan="2" align="center">
        <?php if ($btn == 's'){ ?>

          <input type="button" name="gravar"  onClick="valida_pericontr();" value="Gravar" class="search-submit2"  />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluir_pericontr(<?php echo($id); ?>);" value="Excluir" class="search-submit2" />
       <?php } ?>
          <input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th colspan="2" align="center">Registros Cadastrados</th>
      </tr>
      <tr>
        <th colspan="2" align="left">Consultor<select name="id_consult2"  onChange="atualiza();"  class="search-input5">
            <option value="">Selecione o Consultor</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult2 ) {?>selected <? } ?>				
				 ><?php echo($row33['nome']  );?></option>
            <?php }?>
        </select>
          Exame/Treinamento
          <select name="id_itcontr22" onChange="atualiza();" class="search-input3">
             <option value="">Selecione o Item</option>
             
             <?php while($row333=mysql_fetch_assoc($rs340)){ ?>
             <option value="<?php echo($row333['id_itcontr']);?>"
				  <? if($row333['id_itcontr'] == $id_itcontr22 ) {?>selected <? } ?>		
       				 ><?php echo($row333['descr_itcontr'] );?></option>
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
                  <th >Consultor</th>
                  <th >Item</th>
                  <th >Periodicidade</th>
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
           <a href="consult0005.php?id=<?php echo ($row['id_pericontr']);?>"><?php echo ($row['id_pericontr']);?></a></td>
           <td align="left"><?php echo ($row['nome']);?></td>
           <td align="left"><?php echo ($row['descr_itcontr']);?></td>
           <td align="left"><?php echo ($row['periodicid']);?> mes(es)</td>
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
