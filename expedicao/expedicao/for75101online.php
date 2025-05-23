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


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");


$lote_fabr2 = $_GET ["lt"];
$prod       = $_GET ["prd"];
//$lote_fabr2 = $lote_fabricado;

if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
	 }
}

$bx = 0;

$rs2xx = mysql_query("select a.* ,
	DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib,
	DATE_FORMAT(a.data_liblote, '%d/%m/%Y') data_liblote,
	b.descr_prod
	from tb_entprodac a
	 inner join tb_produto b on a.cod_prod = b.cod_prod
	 where a.num_lote = '" . $lote_fabr2 . "' order by a.id_entprodac desc");				  
    $bx = mysql_num_rows($rs2xx);
	
    if ($bx > 0){
		$row1x = mysql_fetch_assoc($rs2xx);
        $descr_prod = $row1x['descr_prod'];		
	}else {
	    $rs1x = mysql_query("SELECT a.* FROM tb_produto a where a.cod_prod = '". $prod . "'" );
		$row1x = mysql_fetch_assoc($rs1x);
        $descr_prod = $row1x['descr_prod'];			
	}



 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc,
					 DATE_FORMAT(a.data_saida, '%d/%m/%Y') data_saida2
 FROM tb_saidmatp a
     inner join tb_produto b on a.cod_prod = b.cod_prod 
	  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
	  where a.id_saidmat > 0 " . $p2 . "
	  group by a.id_saidmat	
	 order by a.id_saidmat desc ");				  
    $b = mysql_num_rows($rs2);
	
	
	 $rs2dt = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc,
					 DATE_FORMAT(a.data_saida, '%d/%m/%Y') data_saida2
 FROM tb_saidmatp a
     inner join tb_produto b on a.cod_prod = b.cod_prod 
	  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
	  where a.id_saidmat > 0 " . $p2 . "
	  group by a.id_saidmat	
	 order by a.id_saidmat desc ");				  
    
	 $row33a = mysql_fetch_assoc($rs2dt);
	 
	 $data_saida = $row33a['data_saida2'];

$ite=0;

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
	<title>FOR75101 OnLine- Solicitacao de Insumos e Embalagens para Formulacâo</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th ><h1>Sistema de Gest&atilde;o da Qualidade<br></h1>
          <h2>Formul&aacute;rio          </h2>
          <h2> Solicita&ccedil;&atilde;o de Insumos e embalagens para formula&ccedil;&atilde;o / produ&ccedil;&atilde;o</h2>
          </th>
        <th align="right"><table width="100%" border="1">
          <tr>
            <th colspan="2" align="center" scope="col">FOR751-01 Online</th>
            <th align="center" scope="col"><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
            </tr>
          <tr>
            <td>Revis&atilde;o</td>
            <td>0</td>
            <td rowspan="3" align="center">P&aacute;gina</td>
          </tr>
          <tr>
            <td>Data Revis&atilde;o</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>Respons&aacute;vel</td>
            <td>Dilson Magalhaes</td>
            </tr>
          <tr>
            <td>Data Efetiva&ccedil;&atilde;o</td>
            <td>01/06/2019</td>
            <td align="center">01 de 01</td>
          </tr>
        </table></th>
      </tr>
      
      </table>
      <br><br>
     <table width="95%" border="0">
      <tr>
        <th align="left">Produto:</th>
        <th align="left"><h3><?php echo($descr_prod); ?></h3></th>
        <th align="right">N. Lote: 
          <input  type="hidden" name="ttanlises" value="<?php echo($lm); ?>">
        </th>
        <th align="left">
         <h3><?php echo($lote_fabr2); ?></h3>
        </th>
        <th align="right">Data:</th>
        <th align="left"><h3><?php echo($data_saida); ?></h3></th>
      </tr>
           
    </table>    
    <br>
   <table width="95%" border="0">
   <tr bgcolor="#CCCCCC">
     <td>Item </td>
     <td>Código </td>
     <td align="center">Matéria Prima</td>
     <td>Lote</td>
     <td>Material Recebido</td>
     <td>Observacões</td>
     <td align="center">Motivo</td>
    </tr>
    
   <?php while($row=mysql_fetch_array($rs2)){ 
   
    	 $msk = "S";
		 if(strtoupper($row['unidade']) != "KG"){
						 $msk = "N";
		 }
   
    ?>

   <tr>
     <td>
	 <?php 
	 	$ite ++;
		 echo($ite);
	 ?>
	 </td>
     <td><?php 
	 	
		 echo($row['cod_prod']);
	 ?></td>
     <td><?php 
	 	
		 echo($row['descr_prod']);
	 ?></td>
     <td><?php 
	 	
		 echo($row['num_lote']);
	 ?></td>
     <td align="right"><?php 
	 	  if ($msk == "S") {
				      echo (number_format($row['quantid_said'],3,',','.') . " - " . $row['unidade'] );
				  }else{
				      echo (number_format($row['quantid_said'],0,'','') . " - " . $row['unidade']);					  
				  }
		
		 //echo($row['quantid_said']);
	 ?></td>
     <td><?php 
	 	
		 echo($row['obs']);
	 ?></td>
     <td><?php 
	 	
	   switch ($row['motivo']) {
			case 1:
				echo("Producão");
				break;
			case 2:
				echo("Perda");
				break;
			case 3:
				echo("Outros");
				break;
		  }
	 ?></td>
   </tr>
   <?php } ?>
    </table>
    <br><br>
    
  <table width="95%" border="1">
    <tr>
      <td align="left">Solicitado por:</td>
      <td>Assinatura</td>
      <td>Data:</td>
      </tr>
     <tr>
      <td>Entregue por:</td>
      <td>Assinatura</td>
      <td>Data:</td>
      </tr>
     <tr>
       <td colspan="3">Observac&otilde;es: Procedimentos Relacionados - PPO-010 e PPO-011</td>
      </tr>
  </table>    

     
</form> 
</center>
</body>
</html>
