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
 //        $id_itemmanu      = "";	 
//		 $id_eqpto         = "";
		 $id_chkman        = "";
		 $data_serv        = "";		 		  
$responsavel = "dilson magalhaes";


		if (!isset($id_eqpto2)){
		 		 $id_evento      = "";
		}


$id = $_GET ["id"];

$habilit = "S";

$rs330 = mysql_query("select a.*,b.id_eqpto from tb_equipamento a 
                     inner join tb_plmanut b on a.id_eqpto = b.id_eqpto
					 group by b.id_eqpto order by a.descr_eqpto");		


$rs340 = mysql_query("select a.*,b.descr_evento from tb_plmanut a 
                      inner join tb_evento b on b.id_evento = a.id_evento
                      where a.id_eqpto = '" .$id_eqpto2 . "' order by b.descr_evento ");	



$p4 = "";
$p44 = "";
$p45 = "";

//echo($id_itemmanu22);

if (isset($id_eqpto2)){
	if ($id_eqpto2 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and d.id_eqpto = '" . $id_eqpto2 ."'" ; 
		 }}


if (isset($id_plmanut22)){
	if ($id_plmanut22 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p45 = " and a.id_plmanut = '" . $id_plmanut22 ."'" ; 
		 }}
$p5 = "";
$p51 = "";


if (isset($data_1)){
	if ($data_1 <> "" ){
    	 $p5 = " and a.data_serv >= '" . $data_1 ."'" ; 	
		 }
}

if (isset($data_2)){
	if ($data_2 <> "" ){
    	 $p51 = " and a.data_serv <= '" . $data_2 ."'" ; 	
		 }
}

$rs2 = mysql_query("select a.*,DATE_FORMAT(a.data_serv, '%d/%m/%Y') data_serv2
					  ,b.descr_evento,c.descr_eqpto,d.periodic,c.tag_eqpto
					  from tb_acompljm  a
					  inner join tb_plmanut d on d.id_plmanut = a.id_plmanut
					  inner join tb_evento b on b.id_evento = d.id_evento
				      inner join tb_equipamento c on c.id_eqpto = a.id_eqpto
					  where a.id_acompljm > 0 ". $p4 . $p44 . $p45 .$p5 .$p51 ."
			          order by a.data_serv desc,c.descr_eqpto,b.descr_evento");

    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("select a.*,b.id_eqpto from tb_equipamento a 
                     inner join tb_plmanut b on a.id_eqpto = b.id_eqpto
					 group by b.id_eqpto order by a.descr_eqpto");		

						  	
$rs34 = mysql_query("select a.*, b.descr_evento from tb_plmanut a   
                    inner join tb_evento b on b.id_evento = a.id_evento 
					where a.id_eqpto = " .$id_eqpto .
					" order by b.descr_evento ");	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_acompljm a where a.id_acompljm ='". $id."'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         $rs1 = mysql_query("SELECT a.*,DATE_FORMAT(a.data_serv, '%d/%m/%Y') data_serv1 FROM tb_acompljm a where a.id_acompljm = '". $id ."'");
    	 $row1 = mysql_fetch_assoc($rs1);


         $id_eqpto      = $row1['id_eqpto'];	 
		 
		 $id_plmanut        = $row1['id_plmanut'];
		 $data_serv         = $row1['data_serv1'];

         $rs34 = mysql_query("select a.*, b.descr_evento from tb_plmanut a   
                    inner join tb_evento b on b.id_evento = a.id_evento 
					where a.id_eqpto = " .$id_eqpto .
					" order by b.descr_evento ");	

		 
		 
	  }
	 
 }
 
 
//SELECT a.id_eqpto, a.dt_garantiafab ,ADDDATE(a.dt_garantiafab,INTERVAL 3 year) nvdata FROM tb_equipamento a;
//


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

// Comparando as Datas
/*
if(strtotime($data1) > strtotime($data2))
{
echo 'A data 1 ? maior que a data 2.';
}
elseif(strtotime($data1) == strtotime($data2))
{
echo 'A data 1 ? igual a data 2.';
}
else
{
echo 'A data 1 ? menor a data 2.'.strtotime($data1);
}


<?php 
		   switch ($row['situacao']) {
				case "1":
					echo ("Ativo");
					break;
				case "2":
					echo ("Inativo");
					break;
				case "3":
					echo ("Em Manuten??o");
					break;
				case "4":
					echo ("Alugado");
					break;
				case "5":
					echo ("Baixado");
					break;
}
		   
		   ?>
*/




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
	<title>EQPTO0012c - Planejamento de Manutencoes Executados</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="funcequipamento.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_eqpto.value ='';
		  document.form1.id_plmanut.value = '';
		  document.form1.data_said.value = '';
   	   	  document.form1.action="eqpto0012.php";
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
        <h1> Planejamento de Manuten&ccedil;&atilde;o Executados- 
        <?php
	// echo($_SESSION['id_eqpto']);
		  ?>
      </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
      <th  colspan="3" align="center"></th></tr>
      <tr>
        <th colspan="3" align="center">
        <?php if ($btn == 's'){ ?>
        <?php } ?>
          <input type="button" onClick="sair();" value="Sair"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th colspan="3" align="center"><font color="#000000">Servicos Executados</font></th>
      </tr>
      <tr>
        <th colspan="3" align="left">Equipamento 
          <select name="id_eqpto2" style="font-size:10" onChange="atualiza();" class="search-input5">
            <option value="">Selecione o Equipamento</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php print($row33['id_eqpto'])?>"
				  <? if($row33['id_eqpto'] == $id_eqpto2 ) {?>selected <? } ?>				
				 ><?php print($row33['descr_eqpto']  . " TAG - " . $row33['tag_eqpto']);?></option>
            <?php }?>
        </select>
          Evento
          <select name="id_plmanut22" style="font-size:10" onChange="atualiza();"  class="search-input3">
             <option value="">Selecione o Item</option>
             
             <?php while($row333=mysql_fetch_assoc($rs340)){ ?>
             <option value="<?php print($row333['id_plmanut']);?>"
				  <? if($row333['id_plmanut'] == $id_plmanut22 ) {?>selected <? } ?>		
       				 ><?php print($row333['descr_evento'] . " - Periodicidade -  " . $row333['periodic'] ." dias ");?></option>
		             <?php }?>
        </select>
Periodo
<input type="date" name="data_1" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);" />
a
<input type="date" name="data_2" size="8" maxlength="8"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
<input type="submit"  name="gravar"   value="Filtrar" class="search-submit2" /></th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td colspan="3" align="center">
              <table width="80%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >TAG</th>
                  <th >Equipamento</th>
                  <th >Evento</th>
                  <th >Data</th>
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

           
             <td  align="left"><?php echo ($row['tag_eqpto']);?></td>
           <td  align="left">
           <?php echo ($row['descr_eqpto']);?></td>
           <td align="left"><?php echo ($row['descr_evento']);?></td>
           <td align="right"><?php echo ($row['data_serv2']);?></td>
           <td align="right"><?php echo ($row['periodic']);?> dias</td>
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
