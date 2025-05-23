<?php
include 'conectabco.php';


$a = $_GET ["gravar"];
$dt1=explode("/",$data_doc);
$data_doc="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$descr_doc  = str_replace("'","",$descr_doc);
//$tipo_doc     = str_replace("'","",$tipo_doc);

$resp_doc    = str_replace("'","",$resp_doc);
$nome_doc = $arq_instr;
if ($data_doc == "--"){$data_doc = "0000-00-00";}

if ($a != "E") {
		///////////////////////////////Importa o arquivo de imagem para a pasta específica //////////////
		ini_set("max_execution_time", 3600);
		ini_set("memory_limit","128M");
 $nome_doc = $_FILES['arq_instr']['name'];		
 $doc_abertura = $_FILES['arq_instr']['name'];
 $doc_fecha = $_FILES['arq_instr2']['name'];
 $grava_up = upload_arq($nome_doc,$id_projeto);
		

$remvdcfech = $_REQUEST['remove_docfech'];
}
echo("teste=".$remvdcfech);

$aResult = gravarreg($id,$id_projeto,$descr_doc,$data_doc,$nome_doc,$resp_doc,$a,$remvdcfech);

header("Location: proj0008.php");


function upload_arq($arq_up,$idproj){
	
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
						  		$dirName = "publicacoes/".$subdir;

				*/		
		$subdir = $idproj;					
		$dirName = "projetos/".$subdir;
		echo('subdir='.$subdir);
    	if(!is_dir("./projetos/".$subdir)){  
		   	 mkdir("./projetos/".$subdir, 0777);  
			 $uploaddir = '../projetos/';
			 $uploadfile = $uploaddir . basename($_FILES['arq_instr']['name']);
		}  
		
		///////////////////////////////////////////
		
			if (is_file($_FILES[arq_instr][tmp_name])) {
				$arquivo = $_FILES[arq_instr][tmp_name];
				$caminho="./projetos/$subdir/";
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
		




		if($arq_instr == "") {$arq_instr = $arq_instr1;}

		/////////////////////////////////////////
}

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8){

	 $cp3 = str_replace("'", "", $cp3);
	 
	  if ($cp7 <> "E") {   
           echo("SELECT * FROM tb_docsprojeto where id_docsprojeto = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_docsprojeto where id_docsprojeto = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
	      if ($a == 0){
			  
			  	 $rs1000       = mysql_query("SELECT max(id_docsprojeto) + 1 as id_docsprojeto FROM tb_docsprojeto");
	             $row1000      = mysql_fetch_assoc($rs1000);
	             $cp1          = $row1000['id_docsprojeto'];
				 
              if ($cp1  == ""){$cp1 = 1;}
			    
              echo("insert into tb_docsprojeto(id_docsprojeto,id_projeto,descr_doc,data_doc,nome_doc,resp_doc)
  			              values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6')");
						  						  						  
    		  $sqlins = "insert into tb_docsprojeto(id_docsprojeto,id_projeto,descr_doc,data_doc,nome_doc,resp_doc)
  			              values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6')";
	    	  $ins=mysql_query( $sqlins );
   	    	  if( $ins===FALSE ){
				  $msg= "Erro na query... " . mysql_error( ) . "<br/>";}				  
      		  } else { 
		               //$rs1 = mysql_query("SELECT * FROM tb_documentos where id_eqpto ='". $cp1 ."'" );
		        		
				 
				$atnome_doc = '';
				if ($cp8 == "") { $atnome_doc = "nome_doc = '" . $cp5 . "',"; }		  
				if ($cp8 == "1") { $atnome_doc = "nome_doc = '',"; }		  
				
						  
		        $sqlins = "update tb_docsprojeto set descr_doc = '" .$cp3 . "',".
						  "data_doc = '"   . $cp4 . "',".
						  $atnome_doc .
						  "resp_doc = '" . $cp6 . 
						   "'  where id_docsprojeto = '".$cp1."'";

echo("cp8=".$cp8);
echo($sqlins);


	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp7 == "E") {   
	        echo("delete from tb_docsprojeto where id_docsprojeto = '". $cp1 ."'");
	        $sqlins = "delete from tb_docsprojeto where id_docsprojeto = '". $cp1 ."'";
	        $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17 );
?>
