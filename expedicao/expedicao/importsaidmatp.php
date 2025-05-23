<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importação de Dados - Saidas de Materias Primas</title>
 <head>  
<body >
<p><img src="../imagens/banner2.jpg" width="775" height="95">

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
 Importa&ccedil;&atilde;o de dados - Saidas de Materias Primas

 <form name="form1" id="form1" enctype="multipart/form-data" method="post" action="">  
     <p>  

       <input type="file" name="flfArquivo" id="flfArquivo" />  

   </p>  

     <input type="submit" name="btnEnviar" id="btnEnviar" value="Submit" />  
<input type='button' name='Submit4'  onclick='javascript:self.close();' value='Sair' style='font:color=#006600-size:8' />

 </form>  

    

 </body>  

 
<?PHP  
ini_set("max_execution_time", 19600);
ini_set("memory_limit","512M");

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
  //$zeratab= "truncate tb_produto ";
  //mysql_query($zeratab);
	$filename = $_FILES["flfArquivo"]["name"];
	$handle = fopen("arquivostst/".$arquivo,"r");
	$ttimport = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     { 
        $a = 0;
		$ttimport++;
/*================================ importar dados de produtos ==============================*/
	   	   
        $rs1 = mysql_query("SELECT * FROM tb_saidmatp where cod_prod = '". $data[0] 
		       ."' and num_lote    = '" . $data[1] 
			   ."' and data_saida  = '" . $data[2]
			   ."' and quantid_said  = '" . (float)$data[3] 
			   ."' and lote_fabricado  = '" . $data[4]
			   ."'"   );
		
		$a   = mysql_num_rows($rs1);
	    //printf($a);
		/*
		$descr_prod = str_replace("'","`",$data[1]);	
		$descr_prod = str_replace("€","C",$descr_prod);	
        $descr_prod = str_replace("§",".",$descr_prod);
		*/
        if ($a > 0) {
			$altera = "update tb_saidmatp set unidade = '" . $data[6] 
			   ."' where cod_prod  = '" . $data[0] 
		       ."' and num_lote    = '" . $data[1] 
			   ."' and data_saida  = '" . $data[2]
			   ."' and quantid_said  = '" . (float)$data[3] 
			   ."' and lote_fabricado  = '" . $data[4]
			   ."'"  ;
			//echo("update tb_produto set descr_prod = '" . $descr_prod . "'" . 		 
			//" where cod_prod = '" . $data[0] . "'");
			mysql_query($altera) or die(mysql_error());
			
		}else{	
            $rs2   = mysql_query("SELECT max(id_saidmat) + 1 as id_saidmat FROM tb_saidmatp ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_saidmat'];
			if ($nvid == ""){$nvid = 1; }
			
			if($data[5] == ''){$data[5] = 0;}
			
			$inclui = " insert into tb_saidmatp (id_saidmat, cod_prod, num_lote,data_saida,quantid_said,
			            lote_fabricado,saldo_anterior,unidade) 
			values ('$nvid','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			mysql_query($inclui) or die(mysql_error());
			
		}
     }

     fclose($handle);

     echo("Os dados foram inseridos com sucesso !" . "<br>". $ttimport . " Registros gravados ");

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

