// JavaScript Document

$(document).ready(function(){
//inicio codigo jquery
	
$("form").submit(function(e) {
	e.preventDefault(); 
	url='suscripcion.php';	
	s_nombre=$('[name=nombre]').val();
	s_email=$('[name=email]').val();
        
	$.post( url, { 'nombre': s_nombre, 'email': s_email },function( data ) {
		//alert(data);
		if(data==1){
			text="Suscripcion exitosa";
			val_name='';val_email='';
		}
		else if(data==2){
			text="Email existente, utilizar otro email";
			val_name=s_nombre;val_email='';
		}
		else if(data==0){
			text="Error de conexion - Intente nuevamente";
			val_name=s_nombre;val_email=s_email;
		}
		$('[name=nombre]').val(val_name);
		$('[name=email]').val(val_email);
		alert(text,'Alerta');
	});
});

// alert jquery	
var oAlert = alert;
function alert(txt, title) {
    try {
        jAlert(txt, title);
    } catch (e) {
        oAlert(txt);
    }
}

//confirm()
var oConfirm = confirm;
function confirm(txt, title, func) {
    try {
        jConfirm(txt, title, func);
    } catch (e) {
        if (oConfirm (txt, title)) func();
    }
}

//prompt()
var oPrompt = prompt;
function prompt(txt, input, title, func){
    try {
        jPrompt(txt, input, title, func);
    } catch(e) {
        func(prompt(txt, input, title));
    }
}
//fin codigo jquery
});