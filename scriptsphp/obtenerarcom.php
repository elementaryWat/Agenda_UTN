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

	$Cadenacom=$_GET['Cadenacom'];
	$Usuario=$_GET['Usuario'];
	$Materia=$_GET['Materia'];
	$Comision=$_GET['Comision'];
	//Ordena los archivos compartidos por fecha de comp
	$af="select * from filescomp where idmateria=".$Materia." AND Comision=".$Comision." ORDER BY Fechacomp DESC";	
	$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
	 $listaar='<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar en archivos compartidos">';
	$listaar.='<li onclick="obtenermateriascarp(\''.$Cadenacom.'\')"><a href="#" id="carpeta'.$ubicacraiz.'"><img src="../imagenes/iconosprogramas/carpeta.png"/><h1>..</h1></a></li>';
	//En caso afirmativo muestra estas materias dentro de un div inicialmente oculto con un header del nombre de la comision en la que esta cursando estas materias
	while ($msusc=mysqli_fetch_array($fa))
	{
		$idarchivo=$msusc['idarchivo'];
		$Fechacomp=$msusc['Fechacomp'];
		//Comprueba si hay archivos compartidos de la materia y comision actual 
		$ab="select * from archivos where idarchivo=$idarchivo";	
		$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
		$m=mysqli_fetch_array($ba);
					$Ruta=$m['Ruta'];
					$listaar.='<li>';
					$Nombre=$m['Nombre'];
					$Extension=$m['Extension'];
					$Tipoarchi=$m['Tipoarchi'];
					$Tamanio=$m['Tamanio'];
					//Calcula la cantidad de MiB teniendo en cuenta los bytes
					$KiB=$Tamanio/1024;
					//Redondea a dos decimales
					$KiB=round($KiB,2);
					$MiB=$Tamanio/1048576;
					$MiB=round($MiB,2);
					if ($MiB<1)
					{
						$Cadenatam=$KiB." KiB";
					}
					else
					{
						$Cadenatam=$MiB." MiB";
					}
					$Fechaagre=$m['Fechaagre'];
					$ab="select * from Tiposarchivos where idtipo=$Tipoarchi";	
					$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
                    $mp=mysqli_fetch_array($ba);
					$Imagen=$mp['Imagen'];
					$listaar.='<a href="#"><img src="../'.$Imagen.'"/>';	
					$listaar.='<h2>'.$Nombre.$Extension.'</h2>';
					$listaar.='<p>'.$Cadenatam.'</p>';
					$listaar.='<p>'.$Fechacomp.'</p>';
					$listaar.='</a></li>';	 
	}				
	$listaar.='</ul>';
echo $listaar;
?>


	