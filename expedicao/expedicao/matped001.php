<Meta http-equiv="refresh" content="20" />
<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p100 = "";
$p101 = "";
$p200 = "";
$p201 = "";
$p300 = "";

$p2 = "";

if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p1 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p2 = " and a.descr_prod like '%" . $mprimaps ."%'" ; }
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
$data_saida = $hoje; 
$dt1=explode("/",$data_saida);
$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())

$rs20 = mysql_query("select b.cod_prod, a.descr_prod, a.num_lote, sum(a.tt_lote) tt_lote, b.embalagem
                    ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote
                    from tv_saldoltprac a
                    inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
					where a.cod_prod > 0 "  . $p1 . $p2 . " and a.tt_lote > 0 
                    group by a.cod_prod, a.num_lote
					order by a.cod_prod, a.num_lote asc");		 	
					
					
$rs2 = mysql_query("select b.cod_prod, a.descr_prod, a.num_lote, sum(a.tt_lote) tt_lote, b.embalagem
                    ,DATE_FORMAT(b.data_liblote, '%d/%m/%Y') data_liblote
                    ,b.data_fabr,b.data_venc,DATEDIFF(str_to_date(b.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer
					from tv_saldoltprac a
                    inner join tb_entprodac b on a.cod_prod = b.cod_prod and a.num_lote = b.num_lote
					where a.cod_prod > 0 "  . $p1 . $p2 . " and a.tt_lote > 0 
                    group by a.cod_prod, a.num_lote
					order by a.cod_prod, a.num_lote asc");	
					
					
$row33a = mysql_fetch_assoc($rs20);
$cd_prodini = $row33a['cod_prod'];					
	 
$b = mysql_num_rows($rs2);

/*
SELECT a.*,b.descr_prod FROM tb_peddia a
inner join tb_produto b on a.cod_prod = b.cod_prod
order by a.data_ped desc, a.id_peddia desc

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
	<title>MATPED001 - SAIDA DE PRODUTOS ACABADOS POR LOTE</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}


function gravar1(cod,lot,quant,ttdv) {
	
	var qtdinf = document.form1.quantid[quant].value;
	
	/*
	alert("entrou");
	alert(cod);
	alert(lot);
	alert(qtdinf);
	alert(ttdv);
	*/
	
	
	if(eval(ttdv) < eval(qtdinf) || qtdinf <= 0) { alert("A quantidade de Saida e maior que a quantidade disponivel para venda deste lote ou o valor e menor que zero!");
	  return false;
	 }
    
	document.form1.action='matpedgr1.php?cod_prod='+cod+"&num_lote="+lot+"&quantid="+qtdinf;
	document.form1.submit();  
	return true;
	
}
function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
		  document.form1.codigo_cli.value = '';
   	   	  document.form1.action="matped001.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input type="hidden" name="saldo_anterior" value="<?php echo($sald_lote);?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center" >
        <h2>Previs&atilde;o de Saidas de Produtos Acabados por Lote-   </h2>
              <?php
	echo($_SESSION['id_entmatp']);
		  ?>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
        <?php echo($hoje); ?>
      </tr>
</table>
<table width="95%" border="0">
      
         <tr>
        <th colspan="3" align="center">Produto
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" ></th>
      </tr>
            <tr >
              <th colspan="4" align="center">
               <input type="submit"  name="gravar"   value="Filtrar" style="font:color="#006600"-size:8" />
              <input type="button" onClick="sair();" value="Sair"></th>
            </tr>
        
            <tr align="center">
              <td colspan="4" align="center">
              <table width="90%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto</th>
                  <th  >Grupo</th>
                  <th >N. Lote</th>
                  <th>Saldo Inicial</th>
                  <th>Libera&ccedil;&atilde;o</th>
                  <th>Fabrica&ccedil;&atilde;o</th>
                  <th>Vencimento</th>
                  <th>Qtd. Lib Venda</th>
                  <th>Qtd Pedido</th>
                  <th>A&ccedil;&atilde;o</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  $tot_prod = 0.00;
	  $qt=0;
	  while($row=mysql_fetch_array($rs2)){ 
         if ($row['cod_prod'] != $cd_prodini ){  ?>
                <tr bgcolor="#E1E1FF">
                  <td colspan="3" align="right" bgcolor="#E1E1FF">T O T A L  .</td>
                  <td align="center"  ><b><?php echo ($tot_prod);?></b></td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                </tr>
          <?php 
		       $cd_prodini = $row['cod_prod'] ;
			   $tot_prod = 0.00;
			}
	
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

        
                <tr>
                  <td >
           <a href="matped001.php?id=<?php echo ($row['id_saidaprodac']);?>"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>
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
				case 32:
					echo "Elanco";
					break;
				case 70:
					echo "Natrucan";
					break;
				case 10:
					echo "Antiespumante";
					break;
		
}
			
			?></td>
           <td align="center"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo(number_format($row['tt_lote'],0,',',''). " " . $row['embalagem']);?></td>
           <td align="center" >
		   <?php 
		            if ($row['data_liblote'] == ""){
						echo("<font color='#FF0000'>Não Liberado !</font>"); }
					else{
						echo($row['data_liblote']);}?>
		   </td>
           <td align="center" ><?php echo($row['data_fabr']);?></td>
           <td align="center" ><?php echo($row['data_venc']);?>
            <?php 
			
			 if($row['dias_avencer'] <= 180 and $row['dias_avencer'] > 0 ) {
		      	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>');
			 }
			 if($row['dias_avencer'] < 0  ) {
		      	echo ('<b><font color="red"> - Vencido a  ' . $row['dias_avencer'].' dias </font>');
			 }


			?>

           </td>
           <td align="center" ><font size="3"><?php 
		   
		   $rscv =  mysql_query("SELECT sum(a.quantid) ttquantid from tb_peddia a where a.cod_prod =".$row['cod_prod'] . " and a.num_lote = '". $row['num_lote'] .
           "' and a.data_ped = '" .$data_ped . "'");
		   
    $b = mysql_num_rows($rscv);
           $tt_lote = $row['tt_lote'];
		   if($b > 0){ 
		       $row33a = mysql_fetch_assoc($rscv);
     		   $tt_lote = $tt_lote - $row33a['ttquantid'];
		   }
		   echo(number_format($tt_lote,0,',',''). " " . $row['embalagem']);?>
           </font>
           </td>
           <td align="center" ><input type="text" name="quantid" value="" size="10" maxlength="10" align="right"  ></td>
           <td align="center" >        
           <input type="button" value="Gravar" onclick="gravar1('<?php echo($row['cod_prod']."','".$row['num_lote'] ."','".$qt."','".number_format($tt_lote,0,',','')."'") ?>);">
           <!--
           a href="javascript:void(0)" onclick="gravar1('<?php echo($row['cod_prod']."','".$row['num_lote'] ."','".$qt."','".number_format($tt_lote,0,',','')."'") ?>);">
           Gravar</a-->
           </td>
   <?php 
   $qt++;
   	   } 
	     }
		  ?>
                <tr bgcolor="#E1E1FF">
                  <td colspan="3" align="right" bgcolor="#E1E1FF">T O T A L  .</td>
                  <td align="center"  ><b><?php echo ($tot_prod);?></b></td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                  <td align="center" >&nbsp;</td>
                </tr>

          </table>
              
         </td>
         </tr>
           
    </table>     
</form> 
</center>
</body>
</html>
