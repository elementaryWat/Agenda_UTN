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
function calculardiferenciafecha($fInicio,$fFinal)
{
	// Calculamos los segundos entre las dos fechas
	$fechaInicio = strtotime($fInicio);
	$fechaFinal = strtotime($fFinal);
	$segundos = ($fechaFinal - $fechaInicio);
	$dias = round($segundos/86400);
	$meses = floor($segundos/2592000);
	$segundosRestante = ($segundos)%(2592000);
	$semanas = round($segundosRestante/604800);
	
	if ($dias==0)
	{
		$cadenadia="Hoy";
	}
	else
	{
		if ($dias==1)
		{
			$cadenadia="Mañana";
		}
		else
		{
			if ($dias>30)
			{
				if ($meses==0)
				{
					$cadenameses="";
				}
				else
				{
					if ($meses==1)
					{
						$cadenameses=" 1 mes";
					}
					else
					{
						$cadenameses=$meses. " meses";
					}
				}
				if ($semanas==0)
				{
					$cadenasemanas="";
				}
				else
				{
					if ($semanas==1)
					{
						$cadenasemanas=" y 1 semana";
					}
					else
					{
						$cadenasemanas=" y ".$semanas. " semanas";
					}
				}
				$cadenadia="En ".$cadenameses.$cadenasemanas;
			}
			else
			{
				$cadenadia="En ".$dias. " d&iacute;as";
			}
		}
	}
	$cadenafinal=$cadenadia;
	return $cadenafinal;
}
function deferenciadedias($fIni,$fFin)
{
	// Calculamos los segundos entre las dos fechas
	$fechaI = strtotime($fIni);
	$fechaF = strtotime($fFin);
	$segundos = ($fechaF - $fechaI);
	$dias = round($segundos/86400);
	return $dias;
}
$Tipocom=$_GET['Tipocom'];
$Usuario=$_GET['Usuario'];
$Carrera=$_GET['Carrera'];
$Rango=$_GET['Rango'];
$conscomp="";

switch($Rango)
{
	case "Todas":
	/*Obtiene las materias que esta cursando el usuario
	Y para cada materia obtiene el id y va formando una cadena que sera usada 
	para obtener la lista de tareas de esa materia y comsision
	*/
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
		$consultarango=$consultatotcommat;
		$cadenarango="";
		$cadenabusqmat="";
		break;
	default:
	$ab="select * from materias where idmateria=$Rango";	
	$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
    $mp=mysqli_fetch_array($ba);
	$Nombremateria=$mp['Abrevmateria'];
	/*
	Obtiene la comision en la que esta cursando la mteria seleccionada
	*/
	$ac="select * from suscmaterias where idmateria=$Rango";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$msum=mysqli_fetch_array($ca);
	$comisioncursadomat=$msum['comisioncursado'];
	$consultarango="Materia=$Rango AND Comision=$comisioncursadomat";
	$cadenarango=" en esta materia";
	$cadenabusqmat=" en " .$Nombremateria;
}
$Criterio=$_GET['Criterio'];
switch($Criterio)
{
	case "Todos":
		$consultacriterio="";
		$cadenatoshoww="Lista de tareas";
		$cadenabusqueda="Buscar tarea";
		$cadenacriterio="No hay ninguna tarea";
		break;
	default:
	$consultacriterio="AND Tipo='$Criterio'";
	if ($Criterio=="TP")
	{
		//Para los trabajos busca tantos aquellos obligatorios como opcionales
		$consultacriterio="AND (Tipo='TP' OR Tipo='OP')";
		$cadenabusqueda="Buscar trabajo practico";
		$cadenatoshoww="Lista de trabajos practicos";
		$cadenacriterio="No hay ningun trabajo practico";
	} else if ($Criterio=="PC")
	{
		$cadenabusqueda="Buscar parcial";
		$cadenatoshoww="Lista de parciales";
		$cadenacriterio="No hay ningun parcial";
	} else if ($Criterio=="FL")
	{
		$cadenabusqueda="Buscar final";
		$cadenatoshoww="Lista de finales";
		$cadenacriterio="No hay ningun final";
	}else if ($Criterio=="RE")
	{
		$cadenabusqueda="Buscar recuperatorio";
		$cadenatoshoww="Lista de recuperatorios";
		$cadenacriterio="No hay ningun recuperatorio";
	}
}
$cadenaswow=$cadenacriterio.$cadenarango;
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$fechahoy=date("Y-m-d");
$hora=date("G:i:s");
$fechahoy.=" ".$hora;


