<?php
$conexao=mysql_connect("localhost","root","di2134");
if(!$conexao){
echo "Erro ao se conectar";
exit;
}
$banco=mysql_select_db("quimicareal");
if(!$banco){
echo "O Banco de dados n�o foi encontrado";
exit;
}
?>
