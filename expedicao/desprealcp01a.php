<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

<?php
session_start();
$anodf = date("Y");

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


$p01 = "";
$p1 = "";
$p01x = "";

$p02 = "";
$p02a = "";

$p2 = "";
$p3 = "";
$p4 = "";
$p4a = "";
$p4b = "";

$p5 = "";
$p6 = "";
$p7 = "";
$p8 = "";
$p11 = "";
$p12 = "";
$p13 = "";
$p14 = "";

$p12 = "";
$p13 = "";
$p14y = "";			
$p3e = "";
	 
if(isset($linha_desp) ){
	if ($linha_desp <> "" ){
  		  $linha_desp = str_replace("'", "", $linha_desp);	
  		  $p01x = " and c.id_grupocusto = '" . $linha_desp ."' ";
 		  $p3e = " and c.id_grupocusto = '" . $linha_desp ."' ";
	}
}

	 
if(isset($codigo2) && $codigo2 > 0 ){
    $codigo2 = str_replace("'", "", $codigo2);	
    $p01 = " and a.cod_sidespreal in(" . $codigo2 .") ";
}

		 
if (isset($descricao2)){
	if ($descricao2 <> "" ){
		 $descricao2 = str_replace("'", "", $descricao2);
		 $p02 = " and b.descr_despreal like '%" . $descricao2 ."%' " ; 
		 }}
  $p33 = "";
  $p34 = "";

$p1a="";
$p1b="";

$p2d="";
$p2e="";
			 
if(isset($ano_i) && $ano_i > 0 ){
	$anodf = $ano_i; }
$p1  = " and ano_custoreal = '" . $anodf ."' ";
$p1a = " and ano_prevdespr = '" . $anodf ."' ";
$p1b = " and a.ano_prevdespr = '" . $anodf ."' ";

if(isset($ano_r) && $ano_r > 0 ){
     $p1  = " and ano_custoreal = '" . $ano_r ."' ";
}
	
if($mes_i > 0){
	$p2 = " and mes_custoreal >= '" .$mes_i ."' ";
    $p2d = " and a.mes_prevdespr >= '" .$mes_i ."' ";
    $p2e = " and a.mes_prevdespr >= '" .$mes_i ."' ";

}
if($mes_f > 0){
	$p2 = $p2 . " and mes_custoreal <='" .$mes_f ."' ";
	
	$p2a = $p2 . " and mes_custoreal <='" .$mes_f ."' ";
    $p2e = $p2e." and a.mes_prevdespr <= '" .$mes_f ."' ";
}
	
    $cabec   = array();
	$header  = array();
	$header2  = array();
	$ttcol    = array();
	$tt_lin = array();
    $tt_linp[$i] =  array(); 
    $tt_linr[$i] =  array(); 

    $tot_prev = array();
    $tot_real = array();
    $tot_var  = array();
	
	$tot_perc = array();
		
	
	$resumo  = array();

     $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $ttcol[$i]    = ""; 
		 $tt_lin[$i]   = "";
		 $tot_prev[$i] = "";
		 $tot_real[$i] = "";
		 $tot_var[$i]  = "";
		 $tot_perc[$i]  = 0.00;
	          $tt_linp[$i] = ''; 
	          $tt_linr[$i] = ''; 
		 		 
     }
	 
	 $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $resumo[$i] = ""; 
     }
	
	$cabec[0] = "Codigo";
	$cabec[1] = "Despesa";	
	$cabec[2] = "Jan";
	$cabec[3] = "Fev";
	$cabec[4] = "Mar";
	$cabec[5] = "Abr";
	$cabec[6] = "Mai";
	$cabec[7] = "Jun";
	$cabec[8] = "Jul";
	$cabec[9] = "Ago";
	$cabec[10] = "Set";
	$cabec[11] = "Out";
	$cabec[12] = "Nov";
	$cabec[13] = "Dez";
	$cabec[14] = "Total";
	$cabec[15] = "Media";

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
   }else{
         echo("Você não esta logado !!");
              	header("Location: loginx.php"); 
         }
