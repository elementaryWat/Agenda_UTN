<?
session_start();
$valor=$_GET['Estado'];
$idtarea=$_GET['idtarea'];
$idusuario=$_GET['idusuario'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaagre=date("Y-m-d");
$hora=date("G:i:s");
$fechaagre.=" ".$hora;
date_default_timezone_set('America/Argentina/Buenos_Aires');
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
//Primero consulta si previamente no fue agregado a la lista de entregados
//En ese caso solammente modifica el campo verficados 
$aa="select * from entregados where Usuario=$idusuario AND Tarea=$idtarea";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$cantentreg=mysqli_num_rows($bb);
if ($cantentreg==0)
{
	$aa="insert into entregados (Usuario,Tarea,Fechaentrega,Verificado) values ($idusuario,$idtarea,'$fechaagre','SI')";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
}
else
{
	$aa="UPDATE entregados SET Verificado='$valor' where Usuario=$idusuario AND Tarea=$idtarea";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
}
echo "Se ha insertado la tarea de forma correcta";
?>


	