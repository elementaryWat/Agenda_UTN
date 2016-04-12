<?
session_start();
$Usuario=$_GET['Usuario'];
$wid=$_GET['wid'];
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
$aa="select * from usuarios where idusuario=$Usuario";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mre=mysqli_fetch_array($bb);
$lastnot=$mre['Idlastmod'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechavis=date("Y-m-d");
$horavis=date("G:i:s");
$fechavis.=" ".$horavis;
//Obtiene todas las notificaciones pertenecientes a las materias que se estan cursando
$consultatotcommat="";
	$ac="select * from suscmaterias where idusuario=$Usuario ORDER BY comisioncursado ASC";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	/*Obtiene todas las materias agrupadas por comision*/
	/*D esta forma genera la cadena que formara parte de la consulta que se encargara de obtener 
	todas las tareas pertenecientes a las materias que se estan cursando*/
	$comisionactual=0;
	$cantcom=0;
	while ($msuc=mysqli_fetch_array($ca))
	{
		$comisioncursado=$msuc['comisioncursado'];
		$cadenaconmat="";
		if ($comisioncursado!=$comisionactual)
		{
			$comisionactual=$comisioncursado;
			$ad="select * from suscmaterias where idusuario=$Usuario AND comisioncursado=$comisionactual";	
			$da=mysqli_query($con,$ad) or die ("error buscando ".$ad);
			$cantmat=0;
			while ($msum=mysqli_fetch_array($da))
			{
				$materiaa=$msum['idmateria'];
				if ($cantmat==0)
				{
					$cadenaconmat.="idmateria=".$materiaa;
				}
				else
				{
					$cadenaconmat.=" OR idmateria=".$materiaa;
				}
				$cantmat++;
			}
			if ($cantcom==0)
			{
				$consultatotcommat.="((".$cadenaconmat.") AND Comision=$comisionactual)";
			}
			else
			{
				$consultatotcommat.=" OR ((".$cadenaconmat.") AND Comision=$comisionactual)";
			}
			$cantcom++;
		}
	}
$aa="select * from notificaciones where $consultatotcommat ORDER BY idnotificacion DESC LIMIT 1";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mre=mysqli_fetch_array($bb);
$cantnot=mysqli_num_rows($bb);
$contador=0;
$lastnota=$mre['idnotificacion'];
if ($lastnota>$lastnot)
{
	//Detecta si el usuario aun no ha visto ciertas notificaciones
	$aa="select * from notificaciones where idnotificacion>$lastnot AND $consultatotcommat ORDER BY idnotificacion DESC";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	$cantidadnot=mysqli_num_rows($bb);
	while ($mre=mysqli_fetch_array($bb))
	{
		$idusuario=$mre['idusuario'];
		//Asegura que el usuario de la notificacion sea distinto del usuario actual
		if ($idusuario==$Usuario)
		{ 
			$cantidadnot--;
		}
	}
	echo $cantidadnot;
}
else
{
	echo 0;
}
?>


	