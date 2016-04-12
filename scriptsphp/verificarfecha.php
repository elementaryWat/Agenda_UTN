<?
//Este script se encarga de validar la consistencia de la fecha de la tarea
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$Tipofec=$_GET['Tipofec'];
$Fechainicio=$_GET['Fechainicio'];
$Fechafin=$_GET['Fechafin'];
$Fechaunica=$_GET['Fechaunica'];
$Fechainicio=substr($Fechainicio,6,4)."-".substr($Fechainicio,3,2)."-".substr($Fechainicio,0,2);
$Fechafin=substr($Fechafin,6,4)."-".substr($Fechafin,3,2)."-".substr($Fechafin,0,2);
$Fechaunica=substr($Fechaunica,6,4)."-".substr($Fechaunica,3,2)."-".substr($Fechaunica,0,2);
function calculardiferenciafecha($fInicio,$fFinal)
{
	// Calculamos los segundos entre las dos fechas
	$fechaInicio = strtotime($fInicio);
	$fechaFinal = strtotime($fFinal);
	$segundos = ($fechaFinal - $fechaInicio);
	$dias = round($segundos/86400);
	return $dias;
}
$conterrores=0;
switch($Tipofec)
{
	case "ESP":
		$dias=calculardiferenciafecha($fechahoy,$Fechaunica);
//Verifica la relacion entre la fecha de inicio y la fecha final
	if ($dias<0)
		{
			echo "<p>Esta fecha ya ha pasado</p>";
			$conterrores++;
		}
		break;
	case "VAR":
		$dias=calculardiferenciafecha($Fechainicio,$Fechafin);
//Verifica la relacion entre la fecha de inicio y la fecha final
	if ($dias==0)
	{
		echo "<p>La fecha de inicio y la fecha final son iguales</p>";
		$conterrores++;
	}
	else
	{
		if ($dias<0)
		{
			echo "<p>La fecha de inicio es mayor que la final</p>";
			$conterrores++;
		}
	}
	$dias=calculardiferenciafecha($fechahoy,$Fechainicio);
//Verifica la relacion entre la fecha de inicio y la fecha final
	if ($dias<0)
		{
			echo "<pLa fecha de inicio ya ha pasado</p>";
			$conterrores++;
		}
		break;				
}
if ($conterrores==0)
{
	echo 1;
}

?>


	