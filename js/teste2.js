  
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  function validagrcc() {
	  descr_grupocc = document.form1.descr_grupocc.value;
	  
	 if (descr_grupocc == "" ) { 
						alert ("Informe a Linha !");
						document.form1.descr_grupocc.value = "";
						document.form1.descr_grupocc.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "custogrupgr01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirgrcc(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custogrupgr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  function validagrcc2() {
	    id_grupocusto  = document.form1.id_grupocusto.options[document.form1.id_grupocusto.selectedIndex].value;
	    id_centcustoind  = document.form1.id_centcustoind.options[document.form1.id_centcustoind.selectedIndex].value;
		
	 if (id_grupocusto == "" ) { 
						alert ("Informe a linha !");
						document.form1.id_grupocusto.value = "";
						document.form1.id_grupocusto.focus();
						return false; }

	 if (id_centcustoind == "" ) { 
						alert ("Informe o item de custo !");
						document.form1.id_centcustoind.value = "";
						document.form1.id_centcustoind.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "custogrupgr02.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirgrcc20(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custogrupgr02.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

  function validagrccr2() {
	    id_grupocusto  = document.form1.id_grupocusto.options[document.form1.id_grupocusto.selectedIndex].value;
	    cod_sidespreal  = document.form1.cod_sidespreal.options[document.form1.cod_sidespreal.selectedIndex].value;
		
	 if (id_grupocusto == "" ) { 
						alert ("Informe a linha !");
						document.form1.id_grupocusto.value = "";
						document.form1.id_grupocusto.focus();
						return false; }

	 if (cod_sidespreal == "" ) { 
						alert ("Informe o item de despesa !");
						document.form1.cod_sidespreal.value = "";
						document.form1.cod_sidespreal.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "custogrupgrr02.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirgrcc2(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custogrupgrr02.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
////////////////////////////////////////////////////////
  function validadespr() {
	  		alert("entrou");

	    id_despreal  = document.form1.id.value;
	    descr_despreal  = document.form1.descr_despreal.value;
	/*
	 if (id_despreal == "" ) { 
						alert ("Informe a despesa !");
						document.form1.id_despreal.value = "";
						document.form1.descr_despreal.focus();
						return false; }
*/
	 if (descr_despreal == "" ) { 
						alert ("Informe a descricao da despesa !");
						document.form1.descr_despreal.value = "";
						document.form1.descr_despreal.focus();
						return false; }
						
					  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados ?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "custoindrgr001.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluirdespr(){
	  
	  if (confirm("Confirma a exclusão ?")){
			document.form1.action="custoindrgr001.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
/////////////////////////////////////////////////////
 function valida_prevdr() {
	 
	    mes_prevdespr  = document.form1.mes_prevdespr.options[document.form1.mes_prevdespr.selectedIndex].value;
	    cod_sidespreal = document.form1.cod_sidespreal.options[document.form1.cod_sidespreal.selectedIndex].value;
	
	    ano_prevdespr  = document.form1.ano_prevdespr.value;
	    val_prevdespr  = document.form1.val_prevdespr.value;
		
	    id_prevdespr  = document.form1.id.value;
		
	 if (cod_sidespreal == "" ) { 
						alert ("Informe a Despesa !");
						document.form1.cod_sidespreal.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }

	 if (mes_prevdespr == "" ) { 
						alert ("Informe o mes !");
						document.form1.mes_prevdespr.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }

	 if (ano_prevdespr == "" ) { 
						alert ("Informe o ano !");
						document.form1.ano_prevdespr.value = "";
						document.form1.ano_prevdespr.focus();
						return false; }
	 if (val_prevdespr == "" ) { 
						alert ("Informe o valor !");
						document.form1.val_prevdespr.value = "";
						document.form1.val_prevdespr.focus();
						return false; }
										  
	  //alert(situacao);
	  if (confirm("Confirma a gravação dos dados ?")){
		  //alert("entrou");
	   //document.form1.gravacao.value = "S";
		   document.form1.action = "custoprevdgr01.php?gravar=I";
		   document.form1.submit();
	   //document.form1.reload();
		   return true;
  
	  }
  }	
  function excluir_prevdr(){
	  
	  if (confirm("Confirma a exclusão ?")){
		   document.form1.action = "custoprevdgr01.php?gravar=E";
			document.form1.submit();  
			return true;
			}
  }
