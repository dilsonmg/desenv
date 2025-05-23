<?php
     session_start(); // sempre chamamos a sessão dessa forma

include 'conectabco.php';

/*
echo $_POST ["nome"];
echo $a;


$a = $_POST ["nome"];
*/
//print("SELECT * FROM tb_usuario where nome_usu like '%". $nome_usu . "%'" . " and senha = '".$senha ."'");

     $rs1 = mysql_query("SELECT * FROM tb_usuario where nome_usu like '%". $nome_usu . "%'" . " and senha = '".$senha ."'");
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


	header("Location: index_desp_ar.php"); 
	}
?>
