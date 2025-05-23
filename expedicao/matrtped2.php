<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

/* volume medio por cliente

select a.codigo_cli ,c.nome_cli,a.cod_prod,b.descr_prod,avg(a.quantid) vol_medio from tb_saidaprodac a
inner join tb_produto b  on a.cod_prod = b.cod_prod
inner join tb_cliente c on c.codigo_cli = a.codigo_cli
group by a.codigo_cli,a.cod_prod
order by vol_medio desc

select a.cod_prod,b.descr_prod,sum(a.quantid) tot_saida,(sum(a.quantid)/1200) lotes from tb_saidaprodac a
inner join tb_produto b  on a.cod_prod = b.cod_prod
group by a.cod_prod
order by tot_saida desc

select a.cod_prod,b.descr_prod,sum(a.quantid) from tb_saidaprodac a
inner join tb_produto b  on a.cod_prod = b.cod_prod
group by a.cod_prod

*///////////////////////////

$num_lote = $_GET ["num_lote"];

$p1 = "";
$p2 = "";
if (isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
        if(!is_numeric($lote_fabr2)){
		     $p1 = " and a.num_lote like '%". $lote_fabr2 ."%'" ; 			 
		     $p1 = " and a.num_lote in (". $lote_fabr2 .")" ; 			 

			 //$p100 = " inner join tb_cliente c on c.codigo_cli = a.codigo_cli and  c.nome_cli  like '%". $lote_fabr2 ."%'";
			 }
		 else{
			 $p2 = " and cast(a.num_lote as unsigned) = '" . $lote_fabr2 ."'" ; 
             //$p100 = " inner join tb_cliente c on c.codigo_cli = a.codigo_cli and c.codigo_cli = '". $lote_fabr2 . "'" ;

			 }
		 }}

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

//$habilit = "N";

//    
	if ($m_primapesq != "" or $lote_fabr2 != ""){
		
		 	 $rs2 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf,d.rz_social
              FROM tb_saidaprodac a
              inner join tb_produto b on b.cod_prod = a.cod_prod 
	          inner join tb_cliente c on c.codigo_cli = a.codigo_cli ". $p1 . "
	          inner join tb_fornecedor d on d.cod_fornec = a.cod_fornec
	          where a.id_saidaprodac > 0 " . $p2 . "	
	          order by a.data_fatura desc,num_lote desc limit 300 ");		
	 
        $b = mysql_num_rows($rs2);
					
	    $habilit = "S" ;
/*
	    $rs201 = mysql_query("SELECT count(a.codigo_cli) num_compras, sum(a.quantid) total_compr,avg(a.quantid) media_compr
      						from tb_saidaprodac a " . $p100 . "
							where a.id_saidaprodac > 0 " .$p2 . "
      						order by a.num_lote desc limit 300");
   	    $row100 = mysql_fetch_assoc($rs201);
		$num_compras = $row100['num_compras'];
		$tt_compras  = number_format($row100['total_compr'],0,',','');
		$media_compr = number_format($row100['media_compr'],2,',','');  
*/
		 
		}
 
 $fab = "";
 $venc = "";
 
$lm = "";					
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
	<title>MATRT002 - Rastreamento por Cliente</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

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


function carga00(app){
	//window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1280,status=yes,height=1080");
	window.open (app ,"fullscreen = yes,scrollbars=yes,resizable=1 , target=_blank"); 
 
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
           <th height="45" colspan="2" align="center"><h1>Rastreamento Clientes por Lote - P.A- 
        <?php
	//echo($lote_fabr2);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="95%" border="0">
      <tr>
        <th colspan="2" align="center">Informe o 
          Lote do Produto Acabado
          <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="250" size="100" placeholder="informe entre aspas simpls ex '999/99','999/99'"  value="" autofocus>
        <input name="Pesquisar" type="submit" value="Pesquisar" class="search-submit2">
        <?php if ($sr == ""){ ?>
             <input type="button" onClick="sair();" value="Sair" class="search-submit2">
        <?php }else { ?>
             <input type="button" onClick="self.close();" value="Sair" class="search-submit2">
        <?php } ?>
        </th>
      </tr>
<?php
	if ($habilit == "S"  and $b >0){
//busca os dados do lote fabricado
	  
?>

      <tr>
        <th colspan="2" align="center"  bgcolor="#8080FF">Dados da Saida</th>
      </tr>
            <tr >
              <th colspan="3" align="center"><h2> Clientes dos Lotes do Produto Acabado-</h2></th>
            </tr>
</table>
<br>
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
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $tt_compras = 0;
	  $media_compr = 0;
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

            
                <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" ><?php echo(number_format($row['quantid'],0,',',''));
		                      $tt_compras = $tt_compras + $row['quantid'];
							  $media_compr++;
		   ?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_pedido']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $row['nome_cli']); ?></td>
           <td align="left"><?php echo ($row['rz_social']); ?></td>
              </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>
         <br><br>
            Quantidade Total da Quantidade: <?php echo($tt_compras); ?> <br> 
          <?php    
	}
		  ?>    
</form> 
</center>
</body>
</html>
