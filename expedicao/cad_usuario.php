    <link rel="stylesheet" href="../css/qreal.css">

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
//echo($id);
   //  $row = mysql_fetch_array($rs1, MYSQL_BOTH);
    $a = mysql_num_rows($rs1);
	//echof($a);
   
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
    <table width="80%"  border="1" background="../imagens/fundoriscadiagonal.gif" >
      <tr> 
        <th colspan="2" align="center"><h2>Cadastro de Usuário</h2></th>
      </tr>
      <tr> 
        <th  align="left">Codigo</th>
        <th  align="left"><?php echo($nvid);?></th>
      </tr>
      <tr> 
        <th align="left">Nome</th>
        <th align="left"> 
          <input type="text" name="nome_usu1" size="45" maxlength="45" readonly="readonly" value="<?php echo $nome_usu ?>"/>
          </th>
      </tr>
      <tr> 
        <th align="left">Setor</th>
        <th  align="left"> 
          <select name="id_setor" >
            <?php while($row1=mysql_fetch_assoc($rs31)){ ?>
            <option value="<?php echo($row1['id_setor'])?>"
				     <? if($row1['id_setor'] == $id_setor ) {?>selected <? } ?>				
				 ><?php echo($row1['descricao'])?></option>
            <?php }//end if ?>
          </select>
           </th>
      </tr>
      <tr> 
        <th align="left">Unidade</th>
        <th  align="left"> 
          <input type="text" name="unidade" size="20" maxlength="20" value="<?php echo $unidade ?>" readonly="readonly"/>
          </th>
      </tr>
      <tr> 
        <th align="left">Telefone</th>
        <th align="left"> 
          <input type="text" name="telefone" size="12" maxlength="12" value="<?php echo $telefone?>"/>
          </th>
      </tr>
      <tr> 
        <th align="left">Senha</th>
        <th  align="left"> 
          <input type="password" name="senha" size="10" maxlength="10" value=""/>
          </th>
      </tr>
      <tr>
        <th align="left">Confirme 
          a Senha</th>
        <th  align="left">
          <input type="password" name="senha2" size="10" maxlength="10" />
          </th>
      </tr>
      <tr bgcolor="#EEEEFF" background="../imagens/barrafundo.gif" > 
        <th colspan="2" align="center"><?php
		if ($opcm == 1){?>
          <input type="button" name="Submit2" onclick="javascript:novo();" value="Novo" class="search-submit2" />
            <?php }?>
            <input type="button" name="Submit"  onclick="validaform();" value="Gravar"  class="search-submit2" />
            <?php
		if ($opcm == 1){?>
            <input type="button" name="Submit3"  onclick="excluir();" value="Excluir"  class="search-submit2" />
            <?php }?>
            <input type="button" name="Submit4"  onclick="self.close();" value="Sair"   class="search-submit2" />
            </th>
      </tr>
    </table>
	  
    <br />
    <table border="1" background="../imagens/fundorisca.gif"  width="70%" >
	  <tr bgcolor="#99CC99" background="../imagens/fundobarraverde.gif"> 
        <th align="left">Código </th>
        <th align="left">Usuário</th>
        <th align="left">Setor</th>
        <th align="left">Unidade</th>
        <th align="left">Telefone</th>

      </tr>
      <?php while($row=mysql_fetch_array($rs)){ ?>
      <tr> 
        <td> <a href="cad_usuario.php?id=<?php echo $row['id_usuario']?>"><?php echo $row['id_usuario']?></a></td>
        <td align="left"><?php echo $row['nome_usu']?></td>
        <td align="center"><?php echo $row['setor']?></td>
        <td align="center"><?php echo $row['unidade']?></td>
        <td align="center"><?php echo $row['telefone']?></td>


      </tr>
      <?php }//end if ?>
    </table>
  </center>
</form>
</body>
</html>