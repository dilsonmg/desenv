<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p2 = "";
if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1 = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1 = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}


if(isset($lote_fabr2)){
	if ($lote_fabr2 <> "" ){
			 $p2 = " and a.lote_fabricado like '%" . $lote_fabr2 ."%'" ; 
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

$habilit = "S";


//DATEDIFF(t.data_conserto,CURDATE())
	
 $rs32 = mysql_query("select a.cod_prod , b.descr_prod from tb_contraprov a
                      inner join tb_produto b on a.cod_prod = b.cod_prod 
                       group by descr_prod ");


					   
 $rs33 = mysql_query("select a.num_lote from tb_contraprov a where a.cod_prod = '".$cod_prod ."' and a.situacao = 'A'  order by id_contraprov desc");				
					   
 $fab = "";
 $venc = "";
 
$lm = "";					
$p01 = "";
$p1 = "";
$p2 = "";

if(isset($lt_fabr2)){
	$p01 = " and a.num_lote like '%" . $lt_fabr2 ."%'";
	
}

if(isset($pa_pesq)){
	$p2 = " and b.descr_prod like '%" . $pa_pesq ."%'";
	
}



 if (!isset($id)){

				   $rs33a = mysql_query("select a.*,b.descr_prod
										,DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
 										DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
										DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
										DATE_FORMAT(a.venci_retencao, '%d/%m/%Y') venci_retencao1
										from tb_contraprov a
										inner join tb_produto b on a.cod_prod = b.cod_prod
				    		where a.cod_prod ='".$cod_prod. "' and a.num_lote = '" .$num_lote .
							"' and a.situacao = 'A' group by a.cod_prod, a.num_lote");				  	
                    $row33a = mysql_fetch_assoc($rs33a);

					$data_fabr  = $row33a['data_fabr1'];
					$data_venc =  $row33a['data_venc1'];
					$venci_retencao =  $row33a['venci_retencao1'];
					$localizacao =  $row33a['localizacao'];
					$data_descart =  $row33a['data_descart'];
					$observ =  $row33a['observ'];
					$situacao =  $row33a['situacao'];
					$quantidade =  $row33a['quantidade'];
					$unidade =  $row33a['unidade'];
					
					$p1 = " and a.cod_prod = '".$cod_prod . "'";                        
 }
    	
$habilia = 0;

if (isset($id)){
    //$habilita = 1;
	
    $rs1 = mysql_query("select a.*
										,DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
 										DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
										DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
										DATE_FORMAT(a.venci_retencao, '%d/%m/%Y') venci_retencao1
										from tb_contraprov a
                       where a.id_contraprov  = '". $id ."' and a.situacao = 'A' ");
	
    $a = mysql_num_rows($rs1);
    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
					$data_fabr  = $row33a['data_fabr1'];
					$data_venc =  $row33a['data_venc1'];
					$venci_retencao =  $row33a['venci_retencao1'];
					$localizacao =  $row33a['localizacao'];
					$data_descart =  $row33a['data_descart'];
					$observ =  $row33a['observ'];
					$situacao =  $row33a['situacao'];
					$quantidade =  $row33a['quantidade'];
					$unidade =  $row33a['unidade'];
                    $num_lote = $row33a['num_lote'];
					$cod_prod = $row33a['cod_prod'];					
					
					$p1 = " and a.cod_prod = '".$cod_prod . "' and a.num_lote = '" . $num_lote . "'";                        
        
//dias_saida serve para bloquear o botoes de gravar e excluir.
//$data_saida    = strftime("%d/%m/%Y", strtotime($row1['data_saida']));
		 
/* 			  
		  $rs33 = mysql_query("SELECT a.* , if(a.sald_lote is null,a.tt_entradalote,a.sald_lote) tt_lote
                      FROM tv_ttsaidalote a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");				

 
		  echo("select a.num_lote from tb_contraprov a where a.cod_prod = '".$cod_prod .
		  "' and a.num_lote = '". $num_lote ."' and a.situacao = 'A' ");
*/		   

		  $rs33 = mysql_query ("select a.num_lote from tb_contraprov a where a.id_contraprov > 0 ".$p1 ." and a.situacao = 'A'  ");
		 //  $row33a = mysql_fetch_assoc($rs33);
 
          // $lm = "N"; 
		  
		//  echo($num_lote);
		  
	  }	  
 }

if($cod_prod == ""){$p1 = "";}

 $rs2 = mysql_query("select a.*,b.descr_prod
					,DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
					 DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_venc1,
					 DATE_FORMAT(a.data_fabr, '%d/%m/%Y') data_fabr1,
					 DATE_FORMAT(a.venci_retencao, '%d/%m/%Y') venci_retencao1
					from tb_contraprov a
					inner join tb_produto b on a.cod_prod = b.cod_prod " . $p2 . 
					"where a.id_contraprov > 0 " . $p1 . $p01 ."  and a.situacao = 'A' order by a.data_fabr desc");				  
    $b = mysql_num_rows($rs2);
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
	<title>MATCPE001 - CONTRAPROVA PRODUTO ACABADO</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
//if (window.opener && !window.opener.closed) {
//			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.cod_prod.value = '';
		  document.form1.num_lote.value = '';
   	   	  document.form1.action="matcp001.php";
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
        <th align="center" ><h1>Contraprova - Produtos Acabados- 
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      
</table>
<table width="95%" border="0">
      
      <tr>
        <th colspan="2" align="right">Produto</th>
        <th colspan="2" align="left"><select name="cod_prod" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
            <option value="">Selecione o produto</option>
            <?php while($row32=mysql_fetch_assoc($rs32)){ ?>
            <option value="<?php print($row32['cod_prod'])?>"
				  <? if($row32['cod_prod'] == $cod_prod ) {?>selected <? } ?>				
				 ><?php print($row32['descr_prod'] . " - " . $row32['cod_prod'] )?></option>
            <?php }?>
        </select></th>
        <th align="right">Lote</th>
        <th align="left">
        
<input type=hidden name="lm" value="<?php echo($lm); ?>">

<?php 
//  
//		
      if ($lm == "") { ?>
        <select name="num_lote" style="font-size:10" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
         <option value="" >Selecione o Lote</option>
          <?php while($row33=mysql_fetch_assoc($rs33) ){?>
          <option value="<?php print($row33['num_lote'])?>"
				  <?php if($row33['num_lote'] == $num_lote ) {?>selected <? } ?>  ><?php print($row33['num_lote']);?></option>
          <?php }?>
        </select>
        <?php 
	}
		else{
		    ?><input type="text" name="num_lote" value="<?php echo($num_lote);?>" disabled> <?php 
		}
		 ?>
        </th>
      </tr>
      <tr>
        <th colspan="2" align="right">Fabricacao.</th>
        <th align="left"><input type="text" name="data_fabr" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999"  readonly 
        value="<?php echo ($data_fabr); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_fabr);" onChange="verifica_data(this.value,data_saida);"/></th>
        <th align="right">Vencimento.</th>
        <th align="left"><input type="text" name="data_venc" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" readonly        value="<?php echo ($data_venc); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_venc);" onChange="verifica_data(this.value,data_saida);"/></th>
        <th align="left">Retencao
          <input type="text" name="venci_retencao" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999"  readonly 
        value="<?php echo ($venci_retencao); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,venci_retencao1);" onChange="verifica_data(this.value,data_saida);"/></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Quantidade</th>
        <th align="left"><input type="text" id = "quantidade"  name="quantid_said"  maxlength="10" size="10" placeholder="informe a Quantidade"  value="<?php echo($quantidade); ?>" ></th>
        <th align="right">Unidade</th>
        <th align="left"><input type="text" id = "unidade"  name="unidade"  maxlength="10" size="10" placeholder="informe a unidade"  value="<?php echo($unidade); ?>" ></th>
        <th align="left"></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Localizacao</th>
        <th colspan="4" align="left"><input type="text" id = "localizacao"  name="localizacao"  maxlength="100" size="110" placeholder="informe a localizacao !"  value="<?php echo($localizacao); ?>"></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Situacao</th>
        <th align="left"><select name="situacao">
          <option value="">Selecione a situacao</option>
          <option value="A" <?php if($situacao == 'A' ) {echo("selected");}?>>Arquivado</option>
          <option value="D" <?php if($situacao == 'D' ) {echo("selected");}?>>Descartado</option>
          
        </select></th>
        <th align="left">Data descarte</th>
        <th align="left"><input type="text" name="data_descart" size="8" maxlength="10"  placeholder="Informe no formato 99/99/9999" 
        value="<?php echo ($data_descart); ?>" title="Informe no Formato 99/99/9999" onKeyPress="mascara(this)" onBlur="verifica_data(this.value,data_descart);" onChange="verifica_data(this.value,data_descart);"/></th>
        <th align="left"></th>
      </tr>
      <tr>
        <th colspan="2" align="right">Observacao</th>
        <th colspan="4" align="left"><input type="text" id = "observ"  name="observ"  maxlength="100" size="110" placeholder="informe a observacao !"  value="<?php echo($observ); ?>"></th>
      </tr>
      <tr>
        <th colspan="7" align="center">
          <input type="button" name="gravar"  onClick="validacontrprv();" value="Gravar" style="font:color="#006600"-size:8" />
          <input type="button" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" >
          <input type="button" name="Submit4"  onclick="excluircontrprv()(<?php echo($id); ?>);" value="Excluir" style="font:color="#006600"-size:8" />
          <input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <th colspan="7" align="center"  bgcolor="#8080FF">Registros Arquivados</th>
            </tr>
            <tr >
              <th colspan="7" align="center">P.A
                <input type="text" name="pa_pesq" id="pa_pesq" maxlenght="50" size=50 /> 
              </h1>Lote Fabricado 
              <input type="text" id = "lt_fabr2"  name="lt_fabr2"  maxlength="45" size="42" placeholder="informe o lote !"  value="">
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td colspan="7" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th  >Produto Acabado</th>
                  <th >N. Lote</th>
                  <th>Fabricacao</th>
                  <th>Vencimento</th>
                  <th>Venc. Retencao</th>
                  <th >Localizacao</th>
                  <th >Situacao</th>
                  <th >Quantidade</th>
                  <th >Unidade</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td >
           <a href="matcp001.php?id=<?php echo ($row['id_contraprov']);?>"><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></a></td>

           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center" ><?php echo($row['data_fabr1']);?></td>
           <td align="center" ><?php echo($row['data_venc1']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($row['venci_retencao'])));?></td>
           <td align="left" ><?php echo ($row['localizacao']);?></td>
           <td align="center" ><?php if($row['situacao'] == 'A') {echo ("Arquivado");}?></td>
           <td align="center"><?php echo (number_format($row['quantidade'],3,",","")); ?></td>
           <td align="center"><?php echo ($row['unidade']);?></td>
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
