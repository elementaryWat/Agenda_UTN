<?php
$Usuario=$_GET['Usuario'];
session_start();
$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
$Tipocom=$_GET['Tipocom'];
$Usuario=$_GET['Usuario'];
$Carrera=$_GET['Carrera'];
$Rango=$_GET['Rango'];
$_SESSION["Rango"]=$Rango;

switch($Rango)
{
	case "Todas":
	$consultatotcommat="";
	$ac="select * from suscmaterias where idusuario=$Usuario ORDER BY comisioncursado ASC";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
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
		$consultarango=$consultatotcommat;
		$cadenarango="";
		$cadenabusqmat="";
		break;
	default:
	$ab="select * from materias where idmateria=$Rango";	
	$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
    $mp=mysqli_fetch_array($ba);
	$Nombremateria=$mp['Abrevmateria'];
	$ac="select * from suscmaterias where idmateria=$Rango";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$msum=mysqli_fetch_array($ca);
	$comisioncursadomat=$msum['comisioncursado'];
	$consultarango="Materia=$Rango AND Comision=$comisioncursadomat";
}
$Criterio=$_GET['Criterio'];
$_SESSION["Criterio"]=$Criterio;
switch($Criterio)
{
	case "Todos":
		$consultacriterio="";
		break;
	default:
	$consultacriterio="AND Tipo='$Criterio'";
	if ($Criterio=="TP")
	{
		//Para los trabajos busca tantos aquellos obligatorios como opcionales
		$consultacriterio="AND (Tipo='TP' OR Tipo='OP')";
	}
}
$cadenaswow=$cadenacriterio.$cadenarango;
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$hora=date("G:i:s");
$fechahoy.=" ".$hora;

$aa="select * from tareas where ($consultarango) $consultacriterio AND (Fechaentrega>='$fechahoy') ORDER BY Fechaentrega Asc";	
$ba=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$days=2;
$separator='';
$out="";
$out.= '[';
for ($i = 1 ; $i < $days; $i= 1 + $i * 2) {
	$out.= $separator;
	$initTime = (intval(microtime(true))*1000) - (8640000000000);
	$out.= '	{ "date": "'; $out.= $initTime; $out.= '", "type": "Parcial", "title": "Project '; $out.= $i; $out.= ' meeting", "description": "Lorem Ipsum dolor set", "url": "http://www.event1.com/" }';
}
$separator=',';
while ($mref=mysqli_fetch_array($ba))
{
	$idtarea=$mref['idtarea'];
	$Nombree=$mref['Nombre'];
	$Materia=$mref['Materia'];
	$Fechaa=$mref['Fechaentrega'];
	$Usuarioagre=$mref['Usuarioagre'];
	$Tipo=$mref['Tipo'];
	$Detalles=$mref['Detalles'];
	$Compartido=$mref['Compartido'];
		$muestra=false;
		$seguida=false;
		$ae="select * from seguidos where Tarea=$idtarea AND Usuario=$Usuario";	
		$ea=mysqli_query($con,$ae) or die ("error buscando ".$ae);
		$cantseg=mysqli_num_rows($ea);
		if ($cantseg!=0)
		{
			$seguida=true;
		}
		if ($Tipocom=="Personales")
		{
			if ($Usuarioagre==$Usuario || ($seguida && $Compartido=="SI"))
			{
				$muestra=true;
			}
		}
		else if ($Tipocom=="Compartidas")
		{
			if ($Usuarioagre!=$Usuario && !$seguida && $Compartido=="SI")
			{
				$muestra=true;
			}
		}
	if ($muestra)
	{
		$Tipoc="";
		$ac="select * from materias where idmateria=".$Materia;	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		$mrem=mysqli_fetch_array($ca);
		$Nombremateria=$mrem['Nombremateria'];
			
		switch($Tipo)
		{
			case 'TP':
			case 'PC':
			case 'RE':
				$Tipoc="Parcial";
			break;
			case 'FL':
				$Tipoc="Final";
			break;
		}
		$out.= $separator.' { "date": "'.((strtotime($Fechaa)*1000)).'", "type": "'.$Tipoc.'", "title": "'.$Nombree.'", "description": "Materia: '.$Nombremateria.' ", "url": "#tarea'.$idtarea.'" } ';	
	}
}
if ($Rango=="Todas" && $Criterio=="Todos")
{
	$aa="select * from feriados where Fecha>='$fechahoy'";	
	$ba=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	while ($mref=mysqli_fetch_array($ba))
	{
		$Nombree=$mref['Nombre'];
		$Fecha=((strtotime($mref['Fecha'])*1000));
			
		$out.= $separator.' { "date": "'.$Fecha.'", "type": "Descanso", "title": "'.$Nombree.'", "description": "Feriado", "url": "#" } ';	
	}	
}

$out.= ']';
echo $out;
?>