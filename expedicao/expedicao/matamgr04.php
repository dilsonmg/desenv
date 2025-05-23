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
$dt1=explode("/",$data_nf);
$data_nf="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quant_disp == ''){
	$quant_disp = 0.00;
}

$cd_prod  = explode(";",$cd_itens,-1);
$nr_lotes = explode(";",$cd_lotes,-1);
$qtdbx    = explode(";",$qtd_itens,-1);

//if (is_array($nr_lotes)) { echo("eh um array");}

$y = count($cd_prod);

echo("id_itproc=".$num_lote);

ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

if (!empty($itens)) {                
      $qtd = count($itens);
       for ($i = 0; $i < $qtd; $i++) {
            echo $itens[$i];//imprime o item corrente
       }
 }


echo("idgrpamosta=".$id_grpamostra2);


$aResult = gravarreg($id,$num_nf,$data_nf,$id_grpamostra,$obs_saida,$a,$id_grpamostra2,$id2,$quant_kits);


echo("y=".$y);

if($y == 1){
	
    $aResult = gravarreg1($id2,$_SESSION['id_saidaam'],$cod_prod,$num_lote,$quant_said,$a,$quant_kits,$id_grpamostra2);
	
}else{
	
	  if($a != "E"){
		  
		  for ($i = 0; $i < $y; $i++) {

echo("diferente");
echo($id_itproc[$i]."<br>");
echo($num_lote[$i]."<br>");
			  
			 $aResult = gravarreg1($id2,$_SESSION['id_saidaam'],$cd_prod[$i],$nr_lotes[$i],$qtdbx[$i],$a,$quant_kits,$id_grpamostra2);
		  }
	  } else { 
//	      $aResult = gravarreg1($id1,$_SESSION['id_saidaam'],$id_itproc[0],$num_lote[0],$a); 

echo("ENTROU e*");
		   echo("select cod_prod , quant_said from tb_itsaidalt where id_itsaidalt = '" .$cp1 ."'");
		   $rs100a = mysql_query("select cod_prod , quant_said from tb_itsaidalt where id_itsaidalt = '" .$cp1 ."'");
           $a = mysql_num_rows($rs100a);
            
			if($a>0){

			 while($row=mysql_fetch_array($rs100a)){
				 echo("update tb_itemprocessado set quant_disp = quant_disp + ". $row['quant_said']  ." where id.itproc = '".$row['id_itproc'] ."'");
				 


				 $sqlup = "update tb_itemprocessado set quant_disp = quant_disp + ". $row['quant_said']  ." where id.itproc = '".$row['id_itproc'] ."'";
	             $up=mysql_query( $sqlup );				 
			 }
			}
	
	      $sqlins = "delete from tb_itsaidalt where id_itsaidalt = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}	
		}			  


}

//unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6);
header("Location: matam0004.php");

