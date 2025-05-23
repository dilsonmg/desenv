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
   	   	  document.form1.action="menueqpto.php";
		  document.form1.submit();  
		  return true;

}

function resetForm(){
    if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="eqpto0002.php";
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

function validaform() {
			  
				   descr       = document.form1.descr_eqpto.value;	
				   localizacao = document.form1.localizacao.value;
		           if (descr == ""){
					  alert ("Informe a descrição do Equipamento !");
					  document.form1.descr_eqpto.focus();
					  return false; }
				   if (localizacao == "" ) { 
					  alert ("Informe a localizacao do Equipamento !");
					  document.form1.localizacao.value = "";
					  document.form1.localizacao.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "eqptogr001.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluireqpto(){
	
    if (confirm("Confirma a exclusão do Equipamento?")){
   	   	  document.form1.action="eqptogr001.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function validaitman() {
			  
				   descr_itman = document.form1.descr_itman.value;	
		//		   periodicid  = document.form1.periodicid.value;
		           if (descr_itman == ""){
					  alert ("Informe a descrição do Item de Manutenção !");
					  document.form1.descr_itman.focus();
					  return false; }
				/*
				   if (periodicid == "" ) { 
					  alert ("Informe a Periodicidade !");
					  document.form1.periodicid.value = "";
					  document.form1.periodicid.focus();
					  return false; }
	*/
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "eqptogr003.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluiritman(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr003.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
////////////////////////////////////////////////////////////

function validaplan() {
			  
	               var id_evento = document.form1.id_evento.options[document.form1.id_evento.selectedIndex].value;
				  
				   var id_eqpto    = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
			//	    alert("entrou");
				   periodic  = document.form1.periodic.value;
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
					  					  
				   if (id_evento == "" ) { 
					  alert ("Informe o vento");
					  document.form1.id_evento.focus();
					  return false; }

				   if (periodic == "" ) { 
					  alert ("Informe a periodicidade");
					  document.form1.periodic.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "eqptogr009.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirplan(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr009.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}



////////////////////////////////////////////////////////////
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
function excluirchkman(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr004.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

////////////////////
function validapecait() {
	               var id_itemmanu  = document.form1.id_itemmanu.options[document.form1.id_itemmanu.selectedIndex].value;
				   var id_eqpto     = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var descr_pecait = document.form1.descr_pecait.value;	
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
				   if (descr_pecait == ""){
					  alert ("Informe a descrição da peça !");
					  document.form1.descr_pecait.focus();
					  return false; }
					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr005.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluirpecait(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr005.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

///////////////////

////////////////////
function validapecait7() {
	               var id_itemmanu  = document.form1.id_itemmanu.options[document.form1.id_itemmanu.selectedIndex].value;
				   var id_eqpto     = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var id_pecait    = document.form1.id_pecait.options[document.form1.id_pecait.selectedIndex].value;

				   var data_ent     = document.form1.data_ent.value;	
				   var quant_ent    = document.form1.quant_ent.value;	
				   
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
				   if (id_pecait == ""){
					  alert ("Selecione a peca !");
					  document.form1.id_pecait.focus();
					  return false; }
				   if (data_ent == ""){
					  alert ("Informe a data de entrada !");
					  document.form1.data_ent.focus();
					  return false; }
				   if (quant_ent == ""){
					  alert ("Informe a quantidade !");
					  document.form1.quant_ent.focus();
					  return false; }
					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr007.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluirpecait7(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr007.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

///////////////////

function validaevento(){
	 var descr_evento    = document.form1.descr_evento.value;	
				   
				   
		           if (descr_evento == ""){
					  alert ("Informe o Evento !");
					  document.form1.descr_evento.focus();
					  return false; }

					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr011.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluirevento(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr011.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
	



////////////////////
function validapecait8() {
	               var id_itemmanu  = document.form1.id_itemmanu.options[document.form1.id_itemmanu.selectedIndex].value;
				   var id_eqpto     = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var id_pecait    = document.form1.id_pecait.options[document.form1.id_pecait.selectedIndex].value;

				   var data_said     = document.form1.data_said.value;	
				   var quant_said    = document.form1.quant_said.value;	
				   
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
				   if (id_pecait == ""){
					  alert ("Selecione a peca !");
					  document.form1.id_pecait.focus();
					  return false; }
				   if (data_said == ""){
					  alert ("Informe a data de saida !");
					  document.form1.data_said.focus();
					  return false; }
				   if (quant_said == ""){
					  alert ("Informe a quantidade !");
					  document.form1.quant_said.focus();
					  return false; }
					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr008.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluirpecait8(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr008.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

///////////////////


function validasubpeca() {
	               var id_itemmanu  = document.form1.id_itemmanu.options[document.form1.id_itemmanu.selectedIndex].value;
				   var id_eqpto     = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var id_pecait    = document.form1.id_pecait.options[document.form1.id_pecait.selectedIndex].value;

				   var quantid      = document.form1.quantid.value;	
				   var data_sub     = document.form1.data_sub.value;	
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
				   if (id_pecait == ""){
					  alert ("Selecione a Peça !");
					  document.form1.id_pecait.focus();
					  return false; }
					  
				 if (data_sub.substring(0,2) == "" ){
					  alert ("Informe a data da troca da peça !");
					  document.form1.data_sub.focus();		 
					  return false;}
	
			    if (isNaN(quantid) || quantid == 0){
					  alert ("Informe a quantidade de peça !");
					  document.form1.quantid.focus();
					  return false; }

				  					  
					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr006.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluirsubpeca(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr006.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
function validalceqpto() {

                   id_eqpto      = document.form1.id_eqpto.value;
				   id_fornec     = document.form1.id_fornec.value;			   
				   os_num        = document.form1.os_num.value;				   
				   vlr_conserto  = document.form1.vlr_conserto.value;	
				   data_conserto = document.form1.data_conserto.value;


		        if (id_eqpto == ""){
					  alert ("Informe o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				if (id_fornec == "" ) { 
					  alert ("Informe o fornecedor !");
					  document.form1.id_fornec.value = "";
					  document.form1.id_fornec.focus();
					  return false; }
					  
				if (os_num == '' ) { 
					  alert ("Informe o num da OS !");
					  document.form1.os_num.value = "";
					  document.form1.os_num.focus();
					  return false; }
					  
				if (data_conserto == '' ) { 
					  alert ("Informe a data do conserto !");
					  document.form1.data_conserto.value = "";
					  document.form1.data_conserto.focus();
					  return false; }
					  
			   if (vlr_conserto == 0.00 ) { 
					  alert ("Informe o valor do conserto !");
					  document.form1.vlr_conserto.value = "0.00";
					  document.form1.vlr_conserto.focus();
					  return false; }				  
					  
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";	 
	 
	 document.form1.action = "eqptogr002.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	

function excluirlceqpto(){
	
   if (confirm("Confirma a exclusão do lancamento para o Equipamento?")){
   	   	  document.form1.action="eqptogr002.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
	
}


//////////////////////////////////////////
function valida_acomppl() {
	               var id_itemmanu  = document.form1.id_plmanut.options[document.form1.id_plmanut.selectedIndex].value;
				   var id_eqpto     = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var data_serv    = document.form1.data_serv.value;	
				   
		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (id_itemmanu == ""){
					  alert ("Selecione o Item de Manutenção !");
					  document.form1.id_itemmanu.focus();
					  return false; }
					  
				 if (data_serv.substring(0,2) == "" ){
					  alert ("Informe a data da troca da peça !");
					  document.form1.data_serv.focus();		 
					  return false;}
		  					  
	//////////compara a data para nao ser menor que a data do dia ///////
/*
			hoje = new Date();
			var strData = data_serv;
			var partesData = strData.split("/");
			var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
			if(data < new Date()){
			   alert("A data informada nao pode ser menor que a data do dia!" + hoje);
			   return false;
			   }
*/			   
/////////////////////////////////////////////////////////////////////					  
				  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptogr012.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluir_acomppl(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptogr012.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function validaform_ferr() {
			  
				   descr_ferram       = document.form1.descr_ferram.value;	
		           if (descr_ferram == ""){
					  alert ("Informe a descrição da Ferramenta !");
					  document.form1.descr_ferram.focus();
					  return false; }

	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
	 
	 
	 document.form1.action = "eqpto_fergr001.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirferr(){
	
	 id       = document.form1.id.value;	
	 if (id == ""){
		alert ("Selecione a  Ferramenta !");
		document.form1.descr_ferram.focus();
		return false; }
	
	
    if (confirm("Confirma a exclusão do Equipamento?"+id)){
   	   	  document.form1.action="eqpto_fergr001.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}


////////////////////////////////////////////////////////////

function validaplanferr() {
			  
	               var id_evento = document.form1.id_evento.options[document.form1.id_evento.selectedIndex].value;
				  
				   var id_ferram = document.form1.id_ferram.options[document.form1.id_ferram.selectedIndex].value;
				 //   alert("entrou");
				   periodic  = document.form1.periodic.value;
		           if (id_ferram == ""){
					  alert ("Selecione a Ferramenta !");
					  document.form1.id_ferram.focus();
					  return false; }
					  					  
				   if (id_evento == "" ) { 
					  alert ("Informe o vento");
					  document.form1.id_evento.focus();
					  return false; }

				   if (periodic == "" ) { 
					  alert ("Informe a periodicidade");
					  document.form1.periodic.focus();
					  return false; }
	
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	 document.form1.action = "eqpto_fergr009.php?gravar=I";
	 document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}	
function excluirplanferr(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqpto_fergr009.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////
function valida_acompplferr() {
	               var id_periodferr  = document.form1.id_periodferr.options[document.form1.id_periodferr.selectedIndex].value;
				   var id_ferram      = document.form1.id_ferram.options[document.form1.id_ferram.selectedIndex].value;
				   var data_serv    = document.form1.data_serv.value;	
				   
		           if (id_ferram == ""){
					  alert ("Selecione a Ferramenta !");
					  document.form1.id_ferram.focus();
					  return false; }
				   if (id_periodferr == ""){
					  alert ("Selecione o Item  !");
					  document.form1.id_periodferr.focus();
					  return false; }
					  
				 if (data_serv.substring(0,2) == "" ){
					  alert ("Informe a data da troca da peça !");
					  document.form1.data_serv.focus();		 
					  return false;}
					  
//////////compara a data para nao ser menor que a data do dia ///////
/*
			hoje = new Date();
			var strData = data_serv;
			var partesData = strData.split("/");
			var data = new Date(partesData[2], partesData[1] - 1, partesData[0]);
			if(data < new Date()){
			   alert("A data informada nao pode ser menor que a data do dia." + hoje);
			   return false;}
*/			   
/////////////////////////////////////////////////////////////////////					  
		  					  
					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqpto_fergr012.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluir_acompplferr(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqpto_fergr012.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

//////////////////////////////////////////

function val_contr() {
	
	               var id_eqpto  = document.form1.id_eqpto.options[document.form1.id_eqpto.selectedIndex].value;
				   var data_cont   = document.form1.data_cont.value;	
				   var hora_inic   = document.form1.hora_inic.value;	
				   var hora_fim    = document.form1.hora_fim.value;	

		           if (id_eqpto == ""){
					  alert ("Selecione o Equipamento !");
					  document.form1.id_eqpto.focus();
					  return false; }
				   if (data_cont.substring(0,2) == ""){
					  alert ("Informe a data  !");
					  document.form1.data_cont.focus();
					  return false; }
					  
				 if (hora_inic == "" ){
					  alert ("Informe a hora Inicial !");
					  document.form1.hora_inic.focus();		 
					  return false;}

				 if (hora_fim == "" ){
					  alert ("Informe a hora Final !");
					  document.form1.hora_fim.focus();		 
					  return false;}
					  
				 if(eval(hora_fim) < eval(hora_inic)){
					 alert ("A hora final não pode ser menor que a hora inicial !");
					 document.form1.hora_fim.focus();	
					 return false;
				 } 
 

					  					  					  
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
	    document.form1.action = "eqptocontgr1.php?gravar=I";
	    document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	}
}	
function excluir_contr(){
	
    if (confirm("Confirma a exclusão dos Dados ?")){
   	   	  document.form1.action="eqptocontgr1.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}

function contr(){
	alert("entrou contr");
}
	
/////////////////////////////////
