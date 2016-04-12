<?
session_start();
$Usuario=$_GET['Usuario'];
$Pass=$_GET['Pass'];
$Nombre=$_GET['Nombre'];
$Apellido=$_GET['Apellido'];
$Carrera=$_GET['Carrera'];
$Email=$_GET['Email'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$hora=date("G:i:s");
$fechahoy.=" ".$hora;
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$aa="select * from notificaciones ORDER BY idnotificacion DESC LIMIT 1";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mre=mysqli_fetch_array($bb);
$lastnota=$mre['idnotificacion'];
$ab="insert into usuarios (Usuario,Pass,Nombre,Apellido,Carrera,Email,Fecharegistro,Idlastmod) values ('$Usuario','$Pass','$Nombre','$Apellido',$Carrera,'$Email','$fechahoy',$lastnota)";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$ab="select * from usuarios ORDER BY idusuario DESC LIMIT 1";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$m=mysqli_fetch_array($ba);
$idusuario=$m['idusuario'];
echo 1;
$_SESSION["idusuarioutnd"] = $idusuario;
	$_SESSION["Usuarioutnd"] = $Usuario;
	$_SESSION["Nombreutnd"] = $Nombre;
	$_SESSION["Apellidoutnd"] = $Apellido;
	$_SESSION["Carrerautnd"] = $Carrera;
?>


	