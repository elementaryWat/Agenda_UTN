<? 
session_start();
$tiposes=$_COOKIE['tiposesutnd'];
if ($tiposes=="sesionUTNtempp")
{
	//Si el tipo de sesion es temporal obtiene los valores de las variables de sesion correspondientes en caso contrario de las cookies
	if ($_SESSION["idusuarioutnd"]==0)
	{
		header ("Location:inicioses.php");
	}
	$idusuario=$_SESSION["idusuarioutnd"];
	$usuario=$_SESSION["Usuarioutnd"];
	$Nombre=$_SESSION["Nombreutnd"];
	$Apellido=$_SESSION["Apellidoutnd"];
	$Carrera=$_SESSION["Carrerautnd"];
	$dbservidor=$_SESSION["dbservidor"];
	$dbnusuario=$_SESSION["dbnusuario"];
	$dbpass=$_SESSION["dbpass"];
	$dbnombre=$_SESSION["dbnombre"];
	$dbmensaje=$_SESSION["dbmensaje"];
}
else
{
	$idusuario=$_COOKIE["idusuarioutnd"];
	if ($idusuario==0)
	{
		header ("Location:inicioses.php");
	}
	$usuario=$_COOKIE["Usuarioutnd"];
	$Nombre=$_COOKIE["Nombreutnd"];
	$Apellido=$_COOKIE["Apellidoutnd"];
	$Carrera=$_COOKIE["Carrerautnd"];
	$dbservidor=$_COOKIE["dbservidor"];
	$dbnusuario=$_COOKIE["dbnusuario"];
	$dbpass=$_COOKIE["dbpass"];
	$dbnombre=$_COOKIE["dbnombre"];
	$dbmensaje=$_COOKIE["dbmensaje"];
}
$_SESSION["dbservidor"]="mysql.hostinger.com.ar";
$_SESSION["dbnusuario"]="u376876484_agen2";
$_SESSION["dbpass"]="utniano2";
$_SESSION["dbnombre"]="u376876484_agen2";
$_SESSION["dbmensaje"]="no se ha podido encontrar la base de datos";
$con=mysqli_connect($dbservidor,$dbnusuario,$dbpass);
mysqli_select_db($con,$dbnombre) or die ($dbmensaje);
//Determina si el usuario esta suscripto por lo menos a una materia 
//En caso contrario lo redirecciona a la pagina de seleccion de materias para poder realizar 
//la correspondiente "inscripcion"
$ab="select * from carrera  where idcarrera=$Carrera";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mperr=mysqli_fetch_array($ba);
$Nombcar=$mperr['Nombrecarrera'];
$ab="select * from usuarios  where idusuario=$idusuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mperr=mysqli_fetch_array($ba);
$fp=$mperr['Fotoperfil'];
$pasus=$mperr['Pass'];
$Emailus=$mperr['Email'];
if ($fp=="")
{
	$fp="estandar.jpg";
}

