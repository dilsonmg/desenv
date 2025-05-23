<?php
include 'conectabco.php';

$a = $_GET ["gravar"];
//$id = $_GET["id"];

echo($a);
echo($id);
$hoje = date("d/m/Y");
$data_saida = $hoje; 
$dt1=explode("/",$data_saida);
$data_ped="{$dt1[2]}-{$dt1[1]}-{$dt1[0]}";

if ($quantid == ''){
	$quantid = 0.00;
}


ini_set("max_execution_time", 3600);
ini_set("memory_limit","128M");

echo($id_transp);
$aResult = gravarreg($id,$nm_transp,$enderec,$bairro,$cidade,$uf,$cep,$telef,$contato,$email,$obs,$a);

		unset( $cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12,$cp13,$cp14,$cp15,$cp16 );
header("Location: mattr0001.php");



function gravarreg($cp1,$cp2,$cp3,$cp4,$cp5,$cp6,$cp7,$cp8,$cp9,$cp10,$cp11,$cp12){
	 
	  if ($cp12 <> "E") {   
           echo("SELECT * FROM tb_transportadora where id_transp = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * FROM tb_transportadora where id_transp = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
				
				   $rs1000       = mysql_query("SELECT max(id_transp) + 1 as id_transp FROM tb_transportadora");
				   $row1000      = mysql_fetch_assoc($rs1000);
				   $cp1          = $row1000['id_transp'];
				   
				   if ($cp1  == ""){
					   $cp1 = 1;}  
									
				   $sqlins = "insert into tb_transportadora(id_transp,nm_transp,enderec,bairro,cidade,uf,cep,telef,contato,email,obs)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11')";
							
				   echo("insert into tb_transportadora(id_transp,nm_transp,enderec,bairro,cidade,uf,cep,telef,contato,email,obs)
							values('$cp1','$cp2','$cp3','$cp4','$cp5','$cp6','$cp7','$cp8','$cp9','$cp10','$cp11')");			
														
				  $ins=mysql_query( $sqlins );
						 
			     if( $ins===FALSE ){
				   $msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
			
			} else { 

               echo("update tb_transportadora set nm_transp = '"   . $cp2 . "'," 
				          ." enderec = '" . $cp3 . "', "
				          ." bairro = '" . $cp4 . "', "
				          ." cidade = '" . $cp5 . "', "
				          ." uf = '" . $cp6 . "', "
				          ." cep = '" . $cp7 . "', "
				          ." telef = '" . $cp8 . "', "
				          ." contato = '" . $cp9 . "', "
				          ." email = '" . $cp10 . "', "
				          ." obs = '" . $cp11 . "'  where id_transp = '".$cp1."'");

		        $sqlins = "update tb_transportadora set nm_transp = '"   . $cp2 . "'," 
				          ." enderec = '" . $cp3 . "', "
				          ." bairro = '" . $cp4 . "', "
				          ." cidade = '" . $cp5 . "', "
				          ." uf = '" . $cp6 . "', "
				          ." cep = '" . $cp7 . "', "
				          ." telef = '" . $cp8 . "', "
				          ." contato = '" . $cp9 . "', "
				          ." email = '" . $cp10 . "', "
				          ." obs = '" . $cp11 . "'  where id_transp = '".$cp1."'";

	    	   $ins=mysql_query( $sqlins );
					   
   	     if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			  
		}
	  }
	  if ($cp12 == "E") {   
	       
		  echo("delete from tb_transportadora where id_transp = '". $cp1 ."'");
	      $sqlins = "delete from tb_transportadora where id_transp = '". $cp1 ."'";
	      $ins=mysql_query( $sqlins );
	      if( $ins===FALSE ){
				$msg= "Erro na query... " . mysql_error( ) . "<br/>";}			
    }
}
?>
