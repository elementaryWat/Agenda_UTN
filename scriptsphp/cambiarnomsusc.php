<?
session_start();
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$ab="select * from suscmaterias";
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
while ($mref=mysqli_fetch_array($ba))
{
	$idsusc=$mref['idsuscripcion'];
	$idmateria=$mref['idmateria'];
	$ac="select * from materias where idmateria=$idmateria";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
	$mrem=mysqli_fetch_array($ca);
	$Nombremateria=$mrem['Abrevmateria'];
	$ac="UPDATE suscmaterias SET Nombremateria='$Nombremateria' where idsuscripcion=$idsusc";	
	$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);	
	
}
echo "ok";
?>



	