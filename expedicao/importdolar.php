<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importa��o de Dados - Custos</title>
 <head>  
  <script>
 
 		function start(registro){
			//if((progresso ++) < maximo){
			//    progresso ++;
				document.getElementById("contador").value = registro;
				//document.getElementById("pg").value = progresso;
				//setTimeout("start();",1000);
			//}
		}
</script>
</head>
<body >
<p><img src="../imagens/banner2.jpg" >

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
 Importa&ccedil;&atilde;o de dados - tabela de dolar

 <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">  
     <p>  

       <input type="file" name="flfArquivo" id="flfArquivo" />  

   </p>  
     <p>Registros Gravados <input name="contador"  type="text" id="contador" size="5" dir="rtl" readonly="readonly"  /> </p>  

     <input type="submit" name="btnEnviar" id="btnEnviar" value="Submit" />  
<input type='button' name='Submit4'  onclick='javascript:self.close();' value='Sair' style='font:color=#006600-size:8' />

 </form>  

 </body>  

 
<?PHP  
ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

 //Se receber via POST o bot�o "btnEnviar" d� inicio ao processo de envio  

 //OBS: ao entrar na p�gina n�o � executado porque ainda n�o foi clicado no bot�o "btnEnviar"  

 if($_POST["btnEnviar"]){  

     //Recebe o caminho do arquivo selecionado  

     $arquivo = $_FILES["flfArquivo"]["name"];  
	 echo($arquivo);

     //Verifica se foi selecionado algum arquivo  
     if(!empty($arquivo)){  

     //Verifica se a pasta "arquivos existe, se n�o existir cria a pasta"  

$dirName = "arquivostst";
     if(!is_dir("./arquivostst")){  

         mkdir("./".$dirName, 0777);  

     }  

     //Copia o arquivo com o nome tempor�rio para a pasta "arquivos" com o nome original  

     if(copy($_FILES["flfArquivo"]["tmp_name"], "./arquivostst/".$_FILES["flfArquivo"]["name"])){  

     //Avisa com um "alert" que o arquivo foi enviado com sucesso e volta para a p�gina desejada, nesse caso a index.php  

////////////////////////////////////////////

/*

SELECT year(a.data_liblote) ano_fab, a.cod_prod, b.descr_prod, count(a.cod_prod) num_produz
FROM tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
where data_liblote is not null
group by year(a.data_liblote), a.cod_prod
order by year(a.data_liblote) desc

*/

include 'conectabco.php';
mysql_query("SET NAMES 'utf8'");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_results=utf8");

$id_con = '';
$ponteiro = fopen ("arquivostst/".$arquivo, "r");

 if  (!feof ($ponteiro)) {
 //Trabalha com o Arquivo Txt de SMS
     $linha = fgets($ponteiro, 4096);
     $col = explode(";", $linha);
     $campos = count($col) - 1;
 //echo("campos = ".$campos);
 }
    fclose($ponteiro);
	
//////////////////////////
if($campos > 3){
			echo("<h1>Tabela Invalida1 !! </h1>");}
else{
  $zeratab= "truncate tb_dolarmes ";
  //mysql_query($zeratab);
}
	$filename = $_FILES["flfArquivo"]["name"];
	$handle = fopen("arquivostst/".$arquivo,"r");
	$ttreg = 0;
	$reg = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     { 
	 
	   $campos = count($data) -1;
	
	    if ($campos > 3 ){
			echo("<h1>Tabela Invalida2 !! </h1>");
			break;
		}
	 
	 
        $a = 0;
		$ttreg ++;

	 $reg ++; 
	 ?>
     <script>
	     //document.write("Processando aguarde !"); 
	    start(<?php echo($reg)?>);

	 </script>
     <?

/*================================ importar dados de produtos ==============================*/
	   if ($campos == 3){
	   
        $rs1 = mysql_query("SELECT * FROM tb_dolarmes where mes_dolar = '". $data[0] . "'"
		                   . " and ano_dolar = '" . $data[1] . "'" ) ;
		 $a   = mysql_num_rows($rs1);
	    //printf($a);
		/*
		$descr_prod = str_replace("'","`",$data[1]);	
		$descr_prod = str_replace("�","C",$descr_prod);	
        $descr_prod = str_replace("�",".",$descr_prod);
		$linha_prod = str_replace("'","`",$data[2]);	
		$linha_prod = str_replace("�","C",$linha_prod);	
        $linha_prod = str_replace("�",".",$linha_prod);
		*/
		
		$valordolar = str_replace(",",".",$data[2]);	

        if ($a > 0) {
			$altera = "update tb_dolarmes set valor_dolar = '" . $valordolar
					       ."' where mes_dolar = '". $data[0] . "'"
		                   . " and ano_dolar = '" . $data[1] . "'" ;
					
			//echo("update tb_produto set descr_prod = '" . $descr_prod . "'" . 		 
			//" where valor_dolar = '" . $data[0] . "'");
			mysql_query($altera) or die(mysql_error());
			
		}else{	
		
		
			$inclui = " insert into tb_dolarmes (mes_dolar, ano_dolar, valor_dolar) 
			values ('$data[0]','$data[1]','$valordolar')";
			mysql_query($inclui) or die(mysql_error());
			
		}
	   }
     }

     fclose($handle);
	 
	 if($campos == 3){

          print "Os dados foram inseridos com sucesso !";
	     echo ("<br> Total de Registros gravados : ".$ttreg);
	 }
///////////////////////////////////////////		 

         }else{  

             //Se n�o foi possivel copiar o arquivo avisa com um "alert" que houve um erro e volta para a p�gina desejada(index.php neste caso)  

             echo "<script>  

                     alert('N�o foi possivel enviar o arquivo, tente novamente.');  

                     location.href = 'menu_exped.php';  

                 </script>";  

         }  

         //Se n�o foi selecionado nenhum arquivo pede-se ao usu�rio que selecione antes de enviar  

         }else{  

             echo "<script>alert('Escolha um arquivo');</script>";  

         }  
		 
     }  

 ?>  

 </html> 
