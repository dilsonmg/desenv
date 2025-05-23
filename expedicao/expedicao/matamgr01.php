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

if ($quantid == ''){
	$quantid = 0.00;
}


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($id_grpamostra);
$aResult = gravarreg($id,$descr_grpam,$qtd_kits,$a);

		unset( $cp1,$cp2,$cp3);
header("Location: matam0001.php");



function gravarreg($cp1,$cp2,$cp3,$cp4){
	 
if ($cp4 <> "E") {   
    
	

	
	       echo("SELECT * FROM tb_grpamostra where id_grpamostra = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_grpamostra where id_grpamostra = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_grpamostra) + 1 as id_grpamostra FROM tb_grpamostra");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_grpamostra'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_grpamostra(id_grpamostra,descr_grpam,qtd_kits)
							values('$cp1','$cp2','$cp3')";
							
				   echo("insert into tb_grpamostra(id_grpamostra,descr_grpam,qtd_kits)
							values('$cp1','$cp2','$cp3')");			
							
	    		  $ins=mysql_query( $sqlins );	
													
				
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}
				   
				   
				  /* atualiza quantidade de itens disponiveis	*/
				   $rs200 = mysql_query("SELECT a.* FROM tb_compgrp a
         					where a.id_compgrp > 0 and a.id_grpamostra = '" . $cp1 ."'");
				
				   while($row=mysql_fetch_array($rs200)){ 
                        $cod_prod = $row['cod_prod'];
						$quant_it = $row['quant_it'] * $cp3;
		
		                echo("update tb_itemprocessado set quant_disp = quant_disp - "   . $quant_it .
						     " where cod_prod = '".$cod_prod."'");
		
                        $sqlins1a = "update tb_itemprocessado set quant_disp = quant_disp - "   . $quant_it .
						          " where cod_prod = '".$cod_prod."'";

	    	            $ins=mysql_query( $sqlins1a );     

				   }
	
                  //////////////////////////////////////////////////////////	 
			
			} else { 

       /* atualiza quantidade de itens disponiveis	*/
				   $rs200 = mysql_query("SELECT a.* FROM tb_compgrp a
         					where a.id_compgrp > 0 and a.id_grpamostra = '" . $cp1 ."'");
				
				   while($row=mysql_fetch_array($rs200)){ 
                        $cod_prod = $row['cod_prod'];
						$quant_it = $row['quant_it'] * $cp3;
		
		                echo("update tb_itemprocessado set quant_disp = quant_disp - "   . $quant_it .
						     " where cod_prod = '".$cod_prod."'");
		
                        $sqlins1a = "update tb_itemprocessado set quant_disp = quant_disp - "   . $quant_it .
						          " where cod_prod = '".$cod_prod."'";

	    	            $ins=mysql_query( $sqlins1a );     

				   }
	
//////////////////////////////////////////////////////////	
	   
	   
	           echo("update tb_grpamostra set descr_grpam = '"   . $cp2 . "', qtd_kits  = '" .$cp3 ."' where id_grpamostra = '".$cp1."'");

		        $sqlins = "update tb_grpamostra set descr_grpam = '"   . $cp2 . "', qtd_kits  = '" .$cp3 ."' where id_grpamostra = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp4 == "E") {   
	       
		  echo("delete from tb_grpamostra where id_grpamostra = '". $cp1 ."'");
	      $sqlins = "delete from tb_grpamostra where id_grpamostra = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
