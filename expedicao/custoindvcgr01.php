<?php
/*
SELECT a.*,b.descr_despreal FROM tb_custoreal a
 inner join tb_despreal b on b.cod_sidespreal = a.cod_sidespreal
where a.ano_custoreal = 2022
group by a.ano_custoreal,a.mes_custoreal,a.cod_sidespreal
order by b.descr_despreal,a.ano_custoreal,a.mes_custoreal

;
*/
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$p1 = "";
$p2 = "";
$p3 = "";

$tt_custo = 0.00;

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
	     $id_despreal     = "";
		 $id_despreal  = "";
		// $mes_custoreal     = "";
		// $ano_custoreal     = "";
		 $val_custoreal     = "";
		 $obs_custoind     = "";

$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())
//  DATEDIFF(a.data_venc,CURDATE()) dias_avencer,

/*
individual por item
select a.* ,b.descr_despreal,b.id_despreal,d.descr_grupocc
					 from tb_custoreal a
					 inner join tb_despreal b on a.id_despreal = b.id_despreal
           left outer join tb_vinccustor c on a.id_despreal = c.id_despreal
           left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto
					 where a.id_despreal > 0
					 order by  a.ano_custoreal asc,a.mes_custoreal asc,d.descr_grupocc
					 
toral dos itens por grupo
					 
select a.id_despreal,a.id_despreal,a.ano_custoreal,sum(val_custoreal) tot_item
       ,b.descr_despreal,b.id_despreal,d.descr_grupocc
					 from tb_custoreal a
					 inner join tb_despreal b on a.id_despreal = b.id_despreal
           left outer join tb_vinccustor c on a.id_despreal = c.id_despreal
           left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto
					 where a.id_despreal > 0
group by a.id_despreal,a.ano_custoreal
					 order by  a.ano_custoreal asc,d.descr_grupocc,b.descr_despreal				
					 

mkt

select a.id_eventomkt,b.descr_eventomkt, a.ano_saida, sum(a.quantid*a.vlr_unit) total_saida
    from tb_saidvbmkt a
    inner join tb_eventomkt b on a.id_eventomkt = b.id_eventomkt
   group by a.id_eventomkt
order by  a.ano_saida,a.id_eventomkt
					 	 

*/

$rs34 = mysql_query("select a.* from tb_grupoccusto a  order by a.descr_grupocc");

if(isset($cod_sidespreal2)){
	if($cod_sidespreal2 != ""){
		$p1 = " and a.cod_sidespreal = '" .$cod_sidespreal2 . "'";
	}
}
$p1a = '';
$p2a = '';
$p2 = '';
$p3 = '';
$p3a = '';

$pr2a = '';
$pr2 = '';
$pr3 = '';
$pr3a = '';


$pc2a = '';
$pc2 = '';
$pc3 = '';
$pc3a = '';


$p4= '';

//str_pad('100' , 4 , '0' , STR_PAD_LEFT);
$data_i = "'".$ano_custoreal."-".$mes_custoreal."-01'";
$data_f = "'".$ano_custorealf."-".$mes_custorealf."-31'";

$anomesi = $ano_custoreal . str_pad($mes_custoreal,2,'0',STR_PAD_LEFT);
$anomesf = $ano_custorealf . str_pad($mes_custorealf,2,'0',STR_PAD_LEFT);

if (isset($id_grupocusto)){
	if($id_grupocusto != ""){
		$p4 = " and c.id_grupocusto = '" .$id_grupocusto . "'";
	}
}
	

if(isset($mes_custoreal)){
	if($mes_custoreal != ""){
		//$p2 = " and a.mes_custoreal >= " .$mes_custoreal . "";
		$p2 = " and concat(a.ano_custoreal,lpad(a.mes_custoreal,2,0)) >= " .$anomesi;
		
		$pr2 = " and a.data_inic >= " .$data_i . "";
	//	$pc2 = " and a.mes_rdv <= " .$mes_custoreal . "";
		$pc2 = " and concat(a.ano_custoreal,lpad(a.mes_custoreal,2,0)) >= " .$anomesi;
		$pc3 = " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0)) >= " .$anomesi ;
		$pr3 = " and a.data_inic <= " .$data_f . " and a.ano_saida >= " .$ano_custoreal;

	}      

}
if(isset($ano_custoreal)){
	if($ano_custoreal != ""){
//		$p3 = " and a.ano_custoreal >= " .$ano_custoreal . "";

		//$pc3 = " and a.ano_rdv >= " .$ano_custoreal ;

	}
}
if(isset($mes_custorealf)){
	if($mes_custorealf != ""){
		$p2a = " and concat(a.ano_custoreal,lpad(a.mes_custoreal,2,0)) <= " .$anomesf;
		$pr2a = " and a.data_inic <= " .$data_f . "";
		$pc2a = " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0)) <= " .$anomesf ;

	}
}
if(isset($ano_custorealf)){
	if($ano_custorealf != ""){
		//$p3a = " and a.ano_custoreal <= " .$ano_custorealf . "";
		$pr3a = " and a.data_inic <= " .$data_f . "";
		//$pc3a =  " and concat(a.ano_rdv,lpad(a.mes_rdv,2,0))a.ano_rdv <= " .$anomesf ;

	}
}

