<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">


<?php

ini_set("max_execution_time", 360);

session_start();
$_SESSION['gravarreg'] = 'I';

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

   }else{

         echo("Você não esta logado !!");
              	header("Location: loginx.php"); 

}



header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';

mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");
/**/
if ($p != 99){
	//$a = $_GET ["S"];
}

$p1 = "";
$p01 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p5 = "";
$p6 = "";
$p7 = "";
$p8 = "";
/////
//echo($_SESSION['id_consultlg']);
$rs88 = mysql_query("SELECT a.id_consult,b.nome FROM tb_agenda a
                     inner join tb_consultor b on a.id_consult = b.id_consult
					  group by a.id_consult order by 2");

    

if($_SESSION['id_consultlg'] != 68 and $_SESSION['id_consultlg'] != 69  and $_SESSION['id_consultlg'] != 66
		   and $_SESSION['id_consultlg'] != 74 and $_SESSION['id_consultlg'] != 83)
      { 
      $id_consult       = $_SESSION['id_consultlg']; }

if($id_consult == "") {
    $id_consult = 1 ;
	//$_SESSION['id_consultlg'] =  1; 
 }
	 
        $rs1 = mysql_query("SELECT distinct id_consult  FROM tb_regvenda where id_consult = " . $id_consult );
        $av   = mysql_num_rows($rs1);
	   // printf($a);
                        
        if ($av > 0) {
          $p1= " inner join tb_regvenda b on b.id_consult = " . $id_consult . " and b.cod_regiao = a.cod_regiao ";
		}
//$rs01 = mysql_query("select a.* from tb_cliente a ". $p1 ." group by a.nome_cli order by a.nome_cli ");


/////
	 
$rs01 = mysql_query("select a.*,b.cod_regiao from tb_cliente a ". $p1 ." group by a.nome_cli order by a.nome_cli ");
//$av   = mysql_num_rows($rs01);

	   // printf($a);
	   
//$rs01 = mysql_query("select a.* from tb_consultor a order by a.nome ");
$rs001 = mysql_query("select a.* from tb_consultor a order by a.nome ");
	 		
///////////////////////

if (isset($data_visita2)){
	if ($data_visita2 <> "" ){
		 $p2 = " and a.data_anivcd >= '" . formata_data2($data_visita2) ."'" ; 
		 $p2 = $p2 . " and a.data_anivid >= '" . formata_data2($data_visita2) ."'" ; 
		 $p2 = $p2 . " and a.data_anivch >= '" . formata_data2($data_visita2) ."'" ; 
		 
		 }}
if (isset($data_visita3)){
	if ($data_visita3 <> "" ){
		 $p2 = " and a.data_anivcd <= '" . formata_data2($data_visita3) ."'" ; 
		 $p2 = $p2 . " and a.data_anivid <= '" . formata_data2($data_visita3) ."'" ; 
		 $p2 = $p2 . " and a.data_anivch <= '" . formata_data2($data_visita3) ."'" ; 
		 }}
if (isset($cliente1)){
	if ($cliente1 <> "" ){
		 $p4 = " and b.nome_cli like '%" . $cliente1 ."%' or b.nm_fantasi like '" . $cliente1 ."%' or b.grupo_cli like '" . $cliente1 ."%'"; 
		 }}
if (isset($id_consult2)){
	if ($id_consult2 <> "" ){
		 $p5 = " and a.id_consult = '" . $id_consult2 ."'" ; 
		 }}
	
$p559 = "";		 
if (isset($cli_filtro)) {
//   	$p559 = " and grupo_cli like '%".$cli_filtro . "%'" . " or nome_cli like '%".$cli_filtro . "%'"  . " or nm_fantasi like '%".$cli_filtro . "%'";

   	$p559 = " and b.grupo_cli like '%".$cli_filtro . "%'" . " or b.nome_cli like '%".$cli_filtro . "%'"  . " or b.nm_fantasi like '%".$cli_filtro . "%'";

}



$p8 = " order by a.id_lanc desc  limit 0,40" ; //limit 0,40";


        $rs91 = mysql_query("SELECT distinct id_consult  FROM tb_regvenda where id_consult = " . $id_consult );
        $av   = mysql_num_rows($rs91);
	    //printf($av);
                        
        if ($av > 0) {
          $p1= " inner join tb_regvenda b on b.id_consult = " . $id_consult . " and b.cod_regiao = a.cod_regiao ";
		}
		
					
	
$rs09 = mysql_query("select a.* from tb_cliente a  where codigo_cli > 0 " . $p559 . " order by a.nome_cli ");
					

//group by a.nome_cli inner join tb_regvenda b on b.id_consult = " .$id_consult .
//   and b.cod_regiao = a.cod_regiao


 if ($_SESSION['permi'] == 60 &&  $_SESSION['id_consultlg'] > 1 )  { 
      $p01 = " and f.id_consult = " . $_SESSION['id_consultlg'] ;
	  
 }


   if(isset($consultoragenda)){
	   if ($consultoragenda > 1){
	        $id_consultor = $consultoragenda ; 
	        $p01 = " and f.id_consult = " . $consultoragenda  ;
	   }
   }



if ($p1 <> "" ){
/*
	echo("SELECT a.codigo_cli,b.nome_cli,b.nm_fantasi, DATE_FORMAT(e.data_relato, '%d/%m/%Y') data_relato,e.id_visita,
		f.id_consult, g.nome
		,(select b.realizado_cana from tb_prodsafra b where b.safra = 2011
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'cana_r_2011'
		,(select b.realizado_etanol from tb_prodsafra b where b.safra = 2011
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'etanol_r_2011'
		,(select b.realizado_cana from tb_prodsafra b where b.safra = 2010
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'cana_r_2010'
		,(select b.realizado_etanol from tb_prodsafra b where b.safra = 2010
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'etanol_r_2010'
		,(select b.realizado_cana from tb_prodsafra b where b.safra = 2009
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'cana_r_2009'
		,(select b.realizado_etanol from tb_prodsafra b where b.safra = 2009
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'etanol_r_2009'
		   FROM tb_prodsafra a
		inner join tb_cliente b on a.codigo_cli = b.codigo_cli
		inner join tb_regvenda f on f.cod_regiao = b.cod_regiao " . $p01 . "
		inner join tb_consultor g on f.id_consult = g.id_consult
		left outer join tb_relvisita e on e.codigo_cli = a.codigo_cli
		and e.data_relato = (select max(x.data_relato) from tb_relvisita x where x.codigo_cli = a.codigo_cli)
		where a.codigo_cli > 0   ".      $p4 . $p5 .  $p559 . 
    " group by a.codigo_cli, a.safra order by b.nm_fantasi,a.safra " );
		,(select b.realizado_cana from tb_prodsafra b where b.safra = 2009
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'cana_r_2009'
		,(select b.realizado_etanol from tb_prodsafra b where b.safra = 2009
		 and b.codigo_cli = a.codigo_cli group by b.codigo_cli, b.safra) as 'etanol_r_2009'

*/
	

	
    $rs0 = mysql_query("SELECT a.codigo_cli,b.nome_cli,b.nm_fantasi, DATE_FORMAT(e.data_relato, '%d/%m/%Y') data_relato,e.id_visita,
		f.id_consult, g.nome,
		k.realizado_cana cana_r_2016 , k.realizado_etanol etanol_r_2016,
		l.realizado_cana cana_r_2015 , l.realizado_etanol etanol_r_2015,
		m.realizado_cana cana_r_2012 , m.realizado_etanol etanol_r_2012
		   FROM tb_prodsafra a
		inner join tvprodsafra2016 k on k.codigo_cli = a.codigo_cli 
		inner join tvprodsafra2015 l on l.codigo_cli = a.codigo_cli 
		inner join tvprodsafra2012 m on m.codigo_cli = a.codigo_cli 
		inner join tb_cliente b on a.codigo_cli = b.codigo_cli
		inner join tb_regvenda f on f.cod_regiao = b.cod_regiao " . $p01 . "
		inner join tb_consultor g on f.id_consult = g.id_consult
		left outer join tv_maxdtvis e on e.codigo_cli = a.codigo_cli
		where a.codigo_cli > 0   ".      $p4 . $p5 .  $p559 . 
    " group by a.codigo_cli order by b.nm_fantasi  limit 300" );
	
	
}else{
		
	
    $rs0 = mysql_query("SELECT a.codigo_cli,b.nome_cli,b.nm_fantasi, DATE_FORMAT(e.data_relato, '%d/%m/%Y') data_relato,e.id_visita,
		f.id_consult, g.nome,
		k.realizado_cana cana_r_2016 , k.realizado_etanol etanol_r_2016,
		l.realizado_cana cana_r_2015 , l.realizado_etanol etanol_r_2015,
		m.realizado_cana cana_r_2012 , m.realizado_etanol etanol_r_2012
		   FROM tb_prodsafra a
		inner join tvprodsafra2016 k on k.codigo_cli = a.codigo_cli 
		inner join tvprodsafra2015 l on l.codigo_cli = a.codigo_cli 
		inner join tvprodsafra2012 m on m.codigo_cli = a.codigo_cli 
		inner join tb_cliente b on a.codigo_cli = b.codigo_cli
		inner join tb_regvenda f on f.cod_regiao = b.cod_regiao " . $p01 . "
		inner join tb_consultor g on f.id_consult = g.id_consult
		left outer join tv_maxdtvis e on e.codigo_cli = a.codigo_cli
		where a.codigo_cli > 0 ".      $p4 . $p5 .  $p559 . 
    " group by a.codigo_cli order by b.nm_fantasi limit 300" );
	
	
	
}

//////////////////////////
if (isset($id)){
	
	
     $rs10 = mysql_query("SELECT * FROM tb_prodsafra where id_lanc =". $id);
    $a = mysql_num_rows($rs10);

		 $safra      =  '';
		 $codigo_cli      =  '';
		 $previsto_etanol  = 0;
		 $realizado_etanol = 0;
		 $previsto_cana    = 0;
		 $realizado_cana   = 0;
   
    if ($a > 0){
     $_SESSION['gravarreg'] = 'A';
	 $row10 = mysql_fetch_assoc($rs10);
     $safra            = $row10['safra'];
     $codigo_cli       = $row10['codigo_cli'];
	 $previsto_etanol  = $row10['previsto_etanol'];
	 $realizado_etanol = $row10['realizado_etanol'];
	 $previsto_cana    = $row10['previsto_cana'];
	 $realizado_cana   = $row10['realizado_cana'];	 
	 
	} else {
    	 $safra            =  '';
		 $codigo_cli       =  '';
		 $previsto_etanol  = 0.00;
		 $realizado_etanol = 0.00;
		 $previsto_cana    = 0.00;
		 $realizado_cana   = 0.00;
	
	}
	 
     }
else{
       $rs10       = mysql_query("SELECT max(id_lanc) + 1 as id_lanc fROM tb_prodsafra");
	   $row10      = mysql_fetch_assoc($rs10);
	   $nvid      = $row10['id_lanc'];
	 
     if ($nvid  == ""){
		  $nvid = 1;}
    	 $safra            =  '';
		 $codigo_cli       =  '';
		 $previsto_etanol  = 0.00;
		 $realizado_etanol = 0.00;
		 $previsto_cana    = 0.00;
		 $realizado_cana   = 0.00;
	 
	 $id_lanc    = $nvid ;
//echo($id_lanc);
}
	
						   
function formata_data($data)  
 {  
	  if ($data <> ""){
		  //recebe o parâmetro e armazena em um array separado por -  
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
		  //recebe o parâmetro e armazena em um array separado por -  
		  $data = explode('/', $data);  
		  //armazena na variavel data os valores do vetor data e concatena /  
		  $data = $data[2].'/'.$data[1].'/'.$data[0];  
		  //retorna a string da ordem correta, formatada  
		  }
	  return $data;  
 }  


  if($_GET ["P"] == 99){
	  
	  $a="";
	  
  }
  /* controle de amostras de produtos acabados 
  
  
SELECT a.cod_prod,b.descr_prod, a.num_lote,
DATE_FORMAT(str_to_date(a.data_fabr, '%d/%m/%Y'), '%d/%m/%Y') AS data_fabr,
a.data_venc, date_add(str_to_date(a.data_venc, '%d/%m/%Y'), interval 1 year) venci
FROM tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
order by str_to_date(a.data_venc, '%d/%m/%Y') asc

CREATE TABLE tmptbnova SELECT a.cod_prod, a.num_lote,str_to_date(a.data_fabr, '%d/%m/%Y') data_fabr,
str_to_date(a.data_venc, '%d/%m/%Y')data_venc,date_add(str_to_date(a.data_venc, '%d/%m/%Y'), interval 1 year) venci_retencao
FROM tb_entprodac a
group by a.cod_prod,a.num_lote
order by str_to_date(a.data_venc, '%d/%m/%Y') asc

insert into tb_contraprov(cod_prod,num_lote,data_fabr,data_venc,venci_retencao,situacao)(
SELECT cod_prod,num_lote,data_fabr,data_venc,venci_retencao ,"A" FROM tmptbnova )

drop table tmptbnova

update  tb_contraprov set
quantidade = 0.300 , unidade = 'L'
 where cod_prod > 1549  and cod_prod < 1599
 
 update  tb_contraprov set
quantidade = 0.200 , unidade = 'Kg'
 where quantidade is null
 

select * from tb_contraprov
where venci_retencao > curdate()


contraprova de materia prima

insert into tb_contraprovm(cod_prod,num_lote,data_fabr,cod_fornec,data_venc,venci_retencao,situacao,quantidade,unidade)(
SELECT a.cod_prod,a.num_lote,a.data_fab,a.cod_fornec,a.data_venc,
date_add(a.data_venc, interval 1 year) venci,"A" situacao,
"0.200" quantid,a.unidade
FROM tb_entmatp a
group by cod_prod,num_lote
order by a.data_venc asc)


*/
?>


