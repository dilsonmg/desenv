<link rel="stylesheet" href="../css/qreal.css">

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
         $id_itemmanu      = "";	 
//		 $id_eqpto         = "";
		 $id_chkman        = "";
		 $dt_check         = "";
		 $limpeza          = "";
		 $lubrificacao     = "";
		 $eletrica         = "";
		 $pneumatica       = "";
		 $estrutura        = "";
		 $subst_peca       = "";
		 $troca_oleo       = "";
		 $nivel_oleo       = "";
		 $hidraulica       = "";
		 $ajuste           = "";		 		  
		 $avaliacao        = "";		 		  
		 $relatorio        = "";		 		  
$responsavel = "dilson magalhaes";

$id = $_GET ["id"];

$habilit = "S";
$p4 = "";
if (isset($id_eqpto2)){
	if ($id_eqpto2 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_eqpto = '" . $id_eqpto2 ."'" ; 
		 }}


//---------------------------------------------------

$rs2000 = mysql_query("select a.* ,b.descr_eqpto, c.descr_itman, d.descr_pecait, b.codigo_eqpto 
 from tb_subpeca a
 inner join tb_equipamento b on a.id_eqpto = b.id_eqpto
 inner join tb_itemmanut c on c.id_itemmanu   = a.id_itemmanu
 inner join tb_pecait d on a.id_pecait = d.id_pecait
 where a.id_eqpto > 0 " . $p4 .$p50 .$p60 . $p70 .$p80 ."
  order by  a.data_sub desc,b.descr_eqpto,a.id_itemmanu,a.id_pecait");				  
    $b = mysql_num_rows($rs2000);


//------------------------------------------------
		 

$rs2 = mysql_query("select a.* ,b.descr_eqpto, c.descr_itman,b.codigo_eqpto, b.codigo_eqpto ,b.tag_eqpto
 from tb_chkman a
 inner join tb_equipamento b on a.id_eqpto = b.id_eqpto
 inner join tb_itemmanut c on c.id_itemmanu   = a.id_itemmanu
  where a.id_eqpto > 0 " . $p4 . "
  order by a.dt_check desc,a.id_eqpto");				  
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("select a.* from tb_equipamento a order by a.descr_eqpto");		
$rs330 = mysql_query("select a.* from tb_equipamento a order by a.descr_eqpto");		
		  	
$rs34 = mysql_query("select a.* from tb_itemmanut a  where a.id_eqpto = '" .$id_eqpto . "' order by a.descr_itman");				  	


if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_chkman a where a.id_chkman =". $id);
	
	$a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
    $rs1 = mysql_query("SELECT a.* FROM tb_chkman a where a.id_chkman =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $dt_check    = strftime("%d/%m/%Y", strtotime($row1['dt_check']));
         $id_itemmanu      = $row1['id_itemmanu'];	 
		 $id_eqpto         = $row1['id_eqpto'];

         $rs34 = mysql_query("select a.* from tb_itemmanut a  where a.id_eqpto = '" .$id_eqpto . "' order by a.descr_itman");				  	

		 $id_chkman        = $id;
		 $limpeza          = $row1['limpeza'];
		 $lubrificacao     = $row1['lubrificacao'];
		 $eletrica         = $row1['eletrica'];
		 $pneumatica       = $row1['pneumatica'];
		 $estrutura        = $row1['estrutura'];
		 $subst_peca       = $row1['subst_peca'];
		 $troca_oleo       = $row1['troca_oleo'];
		 $nivel_oleo       = $row1['nivel_oleo'];
		 $hidraulica       = $row1['hidraulica'];
		 $ajuste           = $row1['ajuste'];		 		  
		 $avaliacao        = $row1['avaliacao'];		 		  
		 $relatorio        = $row1['relatorio'];	
		 $arq_foto         = $row1['foto_antes'];
		 $arq_instr        = $row1['foto_depois'];

		 	 		  
		 
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


         $rs3400 = mysql_query("select a.*, b.descr_evento from tb_plmanut a   
                    inner join tb_evento b on b.id_evento = a.id_evento 
					where a.id_eqpto = '" .$id_eqpto .
					"' order by b.descr_evento ");	


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
	<title>EQPTO0004 - Ficha de Manutencao de  Equipamentos</title>
	<script type='text/javascript' src="funcequipamento.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
	
	document.form1.id_eqpto.value='';
    if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="eqpto0004.php";
		  document.form1.submit();  
		  return true;
		  }

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


<table width="98%" border="0">
   
      <tr>
      
      <th  colspan="6" align="center"></th></tr>
      <tr>
        <th align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th colspan="3" align="center"><h1>Manuten&ccedil;&atilde;o Preventivas / Corretivas-
        <?php
	echo($_SESSION['id_eqpto']);
		  ?></h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="7" align="left">Selecione o Equipamento 
          <select name="id_eqpto2" onChange="atualiza();">
            <option value="">Selecione o Equipamento</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php print($row33['id_eqpto'])?>"
				  <? if($row33['id_eqpto'] == $id_eqpto2 ) {?>selected <? } ?>				
				 ><?php print($row33['descr_eqpto'] ." - TAG - " .$row33['tag_eqpto']  );?></option>
            <?php }?>
        </select>
        </th>
      </tr>
      </table>
      <table border=0 width="95%">
      <tr>
        <th align="center" bgcolor="#000066"><font color="#FFFFFF">Manute&ccedil;&otilde;es Preventivas</font></th>
        <th>&nbsp;</th>
        <th align="center" bgcolor="#000066"><font color="#FFFFFF">Manuten&ccedil;&otilde;es Corretivas</font></th>
      </tr>
      <tr>
       <th  align="center" valign="top">
           <table width="90%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >Equipamento</th>
                  <th >N.Patr</th>
                  <th >Tag</th>
                  <th >Conjunto</th>
                  <th >Data</th>
                </tr>
         <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;}
	  
	  while($row=mysql_fetch_array($rs2)){ 
          if($bg == 1){
			 $bgc = "bgcolor=#eee";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
			  
	      echo('<tr ' . $bgc .'>');?>

               <td >
           <?php echo ($row['descr_eqpto'] ." - TAG - " .$row['tag_eqpto'] );?></td>
                <td ><?php echo ($row['codigo_eqpto']);?></td>
                <td ><?php echo ($row['tag_eqpto']);?></td>
                <td ><?php echo ($row['descr_itman']);?></td>
                 <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['dt_check'])));?></td>
           </tr>
          <?php 
		   } 
		   ?>
            </table>            
        </th>
        <th>&nbsp;</th>

        <th  valign="top">
          <table width="90%" border="1"  bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >Equipamento</th>
                  <th >Conjunto</th>
                  <th >Pe&ccedil;as Substitu&iacute;das</th>
                  <th >Quantidade</th>
                  <th >Data </th>
                </tr>
     <?php
//echo($b);

			 $ttpeca = 0;
			 if ($b > 0){
			   $bg = 0;}
			  
			  while($row=mysql_fetch_array($rs2000)){ 
			       if($bg == 1){
						$bgc = "bgcolor=#eee";  $bg = 0;}
				   else{ $bgc = ''; $bg = 1;}	
					  
			       echo('<tr ' . $bgc .'>');?>
		
				   <td align="left">
				   <?php echo ($row['descr_eqpto'] ." - Patr - " .$row['codigo_eqpto'] );?></td>
				   <td align="left"><?php echo ($row['descr_itman']);?></td>
				   <td align="left"><?php echo ($row['descr_pecait']);?></td>         
				   <td align="right"><?php echo ($row['quantid']);
					   $ttpeca = $ttpeca + $row['quantid'] ;
				   ?></td>         
				   <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_sub'])));?></td>
				   </tr>   
				  <?php 
				 }
				  ?>                
         </table>        
        </th>
      </tr>
</table>
</table>
              
</form> 
</center>
</body>
</html>
