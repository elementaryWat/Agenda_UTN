<? 
session_start();
$Email=$_GET['Email'];
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

$a="select * from usuarios where Email = '$Email'";
$b = mysqli_query ($con,$a)
or die ("error buscando".$a);
$cant=mysqli_num_rows($b);
$m=mysqli_fetch_array ($b);
if ($cant != 0 ) 
{
	$usuario=$m['Usuario'];
	$passus=$m['Pass'];
	$Nombre=$m['Nombre'];
	$Apellido=$m['Apellido'];
	$destinatario = $Email; 
	$asunto = "Informacion de cuenta de www.utndiary.16mb.com"; 
	$cuerpo = ' 
	<html> 
	<head> 
	   <title>Informacion de cuenta</title> 
	</head> 
	<body> 
	<h1>Hola '.$Nombre.' '.$Apellido.'</h1> 
	<p> 
	Los datos de tu cuenta de ingreso a la agenda utniana son :
	</p> 
	<p> 
	Nombre de usuario: '.$usuario.'
	</p> 
	<p> 
	Contraseña: '.$passus.'
	</p> 
	<p> 
	<b>Gracias por usar la aplicacion</b>
	</p> 
	<p> 
	<b>Tu colega universitario Augusto Romero</b>
	</p> 
	</body> 
	</html> 
	'; 
	
	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	
	//dirección del remitente 
	$headers .= "From: Gerardo Augusto Romero <geragusto@hotmail.com>\r\n"; 
	
	//dirección de respuesta, si queremos que sea distinta que la del remitente 
	$headers .= "Reply-To: geragusto@hotmail.com\r\n"; 
	
	mail($destinatario,$asunto,$cuerpo,$headers);
	echo 1;
} 
else 
{
	echo 0;
}
?>