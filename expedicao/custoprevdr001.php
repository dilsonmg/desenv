<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

/*   correção automatica de valores

insert into tb_prevdespr (cod_sidespreal,mes_prevdespr,ano_prevdespr,val_prevdespr)
 (select cod_sidespreal,1,2023,(val_custoreal * 1.08)
          from tb_custoreal
          where mes_custoreal = 1 and ano_custoreal = 2022)
*/


$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }

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

         echo("Voce nao esta logado !!");
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

$responsavel = "dilson magalhaes";
$descr_grupocc =  '';

$id = $_GET ["id"];

$habilit = "S";
$p4 = "";
$p4a = "";
$p5 = "";

if (isset($id_grupocustor)){
	if ($id_grupocustor <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_grupocusto = '" . $id_grupocustor ."'" ; 
		 $p4a = " and b.id_grupocusto = '" .$id_grupocustor ."'" ; 
		 $p4b = ""; 
		 }}		 
if (isset($id_grupocusto2)){
	if ($id_grupocusto2 <> "" ){
		 $p4b = " and b.id_grupocusto = '" .$id_grupocusto2 ."'" ;  
		 $p4a = "";
		 }}		 
if (isset($cod_sidespreal2)){
	if ($cod_sidespreal2 <> "" ){
		 $p5 = " and a.cod_sidespreal = '" . $cod_sidespreal2 ."'" ; 
	}
}
  	 
$p1w='';
if (isset($ano_prevdespr2)){
	if($ano_prevdespr2 <> ""){
		$p1w = " and a.ano_prevdespr = '".$ano_prevdespr2 ."'";
	}
}
	
		$rs2 = mysql_query("
					select a.*, b.descr_grupocc, c.descr_despreal
								 from tb_prevdespr a
								 inner join tb_despreal c on a.cod_sidespreal = c.cod_sidespreal
							     inner join tb_vinccustor d on d.cod_sidespreal = a.cod_sidespreal
								 inner join tb_grupoccusto b on b.id_grupocusto = d.id_grupocusto  " . $p4a . $p4b . "
								 where a.cod_sidespreal > 0 " . $p5 . $p1w . "
					  order by d.id_grupocusto desc, c.descr_despreal,a.mes_prevdespr");				  
    	$b = mysql_num_rows($rs2);
					  
		  	
$rs34 = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	
$rs34a = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	

if (isset($id)){

    $rs1 = mysql_query("SELECT a.* FROM tb_prevdespr a where a.id_prevdespr = '". $id . "'");
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
         //$rs1 = mysql_query("SELECT a.* FROM tb_grupoccusto a where a.id_grupocusto =". $id);
    	 $row1 = mysql_fetch_assoc($rs1);
		 //$id_grupocusto        = $id;
 	     //$descr_grupocc        = $row1['descr_grupocc'];  
		 $cod_sidespreal      = $row1['cod_sidespreal'];
		 $mes_prevdespr       = $row1['mes_prevdespr'];
		 $ano_prevdespr       = $row1['ano_prevdespr'];
		 $val_prevdespr       = $row1['val_prevdespr'];
		 $id_prevdespr        = $row1['id_prevdespr'];
		 
		 $rsx = mysql_query("select * from tb_vinccustor b where b.cod_sidespreal = '".$cod_sidespreal ."'");
		 $row1x = mysql_fetch_assoc($rsx);
		 
		 $id_grupocustor = $row1x['id_grupocusto'];
 
	  }
	 
 }

 $rs33 = mysql_query("select a.* from tb_despreal a 
 						inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal " .$p4a .
						" order by a.descr_despreal");	


 $rs330 = mysql_query("select a.* from tb_despreal a 
 						inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal " .$p4b .
						" order by a.descr_despreal");	



