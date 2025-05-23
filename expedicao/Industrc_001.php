<?php
include 'conectabco.php';

mysql_query("SET NAMES 'iso-8859-1'");
mysql_query("SET character_set_connection=iso-8859-1");
mysql_query("SET character_set_client=iso-8859-1");
mysql_query("SET character_set_results=iso-8859-1");

header('Content-type: text/html; charset=ISO-8859-1');
session_start();
set_time_limit(1440000);


		
		 $rs2 = mysql_query("SELECT a.cod_prod,b.descr_prod, a.num_nf, a.num_lote,a.quantid_ent,a.data_nf,sum(c.quantid_said) total_saida,
(a.quantid_ent - sum(c.quantid_said)) saldo_rest
FROM tb_entmatp a
inner join tb_PRODUTO B ON b.cod_prod = a.cod_prod
inner join tb_saidmatp c on month(c.data_saida) = 6 and year(c.data_saida) = 2022
            and c.num_lote = a.num_lote and c.cod_prod = 100263
where a.cod_prod = 100263 and month(a.data_nf) = 6 and year(a.data_nf) = 2022
group by a.num_lote");				  

	 ?>
      
</form> 
</center>
</body>
</html>
