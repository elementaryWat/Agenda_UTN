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
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechamod=date("Y-m-d");
$hora=date("G:i:s");
$fechamod.=" ".$hora;
$Usuario=$_GET['Usuario'];
$idtarea=$_GET['idtarea'];
$ab="select * from tareas where idtarea=$idtarea";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
$mp=mysqli_fetch_array($ba);
$Nombreta=$mp['Nombre'];
$Tipota=$mp['Tipo'];
$Materia=$mp['Materia'];
//Determina la comsision en la que el usuario esta cursando la materia actual
$ac="select * from suscmaterias where idusuario=$Usuario AND idmateria=$Materia ORDER BY comisioncursado ASC";	
$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
$mcom=mysqli_fetch_array($ca);
$Comision=$mcom['comisioncursado'];
//Borra todas las notificaciones de modificacion de la tarea
//para evitar que los usuarios que aun no vieron estas notificaciones tengan un conflicto de inexistencia
$aa="DELETE FROM `notificaciones` WHERE idtarea=$idtarea AND Tipo='MOD'";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$aa="DELETE FROM `tareas` WHERE idtarea=$idtarea";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$aa="insert into notificaciones (Tipo,Recursosino,idusuario,idtarea,idmateria,Nomtarea,Tipota,Comision,Fechanot) values ('ELI','NO',$Usuario,
$idtarea,$Materia,'$Nombreta','$Tipota',$Comision,'$fechamod')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
echo 1;
?>


	