<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$num_lote = $_GET ["num_lote"];

$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}
$sr='';
if ($num_lote != ""){
	$lote_fabr2 = $num_lote; 
	$p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
	$sr = "N";
}else{
	if(isset($lote_fabr2)){
		if ($lote_fabr2 <> "" ){
				 $p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
		 }
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

if ($p1 != "" || $p2 != ""){
	 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
						,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
						 DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc,d.rz_social
	 FROM tb_saidmatp a
		 inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
		  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
		  left outer join tb_fornecedor d on c.cod_fornec = d.cod_fornec
		  where a.id_saidmat > 0 " . $p2 . "	
		  group by a.cod_prod, a.num_lote,a.quantid_said , a.data_saida ,a.lote_fabricado
		 order by a.cod_prod,a.data_saida desc ");				  
		$b = mysql_num_rows($rs2);
}
	if ($m_primapesq != "" or $lote_fabr2 != ""){ $habilit = "S" ;}
			  
 
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
	<title>MATRT000 - Rastreamento por Lote Fabricado</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
*/

function ver_recebimento(app)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
}

function ver_aditivo(app)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
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

<table width="99%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th ><h1>Rastreamento por Lote Fabricado- 
      
			   		 <a href="javascript:ver_aditivo('docto01e4.php?num_lote=<?php echo ($lote_fabr2);?>');"><?php echo ($lote_fabr2);?></a>
                     
                     
                     <?php 
					    $atv_kamo = '';
					    if ($lote_fabr2 != ""){
							$rs33x = mysql_query("SELECT * FROM tv_atvkamoran a where a.lote_fabricado = '".$lote_fabr2  ."' ");				  	
    	                    $row1x = mysql_fetch_assoc($rs33x);
							$atv_kamo = $row1x['atv_kamoran'];
							echo("    % ativo: " . $atv_kamo);
						}
						
						
						
                         
					 	 
				?>		 
						 
		
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
        <th colspan="3" align="center">Lote Fabricado
<input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="">
        <input name="Pesquisar" type="submit" value="Pesquisar">
        <?php if ($sr == ""){ ?>
             <input type="button" onClick="sair();" value="Sair">
        <?php }else { ?>
             <input type="button" onClick="self.close();" value="Sair">
        <?php } ?>
             </th>
      </tr>
<?php
	if ($habilit == "S"  and $b >0){
//busca os dados do lote fabricado
	  
	  
$rs200 = mysql_query("SELECT a.*,b.descr_prod,c.nome_cli 
                    ,DATE_FORMAT(a.data_nf, '%d/%m/%Y') dt_nf
					,d.rz_social
      FROM tb_saidaprodac a
      inner join tb_produto b on b.cod_prod = a.cod_prod 
	  inner join tb_cliente c on c.codigo_cli = a.codigo_cli
	  left outer  join tb_fornecedor d on d.cod_fornec = a.cod_fornec
	  where a.id_saidaprodac > 0  and a.num_lote = '".$lote_fabr2 ."'	
	  order by num_nf desc limit 300 ");		 		  

			 
					 
$rs33 = mysql_query("SELECT a.*,b.descr_prod,DATE_FORMAT(a.data_prevlib, '%d/%m/%Y') data_prevlib2  FROM tb_entprodac a
 					 inner join tb_produto b on b.cod_prod = a.cod_prod
					 where a.data_liblote is not null and a.num_lote = '".$lote_fabr2  ."' ");				  	
    	 $row1 = mysql_fetch_assoc($rs33);


	     $data_prevlib    = strftime("%d/%m/%Y", strtotime($row1['data_prevlib']));
	     $data_liblote    = strftime("%d/%m/%Y", strtotime($row1['data_liblote'])); 
		 $id_entprodac     = $id;
		 $cod_prod         = $row1['cod_prod'];
		 $descr_prod       = $row1['descr_prod'];
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
         $resultado6       = $row1['resultado6'];
         $resultado7       = $row1['resultado7'];
         $resultado8       = $row1['resultado8'];
         $resultado9       = $row1['resultado9'];
         $resultado10       = $row1['resultado10'];
         $resultado11      = $row1['resultado11'];

		 $rs340 = mysql_query("SELECT * FROM tb_limitprod where cod_prod = '".$cod_prod ."'");
         $lm    = mysql_num_rows($rs340);					  

?>

      <tr>
        <th colspan="3" align="center"  bgcolor="#8080FF">Dados da Saida</th>
      </tr>
            <tr >
              <th colspan="4" align="center"><h2> Materias Primas Usadas na Fabrica&ccedil;&atilde;o</h2></th>
            </tr>
            <tr >
              <th colspan="4" align="center">&nbsp;</th>
            </tr>
            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Fornecedor</th>
                  <th  >Mat&eacute;ria Prima</th>
                  <th >N. Lote M.Prima</th>
                  <th>Data Fab.</th>
                  <th>Data Venc</th>
                  <th>Data Sa&iacute;da</th>
                  <th >Qtd. Utilizada</th>
                  <th >Unidade</th>
                  <th >Motivo</th>
                  <th >Lote Fabricado</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
	  
	   $msk = "S";
		 if(strtoupper($row['unidade']) != "KG"){
						 $msk = "N";
		 }
	  
	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                
             <td align="left"><?php echo ($row['rz_social']);?></td>           
          <td >
		   <a href="javascript:ver_aditivo('fornec_prod.php?cd_prod=<?php echo ($row['cod_prod']); ?>');"><?php echo($row['cod_prod'] ); ?></a>

		  <?php echo ( " - " . $row['descr_prod']);?></td>

           <td align="right">
		   		 <a href="javascript:ver_aditivo('docto01e4.php?num_lote=<?php echo ($row['num_lote']);?>');"><?php echo ($row['num_lote']);?></a>

	
           
           
           </td>
           <td align="center" ><?php echo($row['data_fab']);?></td>
           <td align="center" ><?php echo($row['data_venc']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_saida'])));?></td>
           <td align="right" >
		     <?php
			  if ($msk == "S") {
				      echo (number_format($row['quantid_said'],3,',','.'));
				  }else{
				      echo (number_format($row['quantid_said'],0,'',''));					  
				  }
               ?>
           
           </td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center">
           <?php 
	 	
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
	 ?>
           </td>
           <td align="center"><?php echo ($row['lote_fabricado']);?></td>
           </tr>
          <?php 
		   } 
	     }
		 ?>
		 </table>
   <br>      
         <table border="0" width="80%" >
         
         <tr>
        <th align="left">Produto 
</th>        <th align="left"><h2><?php echo($descr_prod); ?></h2></th>
<th align="left">Lote</th>
<th align="left"><h2><?php echo($lote_fabr2);?></h2></th>
         </tr>
      <tr>
        <th align="left">Fabrica&ccedil;&atilde;o</th>
        <th align="left"><?php echo($data_fabr); ?></th>
        <th align="right">Vencimento</th>
        <th align="left"><?php echo($data_venc); ?></th>
      </tr>
      <tr>
        <th align="left">Qtd. Fabricada</th>
        <th align="left"><?php echo($quant_fabr); ?></th>
        <th align="right">Embalagem</th>
        <th align="left"><?php echo($embalagem); ?></th>
      </tr>
      <tr>
        <th colspan="4" align="center" bgcolor="#8080FF">Dados Para a Liberacao</th>
      </tr>
      <tr>
        <th align="right">Data da Libera&ccedil;&atilde;o</th>
        <th colspan="3" align="left"><?php echo ($data_liblote); ?> </th>
        </tr>
      <tr>
        <td colspan="4" align="center"><h3>Certificado de An&aacute;lise</h3></td>
      </tr>
      <tr>
        <th colspan="4" align="center"><table width="95%" border="0">
          <tr bgcolor="#8080FF">
            <td align="center">An&aacute;lise</td>
            <td align="center">Resultados</td>
            <td align="center">Limites</td>
          </tr>
          
               <?php
//echo($b);
	 if ($lm > 0){
       $bg = 0;
	  $li = 0;
	  while($row=mysql_fetch_array($rs340)){ 
	  $li++;
	  $var_result = "resultado".$li;
	  if($$var_result != '') {
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
    	   echo('<tr ' . $bgc .'>');?>
                <td><?php echo ($row['descr_analise']); ?> </td>
		        <td align="center">
                <input type="text" id = "resultado<?php echo ($li);?>" required name="resultado<?php echo ($li);?>"  maxlength="45" size="45" placeholder="informe o Resultado"  value="<?php echo($$var_result); ?>" >
                </td>
                <td><?php echo ($row['limite_analise']); ?></td>
               </tr>
          <?php } 
	  }
	   }
	?>
          
        </table></th>
      </tr>

</table>
            <br> <h2>Clientes do Lote - <?php echo($lote_fabr2);?></h2>     
         <table border="1" width="98%" >
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
   /////
     $tt_caixa = 0;
   	  while($row=mysql_fetch_array($rs200)){ 
	    $tt_caixa = $tt_caixa + $row['quantid'];
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(strftime("%d/%m/%Y", strtotime($row['data_fatura'])));?></td>
           <td align="right" ><?php echo(number_format($row['quantid'],0,',',''));?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="center" ><?php echo ($row['num_pedido']);?></td>
           <td align="center" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_nf'])));?></td>
           <td align="left"><?php echo ($row['codigo_cli'] ." - " . $row['nome_cli']); ?></td>
           <td align="left"><?php echo ($row['rz_social']); ?></td>
              </tr>
          <?php 
		   $unida_p = $row['unidade'];
		   } 
		  ?>  
           <tr>
                <td colspan="4"align="right">
				<?php    echo (" Total de Saidas...............:" .$tt_caixa);   ?>
                </td>
                <td align="center" ><?php    echo ($unida_p);   ?></td>
                <td colspan="5" align="left" >&nbsp;</td>
            </tr>    
         </table>
     <?php
           
	}
		  ?>    
      </th></tr>  
         </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
