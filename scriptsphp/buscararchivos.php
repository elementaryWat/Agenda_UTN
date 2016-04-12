<?
//Para obtener una estructura de arbol se usara una funcion recursiva


/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
session_start();
	$Busqueda=$_GET['Busqueda'];
	$Usuario=$_GET['Usuario'];
	$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
	function obtenercadenaruta($Ficheroo)
	{
		$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
		mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
		$ab="select * from archivos where idarchivo=".$Ficheroo;	
		$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
		$maar=mysqli_fetch_array($ba);
			$idarchivo=$maar['idarchivo'];
			$Nombre=$maar['Nombre'];
			$Ubicacion=$maar['Ubicacionfic'];
			if ($Ubicacion!=0)
			{
				$cadenaruta=obtenercadenaruta($Ubicacion).$Nombre."/";
			}
			else
			{
				$cadenaruta="/".$Nombre."/";
			}
			return $cadenaruta;
	}
	if ($Busqueda!="")
	{
		$listamat.='<ul data-role="listview">';
		$af="select * from archivos where Nombre LIKE '%$Busqueda%' AND Tipoarcocar='ARCHIVO' ORDER BY Nombre ASC";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
		while ($msusc=mysqli_fetch_array($fa))
		{
			$idarchivo=$msusc['idarchivo'];
			$Nombre=$msusc['Nombre'];
			$Tipoarchi=$msusc['Tipoarchi'];
			$Ubicacion=$msusc['Ubicacionfic'];
			$ac="select * from Tiposarchivos where idtipo=$Tipoarchi";	
			$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);	
            $mp=mysqli_fetch_array($ca);
			$Imagen=$mp['Imagen'];
			$Tamanio=$msusc['Tamanio'];
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
			if ($Ubicacion!=0)
			{
				$cadenaruta=obtenercadenaruta($Ubicacion).$Nombre;
			}
			else
			{
				$cadenaruta="/".$Nombre;
			}
			$replacee="<u>".$Busqueda."</u>";
			$Nombre=str_replace('%'.$Busqueda.'%',$replacee,$Nombre);
			//Le pasa nuevamente como argumento la cadena de la comision para poder volver al raiz
			$listamat.='<li onclick="seleccionado('.$idarchivo.',\''.$Imagen.'\',\''.$Nombre.'\',\''.$Cadenatam.'\')" id="arch'.$idarchivo.'">';
			$listamat.='<a href="#"><img src="../'.$Imagen.'"/>';	
			$listamat.='<h1>'.$Nombre.'</h1>';
			$listamat.='<p>'.$cadenaruta.'</p>';
			$listamat.='</a></li>';
		}				
		$listamat.='</ul>';
	}
	else
	{
		$listmat="";
	}
echo $listamat;
?>


	