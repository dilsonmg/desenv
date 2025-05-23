<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();
$data1 = date("Y/m/d");
$data2 = date("Y/m/d");

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

$id = $_GET ["id"];

$habilit = "S";
$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p41 = "";

$p300 = "";
$p400 = "";
$dp1="";
$dp2="";

if (isset($dtp2)){
	  $data_1 = substr($dtp2,1,10);
      $data_2 = substr($dtp2,1,10);

}
	


if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p300 = " and a.data_saida >= '" . formata_data2($data_1) ."'" ; 
		 $dp1 = $data_1;
		 $dtp1e = $data_1;

	 }
}

if($data_1 == ""){
		$rs300   = mysql_query("select max(data_saida) maior_saida from tb_saidmatp ");
        $row300 = mysql_fetch_assoc($rs300);
	    $cp300  = $row300['maior_saida'];
   	    $p300 = " and a.data_saida >= '" . $cp300 ."'" ; 	
	}


//echo($data_2);
if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p400 = " and a.data_saida <= '" . formata_data2($data_2) ."'" ; 
		 $dp2 = $data_2;
		 $dtp2e = $data_2;
				 
	}
}

//echo("data_2=".$data_2);


if($data_2 == ""){
		$rs400   = mysql_query("select max(data_saida) maior_saida from tb_saidmatp ");
        $row400 = mysql_fetch_assoc($rs400);
	    $cp400  = $row400['maior_saida'];
   	    $p400 = " and a.data_saida <= '" . $cp400 ."'" ; 	
	}



if($data_1 == ""){$data_1 = $hoje;}
if($data_2 == ""){$data_2 = $hoje;}

////sempre a movimentacao do dia

$data_1 = $hoje;
$data_2 = $hoje;



if (isset($data_1)){
	if ($data_1 <> "" ){
//		 $p1 = " and a.data_venc >= '" . formata_data2($data_1) ."'" ; 
		 $p1 = " and w.data_entrada >= '" . formata_data2($data_1) ."'" ; 
		 $p11 = " and v.data_saida >= '" . formata_data2($data_1) ."'" ; 
	
	
		 }}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 //$p2 = " and a.data_venc <= '" . formata_data2($data_2) ."'" ; 
		 $p2 = " and w.data_entrada <= '" . formata_data2($data_2) ."'" ; 
		 $p21 = " and v.data_saida <= '" . formata_data2($data_2) ."'" ; 		 
		 
		 }}
if (isset($mprimaps)){
	if ($mprimaps <> "" ){
		if (is_numeric($mprimaps)){
			$p3 = " and a.cod_prod = '" . $mprimaps . "'"; }
		else{
		    $p4 = " and b.descr_prod like '%" . $mprimaps ."%'" ; }
		 }}		 


if (isset($mlinha)){
	if ($mlinha <> "" ){
		    $p4 = " and b.linha =  '" . $mlinha ."'" ; }
}		 

		 
//DATEDIFF(t.data_conserto,CURDATE())

/*
echo("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
                    DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
                    DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,c.cod_fornec,c.rz_social,
                    d.tt_entradalote,d.tt_saidalote,d.sald_lote,
                    if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote, w.quantid_ent, v.quantid_said
                    from tb_entmatp a  
                    inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . "
                    inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
                    inner join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
					left outer join tv_ttentmatp w on w.cod_prod = a.cod_prod and w.num_lote = a.num_lote and w.data_entrada = a.data_entrada
					 " . $p1  . $p2 ."
                    left outer join tv_ttsaidmatp v on v.cod_prod = a.cod_prod and v.num_lote = a.num_lote and v.data_saida = a.data_entrada
					 " . $p11  . $p21 ."
                     where a.id_entmatp > 0 " . $p3 . "
					 group by a.cod_prod, a.num_lote
                    order by a.cod_prod asc");				
					
	*/						
					
