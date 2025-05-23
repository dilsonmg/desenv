///////////publicaçoes//////////////////
/**
 * Array de objectos de qual caracter deve substituir seu par com acentos
*/ 
/*
var am = 'Esta função não está disponível!'
var bV  = parseInt(navigator.appVersion)
var bNS = navigator.appName=='Netscape'
var bIE = navigator.appName=='Microsoft Internet Explorer'


function nrc(e) {
     if (bNS && e.which > 1){
             alert(am)
             return false
         } else if (bIE && (event.button >1)) {
                 alert(am)
                 return false;
                }
         }
         document.onmousedown = nrc;
         if (document.layers) window.captureEvents(Event.MOUSEDOWN);
             if (bNS && bV < 5 ) window.onmousedown = nrc;



*/

function ver_foto(foto){ 
	      urln = 'publicacoes/'+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}

function ver_foto1(foto){ 
          var setor_doc = document.form1.setor_doc.value
		  switch (setor_doc)
		  {
			 	   case "1":
					subdir = "Fabrica";
					break;
			   case "2":
					subdir = "RH";
					break;
			   case "3":
					subdir = "TI";
					break;
			   case "4":
					subdir = "Compras";
					break;
			   case "5":
					subdir = "Comercial";
					break;
			   case "6":
					subdir = "Financeiro";
					break;
			   case "7":
					subdir = "Contabilidade";
					break;
			   case "8":
			   		subdir = "Qualidade";
					break;
			   case "9":
					subdir = "Outros";
					break; 
		  }
		  
		    
	      urln = 'arquivos/'+subdir +"/"+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}




function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit)
	field.value = field.value.substring(0, maxlimit);
else 
	countfield.value = maxlimit - field.value.length;
}

function voltar(){
   document.form1.action="menu_visita.php";
   document.form1.submit();
}


function verifica_data(dta,nmcampo) { 

	//dia = (document.forms[0].nasc.value.substring(0,2)); 
	//mes = (document.forms[0].nasc.value.substring(3,5)); 
	//ano = (document.forms[0].nasc.value.substring(6,10)); 
	if (dta == "") {
	    return true;
    }
	dia = (dta.substring(0,2))
	mes = (dta.substring(3,5))
	ano = (dta.substring(6,10));
	if (isNaN(dia) || isNaN(mes) || isNaN(ano)) { 
	   	nmcampo.value = ""
         nmcampo.focus();
		 alert("Data Invalida !");
	     return false;

	    situacao = "falsa"; 
	} 
	
		
	situacao = ""; 
	// verifica o dia valido para cada mes 
	if ((dia < 01)||(dia < 01 || dia > 30) && ( mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
	situacao = "falsa"; 
	} 
	
	// verifica se o mes e valido 
	if (mes < 01 || mes > 12 ) { 
	situacao = "falsa"; 
	} 
	
	// verifica se e ano bissexto 
	if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
	situacao = "falsa"; 
	} 
	
	if (isNaN(dta.charAt(0)) || dta.value == "") { 
//	situacao = "falsa"; 
	} 
		    
//alert(situacao)
	if (situacao == "falsa") { 
		alert("Data inválida!"); 
	//	document.forms[0].nmcampo.focus();  
	     nmcampo.value = ""
	     nmcampo.focus();
	     return false;
	} 
} 

function mascara(campo){ 
   texto = campo.value; 
   if(texto.length == 2){ 
      campo.value = texto + "/"; }
   else if(texto.length ==5){ 
      campo.value = texto + "/"; } 
}
function mascara1(campo){ 
   texto = campo.value; 
   if(texto.length == 2){ 
      campo.value = texto + ":"; }
}

