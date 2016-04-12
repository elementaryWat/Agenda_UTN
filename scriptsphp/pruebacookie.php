<?
	// Caduca en un año 
    setcookie('contador',"sesionUTNtempp", time() + 365 * 24 * 60 * 60); 
    $mensaje = 'Tipo de sesion: ' . $_COOKIE['contador'];
	echo $mensaje; 
?>
