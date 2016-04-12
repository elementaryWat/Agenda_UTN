<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$idtarea=$_GET['Tarea'];
$Usuario=$_GET['Usuario'];
$af="select * from comentarios where Tarea=".$idtarea." ORDER BY Fechaagre ASC";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);	
		$cantcom=mysqli_num_rows($fa);
	  echo $cantcom;
?>


	