$rs20 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
                    DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
                    DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,c.cod_fornec,c.rz_social,
                    d.tt_entradalote,d.tt_saidalote,d.sald_lote,
                    if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote, w.quantid_ent, v.quantid_said
                    from tb_entmatp a  
                    inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . "
                    inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
                    inner join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
					left outer join tv_ttentmatp w on w.cod_prod = a.cod_prod and w.num_lote = a.num_lote and w.data_entrada = a.data_entrada
					 " . $p1  . $p2 ."
                    left outer join tv_ttsaidmatp v on v.cod_prod = a.cod_prod and v.num_lote = a.num_lote and v.data_saida = a.data_entrada
					 " . $p11  . $p21 ."
                     where a.id_entmatp > 0 " . $p3 . "
					 group by a.cod_prod, a.num_lote
                    order by a.cod_prod asc");				  
$row33a = mysql_fetch_assoc($rs20);
$cd_prodini = $row33a['cod_prod'];					
					
/*
select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer, DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf, DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf,
b.descr_prod,c.cod_fornec,c.rz_social, d.tt_entradalote,d.tt_saidalote,d.sald_lote,
if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote, w.quantid_ent, v.quantid_said
from tb_entmatp a
inner join tb_produto b on a.cod_prod = b.cod_prod
inner join tb_fornecedor c on c.cod_fornec = a.cod_fornec
inner join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
left outer join tv_ttentmatp w on w.cod_prod = a.cod_prod and w.num_lote = a.num_lote and w.data_entrada = a.data_entrada
left outer join tv_ttsaidmatp v on v.cod_prod = a.cod_prod and v.num_lote = a.num_lote and v.data_saida = a.data_entrada
where a.id_entmatp > 0 group by a.cod_prod, a.num_lote order by a.cod_prod asc


view de saidas de produtos acabados por cod_prod lote e dia

SELECT a.cod_prod, b.descr_prod, a.num_lote, sum(a.quantid) tt_quantid, a.data_nf
  from tb_saidaprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
group  by a.cod_prod,a.num_lote, a.data_nf
order by a.data_nf desc,num_lote desc
														

	
echo("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
                    DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,
                    DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,c.cod_fornec,c.rz_social,
                    d.tt_entradalote,d.tt_saidalote,d.sald_lote,
                    if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote, w.quantid_ent, v.quantid_said
                    from tb_entmatp a  
                    inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . "
                    inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
                    inner join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
					left outer join tv_ttentmatp w on w.cod_prod = a.cod_prod and w.num_lote = a.num_lote 
					 " . $p1  . $p2 ."
                    left outer join tv_ttsaidmatp v on v.cod_prod = a.cod_prod and v.num_lote = a.num_lote 
					 " . $p11  . $p21 ."
                     where a.id_entmatp > 0 " . $p3 . "
					 group by a.cod_prod, a.num_lote
                    order by a.cod_prod asc");	
*/
$rs2 = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
                    DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,year(a.data_venc) ano_venc,
                    DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
                    DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,c.cod_fornec,c.rz_social,
                    d.tt_entradalote,d.tt_saidalote,d.sald_lote,
                    if(d.sald_lote is null,d.tt_entradalote,d.sald_lote) tt_lote, w.quantid_ent, v.quantid_said
                    from tb_entmatp a  
                    inner join tb_produto b on a.cod_prod = b.cod_prod " . $p4 . $p41 . "
                    inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
                    left outer join tv_ttsaidalote d on d.cod_prod = a.cod_prod and d.num_lote = a.num_lote
					left outer join tv_ttentmatp w on w.cod_prod = a.cod_prod and w.num_lote = a.num_lote 
					 " . $p1  . $p2 ."
                    left outer join tv_ttsaidmatp v on v.cod_prod = a.cod_prod and v.num_lote = a.num_lote 
					 " . $p11  . $p21 ."
                     where a.id_entmatp > 0 " . $p3 . "
					 group by a.cod_prod, a.num_lote,v.data_saida,w.data_entrada
                    order by a.cod_prod asc");				  
    $b = mysql_num_rows($rs2);
	$msglotes = "";
	
	
	 $rs20a = mysql_query("SELECT a.*,b.descr_prod,DATEDIFF(CURDATE(),a.data_saida)dias_saida 
							,DATE_FORMAT(c.data_fab, '%d/%m/%Y') data_fab,
							DATE_FORMAT(c.data_venc, '%d/%m/%Y') data_venc
							FROM tb_saidmatp a
							   inner join tb_produto b on a.cod_prod = b.cod_prod 
							   inner join tb_entmatp c on c.cod_prod = a.cod_prod and c.num_lote = a.num_lote
							                              
							   where a.id_saidmat > 0 " . $p300 .$p400 ."	
									 group by a.cod_prod, a.num_lote,a.quantid_said , a.data_saida ,a.lote_fabricado
									 order by a.data_saida desc  limit 150");				  
			  	
//unset($data_1);			

///// datas de saidas de materias primas ////
$rs2000 = mysql_query("SELECT DATE_FORMAT(a.data_saida, '%d/%m/%Y')data_saida FROM tb_saidmatp a
						group by a.data_saida order by a.data_saida desc limit 20");

//// datas de entradas de materias primas ////

///////////////////////////////////   Entradas de Materias primas ///////////////////////////////////////////////////
$p5e = "";

$cp400e="";
$rs400e   = mysql_query("select max(data_entrada) maior_entrada from tb_entmatp ");
$row400e = mysql_fetch_assoc($rs400e);
$cp400e  = $row400e['maior_entrada'];
$maior_entrada = $row400e['maior_entrada'];


if (isset($dtp1)){
		 $p5e = " and a.data_entrada = '" . str_replace("'","",formata_data2($dtp1)) ."'"  ; 

}

if (isset($m_primapesq)){
	if ($m_primapesq <> "" ){
        if(!is_numeric($m_primapesq)){
		     $p1e = " and b.descr_prod like '%". $m_primapesq ."%'" ; }
		 else{
			 $p1e = " and b.cod_prod like '%" . $m_primapesq ."%'" ; }
		 }}

//echo($dtp2e);

if (isset($dtp1e)){
	if ($dtp1e <> ""  ){
		 $p3e = " and a.data_entrada >= '" . formata_data2($dtp1e) ."'" ; 
	 }
}else{
		 $p3e = " and a.data_entrada = '" . $maior_entrada ."'" ; 

}
if (isset($dtp1e)){
	if ($dtp1e <> ""  ){
		 $p4e = " and a.data_entrada <= '" . formata_data2($dtp2e) ."'" ; 
	 }
}else{
		 $p3e = " and a.data_entrada = '" . $maior_entrada ."'" ; 

}

$rs3000 = mysql_query("SELECT DATE_FORMAT(a.data_entrada, '%d/%m/%Y')data_entrada FROM tb_entmatp a
                       group by a.data_entrada order by a.data_entrada desc limit 20");


if (isset( $dtp1) and $dtp1 == "" ){
	echo($dtp1);
	$p3e = " ";
	$p4e = " ";
   $p400e = " and a.data_entrada = '" . $cp400e ."'" ; 	
}

if (isset( $dtp1) and $dtp1 <> "" ){
	echo($dtp1);
	$p3e = " ";
	$p4e = " ";
   $p400e = " and a.data_entrada = '" . str_replace("'","",formata_data2($dtp1)) ."'" ; 	
}		   
$rs2e = mysql_query("select a.* , DATEDIFF(a.data_venc,CURDATE()) dias_avencer,
						DATE_FORMAT(a.data_entrada, '%d/%m/%Y') data_entrada1,
						DATE_FORMAT(a.data_nf, '%d/%m/%Y') data_nff,year(a.data_venc) ano_venc,
						DATE_FORMAT(a.data_fab, '%d/%m/%Y') data_fabf,
						DATE_FORMAT(a.data_venc, '%d/%m/%Y') data_vencf, b.descr_prod,b.cod_prod,c.cod_fornec,c.rz_social
						from tb_entmatp a
						 inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1e . "
						 inner join tb_fornecedor  c on c.cod_fornec = a.cod_fornec
						 where a.id_entmatp > 0 " .$p3e . $p4e . $p400e. $p5e.  " order by a.data_entrada desc");				  
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
	<title>MATPCV001 - CONSULTA VENCIMENTOS DE MATERIAS PRIMAS</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
/*
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}
	*/
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="matpcv001.php";
		  document.form1.submit();  
		  return true;
	//	  }

}
function refazform(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="matpcv001.php";
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
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">
<table width="100%" border="0">
      <tr>
        <th align-"left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h2>Vencimentos de Mat&eacute;rias Primas em : <?php echo($hoje); ?></h2></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a>
        </th>
      </tr>
      <tr>
        <th colspan="3" align="center"  bgcolor="#8080FF">Filtros de Pesquisa</th>
      </tr>
      <tr>
        <th colspan="3" align="center">M. Prima
          <input type="text" id = "mprimaps" name="mprimaps"  maxlength="40" size="40" >
          Periodo
          <input type="text" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);"/>
a
<input type="text" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);"/>
Linha
        <select name="mlinha" >
          <option value="" >Todas</option>
          <option value="EMBALAGEM"> Embalagens </option>
        </select>

<input type="button"  name="gravar"   value="Filtrar" onClick="refazform();" />
<input type="button" onClick="sair();" value="Sair"></th>
      </tr>
    
            <tr >
              <td colspan="4" align="center">
                <?php
			    if($dp1 !=""){
					?>
                     
                <p>Período Pesquisado1 :<?php echo($dp1 . " a " . $dp2); ?></p>
			 <?php } else { 
				    	if(isset($dtp1)){?>
						 <p>Período Pesquisado :<?php echo(substr($dtp1,1,10) . " a " . substr($dtp1,1,10)); ?></p>
				 <?php  } else { ?>
						  <p>Período Pesquisado :<?php echo($data_1 . " a " . $data_2); ?></p>
				  <?php } 
			    }?>              
              </td>
            </tr>
            
            <tr >
              <td colspan="4" align="center">
                 <table border=1 width="100%">
                   <tr  bgcolor="#B3B3D9">
                   <th><b>Entradas</b></th>
                     <?php
					    while($row=mysql_fetch_array($rs3000)){ 
						$lnk = "<th><a href=matpcv001.php?dtp1='" .$row['data_entrada'] ."'>".$row['data_entrada']."</a>" ;
                          echo($lnk ."</th>");
						}
						?>
                    </tr>
                    </table>
                   
              
              </td>
            </tr>
               <tr >
              <td colspan="4" align="center">
                 <table border=1 width="100%">
                   <tr  bgcolor="#B3B3D9">
                   <th><b>Saidas</b></th>
                     <?php
					    while($rows=mysql_fetch_array($rs2000)){ 
						$lnk2 = "<th><a href=matpcv001.php?dtp2='" .$rows['data_saida'] ."'>".$rows['data_saida']."</a>" ;
                          echo($lnk2 ."</th>");
						}
						?>
                    </tr>
                    </table>
                   
              
              </td>
            </tr>
         
            
            <tr align="center">
              <td colspan="4" align="center">
              <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Codigo</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="2"  bgcolor="#A8A8FF">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#9DFF9D">Lote / Partida</th>
                  <th rowspan="2">Ativo Kamoran</th>
                  <th rowspan="2">Inicial</th>
                  <th rowspan="2">Entrada</th>
                  <th rowspan="2">Saida</th>
                  <th rowspan="2">Saldo KG</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	   $tt_soma = 0;
	   $tot_saida = 0.00;
	   $tot_entrada = 0.00;
	   $totg_s = 0.00;
	   $totg_e = 0.00;
	  
	    
	  
	  
	  while($row=mysql_fetch_array($rs2)){ 
	  
	   $msk = "S";
	   if(strtoupper($row['unidade']) != "KG"){
			 $msk = "N";
		}
	  
	  if($row['tt_lote'] > 0 ){
	  
       if($bg == 1){
			   	    $bgc = "bgcolor=#E8E8E8";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');
       if ($row['cod_prod'] != $cd_prodini && $tot_prod > 0){  ?>
              <tr bgcolor="#E1E1FF">
                <td colspan="11" align="center" ><div align="right">T O T A L</div></td>
                <td align="right" ><?php  
				  if ($msk == "S") {
				      echo (number_format($tot_entrada,3,',','.'));
				  }else{
				      echo (number_format($tot_entrada,0,'',''));					  
				  }
					  ?></td>
                <td align="right" ><?php 
				 	if ($msk == "S") {
				       echo (number_format($tot_saida,3,',','.'));}
					else{
					   echo (number_format($tot_saida,0,',','.'));
					}
				 ?></td>
                <td align="right"><?php 
				 	if ($msk == "S") {
  				     echo (number_format($tot_prod,3,',','.'));
					}else{
					 echo (number_format($tot_prod,0,',','.'));
					}	
						
				 ?></td>
              </tr>
           <?php 
			   $tot_prod = 0.00;
			   $tot_saida = 0.00;
			   $tot_entrada = 0.00;

			} 
		
			?>
              <tr>
                <td align="left" >
          
		   <?php echo ($row['rz_social']);?></td>
                <td align="left" ><?php echo ($row['cod_prod']);?></td>

           <td align="left" ><?php echo ($row['descr_prod']);
		   		   if ($row['msg_lote'] <> ""){ $msglotes =  $msglotes . "<br> <font color=#999999 align = left> Lote :" .$row['num_lote'] . " - " . $row['msg_lote'] . "</font><br>";}

//		      if ($row['msg_lote'] <> ""){ echo("<br> <font color=#999999> " . $row['msg_lote'] . "</font>");
	///		  }
		   ?></td>
           <td  align="center"><?php 
		             echo (strtoupper($row['unidade']));
					 ?></td>
           <td align="center" >		   
		   <?php 
		       $cd_prodini = $row['cod_prod'] ;
		       $cdprod = $row['cod_prod'];
			   $cdlote = $row['num_lote'];
		   echo ($row['num_nf']);
		   
		   $rs2000 = mysql_query("select a.cod_prod,a.num_lote,a.num_nf,a.data_nf from tb_entmatp a
                               where a.cod_prod = '" . $cdprod .  "' and a.num_lote = '" .$cdlote . "' order by a.cod_prod,a.num_lote ");
	  	 /*
		  while($row2000=mysql_fetch_array($rs2000)){ 
               echo($row2000['num_nf'] . "<br>");
		  }
		  */
		   ?></td>
           <td align="center" ><?php echo ($row['data_nff']);?></td>
           <td align="center"><?php echo ($row['num_lote']);?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));
		  
		   ?></td>
           <td align="center"><?php 
		   
		     if($row['ano_venc'] == 0 || $row['ano_venc'] == ''){
			   echo("<b><font color='#0000FF'> Indeterminado </font></b>"); } 
		   else{
		   		echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   		if(strtotime($row['data_venc']) < strtotime($data2)){
                	echo ('<b><font color="#FF0000"> - Vencido a ' . $row['dias_avencer'].' dias </font>');}
          		else {
			    	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>'); 
		  		}
		   }
		   ?></td>
           <td align="center"><?php echo ($row['atv_kamoran']); 
		   		   
		   ?></td>
           <td align="right"><?php 
		   if ($msk == "S") {
			        
				     echo (number_format(($row['tt_lote'] -$row['quantid_ent'] + $row['quantid_said']),3,',','.')); 
		   }else{
				     echo (number_format(($row['tt_lote'] -$row['quantid_ent'] + $row['quantid_said']),0,',','.')); 
		   }
		    ?></td>
           <td align="right"><?php 
		   if ($msk == "S") {
		       echo (number_format($row['quantid_ent'],3,',','.')); 
		   }else{
		       echo (number_format($row['quantid_ent'],0,',','.')); 			   
		   }
		   
		   ?></td>
           <td align="right"><?php 
		    if ($msk == "S") {
		        echo (number_format($row['quantid_said'],3,',','.')); 
			}else{
			   echo (number_format($row['quantid_said'],0,',','.')); 	
			}
			  
			  
		   $tot_entrada = $tot_entrada + $row['quantid_ent'];
		   $totg_e      = $totg_e  + $row['quantid_ent'];
		   $tot_saida = $tot_saida + $row['quantid_said'];
		   $totg_s    = $totg_s    + $row['quantid_said'];
		   ?></td>
           <td align="right"><?php 
		   	   if ($msk == "S") {
		         echo (number_format($row['tt_lote'],3,',','.')); }
		       else{
		         echo (number_format($row['tt_lote'],0,',','.')); 		   
			   }
		   		   $tt_soma = $tt_soma + $row['tt_lote']; 
				   $tot_prod = $tot_prod + $row['tt_lote']; 
		   ?></td>
              </tr>
          <?php 
		   } 
	      }
	     }
		  ?>     
              <tr bgcolor="#E1E1FF">
                <td colspan="11" align="right" >T O T A L </td>
                <td align="right"><?php  
				 if ($msk == "S") {
				    echo (number_format($tot_entrada,3,',','.'));}
			     else{
				    echo (number_format($tot_entrada,0,',','.'));			     
				 }
				?></td>
                <td align="right"><?php
				if ($msk == "S") {
				  echo (number_format($tot_saida,3,',','.'));
				}else{
				  echo (number_format($tot_saida,0,',','.'));
				}
				  ?></td>
                <td align="right"><?php 
				if ($msk == "S") {
				   echo (number_format($tot_prod,3,',','.'));
				}else{
				  echo (number_format($tot_prod,0,',','.'));
					
				}
				   
				   ?></td>
              </tr>

               <tr>
                <td colspan="9" >&nbsp;</td>
                <td colspan="2" align="center">Total Geral</td>
                <td align="right"><b><?php echo (number_format($totg_e,3,',','.'));?></b></td>
                <td align="right"><b><?php echo (number_format($totg_s,3,',','.'));?></b></td>
                <td align="right"><b><?php echo (number_format($tt_soma,3,',','.'));?></b></td>
              </tr>
               <tr>
                 <td colspan="14" ><?php  echo($msglotes); ?></td>
                </tr>
 
              </table>
              
         </td>
         </tr>
           
    </table>
     
             <div align="center"   style="background:#003366"><font color="#FFFFFF"> Sa&iacute;das - Mat&eacute;rias Primas utilizadas no Per&iacute;odo </font></div>

    <table width="100%" border="1">
                 <tr bgcolor="#D2D2FF" >
                  <td  >Mat&eacute;ria Prima</td>
                  <td align="center" >N. Lote</td>
                  <td align="center">Dt. Sa&iacute;da</td>
                  <td align="center" >Sd. Anterior</td>
                  <td align="center" >Qtd. Ulizada</td>
                  <td align="center" >Unidade</td>
                  <td align="center" >Saldo Atual</td>
                  <td align="center">Lote Fabricado</td>
                  <td align="center">Motivo</td>
                </tr>
     <?php
//echo($b);
	   $bg = 0;

	  while($rowxx=mysql_fetch_array($rs20a)){ 

		  if($bg == 1){
				$bgc = "bgcolor=#eee";  $bg = 0;}
		  else{ $bgc = ''; $bg = 1;}	
				  
		  echo('<tr ' . $bgc .'>');?>
        
        <?php
		
				$rs20xx = mysql_query("select a1.num_lote,b1.descr_prod as prod_fabric from  tb_entprodac a1
                                      inner join tb_produto b1 on a1.cod_prod = b1.cod_prod
                                      where a1.num_lote = '" . $rowxx['lote_fabricado'] ."' limit 1");
				$rowxx2 = mysql_fetch_array($rs20xx);
								
			?>
           <tr>
             <td >
           <?php echo ($rowxx['cod_prod'] . " - " . $rowxx['descr_prod']);?></td>

           <td align="right"><?php echo ($rowxx['num_lote']);?></td>
           <td align="center" ><?php echo (strftime("%d/%m/%Y", strtotime($rowxx['data_saida'])));?></td>
           <td align="right" ><?php echo (number_format($rowxx['saldo_anterior'],3,",",""));?></td>
           <td align="right" ><?php echo (number_format($rowxx['quantid_said'],3,",",""));?></td>
           <td align="right" ><?php echo ($rowxx['unidade']);?></td>
           <td align="right"><?php echo (number_format(($rowxx['saldo_anterior'] - $rowxx['quantid_said']),3,",","")); ?></td>
           <td align="center"><?php echo ($rowxx['lote_fabricado'] . " - " . $rowxx2['prod_fabric']);?></td>
           <td align="center">     
               <?php 
		   switch ($rowxx['motivo']) {
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
	  } 
	     unset($dtp1,$data_1,$data_2);
		  ?>      
         </table>
<br>
         <br>
         <div align="center"   style="background:#003366"><font color="#FFFFFF"> Entradas de Matérias Primas </font></div>
          <table width="100%" border="1">
                <tr bgcolor="#D2D2FF" >
                  <th rowspan="2" >Data Entrada</th>
                  <th rowspan="2" >Fornecedor</th>
                  <th rowspan="2" >Fabricante</th>
                  <th rowspan="2" >Produto</th>
                  <th rowspan="2" >Unidade</th>
                  <th colspan="3"  bgcolor="#009999">Nota Fiscal</th>
                  <th colspan="3"  bgcolor="#00FF66">Lote / Partida</th>
                  <th>Especificacao</th>
                  <th>&nbsp;</th>
                </tr>
                <tr bgcolor="#D2D2FF" >
                  <th >Numero</th>
                  <th >Data</th>
                  <th >Quantidade</th>
                  <th >N. Lote</th>
                  <th >Dt. Fab.</th>
                  <th >Dt. Venc.</th>
                  <th>&nbsp;</th>
                  <th>Motivo</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2e)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

              <tr>
                <td ><?php echo($row['data_entrada1']);?></td>
                <td >
           <a href="#?id=<?php echo ($row['id_entmatp']);?>"><?php echo ($row['rz_social']);?></a></td>
                <td ><?php echo ($row['nm_fabric']);?></td>

           <td ><?php echo ($row['cod_prod'] . " - " . $row['descr_prod']);?></td>
           <td  align="center"><?php echo ($row['unidade']);?></td>
           <td align="right" ><?php echo ($row['num_nf']);?></td>
           <td align="center" ><?php echo ($row['data_nff']);?></td>
           <td align="right" ><?php echo ($row['quantid_ent']);?></td>
           <td align="right"><?php echo ($row['num_lote']);?></td>
           <td align="center"><?php echo (strftime("%d/%m/%Y", strtotime($row['data_fab'])));
		  
		   ?></td>
           <td align="center"><?php 
		     if($row['ano_venc'] == 0 || $row['ano_venc'] == ''){
			   echo("<b><font color='#0000FF'> Indeterminado </font></b>"); } 
		   else{
		   		echo (strftime("%d/%m/%Y", strtotime($row['data_venc'])));
		   		if(strtotime($row['data_venc']) < strtotime($data2)){
                	echo ('<b><font color="#FF0000"> - Vencido a ' . $row['dias_avencer'].' dias </font>');}
          		else {
			    	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>'); 
		  		}
		   }
		   ?></td>
           <td align="center"><?php echo ($row['atv_kamoran']); 
		   		   
		   ?></td>
           <td align="center">
            <?php 
		   switch ($row['motivo_ent']) {
			case 1:
				echo("Compra");
				break;
			case 2:
				echo("Devolucão");
				break;
			case 3:
				echo("Bonificacão");
				break;
		  }
		  ?>
           </td>
            </tr>
          <?php 
		   } 
	     }
		  ?>      
         </table>

    
    
</form> 
</center>
</body>
</html>
