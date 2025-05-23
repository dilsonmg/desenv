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
function sairex(){
   	   	  document.form1.action="menu_exped.php";
		  document.form1.submit();  
		  return true;
}

function sair(){
   	   	  document.form1.action="menu_docs.php";
		  document.form1.submit();  
		  return true;
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit)
		field.value = field.value.substring(0, maxlimit);
	else 
		countfield.value = maxlimit - field.value.length;
	}

function ver_fotofab(foto){ 
          
		  subdir = "Fabrica";
				  
		    
	      urln = '../documentos/arquivos/'+subdir +"/"+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}
///////////

function ver_foto(foto){ 
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
			   case "10":
					subdir = "Representantes";
					break; 

		  }
		  
		    
	      urln = 'arquivos/'+subdir +"/"+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}

function ver_foto2(foto,setor_dc){ 
   //       var setor_doc = document.form1.setor_doc.value
		  switch (setor_dc)
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
			   case "10":
					subdir = "Representantes";
					break; 

		  }
		  
	      urln = '../documentos/arquivos/'+subdir +"/"+foto;
		  		    //alert(setor_dc);

          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
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

////////////////////
function validaformlb() {

	/*if (
	//document.form1.tipo[0].checked == false &&
	//document.form1.tipo[1].checked == false && 
	//document.form1.tipo[2].checked == false  
		document.getElementById('tipo').checked == false
		
		
		){
		alert("Informe o Tipo da Requisição !")
		document.form1.tipo[0].focus();
		return false;
	}
	*/
	
	
	data_autor  = document.form1.data_autor.value
	descr_docto = document.form1.descr_docto.value;
	num_paginas = document.form1.num_paginas.value;
//	nome_doc    = document.form1.nome_doc.value;


    if (data_autor == '' || data_autor == '00/00/0000'){
		
		alert("Data de autorizacao invalida !");
		document.form1.data_autor.focus();
		return false;
	}

	
	if (num_paginas == '' || num_paginas == 0){
		alert('Informe o numero de paginas do documento !');
		document.form1.num_paginas.focus();
		return false;
	}
		
	if (document.form1.descr_docto.value == ''){
		alert("Informe a descricao do documento ! ");
		document.form1.descr_docto.focus();
		return false;
		}
/*
	if (document.form1.nome_doc.value == ''){
		alert("Informe a nome do documento ! ");
		document.form1.nome_doc.focus();
		return false;
		}
*/
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "doctoaugr.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}


///////////////////

function validaform() {

	/*if (
	//document.form1.tipo[0].checked == false &&
	//document.form1.tipo[1].checked == false && 
	//document.form1.tipo[2].checked == false  
		document.getElementById('tipo').checked == false
		
		
		){
		alert("Informe o Tipo da Requisição !")
		document.form1.tipo[0].focus();
		return false;
	}
	*/
	descr_docto = document.form1.descr_docto.value;
	num_paginas = document.form1.num_paginas.value;
//	nome_doc    = document.form1.nome_doc.value;
	
	if (num_paginas == '' || num_paginas == 0){
		alert('Informe o numero de paginas do documento !');
		document.form1.num_paginas.focus();
		return false;
	}
		
	if (document.form1.descr_docto.value == ''){
		alert("Informe a descricao do documento ! ");
		document.form1.descr_docto.focus();
		return false;
		}
/*
	if (document.form1.nome_doc.value == ''){
		alert("Informe a nome do documento ! ");
		document.form1.nome_doc.focus();
		return false;
		}
*/
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "doctogr01.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

function excluir_docto(id,itemex){
	
    if (confirm("Confirma a exclusão do item  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="doctogr01.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
