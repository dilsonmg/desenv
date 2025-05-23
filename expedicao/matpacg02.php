<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
echo($a);

$dt1=explode("/",$data_prevlib);
$data_prevlib="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

echo($data_prevlib);

$dt1=explode("/",$data_liblote);


if($cod_prod2 <> "") {
	$cod_prod = $cod_prod2;}
	
	
echo($cod_prod);	

if ($quant_fabr == ''){
	$quant_fabr = 0.00;
}

echo($cod_prod);

$msg_lote = str_replace("'","",$msg_lote);
$localizacao = str_replace("'","",$localizacao);




ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");
if($a=="r"){
	echo("entrou");
				$resultado1     = str_replace("'","",$resultado1);
				$resultado2     = str_replace("'","",$resultado2);
				$resultado3     = str_replace("'","",$resultado3);
				$resultado4     = str_replace("'","",$resultado4);
				$resultado5     = str_replace("'","",$resultado5);
				$resultado6     = str_replace("'","",$resultado6);
				$resultado7     = str_replace("'","",$resultado7);
				$resultado8     = str_replace("'","",$resultado8);

				$dt1=explode("/",$data_liblote);
				$data_liblote="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";
    		    echo($data_liblote);
				if($dt1[2] <> ""){
				   $sqlins = "update tb_entprodac set  data_liblote = '" . $data_liblote . "',".
				          "resultado1 = '"   . $resultado1 . "',".
						  "resultado2  = '" . $resultado2 . "'," . 
						  "resultado3  = '" . $resultado3 . "'," . 
						  "resultado4  = '" . $resultado4 . "'," . 
						  "resultado5 = '" . $resultado5 ."'," .
						  "resultado6 = '" . $resultado6 ."'," .
						  "resultado7 = '" . $resultado7 ."'," .
						  "resultado8 = '" . $resultado8 .
						  "'  where id_entprodac = '".$id."'";
				   }
				else{
					$sqlins = "update tb_entprodac set  data_liblote = NULL ,".
				          "resultado1 = '"   . $resultado1 . "',".
						  "resultado2  = '" . $resultado2 . "'," . 
						  "resultado3  = '" . $resultado3 . "'," . 
						  "resultado4  = '" . $resultado4 . "'," . 
						  "resultado5 = '" . $resultado5 ."'," .
  						  "resultado6 = '" . $resultado6 ."'," .
						  "resultado7 = '" . $resultado7 ."'," .
						  "resultado8 = '" . $resultado8 .
						  "'  where id_entprodac = '".$id."'";					
					 }
				echo($sqlins);
	    	   $ins=mysql_query( $sqlins );
					   
}else{
    $aResult = gravarreg($id,$cod_prod,$embalagem,$num_lote,$data_fabr,$data_venc,$quant_fabr,$data_prevlib,$a,$msg_lote,$tp_entrada,$localizacao);
}
/*matpac001.ph*/

