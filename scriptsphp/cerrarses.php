<?
date_default_timezone_set('America/Argentina/Buenos_Aires');
$tiposes=$_COOKIE['tiposesutnd'];
session_start();
	session_destroy();
	setcookie('idusuarioutnd','', time() - 4200, '/'); 
		setcookie('Usuarioutnd','', time() - 4200, '/'); 
		setcookie('Nombreutnd','', time() - 4200, '/'); 
		setcookie('Apellidoutnd','', time() - 4200, '/'); 
		setcookie('Carrerautnd','', time() - 4200, '/'); 
		setcookie('Anioutnd','', time() - 4200, '/'); 
		setcookie('Comisionutnd','', time() - 4200, '/'); 

echo "ok";
?>
