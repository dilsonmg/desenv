<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);


   header('Content-type: text/html; charset=UTF-8');
   session_start();
   
   if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }   

   }else{

         echo("Voc? n?o esta logado !!");
              	header("Location: loginx.php"); 

}

$_SESSION['menuret'] = "../expedicao/menu_exped.php";
   
?>
<!DOCTYPE HTML>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

<!--html lang="pt-br"-->
<head>
  <!--meta charset="UTF-8"-->
    <title>Gest&atilde;o do Processo Fabrica&ccedil;&atilde;o</title>
     <!-- Aqui chamamos o nosso arquivo css externo -->
         <link rel="stylesheet" href="expedicm.css">

         <link rel="stylesheet" type="text/css"  href="menuexp.css" />
    <!--[if lte IE 8]>
 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
</script>
</head>
<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
<center>
<table width="98%" border="0">
      <tr>
        <th align='left'><img src="../imagens/logoqrred.jpg" border="0"></th>
        <th align='center'><font size="+2">Gest&atilde;o do Processo Fabrica&ccedil;&atilde;o</font></th>
        <th align="right"><img src="../imagens/tecladoclaro.png" ><br> <?php echo( $_SESSION['nome_usu']); ?></th>
      </tr>
    
</table>
<br>
</center>
<div class="menu-container" align="center">
  <ul class="menu clearfix">
        <li><a href="#">Recebimentos</a>    
                <ul class="sub-menu clearfix">

        <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '306') { ?>
	                  <li><a href="dados_entrega.php">Avalia&ccedil;&atilde;o de Recebimentos de Insumos</a></li>
          <?php } ?>
        <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222' || $_SESSION['permi'] == '306'  || $_SESSION['permi'] == '300'|| $_SESSION['permi'] == '305' || $_SESSION['permi'] == '227') { ?>
                       
	                  <li><a href="consulta_fornec.php">Consulta - Receb. por Fornecedor</a></li> 
                      <li><a href="estat_entrega.php">Consulta - Pontua&ccedil;&atilde;o de Fornecedores</a></li>        
         <?php } ?>
                     </ul><!-- submenu -->

         </li>
         <li><a href="#">Mat&eacute;rias-Primas</a>
              <ul class="sub-menu clearfix"> 
           <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '306') { ?>
            
	                  <li><a href="matpcv002.php">Saldo</a></li>
                      <li><a href="matpe001.php">Entrada</a></li>
                      <li><a href="matpe002.php">Saidas</a></li>
            <?php } ?>          
                      <li><a href="matpcv001.php">Vencimentos</a></li>
                      
           <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '227' || $_SESSION['permi'] == '306') { ?>
                          <li><a href="#">Consultar movimentacao</a>
                             <ul class="sub-menu">
                                  <li><a href="matpcv004.php">Consulta Entradas</a></li>
                                  <li><a href="matpcv003.php">Consulta Saidas p/Lt. Fabr</a></li>         
                                  <li><a href="matpec02.php">Consulta Saidas </a></li>
                                  <li><a href="matpec02b.php">Consulta Producao x Perda </a></li>
                                  <li><a href="matpec02c.php">Consulta Percentual de Perda </a></li>
                                  <li><a href="matpcv003es.php">Consulta Entradas / Saidas p. lote M.Prima</a></li>

                            </ul><!-- submenu do submenu do submenu -->
                       </li>
           

          <?php } ?>
        <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222' || $_SESSION['permi'] == '306' || $_SESSION['permi'] == '300'|| $_SESSION['permi'] == '305' || $_SESSION['permi'] == '111' || $_SESSION['permi'] == '227') { ?>
                  <li><a href="#">Consultar Consumo</a>
                       <ul class="sub-menu">
                      
                              <li><a href="matpcm001.php">Consumo Mensal de M.Primas</a></li>
                              <li><a href="matpcm001r.php">Consumo Mensal de M.Primas em Reais</a></li>
                              <li><a href="matpcm001d.php">Consumo Mensal de M.Primas em Dolar</a></li>
                              <li><a href="matpcmf001.php">Consumo Mensal de M.Primas p/ prod. fabricado</a></li>
        
                              <li><a href="matpcon00.php">Consumo M&eacute;dio de M. Primas</a></li>

                        </ul><!-- submenu do submenu do submenu -->
                  </li>

         <?php } ?>
             <li><a href="for75101p.php">FOR75101-On Line</a></li>
                        </ul><!-- submenu do submenu -->

         
        </li>
        <li><a href="#">Produto Acabado</a>
                      <ul class="sub-menu clearfix"> 
                      <li><a href="matpeds001.php">Saldo de produto acabado</a></li>
                      <li><a href="matpac005.php">Controle de Vencimentos</a></li>
                      <li><a href="matpac100c.php">Consulta Par&acirc;metros de An&aacute;lise</a></li>                      

         <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>      
                      <li><a href="matpac100.php">Par&acirc;metros de An&aacute;lise</a></li>
                      <li><a href="matpac001.php">Entradas Produto Acabado</a></li>
                      <li><a href="matpac200.php">Libera&ccedil;&atilde;o Produto Acabado</a></li>
                      <li><a href="matpacmv201.php">Movimenta&ccedil;&atilde;o Produtos Acabados</a></li>
                      <li><a href="matpac003.php">Sa&iacute;da Prod. Acabado</a></li>
                      
   <?php } ?>
                      <li><a href="matpacm01.php">Sa&iacute;da Mensal Prod. Acabado</a></li>
                      <li><a href="matpac201.php">Consulta Produtos Liberados</a></li>
                      <li><a href="matpac004.php">Consulta Saidas Prod. Acabado</a></li>
                      <li><a href="matpcm012.php">Consulta Produ&ccedil;&atilde;o Mensal de  Prod. Acabado</a></li>

      
                 </ul><!-- submenu do submenu -->
       
        </li>
        <li><a href="#">Amostras</a>
                      <ul class="sub-menu clearfix"> 

         <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>      
                      <li><a href="matam0008.php">Entrada de Processados</a></li>
                      <li><a href="matam0011.php">Grupos de Amostras</a></li>
                      <li><a href="matam0001.php">Gerar kits de Amostras</a></li>
                      <!--li><a href="matam0009.php">Saida de Processados</a></li-->
                      <li><a href="matam0003.php">Composi&ccedil;&atilde;o de Kits</a></li>
                     <li><a href="matam0004.php">Sa&iacute;da de Kits de Amostras</a></li>
       
         <?php } ?>                      
                      <li><a href="matam0018.php">Consulta Saldo de Processados</a></li>
                      <li><a href="matam0005.php">Consulta Saidas do Kits Amostras</a></li>
                      <li><a href="matam0006.php">Consulta Saldos de Kits de Amostras</a></li>
                      
               </ul><!-- submenu do submenu -->

        </li>

        <li><a href="#">Pedidos</a>
              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>

                      <li><a href="matped001.php">Previs&atilde;o de Sa&iacute;das por Lote Fabricado</a></li>
           <?php } ?>
                      <li><a href="matpedc01.php">Consulta Previs&atilde;o de Saidas Por Lote</a></li>

               </ul><!-- submenu do submenu -->
        </li>
        <li><a href="#">Transporte</a>
              <ul class="sub-menu clearfix"> 
                    <li><a href="mattr0001.php">Transportadoras</a></li>

             <?php 
			  //if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { 
			  ?>
 
                      <li><a href="../comissoes/matpac510n.php">Fretes</a></li>
           <?php 
		   //} 
		   ?>

               </ul><!-- submenu do submenu -->
        </li>


        <li><a href="#">Rastreablidade</a>
              <ul class="sub-menu clearfix"> 
             <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300'|| $_SESSION['permi'] == '111' || $_SESSION['permi'] == '305'  || $_SESSION['permi'] == '227') { ?>

                      <li><a href="matrt000.php">Rastreamento Por Lote Fabricado</a></li>
                      <li><a href="matrt001.php">Rastreamento Por Lote de Materia Prima</a></li>
                      <li><a href="matrt002.php">Rastreamento Por Cliente</a></li>
                      <li><a href="matrt003.php">Rastreamento Por Produto</a></li>
                      <li><a href="matrtnf2.php">Rastreamento Por NF</a></li>
                      <li><a href="matrtped.php">Rastreamento Por Pedido</a></li>
                      <li><a href="matrtped2.php">Rastreamento Por Lote P.A</a></li>            
                      <li><a href="docto00e4.php">Consulta de Laudos</a></li>
                      
            <?php } ?>

               </ul><!-- submenu do submenu -->
        </li>
        
        <!---------------------------------------------------->
 
                <li><a href="#">Pesquisa e Desenvolvimento</a>
               <ul class="sub-menu">
           <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>             

                       <li><a href="#">Entrada de Dados</a>
                            <!-- NG­vel 3 -->
                            <!-- submenu do submenu do submenu -->
                            <ul class="sub-menu">   

                         
                                 <li><a href="proj0001.php">Cadastro de Projetos</a></li>
                                 <li><a href="proj0002.php">Parametros de Estudo</a></li>
                                 <li><a href="proj0006.php">Ambientes de Estudo</a></li>
                                 <li><a href="proj0004.php">Formula&ccedil;&atilde;o</a></li>
                                 <li><a href="proj0003.php">Analise de Par&acirc;metros</a></li>
                                 <li><a href="proj0007.php">Acompanhamento Semanal</a></li>
                                 
                                <li><a href="proj0008.php">Documenta&ccedil;&atilde;o dos Projetos</a></li>
                           
                            </ul><!-- submenu do submenu do submenu -->
                        </li>     
         <?php } ?>  

                        <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '111' || $_SESSION['permi'] == '227') { ?>             
   
                        <li><a href="#">Consultas</a>
                             <ul class="sub-menu">
                                <li><a href="projc004.php">Estudos Formula&ccedil;&atilde;o</a></li>
                                <li><a href="projc007.php">Acompanhamento Semanal</a></li>
                                <li><a href="projc008.php">Documenta&ccedil;&atilde;o dos Projetos</a></li>
                                <li><a href="projc001.php">Consultar Projetos</a></li>

                            </ul><!-- submenu do submenu do submenu -->
                       </li>
                                 <?php } ?>     


                    </ul>
        </li>
        
        <!---------------------------------------------------->
 
        
        <!---------------------------------------------------->
 
            <li><a href="#">Producao</a>
               <ul class="sub-menu">

                       <li><a href="#">Consultas</a>
                            <!-- NG­vel 3 -->
                            <!-- submenu do submenu do submenu -->
                            <ul class="sub-menu">                          
                                 <li><a href="../producao/rel_producao.php">Planejamento</a></li>
                                 <li><a href="../producao/cons_prod.php">Previsoes/Vendas</a></li>
                                 <li><a href="../producao/matpac004l.php">Lotes por ano</a></li>
                                 <li><a href="../producao/cons_prod3grf">Anual por Linha</a></li>
                                 <li><a href="../producao/cons_prod6grf.php">Realizada Mensal</a></li>
                           
                            </ul><!-- submenu do submenu do submenu -->
                        </li>     
                    </ul>
            </li>
        
        <!---------------------------------------------------->
 
 
        
        <!---------------------------------------------------->
                <li><a href="#">Arquivo</a>
               <ul class="sub-menu">
                       <li><a href="#">Contraprova Produto Acabado</a>
                            <!-- NG­vel 3 -->
                            <!-- submenu do submenu do submenu -->
                             <ul class="sub-menu">
          <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>                                        
                                 <li><a href="matcp001.php">Gest&atilde;o Contraprova P.A.</a></li>
           <?php }?>                 
                                 <li><a href="matcpcv1.php">Consulta por Vencimento </a></li>
                                 <li><a href="matcpcv2.php">Consulta por Dt. Fabrica&ccedil;&atilde;o</a></li>
                                 <li><a href="matcpde1.php">Consulta P.A. descartados</a></li>
                                
                            </ul><!-- submenu do submenu do submenu -->
                        </li>           
                        <li><a href="#">Contraprova Materia Prima</a>
                             <ul class="sub-menu">
                            <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>                                        
 
                                 <li><a href="matcpm01.php">Gest&atilde;o Contraprova M.P.</a></li>
                            <?php }?>
                                 
                                 <li><a href="matcpcvm1.php">Consulta por Vencimento </a></li>
                                 <li><a href="matcpcvm2.php">Consulta por Data Fabrica&ccedil;&atilde;o</a></li>
                                 <li><a href="matcpcvm2a.php">Consulta por Data Entrada</a></li>                                 
                                 <li><a href="matcpdem1.php">Consulta M.P descartados</a></li>

                            </ul><!-- submenu do submenu do submenu -->
                       </li>                  
                        
                        <li><a href="#">Documentos</a>
                             <ul class="sub-menu">
                                <li><a href="docto0002f.php">Lista De Documentos</a></li>
                                <li><a href="../documentos/doctoam01.php">Arquivo Morto</a></li>
                                <li><a href="../documentos/doctoamc3.php#">Consulta por Vencimento</a></li>
                                <li><a href="../documentos/doctoamc1.php">Consulta Documentos Descartados</a></li>
                                <li><a href="../documentos/doctoamc2.php">Consulta Documentos Nao Descartados</a></li>

                            </ul><!-- submenu do submenu do submenu -->
                       </li>

                    </ul>
        </li>

        <!---------------------------------------------------->

        <li><a href="#">Documentos</a>
          <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300') { ?>             
              <ul class="sub-menu clearfix"> 

                      <li><a href="doctoau01.php">Liberacao de Documentos para Consulta</a></li>
                      

               </ul><!-- submenu do submenu -->
        <?php } ?>
        </li>


        <!----------------------------------------------------

                
          <li><a href="#">Custos de Produ&ccedil;&atilde;o</a>

              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '111'|| $_SESSION['permi'] == '10') { ?>
                      <li><a href="custoind001.php">Centros de Custos - Indiretos</a></li>
                      <li><a href="custoindv001.php">Vincula&ccedil;&atilde;o Mensal de C.Custos - Indiretos</a></li>
                      <li><a href="custoindvc01.php">Consulta Vincula&ccedil;&atilde;o Mensal de C.Custos - Indiretos</a></li>
     
                      <li><a href="matpac_custo_prod.php">Consulta Custos de Produ&ccedil;&atilde;o</a></li>
                      <li><a href="matpac_custo_prod_anual.php">Consulta Custo Anual por Linha</a></li>

            <?php } ?>
               </ul><!-- submenu do submenu -->


        </li>

                
          <li><a href="#">Importar dados</a>

              <ul class="sub-menu clearfix"> 
              <?php if ($_SESSION['permi'] == '999' || $_SESSION['permi'] == '222'  || $_SESSION['permi'] == '300' || $_SESSION['permi'] == '10'  ) { ?>
     
                      <li><a href="javascript:carga00('importfornec.php');">Tabela de Fornecedores</a></li>
                      <li><a href="javascript:carga00('importinsumo.php');">Tabela de Produtos</a></li>
                      <li><a href="javascript:carga00('importcliente.php');">Tabela de Clientes</a></li>
                      <!--li><a href="javascript:carga00('importcusto.php');">Tabela de Custos</a></li>
                      <li><a href="javascript:carga00('importdolar.php');">Tabela do Dolar</a></li -->
                  
                      <li>Importar Entrada Materia Prima<!--a href="javascript:carga00('importentmatp.php');"></a--></li>
                      <li><!--a href="javascript:carga00('importsaidmatp.php');"></a-->Importar Saidas Materia Prima</li>
                      <li><!--a href="javascript:carga00('importentprodac.php');"></a-->Importar Entrada Produto Acabado</li>
                      <li><a href="javascript:carga00('importsaidprodac.php');">Importar Saida Produto Acabado</a></li>

            <?php } ?>
               </ul><!-- submenu do submenu -->


        </li>
        
          <li>
        <!--a href="javascript:trsenha();">Trocar Senha</a -->
      <li><a href="cad_usuario.php">Trocar Senha</a></li>       

        </li>
        
      
  </ul>
  
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<center >
<hr color="#003871" width="70%" >
<a href="login.php">
<img src="../imagens/footerQR.png"  border="0"></a>
</center>
</div>
</body>
</html>