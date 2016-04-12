<?
session_start();
//Para obtener una estructura de arbol se usara una funcion recursiva


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

	$Usuario=$_GET['Usuario'];
	//Muestra todas las comisiones en la que esta cursando el usuario sus materias
	
	$ab="select * from carrera";	
	$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);

$listacar='';
$listacar.='<ul data-role="listview" data-inset="true">';
while ($mref=mysqli_fetch_array($ba))
{
	$Carrera=$mref['idcarrera'];
	$cantidadanios=$mref['Cantidadanios'];
	$abrevcarrera=$mref['Abrevcarrera'];
	for ($x=1;$x<=$cantidadanios;$x++)
				 {
					 	$ac="select * from comisiones where Carrera=$Carrera AND Anio=$x";	
						$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
						$mreco=mysqli_fetch_array($ca);
						$cantidadcomsisiones=$mreco['Cantidadcomis'];
						for ($y=1;$y<=$cantidadcomsisiones;$y++)
						 {
							 switch($y)
							 {
								 case 1:
								 $letra="A";
								 break;
								 case 2:
								 $letra="B";
								 break;
								 case 3:
								 $letra="C";
								 break;
								 case 4:
								 $letra="D";
								 break;
								 case 5:
								 $letra="E";
								 break;
								 case 6:
								 $letra="F";
								 break;
							}
							$af="select * from materias where Carrera=$Carrera AND Anio=$x";	
							$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
							$cadenamat="";
							$contmat=0;
							while ($mrema=mysqli_fetch_array($fa))
							{
								$idmateria=$mrema['idmateria'];
								if ($contmat==0)
								{
									$cadenamat.="idmateria=$idmateria";
								}
								else
								{
									$cadenamat.=" OR idmateria=$idmateria";
								}
								$contmat++;
							}
							//Verifica si este usuario esta cursando alguna materia en esta comision
							$af="select * from suscmaterias where ($cadenamat) AND comisioncursado=$y AND idusuario=$Usuario";	
							$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
							$cantenc=mysqli_num_rows($fa);
							
							//En caso afirmativo muestra estas materias dentro de un div inicialmente oculto con un header del nombre de la comision en la que esta cursando estas materias
							if ($cantenc!=0)
							{
								$cantmat=0;
							$cadenaconsmat="";
							while ($msum=mysqli_fetch_array($fa))
							{
								$materiaa=$msum['idmateria'];
								if ($cantmat==0)
								{
									$cadenaconsmat.="idmateria=".$materiaa;
								}
								else
								{
									$cadenaconsmat.=" OR idmateria=".$materiaa;
								}
								$cantmat++;
							}
							$af="select * from filescomp where ($cadenaconsmat) AND Comision=$y";	
							$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
							$cantshfiles=mysqli_num_rows($fa);
							
								$comabr=$x.' '.$letra.' '.$abrevcarrera;
								$listacar.='<li onclick="obteneropcionescomp(\'COMISION\',\''.$comabr.'\')">';
								$listacar.='<a href="#"><img src="../imagenes/iconosprogramas/carpeta.png"/>';	
								$listacar.='<h1>'.$x."º Año ".$letra." ".$abrevcarrera.'</h1>';
								$listacar.='<span class="ui-li-count">'.$cantshfiles.'</span>';
								$listacar.='</a></li>';
							}				
						} 
						
				} 
}
$listacar.='</ul>';

echo $listacar;
?>


	