$aa="select * from tareas where ($consultarango) $consultacriterio AND (Fechaentrega>='$fechahoy' OR Fechafin>='$fechahoy') ORDER BY Fechaentrega Asc";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$canttareas=mysqli_num_rows($bb);
$saltar="";
if ($canttareas!=0)
{
			$saltar.='<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="'.$cadenabusqueda.$cadenabusqmat.'">';
           		while ($m=mysqli_fetch_array($bb)){
					$idtarea=$m['idtarea'];
					$Nombre=$m['Nombre'];
					$Fechaentrega=$m['Fechaentrega'];
					$Tipofecha=$m['Tipofecha'];
					$Fechafin=$m['Fechafin'];
					$Usuarioagre=$m['Usuarioagre'];
					$Tipo=$m['Tipo'];
					$idmateria=$m['Materia'];
					$Compartido=$m['Compartido'];
					$muestra=false;
					$seguida=false;
					$personal=true;
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
						else
						{
							$canttareas--;
						}
					}
					else if ($Tipocom=="Compartidas")
					
					{
						if ($Usuarioagre!=$Usuario && (!$seguida && $Compartido=="SI"))
						{
							$muestra=true;
							$personal=false;
						}
						else
						{
							$canttareas--;
						}
					}
					if ($muestra)
					{
						$saltar.='<li><a href="#dialogotarea" onclick="obtenerdetallestarea('.$idtarea.')" data-rel="dialog">';
						switch($Tipo)
						{
							case "TP":
								$Tipota="Trabajo Practico";
								break;
							case "PC":
								$Tipota="Parcial";
								break;
							case "FL":
								$Tipota="Final";
								break;
							case "RE":
								$Tipota="Recuperatorio";
								break;
							case "OP":
								$Tipota="Trab. Pract.(opcional)";
								break;
						}
						$ab="select * from materias where idmateria=$idmateria";	
						$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
						$mp=mysqli_fetch_array($ba);
						$Materia=$mp['Nombremateria'];
						$ab="select * from entregados where Usuario=$Usuario AND Tarea=$idtarea AND Verificado='SI'";	
						$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
						$cantent=mysqli_num_rows($ba);
						date_default_timezone_set('America/Argentina/Buenos_Aires');
						$fechahoy=date("Y-m-d");
						
						$dias=calculardiferenciafecha($fechahoy,$Fechaentrega);
						$cdiasinicio=deferenciadedias($fechahoy,$Fechaentrega);
						$cdiasfinl=deferenciadedias($fechahoy,$Fechafin);
						if ($Tipo=="TP" || $Tipo=="OP")
						{
							$saltar.='<img src="imagenes/71tnia.png"/>';	
						}
						else
						{
							$saltar.='<img src="imagenes/Test-paper-512.png"/>';
						}
						$saltar.='<h2 id="tarea'.$idtarea.'">'.$Nombre.'</h2>';
						 $saltar.='<p>'.$Tipota.'</p>'
						 .'<p>Materia: '.$Materia.'</p>';
						 if ($Tipofecha=="ESP")
						 {
							 //La fecha de entrega es de un solo dia 
							  $saltar.='<p>'.$dias.'</p></a>';
						}
						else
						{
							//La fecha de entrega es de un rango de tiempo
							//Si la fecha de inicio ya ha pasado
							if ($cdiasinicio>0)
							{
								$saltar.='<p>'.$dias.'</p></a>';
							}
							else
							{
								if ($Tipo=="TP" || $Tipo=="OP")
								{
									if ($cdiasfinl==0)
									{
										$saltar.='<p>Entrega termina hoy</p></a>';
									} else if ($cdiasfinl==1)
									{
										$saltar.='<p>Entrega termina mañana</p></a>';
									}else
									{
										$saltar.='<p>Entrega termina en '.$cdiasfinl.' dias</p></a>';
									}	
								}
								else
								{
									if ($cdiasfinl==0)
									{
										$saltar.='<p>Mesas terminan hoy</p></a>';
									} else if ($cdiasfinl==1)
									{
										$saltar.='<p>Mesas terminan mañana</p></a>';
									}else
									{
										$saltar.='<p>Mesas terminan en '.$cdiasfinl.' dias</p></a>';
									}
								}
							}
						}
						if ($personal)
						{
							if ($Usuario==$Usuarioagre)
							{
								$saltar.='<a data-icon="delete" data-role="button" href="#confirmar" data-rel="dialog" onclick="definirtareaael('.$idtarea.')" data-theme="a">Eliminar</a>'; 
							}	else
							{
								$saltar.='<a data-icon="share-square" data-role="button" href="" data-rel="dialog" onclick="noseguirtarea('.$idtarea.')" data-theme="a">Dejar de seguir</a>'; 
							}
						}
						else
						{
							$saltar.='<a data-icon="share-square-o" data-role="button" href="" data-rel="dialog" onclick="seguirtarea('.$idtarea.');obtenertareas();obtenereventos();" data-theme="a">Seguir</a>'; 
						}
						  
						 //En el caso de que el usuario actual sea el que agrego la tarea el la va a poder eliminar
						if ($personal)
						{
							$saltar.='<table width="100%" border="0">'.
								 ' <tr>'.
									'<td width="50%" align="center">';
									 if ($Tipo=="TP" || $Tipo=="OP")
									{$saltar.='<label for="sliderpe">Completado</label>';}
									else
									{$saltar.='<label for="sliderpe">Estudiado</label>';}
										$saltar.='<select onchange="compchange('.$idtarea.',this.value)" data-role="slider" id="ped'.$idpedi.'" name="sliderpe"> 
											  <option value="NO">No</option>';
											  if ($cantent!=0){
													$saltar.='<option selected="selected" value="SI">Si</option>';}
													else
													{$saltar.='<option value="SI">Si</option>';}
											$saltar.='</select>';
									$saltar.='</td>';
								$saltar.='</table>';
						}
						$saltar.='</li>';
					}	 
                } 
            $saltar.='</ul>';
			$saltar='<h2>'.$cadenatoshoww.' ('.$canttareas.')</h2>'.$saltar;
			echo $saltar;
}
else
{
	echo '<h2>'.$cadenaswow.'</h2>';
}
?>


	