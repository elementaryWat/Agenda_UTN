<?
session_start();
function deferenciadedias($fIni,$fFin)
{
	// Calculamos los segundos entre las dos fechas
	$fechaI = strtotime($fIni);
	$fechaF = strtotime($fFin);
	$segundos = ($fechaF - $fechaI);
	$dias = floor($segundos/86400);
	return $dias;
}
function obtenerdiferenciat($fInicio,$fFinal)
{
	$fechaInicio = strtotime($fInicio);
	$fechaFinal = strtotime($fFinal);
	$segundos = ($fechaFinal - $fechaInicio);
	$minutos = round($segundos/60);
	$diai=date("d",$fInicio);
	$fechaif=date("d/m/Y",strtotime($fInicio));
	$fechai=date("Y-m-d",strtotime($fInicio));
	$fechaf=date("Y-m-d",strtotime($fFinal));
	$diaa=date('Y-m-d', strtotime('-1 day',strtotime($fFinal)));
	$diaf=date("d",strtotime($fInicio));
	$diawi=date("l",strtotime($fInicio));
	$mesi=date("F",strtotime($fInicio));
	$yeari=date("y",strtotime($fInicio));
	$horai=date("H:i:s",strtotime($fInicio)); 
	$dif=$diaf-$diai;
	
	switch($diawi)
	{
		case "Sunday":
			$diawi="Domingo";
			break;
		case "Monday":
			$diawi="Lunes";
			break;
		case "Tuesday":
			$diawi="Martes";
			break;
		case "Wednesday":
			$diawi="Miércoles";
			break;
		case "Thursday":
			$diawi="Jueves";
			break;
		case "Friday":
			$diawi="Viernes";
			break;
		case "Saturday":
			$diawi="Sábado";
			break;
	}
	switch($mesi)
	{
		case "January":
			$mesi="Enero";
			break;
		case "February":
			$mesi="Febrero";
			break;
		case "March":
			$mesi="Marzo";
			break;
		case "April":
			$mesi="Abril";
			break;
		case "May":
			$mesi="Mayo";
			break;
		case "June":
			$mesi="Junio";
			break;
		case "July":
			$mesi="Julio";
			break;
		case "August":
			$mesi="Agosto";
			break;
		case "September":
			$mesi="Septiembre";
			break;
		case "October":
			$mesi="Octubre";
			break;
		case "November":
			$mesi="Noviembre";
			break;
		case "December":
			$mesi="Diciembre";
			break;
	}
	
	if ($fechaf==$fechai)
	{
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
	}
	else
	{
		if ($diaa==$fechai)
		{
			$cadenatiempo="Ayer a las ".$horai; 
		}
		else
		{
			$cadenatiempo="El ".$diawi." ".$fechaif." a las ".$horai;
		}
	}
	return $cadenatiempo;
}
function calculardiferenciafecha($fInicio,$fFinal)
{
	// Calculamos los segundos entre las dos fechas
	$fechaInicio = strtotime($fInicio);
	$fechaFinal = strtotime($fFinal);
	$segundos = ($fechaFinal - $fechaInicio);
	$dias = floor($segundos/86400);
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
			$cadenadia="En ".$dias. " d&iacute;as";
		}
	}
	$cadenafinal=$cadenadia;
	return $cadenafinal;
}
$idTarea=$_GET['idtarea'];
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
$aa="select Date_format(Fechaentrega,'%W') AS ndent,Date_format(Fechaentrega,'%d') AS dent,Date_format(Fechaentrega,'%M') AS ment,Date_format(Fechaentrega,'%Y') AS aent,Date_format(Fechaentrega,'%H') AS horent,Date_format(Fechaentrega,'%i') AS minent,Date_format(Fechafin,'%W') AS ndfin,Date_format(Fechafin,'%d') AS dfin,Date_format(Fechafin,'%M') AS mfin,Date_format(Fechafin,'%Y') AS afin,Nombre,Materia,Fechaentrega,Detalles,Tipo,Usuarioagre,Modsino,Lastusmod,Date_format(Fechaagre,'%W') AS ndagre,Date_format(Fechaagre,'%d') AS dagre,Date_format(Fechaagre,'%M') AS magre,Date_format(Fechaagre,'%Y') AS aagre,Date_format(Fechaagre,'%H') AS hagre,Date_format(Fechaagre,'%i') AS minagre,Date_format(Fechaagre,'%s') AS segagre,Date_format(Lastdatmod,'%W') AS ndmod,Date_format(Lastdatmod,'%d') AS dmod,Date_format(Lastdatmod,'%M') AS mmod,Date_format(Lastdatmod,'%Y') AS amod,Date_format(Lastdatmod,'%H') AS hmod,Date_format(Lastdatmod,'%i') AS minmod,Date_format(Lastdatmod,'%s') AS segmod,Tipofecha,Fechafin from tareas where idtarea=$idTarea ORDER BY Nombre Asc";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$m=mysqli_fetch_array($bb);
$Nombre=$m['Nombre'];
$Detalles=$m['Detalles'];
$idmateria=$m['Materia'];
$Tipofecha=$m['Tipofecha'];
$ndent=$m['ndent'];
$dent=$m['dent'];
$ment=$m['ment'];
$aent=$m['aent'];
$horent=$m['horent'];
$minent=$m['minent'];
$ndfin=$m['ndfin'];
$dfin=$m['dfin'];
$mfin=$m['mfin'];
$afin=$m['afin'];
$ndagre=$m['ndagre'];
$dagre=$m['dagre'];
$magre=$m['magre'];
$aagre=$m['aagre'];
$hagre=$m['hagre'];
$minagre=$m['minagre'];
$segagre=$m['segagre'];
$ndmod=$m['ndmod'];
$dmod=$m['dmod'];
$mmod=$m['mmod'];
$amod=$m['amod'];
$hmod=$m['hmod'];
$minmod=$m['minmod'];
$segmod=$m['segmod'];
$idusuarioagre=$m['Usuarioagre'];
$Fechaentrega=$m['Fechaentrega'];
$Fechafin=$m['Fechafin'];
$idlastusmod=$m['Lastusmod'];
$Modsino=$m['Modsino'];
$Tipoi=$m['Tipo'];
$ab="select * from materias where idmateria=$idmateria";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mmat=mysqli_fetch_array($ba);
$Materia=$mmat['Nombremateria'];
switch($Tipoi)
{
	case "TP":
		$Tipo="Trabajo Practico (obligatorio)";
		break;
	case "PC":
		$Tipo="Examen Parcial";
		break;
	case "FL":
		$Tipo="Examen Final";
		break;
	case "OP":
		$Tipo="Trabajo practico (no obligatorio)";
		break;
	case "RE":
		$Tipo="Recuperatorio";
		break;
}
function armarfechaedi($d,$m,$a)
{
	  if ($m == "January"){
	  $m = "01";
	  }
	  if ($m == "February"){
	  $m = "02";
	  }
	  if ($m == "March"){
	  $m = "03";
	  }
	  if ($m == "April"){
	  $m = "04";
	  }
	  if ($m == "May"){
	  $m = "05";
	  }
	  if ($m == "June"){
	  $m = "06";
	  }
	  if ($m == "July"){
	  $m = "07";
	  }
	  if ($m == "August"){
	  $m = "08";
	  }
	  if ($m == "September"){
	  $m = "09";
	  }
	  if ($m == "October"){
	  $m = "10";
	  }
	  if ($m == "November"){
	  $m = "11";
	  }
	  if ($m == "December"){
	  $m = "12";
	  }
	  $fechaf =$d."/".$m."/".$a;
	  return $fechaf;
}
function armarfecha($nd,$d,$m,$a)
{
	if ($nd == "Monday"){
	  $nd = "Lunes";
	  }
	  if ($nd == "Tuesday"){
	  $nd = "Martes";
	  }
	  if ($nd == "Wednesday"){
	  $nd = "Miércoles";
	  }
	  if ($nd == "Thursday"){
	  $nd = "Jueves";
	  }
	  if ($nd == "Friday"){
	  $nd = "Viernes";
	  }
	  if ($nd == "Saturday"){
	  $nd = "Sábado";
	  }
	  if ($nd == "Sunday"){
	  $nd = "Domingo";
	  }
	  
	  if ($m == "January"){
	  $m = "Enero";
	  }
	  if ($m == "February"){
	  $m = "Febrero";
	  }
	  if ($m == "March"){
	  $m = "Marzo";
	  }
	  if ($m == "April"){
	  $m = "Abril";
	  }
	  if ($m == "May"){
	  $m = "Mayo";
	  }
	  if ($m == "June"){
	  $m = "Junio";
	  }
	  if ($m == "July"){
	  $m = "Julio";
	  }
	  if ($m == "August"){
	  $m = "Agosto";
	  }
	  if ($m == "September"){
	  $m = "Septiembre";
	  }
	  if ($m == "October"){
	  $m = "Octubre";
	  }
	  if ($m == "November"){
	  $m = "Noviembre";
	  }
	  if ($m == "December"){
	  $m = "Diciembre";
	  }
	  $fechaf =$nd." ".$d."/".$m."/".$a;
	  return $fechaf;
}
//Obtiene nombre y apellido de usuario que agrego
$aa="select * from usuarios where idusuario=$idusuarioagre";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$mre=mysqli_fetch_array($bb);
$Nombreus=$mre['Nombre'];
$Nombreus.=" ".$mre['Apellido'];