///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					 
$rs2t = mysql_query("select sum(a.val_custoreal) tot_custo
					 from tb_custoreal a
					 inner join tb_despreal b on a.cod_sidespreal = b.cod_sidespreal " . $p1a . "
					 where a.cod_sidespreal > 0 " . $p1 . $p2 .$p3 . $p2a .$p3a . 
					 " order by b.descr_despreal ");				  
$bx = mysql_num_rows($rs2t);

$row1x = mysql_fetch_assoc($rs2t);
$tot_custog  = $row1x['tot_custo'];			  
 
$rs2 = mysql_query("select a.cod_sidespreal,sum(val_custoreal) tot_item ,b.descr_despreal,
                    b.cod_sidespreal as id_despreal,d.id_grupocusto,d.descr_grupocc
                    from tb_custoreal a
                    inner join tb_despreal b on a.cod_sidespreal = b.cod_sidespreal
                    inner join tb_vinccustor c on a.cod_sidespreal = c.cod_sidespreal " . $p4 . "
                    left outer join tb_grupoccusto d on c.id_grupocusto = d.id_grupocusto 
		 where a.cod_sidespreal > 0" . $p1 . $p2 . $p2a .$p3 .$p3a . 
					 " group by a.cod_sidespreal
					 order by tot_item desc,6,3
 ");				  
$b = mysql_num_rows($rs2);


}
///////////////fim pesquisar ////////////////////


$rs33 = mysql_query("select a.* from tb_despreal a order by a.descr_despreal");				  	
$rs331 = mysql_query("select a.* from tb_despreal a order by a.descr_despreal");				  	

