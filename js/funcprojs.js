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





function sair(){
   	   	  document.form1.action="menu_exped.php";
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
     /*    
	  subdir = document.form1.id_projeto.value;
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
		  */
		    
	      urln = 'projetos/'+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}
function ver_foto1(foto,sdir){ 
         
	      var subdir = sdir;
	 	    
	      urln = 'projetos/'+subdir+"/"+foto
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
	descr_projeto   = document.form1.descr_projeto.value;
	
	solicitante     = document.form1.solicitante.value;
	
    data_abertura    = document.form1.data_abertura.value;
	
	arq_instr   = document.form1.arq_instr.value;
	
	data_prevtermino   = document.form1.data_prevtermino.value;
	//alert("entrou");
		
	if (document.form1.descr_projeto.value == ''){
		alert("Informe a descricao do projeto ! ");
		document.form1.descr_projeto.focus();
		return false;
		}
		
	if (document.form1.solicitante.value == ''){
		alert("Informe o solicitante ! ");
		document.form1.solicitante.focus();
		return false;
		}
		
	if (document.form1.data_abertura.value == ''){
		alert("Informe a data de abertura ! ");
		document.form1.data_abertura.focus();
		return false;
		}
		
    if (document.form1.arq_instr.value == '' && document.form1.doc_abertura1.value == ''){
		alert("Anexe o documento de abertura ! ");
		document.form1.arq_instr.focus();
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
		document.form1.action = "projgr01.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

function excluir_projeto(id,itemex){
	
    if (confirm("Confirma a exclusão do projeto  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="projgr01.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}


function validaparam_conce(){
	   desc_paramestd  = document.form1.desc_paramestd.value;

       if (desc_paramestd == ""){
		   alert("Informe a Descricao !");
		   return false;
	   }
	   if (confirm("Confirma a gravação dos dados?")){
		//
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr02.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluirparamestd(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";

    	 document.form1.action = "projgr02.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

//////////////////////////////////////////////////////
function validaambiente(){
	   descr_ambiente  = document.form1.descr_ambiente.value;

       if (descr_ambiente == ""){
		   alert("Informe a Descricao !");
		   return false;
	   }
	   if (confirm("Confirma a gravação dos dados?")){
		//
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr06.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluirambiente(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";

    	 document.form1.action = "projgr06.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

//////////////////////////////////////////////////////
function validaparamestd() {
	
   id_projeto    = document.form1.id_projeto.options[document.form1.id_projeto.selectedIndex].value;
   id_paramestd  = document.form1.id_paramestd.options[document.form1.id_paramestd.selectedIndex].value;
   data_estudo   = document.form1.data_estudo.value;
   descri_estudo = document.form1.descri_estudo.value;
		    
    if(id_projeto == ""){
	    alert("Selecione o Projeto !");
	    document.form1.id_projeto.focus();
		return false;
	}
    if(id_paramestd == ""){
	    alert("Selecione o Parametro de estudo !");
	    document.form1.id_paramestd.focus();
		return false;
	}
	if(data_estudo == ""){
	    alert("Informe a data do estudo !");
	    document.form1.data_estudo.focus();
		return false;
	}
	if(descri_estudo == ""){
	    alert("Informe os Resultados !");
	    document.form1.descri_estudo.focus();
		return false;
	}
	
	
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr03.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}	
}

function excluirparamestd(){
	if (confirm("Confirma a exclusão dos dados?")){
	   	 document.form1.action = "projgr03.php?gravar=E";
	     document.form1.submit();
	 	 return true;

	}
}

////////////////////////////


function validaformula() {
	
   var id_projeto    = document.form1.id_projeto.options[document.form1.id_projeto.selectedIndex].value;
   var mprima        = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
   var id_paramestd  = document.form1.id_paramestd.options[document.form1.id_paramestd.selectedIndex].value;

   kg_param      = document.form1.kg_param.value;
   
   perc_param    = document.form1.perc_param.value;
		    
    if(id_projeto == ""){
	    alert("Selecione o Projeto !");
	    document.form1.id_projeto.focus();
		return false;
	}
    if(mprima == ""){
	    alert("Selecione a Materia Prima !");
	    document.form1.cod_prod.focus();
		return false;
	}	
    if(id_paramestd == ""){
	    alert("Selecione o Parametro de estudo !");
	    document.form1.id_paramestd.focus();
		return false;
	}
	if(kg_param == "" && perc_param == ""){
	    alert("Informe a quantidade de KG!");
		//document.getElementById('kg_param').setAttribute('readonly',false);
	    document.form1.kg_param.focus();
		return false;
	}
	
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr04.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}	
}

function excluirformula(){
	if (confirm("Confirma a exclusão dos dados?")){
	   	 document.form1.action = "projgr04.php?gravar=E";
	     document.form1.submit();
	 	 return true;

	}
}


///////////////////////////

//////////////////////////////////////////////////////
function validaacomp() {
	
   id_projeto    = document.form1.id_projeto.options[document.form1.id_projeto.selectedIndex].value;
   id_ambiente   = document.form1.id_ambiente.options[document.form1.id_ambiente.selectedIndex].value;
   id_paramestd  = document.form1.id_paramestd.options[document.form1.id_paramestd.selectedIndex].value;

   semana        = document.form1.semana.value;
   fermentacao   = document.form1.fermentacao.value;
   fung_bact     = document.form1.fung_bact.value;
   cor_param     = document.form1.cor_param.value;
   class_param   = document.form1.class_param.value;
		    
    if(id_projeto == ""){
	    alert("Selecione o Projeto !");
	    document.form1.id_projeto.focus();
		return false;
	}
    if(id_ambiente == ""){
	    alert("Selecione o ambiente de estudo !");
	    document.form1.id_ambiente.focus();
		return false;
	}
    if(id_paramestd == ""){
	    alert("Selecione o Parametro de estudo !");
	    document.form1.id_paramestd.focus();
		return false;
	}

	if(semana == ""){
	    alert("Informe a semana do estudo !");
	    document.form1.semana.focus();
		return false;
	}
	if(fermentacao == ""){
	    alert("Informe se houve fermentacao !");
	    document.form1.fermentacao.focus();
		return false;
	}	
	if(fung_bact == ""){
	    alert("Informe se houve fungos e bacterias !");
	    document.form1.fung_bact.focus();
		return false;
	}
	if(cor_param == ""){
	    alert("Informe a cor !");
	    document.form1.cor_param.focus();
		return false;
	}
	if(class_param == ""){
	    alert("Informe a classificacao !");
	    document.form1.class_param.focus();
		return false;
	}
	
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr07.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}	
}

function excluiracomp(){
	if (confirm("Confirma a exclusão dos dados?")){
	   	 document.form1.action = "projgr07.php?gravar=E";
	     document.form1.submit();
	 	 return true;

	}
}

////////////////////////////

//////////////////////////////////////////////////////
function validadocproj() {
	
   id_projeto    = document.form1.id_projeto.options[document.form1.id_projeto.selectedIndex].value;

   descricao     = document.form1.descr_doc.value;
   data_doc      = document.form1.data_doc.value;
   responsavel   = document.form1.resp_doc.value;
		    
    if(id_projeto == ""){
	    alert("Selecione o Projeto !");
	    document.form1.id_projeto.focus();
		return false;
	}
    if(descricao == ""){
	    alert("Informe a descricao do documento !");
	    document.form1.descr_doc.focus();
		return false;
	}
	if(responsavel == ""){
	    alert("Informe o responsavel pelo documento !");
	    document.form1.resp_doc.focus();
		return false;
	}
    if(data_doc == ""){
	    alert("Informe a data do documento !");
	    document.form1.data_doc.focus();
		return false;
	}

	
	    if (document.form1.arq_instr.value == '' && document.form1.nome_doc1.value == ''){
		alert("Anexe o documento do Projeto ! ");
		document.form1.arq_instr.focus();
		return false;
		}

	
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "projgr08.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}	
}

function excluirdocproj(){
	if (confirm("Confirma a exclusão dos dados?")){
	   	 document.form1.action = "projgr08.php?gravar=E";
	     document.form1.submit();
	 	 return true;

	}
}

////////////////////////////