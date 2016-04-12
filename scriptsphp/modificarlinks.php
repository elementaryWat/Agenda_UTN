<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

$idlink=$_GET['idlink'];
$Notas=$_GET['Notas'];
$Enlace=$_GET['Enlace'];

$ab="UPDATE links SET Notas='$Notas' ,Enlace='$Enlace' WHERE idlink=$idlink";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
?>



	