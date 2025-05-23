<?php
include 'conectabco.php';


$a = $_GET ["gravar"];
$dt1=explode("/",$data_emis);
$data_emis="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_venc);
$data_venc="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_elab);
$data_elab="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_verif);
$data_verif="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_autor);
$data_autor="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
$dt1=explode("/",$data_rev);
$data_rev="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

$descr_docto  = str_replace("'","",$descr_docto);
//$tipo_doc     = str_replace("'","",$tipo_doc);

echo("tipo_doc=".$tipo_doc);

$setor_doc    = str_replace("'","",$setor_doc);
$verif_por    = str_replace("'","",$verif_por);
$auto_por     = str_replace("'","",$auto_por);
$revis_por    = str_replace("'","",$revis_por);
$versao_doc   = str_replace("'","",$versao_doc);
$nome_doc     = str_replace("'","",$nome_doc);
$num_paginas  = str_replace("'","",$num_paginas);
$obs_doc      = str_replace("'","",$obs_doc);

$arq_origem = $arq_instr;



if ($data_emis == "--"){$data_emis = "0000-00-00";}
if ($data_venc == "--"){$data_venc = "0000-00-00";}
if ($data_elab == "--"){$data_elab = "0000-00-00";}
if ($data_verif == "--"){$data_veri = "0000-00-00";}
if ($data_autor == "--"){$data_autor = "0000-00-00";}
if ($data_rev == "--"){$data_rev = "0000-00-00";}
if ($data_verif == "--"){$data_verif = "0000-00-00";}


	
$aResult = gravarreg($id,$descr_docto,$tipo_doc,$data_emis,$data_venc,$setor_doc,$elab_por,$verif_por,$auto_por,$revis_por,
$data_elab,$data_verif,$data_autor,$data_rev,$versao_doc,$nome_doc,$num_paginas,$a,$id_consult,$obs_doc);

header("Location: doctoau01.php");


function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17,$cp18,$cp19,$cp20){

	 $cp2 = str_replace("'", "", $cp2);
	 
	  if ($cp18 <> "E") {   
echo("SELECT * FROM tb_documentos where id_documento = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_documentos where id_documento ='". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
	      if ($a == 0){
			  
			  	 $rs1000       = mysql_query("SELECT max(id_documento) + 1 as id_documento FROM tb_documentos");
	             $row1000      = mysql_fetch_assoc($rs1000);
	             $cp1          = $row1000['id_documento'];
				 
                 if ($cp1  == ""){
		             $cp1 = 1;}  
                      echo("insert into tb_documentos(id_documento,descr_docto,tipo_doc,data_emis,data_venc,setor_doc,elab_por,
					        verif_por,auto_por,revis_por,data_elab,data_verif,data_autor,data_rev,versao_doc,nome_doc,num_paginas,obs_doc)
  			              values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12',
			              '$cp13','$cp14','$cp15','$cp16','$cp17','$cp19','$cp20')");
						  						  						  
    		   $sqlins = "insert into tb_documentos(id_documento,descr_docto,tipo_doc,data_emis,data_venc,setor_doc,elab_por,
					        verif_por,auto_por,revis_por,data_elab,data_verif,data_autor,data_rev,versao_doc,nome_doc,num_paginas,id_consult,obs_doc)
  			              values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11','$cp12',
			              '$cp13','$cp14','$cp15','$cp16','$cp17','$cp19','$cp20')";
	    	  /*
			   $ins=mysql_query( $sqlins );
   	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
              */
			  
		  } else { 
		  //$rs1 = mysql_query("SELECT * FROM tb_documentos where id_eqpto ='". $cp1 ."'" );
		         if ($cp16 ==""){
				 
					 $row1 = mysql_fetch_assoc($rs1);
            		 $cp16         = $row1['arq_foto'];

				 }			
				 echo("update tb_documentos set auto_por = '" . $cp9 .
						  "', data_autor = '" . $cp13 . "'".				  
						   "  where id_documento = '".$cp1."'"); 
				$atnome_doc = '';
				
				if ($cp16 != "") { $atnome_doc = "nome_doc = '" . $cp16 . "',"; }		  
						  
		        $sqlins = "update tb_documentos set auto_por = '" . $cp9 .
						  "', data_autor = '" . $cp13 . "'".				  
						   "  where id_documento = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

		  }
	  }
	  if ($cp18 == "E") {   
	echo("delete from tb_documentos where id_documento = '". $cp1 ."'");
	        $sqlins = "delete from tb_documentos where id_documento = '". $cp1 ."'";
	       // $ins=mysql_query( $sqlins );
	    	 if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
		     }
	}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16,$cp17 );
?>
