<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechasegui=date("Y-m-d");
$hora=date("G:i:s");
$fechasegui.=" ".$hora;	

$Tarea=$_GET['Tarea'];
$Usuario=$_GET['Usuario'];

//Determina la materia de la tarea

$ab="insert into seguidos (Usuario,Tarea,Fechaseguido) values ($Usuario,$Tarea,'$fechasegui')";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
?>



	