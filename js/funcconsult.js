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
   	   	  document.form1.action="../comissoes/menu_comercial.php";
		  document.form1.submit();  
		  return true;

}

function resetForm(){
    if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="treinaex0001.php";
		  document.form1.submit();  
		  return true;
		  }

}


function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit)
		field.value = field.value.substring(0, maxlimit);
	else 
		countfield.value = maxlimit - field.value.length;
	}

function ver_foto(foto){   
	      urln = 'doc_consult/'+foto
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

function validaitcontr() {
			  
				   descr       = document.form1.descr_itcontr.value;	
		           if (descr == ""){
					  alert ("Informe a descrição  !");
					  document.form1.descr_itcontr.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "consultgr002.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluiritcontr(){
	
    if (confirm("Confirma a exclusão ?")){
   	   	  document.form1.action="consultgr002.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////////////

function validaformacao() {
			  
	 descr       = document.form1.descr_formprof.value;	
     if (descr == ""){
					  alert ("Informe a descrição  !");
					  document.form1.descr_formprof.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "consultgr003.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirformacao(){
	
    if (confirm("Confirma a exclusão ?")){
   	   	  document.form1.action="consultgr003.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
////////////////////////////////////////////////////////////////////

function validaconform() {
			  
	               var id_consult = document.form1.id_consult.options[document.form1.id_consult.selectedIndex].value;
				  
				   var id_formprof    = document.form1.id_formprof.options[document.form1.id_formprof.selectedIndex].value;
			//	    alert("entrou");
		           if (id_consult == ""){
					  alert ("Selecione o consultor !");
					  document.form1.id_consult.focus();
					  return false; }
					  					  
				   if (id_formprof == "" ) { 
					  alert ("Informe a Formação");
					  document.form1.id_formprof.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "consultgr004.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirconform(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="consultgr004.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_pericontr() {
			       var periodicid = document.form1.periodicid.value;
				   
	               var id_consult = document.form1.id_consult.options[document.form1.id_consult.selectedIndex].value;
				  
				   var id_itcontr    = document.form1.id_itcontr.options[document.form1.id_itcontr.selectedIndex].value;
			//	    alert("entrou");
		           if (id_consult == ""){
					  alert ("Selecione o consultor !");
					  document.form1.id_consult.focus();
					  return false; }
					  					  
				   if (id_itcontr == "" ) { 
					  alert ("Selecione o item de controle !");
					  document.form1.id_itcontr.focus();
					  return false; }

				   if (periodicid == "" ) { 
					  alert ("Informe a periodicidade !");
					  document.form1.periodicid.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "consultgr005.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluir_pericontr(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="consultgr005.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_acomp() {
			       var data_realiz = document.form1.data_realiz.value;
	               var id_consult = document.form1.id_consult.options[document.form1.id_consult.selectedIndex].value;
 
				   var id_pericontr    = document.form1.id_pericontr.options[document.form1.id_pericontr.selectedIndex].value;
			//	    
			   
		           if (id_consult == ""){
					  alert ("Selecione o Consultor !");
					  document.form1.id_consult.focus();
					  return false; }
					  					  
				   if (id_pericontr == "" ) { 
					  alert ("Selecione o Item de Controle !");
					  document.form1.id_pericontr.focus();
					  return false; }

				   if (data_realiz == "" ) { 
					  alert ("Informe a Data !");
					  document.form1.data_realiz.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "consultgr006.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluir_acomp(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="consultgr006.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////


function valida_comprovr() {
	
				   
	               var id_consult  = document.form1.id_consult.options[document.form1.id_consult.selectedIndex].value;
				   var data_compr  = document.form1.data_compr.value;
		           var descr_compr = document.form1.descr_compr.value;
				  
	
			//	    alert("entrou");
		           if (id_consult == ""){
					  alert ("Selecione o consultor !");
					  document.form1.id_consult.focus();
					  return false; }
					  					  
				   if (descr_compr == "" ) { 
					  alert ("Informe a Descrição !");
					  document.form1.descr_compr.focus();
					  return false; }

				   if (data_compr == "" ) { 
					  alert ("Informe a Data !");
					  document.form1.data_compr.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "consultgr007.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluir_comprovr(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="consultgr007.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////

