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
			document.form1.action="menu_hse.php";
			document.form1.submit();  
			return true;
  }
  
  function textCounter(field, countfield, maxlimit) {
	  if (field.value.length > maxlimit)
		  field.value = field.value.substring(0, maxlimit);
	  else 
		  countfield.value = maxlimit - field.value.length;
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
 
 ////////////////
 
  function validaform_acao() {
  
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
	  fato_relat = document.form1.fato_relat.value;
	  data_relato = document.form1.data_relato.value;
	  hora_relato = document.form1.hora_relato.value;


	  id_acaocorr = document.form1.id_acaocorr.value;
	  data_acao   = document.form1.data_acao.value;
	  id_classtpac = document.form1.id_classtpac.value;
	  desc_acao   = document.form1.desc_acao.value;
 
	 // nome_doc    = document.form1.arq_instr.value;
		  
	  
	 // resp_acao   = document.form1.resp_acao.value;


  //	nome_doc    = document.form1.nome_doc.value;
	  
	  if (data_relato == '' || data_relato == null){
		  alert('Informe a Data !');
		  document.form1.data_relato.focus();
		  return false;
	  }	
	//alert("acao1");  
	  if (hora_relato == '' || hora_relato == null){
		  alert('Informe a hora !');
		  document.form1.hora_relato.focus();
		  return false;
	  }
	  
	  if (fato_relat == '' || fato_relat == null){
		  alert('Informe o fato !');
		  document.form1.fato_relat.focus();
		  return false;
	  }
	  if (id_acaocorr == '' || id_acaocorr == null){
		  alert('Selecione a acao !');
		  document.form1.id_acaocorr.focus();
		  return false;
	  }
	  if (data_acao == '' || data_acao == null){
		  alert('informe a data da acao !');
		  document.form1.data_acao.focus();
		  return false;
	  }
	  if (id_classtpac == '' || id_classtpac == null){
		  alert('informe a classe da acao !');
		  document.form1.id_classtpac.focus();
		  return false;
	  }
	  /*
	  if (desc_acao == '' || desc_acao == null){
		  alert('informe a descricao da acao !');
		  document.form1.desc_acao.focus();
		  return false;
	  }
		*/  
  
  /*
	  if (document.form1.nome_doc.value == ''){
		  alert("Informe a nome do documento ! ");
		  document.form1.nome_doc.focus();
		  return false;
		  }
  */
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  document.form1.action = "hsegr02.php?gravar=I";
		  document.form1.submit();
		  //document.form1.reload();
		  return true;
  
	  }
  }
  
 //////////////////////
 
 
  
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
	  fato_relat = document.form1.fato_relat.value;
	  data_relato = document.form1.data_relato.value;
	  hora_relato = document.form1.hora_relato.value;
	  
  //	nome_doc    = document.form1.nome_doc.value;
	  
	  if (data_relato == '' || data_relato == null){
		  alert('Informe a Data !');
		  document.form1.data_relato.focus();
		  return false;
	  }	
	  if (hora_relato == '' || hora_relato == null){
		  alert('Informe a hora !');
		  document.form1.hora_relato.focus();
		  return false;
	  }
	  
	  if (fato_relat == '' || fato_relat == null){
		  alert('Informe o fato !');
		  document.form1.fato_relat.focus();
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
		  document.form1.action = "hsegr01.php?gravar=I";
		  document.form1.submit();
		  //document.form1.reload();
		  return true;
  
	  }
  }
  
  function excluir_docto(id,itemex){
	  
	  if (confirm("Confirma a exclusão do item  ?")){
			// document.location.href='excluieq.asp'
			document.form1.action="hsegr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
function ver_foto(foto){ 
		  subdir = "hse_docs";
	      urln = 'arquivos/'+subdir +"/"+foto
          newwindow=window.open(urln,'fotos','top=10,left=200,location=0,directories=0,toolbar=no, scrollbars=yes, resizable=yes,height=600,width=900');
}


 function janelaSecundaria888(param1,param2){ 
 //alert(param);
   window.open("hse0013.php?"+param1+"="+param2,"janela1","width=1150,height=570,scrollbars=yes,resize=yes") 
} 

 function janelaSecundaria999(param){ 
 //alert(param);
   window.open("hse0003.php?id="+param,"janela1","width=1150,height=570,scrollbars=yes,resize=yes") 
} 