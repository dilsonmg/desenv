<Meta http-equiv="refresh" content="3600" />

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <meta charset="iso-8859-1">
    <title>Gest&atilde;o Itens de controles - Consultores</title>
     <!-- Aqui chamamos o nosso arquivo css externo -->

    <link rel="stylesheet" href="../css/qreal.css">
    <link rel="stylesheet" type="text/css"  href="../css/menu_padr.css" />

    <!--[if lte IE 8]>
 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<html lang="pt-br">

<head>

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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
///
 //Configura o timezone a ser utilizado
    date_default_timezone_set('America/Fortaleza');
///
// Parametros
/**/


   header('Content-type: text/html; charset=iso-8859-1');
   session_start();

   $agora = date("H:i:s");

  //  echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';


  //  echo 'date.timezone: ' . ini_get('date.timezone');

   
  // echo( $_SESSION['idusuario']);
  // $_SESSION['login'] = $_SESSION['nome_usu'];
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voce nao esta logado !!");
              	header("Location: loginx.php"); 

}

   $hoje = date("d/m/Y");
   
   
   
/*  */
   
function intervaloEntreHoras($inicio, $fim, $agora) {
   $inicioTimestamp = strtotime($inicio);
   $fimTimestamp = strtotime($fim);
   $agoraTimestamp = strtotime($agora);
   //echo($fimTimestamp);
  // return (($agoraTimestamp >= $inicioTimestamp) && ($agoraTimestamp <= $fimTimestamp));
  
  if($agoraTimestamp >= $inicioTimestamp && $agoraTimestamp <= $fimTimestamp){
	  return('S'); }
  else{ return('N');}
  
}




$inicio = '08:00:00';
$fim = '15:30:00';
$agora = date("H:i:s");

// Chamada
	$mostra_opcmenu = "S";

$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('Y-m-d');
// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));
// Exibe o dia da semana com o Array
echo ($diasemana[$diasemana_numero] . " - ");


//if(intervaloEntreHoras($inicio,$fim,$agora)){
//}   
$msg = "";
	if($diasemana_numero > 0 && $diasemana_numero <=5){
		$mostra_opcmenu = "S";
	    $msg = 'Esta no Intervalo ! '. " - " .  '<label id="demo"></label>' ;
		if($diasemana_numero == 4){
			$mostra_opcmenu = intervaloEntreHoras($inicio,$fim,$agora);
			if($mostra_opcmenu == "N"){
       			$msg = 'Não está no intervalo !! '  . " - " . '<label id="demo"></label>' ;
			}
      	}
	} else {
		$msg = 'Não está no intervalo !! '. " - " . '<label id="demo"></label>' ;
		$mostra_opcmenu = "N";
	}
echo($msg);
 
?>

<script>
function carga00(app){
	newwindow=window.open (app,"mywindow","location=0,menubar=0,scrollbars=yes,resizable=1,width=1010,status=yes,height=450"); 
	      newwindow.moveTo(150,150);
/*
   if (window.focus) 
          {
             newwindow.focus()
          }
   return false;
   */
}
function carga1(){
	window.open ("importmateriais.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=450,top=100,left=150"); 
}
function carga2(){
	window.open ("export_rec.php","mywindow","menubar=0,scrollbars=yes,resizable=1,top=100,left=150,width=810,status=yes,height=450"); 
}

function trsenha(){
	window.open ("cad_usuario.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=350"); 
}

function ver_entrada(app)
{
	
		//	window.open (app,"mywindow","menubar=0,scrollbars=yes,resizable=1,width=1110,status=yes,height=550"); 
		var janela;
		janela = 	window.open (app,"mywindow1","menubar=0,top=100,left=150,scrollbars=yes,resizable=1,width=1250,status=yes,height=520"); 
		
		//janela.captureEvents(Event.RESIZE);
		//janela.onresize=informar;
}
</script>

</script>

</head>
<body >
<center>
<table width="99%" border="0">
      <tr>
        <th align='left'><img src="../imagens/logoqrred.jpg" border="0"><br><?php echo($_SESSION['nome_usu']);?></th>
       <th  align="center" ><font size="+1">Gest&atilde;o  - Consultores</font></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" >
        <label id="demo"></label>
        <br> <?php echo($hoje);?></th>
      </tr>
</table>
<br>
</center>
<center>
<div class="menu-container"  style="width:80%"  >
    <ul class="menu clearfix">
        <li><a href="#">Tabelas</a>
            <!-- Nível 1 -->
            <!-- submenu -->
            <ul class="sub-menu clearfix">
                <li><a href="consult0001.php">Representantes</a> </li>
                <li><a href="consult0002.php">Itens de Controle</a> </li>               
                <li><a href="consult0003.php">Formação Profissional</a> </li>               
                <li><a href="consult0004.php">Consultor Formação Profissional</a> </li>               
                <li><a href="consult0005.php">Itens de Controle</a> </li>               
                <li><a href="consult0006.php">Acompanhamento de Controle</a> </li>               
                <li><a href="consult0007.php">Documentos por representante</a> </li>               


            </ul><!-- submenu -->
      </li>
     <li><a href="#">Consultas</a>
       <ul class="sub-menu clearfix">
       <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '111') { ?>
	      <li><a href="consult0008.php">Documentação por Representante</a></li>  
       <?php }?>
	      <li><a href="consult0009.php">Acompanhamento da Documentação</a></li>                   
	      <li><a href="#">Ponto Minimo</a></li>                   

      </ul><!-- submenu do submenu -->
     </li>
     
    
        <li><a href="javascript:trsenha();">	Trocar Senha</a></li>

    </ul>
    </ul>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


</center>
<center >
<hr color="#003871" width="90%" >
<table border = 0 width="70%">
<tr>
  <th align="left" valign="top">
    <a href="javascript:ver_entrada('../documentos/arquivos/Outros/Manual - Solicit Mat Escrit (2021).pdf')" > <img src="../imagens/tutorial.png"  /></a>
  </th>
  <th align="right">
<a href="login.php"><img src="../imagens/footerQR.png"  border="0"></a>
</th>
</tr>
</table>


</center>
</body>
</html>