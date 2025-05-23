<?php
session_start();


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
*/
$a = $_GET ["gravar"];

//if ($a = "I"){
	$aResult = gravarreg( $id,$nome_usu1, $id_setor,$unidade,$telefone,$senha, $a, $_SESSION['permi'] );
//}
header("Location: login.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8){
     // echo $cp5;
	  //if ($cp1 <> "") {
	  $sqlins = "delete from tb_usuario where id_usuario = $cp1";
	  $ins=mysql_query( $sqlins );
	 // printf($sqlins);
	  if( $ins===FALSE ){
		  $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
			
  	  if ($cp7 === "I"){
	 		  // printf("entrei ".$cp5);
    		   $sqlins = "insert into tb_usuario(id_usuario,nome_usu,id_setor,unidade,telefone,senha,nv_permi) values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp8')";
			  // printf("insert into tb_usuario(id_usuario,nome_usu,id_setor,unidade,telefone,senha,nv_permi) values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp8')");
	    	   $ins=mysql_query( $sqlins );
	   }
	
		  //verifica se o resultado dado é falso
		  if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}
		  else{
				$msg= "Foi inserida " . mysql_affected_rows( ) . " linha <br/>";
				//destrói as variáveis criadas para receber os dados
			}	       
			unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$nome, $telefone, $uf );
	//}
}

?>
