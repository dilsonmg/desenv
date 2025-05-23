<?php
session_start();

include 'conectabco.php';
$lgd = 0;
$opcm = 0;
if(isset($_SESSION['login'])){// verifica se existe a varavel session
   $lgd = 1;
   $login=$_SESSION['login']; // passa o valor da variavel session para outra variavel so que uma variavel dentro do mesmo arquivo
   $id = $_SESSION['idusuario'];
   
  echo($_SESSION['nome_usu']);
 //cloud
   if($login == 'dilson'){
       $opcm = 1; }
      

}else{

  echo("vc nao passou pelo arquivo anterior");

}



if (isset($id)){
	
     $rs1 = mysql_query("SELECT * FROM tb_usuario where id_usuario=". $id);
//print($id);
   //  $row = mysql_fetch_array($rs1, MYSQL_BOTH);
    $a = mysql_num_rows($rs1);
	//printf($a);
   
	 $row1 = mysql_fetch_assoc($rs1);
	 
     $nvid = $row1['id_usuario'];
     $nome_usu = $row1['nome_usu'];
     $id_setor = $row1['id_setor'];
     $unidade = $row1['unidade'];
     $telefone = $row1['telefone'];
     $senha = $row1['senha'];

     }

if ($opcm == 0){ 
    if (isset($id)){
         $nvid = $id; } else {$nvid = "";}
   					   
	$rs=mysql_query("SELECT a.*,b.descricao as setor FROM tb_usuario a 
                 left join tb_setor b 
				       on a.id_setor = b.id_setor
					   where a.id_usuario = " .$id );}
			   

$rs31=mysql_query("SELECT * FROM tb_setor order by 3");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Visualizando dados da tabela Usuários</title>
<script>
var nome_usu;
var id_setor;
var unidade;
var telefone;
var senha;

function validaform(){
id = document.form1.id.value;
  
nome_usu = document.form1.nome_usu1.value;
id_setor = document.form1.id_setor.value;
unidade  = document.form1.unidade.value;
telefone = document.form1.telefone.value;
senha    = document.form1.senha.value;
senha2    = document.form1.senha2.value;

if (id == ""){
    alert("Informe a identificação do usuário !");
	document.form1.nome_usu1.value="";
	document.form1.nome_usu1.focus(); 
	return false;
	}

if (nome_usu == ""){
    alert("Informe o nome do usuário !");
	document.form1.nome_usu1.value="";
	document.form1.nome_usu1.focus(); 
	return false;
	}
if (unidade == ""){
    alert("Informe o nome da unidade !");
	document.form1.unidade.value="";
	document.form1.unidade.focus(); 
	return false;
	}
if (telefone == ""){
    alert("Informe o N. telefone !");
	document.form1.telefone.value="";
	document.form1.telefone.focus(); 
	return false;
	}
if (senha == ""){
    alert("Informe a senha !");
	document.form1.senha.value="";
	document.form1.senha.focus(); 
	return false;
	}			
if (senha2 == "" || senha2 != senha){
    alert("Confirme a senha !");
	document.form1.senha.value="";
	document.form1.senha.focus(); 
	return false;
	}			
	
     document.form1.gravacao.value = "S"
	 document.form1.action = "gravarusuario.php?gravar=I"
	 document.form1.submit();
	 document.form1.reload();
	 return true;
}
function excluir(){
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravarusuario.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
function novo(){
  document.location.href='cad_usuario.php';
		  return true;
}

function sair(){
  document.location.href='login.php';
		  return true;
}

</script>
</head>
<body onload="document.form1.nome_usu1.focus();">
<form name="form1" METHOD="POST" enctype="multipart/form-data">
  <input type="hidden" name="gravacao" value="N">
  <input type="hidden" name="id" value="<?php echo $nvid?>">
    <input type="hidden" name="setor" value="<?php echo $descricao?>">

  
  <center>
    <table  border="1" cellpadding="0" cellspacing="0" background="../imagens/fundoriscadiagonal.gif" >
      <tr> 
        <th colspan="3" align="left"><div align="center"><font size="5">Usuário</font></div></th>
      </tr>
      <tr> 
        <th width="103" align="left"><font size="2" face="Arial, Helvetica, sans-serif">Codigo</font> 
        </th>
        <th width="270" colspan="2" align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $nvid?></font></th>
      </tr>
      <tr> 
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Nome</font></th>
        <th colspan="2" align="left"> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <input type="text" name="nome_usu1" size="45" maxlength="45" readonly="readonly" value="<?php echo $nome_usu ?>"/>
          </font></th>
      </tr>
      <tr> 
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Setor</font></th>
        <th colspan="2" align="left"> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <select name="id_setor" style="font-size:12">
            <?php while($row1=mysql_fetch_assoc($rs31)){ ?>
            <option value="<?php print($row1['id_setor'])?>"
				     <? if($row1['id_setor'] == $id_setor ) {?>selected <? } ?>				
				 ><?php print($row1['descricao'])?></option>
            <?php }//end if ?>
          </select>
          </font> </th>
      </tr>
      <tr> 
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Unidade</font></th>
        <th colspan="2" align="left"> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <input type="text" name="unidade" size="20" maxlength="20" value="<?php echo $unidade ?>" readonly="readonly"/>
          </font></th>
      </tr>
      <tr> 
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Telefone</font></th>
        <th colspan="2" align="left"> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <input type="text" name="telefone" size="12" maxlength="12" value="<?php echo $telefone?>"/>
          </font></th>
      </tr>
      <tr> 
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Senha</font></th>
        <th colspan="2" align="left"> <font size="2" face="Arial, Helvetica, sans-serif"> 
          <input type="password" name="senha" size="10" maxlength="10" value=""/>
          </font></th>
      </tr>
      <tr>
        <th align="left"><font size="2" face="Arial, Helvetica, sans-serif">Confirme 
          a Senha</font></th>
        <th colspan="2" align="left"><font size="2" face="Arial, Helvetica, sans-serif">
          <input type="password" name="senha2" size="10" maxlength="10" />
          </font></th>
      </tr>
      <tr bgcolor="#EEEEFF" background="../imagens/barrafundo.gif" > 
        <th colspan="3" align="left"><div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
            <?php
		if ($opcm == 1){?>
            <input type="button" name="Submit2" onclick="javascript:novo();" value="Novo" />
            <?php }?>
            <input type="button" name="Submit"  onclick="validaform();" value="Gravar" />
            <?php
		if ($opcm == 1){?>
            <input type="button" name="Submit3"  onclick="excluir();" value="Excluir"/>
            <?php }?>
            <input type="button" name="Submit4"  onclick="sair();" value="Sair"  />
            </font></div></th>
      </tr>
    </table>
	  
    <br />
    <table border="1"  cellpadding="0" cellspacing="0" background="../imagens/fundorisca.gif"  >
	        <tr bgcolor="#99CC99" background="../imagens/fundobarraverde.gif"> 
        <th width="88" align="left"><font size="2" face="Arial, Helvetica, sans-serif">Código 
          </font></th>
        <th width="301" align="left"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Usuário</font></div></th>
        <th width="165" align="left"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Setor</font></div></th>
        <th width="124" align="left"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Unidade</font></div></th>
        <th width="95" align="left"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Telefone</font></div></th>

      </tr>
      <?php while($row=mysql_fetch_array($rs)){ ?>
      <tr> 
        <td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="cad_usuario.php?id=<?php echo $row['id_usuario']?>"><?php echo $row['id_usuario']?></a></font></td>
        <td align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $row['nome_usu']?></font></td>
        <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $row['setor']?></font></td>
        <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $row['unidade']?></font></td>
        <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $row['telefone']?></font></td>


      </tr>
      <?php }//end if ?>
    </table>
  </center>
</form>
</body>
</html>