///////////////////////
function validaformpublica() {
	docto = document.form1.arq_instr.value;
	
	if(docto != ""){document.form1.nome_doc1.value = docto;}
	
	if (document.form1.descr_publica.value == ''){ 
	    alert("Informe a Descricao !");
		document.form1.descr_publica.focus();
		return false;
	}
	
	
	if (document.form1.data_public.value==''){ 
	    alert("Informe a Data da Publicacao !");
		document.form1.data_public.focus();
		return false;
	}
	if (document.form1.nome_doc1.value==''){ 
	    alert("Informe o nome do arquivo !");
		document.form1.arq_instr.focus();
		return false;
	}

	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "doctovgr1.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}


}
function excluir_publica(){
	
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="doctovgr1.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}



/////////////////////
function validaforminf() {
	var unid_industr = document.form1.unid_industr.value;
	if (unid_industr == ''){
		alert("Informe a Unidade Industrial !")
		document.form1.unid_industr.focus();
		return false;}

	if(document.form1.gegis.checked){
    	document.form1.gegis.value="S";
	}else{document.form1.gegis.value="";}
	
	if(document.form1.unica.checked){
    	document.form1.unica.value="S";
	}else{document.form1.unica.value="";}

	if(document.form1.ctc.checked){
    	document.form1.ctc.value="S";
	}else{document.form1.ctc.value="";}

	if(document.form1.preventivo.checked){
    	document.form1.preventivo.value="S";
	}else{document.form1.preventivo.value="";}

	if(document.form1.conc_natu.checked){
    	document.form1.conc_natu.value="S";
	}else{document.form1.conc_natu.value="";}
	
	if(document.form1.conc_conve.checked){
    	document.form1.conc_conve.value="S";
	}else{document.form1.conc_conve.value="";}

	if(document.form1.conc_dioxido.checked){
    	document.form1.conc_dioxido.value="S";
	}else{document.form1.conc_dioxido.value="";}

	if(document.form1.conc_ndet.checked){
    	document.form1.conc_ndet.value="S";
	}else{document.form1.conc_ndet.value="";}
/*
	if(document.form1.corretivo.checked){
    	document.form1.corretivo.value="S";
	}else{document.form1.corretivo.value="";}
*/
	if(document.form1.fermentec.checked){
    	document.form1.fermentec.value="S";
	}else{document.form1.fermentec.value="";}
	
	if(document.form1.fab_levedura.checked){
    	document.form1.fab_levedura.value="S";
	}else{document.form1.fab_levedura.value="";}

	if(document.form1.fornec_creme.checked){
    	document.form1.fornec_creme.value="S";
	}else{document.form1.fornec_creme.value="";}
	
	if(document.form1.outras_consult.checked){
    	document.form1.outras_consult.value="S";
	}else{document.form1.outras_consult.value="";}
	
	
	if (isNaN(document.form1.rea_etnant.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.rea_etnant.focus();
		return false;
	}
	if (isNaN(document.form1.prv_etnatu.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.prv_etnatu.focus();
		return false;
	}
	if (isNaN(document.form1.prv_canaatu.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.prv_canaatu.focus();
		return false;
	}
	if (isNaN(document.form1.rea_canaant.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.rea_canaant.focus();
		return false;
	}
	

	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_infad.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}


}
function validaforminf1() {

	
	if (isNaN(document.form1.safra.value) || document.form1.safra.value == ''){ 
	    alert("Informe o campo no formato 9999 !");
		document.form1.safra.focus();
		return false;
	}
	
	
	if (isNaN(document.form1.previsto_etanol.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.previsto_etanol.focus();
		return false;
	}
	if (isNaN(document.form1.realizado_etanol.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.realizado_etanol.focus();
		return false;
	}
	if (isNaN(document.form1.previsto_cana.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.previsto_cana.focus();
		return false;
	}
	if (isNaN(document.form1.realizado_cana.value)){ 
	    alert("Informe o campo no formato 9999999999.99 !");
		document.form1.realizado_cana.focus();
		return false;
	}
	

	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_safra.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}


}
function excluirinf(){
	
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_safra.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function validaformc(){
/*
	var concl_pend = document.form1.concl_pend.value;
	
	
	if (concl_pend == ""){
    alert("Informe a conclusão da pendência !");
	document.form1.concl_pend.value="";
	document.form1.concl_pend.focus(); 
	return false;
	}			
*/

	//alert(situacao);
    if (confirm("Confirma a gravação da conclusão da pendência ?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_visita.php?gravar=P";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}

}

function validaformrc(arg1){
var data_recl     = document.form1.data_recl.value;

var resumo_recl      = document.form1.resumo_recl.value;

var descr_recl      = document.form1.descr_recl.value;

var cliente      = document.form1.cliente.value;


if (arg1 != "A"){
	if (cliente == ""){
	
	  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
		alert("Informe o cliente da Reclamação !");
		document.form1.cliente.value="";
		document.form1.cliente.focus(); 
		return false;
		}
	
	
	
	if (data_recl == ""){
	
	  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
		alert("Informe a data da Reclamação !");
		document.form1.data_recl.value="";
		document.form1.data_recl.focus(); 
		return false;
		}
	if (resumo_recl == ""){
	
	  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
		alert("Informe o resumo da Reclamação !");
		document.form1.resumo_recl.value="";
		document.form1.resumo_recl.focus(); 
		return false;
		
		}
	
	 var valor = 0; 
	 var aChk = document.getElementsByName("dest_recl");  
		 for (var i=0;i<aChk.length;i++){         
		  if (aChk[i].checked == true){           
			 valor = eval(valor) +  eval(aChk[i].value) ;
			   // alert(aChk[i].value + " marcado.");  //alert(document.getElementsByName('dest_recl').length);
		  } 
		 }
		 if (valor == 0) {     
					alert("Escolha alguma destinação para a reclamação !"); 
					document.form1.resumo_recl.focus();      
					return false;
		}
		
		//alert("valor"+valor);
	document.form1.val_dest.value = valor;	   
	
	if (descr_recl == ""){
	
	  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
		alert("Informe a  Reclamação !");
		document.form1.descr_recl.value="";
		document.form1.descr_recl.focus(); 
		return false;
	}
}

	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_recl.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}



}
//////////////////
var dateDif = {
// Fonte: http://www.bigbold.com/snippets/posts/show/2501
dateDiff: function(strDate1,strDate2){
return (((Date.parse(strDate2))-(Date.parse(strDate1)))/(24*60*60*1000)).toFixed(0);
}
}
function compara_datas(dt_i){

   hoje = new Date();
            dia = hoje.getDate();
            mes = hoje.getMonth();
            ano = hoje.getFullYear();
            if (dia < 10){
                dia = "0" + dia;}
            //mes = mes + 1;
            if (mes < 10){
                mes = "0" + mes;
			}			
//formato do brasil 'pt-br'
 
 // Declarações de variáveis
var mes, data, dataAtual, dataInfo, arrDataInfo, novaDataInfo, diasEntreDatas;
// Lista dos meses em inglês
mes = [];
mes[0] = "January";
mes[1] = "February";
mes[2] = "March";
mes[3] = "April";
mes[4] = "May";
mes[5] = "June";
mes[6] = "July";
mes[7] = "August";
mes[8] = "September";
mes[9] = "October";
mes[10] = "November";
mes[11] = "December";
// Instancia o objeto Date
data = new Date();
// Pega a data de hoje no seguinte formato: November 22 2006
dataAtual = mes[data.getMonth()] + ' ' + data.getDate() + ' ' + data.getFullYear();
// Pega a data informada pelo usuário
dataInfo = dt_i;
// Separa a data informada pelo usuário através da barra /
arrDataInfo = dataInfo.split('/');
// Formata a data para o seguinte formato: November 22 2006
novaDataInfo = mes[(arrDataInfo[1] - 1)] + ' ' + arrDataInfo[0] + ' ' + arrDataInfo[2];
// Saberemos o total de dias entre: a data informada pelo usuário e a data atual
var diasEntreDatas = dateDif.dateDiff(novaDataInfo, dataAtual);
 ////////////
var limite = 7; 
 /*           
  
  Limite de 7 dias

            if (parseInt(diasEntreDatas) > parseInt(limite)){
				//alert(diasEntreDatas);
				alert("A data do relatorio antecede a 7 dias da data de hoje ");
	            document.form1.data_relato.value="";
	           return false;
			}
  */

  var data_1 = dt_i.value;

  hoje = new Date();
 dia_hj = hoje.getDate();
 dia = "5";
 mes = hoje.getMonth() + 1;
 ano = hoje.getFullYear();
  
 //alert(hoje);
  

 if (dia < 10){
 dia = "0" + dia;}

 if (mes < 10){
// 	mes = "0" + eval(mes +1);}
 	mes = "0" + eval(mes);}
 
 if (ano < 2000){
	ano = "19" + ano;
 }
//O mes começa em Zero, então soma-se 1
 if(mes == 1){
	 mes_ant = 12;
 }else{
	 mes_ant = mes - 1;
 }
 ano_ant = ano - 1;

var data_1 = dia+"/"+mes+"/"+ano;



  var data_2 = dt_i;
    var Compara02 = parseInt(data_2.split("/")[2].toString() + data_2.split("/")[1].toString() + data_2.split("/")[0].toString());
  
  //alert("compara02="+Compara02);

  var Compara01 = parseInt(data_1.split("/")[2].toString() + data_1.split("/")[1].toString() + data_1.split("/")[0].toString());
 // alert("compara01="+Compara01);
 var mes_c =data_2.split("/")[1].toString();
 var ano_c = data_2.split("/")[2].toString();


/* 
if (mes_c < mes_ant || ano_c < ano_ant){
	   alert("A data do relatório inválida !");
	   document.form1.data_relato.value="";
	   return false;
}
*/



var datainf = dt_i;



	var objDate = new Date();
	objDate.setYear(datainf.split("/")[2]);
	objDate.setMonth(datainf.split("/")[1]  - 1);//- 1 pq em js é de 0 a 11 os meses
	objDate.setDate(datainf.split("/")[0]);

	if(objDate.getTime() > new Date().getTime()){
		alert("A data do relatorio não pode ser maior que a data atual");
		document.form1.data_relato.value="";
	  return false;
   }
 /* 
if (dia_hj > 5){
	if (Compara01 > Compara02 && mes_c < mes || ano_c < ano) {
	   alert("Os relatórios do mês anterior só podem ser lançados até o quinto dia do mês corrente !");
	   document.form1.data_relato.value="";
	   return false;
	}
	else {
 	   return true
	}
}
*/
}	


function validaformag999(){

hoje = new Date();
 dia = hoje.getDate();
 mes = hoje.getMonth() + 1;
 ano = hoje.getFullYear();
 

 
 //alert(hoje);

 if (dia < 10){
 dia = "0" + dia;}

 if (mes < 10){
// 	mes = "0" + eval(mes +1);}
 	mes = "0" + eval(mes);}
 
 if (ano < 2000){
	ano = "19" + ano;
 }
//O mes começa em Zero, então soma-se 1
var numdata = ano+mes+dia;


var data_ag     = document.form1.data_ag.value;


var codigo_cli  = document.form1.codigo_cli.value;

var descri_ag   =  document.form1.descri_ag.value;

var nrdtag = data_ag.substr(6,6) + data_ag.substring(3,5) + data_ag.substring(0,2);


var difdt = (eval(nrdtag) - eval(numdata));



if (difdt < 0){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
/*
  alert("nrdtag="+nrdtag);
  alert("numdata="+numdata);

  alert(difdt);
  alert(nrdtag);
  alert(numdata);
  
  
    alert("Data da Inválida @1!!");
	document.form1.data_ag.value="";
	document.form1.data_ag.focus(); 
	return false;*/
	}


if (data_ag == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data da Visita !");
	document.form1.data_ag.value="";
	document.form1.data_ag.focus(); 
	return false;
}
	
if (codigo_cli == ""){
    alert("Informe o cliente visitado !");
	document.form1.cliente.value="";
	document.form1.cliente.focus(); 
	return false;
}
	
 if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_agenda.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
				
		
}


//////////////////
function validaform(){

var data_relato     = document.form1.data_relato.value;

//var id_consultc      = document.form1.id_consultc.value;

var codigo_cli      = document.form1.codigo_cli.value;

var objetivos_visita =  document.form1.objetivos_visita.value;

var resumo =  document.form1.resumo.value;

var contatos =  document.form1.contatos.value;

////////////////////////////////////////	
var strData = data_relato;
var partesData = strData.split("/");
var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
if(data > new Date()){
   alert("A data informada e maior que a data do dia");
	document.form1.data_relato.value="";
	document.form1.data_relato.focus(); 
	return false;
   
   }	
////////////////////////////////////////////		
	if(document.form1.conc_natu.checked){
    	document.form1.conc_natu.value="S";
	}else{document.form1.conc_natu.value="";}
	
	if(document.form1.conc_conve.checked){
    	document.form1.conc_conve.value="S";
	}else{document.form1.conc_conve.value="";}

	if(document.form1.conc_dioxido.checked){
    	document.form1.conc_dioxido.value="S";
	}else{document.form1.conc_dioxido.value="";}

	if(document.form1.conc_ndet.checked){
    	document.form1.conc_ndet.value="S";
	}else{document.form1.conc_ndet.value="";}


	
if (data_relato == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data do Relatorio !");
	document.form1.data_relato.value="";
	document.form1.data_relato.focus(); 
	return false;
	}
if (contatos == ""){
    alert("Informe os contatos da visita !");
	document.form1.contatos.value="";
	document.form1.contatos.focus(); 
	return false;
	}			
		
if (objetivos_visita == ""){
    alert("Informe o objetivo da visita !");
	document.form1.objetivos_visita.value="";
	document.form1.objetivos_visita.focus(); 
	return false;
	}			
	
	
if (resumo == ""){
    alert("Informe o resumo da visita !");
	document.form1.resumo.value="";
	document.form1.resumo.focus(); 
	return false;
	}			


	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_visita.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
function validaformE(){
    if (confirm("Confirma a Alteração do Motivo da Visita ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_visita1.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function excluir(){
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_visita.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
function novo(){
  document.location.href='dados_visita.php';
		  return true;
}

function novo1(){
  document.location.href='dados_agenda.php';
		  return true;
}
function novopl(){
  document.location.href='dados_plnovd.php';
		  return true;
}


function validaformag(){

hoje = new Date();
 dia = hoje.getDate();
 mes = hoje.getMonth() + 1;
 ano = hoje.getFullYear();
 

 
 //alert(hoje);

 if (dia < 10){
 dia = "0" + dia;}

 if (mes < 10){
// 	mes = "0" + eval(mes +1);}
 	mes = "0" + eval(mes);}
 
 if (ano < 2000){
	ano = "19" + ano;
 }
//O mes começa em Zero, então soma-se 1
var numdata = ano+mes+dia;


var data_ag     = document.form1.data_ag.value;


var codigo_cli  = document.form1.codigo_cli.value;

var descri_ag   =  document.form1.descri_ag.value;

var nrdtag = data_ag.substr(6,6) + data_ag.substring(3,5) + data_ag.substring(0,2);


var difdt = (eval(nrdtag) - eval(numdata));



if (difdt < 0){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
/*
  alert("nrdtag="+nrdtag);
  alert("numdata="+numdata);

  alert(difdt);
  alert(nrdtag);
  alert(numdata);
  
  */
    alert("Data da Inválida @1!!");
	document.form1.data_ag.value="";
	document.form1.data_ag.focus(); 
	return false;
	}


if (data_ag == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data da Visita !");
	document.form1.data_ag.value="";
	document.form1.data_ag.focus(); 
	return false;
}
	
if (codigo_cli == ""){
    alert("Informe o cliente visitado !");
	document.form1.cliente.value="";
	document.form1.cliente.focus(); 
	return false;
}
	
 if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_agenda.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
				
		
}

function cancelarag(){
	
	    if (confirm("Confirma o cancelamento do compromisso agendado ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_agenda.php?gravar=C";
		  document.form1.submit();  
		  return true;
		  }

	
}

function validaformplnov(){

hoje = new Date();
 dia = hoje.getDate();
 mes = hoje.getMonth();
 ano = hoje.getFullYear();
 if (dia < 10)
 dia = "0" + dia;
 if (mes < 10)
 	mes = "0" + eval(mes +1);
 
 if (ano < 2000)
	ano = "19" + ano;

//O mes começa em Zero, então soma-se 1
var numdata = ano+mes+dia;


var data_cad     = document.form1.data_cad.value;


var codigo_cli  = document.form1.codigo_cli.value;

var prod_foco   =  document.form1.prod_foco.value;

var nrdtag = data_cad.substr(6,6) + data_cad.substring(3,5) + data_cad.substring(0,2);

var id_plano = document.form1.id_plano.value;

var difdt = (eval(nrdtag) - eval(numdata));

//alert(difdt)
if (difdt < 0){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Data da Inválida 2  ! !");
	document.form1.data_cad.value="";
	document.form1.data_cad.focus(); 
	return false;
	}


if (data_cad == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data do Cadastro !");
	document.form1.data_cad.value="";
	document.form1.data_cad.focus(); 
	return false;
}
	
if (codigo_cli == ""){
    alert("Informe o cliente  !");
	document.form1.codigo_cli.value="";
	document.form1.codigo_cli.focus(); 
	return false;
}
	
 if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_plnovd.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
				
		
}


function excluirplnv(){
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_plnovd.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function validaformacomppl(){
var data_ac     = document.form1.data_ac.value;

var id_plano    = document.form1.id_plano.value;

var id_acplano   = document.form1.id_acplano.value;

var status_ac    = document.form1.status_ac.value;


if (data_ac == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data do Cadastro !");
	document.form1.data_ac.value="";
	document.form1.data_ac.focus(); 
	return false;
}
	
	
 if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_acomppl.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}		
}

function excluiracomppl(){
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_acomppl.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function excluirag(){

    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_agenda.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}


function validaformq(){
var data_visita     = document.form1.data_visita.value;

var id_consult      = document.form1.id_consult.value;

var cliente         = document.form1.cliente.value;

var cidade          =  document.form1.cidade.value;

var contato =  document.form1.contato.value;

var cargo =  document.form1.cargo.value;

var email =  document.form1.email.value;


if (data_visita == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data da Visita !");
	document.form1.data_visita.value="";
	document.form1.data_visita.focus(); 
	return false;
	}
if (cliente == ""){
    alert("Informe o cliente visitado !");
	document.form1.cliente.value="";
	document.form1.cliente.focus(); 
	return false;
	}			
		
if (cidade == ""){
    alert("Informe a cidade da visita !");
	document.form1.cidade.value="";
	document.form1.cidade.focus(); 
	return false;
	}			
	
	
if (contato == ""){
    alert("Informe o contato da visita !");
	document.form1.contato.value="";
	document.form1.contato.focus(); 
	return false;
	}			

if (cargo == ""){
    alert("Informe o cargo do contato da visita !");
	document.form1.cargo.value="";
	document.form1.cargo.focus(); 
	return false;
	}			
if (email == ""){
    alert("Informe o email do contato da visita !");
	document.form1.email.value="";
	document.form1.email.focus(); 
	return false;
	}			
if (data_visita == ""){
    alert("Informe a data da visita !");
	document.form1.data_visita.value="";
	document.form1.data_visita.focus(); 
	return false;
	}			

	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_pesquisa.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
function novoq(){
  document.location.href='dados_pesquisa.php';
		  return true;
}
function novoq1(){
  document.location.href='dados_infcliente.php';
		  return true;
}
function novoq11(){
  document.location.href='dados_safra.php';
		  return true;
}

