<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importa��o de Dados - Saida de Produtos Acabados</title>
 <head> 
 <script language="javascript">
		function start(registro){
				document.getElementById("contador").value = registro;
		}

</script>
 </head> 
<body >
<p><img src="../imagens/banner2.jpg" >

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
 Importa&ccedil;&atilde;o de dados - Saida de Produtos Acabados

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
ini_set("max_execution_time", 619600);
ini_set("memory_limit","60512M");

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
	$reg = 0;
     while (($data = fgetcsv($handle, 100000, ";")) !== FALSE)
     { 
	 
	    $reg++;
        $a = 0;
/*================================ importar dados de produtos ==============================*/

	 ?>
     <script>
	     //document.write("Processando aguarde !"); 
	    start(<?php echo($reg)?>);

	 </script>
     <?

        $rs1 = mysql_query("SELECT * FROM tb_saidaprodac where cod_prod = ". intval($data[0]) 
		       ." and num_lote   = '" . trim($data[2]) 
			   ."' and num_pedido  = " . intval($data[4])
			   ." and num_nf      = " . intval($data[5]) 
			   ." and data_nf     = '" . $data[6]
			   ."' and codigo_cli  = " . intval($data[7]));
		
		
			
		$a   = mysql_num_rows($rs1);
	    //printf($a);
		/*
		$descr_prod = str_replace("'","`",$data[1]);	
		$descr_prod = str_replace("�","C",$descr_prod);	
        $descr_prod = str_replace("�",".",$descr_prod);
		*/
		
     	$obs_bonif = str_replace("'","`",$data[10]);	
		$obs_bonif = str_replace("�","C",$obs_bonif);	
        $obs_bonif = str_replace("�",".",$obs_bonif);

		
        if ($a > 0) {
			$altera = "update tb_saidaprodac set  val_unit = '" . $data[12] . "' where cod_prod = ". intval($data[0]) 
		       ." and num_lote   = '" . trim($data[2]) 
			   ."' and num_pedido  = " . intval($data[4])
			   ." and num_nf      = " . intval($data[5]) 
			   ." and data_nf     = '" . $data[6]
			   ."' and codigo_cli  = " . intval($data[7]);
			
			
			//echo("update tb_produto set descr_prod = '" . $descr_prod . "'" . 		 
			//" where cod_prod = '" . $data[0] . "'");
			mysql_query($altera) or die(mysql_error());
			
		}else{	
            $rs2   = mysql_query("SELECT max(id_saidaprodac) + 1 as id_saidaprodac FROM tb_saidaprodac ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_saidaprodac'];
			if ($nvid == ""){$nvid = 1; }
			$ddt2 = trim($data[2]);
			$inclui = " insert into tb_saidaprodac (id_saidaprodac,cod_prod,unidade,num_lote,quantid,num_pedido,
			            num_nf,data_nf,codigo_cli,data_fatura,cod_fornec,obs_bonif,sigla_bonifi,val_unit,tot_nota,peso_bruto,id_consult) 
			values ('$nvid','$data[0]','$data[1]','$ddt2','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$obs_bonif','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]')";
			//echo($inclui);
		//mysql_query($inclui) or die(mysql_error());
			
		}
     }

     fclose($handle);

     print "Os dados foram inseridos com sucesso !";

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

