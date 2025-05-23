<?php


/*
select a.id_chkferr,a.id_periodferr,
       a.id_ferram,a.data_serv,
       date_format(max(a.data_serv),_utf8'%d/%m/%Y') AS data_serv2,
       b.descr_evento,
       c.descr_ferram,date_format((max(a.data_serv) + interval d.periodic day),
       _utf8'%d/%m/%Y') AS data_proximo,d.periodic,
       b.id_evento,
       date_format((max(a.data_serv)+ interval d.periodic day),
       _utf8'%Y/%m/%d') AS data_proximo2,
       (to_days(date_format((max(a.data_serv) + interval d.periodic day),_utf8'%Y/%m/%d')) - to_days(curdate())) AS dias_avencer
  from tb_chkferr a
  inner join tb_periodferr d on d.id_periodferr = a.id_periodferr
  inner join tb_evento b on b.id_evento = d.id_evento
  inner join tb_ferram c on c.id_ferram = a.id_ferram
  where a.id_chkferr = (select max(a2.id_chkferr) AS max_acomp
                         from tb_chkferr a2 where a2.id_ferram = a.id_ferram and a2.id_chkferr = a.id_chkferr
                         group by a2.id_ferram,a2.id_chkferr)
  group by a.id_ferram,b.id_evento order by c.descr_ferram,b.descr_evento;
*/

header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }

//echo($id_evento2);
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

$id = $_GET ["id"];

$habilit = "S";

$rs330 = mysql_query("select a.* from tv_planejferr a  
                     group by a.id_ferram order by a.descr_ferram");		

$p4 = "";
$p44 = "";
$p45 = "";

//echo($id_evento2);

if (isset($id_ferram2)){
	if ($id_ferram2 <> "" ){
		 $p4 = " and a.id_ferram = '" . $id_ferram2 ."'" ; 
		 }}



if (isset($id_evento2)){
	if ($id_evento2 <> "" ){
		 $p44 = " and a.id_evento = '" . $id_evento2 ."'" ; 
		 }}




$rs2 = mysql_query("select a.* 	from tv_planejferr a
					 where a.id_chkferr > 0 ". $p4 . $p44 . $p45 . " order by a.dias_avencer asc,a.descr_ferram " );
  
$b = mysql_num_rows($rs2);
						  	
$rs34 = mysql_query("select a.* from tb_evento a order by a.descr_evento ");	


$data1 = '2013-05-21';
//$data2 = '2013-05-22';
$data2 = date("Y-m-d");

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
	<title>EQPTOC_ferr013 - Consulta próximas de Checagens das ferramentas</title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="funcequipamento.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
			//window.opener.location.reload();
			}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_ferram.value ='';
		  document.form1.id_periodferr.value = '';
		  document.form1.data_serv.value = '';
   	   	  document.form1.action="eqptoc_fer013.php";
		  document.form1.submit();  
		  return true;
	//	  }

}

function atualiza(){
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


<table width="99%" border="0">
      <tr>  
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align="center"><h3>Consulta próximas de Checagens das ferramentas- 
        <?php
	// echo($_SESSION['id_ferram']);
	      echo($hoje);
		  ?>
          
      </h3></th>
        <th align="right"><a  href=javascript:window.print()><img border="0" src="../imagens/print.png"    title="Imprimir"></a><img src="../imagens/tecladoclaro.png" ></th>
      </tr>
     
      <tr>
        <th colspan="3" align="center">
        <?php if ($btn == 's'){ ?>
        <?php } ?>
          <input type="button" onClick="sair();" value="Sair"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th colspan="3" align="center"><font color="#000000">Pr&oacute;ximos servicos a executar</font></th>
      </tr>
      <tr>
        <th colspan="3" align="left">Ferramenta 
          <select name="id_ferram2" onChange="atualiza();" class="search-input5" >
            <option value="">Selecione  Ferramenta</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php print($row33['id_ferram'])?>"
				  <? if($row33['id_ferram'] == $id_ferram2 ) {?>selected <? } ?>				
				 ><?php print($row33['descr_ferram']);?></option>
            <?php }?>
        </select>
          Evento
          <select name="id_evento2"  onChange="atualiza();" class="search-input5">
             <option value="">Selecione o Item</option>
             <?php while($row333=mysql_fetch_assoc($rs34)){ ?>
             <option value="<?php print($row333['id_evento']);?>"
				  <? if($row333['id_evento'] == $id_evento2 ) {?>selected <? } ?>		
       				 ><?php print($row333['descr_evento'] );?></option>
		             <?php }?>
           </select>
        </th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td colspan="3" align="center">
              <table width="85%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th >ID</th>
                  <th >Ferramenta</th>
                  <th >Evento</th>
                  <th >Ult. Evento</th>
                  <th >Periodicidade</th>
                  <th >Prox.Evento</th>
                  <th >N. Dias</th>
                </tr>
     <?php
//echo($b);
	 if ($b > 0){
       $bg = 0;
	  
	  while($row=mysql_fetch_array($rs2)){ 
       if($bg == 1){
			   	    $bgc = "bgcolor=#eeeeee";  $bg = 0;}
			   else{ $bgc = ''; $bg = 1;}	
			  
	   echo('<tr ' . $bgc .'>');?>

          
           <tr>
             <td  align="left"><?php echo ($row['id_chkferr']);?></td>
             <td  align="left">
           <a onClick="window.open(this.href, this.target, ' resizable = no,width=950,height=500, toolbar = no '); return false;" 
            href="eqpto_fer001c.php?id=<?php echo($row['id_ferram']."&m=0")?>" target="_blank" ><?php echo $row['descr_ferram']?></a>
           
          </td>
             <td align="left"><?php echo ($row['descr_evento']);?></td>
           <td align="right"><?php echo ($row['data_serv2']);?></td>
           <td align="right"><?php echo ($row['periodic']);?> dias</td>
           <td align="right"><?php echo ($row['data_proximo']);?></td>
           <?php 
		       if ($row['dias_avencer']< 0){
				    $bgc = "bgcolor=#FF8080";
			   }
			 ?>
             
           <td align="right" <?php echo($bgc); ?>><?php echo ($row['dias_avencer']);?></td>
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