$ab="select * from suscmaterias  where idusuario=$idusuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$cantmat=mysqli_num_rows($ba);
if ($cantmat==0)
{
	header ("Location:selecmaterias.php");
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
$aniohoy=date("Y");

	/*
$con=mysqli_connect("mysql.hostinger.com.ar","u631612768_agend","utniano");
mysqli_select_db($con,"u631612768_agend") or die ("no se ha podido encontrar la base de datos");
*/
$fechavisit=date("Y-m-d");
$horavisit=date("G:i:s");
$fechavisit.=" ".$horavisit;

$aa="UPDATE `usuarios` SET  `Fechalvisit` =  '$fechavisit' WHERE  `idusuario` =$idusuario";	
$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no"/>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/git/jquery.mobile-git.css" /> 
<title>Agenda UTN</title>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/git/jquery.mobile-git.css" /> 
	<link rel="stylesheet" href="calendario/jquery.mobile.datepicker.css" />
	<link rel="stylesheet" href="calendario/jquery.mobile.datepicker.theme.css" />
    <link rel="stylesheet" href="themes/utniano.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
<!--  Seccion calendario-->
	<!-- Core CSS File. The CSS code needed to make eventCalendar works -->
	<link rel="stylesheet" href="css/eventCalendar.css">

	<!-- Theme CSS file: it makes eventCalendar nicer -->
	<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">
<!--Fin seccion calendario-->

	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="calendario/external/jquery-ui/datepicker.js"></script>
	<script src="calendario/jquery.mobile.datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"> </script>
     <link rel="stylesheet"  href="js/packiconos/dist/jqm-icon-pack-fa.css" />
<script type="text/javascript">
$(document).ready(function(e) {
			obtenertutoriales();
    });
	function cerrarses()
{
	$.ajax(
		{
			async:true,
			type:"GET",
			cache:false,
			url:"scriptsphp/cerrarses.php",
			success: function(data)
			{
				if (data=="ok")
				{
					document.location="inicioses.php";
				}
			}
		}
	);
}
function obtenersug()
	{
		$("#mensajesug").html("");
		$("#sugerencia").val("");
		 $("#sugerenciaa").popup('open');
	}
	function agregarsug()
	{
		sugerencia=$("#sugerencia").val();
		Usuario=<? echo $idusuario;?>;
		direcc="scriptsphp/agregarsugerencia.php?Usuario="+Usuario+"&Sugerencia="+sugerencia;
		direcc=encodeURI(direcc);
		if (sugerencia=="")
		{
			$("#mensajesug").html("<p>No se ha ingresado ningun texto</p>");
			$("#mensajesug").css("color","#F00");
			$("#sugerencia").attr("onkeyup","desaparecermensajedeerror('mensajesug')");
		}
		else
		{
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							if (data==1)
							{
								$("#mensajesug").html("<p>Gracias por colaborar en la mejora de la aplicacion. Cuanto antes estare revisando tu sugerencia</p>");
								$("#mensajesug").css("color","#31BF49");
									$("#sugerencia").attr("onkeyup","desaparecermensajedeerror('mensajesug')");
								setTimeout('$("#dialogoconfig").dialog("close")','7000');
							}
						}
				}
			);
		}
		
	}
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
<?
$boton=$_REQUEST['boton'];
$archivo = $_FILES['foto'];
$name = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$rutatmp = $_FILES['foto']['tmp_name'];
if ($boton=="Cambiar")
{
	?>
	$(document).ready(function(){
                   alert("Esto tiene que aparecer");
                });
	<?
}
?>
</script>
<style type="text/css">
</style></head>
<body>
      <div data-role="page" id="paginaselmaterias" data-fullscreen="true">
        <div data-role="panel" id="mypanel" data-position-fixed="true" data-display="push" data-theme="b">
        <div class="ui-grid-a" style="background-color:#12abf8; border-radius:30%">
          <div class="ui-block-a" style="vertical-align:middle" align="center"><h3><? echo $usuario;?></h3></div>
          <div class="ui-block-b" style="vertical-align:middle" align="right" ><img src="imagenes/Fotosperfil/<? echo $fp;?>" width="100%" alt=""/></div>
        </div>
        <a href="index.php" data-role="button" data-icon="calendar-o" data-ajax="false">Mis tareas</a>
        <a href="misarchivos.php" data-role="button" data-icon="folder" data-ajax="false">Mis archivos</a>
        <div data-role="collapsible" data-collapsed-icon="gear" data-expanded-icon="gear" data-collapsed="false">
           <h3>Configuracion</h3>
            <a href="modificacionmaterias.php" data-role="button" data-icon="list-alt" data-ajax="false">Materias</a>
            <a href="#" data-role="button" data-icon="user" class="ui-btn-active">Datos de usuario</a>
        </div>
        <div data-role="collapsible" data-collapsed-icon="code" data-expanded-icon="code">
           <h3>App</h3>
            <a href="#" data-role="button" data-icon="hand-o-left" onclick="obtenersug()">Sugerir</a>
             <a href="ayuda.php" data-role="button" data-icon="question-circle" data-ajax="false">Ayuda</a>
        </div>
        <a href="#" data-role="button" data-icon="power" onclick="cerrarses()">Cerrar sesion</a>
		</div>
        <div data-role="header" data-position="fixed" data-theme="a" onclick="obteneropciones()">
         	<div class="ui-grid-b">
                    <div class="ui-block-a"> <a href="#mypanel" data-role="button" data-icon="bars" data-iconpos="notext">Panel</a></div>
                    <div class="ui-block-b" style="text-align:center"><h5>Datos de usuario</h5></div>
                    <div class="ui-block-c" style="text-align:center"></div>
                </div>
    	</div>

       <div data-role="content" >
        <table width="100%" border="0" class="rowAlternate">
          <tbody>
          <tr>
              <td width="50%"><a href="#cambfp" data-rel="popup">Foto de perfil</a></td>
              <td width="50%"><img src="imagenes/Fotosperfil/<? echo $fp;?>" width="100%" alt=""/></td>
            </tr>
            <tr>
              <td width="50%"><strong>Nombre de usuario</strong></td>
              <td width="50%"><? echo $usuario;?></td>
            </tr>
            <tr>
              <td width="50%"><a><strong>Contraseña</strong></a></td>
              <td width="50%"><? echo $pasus;?></td>
            </tr>
            <tr>
              <td width="50%"><strong>Nombre</strong></td>
              <td width="50%"><? echo $Nombre;?></td>
            </tr>
            <tr>
              <td width="50%"><a><strong>Email</strong></a></td>
              <td width="50%"><? echo $Emailus;?></td>
            </tr>
            <tr>
              <td width="50%"><strong>Carrera</strong></td>
              <td width="50%"><? echo $Nombcar;?></td>
            </tr>
            <tr>
              <td colspan="2"><a href="#" data-role="button">Cambiar datos</a></td>
            </tr>
          </tbody>
        </table>

   	  </div> 
    <div data-role="popup" id="notificacion">
        <div data-role="header" data-theme="a">
        <h1 id="titulon"></h1>
    	</div>
        <div data-role="content" data-theme="a" id="contenidonoti">
        
    	</div>
    </div>
    <div data-role="popup" id="cambfp">
        <div data-role="header" data-theme="a">
        <h1>Cambiar foto de perfil</h1>
    	</div>
        <div data-role="content" data-theme="a">
        <form method="post" enctype="multipart/form-data" data-ajax="false">
         <table width="100%" border="0" class="rowAlternate">
          <tbody>
          <tr>
              <td width="50%"><input type="file" placeholder="Seleccione imagen" accept="image/*" name="foto"/></td>
            </tr>
            <tr>
              <td width="50%"><input type="submit" value="Cambiar" name="boton"/></td>
            </tr>
          </tbody>
        </table>
        </form>      
    </div>
      <div data-role="popup" id="sugerenciaa">
        <div data-role="header" data-theme="a">
        <h1>Agregar sugerencia</h1>
    	</div>
        <div data-role="content" data-theme="a">
         <textarea name="sugerencia" id="sugerencia"></textarea>
				 <a data-role="button" data-icon="check" data-theme="a" href="#" id="agregarsug" onclick="agregarsug()">Enviar</a>
				<span id="mensajesug"></span>
    	</div>
    </div>
    </div>
   
</body>

</html>
