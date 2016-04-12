<?
session_start();
//Este script se ancarga de determinar si existen tareas que sean del dia posterior
//Ademas si estas tareas ya no han sido previamente visualizadas
//Se calcula el dia posterior
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy = date('Y-m-j');
$fechamanana = strtotime ( '+1 day' , strtotime ( $fechahoy ) ) ;
$fechamanana = date ( 'Y-m-j' , $fechamanana );

$Usuario=$_GET['Usuario'];
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
					$cadenaconmat.="Materia=".$materiaa;
				}
				else
				{
					$cadenaconmat.=" OR Materia=".$materiaa;
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
$aa="select * from tareas where ($consultatotcommat) AND Fechaentrega='$fechamanana'";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$canttareasmanana=mysqli_num_rows($bb);
$canttrab=0;
$cantpar=0;
$cantfin=0;
if ($canttareasmanana==0)
{
	echo 1;
}
else
{
	//Verifica las tareas pendientes para manana
	while ($m=mysqli_fetch_array($bb))
	{
		$idtarea=$m['idtarea'];
		$Tipo=$m['Tipo'];
		//Primero verifica si no hay en la tabla de entregados un registro con este id de tarea
		$ab="select * from entregados where Usuario=$Usuario AND Tarea=$idtarea";	
		$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
		$cantent=mysqli_num_rows($ba);
		if ($cantent==0)
		{
			//Si esta tarea no esta agregada es porque aun esta pendiente
			$cantent=1;
		}
		else
		{
			//Si ya esta entregada pero no esta verificada tambien esta pendiente
			$ab="select * from entregados where Usuario=$Usuario AND Tarea=$idtarea AND Verificado='NO'";	
			$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
			$cantent=mysqli_num_rows($ba);
		}
		if ($cantent!=0)
		{
			switch($Tipo)
			{
				case "TP":
					$canttrab++;
				break;
				case "PC":
					$cantpar++;
				break;
				case "FL":
					$cantfin++;
				break;
				case "OP":
					$canttrab++;
					break;
				case "RE":
					$canttrab++;
					break;
			}
		}
		else
		{
			//Si la tarea ya fue cumplida disminuye la cantidad de pendientes
			$canttareasmanana--;
		}
	}
	if ($canttareasmanana==0)
	{
		//Ahora se tiene la cantidad total de tareas pendientes
		echo 1;
	}
	else
	{
		echo '<div data-role="header">'
				.'<a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="consultarnotificaciones()">Close</a>'
              .'<h3 id="titulonot">Para mañana</h3>'
          .'</div>';
		if ($canttareasmanana==1)
		{
			echo '<h4>Hay 1 tarea pendiente para mañana</h4>';
		}
		else
		{
			echo '<h4>Hay '.$canttareasmanana.' tareas pendientes para mañana</h4>';
		}
		$cadenatrab="";
		$cadenapar="";
		$cadenafin="";
		if ($canttrab!=0)
		{
			if ($canttrab==1)
			{
				$cadenatrab='<li>'.$canttrab.' trabajo practico</li>';
			}
			else
			{
				$cadenatrab='<li>'.$canttrab.' trabajos practicos</li>';
			}
		}
		if ($cantpar!=0)
		{
			if ($cantpar==1)
			{
				$cadenapar='<li>'.$cantpar.' examen parcial</li>';
			}
			else
			{
				$cadenapar='<li>'.$cantpar.' examenes parciales</li>';
			}
		}
		if ($cantfin!=0)
		{
			if ($cantfin==1)
			{
				$cadenafin='<li>'.$cantfin.' examen final</li>';
			}
			else
			{
				$cadenafin='<li>'.$cantfin.' examenes finales</li>';
			}
		}
		$cadenato.='<ul>'.$cadenatrab.$cadenapar.$cadenafin.'</ul>';
		echo $cadenato;
		if ($canttareasmanana==1)
		{
			echo '<p>No olvides revisar los detalles para poder completarla</p>';
		}
		else
		{
			echo '<p>No olvides revisar los detalles para poder completarlas</p>';
		}
	}
	
	
}
?>


	