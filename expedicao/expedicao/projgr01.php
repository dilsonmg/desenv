<?php
include 'conectabco.php';


$a = $_GET ["gravar"];
$dt1=explode("/",$data_abertura);
$data_abertura="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_prevtermino);
$data_prevtermino="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_fechamento);
$data_fechamento="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$descr_projeto  = str_replace("'","",$descr_projeto);
//$tipo_doc     = str_replace("'","",$tipo_doc);

$solicitante    = str_replace("'","",$solicitante);
$obs_projeto    = str_replace("'","",$obs_projeto);

$doc_abertura = $arq_instr;
$doc_fecha    = $arq_instr2;

if ($data_abertura == "--"){$data_abertura = "0000-00-00";}
if ($data_prevtermino == "--"){$data_prevtermino = "0000-00-00";}
if ($data_fechamento == "--"){$data_fechamento = "0000-00-00";}


if ($a != "E") {
		///////////////////////////////Importa o arquivo de imagem para a pasta específica //////////////
		ini_set("max_execution_time", 3600);
		ini_set("memory_limit","128M");
 		$nome_doc = $_FILES['arq_instr']['name'];		
		 $doc_abertura = $_FILES['arq_instr']['name'];
		 $doc_fecha = $_FILES['arq_instr2']['name'];
		 $grava_up = upload_arq($nome_doc);
				
		
		$remvdcfech = $_REQUEST['remove_docfech'];
		
		echo("teste=".$remvdcfech);

		$aResult = gravarreg($id,$descr_projeto,$solicitante,$data_abertura,$doc_abertura,$data_prevtermino,
		$data_fechamento,$doc_fecha,$obs_projeto,$a,$remvdcfech,$lote);

		header("Location: proj0001.php");

}
else{
	     echo("delete from tb_projeto where id_projeto = '". $id ."'");
	        $sqlins = "delete from tb_projeto where id_projeto = '". $id ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";			
		     }
		header("Location: proj0001.php");

}

function upload_arq($arq_up){
	
 //Se receber via POST o botão "btnEnviar" dá inicio ao processo de envio  
		 //OBS: ao entrar na página não é executado porque ainda não foi clicado no botão "btnEnviar"  
		 //Recebe o caminho do arquivo selecionado  
    	 // $arquivo = $arquivo;
		 //$arquivo = $_FILES["flfArquivo"]["name"];  
			 $arquivo = $arq_up;
			 $nome_doc = $arquivo;
			 //$arq_instr = $arq_instr;		
			 //$nome_doc = $_FILES['arq_instr']['name'];
			 //$nome_doc = $arquivo;
			 echo("arquivo=".$arquivo);
		
			 //Verifica se foi selecionado algum arquivo  
			// if(!empty($arquivo)){  
		
			 //Verifica se a pasta "arquivos existe, se não existir cria a pasta"  
			/* 
			  switch ($setor_doc){
					   case "1":
							$subdir = "Fabrica";
							break;
								
						  }
				*/				
		$dirName = "projetos/";
		//echo('subdir='.$subdir);
			 if(!is_dir("./projetos/")){  
		
				 mkdir("./projetos/", 0777);  
		
				$uploaddir = '../projetos/';
			    $uploadfile = $uploaddir . basename($_FILES['arq_instr']['name']);
			 }  
		
		///////////////////////////////////////////
		
			if (is_file($_FILES[arq_instr][tmp_name])) {
				$arquivo = $_FILES[arq_instr][tmp_name];
				$caminho="./projetos/";
				$caminho=$caminho.$_FILES[arq_instr][name];
				$arq_instr = $_FILES[arq_instr][name];
		        echo($arquivo);      
				/* Defina aqui o tipo de arquivo suportado */
				if (!(eregi(".php$", $_FILES[arq_instr][name]))) {
		//             unlink($caminho.$_FILES[arq_instr][name]);
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
		

///////Documento de fechamento ///////////////

			if (is_file($_FILES[arq_instr2][tmp_name])) {
				$arquivo = $_FILES[arq_instr2][tmp_name];
				$caminho="./projetos/";
				$caminho=$caminho.$_FILES[arq_instr2][name];
				$arq_instr = $_FILES[arq_instr2][name];
		        echo($arquivo);      
				/* Defina aqui o tipo de arquivo suportado */
				if (!(eregi(".php$", $_FILES[arq_instr2][name]))) {
		//             unlink($caminho.$_FILES[arq_instr][name]);
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
		

////////////////////////////////////////////



		if($arq_instr == "") {$arq_instr = $arq_instr1;}

		/////////////////////////////////////////
}

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12){

echo($cp10);


	 $cp2 = str_replace("'", "", $cp2);
	 
	  if ($cp10 <> "E") {   
           echo("SELECT * FROM tb_projeto where id_projeto = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_projeto where id_projeto = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
	      if ($a == 0){
			  
			  	 $rs1000       = mysql_query("SELECT max(id_projeto) + 1 as id_projeto FROM tb_projeto");
	             $row1000      = mysql_fetch_assoc($rs1000);
	             $cp1          = $row1000['id_projeto'];
				 
              if ($cp1  == ""){$cp1 = 1;}
			    
              echo("insert into tb_projeto(id_projeto,descr_projeto,solicitante,data_abertura,doc_abertura,data_prevtermino,data_fechamento,
					        doc_fecha,obs_projeto,lote)
  			              values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp11','$cp12')");
						  						  						  
    		  $sqlins = "insert into tb_projeto(id_projeto,descr_projeto,solicitante,data_abertura,doc_abertura,data_prevtermino,
					            data_fechamento,doc_fecha,obs_projeto,lote)
  			                    values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp12')";
	    	  $ins=mysql_query( $sqlins );
   	    	  if( $ins===FALSE ){
				  $msg= "Erro na query... " . mysql_error( ) . "<br/>";}				  
      		  } else { 
		               //$rs1 = mysql_query("SELECT * FROM tb_documentos where id_eqpto ='". $cp1 ."'" );
		        		
				 
				$atnome_doc = '';
				if ($cp5 != "") { $atnome_doc = "doc_abertura = '" . $cp5 . "',"; }		  
				$atnome_doc2 = '';
				if ($cp8 != "") { $atnome_doc2 = "doc_fecha = '" . $cp8 . "',"; }		  
				
				if ($cp11 == 1){$atnome_doc2 = "doc_fecha = '',"; }
						  
		        $sqlins = "update tb_projeto set descr_projeto = '" .$cp2 . "',".
						  "solicitante = '"   . $cp3 . "',".
						  "data_abertura = '" . $cp4 . "',".
						  $atnome_doc .
						  "data_prevtermino = '" . $cp6 . "',".
						  "data_fechamento = '" . $cp7 . "',".
						  $atnome_doc2 .
						  "obs_projeto = '" . $cp9 . 	
						  "',lote = '" . $cp12  . 							  				  
						   "'  where id_projeto = '".$cp1."'";

echo($sqlins);


	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp10 == "E") {   
	        echo("delete from tb_projeto where id_projeto = '". $cp1 ."'");
	        $sqlins = "delete from tb_projeto where id_projeto = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17 );
?>
