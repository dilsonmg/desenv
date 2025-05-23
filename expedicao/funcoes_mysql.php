

<?php

  /* controle de amostras de produtos acabados 
  
  //////////////////////////////////////////////////////////
  
  calcula_nota()

  DELIMITER $
  CREATE FUNCTION calc_nota(nota NUMERIC(15,2)) RETURNS NUMERIC(15,2)
  BEGIN
   DECLARE peso INT;
   
   #Se a nota do aluno for maior que 9.5 então sua nota terá um peso maior
   IF nota > 9.5 THEN
    SET peso = 2;
   ELSE
    SET peso = 1;
   END IF;
   
   RETURN (nota*peso) / 20;
  END
  
  Usando o calcula_nota()

  SELECT a.nome, p.descricao, calcula_nota(n.valor_nota) AS nota_calculada, n.valor_nota AS nota_original
   FROM aluno a INNER JOIN nota n ON a.id = n.aluno_id
  INNER JOIN prova p ON n.prova_id = p.id
  ORDER BY a.id, nota_calculada DESC  
  
  
  
  ////////////////////////////////////////////////////////////
  
  arredonda_nota()

  DELIMITER $
  CREATE PROCEDURE arredondamento_nota()
  BEGIN
   #O DECLARE serve para declarar uma variável que será utilizada durante o programa
   DECLARE nota_atual NUMERIC(15,2);
   DECLARE id_aluno, id_prova  INT;
   
   #Criamos um CURSOR que irá "guardar" o resultado do SELECT
   DECLARE cur CURSOR FOR SELECT valor_nota, aluno_id, prova_id FROM nota;
   
   #Abrimos o CURSOR para utilizá-lo dentro do LOOP
   OPEN cur;
   
  #Inicamos o LOOP dando um nome ao mesmo para que este possa ser referenciado caso #necessário
   myloop:
   LOOP
      #Atribuímos o valor das colunas do cursor as variáveis que criamos anteriormente
      FETCH cur INTO nota_atual, id_aluno, id_prova;
    
      #Lógica principal da nossa rotina.
      #Caso o próximo inteiro tenha um diferença de 0.2 ou menos da nota atual
      # então a nota atual será arredondada para este inteiro.
      IF (CEIL(nota_atual) - nota_atual) <= 0.2 THEN
        UPDATE nota SET valor_nota = CEIL(nota_atual) WHERE aluno_id = id_aluno AND prova_id = id_prova;
      END IF;
   
   END LOOP;
   
    #Fechamos o cursor
    CLOSE cur;
  END
  
  
  Executando o procedimento arredonda_nota()

  CALL arredondamento_nota();  
  
  
  Excluindo procedimentos e funções

  #EXCLUINDO FUNÇÃO calcula_nota
  DROP FUNCTION calcula_nota;
   
  #EXCLUINDO PROCEDIMENTO arredonda_nota
  DROP PROCEDURE arredonda_nota;  
  
  //////////////////////////////////////////////////////////
  
    
  #Criação da função calcula_nota()
  DELIMITER $
  CREATE FUNCTION calc_nota(nota NUMERIC(15,2)) RETURNS NUMERIC(15,2)
  BEGIN
   DECLARE peso INT;
   
   #Se a nota do aluno for maior que 9.5 então sua nota terá um peso maior
   IF nota > 9.5 THEN
    SET peso = 2;
   ELSE
    SET peso = 1;
   END IF;
   
   RETURN (nota*peso) / 20;
  END
  $
   
  #Criação do procedimento arredonda_nota
  DELIMITER $
  CREATE PROCEDURE arredondamento_nota()
  BEGIN
   #O DECLARE serve para declarar uma variável que será utilizada durante o programa
   DECLARE nota_atual NUMERIC(15,2);
   DECLARE id_aluno, id_prova  INT;
   
   #Criamos um CURSOR que irá "guardar" o resultado do SELECT
   DECLARE cur CURSOR FOR SELECT valor_nota, aluno_id, prova_id FROM nota;
   
   #Abrimos o CURSOR para utilizá-lo dentro do LOOP
   OPEN cur;
   
  #Inicamos o LOOP dando um nome ao mesmo para que este possa ser referenciado caso #necessário
   myloop:
   LOOP
      #Atribuímos o valor das colunas do cursor as variáveis que criamos anteriormente
      FETCH cur INTO nota_atual, id_aluno, id_prova;
    
      #Lógica principal da nossa rotina.
      #Caso o próximo inteiro tenha um diferença de 0.2 ou menos da nota atual
      # então a nota atual será arredondada para este inteiro.
      IF (CEIL(nota_atual) - nota_atual) <= 0.2 THEN
        UPDATE nota SET valor_nota = CEIL(nota_atual) WHERE aluno_id = id_aluno AND prova_id = id_prova;
      END IF;
   
   END LOOP;
   
    #Fechamos o cursor
    CLOSE cur;
  END
  

array13

nbsp;

O objetivo deste artigo não foi apenas apresentar teorias e conceitos que podem ser encontrados no próprio manual do MySQL a respeito de funções e procedimentos. Mostramos como aplicar estes na prática com um cenário real, criando toda a estrutura do banco até a população do mesmo.

Usamos como ferramenta o PhpMyAdmin apenas para dar uma melhor noção para aqueles que estão começando agora, mas nada impede que sejam utilizadas outras ferramentas como, por exemplo, o MySQL Workbench, que é uma poderosa ferramenta para realizar até a modelagem do banco de dados e fazer engenharia reserva do modelo para o script.
Publicado no canal PHP e no canal Mais Canal Mais

  
  /////////////////////////////////////////////////////////
  
  
  INSERT INTO aluno (id, nome, matricula, data_nascimento, data_matricula) VALUES
  (1,'MICHAEL JONH', '123A', STR_TO_DATE('23/08/1993', '%d/%m/%Y'), CURRENT_DATE()),
  (2,'WILLIANS JUNIOR', '400B', STR_TO_DATE('10/04/1993', '%d/%m/%Y'), CURRENT_DATE()),
  (3,'JOHN BILLBOARD', '420B', STR_TO_DATE('30/07/1993', '%d/%m/%Y'), CURRENT_DATE()),
  (4,'JENNY KILLY', '010A', NULL, STR_TO_DATE('25/01/2014', '%d/%m/%Y'))  
  
SELECT a.cod_prod,b.descr_prod, a.num_lote,
DATE_FORMAT(str_to_date(a.data_fabr, '%d/%m/%Y'), '%d/%m/%Y') AS data_fabr,
a.data_venc, date_add(str_to_date(a.data_venc, '%d/%m/%Y'), interval 1 year) venci
FROM tb_entprodac a
inner join tb_produto b on a.cod_prod = b.cod_prod
order by str_to_date(a.data_venc, '%d/%m/%Y') asc

CREATE TABLE tmptbnova SELECT a.cod_prod, a.num_lote,str_to_date(a.data_fabr, '%d/%m/%Y') data_fabr,
str_to_date(a.data_venc, '%d/%m/%Y')data_venc,date_add(str_to_date(a.data_venc, '%d/%m/%Y'), interval 1 year) venci_retencao
FROM tb_entprodac a
group by a.cod_prod,a.num_lote
order by str_to_date(a.data_venc, '%d/%m/%Y') asc

insert into tb_contraprov(cod_prod,num_lote,data_fabr,data_venc,venci_retencao,situacao)(
SELECT cod_prod,num_lote,data_fabr,data_venc,venci_retencao ,"A" FROM tmptbnova )

drop table tmptbnova

update  tb_contraprov set
quantidade = 0.300 , unidade = 'ml'
 where cod_prod > 1549  and cod_prod < 1599
 
 update  tb_contraprov set
quantidade = 0.200 , unidade = 'gr'
 where quantidade is null
 

select * from tb_contraprov
where venci_retencao > curdate()



///////////////////////////////
select date_sub('2016-10-01', interval 1 day_hour)

select
*
from
clientes
where date(now()) = date(date_sub(data_vencimento, interval 10 day));

Explicando...

No where estou pegando o dia de hoje (date(now())), ai eu subtraio 10 dias da data de vencimento (date(date_sub(data_vencimento, interval 10 day))) comparo com o hoje.

Em resumo, eu pego os clientes que irão vencer daqui a 10 dias, por isso o uso do SUB, voltando esse vencimento no tempo, ai comparo com o hoje.
////--------------------------------------------------------------------------------------------------------------------///////

1. Adicionando um ano sob a data atual.

 select date_add(now(), interval 1 year)  


2. Adicionando um mês sob a data atual

 select date_add(now(), interval 1 month)  


3. Adicionando um dia sob a data atual

 select date_add(now(), interval 1 day)  


4. Adicionando uma hora sob a data atual

 select date_add(now(), interval 1 hour)  



1. Subtraindo um ano e um mês sob a data atual.

 select date_sub(now(), interval 1 year_month)  


2. Subtraindo um mês sob a data atual

 select date_sub(now(), interval 1 month)  


3. Subtraindo um dia e uma hora sob a data atual

 select date_sub(now(), interval 1 day_hour)  


4. Subtraindo uma hora e um minuto sob a data atual

 select date_sub(now(), interval 1 hour_minute)  


//////////////////////////////

*/
?>


