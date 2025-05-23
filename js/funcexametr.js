
  // Desabilitar a exibição do código-fonte
  document.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.key === 'u') {
      event.preventDefault();
      alert('Exibição do código-fonte desabilitada!');
  }
 });

window.onkeydown = function() {
   var key = event.keyCode || event.charCode || e.which;
   if(key==17){ alert('copia ok'); return false; }
}

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
   	   	  document.form1.action="../exames/menu_extr.php";
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

function ver_foto2(foto){   
	      urln = 'foto_func/'+foto
          newwindow=window.open(urln,'fotos','toolbar=no, scrollbars=yes, resizable=yes,height=600,width=800');
}

function ver_foto(foto){   
	      urln = 'doc_exame/'+foto
          newwindow=window.open(urln,'fotos','toolbar=no, scrollbars=yes, resizable=yes,height=600,width=800');
}
function ver_fotoepi(foto){   
	      urln = 'foto_epi/'+foto
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

function validaexametr() {
			  
				   descr       = document.form1.descr_exametr.value;	
				   tipo        = document.form1.tipo.value;
		           if (descr == ""){
					  alert ("Informe a descrição  !");
					  document.form1.descr_exametr.focus();
					  return false; }
				   if (tipo == "" ) { 
					  alert ("Informe o tipo !");
					  document.form1.tipo.value = "";
					  document.form1.tipo.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "treinaexgr001.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirexametr(){
	
    if (confirm("Confirma a exclusão ?")){
   	   	  document.form1.action="treinaexgr001.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////////////

function validafuncao() {
			  
	 descr       = document.form1.descr_funcao.value;	
     if (descr == ""){
					  alert ("Informe a descrição  !");
					  document.form1.descr_funcao.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "treinaexgr002.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirfuncao(){
	
    if (confirm("Confirma a exclusão ?")){
   	   	  document.form1.action="treinaexgr002.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
////////////////////////////////////////////////////////////////////

function valida_usufunc() {
			  
	               var id_usuario = document.form1.id_usuario.options[document.form1.id_usuario.selectedIndex].value;
				  
				   var id_funcao    = document.form1.id_funcao.options[document.form1.id_funcao.selectedIndex].value;
			//	    alert("entrou");
		           if (id_usuario == ""){
					  alert ("Selecione o usuario !");
					  document.form1.id_usuario.focus();
					  return false; }
					  					  
				   if (id_funcao == "" ) { 
					  alert ("Informe a Função");
					  document.form1.id_funcao.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "treinaexgr003.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluir_usufunc(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="treinaexgr003.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_usuexame() {
			       var periodicid = document.form1.periodicid.value;
				   
	               var id_usuario = document.form1.id_usuario.options[document.form1.id_usuario.selectedIndex].value;
				  
				   var id_exametr    = document.form1.id_exametr.options[document.form1.id_exametr.selectedIndex].value;
			//	    alert("entrou");
		           if (id_usuario == ""){
					  alert ("Selecione o usuario !");
					  document.form1.id_usuario.focus();
					  return false; }
					  					  
				   if (id_exametr == "" ) { 
					  alert ("Selecione o Exame / Treinamento !");
					  document.form1.id_exametr.focus();
					  return false; }

				   if (periodicid == "" ) { 
					  alert ("Informe a periodicidade !");
					  document.form1.periodicid.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "treinaexgr004.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluir_usuexame(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="treinaexgr004.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_acomp() {
			       var data_realiz = document.form1.data_realiz.value;
				   
	               var id_usuario = document.form1.id_usuario.options[document.form1.id_usuario.selectedIndex].value;
				  
				   var id_usuexametr    = document.form1.id_usuexametr.options[document.form1.id_usuexametr.selectedIndex].value;
			//	    alert("entrou");
		           if (id_usuario == ""){
					  alert ("Selecione o usuario !");
					  document.form1.id_usuario.focus();
					  return false; }
					  					  
				   if (id_usuexametr == "" ) { 
					  alert ("Selecione o Exame / Treinamento !");
					  document.form1.id_usuexametr.focus();
					  return false; }

				   if (data_realiz == "" ) { 
					  alert ("Informe a Data !");
					  document.form1.data_realiz.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "treinaexgr005.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluir_acomp(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="treinaexgr005.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_comprov2() {
	
				   
	               var id_usuario  = document.form1.id_usuario.options[document.form1.id_usuario.selectedIndex].value;
				   var data_compr  = document.form1.data_compr.value;
		           var descr_compr = document.form1.descr_compr.value;
				  
	
			//	    alert("entrou");
		           if (id_usuario == ""){
					  alert ("Selecione o usuario !");
					  document.form1.id_usuario.focus();
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
	 document.form1.action = "treinaexgr007.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluir_comprov2(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="treinaexgr007.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_comprovd() {
					   
				   var data_compr  = document.form1.data_compr.value;
		           var descr_compr = document.form1.descr_compr.value;
				  					  					  
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
	 document.form1.action = "treinaexgr009.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	


function excluir_comprovd(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="treinaexgr009.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

//////////////////////////////////////////////////////////////

function validaform_epi() {
					   
				 //  var descr_epi  = document.form1.descr_epi.value;
		          // var unid_epi = document.form1.unid_epi.value;
				  					  					  
				 /*
				   if (descr_epi == "" ) { 
					  alert ("Informe a Descrição !");
					  document.form1.descr_epi.focus();
					  return false; }

				   if (unid_epi == "" ) { 
					  alert ("Informe a unidade !");
					  document.form1.unid_epi.focus();
					  return false; }
	             */
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "epigr01.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluir_epi(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="epigr01.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////////////

function valida_depi() {
			  
	               var id_usuario = document.form1.id_usuario.options[document.form1.id_usuario.selectedIndex].value;
				  
				   var cod_prod    = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
						//  alert("entrou");
	   
				   var quant_receb = document.form1.quant_receb.value;
			//	    alert("entrou");
		           if (id_usuario == ""){
					  alert ("Selecione o usuario !");
					  document.form1.id_usuario.focus();
					  return false; }
					  					  
				   if (cod_prod == "" ) { 
					  alert ("Selecione o EPI");
					  document.form1.cod_prod.focus();
					  return false; }
	
				   if (quant_receb == "" ) { 
					  alert ("Informe a quantidade entregue !");
					  document.form1.quant_receb.focus();
					  return false; }

	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "epigr002.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluir_depi(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="epigr002.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////

				 
function excl_validepi() {
	
	  var cod_prod = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  
	  var mes_valepi = document.form1.mes_valepi.value;
	  
	  
	  if (cod_prod == "") {
		  alert("Selecione o codigo do Item !");
		  return false;
	  }
	  
		  
	  if (mes_valepi == "") {
		  alert("Informe a validade do Item !");
		  return false;
	  }
				  
	
	  if (confirm("Confirma a gravacão dos Dados ?")){
   	   	  document.form1.action="epigr004.php?gravar=i";
		  document.form1.submit();  
		  return true;
		  } 
				   
	 	 return true;

}	

function excluir_mesepi(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="epigr004.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_grupoepi(){
				  	   
   var descr_grupo = document.form1.descr_grupo.value;
			   // alert("entrou");
					  					  
   if (descr_grupo == "" ) { 
		alert ("Informe o grupo  !");
		document.form1.descr_grupo.focus();
		return false; }

	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "epigr005.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
	
function excluir_grupoepi(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="epigr005.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////

function valida_decl(){
				  	   
   var descr_decl = document.form1.descr_declara.value; 
   //alert("entrou");
   var data_decl  = document.form1.data_decl.value;
   var declara    = document.form1.declara.value;
			  
					  					  
   if (descr_decl == "" ) { 
		alert ("Informe o descricao  !");
		document.form1.descr_declara.focus();
		return false; }
 
   if (data_decl == "" ) { 
		alert ("Informe a Data  !");
		document.form1.data_decl.focus();
		return false; }

   if (declara == "" ) { 
		alert ("Informe  desclaracão  !");
		document.form1.declara.focus();
		return false; }

	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "epigr006.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}
	
function excluir_decl(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="epigr006.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////////////////////////////////////////////
	
////////////////////////////////////////////////////////////////////


	