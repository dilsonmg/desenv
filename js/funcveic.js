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
   	   	  document.form1.action="menu_frotas.php";
		  document.form1.submit();  
		  return true;

}

function resetForm(formul){
    //if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
   	   	  document.form1.action=+formul;
		  document.form1.submit();  
		  return true;
		//  }

}


function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit){
		field.value = field.value.substring(0, maxlimit);}
	else {
		countfield.value = maxlimit - field.value.length;}
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
function atualiza(){
   document.form1.submit();	
}
			
function resetForm(){
   // if (confirm("Confirma limpeza do formulário  ?")){
	      // document.location.href='excluieq.asp'
		  document.form1.placa.value = '';
		  document.form1.marca_modelo.value = '';
		  document.form1.ano_modelo.value = '';
		  document.form1.motor_potenc.value = '';
		  document.form1.combustivel.value = '';
		  document.form1.chassi.value = '';
		  document.form1.renavan.value = '';
		  document.form1.cor.value = '';
		  document.form1.valor_basico.value = '';
		  document.form1.obs_veiculo.value = '';
	
	   	  document.form1.action="veic0001.php?id=''";
		  document.form1.submit();  
		  return true;
	//	  }

}

 function ResetFormValues(campo) {
	 var formRetorno = campo;
// alert(formRetorno);
	 frm_elements = form1;
	 for (i = 0; i < frm_elements.length; i++){
    field_type = frm_elements[i].type.toLowerCase();
    switch (field_type)
    {
    case "text":
    case "password":
    case "textarea":
    case "hidden":
        frm_elements[i].value = "";
        break;
    case "radio":
    case "checkbox":
        if (frm_elements[i].checked)
        {
            frm_elements[i].checked = false;
        }
        break;
    case "select-one":
	    frm_elements[i].selectedIndex = -1;
        break;
    case "select-multi":
        frm_elements[i].selectedIndex = -1;
        break;
    default:
        break;
    }
}
	 
   document.form1.reset();
   document.form1.action=formRetorno;
   document.form1.submit();  
   return true;
   
    }
	
function validaveiccond() {
	
           id_veiculo   = document.form1.id_veiculo.options[document.form1.id_veiculo.selectedIndex].value;
		   id_condutor  = document.form1.id_condutor.options[document.form1.id_condutor.selectedIndex].value;
	       data_entrega = document.form1.data_entrega.value;
		    
		    if(id_veiculo == ""){
			     alert("Selecione o Veiculo !");
				 document.form1.id_veiculo.setfocus();
				 return false;
			}
		    if(id_condutor == ""){
			     alert("Selecione o Condutor !");
				 document.form1.id_condutor.setfocus();
				 return false;
			}
		    if(data_entrega == ""){
			     alert("Informe a data de Entrega !");
				 document.form1.data_entrega.setfocus();
				 return false;
			}

	   if (confirm("Confirma a gravação dos dados?")){
    	 document.form1.action = "veicgr005.php?gravar=r";
	     document.form1.submit();
	 	 return true;
	   }		
}	
function validakmveic(){
	
	    id_veiculo   = document.form1.id_veiculo.options[document.form1.id_veiculo.selectedIndex].value;
        ano_km = document.form1.ano_km.value;
		    
	   if(id_veiculo == ""){
		    alert("Selecione o Veiculo !");
		    document.form1.id_veiculo.setfocus();
			return false;
	   }
	   
	   if (ano_km == ""){
		   alert("Informe o ano da Kilometragem !");
		   document.form1.ano_km.setfocus();
		   return false;
	   }

	   if (confirm("Confirma a gravação dos dados?")){
    	 document.form1.action = "veicgr006.php?gravar=r";
	     document.form1.submit();
	 	 return true;
	   }	
}

function excluirkmveic(){
		   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr006.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	   }

	
}

	
function validacondutor(){
       var cnh_condutor  = document.form1.cnh_condutor.value;
       var cpf_condutor  = document.form1.cpf_condutor.value;
       var nome_condutor = document.form1.nome_condutor.value;
	   
	   if (cnh_condutor == ""){
		   alert("Informe a CNH do Condutor !");
		   return false;
	   }

	   if (cpf_condutor == ""){
		   alert("Informe o CPF do Condutor !");
		   return false;
	   }
	   if (nome_condutor == ""){
		   alert("Informe o Nome do Condutor !");
		   return false;
	   }

	   if (confirm("Confirma a gravação dos dados?")){
    	 document.form1.action = "veicgr004.php?gravar=r";
	     document.form1.submit();
	 	 return true;
	   }	
}
function excluircondutor(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr004.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	   }
}


