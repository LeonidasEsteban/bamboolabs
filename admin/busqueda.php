<?
session_start();
if($_SESSION['open']!=1)
{
	header("Location: index.php");
	die();
}
require_once("../conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="imagen/icon.ico">
<title>Busqueda de Suscriptores</title>
<link href="css/css.css" rel="stylesheet" type="text/css"/>
<!-- para tablas dinamicas -->
	<style type="text/css" title="currentStyle">
			@import "sortable/css/demo_page.css";
			@import "sortable/css/demo_table_jui.css";
			@import "sortable/themes/smoothness/jquery-ui-1.8.4.custom.css";
	#apDiv1 {
	position:absolute;
	z-index:100;
	background:#D5E5E3;
	top:65px; right:16px;
	border: #888 solid 3px;
	border-radius: 3px;-moz-border-radius: 3px; -webkit-border-radius: 3px;-ms-border-radius: 3px;-khtml-border-radius: 3px;
	}
	#apDiv1 img{max-width:150px; max-height:170px; margin:0 auto;}
	.oculto{ display:none;}
	.visible{ display:block;}
	.formulario{ padding-top:25px !important;}
    </style>
	<script type="text/javascript" language="javascript" src="sortable/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="sortable/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
	// para manipular clases
	function hasClass(ele,cls) {
		return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
	}

	function addClass(ele,cls) {
		if (!this.hasClass(ele,cls)) ele.className += " "+cls;
	}

	function removeClass(ele,cls) {
		if (hasClass(ele,cls)) {
    		var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
			ele.className=ele.className.replace(reg,' ');
		}
	}
	
		function trim(stringToTrim) {
			return stringToTrim.replace(/^\s+|\s+$/g,"");
		}
	
		function fnFilterColumn ( i )
		{
			$('#example').dataTable().fnFilter( 
				$("#col_"+i).val(),i);
		}
		
		// para mostra detalles
		function fnFormatDetails ( oTable, nTr, valor)
			{
				con=valor.split("_/"); 
				idem=con[1];
				pdf=con[2];
				img=con[3];
				var aData = oTable.fnGetData( nTr );
				var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
				sOut += '<tr><td>Informaci&oacute; extra:</td><td><a title="Mas detalles">Detalles</a>...</td></tr>';
				sOut += '</table>';
				
				return sOut;
			}
			
		function mostrar_img(img){
			removeClass(document.getElementById("apDiv1"), "oculto")
			addClass(window.document.getElementById("apDiv1"), "visible");
			document.images["foto_img"].src = "fotos/"+img;
			
		}
		function ocultar_img(){
			removeClass(document.getElementById("apDiv1"), "visible")
			addClass(window.document.getElementById("apDiv1"), "oculto");

		}
		function abre(url, nombre, ancho, alto) {
			xpos=(screen.width/2)-(ancho/2);
			ypos=(screen.height/2)-(alto/2);
			window.open(url,nombre,'resizable=no,width='+ancho+',height='+alto+',left='+xpos+',top='+ypos+',statusbar=no, toolbar=no, location=no, menubar=no');
		}
	
	
		$(document).ready(function() {
			$(".bottom").append('<div id="apDiv1" class="oculto"><img name="foto_img" /></div>');
			
			var oTable = $('#example').dataTable( {
				"sScrollY": "200px",
				"bScrollCollapse": true,
				"bPaginate": true,
				"bJQueryUI": true,
				"aoColumnDefs": [
					{ "bSortable": false, "aTargets":[0]}],
				"aaSorting": [[ 0, 'asc' ]]
			} );
			
			$('#example tbody td img.detalle').live('click', function () {
					var nTr = this.parentNode.parentNode;
					if ( this.src.match('details_close') )
					{
						/* This row is already open - close it */
						this.src = "sortable/images/details_open.png";
						oTable.fnClose( nTr );
					}
					else
					{
						/* Open this row */
						this.src = "sortable/images/details_close.png";
						valor=this.id;
						oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr, valor), 'details' );
					}
			} );
			
			$("#col_1").keyup( function() { fnFilterColumn( 1 ); } );
			$("#col_2").keyup( function() { fnFilterColumn( 2 ); } );
			$("#col_3").keyup( function() { fnFilterColumn( 3 ); } );
			$("#col_4").keyup( function() { fnFilterColumn( 4 ); } );
			$("#col_5").keyup( function() { fnFilterColumn( 5 ); } );
			
			// para cambiar estado de suscriptor
			$('#example tbody td img.s_estado').live('click', function () {
				idem=this.id;
				con=idem.split("_");
				s_id=con[1];
				s_estado=con[2];
				if ( s_estado==0 )	s_estado=1;
				else if ( s_estado==1 )	s_estado=2;
				else if ( s_estado==2 )	s_estado=1;
				
				url='cambiar_estado.php';
				$.post( url, { 'id': s_id, 'valor': s_estado },function( data ) {
					if(data=='error') alert('Error - Intente nuevamente');
					else {
						$("#conte_img_"+s_id).html(data);
					}
					
				});
			});
		});
	</script>
	
