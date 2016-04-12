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
$ab="select * from usuarios  where idusuario=$idusuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$mperr=mysqli_fetch_array($ba);
$fp=$mperr['Fotoperfil'];
if ($fp=="")
{
	$fp="estandar.jpg";
}
//Variabl de sesion utilizada para almacenar el id del directorio actual
if ($_SESSION['Directorio']==0 || $_SESSION['Directorio']=="")
{
	//Si no se cambia el valor de la variable se determina el valor al del drectorio raiz
	$_SESSION['Directorio']=0;
}
$directorio=$_SESSION['Directorio'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><ul></ul>
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
    <script>

/*Prototipo indexOf*/
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function (searchElement /*, fromIndex */ ) {
        "use strict";
        if (this == null) {
            throw new TypeError();
        }
        var t = Object(this);
        var len = t.length >>> 0;
        if (len === 0) {
            return -1;
        }
        var n = 0;
        if (arguments.length > 1) {
            n = Number(arguments[1]);
            if (n != n) { // para verificar si es NaN
                n = 0;
            } else if (n != 0 && n != Infinity && n != -Infinity) {
                n = (n > 0 || -1) * Math.floor(Math.abs(n));
            }
        }
        if (n >= len) {
            return -1;
        }
        var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
        for (; k < len; k++) {
            if (k in t && t[k] === searchElement) {
                return k;
            }
        }
        return -1;
    }
}
/*-------------------------------------------------------------------*/
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

function redireccionar()
	{
		document.location="index.php";
	}
