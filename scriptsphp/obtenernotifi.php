<?
session_start();
function obtenerdiferenciatiempo($fInicio,$fFinal)
{
	$fechaInicio = strtotime($fInicio);
	$fechaFinal = strtotime($fFinal);
	$segundos = ($fechaFinal - $fechaInicio);
	$minutos = round($segundos/60);
	if ($minutos<60)
	{
		if ($minutos==0 || $minutos==1)
		{
			$cadenatiempo="Hace un momento";
		}
		else
		{
			$cadenatiempo="Hace ".$minutos." minutos"; 
		}
		//En caso de que no haya pasado mas de una hora muestra la cantidad de minutos
	}else
	{
		$horas = floor($segundos/3600);
		if ($horas<24)
		{
			//En case de que no haya pasado mas de un dia muestra la cantidad de horas
			$segundosRestante = ($segundos)%(3600);
			$minutos=round($segundosRestante/60);
			if ($horas==1)
				{
					$cadenaacomph="hora";
				}
				else
				{
					$cadenaacomph="horas";
				}
			if ($minutos!=0)
			{
				if ($minutos==1)
				{
					$cadenaacompm="minuto";
				}
				else
				{
					$cadenaacompm="minutos";
				}
				$cadenatiempo="Hace ".$horas." ".$cadenaacomph." y ".$minutos." ".$cadenaacompm;
				 
			}
			else
			{
				$cadenatiempo="Hace ".$horas." ".$cadenaacomph; 
			}
			
		}
		else
		{
			$dias = round($segundos/86400);
			if ($dias<7)
			{
				//Si todavia no ha pasado un mes muestra la cantidad de dias
				if ($dias==1)
				{
					$cadenaacompd="dia";
				}
				else
				{
					$cadenaacompd="dias";
				}
				$cadenatiempo="Hace ".$dias." ".$cadenaacompd; 
			}
			else
			{
				$semanas = round($segundos/604800);
				if ($semanas<5)
				{
					if ($semanas==1)
					{
						$cadenaacomps="semana";
					}
					else
					{
						$cadenaacomps="semanas";
					}
					$cadenatiempo="Hace ".$semanas." ".$cadenaacomps; 
				}	
				else
				{
					$meses = round($segundos/2592000);	
					if ($meses==1)
					{
						$cadenaacompme="mes";
					}
					else
					{
						$cadenaacompme="meses";
					}
					$cadenatiempo="Hace ".$meses." ".$cadenaacompme; 
				}
			}
		}	
	}
	return $cadenatiempo;
}
function obtenerlista($cont)
{
	global $cantidadnot,$bb,$contador,$con,$Usuario,$fechavis,$wid;
	while ($mre=mysqli_fetch_array($bb))
	{
		$idusuario=$mre['idusuario'];
		$idtarea=$mre['idtarea'];
		//Este campo de la base de datos se utiliza para determinar si la notificacion se refiere a una tarea en si o a un recurso perteneciente a ella
		$Recursosino=$mre['Recursosino'];
		$Tipo=$mre['Tipo'];
		$Nombreta=$mre['Nomtarea'];
		$Tipota=$mre['Tipota'];
		$Fechanot=$mre['Fechanot'];
		$idmateria=$mre['idmateria'];
		//Asegura que el usuario de la notificacion sea distinto del usuario actual
		if ($idusuario!=$Usuario)
		{ 
			switch($Tipo)
			{
				case "MOD":
					$cadenatype="ha modificado";
					$backcolor="#3388cc";
					$prefijo="de";
					break;
				case "INS":
					$cadenatype="ha agregado";
					$backcolor="#252655";
					$prefijo="a";
					if ($Recursosino!="NO")
					{
						$prefijo="de";
					}
					break;
				case "ELI":
					$cadenatype="ha eliminado";
					$backcolor="#F85507";
					$prefijo="de";
					break;
			}
			$ab="select * from usuarios where idusuario=$idusuario";	
			$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
			$mus=mysqli_fetch_array($ba);
			$Nombreus=$mus['Nombre'];
			$Nombreus.=" ".$mus['Apellido'];
			if ($Recursosino!="NO")
			{
				$ab="select * from tareas where idtarea=$idtarea";	
				$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
				$mus=mysqli_fetch_array($ba);
				$cantta=mysqli_num_rows($ba);
				//Si la tarea fue eliminada 
				if ($cantta==0)
				{
					$ab="select * from notificaciones where idtarea=$idtarea AND Tipo='ELI'";	
					$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
					$musn=mysqli_fetch_array($ba);
					$Nombreta=$musn['Nomtarea'];
					$Tipota=$musn['Tipota'];
					$idmateria=$musn['idmateria'];
				}
				else
				{
					$Nombreta=$mus['Nombre'];
					$Tipota=$mus['Tipo'];
					$idmateria=$mus['Materia'];
				}
				switch ($Recursosino)
				{
					//Determina el tipo de recurso
					case "LINK":
					$tiporecurso=" un link ";
					break;
					case "ARCHIVO":
					$tiporecurso=" un archivo ";
					break;
					case "COMENTARIO":
					$tiporecurso=" un comentario ";
					break;
				}
				if ($Tipo=="ELI")
				{
					$tiporecurso.="del ";
				}
				else
				{
					$tiporecurso.="al ";
				}
			}
			//Si esta notificacion no se refiere a un recurso y ya ha sido eliminada la tarea en cuestion
			else
			{
				if ($Tipo!="ELI")
				{
					$ab="select * from tareas where idtarea=$idtarea";	
					$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
					$mus=mysqli_fetch_array($ba);
					$cantta=mysqli_num_rows($ba);
					//Si la tarea fue eliminada 
					if ($cantta==0)
					{
						$ab="select * from notificaciones where idtarea=$idtarea AND Tipo='ELI'";	
						$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
						$musn=mysqli_fetch_array($ba);
						$Nombreta=$musn['Nomtarea'];
						$Tipota=$musn['Tipota'];
						$idmateria=$musn['idmateria'];
					}
					else
					{
						$Nombreta=$mus['Nombre'];
						$Tipota=$mus['Tipo'];
						$idmateria=$mus['Materia'];
					}
				}
				$tiporecurso=" el ";
			}
			$ac="select * from materias where idmateria=".$idmateria;	
				$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
				$mma=mysqli_fetch_array($ca);
				$Nombremat=$mma['Nombremateria'];
			
			switch($Tipota)
			{
				case "TP":
					$cadenattar="trabajo practico ";
					break;
				case "PC":
					$cadenattar="parcial ";
					break;
				case "FL":
					$cadenattar="examen final ";
					break;
				case "OP":
					$cadenattar="trabajo opcional ";
					break;
				case "RE":
					$cadenattar="recuperatorio ";
					break;
			}
			

			$tiemponotif=obtenerdiferenciatiempo($Fechanot,$fechavis);
			$cadenanotificacion.='<div style="background-color:'.$backcolor.'; color:#FFF;"><p><table width="100%" border="0">'
			 .' <tbody>'
				.'<tr>'
				  .'<td><img src="../imagenes/fp.JPG" width="100" heigth="100"  alt="imgper" style="border-radius: 50%; /* Borde redondeado */'
.'box-shadow: 0px 0px 15px #000; /* Sombra */'
.'-moz-transition: all 1s;'
.'-webkit-transition: all 1s;'
.'-o-transition: all 1s;'
.'cursor:pointer;"/></td>'
				  .'<td>'.$Nombreus.' '.$cadenatype.$tiporecurso.$cadenattar.'<strong>'.$Nombreta."</strong> ".$prefijo .' la materia '.$Nombremat.' <span style="font-style: italic; color:#CCC;">'.$tiemponotif.'</span></td>'
				.'</tr>'
			  .'</tbody>'
			.'</table></p></div>';
			
			//Contador usado para mostrar solo los 4 primeros registros
			$contador++;
			if ($cont!=0)
			{
				if ($contador==$cont)
				{
					break;
				}
			}
			
		}
		else
		{
			$cantidadnot--;
		}
	}
	return $cadenanotificacion;
}
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
if ($cantnot!=0)
{
	$aa="UPDATE usuarios SET Idlastmod=$lastnota WHERE idusuario=$Usuario";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
}
if ($lastnota>$lastnot)
{
	//Detecta si el usuario aun no ha visto ciertas notificaciones
	$aa="select * from notificaciones where idnotificacion>$lastnot AND $consultatotcommat ORDER BY idnotificacion DESC";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	$cantidadnot=mysqli_num_rows($bb);
		$contador=0;
	$cadenanotificacion=obtenerlista(4);
	echo $cadenanotificacion;
	
	//Inicializa la notificacion en cadena vacia para comprobar si se debe o no mostrar una notificacion mas adelante
	$cadenanotificacion="";
	$contador=0;
	$cadenanotificacion=obtenerlista(0);
	
	
	
	//Comprueba si hay una notificacion extra que mostrar
	if ($cadenanotificacion!="")
	{
		echo '<div data-role="collapsible" data-theme="a" data-collapsed="true">';
		echo '<h2>Todas las notificaciones('.$contador.'+)</h2>';
		echo $cadenanotificacion;
		echo '</div>';
	}
	//No hay notificaciones que mostrar
	if ($cantidadnot==0)
	{
		echo 1;
	}
}
else
{
	echo 1;
}
?>


	