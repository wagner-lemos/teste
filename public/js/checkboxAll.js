function checkboxAll() {
	if(document.f1) {    
		var campo = 1;
		for (var i = 1; i < document.f1.elements.length; i++) {
			if(document.f1.elements[i].type == "checkbox") {
				if (document.f1.mestre.checked == 0) {
	   				document.f1.elements[i].checked = 0;
	   				mudaCor(campo, 0);
	   			}
	        	else {
	        		document.f1.elements[i].checked = 1;
	       			mudaCor(campo, 1);
	        	}
	        	campo++;
        	}
   		}
	}
}

function mudaCor(param, campo) {
	if (campo == 0) {
		var cor
		if(param % 2 == 1) {cor="#F1F1F1"; }else{cor="#E5E5E5";}
		document.getElementById(param).style.background=cor;
	}
	else{
		document.getElementById(param).style.background='#fec489';
	}
}