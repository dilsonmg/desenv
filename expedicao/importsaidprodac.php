<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importação de Dados - Saida de Produtos Acabados</title>
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
	$reg = 0;
	
/////////////////zera tabela a receber ///////////////////////////////////////

	$zera_tab = "truncate tb_dpreceb ";
	mysql_query($zera_tab);

//////////////////////////////inicio leitura ////////////////////////////////////
     while (($data = fgetcsv($handle, 100000, ";")) !== FALSE)
     { 
	    $reg++;
        $a = 0;
		
		flush();
    // sleep(3);

	 ?>
     
     <script>
	     //document.write("Processando aguarde !"); 
	    start(<?php echo($reg)?>);

	 </script>
     <?
	  if($data[0] == 1) {	
		/*================================ importar dados de saida de produtos ==============================*/

			
        $rs1 = mysql_query("SELECT * FROM tb_saidaprodac where cod_prod = ". intval($data[1]) 
		       ." and num_lote   = '" . trim($data[3]) 
			   ."' and num_pedido  = " . intval($data[5])
			   ." and num_nf      = " . intval($data[6]) 
			   ." and data_nf     = '" . $data[7]
			   ."' and codigo_cli  = " . intval($data[8]));
			
			$a   = mysql_num_rows($rs1);
			$obs_bonif = str_replace("'","`",$data[11]);	
			$obs_bonif = str_replace("€","C",$obs_bonif);	
			$obs_bonif = str_replace("§",".",$obs_bonif);
		
        if ($a > 0) {
			$altera = "update tb_saidaprodac set unidade = '" . $data[2] . "'," .
			" quantid = '" . $data[4] . "'," .
			" data_fatura = '" . $data[9] . "'," .
			" obs_bonif = '" . $obs_bonif . "'," .
			" sigla_bonifi = '" . $data[12] . "'," .
			" val_unit = '" . $data[13] . "'," .
			" tot_nota = '" . $data[14] . "'," .
			" peso_bruto = '" . $data[15] . "'," .
			" cod_fornec  = '" . $data[10] . "'," .
			" id_consult  = '" .$data[16] . "',".
			" cfop        = '" .$data[17] . "'".
			" where cod_prod = ". intval($data[1]) 
		       ." and num_lote   = '" . trim($data[3]) 
			   ."' and num_pedido  = " . intval($data[5])
			   ." and num_nf      = " . intval($data[6]) 
			   ." and data_nf     = '" . $data[7]
			   ."' and codigo_cli  = " . intval($data[8]);
			
			mysql_query($altera) or die(mysql_error());
			
		}else{	
            $rs2   = mysql_query("SELECT max(id_saidaprodac) + 1 as id_saidaprodac FROM tb_saidaprodac ");
        	$row1  = mysql_fetch_assoc($rs2);
	        $nvid  = $row1['id_saidaprodac'];
			if ($nvid == ""){$nvid = 1; }
			$ddt2 = trim($data[3]);
			$inclui = " insert into tb_saidaprodac (id_saidaprodac,cod_prod,unidade,num_lote,quantid,num_pedido,
			            num_nf,data_nf,codigo_cli,data_fatura,cod_fornec,obs_bonif,sigla_bonifi,val_unit,tot_nota,peso_bruto,id_consult,cfop) 
						values ('$nvid','$data[1]','$data[2]','$ddt2','$data[4]','$data[5]','$data[6]','$data[7]',
						'$data[8]','$data[9]','$data[10]','$obs_bonif','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]')";
			//echo($inclui);
			mysql_query($inclui) or die(mysql_error());
			
		}
		//==============================Fim importacao saida de produtos =========================================================//
	  }
	  //========================titulos a receber =================================================================//
	  if($data[0] == 2) {
			  $inclui = " insert into tb_dpreceb (duplicata,codigo_cli,id_consult,data_venc,val_docto,obs_docto) 
						values ('$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			//echo($inclui);
			  mysql_query($inclui) or die(mysql_error());			
	  }
	  
    }
////////////final importação de titulos a receber//////////////////////////////////////////////////////////////////////////
     fclose($handle);

     print "Os dados foram inseridos com sucesso !";

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

