<? 
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
//Recibe el tipo de sesion
//es decir si esta sera temporal o prolongada (se mantendra la sesion iniciada en el dispositivo)
//En el caso de que sea prolongada se usaran cookies 
//Sino variables de sesion
//Cadena temporal sesionUTNtempp
//Cadena temporal sesionUTNprol
$tiposesion=$_GET['tiposesion'];
$usuario=$_GET['usuario'];
$pass=$_GET['pass'];
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");

$a="select * from usuarios where Usuario = '$usuario'";
$b = mysqli_query ($con,$a)
or die ("error buscando".$a);
$cant=mysqli_num_rows($b);
$m=mysqli_fetch_array ($b);
if ($cant <> 0 ) {
	$idusuario=$m['idusuario'];
	$usuario=$m['Usuario'];
	$passus=$m['Pass'];
	$Nombre=$m['Nombre'];
	$Apellido=$m['Apellido'];
	$Carrera=$m['Carrera'];
	if ($pass == $passus ) {
	setcookie('tiposesutnd',$tiposesion, time() + 365 * 24 * 60 * 60); 
	if ($tiposesion=="sesionUTNtempp")
	{
		$_SESSION["idusuarioutnd"] = $idusuario;
		$_SESSION["Usuarioutnd"] = $usuario;
		$_SESSION["Nombreutnd"] = $Nombre;
		$_SESSION["Apellidoutnd"] = $Apellido;
		$_SESSION["Carrerautnd"] = $Carrera;
		$_SESSION["dbservidor"]="mysql.hostinger.com.ar";
		$_SESSION["dbnusuario"]="u376876484_agen2";
		$_SESSION["dbpass"]="utniano2";
		$_SESSION["dbnombre"]="u376876484_agen2";
		$_SESSION["dbmensaje"]="no se ha podido encontrar la base de datos";
	}
	else if ($tiposesion=="sesionUTNprol")
	{
		//Duracion de la "session" 1 anio
		setcookie('idusuarioutnd',$idusuario, time() + 365 * 24 * 60 * 60); 
		setcookie('Usuarioutnd',$usuario, time() + 365 * 24 * 60 * 60); 
		setcookie('Nombreutnd',$Nombre, time() + 365 * 24 * 60 * 60); 
		setcookie('Apellidoutnd',$Apellido, time() + 365 * 24 * 60 * 60); 
		setcookie('Carrerautnd',$Carrera, time() + 365 * 24 * 60 * 60); 
		setcookie('dbservidor',"mysql.hostinger.com.ar", time() + 365 * 24 * 60 * 60); 
		setcookie('dbnusuario',"u376876484_agen2", time() + 365 * 24 * 60 * 60); 
		setcookie('dbpass',"utniano2", time() + 365 * 24 * 60 * 60); 
		setcookie('dbnombre',"u376876484_agen2", time() + 365 * 24 * 60 * 60); 
		setcookie('dbmensaje',"no se ha podido encontrar la base de datos", time() + 365 * 24 * 60 * 60); 
	}
	echo "ok";
	} else {
	echo "no";
	}
} else {
echo "no";
}
?>