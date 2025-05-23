
  // Desabilitar a exibição do código-fonte
  document.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.key === 'u') {
   //   event.preventDefault();
   //   alert('Exibição do código-fonte desabilitada!');
  }
 });
 
 ////////////////////////data//////////////////////////
 
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
 
 
  function textCounter(field, countfield, maxlimit) {
	  if (field.value.length > maxlimit){
		  field.value = field.value.substring(0, maxlimit);}
	  else {
		  countfield.value = maxlimit - field.value.length;}
  }
  
  function ver_foto(foto){   
			urln = 'doc_clien/'+foto
			newwindow=window.open(urln,'fotos','toolbar=no, scrollbars=yes, resizable=yes,height=600,width=800');
  }
  
  function redimensiona()
			  {
				  document.images['id_da_imagem'].width = 120;
			  }
  
 ///////////////////////////////////////////////////

function sairx(me)
  {	    
  	  switch (me)
	  {

	  case "V":
     	document.form1.action="menu_visita.php";
	   	document.form1.submit();  
		return true;
    	break;
	  case "C":
     	document.form1.action="menu_comercial.php";
	   	document.form1.submit();  
		return true;
  	    break;

	  default:
     	document.form1.action="menu_exped.php";
	   	document.form1.submit();  
		return true;
		break;
	  }
/*
      if(mn == "e"){
     	document.form1.action="menu_exped.php";
	  }
      if(mn == "V"){
			document.form1.action="menu_visita.php";
	   } 
       if(mn == "C"){
			document.form1.action="menu_comercial.php";
	   }
*/
	   	document.form1.submit();  
		return true;
  }
  
  //////////////////////////////////Dados dos documenos de clientes//////////////////////////////////
    function valida_docclie() {
		
	  var codigo_cli    = document.form1.codigo_cli.options[document.form1.codigo_cli.selectedIndex].value;
	  var descri_docto  = document.form1.descri_docto.value;
	  var id_tipodoc    = document.form1.id_tipodoc.options[document.form1.id_tipodoc.selectedIndex].value;
	  var data_cad      = document.form1.data_cad.value;
	  
	 if (codigo_cli == '') {
		 alert("selecione o cliente ! ");
		 document.form1.descri_docto.focus();
		 return false
	 }
	  
	 if (descri_docto == "" ) { 
		alert ("Informe a descrição do documento !");
		document.form1.descri_docto.focus();
		return false; 
	 }
						
	 if (id_tipodoc == "" ) { 
		alert ("Informe o tipo do documento !");
		document.form1.id_tipodoc.value = "";
		document.form1.id_tipodoc.focus();
		return false;
	 }
						
	 if (data_cad == "" ) { 
		alert ("Informe a data de cadastro !");
		document.form1.data_cad.value = "";
		document.form1.data_cad.focus();
		return false;
	 }
											  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "doc_cliegr007.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluir_docclie(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="doc_cliegr007.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }



