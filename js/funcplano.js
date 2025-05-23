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
   	   	  document.form1.action="menu_plano.php";
		  document.form1.submit();  
		  return true;
}

function sair(){
   	   	  document.form1.action="menuplano.php";
		  document.form1.submit();  
		  return true;
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit)
		field.value = field.value.substring(0, maxlimit);
	else 
		countfield.value = maxlimit - field.value.length;
	}


function ver_fotoplano1(foto){   
	      urln = 'arquivos/plano/'+foto
          newwindow=window.open(urln,'fotos','toolbar=no, scrollbars=yes, resizable=yes,height=600,width=800');
}

function ver_fotoplano(foto){ 
          
		  subdir = "fotos";
				  
		    
	      urln = '../planoacao/arquivos/'+subdir +"/"+foto
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
		  
	      urln = '../planos/arquivos/'+subdir +"/"+foto;
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
function validaform() {	
	
	data_inic   = document.form1.data_inic.value
	descr_plano = document.form1.descr_plano.value;
//	nome_doc    = document.form1.nome_doc.value;
    var e = document.getElementById("id_setor");
    var setorSelecionado = e.options[e.selectedIndex].value;


	if (descr_plano == ''){
		alert('Informe descricão do plano !');
		document.form1.descr_plano.focus();
		return false;
	}

  if (setorSelecionado == ''){
		alert('Selecione o Setor !');
		//document.form1.id_setor.options[0].focus(0);
		document.form1.descr_plano.focus();
		return false;
	}

    if (data_inic == '' || data_inic == '00/00/0000'){
		
		alert("Data de início invalida !");
		document.form1.data_inic.focus();
		return false;
	}

	
		
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "plangr01.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

///////////////////

function excluir_plano(id,itemex){
	
    if (confirm("Confirma a exclusão do Plano de Acão  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="plangr01.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////
function validaform2() {	
	
	data_lim    = document.form1.data_lim.value
	
	titulo      = document.form1.titulo.value;
	prazo_dias  = document.form1.prazo_dias.value;
	data_lim    = document.form1.data_lim.value;
	descr_item  = document.form1.descr_item.value;
	
    var e = document.getElementById("id_planoac");
    var planoSelecionado = e.options[e.selectedIndex].value;


    if (planoSelecionado == ''){
		alert('Selecione o Plano !');
		//document.form1.id_planoac.focus();
		document.form1.titulo.focus();
		
		return false;
	}

    if (titulo == ''){
		alert('Informe o Titulo !');
		document.form1.titulo.focus();
		return false;
	}
        
    if (prazo_dias == ''){
		alert('Informe o Prazo !');
		document.form1.prazo_dias.focus();
		return false;
	}

    if (data_lim == '' || data_lim == '00/00/0000'){
		
		alert("Data de limite invalida !");
		document.form1.prazo_dias.focus();
		return false;
	}

	/*
	if (descr_item == ''){
		alert('Informe descricão do item !');
		document.form1.descr_item.focus();
		return false;
	}
	*/
		
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "plangr02.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

///////////////////

function excluir_itemplano(id,itemex){
	
    if (confirm("Confirma a exclusão do Item do Plano de Acão  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="plangr02.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
////////////////////
function validaform3() {	
	
	
    var e = document.getElementById("id_usuario");
    var usuarioSelecionado = e.options[e.selectedIndex].value;


    if (usuarioSelecionado == ''){
		alert('Selecione o Usuário !');
		//document.form1.id_planoac.focus();
		document.form1.id_usuario.focus();
		
		return false;
	}


		
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "plangr03.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

///////////////////

function excluir_resplano(id,itemex){
	  var e = document.getElementById("id_usuario");
    var usuarioSelecionado = e.options[e.selectedIndex].value;


    if (usuarioSelecionado == ''){
		alert('Selecione o Usuário !');
		//document.form1.id_planoac.focus();
		document.form1.id_usuario.focus();
		
		return false;
	}

    if (confirm("Confirma a exclusão do responsável do Plano de Acão  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="plangr03.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////
function validaform4() {	
	
    var a = document.getElementById("id_planoac");
    var planoSelecionado = a.options[a.selectedIndex].value;

    var b = document.getElementById("id_itempl");
    var itemSelecionado = b.options[b.selectedIndex].value;
 
    var data_evento = document.form1.data_evento.value;

    var acao_ev = document.form1.acao_ev.value;
	
	if (planoSelecionado == "" ) {
		alert("Selecione um plano de acão !");
		document.form1.data_evento.focus();
		return false;
	}
	
	if (itemSelecionado == "" ) {
		alert("Selecione um item de acão !");
		document.form1.data_evento.focus();
		return false;
	}
	
	if (data_evento == "" ) {
		alert("Digite a data da acão !");
		document.form1.data_evento.focus();
		return false;
	}

	if (acao_ev == "" ) {
		alert("Digite a acão !");
		document.form1.acao_ev.focus();
		return false;
	}
		
	if (confirm("Confirma a gravação dos dados?")){
		
		document.form1.action = "plangr04.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

function excluir_evento(id,itemex){

    var a = document.getElementById("id_planoac");
    var planoSelecionado = a.options[a.selectedIndex].value;

    var b = document.getElementById("id_itempl");
    var itemSelecionado = b.options[b.selectedIndex].value;

    var acao_ev = document.form1.acao_ev.value;
	
	if (planoSelecionado == "" ) {
		alert("Selecione um plano de acão !");
		document.form1.data_evento.focus();
		return false;
	}
	
	if (itemSelecionado == "" ) {
		alert("Selecione um item de acão !");
		document.form1.data_evento.focus();
		return false;
	}
	
    if (confirm("Confirma a exclusão da Acão  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="plangr04.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
///////////////////
