<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
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
$idtarea=$_GET['Tarea'];
$Usuario=$_GET['Usuario'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechavis=date("Y-m-d");
$horavis=date("G:i:s");
$fechavis.=" ".$horavis;
	  	$af="select * from comentarios where Tarea=".$idtarea." ORDER BY Fechaagre ASC";	
		$fa=mysqli_query($con,$af) or die ("error buscando ".$af);	
		$cantcom=mysqli_num_rows($fa);
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
				 echo '<div style="background-color:#0284c5; color:#FFF;  border-radius:10%"><p><table width="100%" border="0">'
			 .' <tbody>'
				.'<tr>'
				  .'<td width="15%"><img src="imagenes/Fotosperfil/'.$Fotoperfil.'" width="100" heigth="100"  alt="imgper" style="border-radius: 50%; /* Borde redondeado */'
.'box-shadow: 0px 0px 15px #000; /* Sombra */'
.'-moz-transition: all 1s;'
.'-webkit-transition: all 1s;'
.'-o-transition: all 1s;'
.'cursor:pointer;"/></td>'
				  .'<td width="85%">'.'<strong>'.$Usercom."</strong> <p>".$Comentario .'</p> <p><span style="font-style: italic; color:#CCC;">'.$fechacom.'</span></p></td>'
				.'</tr>'
			  .'</tbody>'
			.'</table></p></div>';
			}
?>


	