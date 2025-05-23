<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.num_lote =  '" . $lote_fabr2 ."'" ; 
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
	     $id_saidmat       = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $data_saida       = "";
		 $quantid_said    = "";
		 $lote_fabricado   = "";
          $unidade         = "";
$id = $_GET ["id"];

$habilit = "N";


$rs2 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,b.cod_prod,c.cod_fornec,c.rz_social
from tb_entmatp a
 inner join tb_produto b on a.cod_prod = b.cod_prod 
 inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
 where a.id_entmatp > 0 " .$p2 . "
  order by a.id_entmatp desc");	
   $b = mysql_num_rows($rs2);
	
	if ($m_primapesq != "" or $lote_fabr2 != ""){ $habilit = "S" ;}
			  
 
 $fab = "";
 $venc = "";
 
$lm = "";					
?>

<head>
<!--[if lt IE 9]>
<script src="//html5shim.googlecod.com/svn/trunk/html5.js">
</script>
<![endif]-->

	<title>MATRT001 - RASTREAMENTO POR LOTE DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>  
window.onerror=null;
/*  
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/
function ver_aditivo(app)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
}

function informar(){
alert("Janela redimensionada para largura: " + this.outerWidth + "e altura: " +this.outerHeight);
this.focus();
}



function carga00(app){
	//window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1280,status=yes,height=1080");
	window.open (app ,"fullscreen = yes,scrollbars=yes,resizable=1 , target=_blank"); 
 
}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matpe002.php";
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
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" ><h1>Consulta por Lote de Mat&eacute;ria Prima- 
        <?php
	echo($lote_fabr2);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="95%" border="0">
<tr>
        <th colspan="2" align="center"> Lote M.Prima
          <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="">
        <input name="Pesquisar" type="submit" value="Pesquisar">
        <input type="button" onClick="sair();" value="Sair"></th>
      </tr>
<?php
	if ($habilit == "S"  and $b >0){
    //busca os dados do lote fabricado	  
	
	
      $rs200 = mysql_query("SELECT a.*,b.descr_prod FROM tb_saidmatp a
               inner join tb_produto b on a.cod_prod = b.cod_prod
               where a.num_lote =  '". $lote_fabr2 ."' order by a.data_saida desc ");		 		  
?>

      <tr>
        <th colspan="2" align="center"  bgcolor="#8080FF">Lotes Produzidos</th>
      </tr>
            <tr >
              <th colspan="3" align="center"><h2> Materias Primas Usadas na Fabrica&ccedil;&atilde;o</h2></th>
            </tr>
            <tr >
              <th colspan="3" align="center">&nbsp;</th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
               <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="3"  bgcolor="#009999">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#00FF66">Lote / Partida</th>
                  <th>% ativo</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >Quantidade</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                  <th>&nbsp;</th>
                </tr>

     <?php
//echo($b);
	  
	  while($row=mysql_fetch_array($rs2)){ ?>

              <tr>
                <td ><?php echo ($row['rz_social']);?></td>
                <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
                <td  align="center"><?php echo ($row['unidade']);?></td>
                <td align="center" ><?php echo ($row['num_nf']);?></td>
                <td align="center" ><?php echo ($row['data_nff']);?></td>
                <td align="center" ><?php echo ($row['quantid_ent']);?></td>
                <td align="center">
				 <a href="javascript:ver_aditivo('docto01e4.php?num_lote=<?php echo ($row['num_lote']);?>');"><?php echo ($row['num_lote']);?></a>

		            </td>
                <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));?></td>
                <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));?></td>
                <td align="center"><?php echo ($row['atv_kamoran']);?></td>
           </tr>
          <?php 
		   $cod_prod = $row['cod_prod'] ;
		   $desc_prod = $row['descr_prod'];
		   $num_lote_mat = $row['num_lote'];
		   } 
		   
		   ?>
           </table>
           </td></tr>
     </table>
     <br>  <h4><font color="#666666"> Lotes Fabricados com a Materia Prima - <?php echo ($cod_prod . " - " . $desc_prod . " Lote: " . $num_lote_mat);?></font></h4>
      <table width="70%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Mat&eacute;ria Prima</th>
                  <th >N. Lote M. Prima</th>
                  <th>Dt. Sa&iacute;da</th>
                  <th >Quantidade</th>
                  <th >Unidade</th>
                  <th >Lote Fabricado</th>
                </tr>
<!--
 <a href="javascript:carga00('matrt000.php?num_lote=<?php echo ($row['lote_fabricado']);?>');"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>
          
-->
     <?php
//echo($b);
///	
	  while($row=mysql_fetch_array($rs200)){ ?>

              <tr>
                <td >
 <a href="javascript:ver_aditivo('matrt000.php?num_lote=<?php echo ($row['lote_fabricado']);?>');"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_saida'])));?></td>
           <td align="center" ><?php echo (number_format($row['quantid_said'],3,",",""));?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center"><?php echo ($row['lote_fabricado']);?></td>
           </tr>
          <?php 
		   } 
		  ?>      
         </table>
      
     
           
<?php		   
	 }
		  ?>      
</form> 
</center>
</body>
</html>
