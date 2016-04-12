<?
session_start();
$Carrera=$_GET['Carrera'];
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
$ab="select * from carrera where idcarrera=$Carrera";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mref=mysqli_fetch_array($ba);
$cantidadanios=$mref['Cantidadanios'];
$Cantidadcom=$mref['Cantidadcom'];
echo '<label>Año<select name="anio" id="anio" data-native-menu="false"> ';
				echo '<option data-placeholder="true">Seleccionar año</option>';
                 for ($x=1;$x<=$cantidadanios;$x++)
				 {
					 echo '<option value="'.$x.'">'.$x.' Año</option>';
				} 
 echo '</select></label>';
 echo ' <span id="erroranio" style="display:none"></span>';
 echo '<label>Comision<select name="comision" id="comision" data-native-menu="false"> ';
 				echo '<option data-placeholder="true">Seleccionar comision</option>';
                 for ($x=1;$x<=$Cantidadcom;$x++)
				 {
					 switch($x)
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
					 echo '<option value="'.$x.'">'.$letra.'</option>';
				} 
 echo '</select></label>';
 echo ' <span id="errorcomision" style="display:none"></span>';
?>


	