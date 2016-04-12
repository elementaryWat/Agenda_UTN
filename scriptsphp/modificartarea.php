<?
session_start();
$Usuario=$_POST['Usuario'];
$idTarea=$_POST['idTarea'];
$Nombre=$_POST['Nombre'];
$Materia=$_POST['Materia'];
$Detalles=$_POST['Detalles'];
$Tipofecha=$_POST['Tipofecha'];
$Tipotarea=$_POST['Tipotarea'];
$Fechaunica=$_POST['Fechaunica'];
$Fechaunica=substr($Fechaunica,6,4)."-".substr($Fechaunica,3,2)."-".substr($Fechaunica,0,2);
$Hora=$_POST['Hora'];
$Minuto=$_POST['Minuto'];
$Fechainicio=$_POST['Fechainicio'];
$Fechainicio=substr($Fechainicio,6,4)."-".substr($Fechainicio,3,2)."-".substr($Fechainicio,0,2);
$Fechafinal=$_POST['Fechafinal'];
$Fechafinal=substr($Fechafinal,6,4)."-".substr($Fechafinal,3,2)."-".substr($Fechafinal,0,2);
switch($Tipofecha)
{
	case "esp":
		$Tipofecha="ESP";
		$Fechaini=$Fechaunica.' '.$Hora.':'.$Minuto.':00';
		$Fechafin=$Fechaunica.' '.$Hora.':'.$Minuto.':00';
		break;
	case "vari":
		$Tipofecha="VAR";
		$Fechaini=$Fechainicio;
		$Fechafin=$Fechafinal;
		break;
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechamod=date("Y-m-d");
$hora=date("G:i:s");
$fechamod.=" ".$hora;
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
//Determina la comsision en la que el usuario esta cursando la materia actual
$ac="select * from suscmaterias where idusuario=$Usuario AND idmateria=$Materia ORDER BY comisioncursado ASC";	
$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
$mcom=mysqli_fetch_array($ca);
$Comision=$mcom['comisioncursado'];
$aa="select * from tareas where idtarea=$idTarea";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mre=mysqli_fetch_array($bb);
$newvalormod=$mre['Modsino']+1;
$aa="UPDATE tareas SET Tipo='$Tipotarea',Modsino=$newvalormod,Lastusmod=$Usuario,Lastdatmod='$fechamod',Fechaentrega='$Fechaini',Fechafin='$Fechafin',Detalles ='$Detalles' ,Nombre ='$Nombre' ,Materia =$Materia ,Tipofecha ='$Tipofecha'  where idtarea=$idTarea";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$aa="insert into notificaciones (Tipo,Recursosino,idusuario,idtarea,idmateria,Comision,Fechanot) values ('MOD','NO',$Usuario,
$idTarea,$Materia,$Comision,'$fechamod')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
echo "Se ha insertado la tarea de forma correcta";
?>


	