<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);


   header('Content-type: text/html; charset=ISO-8859-1');
   session_start();
   
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

}

$_SESSION['menuret'] = "../expedicao/menu_custo.php";


$hoje = date("d/m/Y");
$data_req = $hoje; 
   
?>
<!DOCTYPE HTML>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

<!--html lang="pt-br"-->
<head>
  <!--meta charset="UTF-8"-->
    <title>Gest&atilde;o do Processo Custos de Fabrica&ccedil;&atilde;o</title>
     <!-- Aqui chamamos o nosso arquivo css externo -->
         <link rel="stylesheet" href="expedicm.css">

         <link rel="stylesheet" type="text/css"  href="menuexp.css" />
    <!--[if lte IE 8]>
 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
function carga00(app){
	newwindow=window.open (app,"mywindow","location=no,menubar=0,scrollbars=yes,resizable=1,width=1010,location=0,directories=0,locationbar=0,toolbar=0,status=yes,height=450"); 
	      newwindow.moveTo(150,150);
/*
   if (window.focus) 
          {
             newwindow.focus()
          }
   return false;
   */
}
</script>
</head>
<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
<center>
<table width="98%" border="0">
      <tr>
        <th align='left'><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align='center'><font size="+2">Gest&atilde;o dos Custos de Fabrica&ccedil;&atilde;o</font></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br> <?php echo( $_SESSION['nome_usu']); ?></th>
      </tr>
    
</table>
<br>
</center>
<div class="menu-container" align="center">
  <ul class="menu clearfix">
  
  
  
        <!---------------------------------------------------->
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222' || $_SESSION['permi'] == '10') { ?>
            
          <li><a href="#">Custos de Produ&ccedil;&atilde;o</a>

              <ul class="sub-menu clearfix"> 
                      <li><a href="custoind001.php">Centros de Custos - Indiretos</a></li>
                      <li><a href="custoindv001.php">Vincula&ccedil;&atilde;o Mensal de C.Custos - Indiretos</a></li>
                      <li><a href="custogrup002.php">Vincula&ccedil;&atilde;o Itens de Custos x Linha</a></li>

               </ul><!-- submenu do submenu -->
        </li>
        <?php } ?>
  
            <!---------------------------------------------------->


        <li><a href="#">Consultas</a>
              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222' || $_SESSION['permi'] == '227'  || $_SESSION['permi'] == '10') { ?>

                      <li><a href="custoindvc01.php">1 - Vincula&ccedil;&atilde;o Mensal de C.Custos - Indiretos</a></li>
                      <li><a href="custoindvcg01.php">2 - C.Custos - Indiretos por linha</a></li>
                      <li><a href="matpac_custo_prod_anual2d.php">3 -Totais Custos Indiretos mensal por ano</a></li>                      
                      <li><a href="matpcm001c.php">4 - Custo mensal Matéria-prima</a></li>
     
                      <li><a href="matpac_custo_prod.php">5 - Custos de Produ&ccedil;&atilde;o</a></li>
                      <li><a href="matpac_custo_prod_anual2.php">6 - Custos Anual por Linha - *</a></li>
                     <li><a href="matpac_custo_prod_anual2b.php">7 - Custos Mensais</a></li>
                      <li><a href="matpac_custo_prod_anual2.php">8 - Custos Linhas por ano</a></li>
                      <li><a href="matpac_custo_prfb01.php">9 - Custos Mensais M.Primas / Indiretos</a></li>
                        
           <?php } ?>

               </ul><!-- submenu do submenu -->
        </li>
        <li><a href="#">Despesas realizadas</a>
              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222' || $_SESSION['permi'] == '227'  || $_SESSION['permi'] == '10') { ?>
                      <li><a href="custogrup001.php">Linha de Despesas</a></li>
                      <li><a href="custoindr001.php">Itens de Despesas</a></li>

                      <li><a href="custogrupr002.php">Vinculacão Itens de Despesas x Linha</a></li>
                      
                      <li><a href="custoindvcgr01.php">Consulta Despesas Realizadas por linha</a></li>
                      <li><a href="desprealc001.php">Consulta Despesas Realizadas por ano</a></li>
                      <li><a href="custoprevdra01.php">Correção automática da previsão de Despesas</a></li>
                      <li><a href="custoprevdr001.php">Alteração individual da previsão Despesas</a></li>
                      <li><a href="desprealcp01a.php">Consulta Previsto x  Realizado</a></li>
                          
                      
                      
        
                        
           <?php } ?>

               </ul><!-- submenu do submenu -->
        </li>

        <!---------------------------------------------------->




                
          <li><a href="#">Importar dados</a>

              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '10'  ) { ?>
     
                      <li><a href="javascript:carga00('importcusto.php');">Tabela de Custos</a></li>
                      <li><a href="javascript:carga00('importdolar.php');">Tabela do Dolar</a></li>
                      <li><a href="javascript:carga00('import_custoind.php');">Custos Indiretos</a></li>
                      <li><a href="javascript:carga00('importitensdespr.php');">Itens de Despesas</a></li>
                      <li><a href="javascript:carga00('importcustor.php');">Despesas Realizadas</a></li>
            <?php } ?>
               </ul><!-- submenu do submenu -->


        </li>
        
          <li>
        <!--a href="javascript:trsenha();">Trocar Senha</a -->
      <li><a href="javascript:carga00('cad_usuario.php');">Trocar Senha</a></li>       

        </li>
        
      
  </ul>
  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr color="#003871" width="70%" >

<center >
<a href="login_custo.php">
<img src="../imagens/footerQR.png"  border="0"></a>
</center>
</div>
</body>
</html>