<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<Meta http-equiv="refresh" content="120" />


<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$permi      = $_SESSION['permi'];
$idusuario	= $_SESSION['idusuario'];
$nome_usu   = $_SESSION['nome_usu'];
	 


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

$id = $_GET ["id"];
$m = $_GET["m"];
$habilit = "S";

$situa_aprov2;
$p41 = "";
if (isset($situa_aprov2)){
	if ($situa_aprov2 <> "" ){
		// $p4 = " and a.cod_matesc like '%" . $cod_matesc1 ."%'" ; 
		 $p41 = " and a.situa_aprov = '" . $situa_aprov2 ."'" ; 
	 }
}

					 
$rs33 = mysql_query("select a.* from tb_matesc a where trim(a.grupo_mat) = 'consumo'
                     and a.cod_matesc in (select a1.cod_matesc from tb_solmatesc a1  
					 where a1.cod_matesc > 0   and a1.id_setor = '" . $id_setor ."') 
                     order by a.descr_mat");	
					 			  	
$rs330 = mysql_query("select a.* from tb_matesc a where trim(a.grupo_mat) = 'consumo' order by a.descr_mat");				  	

$rs330a = mysql_query("select a.id_usuario, b.nome_usu from tb_solmatesc a
                       inner join tb_usuario b on a.id_usuario = b.id_usuario
					   group by a.id_usuario order by b.nome_usu  ");				  	

$rs3401 = mysql_query("select a1.* from tb_usuario a1 where a1.id_usuario = '". $idusuario . "' order by 					                       a1.nome_usu");	
$rowx = mysql_fetch_assoc($rs3401);

$id_setor = $rowx['id_setor'];

$rs340 = mysql_query("select a1.* from tb_setor a1 order by a1.descricao");	



$p4 = "";
if (isset($cod_matesc2)){
	if ($cod_matesc2 <> "" ){
		// $p4 = " and a.cod_matesc like '%" . $cod_matesc1 ."%'" ; 
		 $p4 = " and a.cod_matesc = '" . $cod_matesc2 ."'" ; 
		 }}
		 
$d3 = "";
$d4 = "";
$p31 = "";
$p32 = "";
$p51 = "";
$p51a = "";


if (isset($id_setor2)){
	if ($id_setor2 <> "" ){
		 $p51 = " and a.id_setor = '" . $id_setor2 ."'" ; 
		 }}

if (isset($id_usuario)){
	if ($id_usuario <> "" ){
		 $p51a = " and a.id_usuario = '" . $id_usuario ."'" ; 
		 }}

if (isset($data_3)){
	if ($data_3 <> "" ){
		 $p31 = " and a.data_sol >= '" . $data_3 ."'" ; 
		 }}

if (isset($data_4)){
	if ($data_4 <> "" ){
		 $p32 = " and a.data_sol <= '" . $data_4 ."'" ;
		 }}
		 

if ($permi == "222" || $permi == "999"){		 
					
			$rs2 = mysql_query("select a.*,b.nome_usu,c.sigla,c.descricao, 
								DATE_FORMAT(a.data_sol, '%d/%m/%Y') data_sol2,
								 DATE_FORMAT(a.data_aprov, '%d/%m/%Y') data_aprov2,
								d.descr_mat,e.sigla,e.descricao
								from tb_solmatesc a 	
								inner join tb_usuario b on b.id_usuario = a.id_usuario
								inner join tb_setor   c on c.id_setor = a.id_setor
								inner join tb_matesc  d on a.cod_matesc = d.cod_matesc
								inner join tb_setor   e on a.id_setor = e.id_setor
								where a.cod_matesc > 0  " . $p31 . $p32 . $p4 . $p41 . $p51 . $p51a . 
								//" and a.id_usuario = '" . $idusuario ."'".
								" order by a.data_sol desc, a.id_solmatesc desc");			
}
						  
    $b = mysql_num_rows($rs2);


$rs3a = mysql_query("select * from tb_setor a order by a.descricao ");


?>

<!DOCTYPE html>
<head>
<!--[if lt IE 9]>
<script src="//html5shim.googlecod.com/svn/trunk/html5.js">
</script>
<![endif]-->
	<title>REQO0001 - Cadastro de Requisição de Materiais</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcreq.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
  //  if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_matesc.value = "";
		  document.form1.unid_sol.value = "";		  
   	   	  document.form1.action="reqa001.php";
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


function analisar(ids)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
app = "reqan01.php?id="+ids;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
}


</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="id_setor" value="<?php echo($id_setor);?>" >

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"><?php echo($nome_usu);?></th>
        <th ><h1> Consulta Requisiç&otilde;es de Materiais  - 
          <?php
	echo($_SESSION['cod_matesc']);
		  ?>
        </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
           <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        <br> <?php echo($hoje);?>
        </th>
      </tr>
</table>      
<table width="99%" border="0"   class="search-form" >
      <tr>
        <th align="center">
          <?php 
		  
		  if (isset($m)){ ?>
             <input type="button" onClick="javascript:self.close();" value="Sair" class="search-submit2" >
		  <?php }else { ?>
		  <input type="button" onClick="sair();" value="Sair"  class="search-submit2" >
	  
          <?php }?>

        </th>
        
        </tr>
            <tr bgcolor="#9D9DFF">
              <td align="center">Registros Cadastrados</td>
            </tr>
                    <tr>
                    <td></tr>
      <tr>
        <th align="center">
        Período
          <input type="date" name="data_3" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_3);" class="search-input3"/>
