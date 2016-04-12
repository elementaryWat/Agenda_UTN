<?
session_start();
//Para obtener una estructura de arbol se usara una funcion recursiva


/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/

//Primero selecciona todas las carpetas del directorio raiz
	$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

	$idarchivo=$_GET['idarchivo'];
	$Newdir=$_GET['Newdir'];
	
	$ac="select * from  archivos where idarchivo=$idarchivo";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$mar=mysqli_fetch_array($ca);
	$Nombre=$mar['Nombre'];
	$Tipo=$mar['Tipoarcocar'];
	$cantwtsn=0;
	if ($Tipo=="CARPETA")
	{
		//Verifica que no haya una carpeta con el mismo nombre en el nuevo directorio a colocar
		$ac="select * from  archivos where Nombre='$Nombre' AND Ubicacionfic=$Newdir";	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		$cantwtsn=mysqli_num_rows($ca);
	}
	if ($cantwtsn==0)
	{
		$ac="UPDATE archivos SET Ubicacionfic=$Newdir where idarchivo=$idarchivo";	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		echo 1;
	}
	else
	{
		echo 0;
	}
	
?>


	