$aa="select * from usuarios where idusuario=$idlastusmod";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$mre=mysqli_fetch_array($bb);
$Nombreusmod=$mre['Nombre'];
$Nombreusmod.=" ".$mre['Apellido'];

$am="select * from suscmaterias where idusuario=$Usuario";	
$bm=mysqli_query($con,$am) or die ("error buscando ".$am);


date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechavis=date("Y-m-d");
$horavis=date("G:i:s");
$fechavis.=" ".$horavis;

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
$dias=calculardiferenciafecha($fechahoy,$Fechaentrega);
$cdiasinicio=deferenciadedias($fechahoy,$Fechaentrega);
$cdiasfinl=deferenciadedias($fechahoy,$Fechafin);
		
	  $fechaent =armarfecha($ndent,$dent,$ment,$aent);
	  $fechafin=armarfecha($ndfin,$dfin,$mfin,$afin);
	  $fechaagre =armarfecha($ndagre,$dagre,$magre,$aagre);
	  $horaagre=$hagre.":".$minagre.":".$segagre;
	  $fechamod =armarfecha($ndmod,$dmod,$mmod,$amod);
	  $horamod=$hmod.":".$minmod.":".$segmod;
echo '<div data-role="collapsibleset">'.
     '<div data-role="collapsible" data-theme="a" data-collapsed="false">'.
	  '<h1>Ver detalles</h1>';
		echo '<table width="90%" border="0">'
		  .'<tr>'
			.'<td colspan="2" align="center"><h4>'.$Nombre.'</h4></td>'
		  .'</tr>';
		  echo '<tr>';
			   echo '<td colspan="2" align="center">Detalles</td>';
			  echo '</tr>';
		echo '<tr>'
			.'<td colspan="2">'.$Detalles.'</td>'
		  .'</tr>'
		 .' <tr>'
			.'<td>Materia:</td>'
			.'<td>'.$Materia.'</td>'
		  .'</tr>'
		  .'<tr>';
		   if ($Tipo=="Trabajo Practico (obligatorio)" || $Tipo=="Trabajo practico (no obligatorio)")
		  {
			  echo '<td>Fecha de entrega:</td>';
		}
		  else
		  {
			  echo '<td>Fecha de mesa:</td>';
		}
		if ($Tipofecha=="ESP")
		{
			echo '<td>'.$fechaent.' a las '.$horent.':'.$minent.' hs.'.' ('.$dias.')'.'</td>';
		}
		else if ($Tipofecha=="VAR")
		{
						//La fecha de entrega es de un rango de tiempo
						//Si la fecha de inicio ya ha pasado
						if ($cdiasinicio>0)
						{
							echo '<td>'.$fechaent." a ".$fechafin.' ('.$dias.')'.'</td>';
						}
						else
						{
							if ($cdiasfinl==0)
								{
									echo '<td>'.$fechaent." a ".$fechafin.'(Termina hoy)</p></a>';
								} else if ($cdiasfinl==1)
								{
									echo '<td>'.$fechaent." a ".$fechafin.'(Termina mañana)</p></a>';
								}else
								{
									echo '<td>'.$fechaent." a ".$fechafin.'(Termina en '.$cdiasfinl.' dias)</td>';
								}	
						}
					
		}
		 echo ' </tr>'
		  .'<tr>'
			.'<td>Tipo:</td>'
			.'<td>'.$Tipo.'</td>'
		  .'</tr>'
		  .'<tr>'
			.'<td colspan="2"><h4>Detalles adicionales</h4></td>'
		  .'</tr>'
		  .'<tr>'
			.'<td>Agregada por:</td>';
			if ($idusuarioagre!=$Usuario)
			{
				echo '<td>'.$Nombreus.'</td>';
			}
			else
			{
				echo '<td>Mi</td>';
			}
			
		  echo '</tr>'
		  .'<tr>'
			.'<td>Fecha insercion:</td>'
			.'<td>'.$fechaagre." a las ".$horaagre.'</td>'
		  .'</tr>'
		 	.'<tr>'
			.'<td>Modificaciones:</td>';
			if ($Modsino==0)
			{
				echo '<td>No se han modificado los detalles</td>';
				echo '</tr>';
			}
			else
			{
				echo '<td>Se han realizado '.$Modsino.' modificaciones</td>';
				echo '</tr>'
				.'<tr>'
					.'<td align="center" colspan="2">Ultima modificacion:</td>'
				  .'</tr>'
				.'<tr>'
					.'<td>Hecha por:</td>'
					.'<td>'.$Nombreusmod.'</td>'
				  .'</tr>'
				  .'<tr>'
					.'<td>Fecha:</td>'
					.'<td>'.$fechamod." a las ".$horamod.'</td>'
				  .'</tr>';
			}
		  
		  
		echo '</table>';
		echo '</div>'
	  
	  .'<div data-role="popup" id="notificacionar" data-overlay-theme="a"></div>'
	  .'<div data-role="collapsible" data-theme="a">';
	  	$af="select idarchivo,Notas,Usuarioagre,Date_format(Fechaagre,'%W') AS ndfi,Date_format(Fechaagre,'%d') AS dfi,Date_format(Fechaagre,'%M') AS mfi,Date_format(Fechaagre,'%Y') AS afi from archivoscom where Tarea=$idTarea";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);	
		$cantfiles=mysqli_num_rows($fa);
		echo '<h1>Archivos<span class="ui-li-count">'.$cantfiles.'</span></h1>';
		if ($cantfiles==0)
		{
			echo '<p>No hay archivos compartidos en esta tarea</p>';
		}
		else
		{
			echo '<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar archivo">';
			$listashfiles="";
			while ($mfile=mysqli_fetch_array($fa))
			{
				$idarchivo=$mfile['idarchivo'];
				$idusuarioar=$mfile['Usuarioagre'];
				$Notasar=$mfile['Notas'];	
				$ndfi=$mfile['ndfi'];
				$dfi=$mfile['dfi'];
				$mfi=$mfile['mfi'];
				$afi=$mfile['afi'];
				$fechaarchi=armarfecha($ndfi,$dfi,$mfi,$afi);
				$ab="select * from archivos where idarchivo=$idarchivo";	
				$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
					$marc=mysqli_fetch_array($ba);
					$Rutaar=$marc['Ruta'];
					$Nombrear=$marc['Nombre'];
					$Extensionar=$marc['Extension'];
					$Tipoarchi=$marc['Tipoarchi'];
					$ab="select * from Tiposarchivos where idtipo=$Tipoarchi";	
					$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
                    $mp=mysqli_fetch_array($ba);
					$Imagen=$mp['Imagen'];
					$infoar="";
					$infoar.='<img src="../'.$Imagen.'"/>';	
					$infoar.='<h2>'.$Nombrear.$Extensionar.'</h2>';
				$au="select * from usuarios where idusuario=$idusuarioar";	
				$ua=mysqli_query($con,$au) or die ("error buscando ".$au);
				$muar=mysqli_fetch_array($ua);	
				$Userar=$muar['Nombre'];
				$Userar.=" ".$muar['Apellido'];
				//Esta variable almacena la cadena que sera mostrada en el popup de info
				$datosinfoar='<p><strong>Notas</strong></p>'
					.'<p>'.$Notasar.'</p>'
					.'<p><strong>Agregado por</strong></p>';
					if ($Usuario!=$idusuarioar)
					{//Si el usuario que lo agreggo es el mismo que tiene iniciada la sesion entonces muestra agregado por mi
						$datosinfoar.='<p>'.$Userar.'</p>';
					}
					else
					{
						$datosinfoar.='<p>Mi</p>';
					}
					$datosinfoar.='<p><strong>Fecha inserción</strong></td>'
					.'<p>'.$fechaarchi.'</p>';
					if ($Usuario==$idusuarioar)
					{
						//Solo muestra la opcion de eliminar y modificar si el usuario que tiene iniciada la sesion es el mismo que lo agrego
						$datosinfoar.='<div data-role="controlgroup">'
						.'<a onclick="eliminararchivo('.$idarchivo.')" data-role="button" data-icon="delete" data-theme="b">Eliminar</a>'
						.'<a onclick="modificararchivo('.$idarchivo.')" data-role="button" data-icon="edit" data-theme="b">Modificar</a>'
						.'</div>';
					}
					$datosinfoeditar='<p><strong>Notas</strong></p>'
					.'<p><textarea id="notaseditarar'.$idarchivo.'" style="height:auto">'.$Notasar.'</textarea></p><span id="errornotaar'.$idarchivo.'"></span>'
					.'<a onclick="modificandoar('.$idarchivo.','.$idTarea.')" data-role="button" data-icon="edit" data-theme="b">Modificar</a>';
			 echo '<li><a  href="http://www.utndiarybeta.890m.com/'.$Rutaar.'" data-rel="extern" target="_blank" data-theme="b" data-icon="arrow-r">'.$infoar.'</a><a onclick="vernotasar('.$idarchivo.')" data-role="button" data-icon="info" id="botar'.$idarchivo.'"></a></li>';
			 echo '<span style="display:none;background-color:#B6C0D1;width:100%" id="arch'.$idarchivo.'"><span id="filemain'.$idarchivo.'">'.$datosinfoar.'</span><span style="display:none;background-color:#B6C0D1;width:100%" id="fileedit'.$idarchivo.'">'.$datosinfoeditar.'</span></span>';
			 //Popup de confirmacion
			 echo ' <div data-role="popup" id="confirmacionar'.$idarchivo.'" data-overlay-theme="a">
     <div data-role="header">
				<a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="$(\'#confirmacionar\'+'.$idarchivo.').popup(\'close\')">Cerrar</a>
              <h3 id="titulonot">Confirmar</h3>
			  <span id="preguntearr'.$idarchivo.'"> <p>¿Estas completamente seguro que deseas eliminar el archivo '.$Nombrear.' de la tarea?</p>
        <a data-role="button" data-icon="check" data-theme="a" onclick="eliminandoar('.$idarchivo.','.$idTarea.')">Si</a>
        <a data-role="button" data-icon="delete" data-theme="a" onclick="$(\'#confirmacionar\'+'.$idarchivo.').popup(\'close\')">No</a></span>
			  <span id="okearr'.$idarchivo.'"></span>
			  
          </div>
          
	</div>';
			}
		 	echo '</ul>';
		}
	 	
	  echo '<div id="boxfil" style="background-color:#B7B8EC; border:#000000"><div id="prevar"></div></div><a data-role="button" data-icon="plus" onclick="agregararchivo('.$idTarea.','.$Usuario.')" id="confagarchivo" style="display:none">Agregar este archivo</a><a data-role="button" data-icon="plus" onclick="mostrarinsarchivo('.$idTarea.','.$Usuario.')" style="display:block"><span id="agrarchivo">Agregar un archivo</span></a>'
	  .'</div>'
	.'<div data-role="collapsible" data-theme="a">';
	  	$af="select idlink,Nombre,Notas,Tarea,Usuarioagre,Enlace,Date_format(Fechaagre,'%W') AS ndli,Date_format(Fechaagre,'%d') AS dli,Date_format(Fechaagre,'%M') AS mli,Date_format(Fechaagre,'%Y') AS ali from links where Tarea=$idTarea";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);	
		$cantlinks=mysqli_num_rows($fa);
		echo '<h1>Links utiles <span class="ui-li-count">'.$cantlinks.'</span></h1>';
		if ($cantlinks==0)
		{
			echo '<p>No hay links en esta tarea</p>';
		}
		else
		{
			echo '<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Buscar link">';
			while ($mlink=mysqli_fetch_array($fa))
			{
				$nombrelink=$mlink['Nombre'];
				$idlink=$mlink['idlink'];	
				$notaslink=$mlink['Notas'];
				$iduserlink=$mlink['Usuarioagre'];
				$au="select * from usuarios where idusuario=$iduserlink";	
				$ua=mysqli_query($con,$au) or die ("error buscando ".$au);
				$mulink=mysqli_fetch_array($ua);
				$Userlink=$mulink['Nombre'];
				$Userlink.=" ".$mulink['Apellido'];
				$ndli=$mlink['ndli'];
				$dli=$mlink['dli'];
				$mli=$mlink['mli'];
				$ali=$mlink['ali'];
				$fechalink=armarfecha($ndli,$dli,$mli,$ali);
				$urrl=$mlink['Enlace'];
				//Esta variable almacena la cadena que sera mostrada en el popup de info
				$datosinfo='<p><strong>Notas</strong></p>'
					.'<p>'.$notaslink.'</p>'
					.'<p><strong>Agregado por</strong></p>';
					if ($Usuario!=$iduserlink)
					{//Si el usuario que lo agreggo es el mismo que tiene iniciada la sesion entonces muestra agregado por mi
						$datosinfo.='<p>'.$Userlink.'</p>';
					}
					else
					{
						$datosinfo.='<p>Mi</p>';
					}
					$datosinfo.='<p><strong>Fecha inserción</strong></td>'
					.'<p>'.$fechalink.'</p>';
					if ($Usuario==$iduserlink)
					{
						//Solo muestra la opcion de eliminar y modificar si el usuario que tiene iniciada la sesion es el mismo que lo agrego
						$datosinfo.='<div data-role="controlgroup">'
						.'<a onclick="eliminarlink('.$idlink.')" data-role="button" data-icon="delete" data-theme="b">Eliminar</a>'
						.'<a onclick="modificarlink('.$idlink.')" data-role="button" data-icon="edit" data-theme="b">Modificar</a>'
						.'</div>';
					}
					$datosinfoedit='<p><strong>Enlace</strong></p>'
					.'<p><input id="enlacedit'.$idlink.'" type="text" value="'.$urrl.'"/></p><span id="errorlink'.$idlink.'"></span>'
					.'<p><strong>Notas</strong></p>'
					.'<p><textarea id="notasedit'.$idlink.'" style="height:auto">'.$notaslink.'</textarea></p><span id="errornotalink'.$idlink.'"></span>'
					.'<a onclick="modificandolink('.$idlink.','.$idTarea.')" data-role="button" data-icon="edit" data-theme="b">Modificar detalles</a>';
			 echo '<li><a  href="'.$urrl.'" data-rel="extern" target="_blank" data-theme="b" data-icon="arrow-r">'.$nombrelink.'</a><a onclick="vernotas('.$idlink.')" data-role="button" data-icon="info" id="bot'.$idlink.'"></a></li>';
			 echo '<span style="display:none;background-color:#B6C0D1;width:100%" id="link'.$idlink.'"><span id="linkmain'.$idlink.'">'.$datosinfo.'</span><span style="display:none;background-color:#B6C0D1;width:100%" id="linkedit'.$idlink.'">'.$datosinfoedit.'</span></span>';
			 //Popup de confirmacion
			 echo ' <div data-role="popup" id="confirmacion'.$idlink.'" data-overlay-theme="a">
     <div data-role="header">
				<a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="$(\'#confirmacion\'+'.$idlink.').popup(\'close\')">Cerrar</a>
              <h3 id="titulonot">Confirmar</h3>
			  <span id="preguntellin'.$idlink.'"> <p>¿Estas completamente seguro que deseas eliminar el link '.$nombrelink.'?</p>
        <a data-role="button" data-icon="check" data-theme="a" onclick="eliminandolink('.$idlink.','.$idTarea.')">Si</a>
        <a data-role="button" data-icon="delete" data-theme="a" onclick="$(\'#confirmacion\'+'.$idlink.').popup(\'close\')">No</a></span>
			  <span id="okellin'.$idlink.'"></span>
			  
          </div>
          
	</div>';
			}
		 	echo '</ul>';
		}
	 	
	  echo '<a data-role="button" data-icon="plus" onclick="mostrarinslink('.$idTarea.','.$Usuario.')">Agregar un link</a>'
	  .'</div>'
	  
	  
	  .'<div data-role="collapsible" data-theme="a" id="comdiv">';
	  	$af="select * from comentarios where Tarea=$idTarea ORDER BY Fechaagre ASC";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);	
		$cantcom=mysqli_num_rows($fa);
		echo '<h1>Comentarios <span class="ui-li-count"><span id="canttcome">'.$cantcom.'</span></span></h1>';
		if ($cantcom==0)
		{
			echo '<span id="listacoment"><p>No hay comentarios en esta tarea</p></span>';
		}
		else
		{
			echo '<span id="listacoment">';
			while ($mcom=mysqli_fetch_array($fa))
			{
				$Comentario=$mcom['Comentario'];
				$idcomentario=$mcom['idcomentario'];
				$idusercomen=$mcom['Usuarioagre'];
				$Fechaagrecom=$mcom['Fechaagre'];
				$au="select * from usuarios where idusuario=$idusercomen";	
				$ua=mysqli_query($con,$au) or die ("error buscando ".$au);
				$mcus=mysqli_fetch_array($ua);
				$Usercom=$mcus['Nombre'];
				$Usercom.=" ".$mcus['Apellido'];
				$Fotoperfil=$mcus['Fotoperfil'];
				$fechacom=obtenerdiferenciat($Fechaagrecom,$fechavis);
				//Esta variable almacena la cadena que sera mostrada en el popup de info
			echo '<div style="background-color:#0284c5; color:#FFF; border-radius:10%"><p><table width="100%" border="0">'
			 .' <tbody>'
				.'<tr>'
				  .'<td width="15%"><img src="imagenes/Fotosperfil/'.$Fotoperfil.'" width="100" heigth="100"  alt="imgper" style="border-radius: 50%; /* Borde redondeado */'
.'box-shadow: 0px 0px 15px #000; /* Sombra */'
.'-moz-transition: all 1s;'
.'-webkit-transition: all 1s;'
.'-o-transition: all 1s;'
.'cursor:pointer;"/></td>'
				  .'<td width="85%">'.'<strong>'.$Usercom."</strong> <p>".$Comentario .'</p><p><span style="font-style: italic; color:#CCC;">'.$fechacom.'</span></p></td>'
				.'</tr>'
			  .'</tbody>'
			.'</table></p></div>';
			 //Popup de confirmacion
			}
		 	echo '</span>';
		}
	 	
	  echo '<table width="100%" border="0">
			  <tbody>
				<tr>
				  <td id="textcomenc"><textarea id="textcome" placeholder="Ingresa el texto del comentario"></textarea></td>
				  <td><a data-role="button" onclick="agregarcom('.$idTarea.','.$Usuario.')">Comentar
				</tr>
			  </tbody>
			</table>
			<span id="errorcomen"></span>
			'
	  .'</div>';
	  if ($idusuarioagre==$Usuario)
	{
		echo '<div data-role="collapsible" data-theme="a" onClick="cargareditor()">'
	  .'<h1>Editar detalles</h1>';
	  echo '<table width="100%" border="0" align="center">';
	  
	  echo '<tr>'
			.'<td colspan="2"><label>Nombre<input type="text" name="nombremod" id="nombremod" value="'.$Nombre.'"/></label><span id="errornombremod"></span></td>'
		  .'</tr>'
	  	.'<tr>'
			.'<td colspan="2"><label>Materia<select name="materiamod" id="materiamod" data-native-menu="false">';
                  while ($mrem=mysqli_fetch_array($bm)) {
					  $idmateriaac=$mrem['idmateria'];
					 	$ae="select * from materias where idmateria=$idmateriaac";	
						$ea=mysqli_query($con,$ae) or die ("error buscando ".$ae);
						$mrema=mysqli_fetch_array($ea);
						$Nommateriaac=$mrema['Abrevmateria'];
					  //Comprueba si la materia de la tarea es igual a la de la seleccion
					  if ($idmateria==$idmateriaac)
					  {
						  echo '<option value="'.$idmateriaac.'" selected="selected">'.$Nommateriaac.'</option>';
					}
					else
					{
						echo '<option value="'.$idmateriaac.'">'.$Nommateriaac.'</option>';
					}
                  	
                   }	
          		echo '</select></label>'
          .'<span id="errormaterianmod"></span></td>'
		  .'</tr>';
		  $oTP="";
		  $oOP="";
		  $oPC="";
		  $oFL="";
		  $oRE="";
		  switch ($Tipoi)
		  {
			 case "TP":
			 	$oTP=" selected=selected";
			 break; 
			 case "OP":
			 	$oOP=" selected=selected";
			 break; 
			 case "PC":
			 	$oPC=" selected=selected";
			 break; 
			 case "FL":
			 	$oFL=" selected=selected";
			 break; 
			 case "RE":
			 	$oRE=" selected=selected";
			 break; 
		}
		  echo '<tr><td colspan="2"><label>Tipo<select name="tipotaed" data-native-menu="false"> 
                  <option value="TP"'.$oTP.'>Trabajo Practico</option>
                  <option value="OP"'.$oOP.'>Trab. Prac. opcional</option>
                  <option value="PC"'.$oPC.'>Parcial</option>
                  <option value="FL"'.$oFL.'>Final</option>
                  <option value="RE"'.$oRE.'>Recuperatorio</option>
          		</select></label>'
		  .'</td></tr>';	
	  echo '<tr>';
			   echo '<td colspan="2" align="center">Detalles</td>';
			  echo '</tr>';
		echo '<tr>'
			.'<td colspan="2"><textarea name="detailss" id="detailss">'.$Detalles.'</textarea><span id="errordetailsmod"></span></td>'
		  .'</tr>'
		   .'<tr>';
		   if ($Tipo=="Trabajo Practico (obligatorio)" || $Tipo=="Trabajo practico (no obligatorio)")
		  {
			  echo '<td colspan="2">Fecha de entrega:</td>'.'</tr>';
		}
		  else
		  {
			  echo '<td colspan="2">Fecha de mesa:</td>'.'</tr>';
		}
		$fechaentedi=armarfechaedi($dent,$ment,$aent);
		$fechafinedi=armarfechaedi($dfin,$mfin,$afin);
			echo '<tr>'
			.'<td colspan="2"><fieldset data-role="controlgroup">';
			if ($Tipofecha=="VAR")
			{
				echo '<label><input name="tipomodfecha" id="tipomodfecha" type="radio" value="esp" onchange="mostrarinpfecha2(this.value)"/>Fecha especifica</label>'
				.' <label><input name="tipomodfecha" id="tipomodfecha" type="radio" value="vari" onchange="mostrarinpfecha2(this.value)" checked="checked"/>Rango de tiempo</label>';
			}
			else
			{
				echo '<label><input name="tipomodfecha" id="tipomodfecha" type="radio" value="esp" onchange="mostrarinpfecha2(this.value)" checked="checked"/>Fecha especifica</label>'
				.' <label><input name="tipomodfecha" id="tipomodfecha" type="radio" value="vari" onchange="mostrarinpfecha2(this.value)"/>Rango de tiempo</label>';
			}
				echo '</fieldset>';
				if ($Tipofecha=="VAR")
				{
					echo '<span id="fechamod2" style="display:none">'
					.'<input type="text" class="date-input-css" id="fecham" name="fecham" style="position: relative; z-index: 100000;">'
					.'<span id="errorfechaum"></span>'
					.'</span>'
					.'<span id="fechamod22" style="display:block">'
					.'<label>Fecha inicio<input type="text" class="date-input-css" id="fechamini" name="fechamini" style="position: relative; z-index: 100000;" value="'.$fechaentedi.'"></label>'
					.'<span id="errorfechamin"></span>'
					.'<label>Fecha fin<input type="text" class="date-input-css" id="fechamfin" name="fechamfin" style="position: relative; z-index: 100000;" value="'.$fechafinedi.'"></label>'
					.'<span id="errorfechamf"></span>'
					.'</span>';	
				}
				else
				{
					echo '<span id="fechamod2" style="display:block">'
					.'<input type="text" class="date-input-css" id="fecham" name="fecham" style="position: relative; z-index: 100000;" value="'.$fechaentedi.'">'
					.'<label for="slider-fill">Hora:</label>
<input type="range" name="slider-fill" id="horamt" value="'.$horent.'" min="0" max="23" data-highlight="true" />
		<span id="errorhoramt"></span>
		<label for="slider-fill">Minuto:</label>
<input type="range" name="slider-fill" id="minutomt" value="'.$minent.'" min="0" max="59" data-highlight="true" />
		<span id="errorminutomt"></span>'
					.'<span id="errorfechaum"></span>'
					.'</span>'
					.'<span id="fechamod22" style="display:none">'
					.'<label>Fecha inicio<input type="text" class="date-input-css" id="fechamini" name="fechamini" style="position: relative; z-index: 100000;"></label>'
					.'<span id="errorfechamin"></span>'
					.'<label>Fecha fin<input type="text" class="date-input-css" id="fechamfin" name="fechamfin" style="position: relative; z-index: 100000;"></label>'
					.'<span id="errorfechamf"></span>'
					.'</span>';	
				}
				
				echo '<span id="errorfechamgen"></span>'
			.'</td></tr>'
			.'<tr>'
			.'<td><input name="editardet" id="editardet" type="button" value="Modificar detalles" onclick="verificarfecha2('.$idTarea.')"/><span id="errormodgen"></span></td>'
		  .'</tr>'
		  .'<table width="100%" border="0">'
	  .'</div>';		
	}
     
     echo '</div>';
?>


	