header("Content-Type: text/html; charset=ISO-8859-1",true);

include 'conectabco.php';
mysql_query("SET NAMES 'ISO-8859-1'");
mysql_query("SET character_set_connection=ISO-8859-1");
mysql_query("SET character_set_client=ISO-8859-1");
mysql_query("SET character_set_results=ISO-8859-1");

$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

$rs2a= mysql_query("SELECT a.* FROM tb_grupoccusto a order by a.descr_grupocc");

if ($p != 99){
	//$a = $_GET ["S"];
}
if(isset($_POST["botao"])){

				$rs2 = mysql_query("SELECT  a.*,b.descr_despreal,c.id_grupocusto,d.descr_grupocc,'P'  FROM tb_prevdespr a
 							inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
							inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal ".$p01x . "
							inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto
							where a.cod_sidespreal > 0 " .$p01 .$p1a .$p2e. " 
							group by a.ano_prevdespr,a.mes_prevdespr,a.cod_sidespreal
				    union all
				    SELECT a.id_custoreal,a.cod_sidespreal,a.mes_custoreal,a.ano_custoreal,a.val_custoreal
					        ,b.descr_despreal,c.id_grupocusto,d.descr_grupocc, 'R' FROM tb_custoreal a
							inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
							inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal ".$p01x . "
							inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto
							where a.cod_sidespreal > 0 " .$p01 .$p1 .$p2 . "
							group by a.ano_custoreal,a.mes_custoreal,a.cod_sidespreal
							order by 7,2,9,3,4 ");
							
         ///////// query do grafico ////////////////
				
		 
		 $rs20 = mysql_query("SELECT  a.mes_prevdespr,sum(a.val_prevdespr) tot_prev,sum(val_custoreal) tot_real,
        					(sum(a.val_prevdespr) - sum(val_custoreal)) tot_vari,c.id_grupocusto,d.descr_grupocc
							 FROM tb_prevdespr a
								inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
										inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal"  .$p3e . "
										inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto 
								left outer join tb_custoreal e on e.cod_sidespreal = a.cod_sidespreal
										and e.mes_custoreal = a.mes_prevdespr
										and e.ano_custoreal = a.ano_prevdespr
								where a.mes_prevdespr > 0 and a.ano_prevdespr = '" .$anodf . "'" .$p01 . $p2d . $p2e . 
									  "	group by a.ano_prevdespr,a.mes_prevdespr ,c.id_grupocusto");
									  
		
		 //////////////////////////////////////////							
							

}


  if($_GET ["P"] == 99){
	  
	  $a="";
	  
  }
$hoje = date("d/m/Y");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/qreal.css">
<link rel="stylesheet" href="../css/qreal2.css">

<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" / -->
 <title>desprealc001 - Consulta despesas realizadas por ano</title>
<script type='text/javascript' src="funcoesexped.js"   charset="ISO-8859-1"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type='text/javascript'>

<!--
function fechar1(){
	window.opener = window
 	window.close("#")
}

function ver_desp(app)
{
		
	//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
	var janela;
	janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=800,status=yes,height=350"); 
	
	//janela.captureEvents(Event.RESIZE);
	//janela.onresize=informar;
}
 function expand() {  
	
	 for(x = 0; x < 50; x++) {  
		 window.moveTo(screen.availWidth * -(x - 1) / 100, screen.availHeight * -(x - 1) / 90);  
		 window.resizeTo(screen.availWidth * x / 1, screen.availHeight * x / 1);  
	 }
 }
 -->
 
 </script>

<style type="text/css"></style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<!--body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'-->
<body>
<META content="text/css" http-equiv="Content-Style-Type">
<link rel="stylesheet" href="../css/qreal.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php echo( $_SESSION['nome_usu']); ?>
<form name="form1" method="post" enctype="multipart/form-data"> 

<input type="hidden" name="monen_res" value="-1" />

<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>Despesas Realizadas- Ano de Referencia : <?php echo($anodf); ?> - <?php echo($data_1); ?> a <?php echo($ano_r); ?>  </h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><a href="menu_custo.php"><img src="../images/back_f2.png" width="32" height="32" border="0" alt="Voltar ao menu" /></a>
        <br /> <?php echo($hoje);?><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a></th>
      </tr>
      </table>
<table width="100%" border="1" cellspacing="0"   align="center"   >

  <tr>
    <th  align="left" valign="bottom" >C&oacute;digos:
    <input type="text" name="codigo2" maxlength="20" size="45"  class="search-input3" title="Informe os codios separados por vírgulas" />
    <select name="linha_desp"  onchange="atualiza();" class="search-input3">
      <option value="">Linha</option>
        <?php while($row33a=mysql_fetch_assoc($rs2a)){ ?>
        <option value="<?php echo($row33a['id_grupocusto']);?>"
				  <? if($row33a['id_grupocusto'] == $linha_desp) {		  
					  ?>selected <? } ?>				
				 ><?php echo($row33a['descr_grupocc']); ?></option>
        <?php }?>
    </select>
    <select name="mes_i" class="search-input4" >
      <option value="0">Mes Inicial </option>
            <option value="1"  <?php if ($mes_i == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>            
            <option value="2"  <?php if ($mes_i == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>            
            <option value="3"  <?php if ($mes_i == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>            
            <option value="4"  <?php if ($mes_i == 4){ echo ( " selected=selected ");} ?>>Abril</option>            
            <option value="5"  <?php if ($mes_i == 5){ echo ( " selected=selected ");} ?>>Maio</option>            
            <option value="6"  <?php if ($mes_i == 6){ echo ( " selected=selected ");} ?>>Junho</option>            
            <option value="7"  <?php if ($mes_i == 7){ echo ( " selected=selected ");} ?>>Julho</option>            
            <option value="8"  <?php if ($mes_i == 8){ echo ( " selected=selected ");} ?>>Agosto</option>            
            <option value="9"  <?php if ($mes_i == 9){ echo ( " selected=selected ");} ?>>Setembro</option>            
            <option value="10"  <?php if ($mes_i == 10){ echo ( " selected=selected ");} ?>>Outubro</option>            
            <option value="11"  <?php if ($mes_i == 11){ echo ( " selected=selected ");} ?>>Novembro</option>            
            <option value="12"  <?php if ($mes_i == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>            
        </select> 
    <select name="mes_f" class="search-input4" >
             <option value="0">Mes Final </option>
             <option value="1" <?php if ($mes_f == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>
             <option value="2" <?php if ($mes_f == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>
             <option value="3" <?php if ($mes_f == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>
             <option value="4" <?php if ($mes_f == 4){ echo ( " selected=selected ");} ?>>Abril</option>
             <option value="5" <?php if ($mes_f == 5){ echo ( " selected=selected ");} ?>>Maio</option>
             <option value="6" <?php if ($mes_f == 6){ echo ( " selected=selected ");} ?>>Junho</option>
             <option value="7" <?php if ($mes_f == 7){ echo ( " selected=selected ");} ?>>Julho</option>
             <option value="8" <?php if ($mes_f == 8){ echo ( " selected=selected ");} ?>>Agosto</option>
             <option value="9" <?php if ($mes_f == 9){ echo ( " selected=selected ");} ?>>Setembro</option>
             <option value="10" <?php if ($mes_f == 10){ echo ( " selected=selected ");} ?>>Outubro</option>
             <option value="11" <?php if ($mes_f == 11){ echo ( " selected=selected ");} ?> >Novembro</option>
             <option value="12" <?php if ($mes_f == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>
        </select>
  Ano Prev: 
  <input type="text" name="ano_i" maxlength="4" size="4"  class="search-input4" value = "<?php echo($ano_i)?>"/> 
  Ano Realiz.:
  <input type="text" name="ano_r" maxlength="4" size="4"  class="search-input4" value = "<?php echo($ano_r)?>" /></th>
    <th  align="center" valign="top"><input type="submit" name="botao"  value="Filtrar" class="search-submit2"  /></th>
  </tr>
  </table>

    <table width="100%"  border="1" >
     <?php 
	// $bg=1;
	 $cd_real = 0;
	 $i = 0;
	 for ($i=0;$i < 19; $i++) {
	     $header2[$i] = ''; 
     }
	 $i = 0;
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<19;$i++){   
              echo('<th  align=right>' .$cabec[$i]  .'</th>');  
         }
	 echo('</tr>');
	$bg = 0; 
	$totv = 0;
	$ttcli = 0;
	$ttm = 0;
if(isset($_POST["botao"])){
     $sald = 0;
	 $ptmin = 0;
	 $var_graf = '';
	 $cd_real0 ='';
	 while($row=mysql_fetch_array($rs2)){ 
			  
	   //echo('<tr ' . $bgc .'>');
	  
	  if ($cd_real0 == ''){
		  $cd_real0 = $row['cod_sidespreal'];  
	  }
	  
	   if ( $row['cod_sidespreal'].$row['P'] != $cd_real){
     	  ++ $ttcli ; 		  
          if($bg == 1){
			   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
    	  echo('<tr ' . $bgc .'>');
	      if ($ttm > 0){
  			  $header2[14] = $totv;
		  }
		  else { $header2[15] = '';}
		  
		  
	   	  for ($i=0;$i < 16; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if ($header2[$i] > 0 && $i > 1) {
			      echo("<th" . $alg . ">" . number_format($header2[$i],2,",",".") ."</th>" );
			  }else{
			         echo("<th" . $alg . ">" . $header2[$i] ."</th>" );
				  }
    	  }
	   	  for ($i=0;$i < 19; $i++) {
	        $header2[$i] = ''; 
            $ttm = 0;          
			$totv = 0;
		  }
		 echo("</tr>");
	   }
     ///////////////////////////////imprime o total da despesa////////////
	 if ($cd_real0 != $row['cod_sidespreal']){

		     echo("<tr bgcolor=#E6E6F2>");
		      $lnk = "<a href=javascript:ver_desp('graf_orc.php?cd=".$cd_real0.'&an='.$anodf."');>";
			  
			  echo($lnk);

		      $tt_lin[1] = $lnk."Variação " ."</a>";
              $totl = 0;
			  $mdl = 0;
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tt_lin[$i];
                  				  
				  if ($tt_lin[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i <   2) {
						echo("<th" . $alg . ">" . $tt_lin[$i] ."</th>" );				
	
				  }else{
					  if ($tt_lin[$i] != NULL){
					       echo("<th" . $alg . ">" . number_format($tt_lin[$i],2,",",".") ."</th>" );
					  }else{
						    echo("<th" . $alg . ">&nbsp;</th>" );
					  }
				  }

		         if($i > 1 && $i < 14){
		  		   $var_graf = $var_graf . "['".trim($cabec[$i]). "'," . $tt_lin[$i]."]," ;
				 }
	    	  }
			  echo("<th" . $alg . ">" . number_format($totl,2,",",".") ."</th>" );
			  if($mdl == 0){$mdl = 1;}
			  echo("<th" . $alg . ">" . number_format(($totl/$mdl),2,",",".") ."</th></tr>" );

   	  //////////////////////////////////////////////////////////////////////////

     ///////////////////////////////imprime o percentural da despesa////////////
		     echo("<tr  bgcolor=#DCDCED> ");
		      $lnk = "<a href=javascript:ver_desp('graf_orc.php?cd=".$cd_real0.'&an='.$anodf."');>";
			  
			  echo($lnk);

		      $tt_lin[1] = $lnk."Percentual " ."</a>";
              $totl = 0;
			  $mdl = 0;
			  $totr = 0;
			  $totp = 0;
			  
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tt_lin[$i];
                  				  
				  if ($tot_perc[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i <   2) {
						echo("<th" . $alg . ">%</th>" );				
	
				  }else{
					  if ($tt_linp[$i] != NULL){
//						       echo("<th" . $alg . ">" . number_format((float)$tot_perc[$i],2,",",".") ."%</th>" );
					       echo("<th" . $alg . ">" . number_format((float)($tt_linr[$i] / $tt_linp[$i])*100 ,2,",",".") ."%</th>" );
				           $totr = $totr + $tt_linr[$i];
						   $totp = $totp + $tt_linp[$i];						   
					  }else{
						    echo("<th" . $alg . ">&nbsp;</th>" );
					  }
				  }

	    	  }
			if($totp > 0 ){
		    	echo("<th" . $alg . ">" . number_format((float)($totr / $totp)*100 ,2,",",".") ."%</th>" );
				echo("<th" . $alg . ">&nbsp;</th></tr>" );
		
			}else{
				echo("<th" . $alg . " colspan=2>&nbsp;</th></tr>" );			
			}


   	  //////////////////////////////////////////////////////////////////////////
		  $cd_real0 = $row['cod_sidespreal'];  
		  $totr = 0;
		  $totp = 0;
		  for ($i=0;$i < 19; $i++) {
	          $tt_lin[$i] = ''; 
	          $tot_perc[$i] = ''; 
	          $tt_linp[$i] = ''; 
	          $tt_linr[$i] = ''; 

          }

	  }
      ////////////////////////////////////////////////////////////////////


	  $tipopr = '';
	  if ($row['P'] == 'P'){ $tipopr = " Previsto ";}
	  if ($row['P'] == 'R'){ $tipopr = " Realizado ";}
	  
	  $header2[0] = $row['cod_sidespreal'] ;
	  $header2[1] = $row['descr_despreal'] . " - " . $row['descr_grupocc']. " - " . $tipopr  ;   
	  $header2[15] = $row['media_desp'];   
	  
 	  $header2[$row['mes_prevdespr']+1] = $row['val_prevdespr'];

///////////////////////////////////////////// totais por despesa ////////////////////////////////////////////
      if ($row['P'] == 'P'){
             $tt_lin[$row['mes_prevdespr']+1] =  $row['val_prevdespr'];
	         $tt_linp[$row['mes_prevdespr']+1] =  $row['val_prevdespr'];
	
			 /////// resumo total do previsto ////////////////
		     $tot_prev[$row['mes_prevdespr']+1] = $tot_prev[$row['mes_prevdespr']+1] +  $row['val_prevdespr'];
		     /////////////////////////////////////////////////				  
	  }else{
	         $tt_lin[$row['mes_prevdespr']+1] = $tt_lin[$row['mes_prevdespr']+1] - $row['val_prevdespr'];
 	         $tt_linr[$row['mes_prevdespr']+1] =  $row['val_prevdespr'];
	 
			 /////// resumo total do realizado ////////////////
		     $tot_real[$row['mes_prevdespr']+1] = $tot_real[$row['mes_prevdespr']+1] +  $row['val_prevdespr'];

			 if ($tot_prev[$row['mes_prevdespr']+1] != ''){
//			      $tot_perc[$row['mes_prevdespr']+1] = 100.00 - ($tt_lin[$row['mes_prevdespr']+1] / $row['val_prevdespr']) * 100;
			      $tot_perc[$row['mes_prevdespr']+1] = ($tot_real[$row['mes_prevdespr']+1] / $tot_prev[$row['mes_prevdespr']+1]) * 100;

	         }else{
				 $tot_perc[$row['mes_prevdespr']+1] = 00;
			 }
		     /////////////////////////////////////////////////				  
	  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////

	  $ttcol[$row['mes_prevdespr']+1] = $ttcol[$row['mes_prevdespr']+1] + $row['val_prevdespr'];
	  
	  $ttm++;
	  $totv = $totv +  $row['val_prevdespr'];
	  $cd_real = $row['cod_sidespreal'].$row['P'];
      
      
	 }	

       if($bg == 1){
		$bgc = "bgcolor=#F3F3F3";  $bg = 0;}
	   else{ $bgc = ''; $bg = 1;}	

	   echo('<tr ' . $bgc .'>');
	   
   	   if ($ttm > 0){
  			  $header2[14] = $totv;
			  $header2[15] = ($totv / $ttm);
			  //$header2[17] = 'Kg';
		}
		
		//////////final//////////////////
	   	  for ($i=0;$i < 15; $i++) {
			  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
			  if ($header2[$i] > 0 && $i > 1) {
			      echo("<th" . $alg . ">" . number_format($header2[$i],2,",",".") ."</th>" );
			  }else{
			         echo("<th" . $alg . ">" . $header2[$i] ."</th>" );
				  }
    	  }
	////////////////////////////////////////////////////////////////////////////////////////	
		     echo("<tr bgcolor=#DCDCED>");
		      $lnk = "<a href=javascript:ver_desp('graf_orc.php?cd=".$cd_real0.'&an='.$anodf."');>";
			  
			  echo($lnk);

		      $tt_lin[1] = $lnk."Variação" ."</a>";
              $totl = 0;
			  $mdl = 0;
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tt_lin[$i];
				  if ($tt_lin[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i <   2) {
						echo("<th" . $alg . ">" . $tt_lin[$i] ."</th>" );				
	
				  }else{
 					  if ($tt_lin[$i] != NULL){
					       echo("<th" . $alg . ">" . number_format($tt_lin[$i],2,",",".") ."</th>" );
					  }else{
						    echo("<th" . $alg . ">&nbsp;</th>" );
					  }
				  }

	    	  }
			  echo("<th" . $alg . ">" . number_format($totl,2,",",".") ."</th>" );
			  if($mdl == 0){$mdl = 1;}
			  echo("<th" . $alg . ">" . number_format(($totl/$mdl),2,",",".") ."</th>" );

		  ///////////////////////////////
			 
	 	//$ttcli ++;
		 echo("</tr>");


     ///////////////////////////////imprime o percentural da despesa////////////
		     echo("<tr  bgcolor=#DCDCED> ");
		      $lnk = "<a href=javascript:ver_desp('graf_orc.php?cd=".$cd_real0.'&an='.$anodf."');>";
			  
			  echo($lnk);

		      $tt_lin[1] = $lnk."Percentual " ."</a>";
              $totl = 0;
			  $mdl = 0;
			  $totr = 0;
			  $totp = 0;
			  
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tt_lin[$i];
                  				  
				  if ($tot_perc[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i <   2) {
						echo("<th" . $alg . ">%</th>" );				
	
				  }else{
					  if ($tt_linp[$i] != NULL){
//						       echo("<th" . $alg . ">" . number_format((float)$tot_perc[$i],2,",",".") ."%</th>" );
					       echo("<th" . $alg . ">" . number_format((float)($tt_linr[$i] / $tt_linp[$i])*100 ,2,",",".") ."%</th>" );
				           $totr = $totr + $tt_linr[$i];
						   $totp = $totp + $tt_linp[$i];						   
					  }else{
						    echo("<th" . $alg . ">&nbsp;</th>" );
					  }
				  }

	    	  }
			if($totp > 0 ){
		    	echo("<th" . $alg . ">" . number_format((float)($totr / $totp)*100 ,2,",",".") ."%</th>" );
				echo("<th" . $alg . ">&nbsp;</th></tr>" );
		
			}else{
				echo("<th" . $alg . " colspan=2>&nbsp;</th></tr>" );			
			}


   	  //////////////////////////////////////////////////////////////////////////

////////////////////////////////imprime resumos previsto////////////////////////////////////////////
$totgp = array();
$totgr = array();
for($i=0;$i<14;$i++){
	$totgp[$i] = 0;
	$totgr[$i] = 0;
}
   echo("<tr bgcolor=#8CC6FF>");
		      $tot_prev[1] = "Total Previsto " ."</a>";
              $totl = 0;
			  $mdl = 0;
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tot_prev[$i];
				  if ($tot_prev[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($tot_prev[$i] > 0 && $i > 1) {
						echo("<th" . $alg . ">" . number_format($tot_prev[$i],2,",",".") ."</th>" );
			            $totgp[$i] = $totgp[$i] + $tot_prev[$i];
						//////////acumula previsto ////////////////////
						$tot_var[$i] = $tot_var[$i] +  $tot_prev[$i];
						///////////////////////////////////////////////
						
				  }else{
						echo("<th" . $alg . ">" . $tot_prev[$i] ."</th>" );
				  }
	    	  }
			  echo("<th" . $alg . ">" . number_format($totl,2,",",".") ."</th>" );
			  if($mdl == 0){$mdl = 1;}
			  echo("<th" . $alg . ">" . number_format(($totl/$mdl),2,",",".") ."</th>" );			 
	 	//$ttcli ++;
		 echo("</tr>");
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////imprime resumos realizado////////////////////////////////////////////
	 echo("<tr bgcolor=#DFFFDF>");
		      $tot_real[1] = "Total Realizado " ."</a>";
              $totl = 0;
			  $mdl = 0;
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tot_real[$i];
				  if ($tot_real[$i]!= NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($tot_real[$i] > 0 && $i > 1) {
						echo("<th" . $alg . ">" . number_format($tot_real[$i],2,",",".") ."</th>" );
						//////////acumula subtrai realizado ////////////////////
						$tot_var[$i] = $tot_var[$i] - $tot_real[$i];
						///////////////////////////////////////////////
		                $totgr[$i] = $totgr[$i] + $tot_real[$i];
	
				  }else{
						echo("<th" . $alg . ">" . $tot_real[$i] ."</th>" );
				  }
	    	  }
			  echo("<th" . $alg . ">" . number_format($totl,2,",",".") ."</th>" );
			  if($mdl == 0){$mdl = 1;}
			  echo("<th" . $alg . ">" . number_format(($totl/$mdl),2,",",".") ."</th>" );			 
	 	//$ttcli ++;
		 echo("</tr>");
	 echo("<tr bgcolor=#D2D2FF>");
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////imprime resumos variação ////////////////////////////////////////////
	 echo("<tr bgcolor=#E2E2F1>");
		      $tot_var[1] = "Total Variação";
              $totl = 0;
			  $mdl = 0;
	    	  for ($i=0;$i < 14; $i++) {
				  $totl = $totl + $tot_var[$i];
				  if ($tot_var[$i] != NULL && $i > 1 && $i < 14){
					  $mdl++;
				  }
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i > 1) {
						echo("<th" . $alg . ">" . number_format($tot_var[$i],2,",",".") ."</th>" );
				  }else{
						echo("<th" . $alg . ">" . $tot_var[$i] ."</th>" );
				  }
	    	  }
			  echo("<th" . $alg . ">" . number_format($totl,2,",",".") ."</th>" );
			  if($mdl == 0){$mdl = 1;}
			  echo("<th" . $alg . ">" . number_format(($totl/$mdl),2,",",".") ."</th>" );			 
	 	//$ttcli ++;
		 echo("</tr></a>");
	 echo("<tr bgcolor=#D2D2FF>");
//////////////////////////////////////////////////////////////////////////////////////////
/*
     ///////////////////////////////imprime o percentural da despesa////////////
		     echo("<tr  bgcolor=#DCDCED> ");
		      $lnk = "<a href=javascript:ver_desp('graf_orc.php?cd=".$cd_real0.'&an='.$anodf."');>";
			  
			  echo($lnk);

		      $tt_lin[1] = $lnk."Percentual " ."</a>";
              $totl = 0;
			  $mdl = 0;
			  $totr = 0;
			  $totp = 0;
			  
	    	  for ($i=0;$i < 14; $i++) {
				  if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
				  if ($i <   2) {
						echo("<th" . $alg . ">%</th>" );				
	
				  }else{
					  if ($totgp[$i] != NULL){
//						       echo("<th" . $alg . ">" . number_format((float)$tot_perc[$i],2,",",".") ."%</th>" );
					       echo("<th" . $alg . ">" . number_format((float)($totgr[$i] / $totgp[$i])*100 ,2,",",".") ."%</th>" );
				           $totr = $totr + $totgr[$i];
						   $totp = $totp + $totgp[$i];						   
					  }else{
						    echo("<th" . $alg . ">&nbsp;</th>" );
					  }
				  }

	    	  }
			if($totp > 0 ){
		    	echo("<th" . $alg . ">" . number_format((float)($totr / $totp)*100 ,2,",",".") ."%</th>" );
				echo("<th" . $alg . ">&nbsp;</th></tr>" );
		
			}else{
				echo("<th" . $alg . " colspan=2>&nbsp;</th></tr>" );			
			}
*/

   	  //////////////////////////////////////////////////////////////////////////


	 $md = 0;
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	 	//$ttcli ++;
		 echo("</tr>");
	 
	 
	 
}
      ?>         
  </table>
  </center>
<?php
	if(isset($_POST["botao"])){
          $mes = array( 1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
		                7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez' );
		
		$var_grafx = '';
		$prev =0;
		$real = 0;
		$var = 0;
							
		while($row=mysql_fetch_array($rs20)){ 
			//	 $prev =   $row['tot_prev'];
			     $prev = $tot_prev[$row['mes_prevdespr']+1];
			
				 if ($prev == null){ $prev = 0;}
				 
			//	 $real =   $row['tot_real'];
			
			     $real =  $tot_real[$row['mes_prevdespr']+1];
				 if ($real == null){ $real = 0;}
				 
			//	 $var =   $row['tot_vari'];
			
			     $var = $prev - $real;
				 if ($var == null){ $var = 0;}
				 
				 $despesa = $row['descr_grupocc'];				   
				 $var_grafx = $var_grafx . "['".$mes[$row['mes_prevdespr']]. "'," . $prev. "," . $real. "," . $var."]," ;
		}
		//echo($var_graf);
		
		$str_prev = "";
		$str_real ="";
		if ($ano_i !=""){
			$str_prev = " Ano previsão : " . $ano_i;
		}
		if ($ano_r !=""){
			$str_real = " Ano realização : " . $ano_r;
		}
			
			
?>

    <script type="text/javascript">
	
	/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////
		 google.charts.load('current', {'packages':['corechart']});
		 google.charts.setOnLoadCallback(drawVisualization);
		
		 function drawVisualization() {
		 
				  var data = google.visualization.arrayToDataTable([
				  ['Mes', 'Previsto', 'Realizado','Variação'],<?php echo($var_grafx);?>]);
				  
				 
		
				var options = {
				  title : 'Previsto x Realizado da despesa : <?php echo($despesa) .$str_prev . $str_real ?>'  ,
				  vAxis: {title: 'Totais'},
				  hAxis: {title: 'Meses'},
				  legendFontSize:12,
				  seriesType: 'bars',
				  series: {4: {type: 'line'}}
				};
		
				var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			  }
			///////////
	  
    </script>
    <div id="chart_div" style="width: 850px; height: 300px;"></div>


<?php


	}
?>      
</form>
 
</body>
</html>
