<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

/*   correção automatica de valores

insert into tb_prevdespr (cod_sidespreal,mes_prevdespr,ano_prevdespr,val_prevdespr)
 (select cod_sidespreal,1,2023,(val_custoreal * 1.08)
          from tb_custoreal
          where mes_custoreal = 1 and ano_custoreal = 2022)
		  
correcao por grupo
		  
select cod_sidespreal,1,2023,(val_custoreal * 1.08)
          from tb_custoreal
  where mes_custoreal = 1 and ano_custoreal = 2022
     and  cod_sidespreal in (
     select a.cod_sidespreal from tb_despreal a
       inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal and b.id_grupocusto = '1'
)		  
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
$p4a = "";
$p3a = "";

$ano_calc = 0;
if (isset($id_grupocustor)){
	if ($id_grupocustor <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4 = " and a.id_grupocusto = '" . $id_grupocustor ."'" ; 
		 $p4a = " and b.id_grupocusto = '" .$id_grupocustor ."'" ;  
		 }}		 
if (isset($id_grupocusto2)){
	if ($id_grupocusto2 <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p4a = " and b.id_grupocusto = '" .$id_grupocusto2 ."'" ;  
		 }}		 

/*
if (isset($ano_prevdespr)){
	if ($ano_prevdespr <> "" ){
 		 $p3a = " and b.cod_sidespreal = '" .$cod_sidespreal ."'" ;  
		 }}		 
*/
if (isset($cod_sidespreal)){
	if ($cod_sidespreal <> "" ){
		// $p4 = " and a.id_eqpto like '%" . $id_eqpto1 ."%'" ; 
		 $p3a = " and b.cod_sidespreal = '" .$cod_sidespreal ."' " ;  
		 }}		 


$perc=0.0000;

if (isset($val_perccorr)){
	if ($val_perccorr <> "" ){
		 $val_perccorr       = str_replace(",",".",$val_perccorr);
		 $perc = 1 + number_format(($val_perccorr / 100), 4);  
		// number_format((float)$b, 2))
		 }}		 
	 
