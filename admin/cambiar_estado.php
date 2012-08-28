<?
	require_once('../conexion.php');
	$idem=$_POST['id'];
	$valor=$_POST['valor'];
	
	$titulo= $valor==1? "Suscrito":"Rechazado";
		
	
	$sql="UPDATE `suscriptores` SET `estado` = '$valor' WHERE `idsuscriptores` = $idem LIMIT 1;";
	$texto='<img class="s_estado" title="'.$titulo.'" id="cimg_'.$idem.'_'.$valor.'" src="imagen/c_'.$valor.'.png"/>';
	
	if(!mysql_query($sql))
		echo 'error';
	else
		echo $texto; 
	

?>