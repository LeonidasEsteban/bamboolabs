<?
	require_once('conexion2.php');
	$nombre='RIcardo';
	$email='RIkardo.corp@gmail.com';
	
		
	$fecha = date("d/m/Y");
	$addSuscriptor  = "INSERT INTO `suscriptores` (`idsuscriptores`, `nombre`, `email`, `detalle`, `fecha`, `estado`) VALUES (NULL, '$nombre', '$email', '', '$fecha', '0');";
	mysql_query($addSuscriptor)
	

?>