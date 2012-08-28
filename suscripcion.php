<?
	require_once('conexion.php');
	$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	
	$sql="SELECT * FROM `suscriptores` WHERE `email`='$email';";
	$aux=mysql_fetch_array(mysql_query($sql));
	
	
	// detalles 
	//	0 = error de consulta mysql
	//	1 = insercion de suscriptor exitosa
	//  2 = email existente
	
	if($aux==''){
		$fecha = date("d/m/Y");
		$addSuscriptor  = "INSERT INTO `suscriptores` (`idsuscriptores`, `nombre`, `email`, `detalle`, `fecha`, `estado`) VALUES (NULL, '$nombre', '$email', '', '$fecha', '0');";
		$valor = (mysql_query($addSuscriptor)) ? '1' : '0';
		echo $valor;
	}
	else
		echo '2';
?>