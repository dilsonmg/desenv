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
function sair()
{	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="menu_requisicao.php";
		  document.form1.submit();  
		  return true;

}



function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit)
		field.value = field.value.substring(0, maxlimit);
	else 
		countfield.value = maxlimit - field.value.length;
	}

function ver_foto(foto){   
	      urln = 'foto_eqpto/'+foto
          newwindow=window.open(urln,'fotos','toolbar=no, scrollbars=yes, resizable=yes,height=600,width=800');
}

function redimensiona()
            {
                document.images['id_da_imagem'].width = 120;
            }

 function verifica_data(dta,nmcampo) { 

	//dia = (document.forms[0].nasc.value.substring(0,2)); 
	//mes = (document.forms[0].nasc.value.substring(3,5)); 
	//ano = (document.forms[0].nasc.value.substring(6,10)); 
	if (dta == "" || dta =="0000-00-00") {
	    return true;
    }
	dia = (dta.substring(0,2))
	mes = (dta.substring(3,5))
	ano = (dta.substring(6,10));
	

	
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
   if(texto != '0000-00-00'){
	   if(texto.length == 2){ 
		  campo.value = texto + "/"; }
	   else if(texto.length ==5){ 
		  campo.value = texto + "/"; } 
   }
}

function valida_req() {
			 var cod_matesc = document.form1.cod_matesc.options[document.form1.cod_matesc.selectedIndex].value;
			 					  
		    if (cod_matesc == ""){
					  alert ("Selecione o Material !");
					  document.form1.cod_matesc.focus();
					  return false; }					  

			 var data_sol  = document.form1.data_sol.value
			 var quant_sol = document.form1.quant_sol.value;	
		     if (data_sol == "" || data_sol.substring(0,2) == "" ){
					  alert ("Informe a data da solicitação !");
					  document.form1.data_sol.focus();
					  return false; }
			 if (isNaN(quant_sol) || quant_sol == 0){
					  alert ("Informe a quantidade !");
					  document.form1.quant_sol.value = "";
					  document.form1.quant_sol.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "reqgr001.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function exclui_req(){
	 var cod_matesc = document.form1.cod_matesc.options[document.form1.cod_matesc.selectedIndex].value;
			 					  
    if (cod_matesc == ""){
					  alert ("Selecione o Material !");
					  document.form1.cod_matesc.focus();
					  return false; }					  

	 var data_sol  = document.form1.data_sol.value
     if (data_sol == "" || data_sol.substring(0,2) == "" ){
					  alert ("Informe a solicitação !");
					  document.form1.data_sol.focus();
					  return false; }
	
    if (confirm("Confirma a exclusão da Solicitação?")){
   	   	  document.form1.action="reqgr001.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}



function valida_reqan() {
			 var id  = document.form1.id.value
			 
			 
//			 var anl = analis;
		 


			 var data_aprov  = document.form1.data_aprov.value
			 var quant_aprov = document.form1.quant_aprov.value;	
			 var unid_aprov = document.form1.unid_aprov.value;	
			 var situa_aprov = document.form1.situa_aprov.options[document.form1.situa_aprov.selectedIndex].value;
			 

			 
			 
			 if (isNaN(quant_aprov) || quant_aprov == 0){
					  alert ("Informe a quantidade aprovada !");
					  document.form1.quant_aprov.value = "";
					  document.form1.quant_aprov.focus();
					  return false; }	

			 if (unid_aprov == ""){
					  alert ("Informe a unidade aprovada !" + unid_aprov);
					  document.form1.unid_aprov.value = "";
					  document.form1.unid_aprov.focus();
					  return false; }	
					  
		    if (situa_aprov == ""){
					  alert ("Selecione a situação da Aprovação !");
					  document.form1.situa_aprov.focus();
					  return false; }					  
					  		 
		     if (data_aprov == "" || data_aprov.substring(0,2) == "" ){
					  alert ("Informe a data da Aprovação !");
					  document.form1.data_aprov.focus();
					  return false; }

	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
//	 document.form1.action = "reqang1.php?gravar=I";


		 document.form1.action = "reqan01.php?gravar=I&id="+id+"&situa_aprov="+situa_aprov;	

	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
function valida_reqan2(analis) {
			 var id  = document.form1.id.value
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){

    	 document.form1.action = "reqan02.php?gravar=I&id="+id;
		
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function aprova_todas() {
	if (confirm("Confirma a aprovação de todas as requisições ?")){
	 document.form1.action = "reqapt01.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function analisa_todas() {
	if (confirm("Confirma a análise de todas as requisições ?")){
	 document.form1.action = "reqapt01.php?gravar=b";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

////////////////////////////////////////////////////////////
/*
function validachkman() {
	               var id_itemmanu = document.form1.id_itemmanu.options[document.form1.id_itemmanu.selectedIndex].value;
				   var id_eqpto    = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var dt_check    = document.form1.dt_check.value;	
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
				   if (dt_check == ""){
					  alert ("Informe a Data da Manutenção !");
					  document.form1.dt_check.focus();
					  return false; }
					  
			      if((form1.limpeza.checked == false )&&(form1.lubrificacao.checked == false )
				     && (form1.eletrica.checked == false )   && (form1.pneumatica.checked == false )
					 && (form1.estrutura.checked == false )  && (form1.subst_peca.checked == false )
					 && (form1.troca_oleo.checked == false )  && (form1.nivel_oleo.checked == false )
					 && (form1.hidraulica.checked == false ) && (form1.ajuste.checked == false )
					 ) {
					  alert("Informe os Itens Verificados !");
					  return false;
				 }
					  
					  
					  
					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "eqptogr004.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
*/
