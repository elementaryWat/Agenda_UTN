<?
session_start();
function armarfecha($nd,$d,$m,$a)
{
	if ($nd == "Monday"){
	  $nd = "Lunes";
	  }
	  if ($nd == "Tuesday"){
	  $nd = "Martes";
	  }
	  if ($nd == "Wednesday"){
	  $nd = "Miércoles";
	  }
	  if ($nd == "Thursday"){
	  $nd = "Jueves";
	  }
	  if ($nd == "Friday"){
	  $nd = "Viernes";
	  }
	  if ($nd == "Saturday"){
	  $nd = "Sábado";
	  }
	  if ($nd == "Sunday"){
	  $nd = "Domingo";
	  }
	  
	  if ($m == "January"){
	  $m = "Enero";
	  }
	  if ($m == "February"){
	  $m = "Febrero";
	  }
	  if ($m == "March"){
	  $m = "Marzo";
	  }
	  if ($m == "April"){
	  $m = "Abril";
	  }
	  if ($m == "May"){
	  $m = "Mayo";
	  }
	  if ($m == "June"){
	  $m = "Junio";
	  }
	  if ($m == "July"){
	  $m = "Julio";
	  }
	  if ($m == "August"){
	  $m = "Agosto";
	  }
	  if ($m == "September"){
	  $m = "Septiembre";
	  }
	  if ($m == "October"){
	  $m = "Octubre";
	  }
	  if ($m == "November"){
	  $m = "Noviembre";
	  }
	  if ($m == "December"){
	  $m = "Diciembre";
	  }
	  $fechaf =$nd." ".$d."/".$m."/".$a;
	  return $fechaf;
}
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
$aa="select Nombre,Apellido,Email,Date_format(Fecharegistro,'%W') AS ndreg,Date_format(Fecharegistro,'%d') AS dreg,Date_format(Fecharegistro,'%M') AS mreg,Date_format(Fecharegistro,'%Y') AS areg,Date_format(Fecharegistro,'%H') AS hreg,Date_format(Fecharegistro,'%i') AS minreg,Date_format(Fecharegistro,'%s') AS segreg from usuarios where idusuario=$Usuario";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);	
$m=mysqli_fetch_array($bb);
$Nombre=$m['Nombre'];
$Apellido=$m['Apellido'];
$Email=$m['Email'];
$ndreg=$m['ndagre'];
$dreg=$m['dreg'];
$mreg=$m['mreg'];
$areg=$m['areg'];
$hreg=$m['hreg'];
$minreg=$m['minreg'];
$segreg=$m['segreg'];
$fechareg =armarfecha($ndreg,$dreg,$mreg,$areg);
echo ' <div data-role="content">'
     .' <table width="100%" border="0">'
          .'<tr>'
           .' <td>Nombre</td>'
           .' <td>'.$Nombre.'</td>'
         .' </tr>'
         .' <tr>'
           .' <td>Apellido</td>'
           .' <td>'.$Apellido.'</td>'
          .'</tr>'
		  .'<tr>'
           .' <td>Email</td>'
           .' <td>'.$Email.'</td>'
         .' </tr>'
         .' <tr>'
           .' <td>Fecha de registro</td>'
           .' <td>'.$fechareg.'</td>'
          .'</tr>'
          .'<tr>'
            .'<td colspan="2"><a data-role="button" data-icon="minus" href="#" id="cerrarses" onclick="cerrarses()">Cerrar sesion</a></td>'
          .'</tr>'
		  .' <tr>'
           .' <td colspan="2">'
		   .'<div data-role="collapsible" data-theme="a" data-collapsed="true">'
	   			.'<h1>Agregar sugerencia</h1>'
				.'<textarea name="sugerencia" id="sugerencia"></textarea>'
				.' <a data-role="button" data-icon="check" data-theme="a" href="#" id="agregarsug" onclick="agregarsug()">Enviar</a>'
				.'<span id="mensajesug"></span>'
	 		 .'</div>'
		  .' </td>'
          .'</tr>'
		  .'<tr>'
            .'<td colspan="2"><a data-role="button" data-icon="back" href="#paginaselmaterias" id="changesub">Cambiar materias de cursado</a></td>'
          .'</tr>'
	.'</table>'
      .'</div>';
?>


	