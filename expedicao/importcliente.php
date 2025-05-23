<meta name="robots" content="noindex" />
<meta name="googlebot" content="noindex" />
<meta name="googlebot-news" content="noindex" />
<meta name="googlebot" content="noindex">
<meta name="googlebot-news" content="nosnippet">

<?php
session_start();
ini_set("max_execution_time", 7200);
ini_set("memory_limit","512M");


/* transf relvisita tales 97 -> Jefferson 103
SELECT * FROM tb_relvisita
    where codigo_cli in (SELECT codigo_cli FROM tb_cliente where cod_regiao in ('GO002','GO003','GO004'))
 and id_consult = 97;
*/

$lgd = 0;
$opcm = 0;
if(isset($_SESSION['en'])){// verifica se existe a varavel session
  
   if($_SESSION['en'] == 1){
              	header("Location: login.php"); }
       

   }else{

         echo("Você não esta logado !!");
              	header("Location: loginx.php"); 

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Importação de Dados - Relação de Clientes</title>
<link rel="stylesheet" href="../css/qreal.css">

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
<p><img src="../imagens/banner2.jpg" width="775" height="95">

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <br />
<p> Importa&ccedil;&atilde;o de dados - Rela&ccedil;&atilde;o de Clientes </p>

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

	$filename = $_FILES["flfArquivo"]["name"];
	$handle = fopen("arquivostst/".$arquivo,"r");
	 $reg = 0;
     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
     { 
        $a = 0;
/*================================ importar dados de produtos ==============================*/
	  // echo($data[0]);
	  
		    $cod_cli  = $data[0];
		//echo("SELECT * FROM tb_cliente where codigo_cli = '". $data[0] ."'");
		
        $rs1 = mysql_query("SELECT * FROM tb_cliente where codigo_cli = '". $data[0] ."'");
        $a   = mysql_num_rows($rs1);
	    //printf($a); ï»¿ ï»
		$codigo_cli = str_replace("ï","",$data[0]);	
		$codigo_cli = str_replace("»","",$codigo_cli);	
		$codigo_cli = str_replace("¿","",$codigo_cli);	
		
		$rz_social = str_replace("'","`",rtrim($data[1]));	
		$rz_social = str_replace("€","C",$rz_social);	
		$nm_fantasi = str_replace("'","`",$data[10]);	
		$nm_fantasi = str_replace("€","C",$nm_fantasi);
		
		
		$cep_cli = $data[7];
		$cidade = str_replace("'","`",rtrim($data[8]));	
		$cidade = str_replace("€","C",rtrim($cidade));	

			
		$uf         = str_replace("'","`",trim($data[9]));	
		$cnpj       = str_replace("'","",$data[4]);	
		
        
	 $reg ++; 
	 ?>
     <script>
	     //document.write("Processando aguarde !"); 
	    start(<?php echo($reg)?>);

	 </script>
     <?
		if ($uf != ""){                                        
			if ($a > 0) {
			if ($cod_cli < 100000){
				$altera = "update tb_cliente set nome_cli = '" . $rz_social . "'" . 
				",grupo_cli = '".$data[2] .
				"',cod_regiao ='".$data[3] .	"', nm_fantasi = '" . $nm_fantasi . 
				"',cidade ='".$cidade .	"', uf = '" . rtrim($data[9]) ."',tel_contato = '" . rtrim($data[11]) . "', cnpj = '" .$data[4] .   
				"', cep_cli = '".$cep_cli . 		 
				"' where codigo_cli = '" . rtrim($data[0]) . "'";
		}else {
				$altera = "update tb_cliente set cod_phibro = '" . $codigo_cli . "' where cnpj = '" . $data[4] . "'";				
		}
			
			//echo($altera);
			
				mysql_query($altera) or die(mysql_error());
				
			}else{	
		    			$rs2   = mysql_query("SELECT max(id_cliente) + 1 as id_cliente FROM tb_cliente ");
						$row1  = mysql_fetch_assoc($rs2);
						$nvid  = $row1['id_cliente'];
				
				
				if ($nvid == ""){$nvid = 1; }
		//echo("  insert into tb_cliente (id_cliente, codigo_cli, nome_cli,grupo_cli,cod_regiao) 
			//	values ('$nvid','$data[0]','$rz_social','$data[2]','$data[3]')");
						
			$inclui = " insert into tb_cliente (id_cliente, codigo_cli, nome_cli,grupo_cli,cod_regiao,cidade,uf,tel_contato,cnpj,cod_phibro,cep_cli) 
			values ('$nvid','$codigo_cli','$rz_social','$data[2]','$data[3]','$cidade',
			'$data[9]','$data[11]','$data[4]','$codigo_cli','$data[7]')";
			
			
			
			
				mysql_query($inclui) or die(mysql_error());
				
			 }
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

             //Se não foi possivel copiar o arquivo avisa com um "alert" que houve um erro e volta para a página desejada(index.php neste caso)  

             echo "<script>  

                     alert('Não foi possivel enviar o arquivo, tente novamente.');  

                  //   location.href = 'menu_visita.php';  

                 </script>";  

         }  

         //Se não foi selecionado nenhum arquivo pede-se ao usuário que selecione antes de enviar  

         }else{  

             echo "<script>alert('Escolha um arquivo');</script>";  

         }  
		 
		 

     }  

 ?>  

  </html>
   

