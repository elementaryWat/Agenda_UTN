<?
session_start();
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

$Usuario=$_GET['Usuario'];
$Directorio=$_GET['Directorio'];
$Nombre=$_POST['nombrecar'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$horavis=date("G:i:s");
$fechahoy.=" ".$horavis;

//Verifica que no haya una carpeta del usuario con el mismo nombre y en el mismo directorio
$aa="select * from archivos where Nombre='$Nombre' AND Usuario=$Usuario AND Tipoarcocar='CARPETA' AND Ubicacionfic=$Directorio";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$canttcarpetas=mysqli_num_rows($bb);
if ($canttcarpetas==0)
{
	$aa="insert into archivos (Nombre,Tipoarcocar,Tipoarchi,Tamanio,Usuario,Fechaagre,Ruta,Ubicacionfic) values ('$Nombre','CARPETA',0,0,$Usuario,'$fechahoy','',$Directorio)";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
	$Men=1;
}
else
{
	$Men=0;
}
echo $Men;
?>


	