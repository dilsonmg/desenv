<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();



$p1 = "";
$p2 = "";
$p3 = "";

$tt_custo = 0.00;

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
	     $id_customind     = "";
		 $id_centcustoind  = "";
		 $mes_custoind     = "";
		 $ano_custoind     = "";
		 $val_custoind     = "";
		 $obs_custoind     = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,


if(isset($id_centcustoind2)){
	if($id_centcustoind2 != ""){
		$p1 = " and a.id_centcustoind = '" .$id_centcustoind2 . "'";
	}
}
$p1a = '';

if(isset($mes_custoind2)){
	if($mes_custoind2 != ""){
		$p2 = " and a.mes_custoind = '" .$mes_custoind2 . "'";
	}
}
if(isset($ano_custoind2)){
	if($ano_custoind2 != ""){
		$p3 = " and a.ano_custoind = '" .$ano_custoind2 . "'";
	}
}

if(isset($tipo_custo)){
	if($tipo_custo != ""){
		$p1a = " and b.tipo_custo = '" .$tipo_custo . "'";
	}
}

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){



$rs2t = mysql_query("select sum(a.val_custoind) tot_custo
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind " . $p1a . "
					 where a.id_customind > 0 " . $p1 . $p2 . $p3 . 
					 " order by b.descr_centcustind ");				  
$bx = mysql_num_rows($rs2t);

$row1x = mysql_fetch_assoc($rs2t);
$tot_custog  = $row1x['tot_custo'];
			  


$rs2 = mysql_query("select a.* ,b.descr_centcustind,b.tipo_custo
					 from tb_customind a
					 inner join tb_centcustoind b on a.id_centcustoind = b.id_centcustoind " . $p1a . "
					 where a.id_customind > 0 " . $p1 . $p2 . $p3 . 
					 " order by a.mes_custoind,a.ano_custoind ");				  
$b = mysql_num_rows($rs2);


}
///////////////fim pesquisar ////////////////////


$rs33 = mysql_query("select a.* from tb_centcustoind a order by a.descr_centcustind");				  	
$rs331 = mysql_query("select a.* from tb_centcustoind a order by a.descr_centcustind");				  	

$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_customind a where a.id_customind ='". $id. "'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
	 
         $rs1 = mysql_query("SELECT a.* FROM tb_customind a where a.id_customind = '". $id . "'");
    	 $row1 = mysql_fetch_assoc($rs1);

		 $id_customind     = $id;
		 $id_centcustoind  = $row1['id_centcustoind'];
		 $mes_custoind     = $row1['mes_custoind'];
		 $ano_custoind     = $row1['ano_custoind'];
		 $val_custoind     = $row1['val_custoind'];
		 $obs_custoind     = $row1['obs_custoind'];

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
	<title>Custoindv001- Vinculacão Mensal de Custos Indiretos</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="custoindvc01.php";
		  document.form1.submit();  
		  return true;
	//	  }

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
<input type=hidden name="cod_prod2" value="<?php echo("$cod_prod");?>">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
         <th align="center"><h1>Consulta Vinculação Mensal de Custos Indiretos - 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
         <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      </table>
 <table width="98%" border="0">
     

   
      <tr>
        <th colspan="2" align="center"><input type="button" onClick="sair1();" value="Sair"  class="search-submit2">
        </th>
        </tr>
              <th colspan="2" align="center"><select name="id_centcustoind2" class="search-input6" <?php if($habilita ==1) echo(" disabled ");?>>
                <option value="">Selecione o Custo</option>
                <?php while($row331=mysql_fetch_assoc($rs331)){ ?>
                <option value="<?php print($row331['id_centcustoind'])?>"
				  <? if($row331['id_centcustoind'] == $id_centcustoind2 ) {?>selected <? } ?>				
				 ><?php print($row331['descr_centcustind'] )?></option>
                <?php }?>
              </select>
              
  <input type="radio" name="tipo_custo" value="I" id="tipo_custo"
         <?php 
	   if ($tipo_custo == "I" ) {
		   echo("Checked='checked'  ");
	   }
	   ?>
         >
