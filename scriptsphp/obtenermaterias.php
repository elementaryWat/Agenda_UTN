<?
session_start();
$Cadenacomision=$_GET['Comision'];
$NumCom=$_GET['NumCom'];
$Usuario=$_GET['Usuario'];
$tamaniocadena=strlen($Cadenacomision);
$Anio=substr($Cadenacomision,0,1);
$Comisioncurl=substr($Cadenacomision,6,1);
$AbreCarrera=substr($Cadenacomision,8,$tamaniocadena-8);
$dbservidor=$_SESSION["dbservidor"];
$dbnusuario=$_SESSION["dbnusuario"];
$dbpass=$_SESSION["dbpass"];
$dbnombre=$_SESSION["dbnombre"];
$dbmensaje=$_SESSION["dbmensaje"];
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
$ab="select * from carrera where Abrevcarrera='$AbreCarrera'";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mref=mysqli_fetch_array($ba);
$Carreracur=$mref['idcarrera'];
/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
//Este script se encarda de mostrar todas las materias correspondientes a la carrera y anio seleccionados
$ab="select * from usuarios where idusuario=$Usuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mref=mysqli_fetch_array($ba);
$Carrera=$mref['Carrera'];
if ($Carrera==$Carreracur)
{
	//Si la carrera de la comision en la que esta cursando la/s materia/s actual/es es la misma a la que pertenece el usuario entonces obtiene todas las materias correspondientes a esa carrera y anio En caso conrrario solo muestra las homogeneas
	$ab="select * from materias where Carrera=$Carreracur AND Anio=$Anio";	
}
else
{
	$ab="select * from materias where Carrera=$Carreracur AND Anio=$Anio AND Homogenea='SI'";	
}
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);

$materias="";
if ($NumCom%2==0)
{
	$estilo='style="background-color:#306; color:#FFF;"';
}
else
{
	$estilo='style="color:#306; background-color:#FFF;"';
}
$materias.='<div '.$estilo.'><p style="text-align:center">¿Que materias estás cursando en la comision '.$Anio.'º Año '.$Comisioncur.' '.$AbreCarrera.'?</p><select name="listamaterias" id="listamaterias'.$NumCom.'" data-native-menu="false" multiple="multiple" onchange="desaparecermensajedeerror(\'errormaterias'.$NumCom.'\')"> <option data-placeholder="true">Seleccionar materia/s</option>';
while ($mref=mysqli_fetch_array($ba))
{
	$Nombremateria=$mref['Nombremateria'];
	$idmateria=$mref['idmateria'];
	$materias.='<option value="'.$idmateria.'">'.$Nombremateria.'</option>'; 
}
$materias.='</select><span id="errormaterias'.$NumCom.'"></span></div>';
		echo $materias;
?>



	