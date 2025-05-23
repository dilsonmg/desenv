<?php
include 'conectabco.php';
session_start(); // sempre chamamos a sessão dessa forma

$_SESSION['id_saidaam']=0;

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo("*** id2 ***".$id2);

//echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_ent);
$data_ent="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quant_it == ''){
	$quant_it = 0.00;
}

//$cd_prod  = explode(";",$cd_itens,-1);
//$nr_lotes = explode(";",$cd_lotes,-1);
//$qtdbx    = explode(";",$qtd_itens,-1);

//if (is_array($nr_lotes)) { echo("eh um array");}

$y = count($cd_prod);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

$aResult = gravarreg($id,$cod_prod,$quant_it,$data_ent,$obs_ent,$a,$num_lote);

//unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6);
header("Location: matam0008.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7){
	
	 echo("cod_prod=".$cp2);
		 
	  if ($cp6 <> "E") {   

           echo("SELECT * FROM tb_entitproc where id_entitproc = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_entitproc where id_entitproc = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);

//// saldo do item processado ///////////////////


			  echo("SELECT * FROM tb_itemprocessado where cod_prod = '". $cp2 ."'" );
				  
	    	   $rs10 = mysql_query("SELECT * FROM tb_itemprocessado where cod_prod = '". $cp2 ."'" );
			   
			   
			   if(mysql_num_rows($rs10) == FALSE){
				   
				   echo("SELECT max(id_itproc) + 1 as id_itproc FROM tb_itemprocessado");
   				   $rs10001       = mysql_query("SELECT max(id_itproc) + 1 as id_itproc FROM tb_itemprocessado");
				   $row10001      = mysql_fetch_assoc($rs10001);
				   $cp11a          = $row10001['id_itproc'];
				   				   
			       if ($cp11a  == ""){
					   $cp11a = 1;}

                   $sqlins1 = "insert into tb_itemprocessado(id_itproc,cod_prod,quant_disp)
							values('$cp11a','$cp2','$cp3')";
							
				   echo("insert into tb_itemprocessado(id_itproc,cod_prod,quant_disp)
							values('$cp11a','$cp2','$cp3')");			
				  	
				  $ins1=mysql_query( $sqlins1 );
				
                }else{
				      $row32=mysql_fetch_assoc($rs1);
                      $quant_anterior = $row32['quant_it'];

                      if($quant_anterior == ""){$quant_anterior = 0;}
                      echo("<br> quanti_anterior=".$quant_anterior."<br>");

                      echo("SELECT * FROM tb_itemprocessado where cod_prod = '". $cp2 ."'" );

	    	          $rs10 = mysql_query("SELECT * FROM tb_itemprocessado where cod_prod = '". $cp2 ."'" );
                      $row320=mysql_fetch_assoc($rs10);
                      $saldo_anterior = $row320['quant_disp'];
			   
	                  echo("<br> saldo_anterior=".$saldo_anterior."<br>");
			   
                      if($saldo_anterior == ""){$saldo_anterior = 0;}

                       $saldo_anterior = $saldo_anterior - $quant_anterior + $cp3;
			   
                       echo("<br> saldo_anterior2=".$saldo_anterior."<br>");
                  
//			           echo("update tb_itemprocessado set quant_disp = '"   . $saldo_anterior . "' where cod_prod = '".$cp2."'");
			   
//			           $sqlins = "update tb_itemprocessado set quant_disp = '"   . $saldo_anterior . "' where cod_prod = '".$cp2."'";

			           $sqlins = "update tb_itemprocessado set quant_disp = '"   . $cp3 . "' where cod_prod = '".$cp2."'";

	    	           $ins=mysql_query( $sqlins );			  
		
                } 
////////////////////////////////////////////////////////////////////////////
		  
		  
		  
		if ($a == 0){
				echo("SELECT max(id_entitproc) + 1 as id_entitproc FROM tb_entitproc ");
				   $rs1000       = mysql_query("SELECT max(id_entitproc) + 1 as id_entitproc FROM tb_entitproc");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_entitproc'];
				   
			   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				$_SESSION['id_saidaam'] = $cp1;
									
			   $sqlins = "insert into tb_entitproc(id_entitproc,cod_prod,quant_it,data_ent,obs_ent,num_lote)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp7')";
							
				   echo("insert into tb_entitproc(id_entitproc,cod_prod,quant_it,data_ent,obs_ent,num_lote)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp7')");			
				  $id2 = "";									
				  $ins=mysql_query( $sqlins );
				  
				  
				  
			     
	
			} else { 


                echo("update tb_entitproc set quant_it = '"   . $cp3 . "', data_ent = '" .$cp4 .
				"', obs_ent = '" . $cp5 . "' where id_entitproc = '".$cp1."'");

		        $sqlins = "update tb_entitproc set quant_it = '"   . $cp3 . "', data_ent = '" .$cp4 .
				"', obs_ent = '" . $cp5 . "' ,num_lote = '" . $cp7 ."' where id_entitproc = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );

         

					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp6 == "E") {   
		   
		   echo("volta saldo<br><br>");
		   echo("update tb_itemprocessado set quant_disp = quant_disp - ' "   . $cp3 . "' where cod_prod = '".$cp2."'");
		   
		   
		   
   			   $sqlins = "update tb_itemprocessado set quant_disp = quant_disp - ' "   . $cp3 . "' where cod_prod = '".$cp2."'";
	           $ins=mysql_query( $sqlins );
		   
		  echo("delete from tb_entitproc where id_entitproc = '". $cp1 ."'");
	      $sqlins = "delete from tb_entitproc where id_entitproc = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			

    }
}

?>