$rs2 = mysql_query("
			select a.*, b.descr_grupocc, c.descr_despreal
								 from tb_prevdespr a
								 inner join tb_despreal c on a.cod_sidespreal = c.cod_sidespreal
							     inner join tb_vinccustor d on d.cod_sidespreal = a.cod_sidespreal
								 inner join tb_grupoccusto b on b.id_grupocusto = d.id_grupocusto  " . $p4a . "
								 where a.cod_sidespreal > 0
			  order by d.id_grupocusto desc,a.ano_prevdespr desc,a.mes_prevdespr, c.descr_despreal ");				  
$b = mysql_num_rows($rs2);
					  
		  	
$rs34 = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	
$rs34a = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");				  	

$rs33 = mysql_query("select a.* from tb_despreal a 
 						inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal " .$p4a .
						" order by a.descr_despreal");	


///////////////////////////////////


if(isset($_POST["botao"])){

   $ano_calc = $ano_prevdespr - 1;

   if (isset($ano_refere)){
	   if ($ano_refere > 0){
		   $ano_calc = $ano_refere;
		}
   }
          

   $exec = "N";
   
   if (isset($ano_prevdespr)){
	   if ($ano_prevdespr > 0){
            $exec = "S";
	   }
   }
   
   if (isset($perc)){
	   if ($perc > 0){
            $exec = "S";
	   }
   }
   
////////////// 1o deleta as pevisões ja existentes

for ($i = $mes_prevdespr; $i <= $mes_prevdespr2; $i++) {

			$rs_dellanc = "delete from tb_prevdespr where cod_sidespreal in (   
							 select b.cod_sidespreal from tb_vinccustor b where b.cod_sidespreal > 0 ".$p3a . $p4a. " )
						  and  mes_prevdespr = '".$i . "' and ano_prevdespr = '" . $ano_prevdespr . "'";       
		 			
/*
	select distinct cod_sidespreal from tb_prevdespr where cod_sidespreal
    in ( select b.cod_sidespreal from  tb_vinccustor b where b.id_grupocusto = '3')
         and mes_prevdespr = '5' and ano_prevdespr = '2023'
		 
		$rs_dellanc = "delete from tb_prevdespr where cod_sidespreal in (   
							 select cod_sidespreal from tb_custoreal
									where  mes_custoreal = '". $i . "' and ano_custoreal = '" .$ano_prevdespr ."'
									and  cod_sidespreal in (
									 select a.cod_sidespreal from tb_despreal a
									  inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal " .$p3a.
									  " and b.id_grupocusto = '".$id_grupocustor ."'))
									  and  mes_prevdespr = '".$i . "' and ano_prevdespr = '" . $ano_prevdespr . "'";       
*/			
			
		echo($rs_dellanc);
        $dellanc =  mysql_query($rs_dellanc);

}

for ($i = $mes_prevdespr; $i <= $mes_prevdespr2; $i++) {

    $rs_lanc = "insert into tb_prevdespr (cod_sidespreal,mes_prevdespr,ano_prevdespr,val_prevdespr)
						(select cod_sidespreal,".$i . ",".$ano_prevdespr .",val_custoreal * " . $perc . " from tb_custoreal
  					where mes_custoreal = $i and ano_custoreal = $ano_calc
     				      and  cod_sidespreal in (select a.cod_sidespreal from tb_despreal a
       										inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal ".$p3a .$p4a .
	   										"))";


  // echo($rs_lanc);
  $lanc =  mysql_query($rs_lanc);


header("Location: custoprevdra01.php");

}

/*
insert into tb_prevdespr (cod_sidespreal,mes_prevdespr,ano_prevdespr,val_prevdespr)
(   
select cod_sidespreal,.$i,.$ano_prevdespr,(val_custoreal * $perc)
          from tb_custoreal
  where mes_custoreal = $i and ano_custoreal = $ano_calc
     and  cod_sidespreal in (
     select a.cod_sidespreal from tb_despreal a
       inner join tb_vinccustor b on b.cod_sidespreal = a.cod_sidespreal .$p3a
	   and b.id_grupocusto = '.$id_grupocustor')
)
*/

}



/////////////////////////////////
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
	<title>custoprevdra01 - Correção automática da previsão de despesas a realizar</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
	<script type='text/javascript' src="../js/funcgrc.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
 //   if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		 // document.form1.id_grupocusto.value="";
		  document.form1.val_perccorr.value="";
   	   	  document.form1.action="custoprevdra01.php";
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

function start(registro){
	document.getElementById("contador").value = registro;
}

/////////////////////////////////////////////////////
 function valida_correcao() {
	    mes_prevdespr  = document.form1.mes_prevdespr.options[document.form1.mes_prevdespr.selectedIndex].value;
	    mes_prevdespr2  = document.form1.mes_prevdespr2.options[document.form1.mes_prevdespr2.selectedIndex].value;

	    cod_sidespreal = document.form1.cod_sidespreal.options[document.form1.cod_sidespreal.selectedIndex].value;
	
	    ano_prevdespr  = document.form1.ano_prevdespr.value;
	
	    val_perccorr  = document.form1.val_perccorr.value;
	
	    id_prevdespr  = document.form1.id.value;

//alert("entrou");
		
/*
	 if (cod_sidespreal == "" ) { 
						alert ("Informe a Despesa !");
						document.form1.cod_sidespreal.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }
*/
	 if (mes_prevdespr == "" ) { 
						alert ("Informe o mes Inicial !");
						document.form1.mes_prevdespr.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }
	 if (mes_prevdespr2 == "" ) { 
						alert ("Informe o mes Final !");
						document.form1.mes_prevdespr2.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }

	 if (ano_prevdespr == "" ) { 
						alert ("Informe o ano !");
						document.form1.ano_prevdespr.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }
	 if (val_perccorr == "" ) { 
						alert ("Informe o índice de correção !");
						document.form1.val_perccorr.value = "";
						document.form1.val_perccorr.focus();
						return false; }
										  
	  //alert(situacao);
	  if (confirm("Confirma a correção dos dados ?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
//////////////////////////////////////////////////////////////////////////////////////////////


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
        <th align="center"><h1> Corre&ccedil;&atilde;o autom&aacute;tica da previs&atilde;o de despesas a realizar - 
    
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
          <select name="cod_sidespreal" class="search-input5" <?php if($habilita ==1) echo(" disabled ");?> onChange="atualiza();">
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
            <th align="left"><select name="mes_prevdespr" class="search-input3" >
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
            </select> 
            a 
            <select name="mes_prevdespr2" class="search-input3" >
              <option value="">Selecione o Mes Final </option>
              <option value="1"  <?php if ($mes_prevdespr2 == 1){ echo ( " selected=selected ");} ?>>Janeiro</option>
              <option value="2"  <?php if ($mes_prevdespr2 == 2){ echo ( " selected=selected ");} ?>>Fevereiro</option>
              <option value="3"  <?php if ($mes_prevdespr2 == 3){ echo ( " selected=selected ");} ?>>Mar&ccedil;o</option>
              <option value="4"  <?php if ($mes_prevdespr2 == 4){ echo ( " selected=selected ");} ?>>Abril</option>
              <option value="5"  <?php if ($mes_prevdespr2 == 5){ echo ( " selected=selected ");} ?>>Maio</option>
              <option value="6"  <?php if ($mes_prevdespr2 == 6){ echo ( " selected=selected ");} ?>>Junho</option>
              <option value="7"  <?php if ($mes_prevdespr2 == 7){ echo ( " selected=selected ");} ?>>Julho</option>
              <option value="8"  <?php if ($mes_prevdespr2 == 8){ echo ( " selected=selected ");} ?>>Agosto</option>
              <option value="9"  <?php if ($mes_prevdespr2 == 9){ echo ( " selected=selected ");} ?>>Setembro</option>
              <option value="10"  <?php if ($mes_prevdespr2 == 10){ echo ( " selected=selected ");} ?>>Outubro</option>
              <option value="11"  <?php if ($mes_prevdespr2 == 11){ echo ( " selected=selected ");} ?>>Novembro</option>
              <option value="12"  <?php if ($mes_prevdespr2 == 12){ echo ( " selected=selected ");} ?>>Dezembro</option>
            </select></th>
            <th align="left">
            Ano Referência 
               <input type="text" name="ano_refere" maxlength="4" size="4"  class="search-input1" value = "<?php echo($ano_refere)?>"  />

            Ano Previs&atilde;o
              <input type="text" name="ano_prevdespr" maxlength="4" size="4"  class="search-input1" value = "<?php echo($ano_prevdespr)?>"  /></th>
          </tr>    
       <?php 
	        $msg=""; 
	       if (isset($id_grupocustor) && isset($cod_sidespreal) && isset($ano_prevdespr)){
	         if ($id_grupocustor <> "" && $cod_sidespreal <> "" && $ano_prevdespr <> "" ){
				 $anodp = $ano_prevdespr - 1;
                /*
				 echo("<tr><th colspan = 3 align = center>     <table width=90%  border=1 >");
				     despesas_realiz($id_grupocustor,$cod_sidespreal,$anodp);
		         echo("</table></tr></th>");
				*/
				$rsvlrm = mysql_query("SELECT max(val_custoreal) maior_valor FROM tb_custoreal
                                      where cod_sidespreal = '" . $cod_sidespreal . "' and ano_custoreal = '" . $anodp . "'");
			    $rowv1 = mysql_fetch_assoc($rsvlrm);
				
				$msg = " <p>Valor Máximo do Item no ano anterior : " .number_format($rowv1['maior_valor'],2,",",".") . "<p>";

			 }
		   }
		   ?>	   
       
          <tr>
            <th align="left">Percentual da Corre&ccedil;&atilde;o</th>
            <th colspan="2" align="left">
            <input type="text" name="val_perccorr" value ="<?php echo($val_perccorr); ?>"  class="search-input3"/>
            %<?php  echo($msg); ?>
            
            
            </th>
          </tr>
      <tr>
        <th align="center" colspan="3">
        <?php if ($btn == 's'){ ?>

          <input type="submit" name="botao"  onClick="valida_correcao();" value="Gravar" class="search-submit2" />
          <input type="reset" name="button" id="button" value="Limpar Formulario" onclick="resetForm();" class="search-submit2">
       <?php } ?>
         <input type="button" onClick="sair1();" value="Sair" class="search-submit2">
         
         <!--p>Registros Gravados <input name="contador"  type="text" id="contador" size="5" dir="rtl" readonly="readonly"  /> </p-->
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
        </select></th>
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
           <!--a href="custoprevdra01.php?id=<?php echo ($row['id_prevdespr']);?>"--><?php echo ($row['id_prevdespr']);?></a></td>
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
