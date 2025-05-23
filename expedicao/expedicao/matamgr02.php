<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
//$dt1=explode("/",$data_saida);
//$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quant_disp == ''){
	$quant_disp = 0.00;
}

$quant_disp    = str_replace(",",".",$quant_disp);


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($id_grpamostra);
$aResult = gravarreg($id,$cod_prod,$quant_disp,$a);

unset( $cp1,$cp2,$cp3,$cp4);
header("Location: matam0002.php");

function gravarreg($cp1,$cp2,$cp3,$cp4){
	 
	  if ($cp4 <> "E") {   
           echo("SELECT * FROM tb_itemprocessado where id_itproc = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_itemprocessado where id_itproc = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				echo("SELECT max(id_itproc) + 1 as id_proc FROM tb_itemprocessado");
				   $rs1000       = mysql_query("SELECT max(id_itproc) + 1 as id_itproc FROM tb_itemprocessado");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_itproc'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_itemprocessado(id_itproc,cod_prod,quant_disp)
							values('$cp1','$cp2','$cp3')";
							
				   echo("insert into tb_itemprocessado(id_itproc,cod_prod,quant_disp)
							values('$cp1','$cp2','$cp3')");			
														
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

               echo("update tb_itemprocessado set quant_disp = '"   . $cp3 . "' where id_itproc = '".$cp1."'");

		        $sqlins = "update tb_itemprocessado set quant_disp = '"   . $cp3 . "' where id_itproc = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp4 == "E") {   
	       
		  echo("delete from tb_itemprocessado where id_itproc = '". $cp1 ."'");
	      $sqlins = "delete from tb_itemprocessado where id_itproc = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
