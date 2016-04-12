<?
session_start();
$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_ageno","utnianoo");
mysqli_select_db($con,"u376876484_ageno") or die ("no se ha podido encontrar la base de datos");
$a="select * from usuarios";
$b=mysqli_query($con,$a);
$con2=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
mysqli_select_db($con2,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
while ($m=mysqli_fetch_array($b))
{
	$idusuario=$m['idusuario'];
	$Carrera=$m['Carrera'];
	$Anio=$m['Anio'];
	$c="select * from materias where Carrera=$Carrera AND Anio=$Anio";
	$d=mysqli_query($con,$c);
	$conta=0;
	while ($m2=mysqli_fetch_array($d))
	{
		$idmateria=$m2['idmateria'];
		$e="insert into suscmaterias (idmateria,idusuario) values ($idmateria,$idusuario)";
		$f=mysqli_query($con2,$e);
	}
	$conta++;
}
echo "La cantidad de veces que se repitio el ciclo es ".$conta;

?>


	