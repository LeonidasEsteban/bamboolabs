<?php session_start();
require_once("../conexion.php");
	$error=1;
	$sql="select * from admin where login='".$_POST['usuario']."' and password='".$_POST['pass']."'";
	$rpta=mysql_query($sql);
	$user=mysql_fetch_array($rpta);	
	if(mysql_num_rows($rpta)==1)
	{
		if($user['privilegios']=='1')
			$_SESSION['privilegios']='si';
		else
			$_SESSION['privilegios']='no';
			
		$_SESSION['usuariox']=$user['idadmin'];
		$_SESSION['open']=1;
		$_SESSION['opc']='vacio';
		header("Location: busqueda.php");
		die();
	}
	else header("Location: index.php");
	
	die();
?>