
<? 
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
$ab="select * from usuarios  where idusuario=$idusuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mperr=mysqli_fetch_array($ba);
$fp=$mperr['Fotoperfil'];
if ($fp=="")
{
	$fp="estandar.jpg";
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
/*-------Modificacion de las materias de cursado-----------------*/
$(document).ready(function(e) {
	obtenercomisiones();
    });
	function redireccionar()
	{
		document.location="index.php";
	}
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
	function obtenercomisiones()
	{
		//Esta funcion es llamada en la primera carga de un dia para informar 
		//de todas las tareas que deberan ser entregadas el dia posterio
		Carrera=<? echo $Carrera;?>;
		Usuario=<? echo $idusuario;?>;
		/*
		Carrera=
		Anio=
		Comision*/
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenercomsisionespmod.php?Carrera="+Carrera+"&Usuario="+Usuario,
					success: function(data)
						{
							$("#comisiones").html(data);
							$("#comisiones").enhanceWithin();
							$(document).ready(function(e) {
								mostrarmaterias();
								});
						}
				}
			);
			
	}
	var cantcam=0;
	function mostrarmaterias()
	{
		$("#materias").html('');
		var selectt=$("#listacomisiones").val();
		var cantidad=selectt.length;
		//Si hay alguna comision seleccionada y ya se ha realizado algun cambio se muestra el boton de modficacion de las materias
		if (cantidad==0 || cantcam==0)
		{
			$("#agregmat").slideUp();
		}
		else
		{
			$("#agregmat").slideDown();
		}
		//Si no hay ninguna comision seleccionada no muestra el boton de insercion de materias 
		for (x=0;x<cantidad;x++)
		{
			respuesta=obtenermateria(selectt[x],x);
		}	
	}
	function obtenermateria(Comision,num)
	{
		//Funcion que se encarga de mostrar un conjunto de divs cada uno correpondientes a una comision seleccionada para determinar las materias cursadas en esa coision
	Usuario=<? echo $idusuario;?>;
	$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenermateriaspmod.php?Comision="+Comision+"&Usuario="+Usuario+"&NumCom="+num,
					success: function(data)
					{
						$("#materias").append(data);
						$("#materias").enhanceWithin();
					}
				}
			);
	}
	function mostrarayuda()
	{
		$("#ayuda").slideDown();
		$("#mostrador").attr("onclick","ocultarayuda()");
	}
	function ocultarayuda()
	{
		$("#ayuda").slideUp();
		$("#mostrador").attr("onclick","mostrarayuda()");
	}
	function desaparecermensajedeerrortwo(elemento)
	{
		$("#"+elemento).css("display","none");
		cantcam++;
		$("#modifmat").slideDown();
	}
	function modificarmaterias()
	{
		Usuario=<? echo $idusuario;?>;
		var selecttcom=$("#listacomisiones").val();
		var selectmatt;
		var cantidadmat;
		var cantidaderrorees=0;
		//Primero se verifica si no hay errores y en caso 
		if (selecttcom==null)
		{
			cantidaderrorees++;
		}
		else
		{
			var cantidadcom=selecttcom.length;
			for (x=0;x<cantidadcom;x++)
			{
				selectmatt=$("#listamaterias"+x).val();
				if (selectmatt==null)
				{
					cantidaderrorees++;
					aparecermensajedeerror("errormaterias"+x,"No se ha seleccionado ninguna materia de cursado en esta comision");
				}
				else
				{
					cantidadmat=selectmatt.length;
				}
			}	
		}
		//En caso de que no haya errores agrega las suscripciones a las materias
		if (cantidaderrorees==0)
		{
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/eliminarmatercur.php?Usuario="+Usuario,
					success: function(data)
						{
							for (x=0;x<cantidadcom;x++)
							{
								selectmatt=$("#listamaterias"+x).val();
								cantidadmat=selectmatt.length;
								for (y=0;y<cantidadmat;y++)
								{
									modificandomaterias(selecttcom[x],selectmatt[y]);
								}	
							}
							$("#mensajeok").html("Las materias han sido modificadas con exito Espera unos segundos mientras tu cuenta es configurada");
							$("#modificandomat").popup('open');
							$("#mensajeok").css("display","block");
							$("#contenidoseleccion").css("display","none");
							$("#ajaxloader").css("display","block");
							setTimeout("redireccionar()","5000");	
						}
				}
			);
		}	
	}
	function modificandomaterias(comision,materia)
	{
		Usuario=<? echo $idusuario;?>;
	$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/modificarmaterias.php?Comision="+comision+"&Usuario="+Usuario+"&Materia="+materia
				}
			);
	}
	/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
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
            <a href="#" data-role="button" data-icon="list-alt" class="ui-btn-active">Materias</a>
            <a href="modificardetalles.php" data-role="button" data-icon="user" data-ajax="false">Datos de usuario</a>
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
                    <div class="ui-block-b" style="text-align:center"><h5>Modificacion de materias</h5></div>
                    <div class="ui-block-c" style="text-align:center"></div>
                </div>
    	</div>
        <div data-role="content" >
        <div id="contenidoseleccion">
            <table width="100%" border="0">
              <tr>
                <td align="center" valign="top">
                <p>Selecciona las nuevas materias de cursado</p>
                <a onclick="mostrarayuda()" id="mostrador">¿Como hago esto?</a>
                <span id="ayuda" style="display:none">
                <p>Primero debes elegir la/s comision/es donde estas cursando tus materias y luego las materias que estas cursando en cada comision</p>
                <p>En caso de que estes cursando una o mas materias homgeneas junto con una comision de otra carrera debes seleccionar la correspondiente comision y luego cual de las materias homogeneas estas cursando en la misma</p>
               </span>
                
                </td>
              </tr>
            </table>
            <span id="comisiones"></span>
            <span id="materias"></span>
            <p id="modifmat" style="display:none; text-align:center">
            <a onclick="modificarmaterias()" id="mostrador" data-role="button" >Modificar</a>
            </p>
        </div>
         <div data-role="popup" id="modificandomat" data-overlay-theme="a">
        <table width="100%" border="0">
          <tr>
            <td valign="middle" align="center"><span id="ajaxloader" style="display:none"><img src="imagenes/ajax-loader (1).gif"/></span>
        <span id="mensajeok" style="color:##252655; display:block"></span></td>
          </tr>
        </table>
		</div>
        
        
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