$habilia = 0;
if (isset($id)){
    $habilita = 1;
    $rs1 = mysql_query("SELECT a.* FROM tb_custoreal a where a.id_despreal ='". $id. "'");
	
    $a = mysql_num_rows($rs1);
   
     if ($a > 0 ) {
         $habilit = "N";
	 
         $rs1 = mysql_query("SELECT a.* FROM tb_custoreal a where a.id_despreal = '". $id . "'");
    	 $row1 = mysql_fetch_assoc($rs1);

		 $id_despreal     = $id;
		 $id_despreal  = $row1['id_despreal'];
		 $mes_custoreal     = $row1['mes_custoreal'];
		 $ano_custoreal     = $row1['ano_custoreal'];
		 $val_custoreal     = $row1['val_custoreal'];
		 $obs_custoind     = $row1['obs_custoind'];

	  }
	 
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
	<title>Custoindv001- Consulta Custos por Linha</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="custoindvc01.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input type=hidden name="cod_prod2" value="<?php echo("$cod_prod");?>">

<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="98%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
         <th align="center"><h1>Consulta  Despesas Realizadas por - Linhas
        <?php
	echo($_SESSION['id_entmatp']);
		  ?>
      </h1></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
         <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      </table>
 <table width="98%" border="0">
 <tr>
    <th colspan="2" align="center"><select name="cod_sidespreal2" class="search-input6" <?php if($habilita ==1) echo(" disabled ");?>>
                <option value="">Selecione a Despesa</option>
                <?php while($row331=mysql_fetch_assoc($rs331)){ ?>
                <option value="<?php print($row331['cod_sidespreal'])?>"
				  <? if($row331['cod_sidespreal'] == $cod_sidespreal2 ) {?>selected <? } ?>				
				 ><?php print($row331['descr_despreal'] )?></option>
                <?php }?>
              </select>
             Linha 
                   <select name="id_grupocusto"   class="search-input3">
                     <option value="">Selecione o Grupo</option>
                     <?php while($row33=mysql_fetch_assoc($rs34)){ ?>
                     <option value="<?php echo($row33['id_grupocusto']);?>"
				  <? if($row33['id_grupocusto'] == $id_grupocusto ) {?>selected <? } ?>				
				 ><?php echo($row33['descr_grupocc']);?></option>
                     <?php }?>
                   </select>
             <br>
                 
              
  Mes inicial                     
    <select name="mes_custoreal" class="search-input4" >
                  <option value="">Selecione o Mês</option>
                  <option value="01" <?php if($mes_custoreal == "01" ){ echo(" selected "); }?>>Jan</option>
                  <option value="02" <?php if($mes_custoreal == "02" ){ echo(" selected "); }?>>Fev</option>
                  <option value="03" <?php if($mes_custoreal == "03" ){ echo(" selected "); }?>>Mar</option>
                  <option value="04" <?php if($mes_custoreal == "04" ){ echo(" selected "); }?>>Abr</option>
                  <option value="05" <?php if($mes_custoreal == "05" ){ echo(" selected "); }?>>Mai</option>
                  <option value="06" <?php if($mes_custoreal == "06" ){ echo(" selected "); }?>>Jun</option>
                  <option value="07" <?php if($mes_custoreal == "07" ){ echo(" selected "); }?>>Jul</option>
                  <option value="08" <?php if($mes_custoreal == "08" ){ echo(" selected "); }?>>Ago</option>
                  <option value="09" <?php if($mes_custoreal == "09" ){ echo(" selected "); }?>>Set</option>
                  <option value="10" <?php if($mes_custoreal == "10" ){ echo(" selected "); }?>>Out</option>
                  <option value="11" <?php if($mes_custoreal == "11" ){ echo(" selected "); }?>>Nov</option>
                  <option value="12" <?php if($mes_custoreal == "12" ){ echo(" selected "); }?>>Dez</option>
              </select>
Ano Inicial
<input type="text" id = "ano_custoreal" required name="ano_custoreal"  maxlength="4" size="10" 
   placeholder="informe o ano inicial"  value="<?php echo($ano_custoreal); ?>" class="search-input4">
Mes Final
<select name="mes_custorealf" class="search-input4" >
  <option value="">Selecione o M&ecirc;s</option>
  <option value="01" <?php if($mes_custorealf == "01" ){ echo(" selected "); }?>>Jan</option>
  <option value="02" <?php if($mes_custorealf == "02" ){ echo(" selected "); }?>>Fev</option>
  <option value="03" <?php if($mes_custorealf == "03" ){ echo(" selected "); }?>>Mar</option>
  <option value="04" <?php if($mes_custorealf == "04" ){ echo(" selected "); }?>>Abr</option>
  <option value="05" <?php if($mes_custorealf == "05" ){ echo(" selected "); }?>>Mai</option>
  <option value="06" <?php if($mes_custorealf == "06" ){ echo(" selected "); }?>>Jun</option>
  <option value="07" <?php if($mes_custorealf == "07" ){ echo(" selected "); }?>>Jul</option>
  <option value="08" <?php if($mes_custorealf == "08" ){ echo(" selected "); }?>>Ago</option>
  <option value="09" <?php if($mes_custorealf == "09" ){ echo(" selected "); }?>>Set</option>
  <option value="10" <?php if($mes_custorealf == "10" ){ echo(" selected "); }?>>Out</option>
  <option value="11" <?php if($mes_custorealf == "11" ){ echo(" selected "); }?>>Nov</option>
  <option value="12" <?php if($mes_custorealf == "12" ){ echo(" selected "); }?>>Dez</option>
</select>
Ano Final
<input type="text" id = "ano_custorealf" required name="ano_custorealf"  maxlength="4" size="10" placeholder="informe o ano"  
value="<?php echo($ano_custorealf); ?>" class="search-input4">
<input name="Pesquisar" type="submit" value="Pesquisar"  class="search-submit2">
<input type="button" onClick="sair1();" value="Sair"  class="search-submit2"></th>
            </tr>
            <tr align="center">
              <td colspan="2" align="center">
 
<?php            
///////////////////inicio pesquisar //////////////////

if(isset($_POST["Pesquisar"])){
              
?>
              
   <table width="80%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th >Despesa</th>
                  <th align=right>Total</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;

      $grcusto = '';
	  $totgrupo = 0.00;
	  $totcustop = 0.00;

	  $var_graf = '';
	  while($row=mysql_fetch_array($rs2)){ 
          if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
	      else{ $bgc = ''; $bg = 1;}	
			  
	     // echo('<tr ' . $bgc .'>');
		   
		  if ($grcusto == '' ){
			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha:".$row['id_grupocusto'] . " - ".$row['descr_grupocc']."</td></tr>");
			   $grcusto = $row['descr_grupocc'];
  
		  }
		  
		  if ($grcusto != $row['descr_grupocc']){
			  
			   echo("<tr  bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
			   echo(number_format($totgrupo,2,",",".")."</td></tr>"); 

			   echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linha:".$row['id_grupocusto'] . " - ".$row['descr_grupocc']."</td></tr>");

  			   $grcusto = $row['descr_grupocc'];
			  $totcustop = $totcustop  + $totgrupo;

			   $totgrupo = 0.00;
		   } 
		   
		  	  $var_graf = $var_graf . "['".$row['descr_despreal'] . "'," . $row['tot_item'].  "],";
 
		   ?>
         
           <tr>
             <td  alingn="center"> <?php  echo ($row['id_despreal'] . " - " . $row['descr_despreal']);?></td>
           <td  align="right"><?php echo (number_format($row['tot_item'],2,",","."));
		   $tt_custo = $tt_custo + $row['tot_item'];
		   $totgrupo = $totgrupo  + $row['tot_item'];
		   ?></td>
  
    
          <?php 
		  			 //  $grcusto = $row['descr_grupocc'];

		   } 
	     }
		 ?>  
          </tr>
          <?php
		   // $grcusto = $row['descr_grupocc'];
			$totgrupo = $totgrupo + $row['tot_item'];
  		    //$var_graf = $var_graf . "['".$grcusto . "'," .$totgrupo.  "],";

		       echo("<tr bgcolor=#EAEAEA><td align=center>*** Totais da Linha ***</td><td align = right>");
			   echo(number_format($totgrupo,2,",",".")."</td></tr>"); 

			  // echo ("<tr bgcolor=#B9B9FF><td colspan=3 aliggn=left> Linhaxxx:".$row['descr_grupocc']."</td><tr>");

  			   //$grcusto = $row['descr_grupocc'];
			   			  $totcustop = $totcustop  + $totgrupo;

			   $totgrupo = 0.00;
			   
				 // $tt_custo = $tt_custo  + $totgrupo;

		?>

          
          <tr  bgcolor="#D2D2FF">
             <th  align="right">Total das despesas</th>
             <th  align="right"><?php echo (number_format($totcustop,2,",","."));?></th>
           </tr>    
         </table>
 <?php
}
/////////////////fim pesquisar ///////////////


?>
         </td>
         </tr>
           
    </table>     
</form> 
</center>
<br />  
  <script type="text/javascript">

/////////////////////////////////////////////// parametros do grafico //////////////////////////////////////

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

 function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Despesa', 'Valor'],
               <?php echo($var_graf); ?>
        ]);

       var options = {
          title : 'Totais de Despesas Realizadas por linha - Período :  <?php echo($mes_custoreal . "/". $ano_custoreal . " a " .$mes_custorealf . "/". $ano_custorealf );?> ',
		  fontName: 'arial',
		  fontSize:14,
		  padding:150,
          vAxis: {title: 'Despesas',
		              color: "#687",
		              fontName: "sans-serif",
					  fontSize: 12		  
		  },
          hAxis: {title: 'Total'},
          bars: 'horizontal', // Required for Material Bar Charts.
		    bar: { groupWidth: '45%' },
			
			width: 750,
        height: 350,
          series: {6: {
			  type: 'line',
              fontSize: 12}
			  }
        };


        var chart = new google.charts.Bar(document.getElementById('chartDiv1'));


        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
	
//////////
/*

SELECT a.codigo_cli, a.cod_prod cod_produto,a.data_nf,a.quantid,a.unidade,a.val_unit,
       c.id_consult,a.cnpj
FROM tb_saidaprodac a
  inner join tb_cliente b on b.codigo_cli = a.codigo_cli
   inner join tb_regvenda c on b.cod_regiao = c.cod_regiao
group by a.num_nf,a.cod_prod

CREATE OR REPLACE VIEW `qreal_inter`.`tv_vendas` AS
SELECT codigo_cli, cod_prod cod_produto,data_nf,quantid,unidade,val_unit,
       num_nf,id_consult
FROM quimicareal.tb_saidaprodac
where year(data_nf) > 2014 and val_unit > 0
order by data_nf desc,num_nf


*/
</script>
<center>
<br>
 <table width="100%"   cellpadding="0" cellspacing="0" >
<tr align="center">
  <!--th align="center" class="esquerda" id="chartDiv1"  style="width: 620px; height: 200px;" > </th --> 
  <th>
    <div id="chartDiv1" style="width: 1050px; height: 450px;"></div>
  </th>

</tr>
</table>

</body>
</html>