function aparecermensajedeerror(elemento,mensaje)
	{
		$("#"+elemento).html(mensaje);
		$("#"+elemento).css("display","block");
		$("#"+elemento).css("color","#F00");
	}
	function desaparecermensajedeerror(elemento)
	{
		$("#"+elemento).css("display","none");
	}
	$(document).ready(function(e) {
		obtenerarchivos();
		obtenercarpcom();
    });
	function mostrarmensaje(tifile,menfile)
	{
		$("#titulofile").html(tifile);
		$("#mensajefile").html(menfile);
		$('#menfile').popup('open');
	}
	function mostrarconfirmacion(tifile,menfile,accionsi)
	{
		$("#tituloconf").html(tifile);
		$("#mensajeconf").html(menfile);
		$("#okconf").attr('onclick',accionsi);
		$("#noconf").attr('onclick','$("#confirmacion").popup("close");');
		$('#confirmacion').popup('open');
	}
	function validarform(formulario)
	{
		//Esta funcion es llamada antes de ejecutar el evento submir del formulario en cuestio
		//y sirve para validar todos los campos
		var nombrear=formulario.nombrear.value;
		var archivo=formulario.archivodestin.value;
		if (nombrear=="" || archivo=="")
		{
			if (nombrear=="")
			{
				aparecermensajedeerror("errornombre","<p>No se ha ingresado el nombre</p>");
				$("#nombrear").attr("onkeyup","desaparecermensajedeerror('errornombre')");
			}
			if (archivo=="")
			{
				aparecermensajedeerror("errorarchivo","<p>No se ha seleccionado el archivo</p>");
				$("#archivodestin").attr("onchange","desaparecermensajedeerror('errorarchivo');cambiarinpnombre(this.value)");
			}
			return false;
		}
		else
		{
			return true;
		}
	}
	function cambiarinpnombre(nombrefile)
	{
		var caracteresc="\\";
		var nombre=nombrefile.split(caracteresc);
		var tamanio=nombre.length;
		if (tamanio<2)
		{
			if (tamanio!=0)
			{
				nombrear=nombre;
			}
			else
			{
				nombrear="";
			}
		}
		else
		{
			nombrear=nombre[tamanio-1];
		}
		var tamnom=nombrear.length;
		//Encuentra la posicion de la ultima ocurrencia del punto
		var lastp=nombrear.lastIndexOf(".");
		var tamext=tamnom-lastp;
		var nombrearchivo=nombrear.substr(0,lastp);
		var extensionar=nombrear.substr(lastp,tamext);
		$("#nombrear").val(nombrearchivo);
		$("#extensionar").val(extensionar);
		$("#extfile").html(extensionar);
		
	}
	//Inicializa la variable directorio
	var Directorio=<? echo $directorio;?>;
	function obtenerarchivos()
	{
		cajaarchivos=$("#boxfiles");
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenearchivos.php?Usuario="+Usuario+"&Directorio="+Directorio,
					success: function(data)
						{
							cajaarchivos.html(data);
							cajaarchivos.enhanceWithin();
							mostraropcgen();
							//Selecciona todos los elementos que empiecen con carpeta y les asigna una funcion de respuesta al evento doubletap 
							//Esta funcion llamara a la funcion cambiardirectorio (pasandole como argumento el id de la carpeta presionada)
							$('[id^=carpeta]').on('doubletap', function() {
								var nombrecar=this.id; 
								var tamncar=nombrecar.length; 
								nombrecar=nombrecar.substr(7,tamncar-7);
								cambiardirectorio(nombrecar);
								});
						}
				}
			);
	 }

	 function obtenercarpcom()
	{
		var cajaarchivos=$("#boxshfiles");
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenercarpcom.php?Usuario="+Usuario,
					success: function(data)
						{
							cajaarchivos.html(data);
							cajaarchivos.enhanceWithin();
							mostraropcgen();
						}
				}
			);
	 }
	 function obtenermateriascarp(comision)
	 {
		 var cajaarchivos=$("#boxshfiles");
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenercarpmat.php?Usuario="+Usuario+"&Comision="+comision,
					success: function(data)
						{
							cajaarchivos.html(data);
							cajaarchivos.enhanceWithin();
							mostraropcgen();
						}
				}
			);
	}
	function obtenerarchivoscomp(matycom,cadenacom)
	{
		var lonmatycom=matycom.length;
		var comision=matycom.substr(0,1);
		var materia=matycom.substr(2,lonmatycom-2);
		 var cajaarchivos=$("#boxshfiles");
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenerarcom.php?Usuario="+Usuario+"&Materia="+materia+"&Comision="+comision+"&Cadenacom="+cadenacom,
					success: function(data)
						{
							cajaarchivos.html(data);
							cajaarchivos.enhanceWithin();
							mostraropcgen();
						}
				}
			);
	}
	
	 var archivoactual=0;
	 var contpres=0;
	 var archivosel=0;
	 function showopcgen()
	 {
		$("#opcmyf").css("display","block");
	}
	function hideopcgen()
	 {
		$("#opcmyf").css("display","none");
	}
	 function mostraropcgen()
	 {
		 //Las opciones generales son mostradas al presionar alguna seccion del header
		 $("#opcgeneral").slideDown(); 
		$("#opcespcif").slideUp();
	}
	
	function obteneropcionescomp(tipo,inffo,cadenacom)
	{
	 	$("#opcespcif").slideDown();
		$("#opcgeneral").slideUp(); 
		$("#opccarpeta").css("display","none");
		$("#opcarchivo").css("display","none");
		$("#confchname").css("display","none");
		$("#opccarpetacom").css("display","block");
		if (tipo=="COMISION")
		{
			$("#gotocar").attr("onclick","obtenermateriascarp(\'"+inffo+"\')");
		}
		else if (tipo=="MATERIA")
		{
			$("#gotocar").attr("onclick","obtenerarchivoscomp(\'"+inffo+"\',\'"+cadenacom+"\')");
		}	
	}
	
	 function obteneropciones(idarchivo,tipo,rutaar)
	 {
		 //Se detecta que el valor enviado como parametro no es el id de un archivo
		 if (isNaN(idarchivo))
		 {
			 mostraropcgen();
		}
		else
		{
			 if (idarchivo!=null)
		 	{
				//Oculta el input de modificacion del nombre del archivo o carpeta anteriormente seleccionado
				//Esto en caso de que el id del archivo sea distinro de 0
				if (archivosel!=0 && archivosel!=idarchivo)
				{
					$("#nombreedit"+archivosel).css("display","none");
					$("#nombrevista"+archivosel).css("display","block");
				}
				archivosel=idarchivo;
				switch (tipo)
				{
					case 'CARPETA':
					 $("#opccarpeta").css("display","block");
					 $("#opcarchivo").css("display","none");
					 $("#confchname").css("display","none");
					 $("#opccarpetacom").css("display","none");
					 $("#elibotca").attr("onclick","eliminararchivo("+idarchivo+",'"+tipo+"')");
					  $("#movbotca").attr("onclick","moverarchivo("+idarchivo+")");
					 $("#chnambotca").attr("onclick","cambiarnombrearchivo("+idarchivo+",'"+tipo+"')");
					break;
					case 'ARCHIVO':
					 $("#opcarchivo").css("display","block");
					 $("#opccarpeta").css("display","none");
					 $("#confchname").css("display","none");
					 $("#opccarpetacom").css("display","none");
					 $("#movbotar").attr("onclick","moverarchivo("+idarchivo+")"); 
					$("#elibotar").attr("onclick","eliminararchivo("+idarchivo+",'"+tipo+"')"); 
					$("#sharbotar").attr("onclick","compartirarchivo("+idarchivo+")");
					$("#descbotar").attr("href",rutaar); 
					$("#chnambotar").attr("onclick","cambiarnombrearchivo("+idarchivo+",'"+tipo+"')");
					break;
				}
				 $("#opcespcif").slideDown();
				$("#opcgeneral").slideUp(); 
				//Establece las llamadas a funciones de los botones descargar eliminar mover y cambiar nombre con los argumentos correctos
			}
		}
	}
	function moverarchivo(idfile)
	{
		var Usuario=<? echo $idusuario;?>;
		//Esta funcion se encarga de mostrar todo el arbol de directorios del usuario actual
		//De esta manera el usuario seleccionara el nuevo destino de su archivo
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenerarboldir.php?Usuario="+Usuario+"&idarchivo="+idfile,
					success: function(data)
						{
							$("#arboldir").html(data);
							$("#arboldir").enhanceWithin();
							$("#treedir").popup('open');
							$("#movatdir").attr('onclick','moviendoarchivo('+idfile+')');
						}
				}
			);
	}
	function moviendoarchivo(idfile)
	{
		var newdir=$('input:radio[name=seldir]:checked').val();
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/moverfichero.php?idarchivo="+idfile+"&Newdir="+newdir,
					success: function(data)
						{
							$("#treedir").popup('close');
							if (data==1)
							{
								setTimeout("mostrarmensaje('Correcto','Se ha movido correctamente')","1000");
								obtenerarchivos();
							}
							else if (data==0)
							{
								setTimeout("mostrarmensaje('Error','Ya existe una carpeta con este nombre en el directorio que se desea mover')","1000");
							}
						}
				}
			);
	}
	function mostrarbotmovdir()
	{
		$("#botmovdir").slideDown();
	}
	function mostrarsubdir(iddir)
	{//Esta funcion muestra el div que contiene los subdirectorios de una carpeta del arbol
		$("#subdir"+iddir).slideDown();
		$("#botmdir"+iddir).attr("onclick","ocultarsubdir("+iddir+")");
	}
	function ocultarsubdir(iddir)
	{
		$("#subdir"+iddir).slideUp();
		$("#botmdir"+iddir).attr("onclick","mostrarsubdir("+iddir+")");
	}
	function eliminararchivo(idfile,tipo)
	{
		if (tipo=="CARPETA")
		{
			var Tiipo="Carpeta";
			var mensajee="¿Esta seguro que desea eliminar esta carpeta y todos sus archivos internos?";
		}
		else if (tipo=="ARCHIVO")
		{
			var Tiipo="Archivo";
			var mensajee="¿Esta seguro que desea eliminar este archivo?";
		}
		mostrarconfirmacion("Eliminar "+Tiipo,mensajee,'eliminandofichero('+idfile+',"'+tipo+'")');
	}
	function eliminandofichero(idfile,tipo)
	{
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/eliminarfichero.php?idarchivo="+idfile+"&Tipo="+tipo,
					success: function(data)
						{
							$("#confirmacion").popup("close");
							if (data==1)
							{
								setTimeout("mostrarmensaje('Correcto','Se ha eliminado correctamente')","1500");
							}
							obtenerarchivos();
						}
				}
			);
	}
	
	function compartirarchivo(idfile)
	{
		var Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenermatdecompcomp.php?Usuario="+Usuario+"&idarchivo="+idfile,
					success: function(data)
						{
							$("#listashare").html(data);
							$("#listashare").enhanceWithin();
							$("#compartiendo").popup('open');
						}
				}
			);
	}
	
	function cambiarnombrearchivo(idfile,tipo)
	{
		$("#nombrevista"+idfile).css("display","none");
		$("#nombreedit"+idfile).css("display","block");
		$("#newnom"+idfile).attr("onkeyup","mostrarconfchna();comprobarnewnamefile("+idfile+",'"+tipo+"')");
	}
	function compartiendoarchivo(comision,idmateria,idarchivo)
	{
		var Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/compartirarchivo.php?Idarchivo="+idarchivo+"&Comision="+comision+"&Idmateria="+idmateria+"&Usuario="+Usuario,
					success: function(data)
						{
							$("#compartiendo").popup('close');
							setTimeout("mostrarmensaje('Compartido','Has compartido el archivo con exito')","1500");
							obtenercarpcom();
						}
				}
			);
	}
	
	function comprobarnewnamefile(idfile,tipo)
	{
		var newnombre=$("#newnom"+idfile).val();
		var Usuario=<? echo $idusuario;?>;
		//Esta funcion sirve para verificar que el nuevo nombre del archivo o carpeta no exista en otro fichero
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/comprobarnnfil.php?Usuario="+Usuario+"&Nombre="+newnombre+"&Tipo="+tipo+"&idarchivo="+idfile,
					success: function(data)
						{
							if (data==1)
							{
								//En caso de que el nuevo nombre pueda ser usado se cambia el evento del 
								//boton check para que llame a la funcion encargada de realizar el cambio
								$("#confchnbot").attr("onclick","cambiandonombre("+idfile+")");
							}
							else if (data==0)
							{
								$("#confchnbot").attr("onclick","");
							}
						}
				}
			);
	}
	function mostrarconfchna()
	{
		$("#opccarpeta").css("display","none");
		$("#opcarchivo").css("display","none");
		$("#confchname").css("display","block");
		$("#opccarpetacom").css("display","none");
	}
	
	function cambiandonombre(idfile)
	{	
		var newnombre=$("#newnom"+idfile).val();
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/cambiarnombrefil.php?idarchivo="+idfile+"&Newname="+newnombre,
					success: function(data)
						{
							obtenerarchivos();
						}
				}
			);
	}
	/*------------------------CARPETAS----------------------*/
	function mostinscarpeta()
	{
		$("#insfolder").popup("open");
	}
	function agregarfolder()
	{
		var divmensaje=$("#mensajefol");
		var dataser=$("#formfol").serialize();
		var nombre=$("#nombrecar").val();
		Usuario=<? echo $idusuario;?>;
		if (nombre=="")
		{
			aparecermensajedeerror("errornombrecar","<p>No se ha ingresado el nombre de la carpeta</p>");
			$("#nombrecar").attr("onkeyup","desaparecermensajedeerror('errornombrecar')");
		}
		else
		{
			$.ajax(
				{
					async:true,
					type:"POST",
					cache:false,
					data:dataser,
					url:"scriptsphp/agregarcarpeta.php?Usuario="+Usuario+"&Directorio="+Directorio+"&Nombre="+nombre,
					error: function(data)
						{
							alert("Error");
						},
					success: function(data)
						{
							if (data==1)
							{
								setTimeout('$("#nombrecar").val("")',"1000");
								setTimeout('$("#insfolder").popup("close")',"2000");
								obtenerarchivos();
							}
							else if (data==0)
							{
								aparecermensajedeerror("mensajefol","<p>Ya existe una carpeta con el mismo nombre en este directorio</p>");
								$("#nombrecar").attr("onkeyup","desaparecermensajedeerror('mensajefol')");
							}
						}
				}
			);
		}
	}
	function cambiardirectorio(iddirectorio)
	{
		mostraropcgen();
		Directorio=iddirectorio;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/cambiardirectorio.php?Newdir="+iddirectorio,
					success: function()
						{
							obtenerarchivos(); 
						}
				}
			);
	}
	/*------------------------------------------------------*/
