///////////publicaçoes//////////////////
/**
 * Array de objectos de qual caracter deve substituir seu par com acentos
*/ 

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

function verlink(){  
      var cpo1 = document.form1.n_contrato2.value;
	  var cpo2 = document.form1.contratada2.value;
	  var cpo3 = document.form1.data_ass2.value;
	  var cpo4 = document.form1.termino_cont2.value;
	  var cpo41 = document.form1.local2.value;
	  //alert("entrou1");
	  
	  document.form1.action="cad_contrato.php?n_contrato="+cpo1+"&contratada="+cpo2+"&data_ass="+cpo3+"&termino_cont="+cpo4+"&local="+cpo41;
	  document.form1.submit();
	  
}

function voltar(){
   document.form1.action="menu_exped.php";
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


function validaform(){
var data_receb     = document.form1.data_receb.value;

var pedido         = document.form1.pedido.value;

var nfiscal        = document.form1.nfiscal.value;

var num_lote       = document.form1.num_lote.value;

if (data_receb == ""){

  //  document.form1.trecho.value="BH -  Rib. Preto / Rib. Preto - BH";
    alert("Informe a data de recebimento !");
	document.form1.data_receb.value="";
	document.form1.data_receb.focus(); 
	return false;
	}
		
if (pedido == ""){
    alert("Informe o número do pedido !");
	document.form1.pedido.value="";
	document.form1.pedido.focus(); 
	return false;
	}
if (nfiscal == ""){
    alert("Informe os dados da nota fiscal !");
	document.form1.nfiscal.value="";
	document.form1.nfiscal.focus(); 
	return false;
	}			


if (num_lote == ""){
    alert("Informe o numero do lote !");
	document.form1.num_lote.value= nfiscal + "/" + data_receb.substring(6);
	document.form1.num_lote.focus(); 
	return false;
	}			


	//alert(situacao);
    if (confirm("Confirma a gravação dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 document.form1.action = "gravar_avaliacao.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
function excluir(){
    if (confirm("Confirma a exclusão dos dados ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="gravar_avaliacao.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
function novo(){
  document.location.href='dados_entrega.php';
		  return true;
}

