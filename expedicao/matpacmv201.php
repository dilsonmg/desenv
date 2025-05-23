<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

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

/*
$data1 = date("Y/m/d");
$data2 = date("Y/m/d");
*/
if($data_1 == ""){$data_1 = $data1;}
if($data_2 == ""){$data_2 = $data2;}
$p10 = "";
$p11 = "";

if (isset($data_1)){
	if ($data_1 <> "" ){
//		 $p1 = " and a.data_venc >= '" . formata_data2($data_1) ."'" ; 
		 $p10 = " and c.data_nf >= '" . formata_data2($data_1) ."'" ; 

		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 //$p2 = " and a.data_venc <= '" . formata_data2($data_2) ."'" ; 
		 $p11 = " and c.data_nf <= '" . formata_data2($data_2) ."'" ; 
		 
		 }}

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
$lm = 0;

	    // $id_entprodac     = "";
         //$cod_prod         = "";	 
		 $embalagem        = "";
		 $num_lote         = "";
		 $data_fabr        = "";
		 $data_venc        = "";
		 $data_prevlib     = "";
		 $data_liblote     = "";
		 $quant_fabr       = "0.00";
		 
$p1 = '';
$p2 = '';
		 
		 
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.num_lote = '" . $lote_fabr2 ."'" ; 
	 }
}
		 

$id = $_GET ["id"];

$habilit = "S";
/*
select distinct a.cod_prod, a.embalagem,a.num_lote,a.data_fabr,a.data_venc ,DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
a.quant_fabr,a.tp_entrada,
b.descr_prod, if(c.tt_quantid is null,0,c.tt_quantid) tt_saida,d.tt_lote from tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
left outer join tv_saidaacdiapac c on a.cod_prod = c.cod_prod and a.num_lote = c.num_lote
left outer join tv_saldoltprac d on a.cod_prod = d.cod_prod and a.num_lote = d.num_lote
where a.data_liblote is not null order by str_to_date(a.data_fabr,'%d/%m/%Y')  desc
limit 300

*/
//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
/*
echo("select  a.cod_prod, a.embalagem,a.num_lote,a.data_fabr,a.data_venc ,DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
a.quant_fabr,a.tp_entrada,
c.descr_prod, 
if(c.tt_quantid is null,0,c.tt_quantid) tt_saida,d.tt_lote ,
ABS((tt_lote + if(c.tt_quantid is null,0,c.tt_quantid))) sd_anterior,
 DATE_FORMAT(c.data_nf, '%d/%m/%Y') data_nf
from tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
inner join tv_saidaacdiapac c on a.cod_prod = c.cod_prod and a.num_lote = c.num_lote " .$p10 . $p11 . "
left outer join tv_saldoltprac d on a.cod_prod = d.cod_prod and a.num_lote = d.num_lote
where a.data_liblote is not null" .$p1 . $p2 . "
order by c.data_nf  desc,a.num_lote desc
limit 300");		
*/				   

