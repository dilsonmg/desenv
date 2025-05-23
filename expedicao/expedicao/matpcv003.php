5<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();


$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p41 = "";
$m_tela = "";


if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }
		 
		 $m_tela = "S";
		 }


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
	 }
	 		 $m_tela = "S";

}


if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p3 = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
		 }
		 		 $m_tela = "S";

		 }

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p4 = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 }
		 		 $m_tela = "S";
}

if (isset($motivop)){
	if ($motivop <> "" ){
		 $p41 = " and a.motivo = '" . $motivop ."'" ; 
		 }
		 		 $m_tela = "S";

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

$habilit = "S";


//DATEDIFF(t.data_conserto,CURDATE())
/*

abc - de saidas

select a.cod_prod, b.descr_prod, sum(a.quantid_said) tt_saida, a.unidade, a.motivo
  from tb_saidmatp a
inner join tb_produto b on a.cod_prod = b.cod_prod
group by a.cod_prod, a.motivo
order by tt_saida desc

*/
$b=0;
if ( $m_tela == "S" ){

 $rs2 = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
                    ,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
                     DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc, c.atv_kamoran
 FROM tb_saidmatp a
     inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote	  
	  where a.id_saidmat > 0 " . $p2 . $p3 .$p4 .$p41 ."	
	  group by a.cod_prod, a.num_lote,a.quantid_said , a.data_saida ,a.lote_fabricado
	 order by a.data_saida desc ");				  
    $b = mysql_num_rows($rs2);
}
 $rs32 = mysql_query("select a.* from tb_produto a order by a.descr_prod ");

 $rs33 = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
                      FROM tv_ttsaidalote a where  a.cod_prod ='".$cod_prod."'");				
					  
 
 $fab = "";
 $venc = "";
 
$lm = "";					
 if (!isset($id)){
					
				   $rs33a = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
                            , DATE_FORMAT(b.data_fab, '%d/%m/%Y') data_fab,
							DATE_FORMAT(b.data_venc, '%d/%m/%Y') data_venc
							FROM tv_ttsaidalote a
							inner join tb_entmatp b on b.cod_prod = a.cod_prod and b.num_lote = a.num_lote
				    		where a.cod_prod ='".$cod_prod. "' and a.num_lote = '" .$num_lote ."' group by a.cod_prod, a.num_lote");				  	
                    $row33a = mysql_fetch_assoc($rs33a);
					$sald_lote = $row33a['sald_lote'];	
					if ($sald_lote == NULL) { $sald_lote = $row33a['tt_entradalote']; 
					    $fab  = "Fabricação :" .$row33a['data_fab'];
						$venc = "Vencimento :" .$row33a['data_venc'];
										
					}
                        
 }
    	
$habilia = 0;

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* ,  DATE_FORMAT(b.data_fab, '%d/%m/%Y') data_fab,
                       DATE_FORMAT(b.data_venc, '%d/%m/%Y') data_venc 	
					   FROM tb_saidmatp a
                       inner join tb_entmatp b on b.cod_prod = a.cod_prod and b.num_lote = a.num_lote
                       where a.id_saidmat =". $id);
	
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $fab  = "Fabricação :" .$row33a['data_fab'];
	    $venc = "Vencimento :" .$row33a['data_venc'];
        $habilit = "N";
        $rs1 = mysql_query("SELECT a.*,DATEDIFF(CURDATE(),a.data_saida)dias_saida FROM tb_saidmatp a where a.id_saidmat =". $id);
     	$row1 = mysql_fetch_assoc($rs1);
//dias_saida serve para bloquear o botoes de gravar e excluir.
	     $data_saida    = strftime("%d/%m/%Y", strtotime($row1['data_saida']));
		 
		 $id_saidmat       = $id;
		 $cod_prod         = $row1['cod_prod'];
		 $num_lote         = $row1['num_lote'];
		 //$data_saida       = $row1['data_saida'];
		 $quantid_said     = $row1['quantid_said'];
		 $lote_fabricado   = $row1['lote_fabricado'];
		 $saldo_anterior   = $row1['saldo_anterior'];
         $unidade          = $row1['unidade'];
		 
		 
		 			  
		  $rs33 = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
                      FROM tv_ttsaidalote a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");				

           $row33a = mysql_fetch_assoc($rs33);
    			
		   $fab  = "Fabricação :" .$row33a['data_fab'];
		   $venc = "Vencimento :" .$row33a['data_venc'];
		   $sald_lote = $row33a['tt_lote'];	
           $lm = "N"; 

	  }
	  

	  
 }
