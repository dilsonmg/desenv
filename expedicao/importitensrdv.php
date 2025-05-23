<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importação de Dados - Insumos</title>
<link rel="stylesheet" href="../css/qreal.css">

<script language="javascript">
 /*
    var progresso = new Number();
	var maximo    = new Number();
	var progresso = 0;
	var maximo    = 100;
*/	
		function start(registro){
			//if((progresso ++) < maximo){
			//    progresso ++;
				document.getElementById("contador").value = registro;
				//document.getElementById("pg").value = progresso;
				//setTimeout("start();",1000);
			//}
		}

</script>
 <head>  
<body>
<p><img src="../imagens/banner2.jpg" >

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br /> <br /> <br /> <br />
 Importa&ccedil;&atilde;o de dados - Itens de RDV

 <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">  
     <p>  

       <input type="file" name="flfArquivo" id="flfArquivo"  />  

   </p>
     <p>Registros Gravados <input name="contador"  type="text" id="contador" style="border:0;"  size="5" dir="rtl" readonly="readonly"  /> </p>  

     <input type="submit" name="btnEnviar" id="btnEnviar" value="Submit" />  
<input type='button' name='Submit4'  onclick='javascript:self.close();' value='Sair' style='font:color=#006600-size:8' />

<br />
<!--progress id="pg" max="100"></progress> -->
 </form>  

    

 </body>  

 
<?PHP  
ini_set("max_execution_time", 9600);
ini_set("memory_limit","512M");

 //Se receber via POST o botão "btnEnviar" dá inicio ao processo de envio  

 //OBS: ao entrar na página não é executado porque ainda não foi clicado no botão "btnEnviar"  

 if($_POST["btnEnviar"]){  

     //Recebe o caminho do arquivo selecionado  
	// echo('Processando ' . '<img src="../imagens/processando.gif" border="0">');

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

	$filename = $_FILES["flfArquivo"]["name"];
	$handle = fopen("arquivostst/".$arquivo,"r");
	 $reg = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     {
		 $reg ++; 
	 ?>
     <script>
	     //document.write("Processando aguarde !"); 
	    start(<?php echo($reg)?>);

	 </script>
     <?
	 
        $a = 0;
/*================================ importar dados de produtos ==============================*/
        $rs1 = mysql_query("SELECT * FROM tb_itemrdv where coditem_si = '". $data[0] ."'");
        $a   = mysql_num_rows($rs1);
	    //printf($a);
		$descr_item = str_replace("'","`",$data[1]);	
		$descr_item = str_replace("€","C",$descr_item);	
        $descr_item = str_replace("§",".",$descr_item);
		$coditem_si = $data[0];
        if ($a > 0) {
			$altera = "update tb_itemrdv set descr_item = '" . $descr_item . "'" . 		 
			" where coditem_si = '" . $data[0] . "'";
			mysql_query($altera) or die(mysql_error());
			
		}else{	
			$inclui = " insert into tb_itemrdv (coditem_si, descr_item) 
			values ('$coditem_si','$descr_item')";
			mysql_query($inclui) or die(mysql_error());
			
		}
     }

     fclose($handle);

     echo( "Os dados foram inseridos com sucesso !");

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