function despesas_realiz($id_gr,$cod_si,$ano_dp){
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
							
					$rs_del = "drop table tmp_mdreal ";					   
					$tmp =  mysql_query( $rs_del );
								  
					$rs_tmp = "create table tmp_mdreal as (SELECT a.cod_sidespreal,b.descr_despreal, sum(val_custoreal) 
							   tot_desp,avg(val_custoreal)media_desp
							   , c.id_grupocusto,d.descr_grupocc
							   FROM tb_custoreal a
							   inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
							   inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal and c.id_grupocusto = '". $id_gr . "'
										 inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto
							    where a.ano_custoreal = '". $ano_dp."'  and ano_custoreal = '" . $ano_dp
							    ."'   and a.cod_sidespreal = '". $cod_si. "' 
								 group by a.cod_sidespreal
								 order by b.descr_despreal )";
										
					$tmp =  mysql_query( $rs_tmp );
							
					if (isset($linha_prod)){
						if($linha_prod != ""){
							 $p02a = " and b.linha ='" . $linha_prod ."'" ;
						}
					}
						
					$rs2dp = mysql_query("SELECT a.*,b.descr_despreal,e.media_desp,c.id_grupocusto,d.descr_grupocc  FROM tb_custoreal a
										inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
										inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal 
										 inner join tb_grupoccusto d on d.id_grupocusto = c.id_grupocusto and c.id_grupocusto = '". $id_gr . "'
										inner join tmp_mdreal e on e.cod_sidespreal = a.cod_sidespreal
										where a.cod_sidespreal > 0 and a.cod_sidespreal = '". $cod_si. 
										"' and ano_custoreal = '" . $ano_dp ."' 
										 group by a.ano_custoreal,a.mes_custoreal,a.cod_sidespreal
										order by b.descr_despreal,a.ano_custoreal,a.mes_custoreal ");
										
					$rscons = mysql_query("SELECT a.* from tmp_mdreal a order by a.tot_desp desc ");
			
    ////////////////////////////Imprime a grade de despesas do item////////////////////

 	$bg = 0; 
 	$totv = 0;
    $ttcli = 0;
	$ttm = 0;
    $sald = 0;
	$ptmin = 0;
	$var_graf = '';
	$cd_real=0;
		
    $cabec   = array();
	$header  = array();
	$header2  = array();
	$ttcol    = array();
	
	
	$resumo  = array();

      $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $ttcol[$i] = ""; 
     }

	 $i = 0;
	 for ($i=0;$i < 16; $i++) {
	     $resumo[$i] = ""; 
     }
	
	$cabec[0] = "Codigo";
	$cabec[1] = "Despesas do ano " .$ano_dp;	
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
	 echo('<tr bgcolor="#B3B3FF">');
	     for($i=0;$i<16;$i++){   
              echo('<th  align=right>' .$cabec[$i]  .'</th>');  
         }
	 echo('</tr>');
     if($bg == 1){
	   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
    else{ $bgc = ''; $bg = 1;}	
 
    echo('<tr ' . $bgc .'>');

	while($rowdp=mysql_fetch_array($rs2dp)){ 
	  
	  $header2[0] = $rowdp['cod_sidespreal'] ;
	  $header2[1] = $rowdp['descr_despreal'] . " - " . $rowdp['descr_grupocc'];   
	  $header2[15] = $rowdp['media_desp'];   
	  
 	  $header2[$rowdp['mes_custoreal']+1] = $rowdp['val_custoreal'];
	 
	  $ttcol[$rowdp['mes_custoreal']+1] = $ttcol[$rowdp['mes_custoreal']+1] + $rowdp['val_custoreal'];
	  
	  $ttm++;
	  $totv = $totv +  $rowdp['val_custoreal'];
      $cd_real = $rowdp['cod_sidespreal'];
	 
     if($bg == 1){
	   	    $bgc = "bgcolor=#F3F3F3";  $bg = 0;}
	 else{ $bgc = ''; $bg = 1;}	
     
	 
	}
	
	// echo('<tr ' . $bgc .'>');
	   
   	 if ($ttm > 0){
  			  $header2[14] = $totv;
	          $header2[15] = ($totv / $ttm);
			  //$header2[17] = 'Kg';
	 }
	 echo("<tr bgcolor=#D2D2FF>");
	 $md = 0;
	 
	 for ($i=0;$i < 16; $i++) {
	      if($i==0){$alg = " align=right ";}else{$alg=" align=right ";}
		     if($i<2){
		       echo("<th" . $alg . " >" . $header2[$i] ."</th>" );
			 }else{
				echo("<th" . $alg . " >" .number_format($header2[$i],2,",",".") ."</th>" );
			 }
	 }
	 

	 //$ttcli ++;
	  echo("</tr>");
	   

	//////////////////////////////////////////////////////////////////////////////
}


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
	<title>custoprevdr001 - Orçamento mensal de despesas a realizadas</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
	<script type='text/javascript' src="../js/funcgrc.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
			
