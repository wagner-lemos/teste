/*$(document).ready( function (){

	$(".lista").hide();
	$(".item").click(function(){	
		
		if($(this).parent().find(".lista").is(":visible")){
			$(this).parent().find(".lista").slideUp();
		}
		else
		{
			jQuery(".lista").slideUp();
			$(this).next(".lista").slideToggle("fast");
			
			$('.item').removeClass('current');
			$(this).addClass("current");
		}

	});
});*/

$(document).ready(function(){
	
	//Sidebar Accordion Menu:
		
		$("#main-nav li ul.lista").hide(); // Hide all sub menus
		$("#main-nav li a.current").parent().find("ul").slideToggle("slow"); // Slide down the current menu item's sub menu
		
		$("#main-nav li a.item").click( // When a top menu item is clicked...
			function () {
				$(this).parent().siblings().find(".lista").slideUp("normal"); // Slide up all sub menus except the one clicked
				$(this).next().slideToggle("normal"); // Slide down the clicked sub menu
				
				$('.item').removeClass('current');
				$(this).addClass("current");
				
				return false;
			}
		);

    //Close button:
		
		$(".close").click(
			function () {
				$(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
					$(this).slideUp(400);
				});
				return false;
			}
		);
});



function OnOff(caminho, divisoria, confirma) {
	var div = divisoria;

	document.getElementById(div).innerHTML = "<img src='images/loader.gif' height='16' width='16'>";
	try 
	{ 
		divisoria = new XMLHttpRequest(); 
	} 
	catch (e) 
	{
		divisoria = new ActiveXObject("Msxml2.XMLHTTP"); 
	}

	divisoria.open("GET",caminho, true);

	divisoria.onreadystatechange = function() { 
		//A consulta esta correta.
		if (divisoria.readyState == 4) {
			//Confirmando se o servidor conseguiu acessar a outra pgina;
			 if (divisoria.status==200) {
				document.getElementById(div).innerHTML = "Done"; 
				document.getElementById(div).innerHTML = divisoria.responseText;
				return;
			 }
			 else
				alert('Erro na consulta, por favor tente novamente.');	 
		}
	}

	divisoria.setRequestHeader('Accept','message/x-jl-formresult'); 
	divisoria.send(null); 

	return false;
}

function ajaxEdit(caminho, divisoria) {
	//Repassando a variavel para que o nome do DIV seja o nome da funo que cuida de armazenar a resposta
	//vinda do servidor. Com isso podemos carregar varios ajax de uma vez;
	var div = divisoria;
	document.getElementById(div).innerHTML = "<img src='images/loader.gif' width='16' height='16' align='middle'>";
	try
  	{
      	divisoria = new XMLHttpRequest(); 
  	}
  	catch (e)
  	{
    	divisoria = new ActiveXObject("Msxml2.XMLHTTP"); 
  	}
  	divisoria.open("GET",caminho, true); 
  	divisoria.onreadystatechange = function() { 
  		//A consulta esta correta.
  		if (divisoria.readyState == 4) {
  			//Confirmando se o servidor conseguiu acessar a outra pgina;
    		 if (divisoria.status == 200) {
        		document.getElementById(div).innerHTML = "Done"; 
        		document.getElementById(div).innerHTML = divisoria.responseText;
        		return;
    		 }
    		 else{
    		 	alert('Erro na consulta, por favor tente novamente.');	 
			}
		}
    }
  	divisoria.setRequestHeader('Accept','message/x-jl-formresult'); 
  	divisoria.send(null); 
  	return false;
}

function ajaxSave(caminho, divisoria, titulo, texto, token) {

	//Repassando a variavel para que o nome do DIV seja o nome da funo que cuida de armazenar a resposta
	//vinda do servidor. Com isso podemos carregar varios ajax de uma vez;
	var div = divisoria;
	document.getElementById(div).innerHTML = "<img src='images/loader.gif' width='16' height='16' align='middle'>";
	try
  	{
      	divisoria = new XMLHttpRequest(); 
  	}
  	catch (e) 
  	{
    	divisoria = new ActiveXObject("Msxml2.XMLHTTP"); 
  	}

  	divisoria.open("POST", caminho, true); 
	divisoria.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	divisoria.setRequestHeader('X-CSRF-TOKEN', token);
	
	var data = JSON.stringify({"titulo":titulo,"texto":texto});
	divisoria.send("dados="+data);

  	divisoria.onreadystatechange = function() { 
  		//A consulta esta correta.
  		if (divisoria.readyState == 4) {
  			//Confirmando se o servidor conseguiu acessar a outra pgina;
    		 if (divisoria.status == 200) {
        		document.getElementById(div).innerHTML = "Done"; 
        		document.getElementById(div).innerHTML = divisoria.responseText;
        		return;
    		}
    		else{
				alert('Erro na consulta, por favor tente novamente.');
			}
       	}
    }

  	return false;
}

function moeda(z){
	v = z.value;
	v=v.replace(/\D/g,"")  //permite digitar apenas números
	v=v.replace(/[0-9]{12}/,"invalido") //limita pra máximo 999.999.999,99
	v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")  //coloca ponto antes dos últimos 8 digitos
	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")  //coloca ponto antes dos últimos 5 digitos
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") //coloca virgula antes dos últimos 2 digitos
	z.value = v;
}

//adiciona mascara de data hora
function dataHora(data){
	if(valorNum(data)==false){
		event.returnValue = false;
	}	
	return formataCampo(data, '00/00/0000 00:00:00', event);
}

//adiciona mascara de data
function trataData(data){
	if(valorNum(data)==false){
		event.returnValue = false;
	}
	return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara telefone
function trataFone(telefone){
	if(valorNum(telefone)==false){
		event.returnValue = false;
	}
	return formataCampo(telefone, '(00) 0.0000.0000', event);
}

//adiciona mascara ao CEP
function trataCEP(cep){
	if(valorNum(cep)==false){
		event.returnValue = false;
	}	
	return formataCampo(cep, '00.000-000', event);
}

//valida numero inteiro com mascara
function valorNum(){
	if (event.keyCode < 48 || event.keyCode > 57){
		event.returnValue = false;
		return false;
	}
	return true;
}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
	var boleanoMascara; 
	
	var Digitato = evento.keyCode;
	exp = /\-|\.|\/|\(|\)|\:| /g
	campoSoNumeros = campo.value.toString().replace( exp, "" ); 
   
	var posicaoCampo = 0;
	var NovoValorCampo="";
	var TamanhoMascara = campoSoNumeros.length;; 
	
	if (Digitato != 8) { // backspace 
		for(i=0; i<= TamanhoMascara; i++) { 
			boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == ":")
								|| (Mascara.charAt(i) == "/"))
			boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
								|| (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))

			if (boleanoMascara) { 
				NovoValorCampo += Mascara.charAt(i); 
				  TamanhoMascara++;
			}else { 
				NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
				posicaoCampo++; 
			  }	   	 
		  }	 
		campo.value = NovoValorCampo;
		  return true; 
	}else { 
		return true; 
	}
}