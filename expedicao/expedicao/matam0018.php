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
	     $id_itproc         = "";
		// $cod_prod         = "";
		 //$num_lote         = "";
		 $descr_analise    = "";
		 $limite_analise   = "";
$id = $_GET ["id"];

$habilit = "S";

//DATEDIFF(t.data_conserto,CURDATE())

	  //and a.num_lote = c.num_lote
	  

 $rs2 =mysql_query("SELECT a.id_entitproc,a.cod_prod,a.num_lote,a.quant_it,b.descr_prod,  DATE_FORMAT(a.data_ent, '%d/%m/%Y') data_ent1,
     DATEDIFF(str_to_date(c.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,c.data_fabr,c.data_venc,d.quant_disp,a.obs_ent
     FROM tb_entitproc a
	    inner join tb_entprodac c on a.cod_prod = c.cod_prod
      inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  left outer join tb_itemprocessado d on d.cod_prod = a.cod_prod
	  where a.id_entitproc = (select max(b.id_entitproc) from tb_entitproc b where b.cod_prod = a.cod_prod  )
	   group by a.cod_prod
	  order by a.data_ent desc, a.id_entitproc desc");
 
 
 /*
 
  mysql_query("SELECT a.*,b.descr_prod,  DATE_FORMAT(a.data_ent, '%d/%m/%Y') data_ent1,
     DATEDIFF(str_to_date(c.data_venc, '%d/%m/%Y'),CURDATE()) dias_avencer,c.data_fabr,c.data_venc
     FROM tb_entitproc a
	  inner join tb_entprodac c on a.cod_prod = c.cod_prod 
      inner join tb_produto b on a.cod_prod = b.cod_prod " . $p1 . "
	  where a.id_entitproc > 0 and a.quant_it > 0
	   group by a.cod_prod
	  order by a.data_ent desc, a.id_entitproc desc");		
	  
	  */		  
$b = mysql_num_rows($rs2);
$rs32 = mysql_query("select a.* from tb_produto a , tb_itemprocessado b where a.cod_prod = b.cod_prod order by a.descr_prod ");					  

$rs32 = mysql_query(" SELECT a.cod_prod,b.descr_prod FROM tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
where a.cod_prod not in (100269)
group by a.cod_prod
order by b.descr_prod");	


$quant_it       = "";
$data_ent       = "";
$obs_ent        = "";
 
$lm = "";					
    	
$habilia = 0;


/*	
	  $rs33 = mysql_query("SELECT a.* FROM tv_saldoltprac a where  a.cod_prod ='".$cod_prod."' and a.tt_lote > 0 ");				


        $row33a = mysql_fetch_assoc($rs33);
		 	
*/

if (isset($id)){
    $habilita = 1;
	
    $rs1 = mysql_query("SELECT a.* FROM tb_entitproc a where a.id_entitproc =". $id);
		    
	$a = mysql_num_rows($rs1);
	
	
//	echo("SELECT a.* FROM tv_saldoltprac a where  a.cod_prod ='".$cod_prod."' and a.num_lote = '" . $num_lote . "'");

    if ($a > 0 ) {
        $row33a = mysql_fetch_assoc($rs1);
        $habilit = "N";		 
		 $id_entitproc   = $id;
		 $cod_prod       = $row33a['cod_prod'];
		 $quant_it       = $row33a['quant_it'];
		 $data_ent       = formata_data($row33a['data_ent']);
         $obs_ent        = $row33a['obs_ent'];
		 $num_lote       = $row33a['num_lote'];
		 
		 
	
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
	<title>MATAM008 - Itens de Processados</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/func.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			window.opener.location.reload();}

function atualiza(){
   document.form1.submit();	
}
			

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}

</script>
    
</head> 
<body  oncontextmenu='return false' onselectstart='return false' ondragstart='return false'> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">

<table width="95%" border="0">
      <tr>
        <th ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
      <tr>
      <th height="45" colspan="2" align="center"><h1>Amostra - Consulta Saldo de  Processados- 
        <?php
	echo($_SESSION['id_itproc']);
		  ?>
      </h1></th></tr>
      <tr>
        <th colspan="3" align="center"><input type="button" onClick="sair();" value="Sair">
        </th>
        </tr>
            <tr >
              <td colspan="3" align="center" bgcolor="#A6A6FF">Processados</td>
            </tr>
            <tr >
              <th colspan="3" align="center">
                Produto
              <input type="text" name="m_primapesq" id="m_primapesq" maxlenght="50" size=50 /> 
              </h1>
              <input name="Pesquisar" type="submit" value="Pesquisar">
              </th>
            </tr>
            <tr align="center">
              <td  colspan="3" align="center">
              <table width="95%" border="0">
                <tr bgcolor="#D2D2FF" >
                  <th >Produto Processado</th>
                  <th >Lote</th>
                  <th >Dt. Entrada</th>
                  <th >Quantidade (GR)</th>
                  <!--th >Fabricacao</th>
                  <th >Vencimento</th-->
                  <th >Saldo</th>
                  <th >Obs</th>
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
           <a href="matam0008.php?id=<?php echo ($row['id_entitproc']);?>"><?php echo ("Processado " . " - " . $row['descr_prod']);?></a></td>
                <td align="center" ><?php echo ($row['num_lote']);?></td>
                <td align="center"><?php echo ($row['data_ent1']);?></td>

           <td align="center"><?php echo ($row['quant_it']);?> Gr</td>
           <!--td align="center" ><?php // echo($row['data_fabr']);?></td-->
           <!--td  align="center" ><?php  /*	echo($row['data_venc']);
		   		
			 if($row['dias_avencer'] <= 180 and $row['dias_avencer'] > 0 ) {
		      	echo ('<b><font color="#0000FF"> - Vence em  ' . $row['dias_avencer'].' dias </font>');
			 }
			 if($row['dias_avencer'] < 0  ) {
		      	echo ('<b><font color="red"> - Vencido a  ' . $row['dias_avencer'].' dias </font>');
			 }

             if($row['data_liblote'] == $data_do_dia){		   				
				$entrada_dia = $row['quant_fabr'];}

             $saldo_anterior = ($row['tt_lote'] - $entrada_dia) + $row['tt_saidaprac'];
			 */
             
			?></td-->
           <td align="right"><?php echo ($row['quant_disp']);?></td>
           <td align="left"><?php echo ($row['obs_ent']);?></td>
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
