<?
//Para obtener una estructura de arbol se usara una funcion recursiva


/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/

//Primero selecciona todas las carpetas del directorio raiz
session_start();
$cadenaarbol='<div style="width:100%"> <div data-role="collapsibleset">';
function obtenercarpetas($iddirec)
{
	$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

	$Usuario=$_GET['Usuario'];
	$idarchivo=$_GET['idarchivo'];
//Consulta el directorio al que pertenece actualmente el archivo amover para de esta forma preseleccionarlo
	$ac="select * from archivos where idarchivo=$idarchivo ORDER BY Nombre ASC";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$maar=mysqli_fetch_array($ca);
	$iddiract=$maar['Ubicacionfic'];
	
	$aa="select * from archivos where Tipoarcocar='CARPETA' AND Usuario=$Usuario AND Ubicacionfic=$iddirec  ORDER BY Nombre ASC";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	while ($mcar=mysqli_fetch_array($bb))
	{
		$idcarpeta=$mcar['idarchivo'];
		$Nombre=$mcar['Nombre'];
		//Primero verifica si no es el mismo directorio que se desea mover para decidir si  mostrarlo o no
		if ($idcarpeta!=$idarchivo)
		{
			//Verifica si hay subdirectorios del directorio actual 
			$ab="select * from archivos where Tipoarcocar='CARPETA' AND Usuario=$Usuario AND Ubicacionfic=$idcarpeta  ORDER BY Nombre ASC";	
			$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
			$cantsubcar=mysqli_num_rows($ba);
			if ($cantsubcar!=0)
			{
				if ($idcarpeta==$idarchivo)
				{
					$checkedd='checked="checked"';
					$showsino='style="display:block;"';
				}
				else
				{
					$checkedd='';
					$showsino='style="display:none;"';
				}
				$cadenaarbol.='<ul data-role="listview" data-inset="true">';
				$cadenaarbol.='<li><table width="100%" border="0" align="center">
								  <tr>
									<td width="90%" align="left"><a href="#" data-role="button" data-icon="plus" onclick="mostrarsubdir('.$idcarpeta.')" id="botmdir'.$idcarpeta.'"><p>'.$Nombre.'</p></a></td>
									<td width="10%" align="right"><input name="seldir" value="'.$idcarpeta.'" type="radio" onchange="mostrarbotmovdir()" '.$checkedd.'/></td>
								  </tr>
								</table></li>';
				//Los subdirectorios estaran contenidos en un div que tendra el id del directorio que los contiene
				//y estaran inicialemte ocultos pero con este id podran ser mostrados
				$cadenaarbol.='<li id="subdir'.$idcarpeta.'" '.$showsino.'><div style="width:100%;margin-left:2%">'.obtenercarpetas($idcarpeta).'</li>';
				$cadenaarbol.='</ul>';
			}
			else
			{
	
				$cadenaarbol.='<ul data-role="listview" data-inset="true">';
				$cadenaarbol.='<li><table width="100%" border="0" align="center">
								  <tr>
									<td width="90%" align="left">'.$Nombre.'</td>
									<td width="10%" align="right"><input name="seldir" type="radio" onchange="mostrarbotmovdir()" value="'.$idcarpeta.'"/></td>
								  </tr>
								</table></li>';
				$cadenaarbol.='</ul>';
			}
		}
		
	}
	return $cadenaarbol;
}
$arboloc=obtenercarpetas(0);
$cadenaarbol.=$arboloc;
$cadenaarbol.='</div></div>';
echo $cadenaarbol;
?>


	