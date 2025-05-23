<?php
$conexao=mysql_connect("localhost","root","di2134");
//mysql_set_charset('utf8',$conexao);
if(!$conexao){
echo "Erro ao se conectar";
exit;
}
$banco=mysql_select_db("quimicareal");
if(!$banco){
echo "O Banco de dados não foi encontrado";
exit;


}
?>
