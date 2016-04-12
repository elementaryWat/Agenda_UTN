<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

$idarchivo=$_GET['idarchivo'];
$Notas=$_GET['Notas'];

$ab="UPDATE archivoscom SET Notas='$Notas' WHERE idarchivo=$idarchivo";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
?>



	