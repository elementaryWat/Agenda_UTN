<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaagre=date("Y-m-d");
$hora=date("G:i:s");
$fechaagre.=" ".$hora;	

$Comentario=$_GET['Comentario'];
$Tarea=$_GET['Tarea'];
$Usuarioagre=$_GET['Usuarioagre'];

//Determina la materia de la tarea
$aa="select * from tareas where idtarea=$Tarea";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$mre=mysqli_fetch_array($bb);
$Materia=$mre['Materia'];
//Determina la comsision en la que el usuario esta cursando la materia actual
$ac="select * from suscmaterias where idusuario=$Usuarioagre AND idmateria=$Materia ORDER BY comisioncursado ASC";	
$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
$mcom=mysqli_fetch_array($ca);
$Comision=$mcom['comisioncursado'];

$ab="insert into comentarios (Comentario,Tarea,Usuarioagre,Fechaagre) values ('$Comentario',$Tarea,$Usuarioagre,'$fechaagre')";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
$aa="insert into notificaciones (Tipo,Recursosino,idusuario,idtarea,idmateria,Comision,Fechanot) values ('INS','COMENTARIO',$Usuarioagre,
$Tarea,$Materia,$Comision,'$fechaagre')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
?>



	