function validadespveic(){
	
      id_veiculo   = document.form1.id_veiculo.options[document.form1.id_veiculo.selectedIndex].value;
	
	  id_itdespveic = document.form1.id_itdespveic.options[document.form1.id_itdespveic.selectedIndex].value;
	  
	  tipo_desp =   document.form1.tipo_desp.options[document.form1.tipo_desp.selectedIndex].value;
	  
	  
       if(id_veiculo == ""){
			     alert("Selecione o Veiculo !");
				 document.form1.id_veiculo.setfocus();
				 return false;
			}

       if(id_itdespveic == ""){
			     alert("Selecione o Iten de despesa !");
				 document.form1.id_itdespveic.setfocus();
				 return false;
			}

       var valor_desp = document.form1.valor_desp.value;
	   if (valor_desp == ""){
		   alert("Informe o valor da Despesa !");
		   return false;
	   }
	   
	      if(tipo_desp == ""){
			     alert("Selecione o Tipo de Despesa !");
				 document.form1.tipo_desp.setfocus();
				 return false;
			}
	   
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr003.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	   }
}

function excluirdespveic(){
   id_veiculo   = document.form1.id_veiculo.options[document.form1.id_veiculo.selectedIndex].value;
	
	  id_itdespveic = document.form1.id_itdespveic.options[document.form1.id_itdespveic.selectedIndex].value;
	  data_desp = document.form1.data_desp.value;

       if(id_veiculo == ""){
			     alert("Selecione o Veiculo !");
				 document.form1.id_veiculo.setfocus();
				 return false;
			}


       if(id_itdespveic == ""){
			     alert("Selecione o Iten de despesa !");
				 document.form1.id_itdespveic.setfocus();
				 return false;
			}


	  
	  if(data_desp == ""){
		  alert("Informe a Data da Despesa !");
          document.form1.data_desp.setfocus();
		  return false ;
	  }

	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr003.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
	   }
}

function validaitdesp(){
	   descr_desp  = document.form1.descr_desp.value;

       if (descr_desp == ""){
		   alert("Informe a Descricao !");
		   return false;
	   }
	   if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr002.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluiritdesp(){
	   if (confirm("Confirma a exclusão dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";

    	 document.form1.action = "veicgr002.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}


function validaveic(){
       placa        = document.form1.placa.value;
//	   marca_modelo = document.form1.uf.options[document.form1.uf.selectedIndex].value;
	   marca_modelo = document.form1.marca_modelo.value;
	   ano_modelo   = document.form1.ano_modelo.value;
	   motor_potenc = document.form1.motor_potenc.value;
	   combustivel  = document.form1.combustivel.value;
	   chassi       = document.form1.chassi.value;
	   renavan      = document.form1.renavan.value;
	   cor          = document.form1.cor.value;
	   valor_basico = document.form1.valor_basico.value;
	   obs_veiculo  = document.form1.obs_veiculo.value;

       if (placa == ""){
		   alert("Informe a Placa do Veiculo !");
		   return false;
	   }
	   if (marca_modelo == "") {
		  alert("Informe a Marca e o Modelo do Veiculo !");  
		  return false; 
	   }
	   if (motor_potenc == "") {
		  alert("Informe a Motorizacao e a Potencia !");  
		  return false; 
	   }
	   if (combustivel == "") {
		  alert("Informe o tipo de combustivel !");  
		  return false; 
	   }
	   if (chassi == "") {
		  alert("Informe o Chassi !");  
		  return false; 
	   }
	   if (renavan == "") {
		  alert("Informe o Renavan !");  
		  return false; 
	   }
	   if (cor == "") {
		  alert("Informe a Cor! ");  
		  return false; 
	   }
	   if (valor_basico == "") {
		  alert("Informe o Valor Basico ! ");  
		  return false; 
	   }
	   
	   	if (confirm("Confirma a gravação dos dados?")){
		//alert("entrou");
     //document.form1.gravacao.value = "S";
    	 document.form1.action = "veicgr001.php?gravar=r";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;

	}
}

function excluirveic(){
    	 document.form1.action = "veicrg001.php?gravar=E";
	     document.form1.submit();
	 //document.form1.reload();
	 	 return true;
}


function setFocus(focoreb) {

  document.getElementById(focoreb).focus(); 
}
/////////////////////
