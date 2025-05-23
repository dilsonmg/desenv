<?php
include 'conectabco.php';
 $arq_foto = $_FILES[arquivo][name];
echo("arquivo:" . $arq_foto);

$a = $_GET ["gravar"];
$dt1=explode("/",$data_compr);
$data_compr="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$descr_compr  = str_replace("'","",$descr_compr);
$arq_foto      = $_FILES['arq_instr']['name'];

if ($data_compr == "--"){$data_compr = "0000-00-00";}

		///////////////////////////////Importa o arquivo de imagem para a pasta específica //////////////
		ini_set("max_execution_time", 3600);
		ini_set("memory_limit","512M");
		
		 //Se receber via POST o botão "btnEnviar" dá inicio ao processo de envio  
		 //OBS: ao entrar na página não é executado porque ainda não foi clicado no botão "btnEnviar"  
		 //Recebe o caminho do arquivo selecionado  
    	 // $arquivo = $arquivo;
		 //$arquivo = $_FILES["flfArquivo"]["name"];  
			 $arquivo = $arq_instr;
			 //$arq_instr = $arq_instr;		
			 $nome_doc = $_FILES['arq_instr']['name'];
			 //$nome_doc = $arquivo;
			 echo("arquivo=".$arquivo);
		
			 //Verifica se foi selecionado algum arquivo  
			// if(!empty($arquivo)){  
		
			 //Verifica se a pasta "arquivos existe, se não existir cria a pasta"  
			 
								
		$dirName = "doc_consult/".$subdir;
		echo('subdir='.$subdir);
			 if(!is_dir("./doc_consult/".$subdir)){  
		
				 mkdir("./doc_consult/".$subdir, 0777);  
		
				$uploaddir = '../doc_consult/'.$subdir;
			   $uploadfile = $uploaddir . basename($_FILES['realupload']['name']);
			 }  
		
		///////////////////////////////////////////
		if (isset($_FILES[arq_instr])) {
			if ($_FILES[arq_instr][size] > 1024 * 1024) {
				$tamanho = round(($_FILES[arq_instr][size] / 1024 / 1024), 2);
				$med = "MB";
			} else if ($_FILES[arq_instr][size] > 1024) {
				$tamanho = round(($_FILES[arq_instr][size] / 1024), 2);
				$med = "KB";
			} else {
				$tamanho = $_FILES[arq_instr][size];
				$med = "Bytes";
			}
		 
			/* Defina aqui o tamanho máximo do arquivo em bytes: */
		 
			#if($_FILES[arquivo][size] > 5242880) { //Limite: 5MB
			#	print (" alert('Tamanho: $tamanho $med! Seu arquivo não poderá ser maior que 5MB!');");
			#	exit;
			#}
			
			/* Defina aqui o diretório destino do upload */
		
			if (is_file($_FILES[arq_instr][tmp_name])) {
				$arquivo = $_FILES[arq_instr][tmp_name];
				$caminho="./doc_consult/";
				$caminho=$caminho.$_FILES[arq_instr][name];
				$arq_instr = $_FILES[arq_instr][name];
		        echo($arquivo);      
				/* Defina aqui o tipo de arquivo suportado */
				if (!(eregi(".php$", $_FILES[arq_instr][name]))) {
		//                unlink($caminho.$_FILES[arq_instr][name]);
		echo($caminho.$arquivo);
		                unlink($caminho.$arquivo);
						copy($arquivo,$caminho) or
							die("<p>Erro durante a manipula&ccedil;&atilde;o do arquivo '$arq_instr'</p>".'<p><a href="'.$_SERVER["PHP_SELF"].'">Voltar</a></p>');
					print "<h3><center>Arquivo enviado com sucesso usando " . $_POST['radio'] . "(), " . $tamanho . ' ' . $med . "!</center></h3>";
				} else {
					print "<h3><center>Arquivo n&atilde;o enviado!</center></h3>\n";
					print "<h4><font color='#FF0000'><center>Caminho ou nome de arquivo Inv&aacute;lido!</center></font></h4>";
				}
			}
			echo("De: $arq_instr<br>\nPara: $caminho [<a href='$caminho'>download</a>]");
		}
		if($arq_instr == "") {$arq_instr = $arq_instr1;}


////////////////////////////////////////////
?>
<?php


//echo($custo_eqpto);echo("id_categ=".$id_categ);

$aResult = gravarreg($id,$id_consult,$descr_compr,$data_compr,$arq_foto,$a,$tipo);

header("Location: consult0007.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7){

	 
	  if ($cp6 <> "E") {   
		  
		  $rs1 = mysql_query("SELECT * FROM tb_repcompr where id_repcompr ='". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
	      if ($a == 0){
				 					
									
									 
    		   $sqlins = "insert into tb_repcompr(id_consult,descr_compr,data_compr,arq_foto,tipo)
  			              values('$cp2','$cp3','$cp4','$cp5','$cp7')";
	    	  
			  echo($sqlins);
			
			   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			

			  
		  } else { 
		         $rs1 = mysql_query("SELECT * FROM tb_repcompr where id_repcompr ='". $cp1 ."'" );
		         if ($cp5 ==""){
				 
					 $row1 = mysql_fetch_assoc($rs1);
            		 $cp5         = $row1['arq_foto'];

				 }		
				 						  
		        $sqlins = "update tb_repcompr set id_consult = '" .$cp2 . "',".
						  "descr_compr = '"   . $cp3 . "',".
						  "data_compr = '" . $cp4 . "',tipo = '" . $cp7 . "',".
						  "arq_foto = '" . $cp5 . "' where id_repcompr = '".$cp1."'";
						  
						  
			  echo($sqlins);

	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp6 == "E") {   
	        echo("delete from tb_repcompr where id_repcompr = '". $cp1 ."'");
	        $sqlins = "delete from tb_repcompr where id_repcompr = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17 );
?>
