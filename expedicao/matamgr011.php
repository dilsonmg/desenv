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
header("Location: matam0011.php");



function gravarreg($cp1,$cp2,$cp3,$cp4){
	 
if ($cp4 <> "E") {   
    

	       echo("SELECT * FROM tb_grpamostra where id_grpamostra = '". $cp1."'" );	
		  
		  $rs1 = mysql_query("SELECT * from tb_grpamostra where id_grpamostra = '". $cp1 ."'" );
          $a = mysql_num_rows($rs1);
		  echo ('a='.$a);
			if ($a == 0){
	
									
				   $sqlins = "insert into tb_grpamostra(descr_grpam,qtd_kits)
							values('$cp2','0')";
							
				   echo("insert into tb_grpamostra(descr_grpam,qtd_kits)
							values('$cp2','0')");			
							
			}else{
			
                        $sqlins = "update tb_grpamostra set descr_grpam = '"   . $cp2 .
						          "' where id_grpamostra = '".$cp1."'";


			}
		    	            $ins=mysql_query( $sqlins );     

                  //////////////////////////////////////////////////////////	 
			
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
