<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate, Post-Check=0, Pre-Check=0"> 
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Expires" CONTENT="-1"> 
<link rel="stylesheet" href="../css/qreal.css">

<?php

session_start();

$lgd = 0;
$opcm = 0;
//echo("en=".$_SESSION['en']);
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
}else{

  echo("vc nao passou pelo arquivo anterior");
  header("Location: loginx.php");

}

$data=date("d/m/Y");
//echo $data;
$anots = date("Y");
//echo $anots;

include 'conectabco.php';


$p4 = " and a.ano = '" . $ano_p . "'";
				

$consp = "";
if (isset($id_consult1)){
	if ($id_consult1 <> "" ){
         $sqlins = "$id_consult1";
               // echo($sqlins);
				  $ins=mysql_query( $sqlins ); ;
	 
 }}


$i=0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript1.2">

top.window.moveTo(0,0);

if (document.all)

{ top.window.resizeTo(screen.availWidth,screen.availHeight); }

else if

(document.layers || document.getElementById)

{

if

(top.window.outerHeight < screen.availHeight || top.window.outerWidth <

screen.availWidth)

{ top.window.outerHeight = top.screen.availHeight;

top.window.outerWidth = top.screen.availWidth; }

}

</script>

<script>
	function abrir_app(app)
	{
	var janela;
	janela = 	window.open (app,"mywindow1","menubar=0,scrollbars=yes,resizable=1,width=1300,status=yes,height=650"); 
	
	}
</script>

</head>
<meta http-equiv="Page-Enter" content="revealTrans(Duration=1.0,Transition=23)" />

<script>
window.moveTo(0,0);
window.scroll(0,0);
</script>
<title>Consulta segmentacão de Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgproperties="fixed" id="top" >
<form name="form1" method="post" enctype="multipart/form-data"> 


<!-- a class="testeimprimir" href="http://google.com" target="_blank">TESTE</a  -->
  
<table width="100%" border="0">
      <tr>
        <th align="left" ><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th  align="center"><h3>- Consulta segmentacão de Clientes</h3></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <a href="menu_visita.php"><img src="../images/back_f2.png"  border="0" alt="Voltar ao menu" /></a></th>
      </tr>
      </table>
      
      <table width="98%">
           <tr>
             <td width="38%" align="center" >
				  
            Consultor
              
             <input type="text" name="id_consult1" id="id_consult1" /></td>
    
             <td width="6%" align="center" valign="top"><input type="submit" name="button" id="button" value="Filtrar" class="search-submit2"/></td>

            </tr>
            </table>            
               


<center>
<br />
    <?php echo("<h2>Critério da pesquisa : ". $consp . " - " . $msg . "- " . $ano_p."</h2>"); ?>
<br />
	  
</form>

<!------------------------------------------------------------------------------------------------------------->
</body>
