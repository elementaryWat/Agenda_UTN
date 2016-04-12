<?
session_start();
$Usuario=$_GET['Usuario'];
$Sugerencia=$_GET['Sugerencia'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechasug=date("Y-m-d");
$hora=date("G:i:s");
$fechasug.=" ".$hora;	
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
$aa="insert into sugerencias (Usuario,Sugerencia,Fecha) values ($Usuario,'$Sugerencia','$fechasug')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
echo 1;?>


	