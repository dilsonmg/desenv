<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<?php

header('Content-type: text/html; charset=ISO-8859-1');
session_start();
set_time_limit(0);

include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");
  //shell_exec("killall -11 httpd");

$data_p = $_GET ["dtp1"];

$p1 = "";

$p1 = " and a.data_nf = '". $data_p ."'" ; 


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

$hoje = date("d/m/Y");
$data_req = $hoje; 
$a = 0;
$b = 0;


$rs2 = mysql_query("SELECT a.*,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					  FROM tb_saidaprodac a
					  where a.id_saidaprodac > 0   " . $p1 ."	
					 order by a.data_nf desc limit 100 ");		 		  

   // $b = mysql_num_rows($rs2);
   $b=1;

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
	<title>MATPAC231 - SAIDAS DE PRODUTOS ACABADOS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   



<!-- EXIBE O CONTADOR -->

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
        <th align="center" ><h1>Sa&iacute;das de Produtos Acabados Em - 
        <?php echo(formata_data($data_p)); ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table> 
 <table width="95%" border="0">
      <tr>
        <th colspan="3" align="center">
        <input type="button" onClick="javascript:self.close();" value="Sair" class="search-submit2">
        </th>
        </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto</th>
                  <th >N. Lote</th>
                  <th>Dt Fatura</th>
                  <th>Quantidade</th>
                  <th>Unidade</th>
                  <th >N. Pedido</th>
                  <th >N. NF</th>
                  <th >Data NF</th>
                  <th >Cliente</th>
                  <th >Transportadora</th>
                </tr>
     <?php
	 $quant = 0;
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 

 		  
      $rs_prd = mysql_query("Select * from tb_produto a where a.cod_prod = '" . $row['cod_prod'] . "'");
	  $row_prd = mysql_fetch_assoc($rs_prd);
	  $descr_prod = $row_prd['descr_prod'];

      $rs_cli = mysql_query("Select * from tb_cliente a where a.codigo_cli = '" . $row['codigo_cli'] . "'");
	  $row_cli = mysql_fetch_assoc($rs_cli);
	  $nome_cli = $row_cli['nome_cli'];


      $rs_for = mysql_query("Select * from tb_fornecedor a where a.cod_fornec = '" . $row['cod_fornec'] . "'");
	  $row_for = mysql_fetch_assoc($rs_for);
	  $rz_social = $row_for['rz_social'];

						 

       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>


              <tr>
                <td >
                
                <?php 
				$bxx = 0;
	   
				$rsxx = mysql_query("SELECT a.* FROM tv_saldoltprac a 
	           where a.cod_prod = '" . $row['cod_prod'] . "' and a.num_lote = '" .$row['num_lote'] . "' 	
	           order by a.cod_prod desc limit 1 ");		 		  
	 
	
              $bxx = mysql_num_rows($rsxx);
				
				?>
                
           <?php echo ($row['cod_prod'] . " - " . $descr_prod);
		    
		   ?>
		
           
           </td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" >
		   <?php 
		         $quant = $quant + $row['quantid'];
		   echo(number_format($row['quantid'],2,',',''));
		   
		   ?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_pedido']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $nome_cli); ?></td>
           <td align="left"><?php echo ($rz_social); ?></td>
              </tr>
          <?php 
		   } 
	     }
		  ?>   
                        <tr>
                <td colspan="3" align="right" >Total de Itens</td>
                <td align="right" > <?php echo(number_format($quant,2,',',''));?></td>
                <td align="center" >&nbsp;</td>
                <td align="center" >&nbsp;</td>
                <td align="center" >&nbsp;</td>
                <td align="center" >&nbsp;</td>
                <td align="left">&nbsp;</td>
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