Indireto
<input type="radio" name="tipo_custo" value="D" id="tipo_custo1"
         <?php 
	   if ($tipo_custo == "D" ) {
		   echo("Checked='checked'  ");
	   }
	   ?>
         >
Direto             
<input type="radio" name="tipo_custo" value="" id="tipo_custo1"
         <?php 
	   if ($tipo_custo == "" ) {
		   echo("Checked='checked'  ");
	   }
	   ?>
         >
Todos             
                  
              
              
              
              
                <select name="mes_custoind2" class="search-input4" >
                  <option value="">Selecione o Mês</option>
                  <option value="1" <?php if($mes_custoind == "1" ){ echo(" selected "); }?>>Jan</option>
                  <option value="2" <?php if($mes_custoind == "2" ){ echo(" selected "); }?>>Fev</option>
                  <option value="3" <?php if($mes_custoind == "3" ){ echo(" selected "); }?>>Mar</option>
                  <option value="4" <?php if($mes_custoind == "4" ){ echo(" selected "); }?>>Abr</option>
                  <option value="5" <?php if($mes_custoind == "5" ){ echo(" selected "); }?>>Mai</option>
                  <option value="6" <?php if($mes_custoind == "6" ){ echo(" selected "); }?>>Jun</option>
                  <option value="7" <?php if($mes_custoind == "7" ){ echo(" selected "); }?>>Jul</option>
                  <option value="8" <?php if($mes_custoind == "8" ){ echo(" selected "); }?>>Ago</option>
                  <option value="9" <?php if($mes_custoind == "9" ){ echo(" selected "); }?>>Set</option>
                  <option value="10" <?php if($mes_custoind == "10" ){ echo(" selected "); }?>>Out</option>
                  <option value="11" <?php if($mes_custoind == "11" ){ echo(" selected "); }?>>Nov</option>
                  <option value="12" <?php if($mes_custoind == "12" ){ echo(" selected "); }?>>Dez</option>
              </select>
Ano
<input type="text" id = "ano_custoind2" required name="ano_custoind2"  maxlength="4" size="10" placeholder="informe o ano"  value="<?php echo($ano_custoind); ?>" class="search-input4">
<input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
</th>
            </tr>
            <tr align="center">
              <td colspan="2" align="center">
 
<?php            
///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
              

?>
              
              
              <table width="80%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Id</th>
                  <th >Mes/Ano</th>
                  <th >Custo</th>
                  <th >tipo</th>
                  <th >Valor</th>
                  <th >Obs</th>
                  <th >%</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;

  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	       echo('<tr ' . $bgc .'>');?>
       
           <tr>
             <td ><?php echo ($row['id_customind']); ?> </td>
           <td align="center"> <?php  echo ($row['mes_custoind'] . "/" . $row['ano_custoind'] );?></td>
           <td  alingn="center"> <?php  echo ($row['id_centcustoind'] . " - " . $row['descr_centcustind']);?></td>
           <td  align="center"><?php
				switch ($row['tipo_custo']){
			   case "D":
					echo ("Direto");
					break;
			   case "I":
					echo ("Indireto");
					break;
				}?></td>
           <td  align="right"><?php echo (number_format($row['val_custoind'],2,",","."));
		   $tt_custo = $tt_custo + $row['val_custoind'];
		   ?></td>
           <td  align="left"><?php echo ($row['obs_custoind']);?></td>
           <td  align="right">
           <?php
		       echo( number_format((($row['val_custoind'] / $tot_custog ) * 100),2,",",".")); 
			   ?> %
           
           </td>
    
          <?php 
		   } 
	     }
		 ?>  
          </tr>  
          <tr  bgcolor="#D2D2FF">
             <th colspan="3"  align="right">Total dos Custos</th>
             <th  align="right">&nbsp;</th>
             <th  align="right"><?php echo (number_format($tt_custo,3,",","."));?></th>
             <th  align="left">&nbsp;</th>
             <th  align="left">&nbsp;</th>
           </tr>    
         </table>
 <?php
}
/////////////////fim pesquisar ///////////////


?>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
