<?php header("Content-Type: text/html; charset=ISO-8859-1",true) ?>
<?php
session_start();
unset($id,$a);
$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("Você não esta logado !!");
              	header("Location: login.php"); 

}

/*
 setlocale(LC_TIME,'pt_BR','ptb');

 $data_ass        = strftime("%Y-%m-%d", strtotime($row1['data_ass']));
    
 $data_ass        = strftime("%A", strtotime('2011-08-18'));
 
 echo($data_ass); 
echo strftime('%A, %d de %B de %Y',mktime(0,0,0,date('n'),date('d'),date('Y')));

   




resumo previsao

select a.cod_prod,b.descr_prod, sum(a.kg_previsto) kg_previsto, sum(a.qtde_lote_prev) qtde_lote_prev
from tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod
where month(data_pr) = 06 and year(data_pr) = 2011 group by a.cod_prod order by b.descr_prod

resumo producao

select a.cod_prod,b.descr_prod, sum(a.kg_realizado) kg_realizado, sum(a.qtde_lote_rel) qtde_lote_rel
from tb_producao a
inner join tb_produto b on a.cod_prod = b.cod_prod
where month(data_pr) = '06' and year(data_pr) = '2011' group by a.cod_prod order by b.descr_prod



*/
include 'conectabco.php';
/*

		 
*/
$p1 = "";
$p2 = "";
$p3 = "";
$p4 = "";
$p5 = "  order by a.data_pr desc limit 60" ; //limit 0,3";

