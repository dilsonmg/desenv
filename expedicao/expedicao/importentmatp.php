<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importa��o de Dados - Entrada de Materias Primas</title>
 <head>  
<body >
<p><img src="../imagens/banner2.jpg" width="775" height="95">

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
 Importa&ccedil;&atilde;o de dados - Entrada de Materias Primas

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
	$ttreg = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     { 
	    $ttreg ++;
        $a = 0;
		$num_nfint = (int)$data[4];
/*================================ importar dados de produtos ==============================*/
	   
        $rs1 = mysql_query("SELECT * FROM tb_entmatp where data_entrada = '". $data[0] 
		       ."' and cod_fornec = '" . $data[1] 
			   ."' and cod_prod   = '" . $data[2]
			   ."' and unidade    = '" . $data[3] 
			   ."' and num_nf         = '" . $num_nfint
			   ."' and data_nf        = '" . $data[5]
			   ."' and num_lote       = '" . $data[6] ."'"   );
		
		$a   = mysql_num_rows($rs1);
	    //printf($a);
		/*
		$descr_prod = str_replace("'","`",$data[1]);	
		$descr_prod = str_replace("�","C",$descr_prod);	
        $descr_prod = str_replace("�",".",$descr_prod);
		*/
        if ($a > 0) {
			$altera = "update tb_entmatp set data_fab = '" . $data[7] . "'," .
			" data_venc = '" . $data[8] . "'," .
			" quantid_ent = '" . $data[9] . "'," .
			" atv_kamoran = '" . $data[10] . "'" .			 		 
			" where data_entrada = '". $data[0] 
		       ."' and cod_fornec = '" . $data[1] 
			   ."' and cod_prod   = '" . $data[2]
			   ."' and unidade    = '" . $data[3] 
			   ."' and num_nf         = '" . $num_nfint
			   ."' and data_nf        = '" . $data[5]
			   ."' and num_lote       = '" . $data[6] ."'"  ;
			//echo("update tb_produto set descr_prod = '" . $descr_prod . "'" . 		 
			//" where cod_prod = '" . $data[0] . "'");
			mysql_query($altera) or die(mysql_error());
			
		}else{	
            $rs2   = mysql_query("SELECT max(id_entmatp) + 1 as id_entmatp FROM tb_entmatp ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_entmatp'];
			if ($nvid == ""){$nvid = 1; }
			$inclui = " insert into tb_entmatp (id_entmatp,data_entrada,cod_fornec,cod_prod,unidade,num_nf,
			            data_nf,num_lote,data_fab,data_venc,quantid_ent,atv_kamoran) 
			values ('$nvid','$data[0]','$data[1]','$data[2]','$data[3]','$num_nfint','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]')";
			mysql_query($inclui) or die(mysql_error());
			
		}
     }

     fclose($handle);

     print  "<br>" .$ttreg . " registros inseridos com sucesso !" ;

///////////////////////////////////////////		 
       echo "<script>  

                // alert('Arquivo enviado com sucesso.');  
                 
				 // location.href = 'index.php';  

             </script>";  

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