$tt_said = 0;

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
	<title>MATPCV003 - REGISTRO DE SAIDAS DE MATERIAS PRIMAS</title>
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
        <th  align="center"><h1>Consulta Sa&iacute;das de Mat&eacute;rias Primas <?php // echo($hoje); ?></h1></th>

        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
</table>
<table width="95%" border="0">

            <tr >
              <th colspan="3" align="left">
                M.Prima
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=40 /> 
              </h1>Lote Fabricado 
              <input type="text" id = "lote_fabr2"  name="lote_fabr2"  maxlength="45" size="32" placeholder="informe o lote !"  value="">
               Saida de
               <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
Motivo  <select name="motivop" >
          <option value="" >Selecione o Motivo</option>
          <option value="1"<?php if($motivop == 1 ) {?> selected <?php }?>> Producão </option>
		  <option value="2"<?php if($motivop == 2 ) {?> selected <?php }?>> Perda </option>
		  <option value="3"<?php if($motivop == 3 ) {?> selected <?php }?>> Outros </option>
        </select>
<input name="Pesquisar" type="submit" value="Pesquisar">
              <input type="button" onClick="sair();" value="Sair"></th>
            </tr>
            <tr align="center">
              <td colspan="3" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Mat&eacute;ria Prima</th>
                  <th >N. Lote</th>
                  <th>% Ativo</th>
                  <th>Dt. Sa&iacute;da</th>
                  <th >Sd. Anterior</th>
                  <th >Qtd. Utilizada</th>
                  <th >Unidade</th>
                  <th >Saldo Atual</th>
                  <th >Lote Fabricado</th>
                  <th >Motivo</th>
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
                <td >
           <?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="right" ><?php echo ($row['atv_kamoran']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['data_saida'])));?></td>
           <td align="right" ><?php 
		   
			  if ($msk == "S") {
				      echo (number_format($row['saldo_anterior'],3,',','.'));
				  }else{
				      echo (number_format($row['saldo_anterior'],0,'',''));					  
				  }			 
	//	   echo (number_format($row['saldo_anterior'],3,",",""));		  
		   
		   
		   ?></td>
           <td align="right" ><?php 
		     $tt_said = $tt_said + $row['quantid_said'];
		  
			  if ($msk == "S") {
				      echo (number_format($row['quantid_said'],3,',','.'));
				  }else{
				      echo (number_format($row['quantid_said'],0,'',''));					  
				  }			 
		   ?></td>
           <td align="center" ><?php echo ($row['unidade']);?></td>
           <td align="right"><?php
		   if ($msk == "S") {
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",",""));
				  }else{
				      echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),0,"",""));					  
				  }
		   
		    //echo (number_format(($row['saldo_anterior'] - $row['quantid_said']),3,",","")); 
			
			?></td>
           <td align="left"><?php echo ($row['lote_fabricado'] . ' - ' );
		   
		   
				   $rs333a = mysql_query("SELECT ax.descr_prod descr_ltfabr FROM tv_lotefabric ax where ax.lote_fabricado =  '". $row['lote_fabricado'] . "'");	
						
										  	
                    $row333a = mysql_fetch_assoc($rs333a);
					$descr_lotefabric  = $row333a['descr_ltfabr'];	
		            echo($descr_lotefabric);
		   
		   ?></td>
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
              </tr>
          <?php 
		   } ?>
		    
                 <tr>
                <td colspan="5"  align="right">Total de Sa&iacute;da</td>
                <td align="right" >
                 <?php
			  
			  if ($msk == "S") {
				      echo (number_format($tt_said,3,',','.'));
				  }else{
				      echo (number_format($tt_said,0,'',''));					  
				  }
		    ?>
                </td>
                <td align="center" >&nbsp;</td>
                <td align="right">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr> 
		<?php   
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
