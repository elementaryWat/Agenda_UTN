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

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");

$cadenacar="";
if ($Directorio!=0)
{
	//Determina el directorio al que debe regresar al presionar el boton de atras 
	//En otras palabras el directorio raiz del directorio actual
	$aa="select * from archivos where idarchivo=$Directorio AND Tipoarcocar='CARPETA'";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
	$mcarp=mysqli_fetch_array($bb);
	$ubicacraiz=$mcarp['Ubicacionfic'];
	$cadenacar.='<li onclick="mostraropcgen()" ondblclick="cambiardirectorio('.$ubicacraiz.')"><a href="#" id="carpeta'.$ubicacraiz.'"><img src="../imagenes/iconosprogramas/carpeta.png"/><h1>..</h1></a></li>';
}
//Primero selecciona todas las "carpetas" del directorio actual
$aa="select * from archivos where Usuario=$Usuario AND Ubicacionfic=$Directorio AND Tipoarcocar='CARPETA' ORDER BY Nombre Asc";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$canttcarpetas=mysqli_num_rows($bb);
if ($canttcarpetas!=0)
{
           		while ($m=mysqli_fetch_array($bb)){
					$idarchivo=$m['idarchivo'];
					$cadenacar.='<li onclick="obteneropciones('.$idarchivo.',\'CARPETA\')"  ondblclick="cambiardirectorio('.$idarchivo.')" id="carpeta'.$idarchivo.'">';
					$Nombre=$m['Nombre'];
					$cadenacar.='<a href="#"><img src="../imagenes/iconosprogramas/carpeta.png"/>';	
                    $cadenacar.='<h1><span id="nombrevista'.$idarchivo.'">'.$Nombre.'</span><span id="nombreedit'.$idarchivo.'" style="display:none"><input id="newnom'.$idarchivo.'" type="text" value="'.$Nombre.'"/></span></h1>';
					
					//Cuenta y muestra la cantidad de subficheros de la carpeta actual en un span burbuja
					$ac="select * from archivos where Usuario=$Usuario AND Ubicacionfic=$idarchivo ORDER BY Nombre Asc";	
					$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);	
					$canttsubfic=mysqli_num_rows($ca);
					$cadenacar.='<span class="ui-li-count">'.$canttsubfic.'</span>';
					$cadenacar.='</a></li>';
						 
                } 
}
//Luego selecciona los archivos del directorio actual
$aa="select * from archivos where Usuario=$Usuario AND Ubicacionfic=$Directorio AND Tipoarcocar='ARCHIVO' ORDER BY Nombre Asc";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$canttarchivos=mysqli_num_rows($bb);
if ($canttarchivos!=0)
{
           		while ($m=mysqli_fetch_array($bb)){
					$idarchivo=$m['idarchivo'];
					$Ruta=$m['Ruta'];
					$cadenacar.='<li onclick="obteneropciones('.$idarchivo.',\'ARCHIVO\',\'http://www.utndiarybeta.890m.com/'.$Ruta.'\')">';
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
					$cadenacar.='<a href="#"><img src="../'.$Imagen.'"/>';	
					$cadenacar.='<h2><span id="nombrevista'.$idarchivo.'">'.$Nombre.$Extension.'</span><table width="100%" border="0" id="nombreedit'.$idarchivo.'" style="display:none">
					  <tr>
						<td><input id="newnom'.$idarchivo.'" type="text" value="'.$Nombre.'"/></td>
						<td>'.$Extension.'</td>
					  </tr>
					</table></h2>';
                    $cadenacar.='';
					$cadenacar.='<p>'.$Cadenatam.'</p>';
					$cadenacar.='<p>'.$Fechaagre.'</p>';
					$cadenacar.='</a></li>';	 
                } 
}
 $cadenacar.='</ul>';
 if ($canttcarpetas!=0 || $canttarchivos!=0)
 {
	 $cadenacar='<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar archivo o carpeta">'.$cadenacar;
	 echo $cadenacar;
}
else
{
	$cadenacar='<ul data-role="listview" data-inset="true">'.$cadenacar;
	echo $cadenacar;
	if ($Directorio==0)
	{
		echo "<p>Aun no tienes ningun fichero</p>";
	}
	else
	{
		echo "<p>No hay ningun fichero aqui</p>";
	}
}
?>


	