</head>

<body>
<?
	$idadmin=$_SESSION['usuariox'];
	$sql="select * from admin where idadmin='".$idadmin."'";
	$rpta=mysql_query($sql);
	$user=mysql_fetch_array($rpta);		
	$login=$user['login'];
	$nombre=$user['nombre'];
	$cargo=$user['cargo'];
	
?>
<div class="caja">
  	<div class="left">
    	<h1>Datos de Usuario</h1>
<?
	echo "<p>".$login."</p>"."<p>".$nombre."</p>"."<p>".$cargo."</p>";
?>
        <div class="botones"><a href="busqueda.php"><div class="button">Actualizar</div></a></div>
    </div>
  <div class="right">
		<div class="caja_head">
        	<span class="text_izq">Consultas Especiales</span>
            <span class="text_der"><a class="link" href="salir.php">Cerrar Sesi&oacute;n</a></span>
        </div>
        <div class="formulario">
        	<form id="form1" name="form1" method="post" action="">
        	<table class="tabla" width="100%" border="0" cellspacing="2" cellpadding="0">
            	<tr>
                	<td width="33%" class="text_der">Nombre :</td>
                    <td width="35%" class="tabla_der"><input type="text" name="col_1" id="col_1" /></td>
                    <td width="10%" class="tabla_der"><img src="imagen/c_0.png"/></td>
                    <td width="22%" class="tabla_izq">: pendiente</td>
                </tr>
                <tr>
                	<td class="text_der">Email :</td>
                    <td class="tabla_der"><input type="text" name="col_2" id="col_2" /></td>
                    <td class="tabla_der"><img src="imagen/c_1.png"/></td>
                    <td class="tabla_izq">: suscrito</td>
                </tr>
                <tr>
                  <td class="text_der">Fecha :</td>
                  <td class="tabla_der"><input type="text" name="col_4" id="col_4" /></td>
                  <td class="tabla_der"><img src="imagen/c_2.png"/></td>
                  <td class="tabla_izq">: rechazado</td>
                </tr>
            </table>
        	</form>
        </div>
  </div>
    
  <div class="bottom" id="dt_example">
  	<div id="tabla-resultado">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th></th>
			<th width="30%">Nombre</th>
			<th width="40%">Email</th>
			<th width="20%">Fecha</th>
            <th width="10%">Estado</th>
		</tr>
	</thead>
	
	<tbody>
<?
$sql = "SELECT * FROM suscriptores WHERE 1";
$ex = mysql_query($sql);

while($dx=mysql_fetch_array($ex)){
	if($dx['estado']==0) $titulo='Pendiente';
	elseif($dx['estado']==1) $titulo='Suscrito';
	elseif($dx['estado']==2) $titulo='Rechazado';

	echo '<tr class="gradeA">';
	echo '<td class="center conte_estado">'.$dx['estado'].'<img class="detalle" src="sortable/images/details_open.png" id="detalle_/'.$dx['idsuscriptores'].'_/'.$dx['pdf'].'_/'.$dx['foto'].'"/></td>';
	echo '<td class="center">'.$dx['nombre'].'</td>';
	echo '<td class="center">'.$dx['email'].'</td>';
	echo '<td class="center">'.$dx['fecha'].'</td>';
	echo '<td class="center" id="conte_img_'.$dx['idsuscriptores'].'"><img class="s_estado" title="'.$titulo.'" id="cimg_'.$dx['idsuscriptores'].'_'.$dx['estado'].'" src="imagen/c_'.$dx['estado'].'.png"/></td>
		  </tr>';
}	
?>
	</tbody>
</table>
    </div>
  </div>
</div>
</body>
</html>