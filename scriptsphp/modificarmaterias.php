<?
session_start();
$Cadenacomision=$_GET['Comision'];
$Materia=$_GET['Materia'];
$Usuario=$_GET['Usuario'];
$Comisioncurl=substr($Cadenacomision,6,1);
switch($Comisioncurl)
{
case "A":
	$Comisioncur=1;
	break;
case "B":
	$Comisioncur=2;
	break;
case "C":
	$Comisioncur=3;
	break;
case "D":
	$Comisioncur=4;
	break;
case "E":
	$Comisioncur=5;
	 break;
case "F":
	$Comisioncur=6;
	 break;
}
$AbreCarrera=substr($Cadenacomision,8,$tamaniocadena-8);
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);

$ab="select * from materias where idmateria=$Materia";
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
$mref=mysqli_fetch_array($ba);
$Nombremateria=$mref['Abrevmateria'];	
$ab="insert into suscmaterias (idmateria,Nombremateria,idusuario,comisioncursado) values ($Materia,'$Nombremateria',$Usuario,$Comisioncur)";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
?>



	