
<?php
session_start();
$Rango=$_SESSION["Rango"];
$Criterio=$_SESSION["Criterio"];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechahoy=date("Y-m-d");
switch($Criterio)
{
	case "Todos":
		$consultacriterio="";
		break;
	default:
	$consultacriterio=" AND Tipo='$Criterio'";
	if ($Criterio=="TP")
	{
		//Para los trabajos busca tantos aquellos obligatorios como opcionales
		$consultacriterio=" AND (Tipo='TP' OR Tipo='OP')";
	}
}
$nivel=0;
$dia=$_GET['dia'];
$mes=$_GET['mes'];
$anio=$_GET['anio'];
$fecha = $anio.'-'.$mes.'-'.$dia;
$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
$consulr="";
if ($Rango!="Todas")
{
	$consulr=" AND Materia=".$Rango;
}
$ab=" SELECT * FROM  `tareas` WHERE  `Fechaentrega` >=  '".$anio."-".$mes."-".$dia."' AND  `Fechaentrega` < '".$nuevafecha."'".$consulr.$consultacriterio;
						$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);	
						$cant=mysqli_num_rows($ba);
						
						while ($mref=mysqli_fetch_array($ba))
						{
							$Tipo=$mref['Tipo'];
							switch($Tipo)
							{
								case 'TP':
								case 'OP':
									$Tipoc="Trabajo";
								break;
								case 'PC':
								case 'RE':
									$Tipoc="Parcial";
								break;
								case 'FL':
									$Tipoc="Final";
								break;
							}
							if ($Tipoc=='Trabajo' && $nivel<2)
							{
								$nivel=2;
							}
							if ($Tipoc=='Parcial' && $nivel<3)
							{
								$nivel=3;
							}
							if ($Tipoc=='Final')
							{
								$nivel=4;
							}
						}
if ($Rango=="Todas" && $Criterio=="Todos" )
{
	$aa="select * from feriados WHERE  `Fecha` =  '".$anio."-".$mes."-".$dia."' AND Fecha>='$fechahoy'";	
$ba=mysqli_query($con,$aa) or die ("error buscando ".$aa);
$cant=mysqli_num_rows($ba);
if ($cant!=0)
						{
							if ($nivel==0)
							{	
								$nivel=1;
							}
								
						}

}
echo $nivel;

?>