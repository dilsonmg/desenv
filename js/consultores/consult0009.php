<?php
header('Content-type: text/html; charset=ISO-8859-1');
session_start();

$hoje = date("d/m/Y");


$btn = 's';
$ms = $_GET ["bt"];
if (isset($ms) && $ms <> "" ){ $btn = 'n'; }


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
 //        $id_itemmanu      = "";	 
//		 $id_consult         = "";
		 $id_chkman        = "";
		 $data_realiz        = "";	
		 $obs_chk	 	= "";  
$responsavel = "dilson magalhaes";


		if (!isset($id_consult2)){
		 		 $id_evento      = "";
		}

$p4 = "";
$p44 = "";
$p45 = "";
$p32 = "";
$p42 = "";
$id = $_GET ["id"];

$habilit = "S";
$p41 = "";

/*
////////////////////////tv_proxdccons - acomp docs repres ///////////////////////

select a.*,DATE_FORMAT(max(a.data_realiz), '%d/%m/%Y') data_realiz1,b.nome,d.id_itcontr,d.descr_itcontr,
(max(a.data_realiz) + interval c.periodicid month) AS data_proximo3,
date_format((max(a.data_realiz) + interval c.periodicid month),'%d/%m/%Y') AS data_proximo2,
(to_days(date_format((max(a.data_realiz) + interval c.periodicid month),'%Y/%m/%d')) - to_days(curdate())) AS dias_avencer,c.periodicid
from tb_acompcontr a
inner join tb_consultor b on b.id_consult = a.id_consult and b.situacao is null
inner join tb_pericontr c on c.id_pericontr = a.id_pericontr
inner join tb_itcontr d on d.id_itcontr = c.id_itcontr
where a.id_consult > 0
group by a.id_consult,a.id_pericontr
order by b.nome,a.id_acompcontr,dias_avencer

////////////////////////////////////////////////////////////////////////////////




if (isset($tipo2)){
	if($tipo2 <> ""){
		$p41 = " and a.tipo = '".$tipo2 . "'";
	}
}
*/

if (isset($data_1)){
	if ($data_1 <> "" ){
		 $p32 = " and a.data_proximo3 >= '" . $data_1 ."'" ; 
		 $data1x = formata_data2($data_1);
	}
}

if (isset($data_2)){
	if ($data_2 <> "" ){
		 $p42 = " and a.data_proximo3 <= '" . $data_2 ."'" ; 
		 $data2x = formata_data2($data_2);
	}
}


$rs33 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome ");		
					
