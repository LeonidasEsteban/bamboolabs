// JavaScript Document
$(document).ready(function(){
	$('table tr td input.boton1').click(function(){
		a=$(this).attr('id');
		con=a.split("_"); 
		tr1=con[0];
		tabla=con[1];
		id=con[2];
		tupla=tr1+'_'+id;
		$.post("marcar_mail.php?idma="+id+"&tabla="+tabla+"&tipo=marcar", 
		function(data) {
			switch(data)
			{
				case '0' : 
				$("#"+tupla).removeClass("marcado");
				$("#"+tupla).addClass("no_marcado");
				break;
				case '1' :
				$("#"+tupla).removeClass("no_marcado");
				$("#"+tupla).addClass("marcado");
				break;			
			}
		});
	});
	$('table tr td input.boton2').click(function(){
		a=$(this).attr('id');
		con=a.split("_");
		tr1=con[0];
		tabla=con[1];
		id=con[2];
		tupla=tr1+'_'+id;
		$.post("marcar_mail.php?idma="+id+"&tabla="+tabla+"&tipo=estado", 
		function(data) {
			if(data==1)
			{
				$("#"+tupla).removeClass("no_leido");
				$("#"+tupla).addClass("leido");
				
			}
			// mostrar mail slideDown
			$.post('ver_mail.php?idma='+id+'&tabla='+tabla,function(data) {
				$("#down").html(data);
			});
		});
	});
	// modificar contenido
	$('#c_conte').maxlength( {slider: true, maxCharacters:100} );	
	
	$('.demo tbody .boton_modifica').click(function() {
		con=$(this).attr('id').split("_"); 
		tabla=con[1];
		bux=con[2];
		/* para tupla seleccionada  */
		$('.demo tbody tr').removeClass('rojo_error');
		if(tabla=='caracteristicas')indice='tb4_'+bux;
		else if(tabla=='servicios')indice='tc4_'+bux;
		else if(tabla=='reglas')indice='td4_'+bux;
		
		$("#"+indice).addClass('rojo_error');
		/****************************/
		$.post('contenido_editar.php', { 			
			id: bux,tab: tabla , tipo: 'out'},
			function(data) {
				if(data!=0){
					$('#down').html(data);
				}
				else alert('Error: Intente Nuevamente');
		});
	});
	
	// borrar tupla de caracteristicas o servicios
	$('.demo tbody .boton_borra').click(function() {
	if (confirm('¿Estas seguro de Borrar esto?')){
		con=$(this).attr('id').split("_"); 
		id_1=con[2];
		tabla=con[1]
		$.post('contenido_editar.php', { 			
			id: id_1,tab: tabla, tipo: 'borra'},
			function(data) {
				if(data==1)
					$('#up').load('caracteristicas_admin.php');
				else 
					alert('Error: Intente Nuevamente');
		});
	}
	});
	
// para administrar imagenes
	$('table tr td input.boton_modifica_2').click(function(){
		$("#down").html('<img src="imagenes/loader-bar.gif" width="43" height="11" />');
		a=$(this).attr('id');
		con=a.split("_");
		id=con[1];
		/* para tupla seleccionada  */
		$('.demo tbody tr').removeClass('rojo_error');
		indice='tb5_'+id;
		$("#"+indice).addClass('rojo_error');
		/****************************/
		// mostrar imagen slideDown
		$.post('ver_imagen.php?id='+id+'&opc=ver',function(data) {
			$("#down").html(data);
		});
	});
	
	$('table tr td input.boton_borra_2').click(function(){
		a=$(this).attr('id');
		con=a.split("_");
		id=con[1];
		if (confirm("¿Esta seguro de eliminar la imagen?"))
		{	
			$.post('ver_imagen.php?id='+id+'&opc=borrar',function(data) {
				co=data.split("_");
				aux=co[0];
				msj=co[1];
				if(aux==1){
					$('#up').load('imagen_admin.php');
				}
				$("#down").html(msj);
			});
		}
	});
});