a
<input type="date" name="data_4" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_4);" class="search-input3"/>
  Solicitante 
          <select name="id_usuario" onChange="atualiza();" class="search-input3">
            <option value="">Selecione o solicitante</option>
            <?php while($row33a=mysql_fetch_assoc($rs330a)){ ?>
            <option value="<?php print($row33a['id_usuario'])?>"
				  <? if($row33a['id_usuario'] == $id_usuario ) {?>selected <? } ?>				
				 ><?php print($row33a['nome_usu']);?></option>
            <?php }?>
            </select>
            
        Material 
          <select name="cod_matesc2" onChange="atualiza();" class="search-input3">
            <option value="">Selecione o Material</option>
            <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php print($row33['cod_matesc'])?>"
				  <? if($row33['cod_matesc'] == $cod_matesc2 ) {?>selected <? } ?>				
				 ><?php print($row33['descr_mat'] . "  - " . $row33['cod_matesc'] );?></option>
            <?php }?>
        </select> 
        <br>
          Situa&ccedil;&atilde;o 
          <select name="situa_aprov2"  onChange="atualiza();" class="search-input3" >
            <option value="" >Selecione o Motivo</option>
            <option value="1"<?php if($situa_aprov2 == 1 ) {?> selected <?php }?>>Em aberto </option>
            <option value="2"<?php if($situa_aprov2 == 2 ) {?> selected <?php }?>>Aprovado</option>
            <option value="3"<?php if($situa_aprov2 == 3 ) {?> selected <?php }?>>Reprovado </option>
            <option value="4"<?php if($situa_aprov2 == 4 ) {?> selected <?php }?>>Cancelado </option>



          </select>
          
          Setor 
          <select name="id_setor2" onChange="atualiza();" class="search-input3">
            <option value="">Selecione o setor</option>
            <?php while($row3a=mysql_fetch_assoc($rs3a)){ ?>
            <option value="<?php print($row3a['id_setor'])?>"
				  <? if($row3a['id_setor'] == $id_setor2 ) {?>selected <? } ?>				
				 ><?php print($row3a['sigla'] . "  - " . $row3a['descricao'] );?></option>
            <?php }?>
        </select> 
          <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2" >
        </th>
      </tr>

            <tr align="center">
              <td align="center">
              <table width="99%" border="1"  bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th>Id</th>
                  <th >Solicitante</th>
                  <th >Setor</th>
                  <th >Data</th>
                  <th >Material</th>
                  <th >Qtd. Solicitada</th>
                  <th >Unidade</th>
                  <th>Situa&ccedil;&atilde;o</th>
                  <th>Obs</th>
                  <th>Data Aprov.</th>
                  <th>Obs Aprovador</th>
                  <th>Qtd. Aprov.</th>
                  <th>Vlr. Unit</th>
                  <th>Total</th>
                  <th>Situa&ccedil;&atilde;o</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	   $totitens = 0;
	   $ttqtap = 0;
	   $ttvlrap = 0;
	   
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eeeeee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

                <tr>
                <td ><?php echo ($row['id_solmatesc']);?></td>
                <td ><?php echo ($row['id_usuario'] . " - " . $row['nome_usu']);?></td>
                <td ><?php echo ($row['sigla'] . " - " . $row['descricao']);?></td>
                <td ><?php echo ($row['data_sol2']);?></td>
                <td ><?php echo ($row['cod_matesc'] . " - " . $row['descr_mat']);?></td>
           <td align="right"   ><?php echo ($row['quant_sol']);
		   $totitens = $totitens + $row['quant_sol'];
		   ?></td>
           <td  align="center"><?php echo ($row['unid_sol']);?></td>
           <td align="center">
             <?php 
		   switch ($row['situa_aprov']) {
				case "1":
					echo ("<font color='blue'>Em Aberto</font>");
					break;
				case "2":
					echo ("<font color='green'>Aprovado</font>");
					break;
				case "3":
					echo ("<font color='red'>Reprovado</font>");
					break;
				case "4":
					echo ("<font color='black'>Cancelado</font>");
					break;

				}
		   
		   ?></td>
           <td align="left"><?php echo ($row['obs_motivo']);?></td>
           <td align="left"><?php echo ($row['data_aprov2']);?></td>
           <td align="left"><?php echo ($row['obs_aprov']);?></td>
           <td align="right"><?php echo ($row['quant_aprov']);
		                       $ttqtap = $ttqtap + $row['quant_aprov'];
		   ?></td>
           <td align="right"><?php echo (number_format($row['custo_med'],2,',','.'));?></td>
           <td align="right"><?php echo (number_format($row['custo_med']*$row['quant_aprov'],2,',','.'));
		       $ttvlrap = $ttvlrap + ($row['custo_med']*$row['quant_aprov']);
		   ?></td>
           <td align="center">Analisada
           <!--input type="button" onClick="analisar(<?php echo ($row['id_solmatesc']);?>);" value="Analisar"  class="search-submit2" -->
           </td>


          <?php 
		   } 
	     }
		  ?>
           </tr>
                <tr>
                  <td colspan="5" align="right" >Total de itens</td>
                  <td align="right"   ><?php echo (number_format($totitens,2,',','.'));?></td>
                  <td  align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                  <td align="right"><?php echo (number_format($ttqtap,2,',','.'));?></td>
                  <td align="left">&nbsp;</td>
                  <td align="right"><?php echo (number_format($ttvlrap,2,',','.'));?></td>
                  <td align="left">&nbsp;</td>
                </tr>
		       
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>