if (isset($id_consult)){
	if($id_consult != ""){
		
	
		
		$rs34 = mysql_query("select a.id_pericontr,a.id_consult, a.id_itcontr,a.periodicid,
		                    b.nome, c.descr_itcontr
						    from tb_pericontr a
							inner join tb_consultor b on a.id_consult = b.id_consult
							inner join tb_itcontr c on a.id_itcontr = c.id_itcontr
							where a.id_consult = '".$id_consult . "'order by c.descr_itcontr ");	
	}
}

$rs330 = mysql_query("SELECT a.* FROM tb_consultor a
					 where a.situacao is null and a.id_cargo in (15,16,300,304)
					 and id_consult != 1
					order by nome");		


$rs340 = mysql_query("select a.* from tb_itcontr a order by a.descr_itcontr ");	


if (isset($id_consult2)){
	if($id_consult2 != ""){

		 $p4 = " and a.id_consult = '" . $id_consult2 ."'" ; 
					
	}
}

//echo($id_itemmanu22);


if (isset($id_itcontr22)){
	if ($id_itcontr22 <> "" ){
		// $p4 = " and a.id_consult like '%" . $id_consult1 ."%'" ; 
		 $p45 = " and a.id_itcontr = '" . $id_itcontr22 ."'" ; 
		 }}

	  
					  
$rs2 = mysql_query("select a.* from tv_proxdccons a where a.id_consult > 0 " .$p4 .$p41 . $p32 .$p42. $p45 );					  
					  

    $b = mysql_num_rows($rs2);



 function formata_data2($data)  
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
	<title>CONSULT0009 - Acompanhamento - Documentação dos Representantes </title>
    <link rel="stylesheet" href="../css/qreal.css">
	<script type='text/javascript' src="../js/funcexametr.js"   charset="ISO-8859-1"></script>
   
<script>    
if (window.opener && !window.opener.closed) {
		//	window.opener.location.reload();
	}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulario  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.id_consult.value ='';
		  document.form1.id_itcontr.value = '';
		  document.form1.id_usuexametr.value = '';
  		  document.form1.data_realiz.value = '';
   	   	  document.form1.action="consult0009.php";
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

function ver_registro(app)
{
	
//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
var janela;
janela = 	window.open (app,"mywindow1","menubar=0,top=40,left=200,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 

//janela.captureEvents(Event.RESIZE);
//janela.onresize=informar;
}

</script>
    
</head> 
<body> 
<center>
<form name="form1" method="post" enctype="multipart/form-data"> 
<input type=hidden name="id" value="<?php echo("$id");?>">
<input readonly type=hidden name=x size=3 maxlength=3 value="250">


<table width="95%" border="0">
      <tr>
        <th align="left"><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th >
        <h1> <?php echo($hoje); ?> - Consulta de Documentação dos Representantes - 
        <?php
	      if($data_1 != ""){
			  echo ($data1x);
		  }
		  echo (" a ");
	      if($data_2 != ""){
			  echo ($data2x);
		  }

		  ?>
      </h1>
        </th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br><?php echo($hoje);?></th>
      </tr>
</table>
<table width="95%" border="0">
      
      <tr>
      <th align="center"></th></tr>
      <tr>
        <th align="center">
        <?php if ($btn == 's'){ ?>
        <?php } ?>
          <input type="button" onClick="sair();" value="Sair" class="search-submit2"></th>
        </tr>
          <tr bgcolor="#9D9DFF">
        <th align="center">Registros Cadastrados</th>
      </tr>
      <tr>
        <th align="left">Consultor 
          <select name="id_consult2"  onChange="atualiza();"  class="search-input3">
            <option value="">Selecione o Consultor</option>
            <?php while($row33=mysql_fetch_assoc($rs330)){ ?>
            <option value="<?php echo($row33['id_consult'])?>"
				  <? if($row33['id_consult'] == $id_consult2 ) {?>selected <? } ?>				
				 ><?php echo($row33['nome']  );?></option>
            <?php }?>
        </select>
          Documento
          <select name="id_itcontr22" onChange="atualiza();" class="search-input4">
             <option value="">Selecione o Item</option>
             
             <?php while($row333=mysql_fetch_assoc($rs340)){ ?>
             <option value="<?php echo($row333['id_itcontr']);?>"
				  <? if($row333['id_itcontr'] == $id_itcontr22 ) {?>selected <? } ?>		
       				 ><?php echo($row333['descr_itcontr'] );?></option>
		             <?php }?>
        </select>
          Tipo 
          
                  Per&iacute;odo
        de
               <input type="date" name="data_1" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_1);" class="search-input4"/>
a
<input type="date" name="data_2" size="10" maxlength="10"  title="Informe no Formato 99/99/9999" onkeypress="mascara(this)" onblur="verifica_data(this.value,data_2);" class="search-input4" onChange="atualiza();" />

          
          </th>
      </tr>

            <!--tr >
              <th colspan="7" align="center"><h1>Ficha de Manuten??o dos Equipamentos</h1></th>
            </tr -->
            <tr align="center">
              <td align="center">
              <table width="99%" border="1" bordercolor="#CCCCCC">
                <tr bgcolor="#D2D2FF" >
                  <th width="5%" >ID</th>
                  <th width="19%" >Representante</th>
                  <th width="21%" >Documento</th>
                  <th width="8%" >Data</th>
                  <th width="10%" >Próximo</th>
                  <th width="6%" >N. Dias</th>
                  <th width="31%" >Obs</th>

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
             <td  align="left"><?php echo ($row['id_acompcontr']);?></td>
           <td align="left">
		   
		              <a href="javascript:ver_registro('consult0010.php?id=<?php echo ($row['id_consult']);?>');">
                      <?php echo ($row['nome']);?>
                      </a>
           </td>
           <td align="left"><?php echo ($row['descr_itcontr']);?></td>
           <td align="center"><?php echo ($row['data_realiz1']);?></td>
           <td align="center"><?php 
	  			if($row['periodicid'] > 0 ){
            		   echo ($row['data_proximo2']);
				}else{					
					echo("Indeterminado !");}
			    ?>
                       
           </td>
           
            <?php 
			if($row['periodicid'] > 0 ){
		     
			   if ($row['dias_avencer']< 0){
				    $bgc = "bgcolor=#FF8080" ;
			   }
		       if ($row['dias_avencer'] > 0  && $row['dias_avencer']< 30){
				    $bgc = "bgcolor=#A8E2FF" ;
			   }
			}

			 ?>
           
           <td align="right" <?php echo($bgc); ?>><?php 
		   			if($row['periodicid'] > 0 ){
                    	echo ($row['dias_avencer']);
					}else{
						echo ("Indeterminado !");
					}
				   ?></td>
           <td align="left" ><?php echo ($row['obs_acomp']);?></td>


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
