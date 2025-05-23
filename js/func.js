
  // Desabilitar a exibição do código-fonte
  document.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.key === 'u') {
 //     event.preventDefault();
  //    alert('Exibição do código-fonte desabilitada!');
  }
 });

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
////////////////////////////////////////////////////////////////////////////////////
function validaindt(){
	alert('ENTROU');
	   ano_ind     = document.form1.ano_ind.value;	  
	   quant_prod  = document.form1.quant_prod.value;	  
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  
//	  

	  if (ano_ind == ""){
		alert ("Informe o ano !");
		document.form1.ano_ind.focus();
		return false; }

	  if (cod_prod == ""){
		alert ("Selecione o produto!");
		document.form1.ano_ind.focus();
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
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function validadocarqvd(){
	  
	  descr_docto     = document.form1.descr_docto.value;
		  
  
	  responsavel    = document.form1.responsavel.value;
	  descr_docto    = document.form1.descr_docto.value;
	  
	  data_arq       = document.form1.data_arq.value;
	  
	  id_setor  = document.form1.id_setor.options[document.form1.id_setor.selectedIndex].value;
//alert('ENTROU');	  

	  if (descr_docto == ""){
		alert ("Informe a Descricao do Documento !");
		document.form1.descr_docto.focus();
		return false; }

	  if (responsavel == ""){
		alert ("Informe o responsavel pelo documento!");
		document.form1.responsavel.focus();
		return false; }
  
	  if (data_arq == ""){
		alert ("Informe da data de arquivamento !");
		document.form1.data_arq.focus();
		return false; }
			  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "doctoamg1.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	  

  }
    
function excluirdocarqvd(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="doctoamg1.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  function validasaidaam(){
 
	  num_nf     = document.form1.num_nf.value;
	  data_nf    = document.form1.data_nf.value;
	  
	  id_grpamostra  = document.form1.id_grpamostra.options[document.form1.id_grpamostra.selectedIndex].value;
	  if (num_nf == ""){
		alert ("Informe a NF !");
		document.form1.num_nf.focus();
		return false; }

	  if (data_nf == ""){
		alert ("Informe a data da NF !");
		document.form1.data_nf.focus();
		return false; }
  
	  if (id_grpamostra == ""){
		alert ("Selecione o KIT !");
		document.form1.id_grpamostra.focus();
		return false; }
		
	  tm = document.form1.num_lote.length;
	  msg=0;
//alert("entrr"); 
	  
	  
	  n_lotearr="";
	  ncd_itens= "";
	  qtd_ite = "";
	  for(i=0;i<tm;i++){
		  n_lote   = document.form1.num_lote[i].value;
		  n_idit   = document.form1.cod_prod[i].value;
		  quantit  = document.form1.quant_said[i].value;
		  
		  if(n_lote == ""){ msg =1;}
		  n_lotearr = n_lotearr+n_lote+";";
		  ncd_itens = ncd_itens+n_idit+";";
		  qtd_ite   = qtd_ite+quantit+";";
		  
	  }
	  
	  document.getElementById("cd_lotes").value = n_lotearr;
	  document.getElementById("cd_itens").value = ncd_itens;
	  document.getElementById("qtd_itens").value = qtd_ite;
	  
	
	//  document.form1.cd_lotes = n_lotearr;
	  
	  if(msg != 0) { 
	      alert("Informe o numero de todos os lotes das amostras !");
          return false;
	  }
	  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matamgr04.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	  

  }
    
function excluirsaidaam(){
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr04.php?gravar=E";
			document.form1.submit();  
			return true;
			}
 	
}
//-----------------------------------------------------------------------------------------------------------//
  function validacontrprv(){
	  
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  num_lote  = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value;
	  situacao  = document.form1.situacao.options[document.form1.situacao.selectedIndex].value;

	  localizacao       = document.form1.localizacao.value;
      data_descart      = document.form1.data_descart.value;

	  if (num_lote == ""){
		alert ("Selecione o Lote !");
		document.form1.num_lote.focus();
		return false; }

	  
	  if (localizacao == ""){
		alert ("Informe a Localizacao !");
		document.form1.localizacao.focus();
		return false; }
		
	  if (situacao == "D"){
		 if(data_descart == ""){
		     alert ("Informe a data que o produto foi descartado !");
		     document.form1.data_descart.focus();
		     return false; }
	  }
	  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matcpgr01.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	  
  }
  
  function excluircontrprv(){
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  num_lote  = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value;
	  
	  
	  if (cod_prod == ""){
		alert ("Selecione o Produto Acabado !");
		document.form1.cod_prod.focus();
		return false; }

	  if (num_lote == ""){
		alert ("Selecione o Lote !");
		document.form1.num_lote.focus();
		return false; }

	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matcpgr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
//----------------------------------------------------------------------------------------------------------//	

//-----------------------------------------------------------------------------------------------------------//
  function validacontrprm(){
	  
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  num_lote  = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value;
	  situacao  = document.form1.situacao.options[document.form1.situacao.selectedIndex].value;

//alert("entrou");

	  localizacao       = document.form1.localizacao.value;
      data_descart      = document.form1.data_descart.value;

	  if (num_lote == ""){
		alert ("Selecione o Lote !");
		document.form1.num_lote.focus();
		return false; }

	  
	  if (localizacao == ""){
		alert ("Informe a Localizacao !");
		document.form1.localizacao.focus();
		return false; }
		
	  if (situacao == "D"){
		 if(data_descart == ""){
		     alert ("Informe a data que o produto foi descartado !");
		     document.form1.data_descart.focus();
		     return false; }
	  }
	  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matcpmgr01.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	  
  }
  
  function excluircontrprm(){
	  cod_prod  = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  num_lote  = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value;
	  
	  
	  if (cod_prod == ""){
		alert ("Selecione o Produto Acabado !");
		document.form1.cod_prod.focus();
		return false; }

	  if (num_lote == ""){
		alert ("Selecione o Lote !");
		document.form1.num_lote.focus();
		return false; }

	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matcpmgr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
//----------------------------------------------------------------------------------------------------------//	

  function validacompgrp(){
	  id_grpamostra  = document.form1.id_grpamostra.options[document.form1.id_grpamostra.selectedIndex].value;
	  cod_prod      = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	  quant_it       = document.form1.quant_it.value;
  
	  if (id_grpamostra == ""){
		alert ("Selecione o Grupo !");
		document.form1.id_grpamostra.focus();
		return false; }
		
	  if (cod_prod == ""){
		alert ("Selecione o Produto !");
		document.form1.cod_prod.focus();
		return false; }
		
	  if (quant_it == "" || eval(quant_it) == 0){
		alert ("Selecione a quantidade do item que compoe o Kit !");
		document.form1.quant_it.focus();
		return false; }
		
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matamgr03.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }	  
  }
  
  function excluircompgrp(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr03.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
 function validasaiditproc(){
	 cod_prod   = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	 quant_it = document.form1.quant_it.value;
	 data_said   = document.form1.data_said.value;
	 num_lote = document.form1.num_lote.value;
	 	 
	 if (cod_prod == ""){
		alert ("Selecione o produto !");
		document.form1.cod_prod.focus();
		return false; }
		
	 if (num_lote == ""){
		alert ("Informe o numero do lote !");
		document.form1.num_lote.focus();
		return false; }
		
  
	 if (quant_it == "" || quant_it < 0.000 ) { 
		   alert ("Informe a quantidade !");
		   document.form1.quant_it.value = "";
		   document.form1.quant_it.focus();
		   return false; }
						
	 if (data_said == ""){
		alert ("Informe a data da Saida !");
		document.form1.data_said.focus();
		return false; }

	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matamgr09.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }
  }
  
  function excluirsaiditproc(){
	  	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr09.php?gravar=E";
			document.form1.submit();  
			return true;
			}	  
  }
  
  function validaentitproc() {
	 cod_prod   = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
	 quant_it = document.form1.quant_it.value;
	 data_ent   = document.form1.data_ent.value;
	 	 
	 if (cod_prod == ""){
		alert ("Selecione o produto !");
		document.form1.cod_prod.focus();
		return false; }
  
	 if (quant_it == "" || quant_it < 0.000 ) { 
		   alert ("Informe a quantidade !");
		   document.form1.quant_it.value = "";
		   document.form1.quant_it.focus();
		   return false; }
						
	 if (data_ent == ""){
		alert ("Informe a data da Entrada !");
		document.form1.data_ent.focus();
		return false; }

	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matamgr08.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }  
  }
    
  function excluirentitproc(){
	  	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr08.php?gravar=E";
			document.form1.submit();  
			return true;
			}

  }
  
  function validaitpro()
   {
	   
	  quant_disp = document.form1.quant_disp.value;
	  cod_prod   = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
		 
	 if (cod_prod == ""){
		alert ("Selecione o produto !");
		document.form1.cod_prod.focus();
		return false; }
  
	 if (quant_disp == "" || quant_disp < 0.000 ) { 
		   alert ("Informe a quantidade !");
		   document.form1.quant_disp.value = "";
		   document.form1.quant_disp.focus();
		   return false; }
						
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matamgr02.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }
  }	
  function excluiritproc(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr02.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  function validagrpam() {
	  descr_grpam = document.form1.descr_grpam.value;
	  
	 if (descr_grpam == "" ) { 
						alert ("Informe o grupo !");
						document.form1.descr_grpam.value = "";
						document.form1.descr_grpam.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matamgr01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirgrpam(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
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
  function sairv(mn)
  {	    
      if(mn == "V"){
			document.form1.action="menu_visita.php";
	   } 
		document.form1.submit();  
		return true;
    }
function sair(){
     	document.form1.action="menu_exped.php";
		document.form1.submit();  
		
		return true;
	  }

 
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
  
  function sair1()
  {	     
	document.form1.action="menu_custo.php";
	document.form1.submit();  
	return true;
  
  }
    function sair2()
  {	     
	document.form1.action="menu_comercial.php";
	document.form1.submit();  
	return true;
  
  }
  function sair3()
  {	     
	document.form1.action="../expedicao/menu_exped.php";
	document.form1.submit();  
	return true;
  }

  function sair4()
  {	     
	document.form1.action="../visitatecnica/menu_visita.php";
	document.form1.submit();  
	return true;
  
  }
function resetForm(){
	  //if (confirm("Confirma limpeza do formulário  ?")){
			// document.location.href='excluieq.asp'
			document.form1.action="matpe001.php";
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
  function validamatpacb2(ac) {
  
					 id_entprodac           = document.form1.id_entprodac.options[document.form1.id_entprodac.selectedIndex].value;
					 embalagem          = document.form1.embalagem.value;		
					 num_lote           = document.form1.num_lote.value;
					 data_fabr          = document.form1.data_fabr.value;
					 data_venc          = document.form1.data_venc.value;
					 data_prevlib       = document.form1.data_prevlib.value;
					 quant_fabr        = document.form1.quant_fabr.value;
						 
					 if (id_entprodac == ""){
						alert ("Selecione o produto !");
						document.form1.id_entprodac.focus();
						return false; }
  
					 if (num_lote == "" ) { 
						alert ("Informe o N. do Lote !");
						document.form1.num_lote.value = "";
						document.form1.num_lote.focus();
						return false; }
  
					 if (data_fabr == "" ) { 
						alert ("Informe a data de fabricacao !");
						document.form1.data_fabr.value = "";
						document.form1.data_fabr.focus();
						return false; }
  
					 if (data_venc == "" ) { 
						alert ("Informe a data de Vencimento !");
						document.form1.data_venc.value = "";
						document.form1.data_venc.focus();
						return false; }
	  
					 if (quant_fabr == "" | quant_fabr == 0.00 ) { 
						alert ("Informe a quantidade fabricada !");
						document.form1.quant_fabr.value = "";
						document.form1.quant_fabr.focus();
						return false; }
				
					 if (embalagem == ""){
						alert ("Informe a Unidade da Embalagem !");
						document.form1.embalagem.focus();
						return false; }			
	  
					 if (data_prevlib == "" ) { 
						alert ("Informe a data de previsao de liberacaoo !");
						document.form1.prev_lib.value = "";
						document.form1.prev_lib.focus();
						return false; }
	  
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpacg02.php?gravar=r";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function validamatpacb() {
				
  
					 cod_prod           = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
					 embalagem          = document.form1.embalagem.value;		
					 num_lote           = document.form1.num_lote.value;
					 data_fabr          = document.form1.data_fabr.value;
					 data_venc          = document.form1.data_venc.value;
					 data_prevlib       = document.form1.data_prevlib.value;
					 quant_fabr        = document.form1.quant_fabr.value;
						 
					 if (cod_prod == ""){
						alert ("Selecione o produto !");
						document.form1.cod_prod.focus();
						return false; }
  
					 if (num_lote == "" ) { 
						alert ("Informe o N. do Lote !");
						document.form1.num_lote.value = "";
						document.form1.num_lote.focus();
						return false; }
  
					 if (data_fabr == "" ) { 
						alert ("Informe a data de fabricacao !");
						document.form1.data_fabr.value = "";
						document.form1.data_fabr.focus();
						return false; }
  
					 if (data_venc == "" ) { 
						alert ("Informe a data de Vencimento !");
						document.form1.data_venc.value = "";
						document.form1.data_venc.focus();
						return false; }
	  
					 if (quant_fabr == "" | quant_fabr == 0.00 ) { 
						alert ("Informe a quantidade fabricada !");
						document.form1.quant_fabr.value = "";
						document.form1.quant_fabr.focus();
						return false; }
				
					 if (embalagem == ""){
						alert ("Informe a Unidade da Embalagem !");
						document.form1.embalagem.focus();
						return false; }			
	  
					 if (data_prevlib == "" ) { 
						alert ("Informe a data de previsao de liberacaoo !");
						document.form1.prev_lib.value = "";
						document.form1.prev_lib.focus();
						return false; }
	  
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpacg02.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  
  function excluirmatpacb(){
	  
	  if (confirm("Confirma a exclusão dos Dados ?")){
			document.form1.action="matpacg02.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  /////==================////////////////
  
    function valida_obs() {
				
		var	msg_lote        = document.form1.msg_lote.value;
						 
	  
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpacg12.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
function validamatpac() {
				
					 cod_prod           = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
					 descr_analise      = document.form1.descr_analise.value;
					 limite_analise     = document.form1.limite_analise.value;				   
							 
					 if (cod_prod == ""){
						alert ("Selecione o produto !");
						document.form1.cod_prod.focus();
						return false; }
						
					 if (descr_analise == ""){
						alert ("Informe a Descricao !");
						document.form1.descr_analise.focus();
						return false; }			
					 
					 if (limite_analise == "" ) { 
						alert ("Informe o limite !");
						document.form1.limite_analise.value = "";
						document.form1.limite_analise.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpacg01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirmatpac(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matpacg01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  /////
  function validamatpe() {
				
					 cod_fornec         = document.form1.cod_fornec.options[document.form1.cod_fornec.selectedIndex].value;
					 cod_prod           = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
					 data_entrada       = document.form1.data_entrada.value;	
					 unidade            = document.form1.unidade.value;
					 num_nf             = document.form1.num_nf.value;
					 data_nf            = document.form1.data_nf.value;
					 num_lote           = document.form1.num_lote.value;
					 data_fab           = document.form1.data_fab.value;
					 data_venc          = document.form1.data_venc.value;
					 quantid_ent        = document.form1.quantid_ent.value;
					 atv_kamoran        = document.form1.atv_kamoran.value;				   
					 nm_fabric          = document.form1.nm_fabric.value;				   
					 
						 
					 if (cod_prod == ""){
						alert ("Selecione o produto !");
						document.form1.cod_prod.focus();
						return false; }
						
					 if (cod_fornec == ""){
						alert ("Selecione o Fornecedor !");
						document.form1.cod_fornec.focus();
						return false; }			
					 if (nm_fabric == ""){
						alert ("Informe o nome do Fabricante !");
						document.form1.nm_fabric.focus();
						return false; }			
					 
					 if (data_entrada == "" ) { 
						alert ("Informe a data da entrada !");
						document.form1.data_entrada.value = "";
						document.form1.localizacao.focus();
						return false; }
  
					 if (num_nf == "" ) { 
						alert ("Informe o numero da NF !");
						document.form1.num_nf.value = "";
						document.form1.num_nf.focus();
						return false; }
  
					 if (data_nf == "" ) { 
						alert ("Informe a data da Nota Fiscal !");
						document.form1.data_nf.value = "";
						document.form1.data_nf.focus();
						return false; }
  
					 if (unidade == "" ) { 
						alert ("Informe a unidade do produto !");
						document.form1.unidade.value = "";
						document.form1.unidade.focus();
						return false; }
	  
					 if (num_lote == "" ) { 
						alert ("Informe o numero do lote !");
						document.form1.num_lote.value = "";
						document.form1.num_lote.focus();
						return false; }
  
					 if (data_fab == "" ) { 
						alert ("Informe a data de fabricacao !");
						document.form1.data_fab.value = "";
						document.form1.data_fab.focus();
						return false; }
	  /*
					 if (data_venc == "" ) { 
						alert ("Informe a data de vencimento !");
						document.form1.data_venc.value = "";
						document.form1.data_venc.focus();
						return false; }	
  */
	  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpeg01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  
  function excluirentmat(){
	  
	  if (confirm("Confirma a exclusão da Nota ?")){
			document.form1.action="matpeg01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  //////////////////////
  function validamatps() {
  
			 cod_prod           = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
		  
		  
			  if(document.form1.lm.value ==  ''){		   
					 num_lote           = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value; 
			  } 
			  else {
					 num_lote           = document.form1.num_lote.value;			
			  }
  ///alert("entrou");
  
					 data_saida         = document.form1.data_saida.value;	
					 quantid_said       = document.form1.quantid_said.value;
					 lote_fabricado     = document.form1.lote_fabricado.value;
					 saldo_anterior     = document.form1.saldo_anterior.value;
					 unidade            = document.form1.unidade.value;
					 
					 
					 if (cod_prod == ""){
						alert ("Selecione o produto !");
						document.form1.cod_prod.focus();
						return false; }
						
					 if (num_lote == ""){
						alert ("Selecione o Lote !");
						document.form1.num_lote.focus();
						return false; }			
					 
					 if (data_saida == "" ) { 
						alert ("Informe a data da saida !");
						document.form1.data_saida.value = "";
						document.form1.data_saida.focus();
						return false; }
  
					 if (quantid_said == "" ) { 
						alert ("Informe a quantidade de Saida !");
						document.form1.num_nf.value = "";
						document.form1.num_nf.focus();
						return false; }
  
					 if (unidade == "" ) { 
						alert ("Informe a unidade do produto !");
						document.form1.unidade.value = "";
						document.form1.unidade.focus();
						return false; }
	  
					 if (lote_fabricado == "" ) { 
						alert ("Informe o numero do lote Fabricado !");
						document.form1.lote_fabricado.value = "";
						document.form1.lote_fabricado.focus();
						return false; }
  
  
	  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpsg01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  
  function excluirsaidmat(){
	  
	  if (confirm("Confirma a exclusão dos Dados ?")){
			document.form1.action="matpsg01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  function validasaidaprodc() {
  
  //alert("entrou");
			 cod_prod           = document.form1.cod_prod.options[document.form1.cod_prod.selectedIndex].value;
			 codigo_cli         = document.form1.codigo_cli.options[document.form1.codigo_cli.selectedIndex].value;
			 cod_fornec         = document.form1.cod_fornec.options[document.form1.cod_fornec.selectedIndex].value;
		  
			 if(document.form1.lm.value ==  ''){		   
					 num_lote           = document.form1.num_lote.options[document.form1.num_lote.selectedIndex].value; 
			 } 
			 else {
					 num_lote           = document.form1.num_lote.value;			
			 }
  ///alert("entrou");
  
			var unidade            = document.form1.unidade.value;	
			var quantid            = document.form1.quantid.value.replace(',','.');
			var num_pedido         = document.form1.num_pedido.value;
			var num_nf             = document.form1.num_nf.value;
			var data_nf            = document.form1.data_nf.value;
			var data_fatura        = document.form1.data_fatura.value;		   
			var tt_estoque         = document.form1.ttestoq.value;
			 
	  //	   alert(tt_estoque);
  //		   alert(quantid > parseInt(tt_estoque));
			 if (cod_prod == ""){
				  alert ("Selecione o produto !");
				  document.form1.cod_prod.focus();
				  return false; }
						
			 if (num_lote == ""){
				alert ("Selecione o Lote !");
				document.form1.num_lote.focus();
				return false; }			
  
			 if (codigo_cli == ""){
				alert ("Selecione o Cliente !");
				document.form1.codigo_cli.focus();
				return false; }			
  
			 if (num_pedido == ""){
				alert ("Informe N. Pedido !");
				document.form1.num_pedido.focus();
				return false; }			
					 
			 if (quantid == "" ) { 
				alert ("Informe a quantidade !");
				document.form1.quantid.value = "";
				document.form1.quantid.focus();
				return false; }
				
			 //if(parseInt(quantid) > parseInt(tt_estoque) ){
				 
			/*
			if(parseFloat(quantid) > parseFloat(tt_estoque)){
				//Math.round(tt_estoque)
				
				alert("A quantidade de saida invalida !" + quantid + " " + tt_estoque );
				document.form1.quantid.value = "";
				document.form1.quantid.focus();
				return false;
				 }
			 */
  
			 if (unidade == "" ) { 
				alert ("Informe a unidade !");
				document.form1.unidade.value = "";
				document.form1.unidade.focus();
				return false; }
  
			 if (data_fatura == "" ) { 
				alert ("Informe a data da Fatura !");
				document.form1.data_fatura.value = "";
				document.form1.data_fatura.focus();
				return false; }
	  
			 if (num_nf == "" ) { 
				alert ("Informe o numero da Nota Fiscal !");
				document.form1.num_nf.value = "";
				document.form1.num_nf.focus();
				return false; }
  
			 if (data_nf == "" ) { 
				alert ("Informe a data da Nota Fiscal !");
				document.form1.data_nf.value = "";
				document.form1.data_nf.focus();
				return false; }
  
			 if (cod_fornec == "" ) { 
				alert ("Informe a transportadora !");
				document.form1.cod_fornec.value = "";
				document.form1.cod_fornec.focus();
				return false; }
  
  
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "matpsg03.php?gravar=I";
		   document.form1.submit();
		   return true;
	  }
  }	
  
  function excluirsaidaprodac(){
	  
	  if (confirm("Confirma a exclusão dos Dados ?")){
			document.form1.action="matpsg03.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  function validaccusto() {
					 descr_centcustind     = document.form1.descr_centcustind.value;				   
							 
					 if (descr_centcustind == ""){
						alert ("Selecione a descricão !");
						document.form1.descr_centcustind.focus();
						return false; }
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "custoindgr1.php?gravar=I";
		   document.form1.submit();
		   return true;
  
	  }
  }	
  function excluiccusto(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custoindgr1.php?gravar=E";
			document.form1.submit();  
			return true;
	  }
  }

  function validacustoindv() {
	  
	   id_centcustoind       = document.form1.id_centcustoind.options[document.form1.id_centcustoind.selectedIndex].value;
	   ano_custoind          = document.form1.ano_custoind.value;				   
	   val_custoind          = document.form1.val_custoind.value;		
	   		   
							 
	   if (id_centcustoind == ""){
			alert ("Selecione o centro de custo");
			document.form1.id_centcustoind.focus();
			return false; 
	   }
	   if (ano_custoind == "" || ano_custoind < 2018){
			alert ("Informe o ano !");
			document.form1.ano_custoind.focus();
			return false; 
	   }
	   if (val_custoind == ""){
			alert ("Informe o Valor");
			document.form1.val_custoind.focus();
			return false; 
	   }
	  if (confirm("Confirma a gravação dos dados?")){
		   document.form1.action = "custoindvgr1.php?gravar=I";
		   document.form1.submit();
		   return true;
  
	  }
  }	
  function excluicustoindv(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custoindvgr1.php?gravar=E";
			document.form1.submit();  
			return true;
	  }
  }
  
    function validagrpam11() {
	  descr_grpam = document.form1.descr_grpam.value;
	  
	 if (descr_grpam == "" ) { 
						alert ("Informe o grupo !");
						document.form1.descr_grpam.value = "";
						document.form1.descr_grpam.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matamgr011.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirgrpam11(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matamgr011.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  //////////////////////////////////Dados dos Fretes//////////////////////////////////
    function valida_frete() {
		
	  var val_fret    = document.form1.val_fret.value;
	  var aliq_icms   = document.form1.aliq_icms.value;
	  var num_conhec  = document.form1.num_conhec.value;
	  
	 if (val_fret == "" ) { 
						alert ("Informe o valor do fret !");
						document.form1.val_fret.value = "";
						document.form1.val_fret.focus();
						return false; }
						
	 if (aliq_icms == "" ) { 
						alert ("Informe o valor da Aliquota do ICMS !");
						document.form1.aliq_icms.value = "";
						document.form1.aliq_icms.focus();
						return false; }
						
	 if (num_conhec == "" || eval(num_conhec) == 0 ) { 
						alert ("Informe o número do conhecimento !");
						document.form1.num_conhec.value = "";
						document.form1.num_conhec.focus();
						return false; }
											  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpacgr500.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluir_frete(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matpacgr500.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
  
  //////////////////////////////////Dados dos Fretes//////////////////////////////////
    function valida_autorizfr() {
		  var nm_autori   = document.form1.nm_autori.value;
		  var data_autori = document.form1.data_autori.value;
		  var num_conhec  = document.form1.num_conhec.value;
		  var autorizac   = document.form1.autorizac.options[document.form1.autorizac.selectedIndex].value;
					
		 if (num_conhec == "" ) { 
				alert ("Informe o número do conhecimento !");
				document.form1.num_conhec.value = "";
				document.form1.num_conhec.focus();
				return false;
		 }
												  
		  //alert(situacao);
		  if (confirm("Confirma a gravação dos dados?")){
			  //alert("entrou");
		   //document.form1.gravacao.value = "S";
			   document.form1.action = "matpac500agr.php?gravar=I";
			   document.form1.submit();
		   //document.form1.reload();
			   return true;
	  
		  }
  }	
  
  //////////////////////////////////Dados dos Fretes//////////////////////////////////
    function valida_autorizfrd() {
		  var nm_autori   = document.form1.nm_autori.value;
		  var data_autori = document.form1.data_autori.value;
		  var num_conhec  = document.form1.num_conhec.value;
		  var autorizac   = document.form1.autorizac.options[document.form1.autorizac.selectedIndex].value;
					//alert("entrou");
		 if (num_conhec == "" ) { 
				alert ("Informe o número do conhecimento !");
				document.form1.num_conhec.value = "";
				document.form1.num_conhec.focus();
				return false;
		 }
												  
		if (autorizac == "" ) { 
				alert ("Selecione a acão a ser tomada !");
				document.form1.autorizac.value = "";
				document.form1.autorizac.focus();
				return false;
		 }

		
		  //alert(situacao);
		  if (confirm("Confirma a gravação dos dados?")){
			  //alert("entrou");
		   //document.form1.gravacao.value = "S";
			   document.form1.action = "matpac500agrd.php?gravar=I";
			   document.form1.submit();
		   //document.form1.reload();
			   return true;
	  
		  }
  }	

  //////////////////////////////////Dados dos Fretes CIF//////////////////////////////////
    function valida_fretecif() {
		
	  var val_fret    = document.form1.val_fret.value;
	  var aliq_icms   = document.form1.aliq_icms.value;
	  var num_conhec  = document.form1.num_conhec.value;
	  var conhecpai   = document.form1.conhecpai.value;
	  
	 transportad       = document.form1.cod_fornec.options[document.form1.cod_fornec.selectedIndex].value;

	 if (transportad == '') {
		 alert("selecione a transportadora ! ");
		 document.form1.cod_fornec.focus();
		 return false
	 }
	  
	 if (val_fret == "" ) { 
						alert ("Informe o valor do fret !");
						document.form1.val_fret.value = "";
						document.form1.val_fret.focus();
						return false; }
						
	 if (aliq_icms == "" ) { 
						alert ("Informe o valor da Aliquota do ICMS !");
						document.form1.aliq_icms.value = "";
						document.form1.aliq_icms.focus();
						return false; }
						
	 if (num_conhec == "" || eval(num_conhec) == 0 ) { 
						alert ("Informe o número do conhecimento !");
						document.form1.num_conhec.value = "";
						document.form1.num_conhec.focus();
						return false; }
											  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "matpac500grcif.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluir_fretecif(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="matpac500grcif.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
////////////////////////////////////////////////////////////////////////////////////////////

