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
	$idarchivo=$_GET['idarchivo'];
	//Muestra todas las materias que esta cursando el usuario en forma de carpetas y clasificadas por comision
	$contcom=0;
	
	$ab="select * from carrera";	
	$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);

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
							$af="select * from suscmaterias where ($cadenamat) AND comisioncursado=$y AND idusuario=$Usuario ORDER BY Nombremateria ASC";	
							$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
							$cantenc=mysqli_num_rows($fa);
							//En caso afirmativo muestra estas materias dentro de un div inicialmente oculto con un header del nombre de la comision en la que esta cursando estas materias
							if ($cantenc!=0)
							{
								$colapsado="";
								if ($contcom==0)
								{
									$colapsado='data-collapsed="false"';
								}
								$listmaterias.='<div data-role="collapsible" '.$colapsado.'><h2>'.$x."º Año ".$letra." ".$abrevcarrera.'</h2>';
								$listmaterias.='<ul data-role="listview" data-inset="true">';
								while($mmar=mysqli_fetch_array($fa))
								{
									$idmateria=$mmar['idmateria'];
									$Nombremateria=$mmar['Nombremateria'];
									$listmaterias.='<li><a href="#" onclick="compartiendoarchivo('.$y.','.$idmateria.','.$idarchivo.')">'.$Nombremateria.'</a></li>';
								}
								$listmaterias.='</ul></div>';
								$contcom++;
							}				
						} 
						
				} 
}

echo $listmaterias;
?>


	