$rs2 = mysql_query("select  a.cod_prod, a.embalagem,a.num_lote,a.data_fabr,a.data_venc ,DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
a.quant_fabr,a.tp_entrada,
c.descr_prod, 
if(c.tt_quantid is null,0,c.tt_quantid) tt_saida,d.tt_lote ,
ABS((tt_lote + if(c.tt_quantid is null,0,c.tt_quantid))) sd_anterior,
 DATE_FORMAT(c.data_nf, '%d/%m/%Y') data_nf
from tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
inner join tv_saidaacdiapac c on a.cod_prod = c.cod_prod and a.num_lote = c.num_lote " .$p10 . $p11 . "
left outer join tv_saldoltprac d on a.cod_prod = d.cod_prod and a.num_lote = d.num_lote
where a.data_liblote is not null" .$p1 . $p2 . "
order by c.data_nf  desc,a.num_lote desc
limit 300");				   
 
    $b = mysql_num_rows($rs2);

$rs33 = mysql_query("SELECT a.*,b.descr_prod,DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib2  FROM tb_entprodac a
 					 inner join tb_produto b on b.cod_prod = a.cod_prod
					 where a.data_liblote is not null
					 order by a.num_lote asc");				  	
$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_entprodac a where a.id_entprodac =". $id);
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         $rs1 = mysql_query("SELECT a.* FROM tb_entprodac a where a.id_entprodac =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_prevlib    = strftime("%d/%m/%Y", strtotime($row1['data_prevlib']));
	     $data_liblote    = strftime("%d/%m/%Y", strtotime($row1['data_liblote']));
		 
		 $id_entprodac     = $id;
		 $cod_prod         = $row1['cod_prod'];
		 
		 $embalagem        = $row1['embalagem'];
		 $num_lote         = $row1['num_lote'];
		 $data_fabr        = $row1['data_fabr'];
		 $data_venc        = $row1['data_venc'];
		 $quant_fabr       = $row1['quant_fabr'];
         $data_prevlib     = $row1['data_previlib2'];
         $resultado1       = $row1['resultado1'];
         $resultado2       = $row1['resultado2'];
         $resultado3       = $row1['resultado3'];
         $resultado4       = $row1['resultado4'];
         $resultado5       = $row1['resultado5'];
		 
	  }
	 
 }
//SELECT a.id_eqpto, a.dt_garantiafab ,ADDDATE(a.dt_garantiafab,INTERVAL 3 year) nvdata FROM tb_equipamento a;
//


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

// Comparando as Datas
/*

/// Diferenca em dias de uma data para a data atual.
SELECT t.*,DATEDIFF(t.data_conserto,CURDATE()) FROM tb_mvtoeq t;
/////////////////////////////////////////////////////////////////

if(strtotime($data1) > strtotime($data2))
{
echo 'A data 1 é maior que a data 2.';
}
elseif(strtotime($data1) == strtotime($data2))
{
echo 'A data 1 é igual a data 2.';
}
else
{
echo 'A data 1 é menor a data 2.'.strtotime($data1);
}


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
	<title>Matpac201- CONSULTA PRODUTOS LIBERADOS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

*/
function atualiza(){
   document.form1.submit();	
}			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_entprodac.value = '';
   	   	  document.form1.action="matpac201.php";
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
<input type=hidden name="prg" value="matpac201.php">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Movimenta&ccedil;&atilde;o de Produtos Acabados- 
        <?php
	echo($_SESSION['id_entmatp']);
	

		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center" bgcolor="#8080FF">Filtro de Dados</th>
      </tr>
            <tr >
              <th colspan="4" align="center">    Produto
                  <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>Lote 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="20" size="20" placeholder="informe o lote !"  value="">
              Periodo
              <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
<input name="Pesquisar" type="submit" value="Pesquisar">
              <input type="button" onClick="sair();" value="Sair"></th>
            </tr>
            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Produto</th>
                  <th >Grupo</th>
                  <th >Lote</th>
                  <th >Fabrica&ccedil;&atilde;o</th>
                  <th >Vencimento</th>
                  <th >Qtd.Frabricada</th>
                  <th >Embalagem</th>
                  <th >Saida</th>
                  <th >Incicial</th>
                  <th >Quantidade</th>
                  <th >Saldo</th>
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

                
                  <td >
                <?php echo ($row['cod_prod']);?>
           
                 <?php echo ($row['descr_prod']); ?>
           </td>
                  <td align="center"><?php
		   $tot_prod = $tot_prod + $row['tt_lote'] ;
//		    echo (substr($row['cod_prod'],0,2));
			
			switch (substr($row['cod_prod'],0,2)) {
				case 13:
					echo "Quimica Real";
					break;
				case 15:
					echo "Quimica Real";
					break;
				case 17:
					echo "Quimica Real";
					break;
				case 32:
					echo "Elanco";
					break;
				case 42:
					echo "Elanco";
					break;
				case 51:
					echo "Filter";
					break;
				case 70:
					echo "Naturais";
					break;
				case 10:
					echo "Antiespumante";
					break;
		
}	
			?></td>
           <td align="center"  alingn="center"> <?php  echo ($row['num_lote']);?></td>
           <td  align="center"><?php echo ($row['data_fabr']);?></td>
           <td  align="center"><?php echo ($row['data_venc']);?></td>
           <td  align="right"><?php echo ($row['quant_fabr']);?></td>
           <td  align="center"><?php echo ($row['embalagem']);?></td>
           <td  align="center"><?php echo ($row['data_nf']);?></td>
           <td  align="right"><?php echo (number_format($row['sd_anterior'],0,',',''));?></td>
           <td  align="right"><?php echo (number_format($row['tt_saida'],0,',',''));?></td>
           <td  align="right"><?php echo (number_format($row['tt_lote'],0,',',''));?></td>
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
