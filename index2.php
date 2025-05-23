<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<Meta http-equiv="refresh" content="60" />
<script>
   var myVar = setInterval(myTimer ,1000);
    function myTimer() {
        var d = new Date(), displayDate;
       if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
          displayDate = d.toLocaleTimeString('pt-BR');
       } else {
          displayDate = d.toLocaleTimeString('pt-BR', {timeZone: 'America/Belem'});
       }
          document.getElementById("demo").innerHTML = displayDate;
    }
</script>
	

<?php
$hoje = date("d/m/Y");
?>
<html>
<head>
<title>Sistemas Internos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<link rel="shortcut icon" href="./imagens/Logo-.ico" type="image/x-icon" />

</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
<center>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><img src="imagens/logoqrred.jpg" ></td>
      <td align="right">
      
      </td>
      <td align="right">
      <label id="demo"></label>
      <br>
       <?php echo($hoje); ?>     
       </td>
    </tr>
    <tr>
      <td colspan="3" align="center"><img src="imagens/menu_int.png" width="1004"  border="0" usemap="#Map"></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><img src="imagens/teclado_maos-banner1.png" width="967" height="236"></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><img src="imagens/footerQR.png" width="1015" height="143"></td>
    </tr>

  </table>
<div id="cont_7e7989f96c6562b346745fce2639a167">
<script type="text/javascript" async src="https://www.tempo.com/wid_loader/7e7989f96c6562b346745fce2639a167"></script>
           <a href="#" moeda="220" type="Comercial" name="boataxa_hoje">Dólar Comercial -</a>
<script async src="https://boataxa.com.br/Api/Scripts/boataxa_hoje.js"></script>
   
                              
 </div>                                               
</center>

<map name="Map">
  <area shape="rect" coords="878,4,993,28" href="index3.php" alt="Administrativo">
  <area shape="rect" coords="754,4,870,28" href="equipamentos/login.php" alt="Equipamentos">
  <area shape="rect" coords="623,4,746,29" href="visitatecnica/login.php" alt="Relatório de Visitas / Agenda">
  <area shape="rect" coords="502,5,622,27" href="producao/login.php" alt="Controles de Previs&atilde;o e Acompanhamento de Produ&ccedil;&atilde;o">
  <area shape="rect" coords="377,5,495,28" href="expedicao/login.php" alt="Entrada de Insumos">
  <area shape="rect" coords="252,4,370,29" href="contratos/login.php" alt="Sistema de Contratos">
  <area shape="rect" coords="127,2,246,28" href="comissoes/login.php" alt="Sistema de Comissões">
  <area shape="rect" coords="3,3,121,28" href="index2.php" alt="Página Incial">  
</map>
</body> 

</html>
