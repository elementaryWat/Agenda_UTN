<?
//Para obtener una estructura de arbol se usara una funcion recursiva


/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/

//Primero selecciona todas las carpetas del directorio raiz
session_start();
	$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

	$Comision=$_GET['Comision'];
	$Idmateria=$_GET['Idmateria'];
	$Idarchivo=$_GET['Idarchivo'];
	$Usuario=$_GET['Usuario'];
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$fechahoy=date("Y-m-d");
	$horavis=date("G:i:s");
	$fechahoy.=" ".$horavis;
	
	//Primero verifica que este archivo no haya sido conmpartido previamente
	$ac="select * from  filescomp where idarchivo=$Idarchivo";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$cantar=mysqli_num_rows($ca);
	if ($cantar==0)
	{
		$ac="insert into filescomp (idarchivo,idusuario,idmateria,Comision,Fechacomp) values ($Idarchivo,$Usuario,$Idmateria,$Comision,'$fechahoy')";	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		echo 1;
	}
	else
	{
		echo 0;
	}
	
?>


	