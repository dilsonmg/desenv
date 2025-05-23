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
   	   	  document.form1.action="menu_prevprod.php";
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
////////////////////////////////////////////////////////////////
function validaemp_ind() {


	descr_emp   = document.form1.descr_emp.value;
		
	if (document.form1.descr_emp.value == ''){
		alert("Informe a Empresa ! ");
		document.form1.descr_emp.focus();
		return false;
		}
		
	//alert(situacao);
	if (confirm("Confirma a gravação dos dados?")){
		document.form1.action = "indgr01.php?gravar=I";
	    document.form1.submit();
	    //document.form1.reload();
	    return true;

	}
}

function excluirempind(id){
	
    if (confirm("Confirma a exclusão  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action="indgr01.php?gravar=E";
		  document.form1.submit();  
		  return true;
		  }
}
/////////////////////////////////////////////////////////////////////////
function validaindt(){
	//alert('ENTROU');
	   ano_ind     = document.form1.ano_ind.value;	  
	   quant_prod  = document.form1.quant_prod.value;	  
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;

	  if (ano_ind == ""){
		alert ("Informe o ano !");
		document.form1.ano_ind.focus();
		return false; }

	  if (cod_prod == ""){
		alert ("Selecione o produto!");
		document.form1.cod_prod.focus();
		return false; }
  
	  if (quant_prod == ""){
		alert ("Informe a quantidade !");
		document.form1.quant_prod.focus();
		return false; }
			  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "indgr02.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	    
  }
      
function excluirindt(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="indgr02.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}
////////////////////////////////////////////////////////////////////////////////////
function validaitem(){
//	alert('ENTROU');
	   descr_paramind  = document.form1.descr_paramind.value;	  
	   cod_prod        = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
  
      var erro = 0;

	  if (descr_paramind == "" && cod_prod == "" ){
		  erro = 1;
	  }
	  
	  if (erro != 0){
		alert ("Informe o item ou selecione o código do produto !");
		document.form1.descr_paramind.focus();
		return false; 
	  }
			  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "indgr03.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	    
  }
      
function excluiritem(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="indgr03.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
function valida_empind(){
	//alert('ENTROU');
	  var preco_item    = document.form1.preco_item.value;	  
	  var id_paramind   = document.form1.id_paramind.options[document.form1.id_paramind.selectedIndex].value;
  
	  if (id_paramind == "" ){
		alert ("Selecione Item / M.prima !");
		document.form1.preco_item.focus();
		return false; 	 
	  }
	  if(isNaN(preco_item) || preco_item == "" || id_paramind == ""){
		alert ("Informe o valor do item !");
		document.form1.preco_item.focus();
		return false; 
	  }
			  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "indgr04.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	    
  }
      
function excluir_empind(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="indgr04.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
function valida_fatind(){
	//alert('ENTROU');
	  var id_empind   = document.form1.id_empind.options[document.form1.id_empind.selectedIndex].value;
	  var cod_prod    = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  var id_paramind = document.form1.id_paramind.options[document.form1.id_paramind.selectedIndex].value;
	  var mes_ind       = document.form1.mes_ind.value;	  
	  var ano_ind       = document.form1.ano_ind.value;	  
	  var quant_prod    = document.form1.quant_prod.value;	  
	  var preco_item    = document.form1.preco_item.value;	  
	  var preco_fat     = document.form1.preco_fat.value;	  

	  var id_industrcontr   = document.form1.id_industrcontr.value;	  
	  var id_itensind       = document.form1.id_itensind.value;	  


	  if (id_empind == "" ){
		alert ("Selecione o cliente !");
		document.form1.ano_ind.focus();
		return false; 	 
	  }
	  if(ano_ind == "" ){
		alert ("Informe o ano de fabricacão !");
		document.form1.ano_ind.focus();
		return false; 
	  }
	  if(cod_prod == "" ){
		alert ("Informe o produto a ser fabricado !");
		document.form1.ano_ind.focus();
		return false; 
	  }

	  if(id_paramind == "" ){
		alert ("Informe o item de fabricacão !");
		document.form1.id_paramind.focus();
		return false; 
	  }
	  if(isNaN(preco_fat)){
		alert ("Informe o valor de fabricacão !");
		document.form1.preco_fat.focus();
		return false; 
	  }
			 
			 
			 
			  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "indgr05.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	    
  }
      
function excluir_fatind(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="indgr05.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}

////////////////////////////////////////////////////////////////////////////////////