</script>
<style type="text/css">
</style></head>
<? 
$nombre=$_REQUEST['nombrear'];
$extensionfile=$_REQUEST['extensionar'];
$boton=$_REQUEST['agregarchivo'];

$archivodestin = $_FILES['archivodestin'];
$archivo = $_FILES['archivodestin'];
	$name = $_FILES['archivodestin']['name'];
	$tipo = $_FILES['archivodestin']['type'];
	$tipo =strtolower($tipo);
	$rutatmp = $_FILES['archivodestin']['tmp_name'];

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaagre=date("Y-m-d");
$hora=date("G:i:s");
$fechaagre.=" ".$hora;

if ($boton=="Agregar archivo")
{
	?>
					 <script type="text/javascript">
					 $(document).ready(function(e) {
						 	alert('El tipo de archivo es '+<? echo $tipo;?>);
						});
					 </script> 
					 <?
	$ab="select * from Tiposarchivos where Descripcion='$tipo'";
	$ba=mysqli_query($con,$ab) or die ("error insertando ".$ab);
	$canttipos=mysqli_num_rows($ba);
	$mtipos=mysqli_fetch_array($ba);
	$ab="select * from archivos ORDER BY idarchivo DESC";
	$ba=mysqli_query($con,$ab) or die ("error insertando ".$ab);
	$mfiles=mysqli_fetch_array($ba);
	$idlast=$mfiles['idarchivo'];
	$destino="archivosusuarios/";
	$nr= $destino."archivo0".$idlast.$extensionfile;
		if (is_uploaded_file($rutatmp)){
			if (copy($rutatmp,$nr)){
				$taman=filesize($nr);
				//Verifica si el tamaño del archivo excede los 25 MiB
				if ($taman>26214400)
				{
					$Men='<p style="text-align:center; color:#F00">Este archivo es demasiado grande. El limite del tamaño de un archivo es de 25 MiB.</p><p style="text-align:center; color:#F00">Proximamente sera ampliado este rango de espacio. Agrega una sugerencia diciendo a cuanto pensas que podria ser ampliado este rango y porque</p>';
					?>
					 <script type="text/javascript">
					 $(document).ready(function(e) {
							mostrarmensaje('Error','<? echo $Men;?>');
						});
					 </script> 
					 <?
				}
				else
				{
					if ($canttipos==0)
					{
						$a="select * from tiposaagregar where Desctipo='$tipo'";
						$l=mysqli_query($con,$a) or die ("error insertando ".$a);
						$ctip=mysqli_num_rows($l);
						if ($ctip!=0)
						{
							//Si no existe el tipo archivo lo agrega en la lista de archivos a agregar
							$a="insert into tiposaagregar(Desctipo,Fecha,Usuario) values ('$tipo','$fechaagre',$idusuario)";
							$l=mysqli_query($con,$a) or die ("error insertando ".$a);
						}
					
					$Men='<p style="text-align:center; color:#F00">Este tipo de archivos no esta soportado actualmente. No te preocupes en la brevedad sera implementada una mejora</p>';
					?>
					 <script type="text/javascript">
					 $(document).ready(function(e) {
							mostrarmensaje('Error','<? echo $Men;?>');
						});
					 </script> 
					 <?
					}
					else
					{
						//Si el tipo existe verifica si esta en la tabla de tipos a agregar y en caso positivo elimina este registro de la tabla
						$a="select * from tiposaagregar where Desctipo='$tipo'";
						$l=mysqli_query($con,$a) or die ("error insertando ".$a);
						$ctip=mysqli_num_rows($l);
						if ($ctip!=0)
						{
							$a="delete from tiposaagregar where Desctipo='$tipo'";
							$l=mysqli_query($con,$a) or die ("error insertando ".$a);
						}
						
						$ab="select * from archivos where Nombre='$nombre' AND Usuario=$idusuario";
						$ba=mysqli_query($con,$ab) or die ("error insertando ".$ab);
						$caar=mysqli_num_rows($ba);
						if ($caar==0)
						{
							$tipoarc=$mtipos['idtipo'];
							$a="insert into archivos(Nombre,Extension,Tipoarcocar,Tipoarchi,Tamanio,Usuario,Fechaagre,Ruta,Ubicacionfic) values ('$nombre','$extensionfile','ARCHIVO',$tipoarc,'$taman',$idusuario,'$fechaagre','$nr',$directorio)";
							$l=mysqli_query($con,$a) or die ("error insertando ".$a);
							$Men='<p style="text-align:center; color:#0C0">Se ha guardado correctamente</p>';
							?>
						 <script type="text/javascript">
						 $(document).ready(function(e) {
								mostrarmensaje('Correcto','<? echo $Men;?>');
							});
						 </script> 
						 <?
						}
						else
						{
							$Men='<p style="text-align:center; color:#F00">Ya tienes un archivo con este mismo nombre</p>';
							?>
						 <script type="text/javascript">
						 $(document).ready(function(e) {
								mostrarmensaje('Error','<? echo $Men;?>');
							});
						 </script> 
						 <?
						}
					}
				}
			}}
			else
			{
				$Men='<p style="text-align:center; color:#F00">No se ha podido guardar</p>';
				?>
				 <script type="text/javascript">
				 $(document).ready(function(e) {
						mostrarmensaje('Error','<? echo $Men;?>');
					});
                 </script> 
                 <?
			}
}
?>
<body>
<div data-role="page" id="archivos" data-fullscreen="false">
		<div data-role="panel" id="mypanel" data-position-fixed="true" data-display="push" data-theme="b">
        <div class="ui-grid-a" style="background-color:#12abf8; border-radius:30%">
          <div class="ui-block-a" style="vertical-align:middle" align="center"><h3><? echo $usuario;?></h3></div>
          <div class="ui-block-b" style="vertical-align:middle" align="right" ><img src="archivosusuarios/Fotosperfil/<? echo $fp;?>" width="100%" alt=""/></div>
        </div>
        <a href="index.php" data-role="button" data-icon="calendar-o" data-ajax="false">Mis tareas</a>
        <a href="#" data-role="button" data-icon="folder" class="ui-btn-active">Mis archivos</a>
        <div data-role="collapsible" data-collapsed-icon="gear" data-expanded-icon="gear">
           <h3>Configuracion</h3>
            <a href="modificacionmaterias.php" data-role="button" data-icon="list-alt" data-ajax="false">Materias</a>
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
                    <div class="ui-block-b" style="text-align:center"><h5>Archivos</h5></div>
                    <div class="ui-block-c" style="text-align:center"></div>
                </div>
    	</div>
        <div data-role="content" data-position="fixed" data-theme="c" id="misfiles">
        <div data-role="tabs" id="tabs">
              <div data-role="navbar">
                <ul>
                  <li><a href="#boxfiles" data-ajax="false" onclick="showopcgen()" data-theme="a" class="ui-btn-active">Mis archivos</a></li>
                  <li><a href="#boxshfiles" data-ajax="false" onclick="hideopcgen()" data-theme="a">Archivos compartidos</a></li>
                </ul>	
              </div>
            <div id="boxfiles"></div>
            <div id="boxshfiles"></div>
            </div>
    	</div>
        <div data-role="footer" data-position="fixed" data-theme="a">
            <span id="opcgeneral" style=" width:100%">
            <span id="opcmyf">
                <div class="ui-grid-a">
                    <div class="ui-block-a" style="text-align:center"> <a href="#" data-role="button" data-icon="files-o" onclick="$('#insfile').popup('open');" data-theme="a">Agregar archivo</a></div>
                    <div class="ui-block-b" style="text-align:center"><a href="#" data-role="button" data-icon="folder-open" data-transition="slidedown" onclick="mostinscarpeta()" data-theme="a">Agregar carpeta</a></div>
                </div>
              </span>
            </span>
            <!-- Esta seccion mostrara las opciones correspondientes a las carpetas y archivos 
            A su vez esta seccion estara dividida en dos partes 
            Opciones de carpetas y archivos personales  y 
            Opciones de carpetas y archivos compartidos -->
            
            <!-- Opciones de carpetas y archivos personales -->
            <span id="opcespcif" style="display:none; width:100%">
                <div class="ui-grid-d" id="opcarchivo">
                        <div class="ui-block-a" style="text-align:center"> <a href="#" data-role="button" data-icon="sitemap" data-iconpos="notext" id="movbotar" data-theme="a">Mover archivo</a></div>
                        <div class="ui-block-b" style="text-align:center"> <a href="#" data-role="button" data-icon="font" data-iconpos="notext" id="chnambotar" data-theme="a">Cambiar nombre</a></div>
                        <div class="ui-block-c" style="text-align:center"> <a href="#" data-role="button" data-icon="delete" data-iconpos="notext" id="elibotar" data-theme="a">Eliminar archivo</a></div>
                        <div class="ui-block-d" style="text-align:center"> <a href="" data-role="button" data-icon="download" data-iconpos="notext" id="descbotar"  data-rel="extern" target="_blank" data-theme="a">Descargar archivo</a></div>
                        <div class="ui-block-e" style="text-align:center"> <a href="#" data-role="button" data-icon="share-square-o" data-iconpos="notext" id="sharbotar" data-theme="a">Compartir archivo</a></div>
                  </div>
                  
                  <div id="confchname" style="display:none">
                      <div style="width:100%; text-align:center"><a href="#" data-role="button" data-icon="check" data-iconpos="notext" id="confchnbot" data-theme="a">Cambiar nombre</a></div> 
                  </div>
                  
                <div class="ui-grid-b" id="opccarpeta" style="display:none">
                        <div class="ui-block-a" style="text-align:center"> <a href="#" data-role="button" data-icon="sitemap" data-iconpos="notext" id="movbotca" data-theme="a">Mover carpeta</a></div>
                        <div class="ui-block-b" style="text-align:center"> <a href="#" data-role="button" data-icon="delete" data-iconpos="notext" id="elibotca" data-theme="a">Eliminar carpeta</a></div>
                        <div class="ui-block-c" style="text-align:center"> <a href="#" data-role="button" data-icon="font" data-iconpos="notext" id="chnambotca" data-theme="a">Cambiar nombre</a></div>
                  </div>
                <!-- Opciones de carpetas y archivos compartidos -->
                <div id="opccarpetacom" style="display:none">
                        <div style="text-align:center"> <a href="#" data-role="button" data-icon="arrow-r" data-iconpos="notext" id="gotocar" data-theme="a">Ir a</a></div>
                  </div>
                  
            </span>
            </div>
            
    
     <div data-role="popup" id="treedir" data-position="fixed">
        <div data-role="header" data-theme="a">
        <h2 id="titulodir">Nueva ubicacion</h2>
    	</div>
        <div data-role="content" data-theme="a">
             <span id="arboldir">
             </span>
    	</div>
        <div data-role="footer" data-theme="b" style="display:none" id="botmovdir">
             <div style="width:100%; text-align:center"><a href="#" data-role="button" data-icon="random" id="movatdir" data-theme="a">Mover a este directorio</a></div>
    	</div>
    </div>
    
    <div data-role="popup" id="compartiendo" data-position="fixed">
        <div data-role="header" data-theme="a">
        <h2 id="tituloshare">Compartir en </h2>
    	</div>
        <div data-role="content" data-theme="a">
             <span id="listashare">
             </span>
    	</div>
    </div>
   
   <div data-role="popup" id="insfile">
        <div data-role="header" data-theme="a">
        <h2>Archivo</h2>
    	</div>
        <div data-role="content" data-theme="a">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" data-ajax="false" onsubmit="return validarform(this)" >

                 <p><table width="100%" border="0">
                      <tr>
                        <td><input name="nombrear" id="nombrear" type="text" /></td>
                        <td><span id="extfile"></span></td>
                      </tr>
                    </table><span id="errornombre"></span></p>
                 <p style="display:none"><input name="extensionar" id="extensionar" type="text" /><span id="errornombre"></span></p>
                <p><input name="archivodestin" id="archivodestin" type="file" onchange="cambiarinpnombre(this.value)"/><span id="errorarchivo"></span></p>
                <input name="agregarchivo" type="submit" value="Agregar archivo"/>
        </form>
          <p id="mensaje" style="text-align:center"></p>
    	</div>
    </div>
    
    <div data-role="popup" id="insfolder">
        <div data-role="header" data-theme="a">
        <h2>Carpeta</h2>
    	</div>
        <div data-role="content" data-theme="a">
        <form action="" method="post" enctype="multipart/form-data" name="formfol" id="formfol" data-ajax="false" onsubmit="return validarform(this)" >
                 <p><label>Nombre<input name="nombrecar" id="nombrecar" type="text" /></label><span id="errornombrecar"></span></p>
                <input name="agregarcarpeta" type="button" value="Agregar carpeta" onclick="agregarfolder()"/>
        </form>
          <p id="mensajefol" style="text-align:center"></p>
    	</div>
    </div>
    
    <div data-role="popup" id="menfile">
        <div data-role="header" data-theme="a">
        <h2 id="titulofile"></h2>
    	</div>
        <div data-role="content" data-theme="a">
          <p id="mensajefile" style="text-align:center"></p>
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
    
               
    <div data-role="popup" id="confirmacion">
        <div data-role="header" data-theme="a">
        <h2 id="tituloconf"></h2>
    	</div>
        <div data-role="content" data-theme="a">
          <p id="mensajeconf" style="text-align:center"></p>
          <p id="mensajeconf" style="text-align:center">
          <table width="100%" border="0">
              <tr>
                <td align="center" width="50%"><a href="#" data-role="button" data-icon="check-square" id="okconf">SI</a></td>
                <td align="center" width="50%"><a href="#" data-role="button" data-icon="minus-square" id="noconf">NO</a></td>
              </tr>
            </table>
            </p>
    	</div>
    </div>
    
    </div>
</body>
</html>
