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

function checarDatas(data_desp) {
   var form_insere = document.form1;
  var data_1 = new Date(form_insere.data_ini.value);
  var data_2 = new Date(form_insere.data_fim.value);
  var data_3 = new Date(form_insere.data_desp.value);

 // alert(data_3);

	
    if (data_3 > data_2) {
        alert("Data não pode ser maior que a data final");
		form_insere.data_desp.value = '';
        return false;
    } else {
	       if (data_3 < data_1) {
              alert("Data não pode ser menor que a data inicial");
			  form_insere.data_desp.value = '';
              return false;
           } 
        return true
    }
}


function sair()
{	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="menu_visita.php";
		  document.form1.submit();  
		  return true;

}



function resetForm(){
		 document.form1.reset();
		 document.form1.submit();  
		 return true;
}


function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit){
		field.value = field.value.substring(0, maxlimit);}
	else {
		countfield.value = maxlimit - field.value.length;}
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
   else{
	    if(texto.length ==5){ 
          campo.value = texto + "/"; }
   }
}
////-----------------//////////////
function atualiza(){
   document.form1.submit();	
}
function validaitdesprdv(){
	   descri_desp  = document.form1.descri_desp.value;

       if (descri_desp == ""){
		   alert("Informe a Descricao !");
		   document.form1.descri_desp.focus();
		   return false;
	   }
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "rdvr001.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluiritdesprdv(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";

    	 document.form1.action = "rdvr001.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
////
function validardvkm(){

	   veiculo  = document.form1.veiculo.value;	
	   placa    = document.form1.placa.value;
	   km_inicio = document.form1.km_inicio.value;
	   periodo_i  = document.form1.periodo_i.value;
	   periodo_f  = document.form1.periodo_f.value;

       if (veiculo == ""){
		   alert("Informe o Veiculo !");
		   document.form1.veiculo.focus();
		   return false;
	   }
	   if (placa == ""){
		   alert("Informe a Placa do Veiculo !");
		   document.form1.placa.focus();
		   return false;
	   }
	   if (km_inicio == ""){
		   alert("Informe o Km Inicial !");
		   document.form1.km_inicio.focus();
		   return false;
	   }
	   if (periodo_i == ""){
		   alert("Informe o periodo inicial !");
		   document.form1.periodo_i.focus();
		   return false;
	   }
	   if (periodo_f == ""){
		   alert("Informe o periodo final !");
		   document.form1.periodo_f.focus();
		   return false;
	   }
	   
	   
	   
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "rdvr002.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluirdvkm(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";

    	 document.form1.action = "rdvr002.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
//////

function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}
/////////////////////