function modificar_caracteristica(){
	conte= $('#c_conte').val()
	orden= $('#c_orden').val()
	if(orden=='') orden=0;
	if(conte!=''){
		alt_x=$('#demo_btn3').attr('alt');
		con=alt_x.split("_");
		id_1=con[0];
		tabla=con[1]
		$.post('contenido_editar.php',{a: conte,id: id_1,tab: tabla, ord: orden, tipo: 'inn' },
			function(data) {
				if(data==1){
					$('#tex_'+id_1).html(conte);
					$('#ord_'+id_1).html(orden);
					$('#etiq').html('Contenido [Anterior]');
					alert('Listo¡¡¡');
				}
				else alert('ERROR: intente nuevamente');
		});
	}
	else alert('El campo no puede estar vacio')
}


function inserta_caracteristica(){
	$("#down").html('<img src="imagenes/loader-bar.gif" width="43" height="11" />');
	$('#down').load('inserta_caracteristica.php');
}
	
function agrega_caracteristica(){
	taux=$('#tipo_apart').val();
	texto=$('#des_texto').val();
	if(texto!=''){
		$.post('contenido_editar.php', { 			
			taux: taux, texto: texto, tipo:'insertar'},
			function(data) {
				if(data==1){
					$('#up').load('caracteristicas_admin.php');
					alert('Agregado');
				}
				else 
					alert('Error: Intente Nuevamente');
		});
		$("#down").html('');
	}
}

function modificar_imagen()
{
	idem=$('#btn_img').attr('alt');
	nom=$('#nom_img').val();
	tipo=$('#tipo_img option:selected"').val();
	desc=$('#des_img').val();
	orden=$('#orden_img').val();
	//file_i=$('#file_img').val();
	if (confirm("¿Esta seguro de realizar los cambios?"))
	{	
		$.post('ver_imagen.php?id='+id+'&opc=modificar', { 			
			nombre:nom, tipo: tipo , descrip: desc, id:idem, orden:orden },function(data) {
			alert(data);
			$('#up').load('imagen_admin.php');
		});
	}
}

function cambia_destino()
{
	tipo=$('#tipo_img option:selected"').val();
	$.post('cambia_select.php?tipo='+tipo,function(data) {	
		$("#file_busca").html(data);});
}

function inserta_imagen(){
	$('#down').load('inserta_imagen.php');
}

function agrega_imagen(){
	//
	tipo=$('#tipo_img option:selected"').val();
	desc=$('#des_img').val();
	file=$('span.fileName').text();
	orden=$('#orden_img').val();
	aux=file.split(".");
		nom=aux[0]
	aux2=aux[1].split(" ");
		ext=aux2[0];
	//alert(nom+' '+ext);
	n=nom.length;
	$.post('ver_imagen.php?opc=insertar', { 			
		tipo: tipo , descrip: desc, nombre: nom, extension: ext , len:n , orden: orden  },function(data) {
		if(data==1) {
			$('#file_img').uploadifyUpload();
			$('#up').load('imagen_admin.php');
		}
		else if(data==-1) alert('La longitud del nombre del archivo es muy extenso. Solo se permite un maximo de 9 caracteres')
		else if(data==-2) alert('Cambiar el nombre de la imagen.')
		else alert('Error - Intente nuevamente')
	});
}

function limpia_mails(tablax,tipo){
	if (confirm("¿Estas seguro de limpiar la bandeja?"))
	{	
		if (confirm("Recuerda que todos los mensajes que no se encuentren marcados seran eliminados de la dandeja de entrada. ¿Deseas continuar?"))
		{
			$.post('borrar_mail.php', {tabla: tablax },function(data) {
				if(data=='0') {
					alert('Error');
				}
				else {  
					$('#up').load('tabla_'+tipo+'.php');
					alert('Se limpio la bandeja satisfactoriamente.');
					$("#down").html('');
				}
			});			
		}
	}
}


/*******************************************************************/