if (isset($prg)){
	header("Location: matpac201.php");
}else{
	header("Location: matpac001.php");
}

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12){
	
	
	
	echo($cp12);

$dt11=explode("/",$cp5);
$data_fabr1="{$dt11[2]}-{$dt11[1]}-{$dt11[0]}";

$dt11=explode("/",$cp6);
$data_venc1="{$dt11[2]}-{$dt11[1]}-{$dt11[0]}";

$dt11=explode("/",$cp6);
$anomd1 = $dt11[2] + 1;
$data_vencret1="{$anomd1}-{$dt11[1]}-{$dt11[0]}";
	 
	  if ($cp9 <> "E") {   
           echo("SELECT * FROM tb_entprodac where id_entprodac = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_entprodac where id_entprodac  = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_entprodac) + 1 as id_entprodac FROM tb_entprodac");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_entprodac'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_entprodac(id_entprodac,cod_prod,embalagem,num_lote,data_fabr,data_venc,quant_fabr,data_prevlib,msg_lote,tp_entrada)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp10','$cp11')";
					   $ins=mysql_query( $sqlins );
					   
				$quantid_contr = 0.200;
				$unid_contr    = "Kg";
				
				if ($cp2 > 1549 && $cp2 < 1599){
					$quantid_contr = 0.300;
				    $unid_contr    = "L";
				}
						 
		        echo("insert into tb_contraprov(cod_prod,num_lote,data_fabr,data_venc,venci_retencao,situacao,quantidade,unidade,localizacao)values(
                           '$cp2','$cp4',
							'$data_fabr1',
							'$data_venc1',
							'$data_vencret1','A','$quantid_contr','$unid_contr','$cp12')");
				
				$sqlins1 = "insert into tb_contraprov(cod_prod,num_lote,data_fabr,data_venc,venci_retencao,situacao,quantidade,unidade,localizacao)values(
                           '$cp2','$cp4',
							'$data_fabr1',
							'$data_venc1',
							'$data_vencret1','A','$quantid_contr','$unid_contr','$cp12')";
	 
				$ins2=mysql_query( $sqlins1 );

			       if( $ins2===FALSE ){
				      $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			 } else { 

             echo("update tb_entprodac set embalagem = '"   . $cp3 . "',".
						  "data_fabr  = '" . $cp5 . "'," . 
						  "data_venc  = '" . $cp6 . "'," . 
						  "data_prevlib  = '" . $cp8 . "'," . 
						  "msg_lote  = '" . $cp10 . "'," . 
						  "quant_fabr = '" . $cp7 ."'  where id_entprodac = '".$cp1."'");

		        $sqlins = "update tb_entprodac set embalagem = '"   . $cp3 . "',".
						  "data_fabr  = '" . $cp5 . "'," . 
						  "data_venc  = '" . $cp6 . "'," . 
						  "data_prevlib  = '" . $cp8 . "'," . 
						  "msg_lote  = '" . $cp10 . "'," .
						  "quant_fabr = '" . $cp7 ."' where id_entprodac = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins  );
			   
			   echo("update tb_contraprov set 
				            data_fabr = '" . $data_fabr1."',".
							"data_venc = '" .$data_venc1 . "',".
						  "localizacao  = '" . $cp12 . "'," . 							
							"venci_retencao = '" . $data_vencret1 ."', situacao = 'A' where cod_prod = '" .$cp2 . "' and num_lote = '" . $cp4 . "'");
			   
			   	$sqlins1 = "update tb_contraprov set 
				            data_fabr = '" . $data_fabr1."',".
							"data_venc = '" .$data_venc1 . "',".
						  "localizacao  = '" . $cp12 . "'," . 							
							"venci_retencao = '" . $data_vencret1 ."', situacao = 'A' where cod_prod = '" .$cp2 . "' and num_lote = '" . $cp4 . "'";
	 
				$ins2=mysql_query( $sqlins1 );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp9 == "E") {   
	  
         $rs1 = mysql_query("SELECT a.* FROM tb_entprodac a where a.id_entprodac =". $cp1);
    	 $row1 = mysql_fetch_assoc($rs1);

	     $data_prevlib    = strftime("%d/%m/%Y", strtotime($row1['data_prevlib']));
	     $data_liblote    = strftime("%d/%m/%Y", strtotime($row1['data_liblote']));
		 
		 $id_entprodac     = $id;
		 $cod_prod         = $row1['cod_prod'];
		 $embalagem        = $row1['embalagem'];
		 $num_lote         = $row1['num_lote'];
		 $data_fabr        = $row1['data_fabr'];
		 $data_venc        = $row1['data_venc'];
		 $data_liblote     = $row1['data_liblote'];
		 $quant_fabr       = $row1['quant_fabr'];
		 $tp_entrada       = $row1['tp_entrada'];
		 $msg_lote         = $row1['msg_lote'];

	  	 echo("delete from  tb_contraprov  where cod_prod = '" .$cod_prod . "' and num_lote = '" . $num_lote . "'");
		 $sqlins1 = "delete from  tb_contraprov  where cod_prod = '" .$cod_prod . "' and num_lote = '" . $num_lote . "'";
	 	 $ins2=mysql_query( $sqlins1 );

	       
		  echo("delete from tb_entprodac where id_entprodac = '". $cp1 ."'");
	      $sqlins = "delete from tb_entprodac where id_entprodac = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
		  
		  
	
		  
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
?>
