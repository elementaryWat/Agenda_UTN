<?
//Para obtener una estructura de arbol se usara una funcion recursiva


/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
//Para eso se utiliza una estructura recursiva de la siguiente funcion que va de forma ascendente desde el subnivel  mas "bajo" de un directorio eliminando todos los archivos y carpetas del mismo tanto de la bd como del HDD
session_start();
	$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
	
	function eliminarsubarchivos($iddir)
	{
		$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
		mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
		$ad="select * from archivos where Ubicacionfic=$iddir";	
		$da=mysqli_query($con,$ad) or die ("error buscando ".$ad);
		$cantar=mysqli_num_rows($da);
		if ($cantar!=0)
		{
			while($mar=mysqli_fetch_array($da))
			{
				$idarchivo=$mar['idarchivo'];
				$Tipoarcocar=$mar['Tipoarcocar'];
				$Ruta='../'.$mar['Ruta'];
				//Si es una carpeta "ingresa" a ella para eliminar todos sus subarchivos
				if ($Tipoarcocar=="CARPETA")
				{
					eliminarsubarchivos($idarchivo);
				}
				else
				{
					//Si es un simple archivo directamente lo elimina del disco del servidor
					unlink($Ruta);
				}
				$ac="DELETE from archivos where idarchivo=$idarchivo";	
				$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
			}
		}
		
	}
//Primero selecciona todas las carpetas del directorio raiz

	$idarchivo=$_GET['idarchivo'];
	$Tipo=$_GET['Tipo'];
	if ($Tipo=="CARPETA")
	{
		//Si es una carpeta llama a la funcion encargada de eliminar todos los subdirectorios y subarchivos
		eliminarsubarchivos($idarchivo);
	}
	else
	{
		//Sino lo elimina directamente de la DB y del HDD del servidor
		$ac="select * from archivos where idarchivo=$idarchivo";	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		$mar=mysqli_fetch_array($ca);
		$Ruta='../'.$mar['Ruta'];
		unlink($Ruta);
	}
	$ac="DELETE FROM archivos where idarchivo=$idarchivo";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);


	
	echo 1;
?>


	