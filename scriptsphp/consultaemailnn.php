<?
session_start();
$Email=$_GET['Email'];
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
$aa="select * from usuarios where Email='$Email'";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$cantuser=mysqli_num_rows($bb);
$respuesta="";
if ($cantuser==0)
{
	echo 1;
}
else
{;
	echo 0;
}
?>


	