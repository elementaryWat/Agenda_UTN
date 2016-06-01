<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$Nombre=$_GET['Nombre'];
$Tipo=$_GET['Tipo'];
$Materia=$_GET['Materia'];
$Detalles=$_GET['Detalles'];
$Tiposhare=$_GET['Compartida'];
$Tipofecha=$_GET['Tipofecha'];
$Fechaunica=$_GET['Fechaunica'];
$Fechaunica=substr($Fechaunica,6,4)."-".substr($Fechaunica,3,2)."-".substr($Fechaunica,0,2);
$Fechainicio=$_GET['Fechainicio'];
$Fechainicio=substr($Fechainicio,6,4)."-".substr($Fechainicio,3,2)."-".substr($Fechainicio,0,2);
$Fechafinal=$_GET['Fechafinal'];
$Fechafinal=substr($Fechafinal,6,4)."-".substr($Fechafinal,3,2)."-".substr($Fechafinal,0,2);
$Hora=$_GET['Hora'];
$Minuto=$_GET['Minuto'];
$Tiempo=' '.$Hora.':'.$Minuto.':00';
switch($Tipofecha)
{
	case "esp":
		$Tipofecha="ESP";
		$Fechaini=$Fechaunica.$Tiempo;
		$Fechafin=$Fechaunica.$Tiempo;
		break;
	case "vari":
		$Tipofecha="VAR";
		$Fechaini=$Fechainicio;
		$Fechafin=$Fechafinal;
		break;
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaagre=date("Y-m-d");
$hora=date("G:i:s");
$fechaagre.=" ".$hora;	
$Usuarioagre=$_GET['Usuarioagre'];
//Determina la comsision en la que el usuario esta cursando la materia actual
$ac="select * from suscmaterias where idusuario=$Usuarioagre AND idmateria=$Materia ORDER BY comisioncursado ASC";	
$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
$mcom=mysqli_fetch_array($ca);
$Comision=$mcom['comisioncursado'];
$Compartir=false;
if ($Tiposhare=="Compartida")
{
	$Compartir=true;
	$Compartida="SI";
} else if ($Tiposhare=="Personal")
{
	$Compartida="NO";
}
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
$aa="insert into tareas (Usuarioagre,Fechaagre,Modsino,Lastusmod,Lastdatmod,Materia,Nombre,Detalles,Tipofecha,Fechaentrega,Fechafin,Tipo,Comision,Compartida) values ($Usuarioagre,'$fechaagre',0,$Usuarioagre,'$fechaagre',$Materia,'$Nombre','$Detalles','$Tipofecha','$Fechaini','$Fechafin','$Tipo',$Comision,'$Compartida')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
//Obtiene el id de la tarea recien agregada
$aa="select * from tareas ORDER BY idtarea DESC LIMIT 1";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mrec=mysqli_fetch_array($bb);
$idrecagre=$mrec['idtarea'];
if ($Compartir)
{
	$aa="insert into notificaciones (Tipo,Recursosino,idusuario,idtarea,idmateria,Comision,Fechanot) values ('INS','NO',$Usuarioagre,
$idrecagre,$Materia,$Comision,'$fechaagre')";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
}
echo 'Se ha insertado la tarea de forma correcta';
?>


	