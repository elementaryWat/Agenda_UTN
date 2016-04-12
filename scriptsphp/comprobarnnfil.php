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

$Usuario=$_GET['Usuario'];
$Nombre=$_GET['Nombre'];
$Tipo=$_GET['Tipo'];
$idarchivo=$_GET['idarchivo'];
$conendir="";
if ($Tipo=="CARPETA")
{
	//Si es una carpeta se verificara si no hay ninguna con el mismo nombre en el directorio al que pertenece la misma
	$aa="select * from archivos where idarchivo=$idarchivo";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
	$marc=mysqli_fetch_array($bb);
	$dirdecar=$marc['Ubicacionfic'];
	$conendir=" AND Ubicacionfic=$dirdecar";
}
$aa="select * from archivos where Usuario=$Usuario AND Nombre='$Nombre' AND Tipoarcocar='$Tipo' $conendir ORDER BY Nombre Asc";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$canttfic=mysqli_num_rows($bb);
if ($canttfic==0)
{
	echo 1;
}
else
{
	echo 0;
}
?>


	