<?
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

$idarchivo=$_GET['idarchivo'];
$Newname=$_GET['Newname'];

$cadenacar="";
//Primero selecciona todas las "carpetas" del directorio actual
$aa="UPDATE archivos SET Nombre='$Newname' where idarchivo=$idarchivo";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
echo 1;
?>


	