function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9){
	
	echo("cp4=".$cp4);
	 
	  if ($cp6 <> "E") {   

                 echo("update tb_grpamostra set qtd_kits = qtd_kits - $cp9 where id_grpamostra = '".$cp4."'");
				 $sqlup0 = "update tb_grpamostra set qtd_kits = qtd_kits - " . $cp9 . " where id_grpamostra = '".$cp4."'";
	             $up=mysql_query( $sqlup0 );				 


           echo("SELECT * FROM tb_saidaam where id_saidaam = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_saidaam where id_saidaam = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				echo("SELECT max(id_saidam) + 1 as id_saidaam FROM tb_saidaam ");
				   $rs1000       = mysql_query("SELECT max(id_saidaam) + 1 as id_saidaam FROM tb_saidaam");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_saidaam'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
									
					$_SESSION['id_saidaam'] = $cp1;
									
				   $sqlins = "insert into tb_saidaam(id_saidaam,num_nf,data_nf,id_grpamostra,obs_saida,quant_kits)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp9')";
							
				   echo("insert into tb_saidaam(id_saidaam,num_nf,data_nf,id_grpamostra,obs_saida,quant_kits)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp9')");			
				  $id2 = "";									
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

     			$_SESSION['id_saidaam'] = $cp1;

               echo("update tb_saidaam set num_nf = '"   . $cp2 . "', data_nf = '" .$cp3 .
				"', obs_saida = '" . $cp5 . "' where id_saidaam = '".$cp1."'");

		        $sqlins = "update tb_saidaam set num_nf = '"   . $cp2 . "', data_nf = '" .$cp3 .
				"', obs_saida = '" . $cp5 . "' where id_saidaam = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp6 == "E") {   
		   //volta o saldo
		   
		   echo("volta saldo");
		   echo("select cod_prod , quant_said from tb_itsaidalt where id_itsaidalt = '" .$cp8 ."'");
		   $rs100a = mysql_query("select cod_prod , quant_said from tb_itsaidalt where id_itsaidalt = '" .$cp8 ."'");
           $a = mysql_num_rows($rs100a);
            
			if($a>0){
                 echo("entrouddd="."update tb_grpamostra set qtd_kits = qtd_kits + 1 where id_grpamostra = '".$cp7."'");
				 $sqlup0 = "update tb_grpamostra set qtd_kits = qtd_kits + 1 where id_grpamostra = '".$cp7."'";
	             $up=mysql_query( $sqlup0 );				 

			 while($row=mysql_fetch_array($rs100a)){
				 echo("update tb_itemprocessado set quant_disp = quant_disp + ". $row['quant_said']  ." where id.itproc = '".$row['id_itproc'] ."'");
				 
				 $sqlup = "update tb_itemprocessado set quant_disp = quant_disp + ". $row['quant_said']  ." where id.itproc = '".$row['id_itproc'] ."'";
	             $up=mysql_query( $sqlup );				 
			 }
			}
		   
		   
		  echo("delete from tb_saidaam where id_saidaam = '". $cp1 ."'");
	      $sqlins = "delete from tb_saidaam where id_saidaam = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			

	      echo("delete from tb_itsaidalt where id_saidaam = '". $cp1 ."'");
		  
		  $sqlins = "delete from tb_itsaidalt where id_saidaam = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
				
    }
}

function gravarreg1($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8){
	 
	  if ($cp6 <> "E") {   
           echo("1====>SELECT * FROM tb_itsaidalt where id_itsaidalt = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_itsaidalt where id_itsaidalt = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				echo("SELECT max(id_itsaidalt) + 1 as id_itsaidalt FROM tb_itsaidalt ");
				   $rs1000       = mysql_query("SELECT max(id_itsaidalt) + 1 as id_itsaidalt FROM tb_itsaidalt");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_itsaidalt'];
				   
				   $rs101 = mysql_query("select x.quant_disp from tb_itemprocessado x where x.cod_prod = '" .$cp3."'");
				   $row101 = mysql_fetch_assoc($rs101);
				   
				   $cp6 = $row101['quant_disp']; // - $cp5;
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
					   
				   $quant_said = $cp5 *$cp7;
									
				   $sqlins = "insert into tb_itsaidalt(id_itsaidalt,id_saidaam,cod_prod,num_lote,quant_said,saldo_it,quant_kits,id_grpamostra)
							values('$cp1','$cp2','$cp3','$cp4','$quant_said','$cp6','$cp7','$cp8')";
							
				   echo("insert into tb_itsaidalt(id_itsaidalt,id_saidaam,cod_prod,num_lote,quant_said,saldo_it,quant_kits,id_grpamostra)
							values('$cp1','$cp2','$cp3','$cp4','$quant_said','$cp6','$cp7','$cp8')");			
		
		//echo("itproc2"."update tb_itemprocessado set quant_disp = '". $cp6 ."' where id_itproc = '".$cp3."'");
							
			//	 $sqlup = "update tb_itemprocessado set quant_disp = '". $cp6 ."' where id_itproc = '".$cp3."'";
	          //   $up=mysql_query( $sqlup );				 
		
		  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

               echo("update tb_itsaidalt set num_lote = '"   . $cp4 ."' where id_saidaam = '".$cp2."' and  cod_prod = '" . $cp3 ."'");

		        $sqlins = "update tb_itsaidalt set num_lote = '"   . $cp4  ."' where id_saidaam = '".$cp2."' and  cod_prod = '" . $cp3 ."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
}

?>
