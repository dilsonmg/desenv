<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script>
function validaform(){
  
nome_usu = document.form1.nome_usu.value.toUpperCase();
senha    = document.form1.senha.value;


if (nome_usu == "" ){
    alert("Informe o nome do usuário !");
	document.form1.nome_usu.value="";
	document.form1.nome_usu.focus(); 
	return false;
	}
if (senha == ""){
    alert("Informe a senha !");
	document.form1.senha.value="";
	document.form1.senha.focus(); 
	return false;
	}			
	
	 document.form1.action = "validausu_custo.php"
	 document.form1.submit();
	 return true;
}



</script>

<title>SGQ - Sistema Fabricação</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body  text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" onLoad="document.form1.nome_usu.focus();">
<div align="center">
  <table width="98%" border="0">
    <tr align="center">
      <td  align="left"><img src="../imagens/logoqrred.jpg" ></td>
      <td  align="center"><font color="#666666"  size="+2">Gest&atilde;o dos Custos de Fabrica&ccedil;&atilde;o</font></td>
    </tr>
    <tr align="center">
      <td colspan="2"  align="center"><img src="../imagens/teclado_maos-banner1.png"></td>
    </tr>
    <tr align="center"> 
      <td colspan="2"  align="center"></td>
    </tr>
    <tr> 
      <td height="144" colspan="10" align="center" valign="middle"><form name="form1">
          <table width="29%" border="0" cellpadding="0" cellspacing="0" background="imagens/fundoriscadiagonal.gif">
    
            <tr> 
              <td><font color="#000000" face="Arial, Helvetica, sans-serif">Usu&aacute;rio</font></td>
              <td ><input type="text" name="nome_usu" size="35" maxlength="35"></td>
            </tr>
            <tr> 
              <td><<font color="#000000" face="Arial, Helvetica, sans-serif">Senha</font></td>
              <td  ><input type="password"  name="senha" size=10 maxlength="10"></td>
            </tr>
            <tr>
              <td  align="center">&nbsp;</td>
              <td  align="center">&nbsp;</td>
            </tr>
            <tr> 
              <td  align="center"><input type="button" name="Button"  value="Confirma" onClick="validaform();" ></td>
              <td  align="center">
                  <input type="button" name="button2" id="button2" value="sair" OnClick="javascript:voltar_menu();" style="font:color="#006600"-size:8" />    
</td>
            </tr>
          </table>
        </form>
        <br> <img src="../imagens/footerQR.png" width="1015" height="143" border="0" usemap="#Map"></td>
    </tr>
  </table>
</div>

<map name="Map">
  <area shape="circle" coords="970,26,25" href="../index2.php">
</map>
</body>
</html>
