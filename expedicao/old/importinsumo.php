<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importação de Dados - Insumos</title>
 <head>  
<body >
<p><img src="../imagens/banner2.jpg" width="775" height="95">

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
 Importa&ccedil;&atilde;o de dados - Insumos

 <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">  
     <p>  

       <input type="file" name="flfArquivo" id="flfArquivo" />  

   </p>  

     <input type="submit" name="btnEnviar" id="btnEnviar" value="Submit" />  
<input type='button' name='Submit4'  onclick='javascript:self.close();' value='Sair' style='font:color=#006600-size:8' />

 </form>  

 </body>  

 
<?PHP  
ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

 //Se receber via POST o botão "btnEnviar" dá inicio ao processo de envio  

 //OBS: ao entrar na página não é executado porque ainda não foi clicado no botão "btnEnviar"  

 if($_POST["btnEnviar"]){  

     //Recebe o caminho do arquivo selecionado  

     $arquivo = $_FILES["flfArquivo"]["name"];  
	 echo($arquivo);

     //Verifica se foi selecionado algum arquivo  
     if(!empty($arquivo)){  

     //Verifica se a pasta "arquivos existe, se não existir cria a pasta"  

$dirName = "arquivostst";
     if(!is_dir("./arquivostst")){  

         mkdir("./".$dirName, 0777);  

     }  

     //Copia o arquivo com o nome temporário para a pasta "arquivos" com o nome original  

     if(copy($_FILES["flfArquivo"]["tmp_name"], "./arquivostst/".$_FILES["flfArquivo"]["name"])){  

     //Avisa com um "alert" que o arquivo foi enviado com sucesso e volta para a página desejada, nesse caso a index.php  

////////////////////////////////////////////

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
     $campos = count($col);
 echo("campos = ".$campos);
 }
    fclose($ponteiro);
	
//////////////////////////
if($campos > 4){
			echo("<h1>Tabela Invalida !! </h1>");}
else{
  $zeratab= "truncate tb_produto ";
  mysql_query($zeratab);
}
	$filename = $_FILES["flfArquivo"]["name"];
	$handle = fopen("arquivostst/".$arquivo,"r");
	$ttreg = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     { 
	 
	   $campos = count($data);
	
	    if ($campos > 4 ){
			echo("<h1>Tabela Invalida !! </h1>");
			break;
		}
	 
	 
        $a = 0;
		$ttreg ++;
/*================================ importar dados de produtos ==============================*/
	   if ($campos < 5){
        $rs1 = mysql_query("SELECT * FROM tb_produto where cod_prod = '". $data[0] ."'");
        $a   = mysql_num_rows($rs1);
	    //printf($a);
		$descr_prod = str_replace("'","`",$data[1]);	
		$descr_prod = str_replace("€","C",$descr_prod);	
        $descr_prod = str_replace("§",".",$descr_prod);
		$linha_prod = str_replace("'","`",$data[2]);	
		$linha_prod = str_replace("€","C",$linha_prod);	
        $linha_prod = str_replace("§",".",$linha_prod);
		
        if ($a > 0) {
			$altera = "update tb_produto set descr_prod = '" . $descr_prod . "',linha = '" .$linha_prod . 		 
			"' where cod_prod = '" . $data[0] . "'";
			//echo("update tb_produto set descr_prod = '" . $descr_prod . "'" . 		 
			//" where cod_prod = '" . $data[0] . "'");
			mysql_query($altera) or die(mysql_error());
			
		}else{	
            $rs2   = mysql_query("SELECT max(id_prod) + 1 as id_prod FROM tb_produto ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_prod'];
			if ($nvid == ""){$nvid = 1; }
			$inclui = " insert into tb_produto (id_prod, cod_prod, descr_prod,linha) 
			values ('$nvid','$data[0]','$descr_prod','$linha_prod')";
			mysql_query($inclui) or die(mysql_error());
			
		}
	   }
     }

     fclose($handle);
	 $a1 = 0;
	    $rs1 = mysql_query("SELECT * FROM tb_produto where cod_prod = '88888'");
        $a1   = mysql_num_rows($rs1);
     if ($a1 == 0){
		    $rs2   = mysql_query("SELECT max(id_prod) + 1 as id_prod FROM tb_produto ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_prod'];
			if ($nvid == ""){$nvid = 1; }

				$inclui = " insert into tb_produto (id_prod, cod_prod, descr_prod,linha) 
			    values ('$nvid','88888','AGUA DEFINICAO','M.PRIMAS')";
			mysql_query($inclui) or die(mysql_error());
	 }
	 $a1 = 0;
	    $rs1 = mysql_query("SELECT * FROM tb_produto where cod_prod = '88889'");
        $a1   = mysql_num_rows($rs1);
     if ($a1 == 0){
		    $rs2   = mysql_query("SELECT max(id_prod) + 1 as id_prod FROM tb_produto ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_prod'];
			if ($nvid == ""){$nvid = 1; }

				$inclui = " insert into tb_produto (id_prod, cod_prod, descr_prod,linha) 
			    values ('$nvid','88889','AGUA FORMULA CONVENCIONAL ','M.PRIMAS')";
			mysql_query($inclui) or die(mysql_error());
	 }
	 
	 
	 if($campos < 5){

          print "Os dados foram inseridos com sucesso !";
	     echo ("<br> Total de Registros gravados : ".$ttreg);
	 }
///////////////////////////////////////////		 
       echo "<script>  

                // alert('Arquivo enviado com sucesso.');  
                 
				 // location.href = 'index.php';  

             </script>";  

         }else{  

             //Se não foi possivel copiar o arquivo avisa com um "alert" que houve um erro e volta para a página desejada(index.php neste caso)  

             echo "<script>  

                     alert('Não foi possivel enviar o arquivo, tente novamente.');  

                     location.href = 'menu_exped.php';  

                 </script>";  

         }  

         //Se não foi selecionado nenhum arquivo pede-se ao usuário que selecione antes de enviar  

         }else{  

             echo "<script>alert('Escolha um arquivo');</script>";  

         }  
		 
     }  

 ?>  

 </html> 