function resetForm(){
 //   if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		 // document.form1.id_grupocusto.value="";
		  document.form1.val_prevdespr.value="";
   	   	  document.form1.action="custoprevdr001.php";
		  document.form1.submit();  
		  return true;
		//  }

}

function atualiza(){
   resetForm();
   document.form1.submit();	
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
<input readonly type=hidden name=x size=3 maxlength=3 value="250">
<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h1>Altera&ccedil;&atilde;o Individual Or&ccedil;amento Mensal de despesas a realizar - 
    
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
  </table>
 <table width="98%" border="0">
 
          <tr>
            <th align="left">Linha</th>
        <th align="left"><select name="id_grupocustor"   class="search-input"  onChange="atualiza();" autofocus="true">
          <option value="">Selecione o Grupo</option>
          <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
          <option value="<?php echo($row33['id_grupocusto']);?>"
				  <? if($row33['id_grupocusto'] == $id_grupocustor ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_grupocc']);?></option>
          <?php }?>
        </select>        </th>
        <th align="left">Item de despesa
          <select name="cod_sidespreal" class="search-input5" <?php if($habilita ==1) echo(" disabled ");?> >
            <option value="">Selecione o item</option>
            <?php while($row33=mysql_fetch_assoc($rs33)){ ?>
            <option value="<?php echo($row33['cod_sidespreal'])?>"
				  <? if($row33['cod_sidespreal'] == $cod_sidespreal ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_despreal'] . " - " . $row33['cod_sidespreal'] )?></option>
            <?php }?>
          </select></th>
      </tr>    
          <tr>
            <th align="left">Mes</th>
            <th align="left"><select name="mes_prevdespr" class="search-input" >
              <option value="">Selecione o Mes Inicial </option>
              <option value="1"  <?php if ($mes_prevdespr == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>
              <option value="2"  <?php if ($mes_prevdespr == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>
              <option value="3"  <?php if ($mes_prevdespr == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>
              <option value="4"  <?php if ($mes_prevdespr == 4){ echo ( " selected=selected ");} ?>>Abril</option>
              <option value="5"  <?php if ($mes_prevdespr == 5){ echo ( " selected=selected ");} ?>>Maio</option>
              <option value="6"  <?php if ($mes_prevdespr == 6){ echo ( " selected=selected ");} ?>>Junho</option>
              <option value="7"  <?php if ($mes_prevdespr == 7){ echo ( " selected=selected ");} ?>>Julho</option>
              <option value="8"  <?php if ($mes_prevdespr == 8){ echo ( " selected=selected ");} ?>>Agosto</option>
              <option value="9"  <?php if ($mes_prevdespr == 9){ echo ( " selected=selected ");} ?>>Setembro</option>
              <option value="10"  <?php if ($mes_prevdespr == 10){ echo ( " selected=selected ");} ?>>Outubro</option>
              <option value="11"  <?php if ($mes_prevdespr == 11){ echo ( " selected=selected ");} ?>>Novembro</option>
              <option value="12"  <?php if ($mes_prevdespr == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>
            </select></th>
            <th align="left">Ano
            <input type="text" name="ano_prevdespr" maxlength="4" size="4"  class="search-input3" value = "<?php echo($ano_prevdespr)?>" onChange="atualiza();" onBlur="atualiza();" /></th>
          </tr>    
       <?php 
	        $msg=""; 
	       if (isset($id_grupocustor) && isset($cod_sidespreal) && isset($ano_prevdespr)){
	         if ($id_grupocustor <> "" && $cod_sidespreal <> "" && $ano_prevdespr <> "" ){
				 $anodp = $ano_prevdespr - 1;
                 echo("<tr><th colspan = 3 align = center>     <table width=90%  border=1 >");
				     despesas_realiz($id_grupocustor,$cod_sidespreal,$anodp);
		         echo("</table></tr></th>");
				
				$rsvlrm = mysql_query("SELECT max(val_custoreal) maior_valor FROM tb_custoreal
                                      where cod_sidespreal = '" . $cod_sidespreal . "' and ano_custoreal = '" . $anodp . "'");
			    $rowv1 = mysql_fetch_assoc($rsvlrm);
				
				$msg = " Valor Máximo do Item no ano anterior : " .number_format($rowv1['maior_valor'],2,",",".");

			 }
		   }
		   ?>	   
       
          <tr>
            <th align="left">Valor Previsto</th>
            <th colspan="2" align="left">
            <input type="text" name="val_prevdespr" value ="<?php echo($val_prevdespr); ?>"  class="search-input3"/>
            <b><?php  echo($msg); ?></b></th>
          </tr>
      <tr>
        <th align="center" colspan="3">
        <?php if ($btn == 's'){ ?>

          <input type="button" name="gravar"  onClick="valida_prevdr();" value="Gravar" class="search-submit2" />
          <input type="reset" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
          <input type="button" name="Submit4"  onclick="excluir_prevdr(<?php echo($id); ?>);" value="Excluir"  class="search-submit2"/>
       <?php } ?>
         <input type="button" onClick="sair1();" value="Sair" class="search-submit2">
        </th>
        </tr>
        
              <tr bgcolor="#9D9DFF">
        <th align="center" colspan="3"><font color="#000000">Previsoes de Despesas Realizadas</font></th>
      </tr>
      <tr>
        <th  align="left" colspan="3">Selecione o Linha:
          <select name="id_grupocusto2"  onChange="atualiza();"  class="search-input3">
            <option value="">Selecione</option>
            <?php while($row33=mysql_fetch_assoc($rs34a)){ ?>
            <option value="<?php echo($row33['id_grupocusto']);?>"
				  <? if($row33['id_grupocusto'] == $id_grupocusto2 ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_grupocc']);?></option>
            <?php }?>
        </select>
          <select name="cod_sidespreal2" class="search-input2" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();" >
            <option value="">Selecione a Despesa</option>
            <?php while($row330=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php echo($row330['cod_sidespreal'])?>"
				  <? if($row330['cod_sidespreal'] == $cod_sidespreal2 ) {?>selected <? } ?>				
				 ><?php echo($row330['descr_despreal'] . " - " . $row330['cod_sidespreal'] )?></option>
            <?php }?>
        </select>
          Ano:
          <input type="text" name="ano_prevdespr2" maxlength="4" size="4"  class="search-input3"
                          value = "<?php echo($ano_prevdespr2)?>" onChange="atualiza();" onBlur="atualiza();" /></th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td align="center"  colspan="3">
              <table width="80%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >Linha </th>
                  <th >Item de Despesa</th>
                  <th >Mes</th>
                  <th >Ano</th>
                  <th >Valor Previsto</th>

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
              
       <td >
           <a href="custoprevdr001.php?id=<?php echo ($row['id_prevdespr']);?>"><?php echo ($row['id_prevdespr']);?></a></td>
                <td ><?php echo ($row['descr_grupocc']);?></td>
                <td ><?php echo ($row['cod_sidespreal'] . " - " .$row['descr_despreal']);?></td>
                <td align="center" ><?php 
				switch ($row['mes_prevdespr']) {
				case 1:
					echo ("Jan");
					break;
				case 2:
					echo ("Fev");
					break;
				case 3:
					echo ("Mar");
					break;
				case 4:
					echo ("Abr");
					break;
				case 5:
					echo ("Mai");
					break;
				case 6:
					echo ("Jun");
					break;
				case 7:
					echo ("Jul");
					break;
				case 8:
					echo ("Ago");
					break;
				case 9:
					echo ("Set");
					break;
				case 10:
					echo ("Out");
					break;
				case 11:
					echo ("Nov");
					break;
				case 12:
					echo ("Dez");
					break;
			}
				
				?></td>
                <td align="right" ><?php echo ($row['ano_prevdespr']);?></td>
                <td align="right" ><?php echo ($row['val_prevdespr']);?></td>

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
