<?php
/// alterar senha do root no mysql ////////////////////////////////////////////////////////////
////////// UPDATE user SET Password=PASSWORD('SENHA_SAN') WHERE User='root';

     session_start(); // sempre chamamos a sessão dessa forma

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

}else{

  echo("Você não esta logado !!");
              	header("Location: login.php"); 

}

include 'conectabco.php';

/*
echo $_POST ["nome"];
echo $a;


$a = $_POST ["nome"];

print("SELECT * FROM tb_usuario where nome_usu like '%". $nome_usu . "%'");
*/
     $rs1 = mysql_query("SELECT * FROM tb_usuario where nome_usu like '%". $_GET ["nome_usu"] . "%' and senha = '".$_GET ["senha"] ."'");
   //  $row = mysql_fetch_array($rs1, MYSQL_BOTH);
   
  if  (!$rs1) {
    echo "Não executou!";
  }
	 $row1 = mysql_fetch_assoc($rs1);
  if (!$row1) {
    echo "Usuário ou senha invalidos !";
  }
   else{
   
    $nvid = $row1['id_usuario'];
    $nome_usu1 = $row1['nome_usu'];
    $id_setor = $row1['id_setor'];
    $unidade = $row1['unidade'];
    $telefone = $row1['telefone'];
    $senha = $row1['senha']; 
	
     
     $login=$nome_usu; // passamos um valor qualquer a variavel $login "ainda não é a sessao"
     
     $_SESSION['login']=$login;
	 $_SESSION['permi']=$row1['nv_permi'];
	 $_SESSION['idusuario']=$nvid;
	 $_SESSION['nome_usu']=$row1['nome_usu'];
	 $_SESSION['id_setor']=$row1['id_setor'];

  
	if ($_SESSION['permi'] == 300 || $_SESSION['permi'] == 111 || $_SESSION['permi'] == 305 || $_SESSION['permi'] == 306 || $_SESSION['permi'] == 999 || $_SESSION['permi'] == 222 ||$_SESSION['permi']== 227 || $_SESSION['permi'] == 888 || $_SESSION['permi'] == '10'){
		if ($id_setor != 8){
        	$_SESSION['en']='0';
      		header("Location: menu_exped.php"); 
		}
		}
	else{
        echo("Voce nao tem permissão para acessar este sistema !"); }
	
			
}		
?>