$rs0 = mysql_query("select a.id_producao,a.data_pr,a.cod_prod, b.descr_prod,a.kg_previsto,a.kg_realizado,
       a.lote_realizado,a.obslote,a.qtde_lote_prev,a.qtde_lote_rel,a.cod_prodr,c.descr_prod descr_prodr
       from tb_producao a
       inner join tb_produto b on a.cod_prod = b.cod_prod
       left outer join tb_produto c on a.cod_prodr = c.cod_prod
       where a.id_producao > 0
       " . $p1 . $p2 . $p3 . $p4 . $p5);
				  
$rs10 = mysql_query("select a.cod_prod, a.descr_prod from tb_produto a order by a.descr_prod");				  

if (isset($id)){
	
     $rs1 = mysql_query("select a.id_producao,a.data_pr,a.cod_prod, b.descr_prod,a.kg_previsto,a.kg_realizado,
       a.lote_realizado,a.obslote,a.qtde_lote_prev,a.qtde_lote_rel,a.cod_prodr,c.descr_prod descr_prodr
       from tb_producao a
       inner join tb_produto b on a.cod_prod = b.cod_prod
       left outer join tb_produto c on a.cod_prodr = c.cod_prod where a.id_producao =". $id);
//print($id);
   //  $row = mysql_fetch_array($rs1, MYSQL_BOTH);
    $a = mysql_num_rows($rs1);
	//printf($a);
   
	 $row1 = mysql_fetch_assoc($rs1);
	 
     $nvid            = $row1['id_producao'];
	 $cod_prod        = $row1['cod_prod'];
     $data_pr         = $row1['data_pr'];
	 $kg_previsto     = $row1['kg_previsto'];
	 $kg_realizado    = $row1['kg_realizado'];
	 $lote_realizado  = $row1['lote_realizado'];
	 $obslote         = $row1['obslote'];
	 $qtde_lote_prev  = $row1['qtde_lote_prev'];
	 $qtde_lote_rel   = $row1['qtde_lote_rel'];
	 $cod_prodr       = $row1['cod_prodr'];
	 $descr_prodr     = $row1['descr_prodr'];

     }
else{
//     print("passei 1");
	 $rs1       = mysql_query("SELECT max(id_producao) + 1 as id_producao FROM tb_producao");
	 $row1      = mysql_fetch_assoc($rs1);
	 $nvid      = $row1['id_producao'];
	 
     if ($nvid  == ""){
		  $nvid = 1;}
	 $cod_prod        = "";
     $data_pr         = "";
	 $kg_previsto     = "";
	 $kg_realizado    = "";
	 $lote_realizado  = "";
	 $obslote         = "";
	 $qtde_lote_prev  = "";
	 $qtde_lote_rel   = "";
	 $cod_prodr       = "";
	 $descr_prodr     = "";

}
						   
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Controle de Produção</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->

<script type='text/javascript' src="funcoesprod.js"></script>

<script language="javascript">

function carga0(){
	window.open ("importadadosprod.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=250"); 
}
function carga02(){
	window.open ("importfornec.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=250"); 
}

function carga00(){
	window.open ("importadadosprevpr.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=250"); 
}
function trsenha(){
	window.open ("cad_usuario.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=350"); 
}


function carga01(){
	window.open ("importinsumo.php","mywindow","menubar=0,scrollbars=yes,resizable=1,width=810,status=yes,height=250"); 
}


</script>

<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Seletores de elementos/tag ~~ */
ul, ol, dl { /* Devido a variações entre navegadores, é recomendado zerar o padding e a margem nas listas. É possível especificar as quantidades aqui ou nos itens da lista (LI, DT, DD) que eles contêm. Lembre-se: o que você fizer aqui ficará em cascata para a lista de navegação a não ser que você escreva outro seletor mais específico. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* ao remover a margem superior, as margens podem escapar das suas containing div. A margem inferior restante vai mantê-la afastada de qualquer elemento que se segue. */
	padding-right: 15px;
	padding-left: 15px; /* adicionando o padding para os lados dos elementos dentro dos divs, ao invés dos próprios divs o livra de qualquer combinação de modelo de caixa. Um div aninhado com padding lateral também pode ser usado como método alternativo. */
	text-align: center;
	color: #666;
}
a img { /* esse seletor remove a borda azul padrão exibida em alguns navegadores ao redor de uma imagem circundada por um link. */
	border: none;
}

/* ~~ A estilização dos links do seu site deve permanecer nesta ordem – incluindo o grupo de seletores que criam o efeito hover. ~~ */
a:link {
	color:#FFF;
	text-decoration: underline; /* a não ser que você estilize seus links para que pareçam extremamente únicos, é melhor utilizar links sublinhados para uma identificação visual mais rápida. */
}
a:visited {
	color: #FFF;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* esse grupo de seletores dará ao navegador que estiver usando um teclado a mesma experiência de hover do que uma pessoa usando um mouse. */
	text-decoration: none;
}

/* ~ esse contêiner envolve todos os outros divs dando a eles uma largura com base em porcentagem ~~ */
.container {
	width: 80%;
	max-width: 1260px;/* uma largura máxima pode ser desejável para evitar que esse layout fique muito largo num monitor grande. Isso torna o comprimento da linha mais legível. O IE6 não concorda com essa declaração. */
	min-width: 780px;/* uma largura mínima pode ser desejável para evitar que esse layout fique muito estreito. Isso torna o comprimento da linha mais legível nas colunas laterais. O IE6 não concorda com essa declaração. */
	background: #FFF;
	margin: 0 auto; /* o valor automático nos lados, combinado com a largura, centraliza o layout. Não é necessário definir a largura do contêiner para 100%. */
}

/* ~~o cabeçalho não tem uma largura. Ele pode ocupar toda a largura do layout. Possui um alocador de espaço de imagem que deve ser substituído pelo seu logotipo com link~~ */
.header {
	background: #6F7D94;
	text-align: center;
}

/* ~~ Informações sobre o layout. ~~ 

1) O padding é posto somente na parte superior e inferior do div. Os elementos nesse div têm padding nos seus lados impedindo o modelo tipo caixa. Lembre-se: ao adicionar qualquer padding lateral ou  bordas no próprio div, ele será adicionado à largura que você define para criar a largura *total*. Também é necessário remover o padding no elemento do div e estabelecer um segundo div, sem largura e o padding necessário para o seu design.

*/
.content {
	padding: 10px 0;
	text-align: center;
}

/* ~~ Este seletor agrupado fornece as listas dentro do espaço da área de conteúdo ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* esse padding espelha o padding direito nos cabeçalhos e regra de parágrafo acima. O padding foi colocado na parte inferior para obter espaço entre outros elementos das listas e à esquerda para criar o recuo. Estes podem ser ajustados como desejar. */
}

/* ~~ O rodapé ~~ */
.footer {
	padding: 10px 0;
	background: #6F7D94;
}

/* ~~ flutuações diversas/limpeza de classes ~~ */
.fltrt {  /* essa classe pode ser usada para flutuar um elemento à direita da página. O elemento flutuado deve preceder o elemento e ser o próximo da página. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* essa classe pode ser usada para flutuar um elemento à esquerda da página. O elemento flutuado deve preceder o elemento e deve ser o próximo da página. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* essa classe pode ser colocada em um <br /> ou em um div vazio como o elemento final que segue o último div flutuado (no #contêiner) caso o rodapé seja removido ou retirado do contêiner. */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
.container .content table {
	font-size: 100px;
}
.container .content table {
	font-size: 9px;
}
.container .content table {
	font-size: 10px;
}
.container .content form table tr td div font {
	color: #FFF;
	font-size: 16px;
}
-->
</style></head>

<body >
<script type="text/javascript">
function calcula() 
{
	var calculo  = document.form1.kg_previsto.value / 1200;
	//UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
	document.getElementById("qtde_lote_prev").innerHTML = calculo;
	document.form1.qtde_lote_prev.value = calculo;
//	setTimeout("UR_Start()",1000);
}
	
</script>


<div class="container">
<center>
  <a href="#"><img src="../imagens/banner2.jpg" width="775" height="95" align="middle" /></a> 
    <!-- end .header -->
</center>
  <div class="content">
  <div align="left"><span style="font-size: 9px; color: #333;">
  <?php echo( $_SESSION['nome_usu']); ?>
  </span></div>
    <h1>Expedi&ccedil;&atilde;o</h1>
    <form action="" method="post" enctype="multipart/form-data" name="form1">
  <center>
      <table width="62%" cellpadding="4" cellspacing="2">
        <tr>
          <td width="24%" background="../imagens/menu.png"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="javascript:trsenha();"> Trocar senha</a></font></div></td>
          <td width="24%" background="../imagens/menu.png">
          <div align="center">
          <a href="matpcv002.php">
          <font size="1" face="Arial, Helvetica, sans-serif">Saldo de Materia Prima</font></a></div>
          </td>
        </tr>
  
       
       <?php         
          if ($_SESSION['permi'] != '305'){	?>

        <tr align="center">
          <td width="24%" height="24" background="../imagens/menu.png"><div align="center"><font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <a href="dados_entrega.php">Recebimento de Insumos</a></font></div></td>
          <td width="24%" background="../imagens/menu.png"><div align="center">
          <a href="matpe001.php">
          <font size="1" face="Arial, Helvetica, sans-serif">Entrada de Materia Prima</font></a></div></td>
        </tr>
        <?php } ?>

        <tr>
          <td width="24%" background="../imagens/menu.png"><div align="center"><a href="consulta_entrega.php"><font size="1" face="Arial, Helvetica, sans-serif">Consulta Recebimentos de Insumos</font></a></div></td>
          <td width="24%" background="../imagens/menu.png"><div align="center">
          <a href="matpe002.php">
          <font size="1" face="Arial, Helvetica, sans-serif">Saida de Materia Prima</font></a></div></td>
        </tr>
        <tr>
          <td width="24%" background="../imagens/menu.png"><div align="center"><a href="estat_entrega.php"><font size="1" face="Arial, Helvetica, sans-serif">Consulta Avalia&ccedil;&atilde;o de Recebimentos</font></a></div></td>
          <td width="24%" background="../imagens/menu.png"><div align="center">
          <a href="matpcv001.php">
          <font size="1" face="Arial, Helvetica, sans-serif">Vencimentos das Materias Primas</font></a></div></td>
        </tr>
        <tr>
          <td width="24%" background="../imagens/menu.png"><div align="center">
          &nbsp;</div></td>
          <td width="24%" background="../imagens/menu.png"><div align="center">
          <a href="matpcv003.php">
          <font size="1" face="Arial, Helvetica, sans-serif">Consulta Saidas das M.Primas</font></a></div></td>
        </tr>


           <?php         
          if ($_SESSION['permi'] == '999'){	?>
   
        <tr align="center">

          <td width="24%" height="24" background="../imagens/menu.png"><div align="center">
          <font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <a href="javascript:carga01();">Carga de Produtos</a></font></div></td>
      

          <td width="24%" background="../imagens/menu.png"></td>
        </tr>
      <?php } ?>   
         <?php         
          if ($_SESSION['permi'] == '999'){	?>
        <tr align="center">
       

          <td width="24%" height="24" background="../imagens/menu.png"><div align="center">
          <font color="#FFFFFF" size="1" face="Arial, Helvetica, sans-serif"> <a href="javascript:carga02();">Carga de Fornecedores</a></font></div></td>

<td width="24%" background="../imagens/menu.png"></td>
            </tr>
<?php }?>
      </table>
      <p><a href="login.php"><img src="../imagens/botao_sair.jpg" width="69" height="32" /></a></p>
    </form>
  </div>
  <!-- end .container --></div>
</body>
</html>
