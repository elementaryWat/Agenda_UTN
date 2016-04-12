<?
session_start();
$Usuario=$_GET['Usuario'];

$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

//Primero elimina todas las materias a las que esta suscrito el usuario
$ab="delete from suscmaterias where idusuario=$Usuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
?>



	