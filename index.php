
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

$ab="select * from suscmaterias  where idusuario=$idusuario";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$cantmat=mysqli_num_rows($ba);
if ($cantmat==0)
{
	header ("Location:modificacionmaterias.php");
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
	$(document).ready(function() {
						obtenereventos();
					});
	var anioactual=<? echo $aniohoy;?>;
	var aniosiguiente=anioactual+1;
		$(function(){
			$( "#fecha" ).datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
			$("#fechaini").datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
			$("#fechafin").datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
		})
	</script>
    <script>
     $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '<Ant',
     nextText: 'Sig>',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd/mm/yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
     };
     $.datepicker.setDefaults($.datepicker.regional['es']);
    </script>
    <? 
	//Nota inicial
	if ($cantmat!=0)
	{
		//Marca como leido la nota de inicio solo en caso de que haya materias
		$aa="select * from notasinicio where idusuario=$idusuario";	
		$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
		$canttvisto=mysqli_num_rows($bb);
		if ($canttvisto==0)
		{
			$aa="insert into notasinicio (idusuario) values ($idusuario)";	
			$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
		}
	}
		
?>
<script type="text/javascript">
var tareasm;
var Usuario;
	function obtenereventos()
	{
		if (tareasm==null)
		{
			tareasm="Personales";
		}
		$("#calendarioac").html("");
		$("#calendarioac").html('<div id="eventCalendarInline"></div>');
		Rango=$("select[name=Rango]").val();
		Criterio=$("select[name=Criterio]").val();
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"json/events.json.php?Usuario="+Usuario +"&Rango="+Rango+"&Criterio="+Criterio+"&Tipocom="+tareasm,
					error: function (xhr, ajaxOptions, thrownError) {
						alert(thrownError);
					  },
					success: function(data)
						{
							eventos=data;
							vercalendario(eventos);
						}
				}
			);
	}
	function vercalendario(eventos)
	{
		$(document).ready(function() {
						eventos=JSON.parse(eventos);
						eventsInline=eventos;	
						$("#eventCalendarInline").eventCalendar({
							jsonData: eventsInline,
							locales: 'json/locale.es.json'
						});
					});
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
	function redireccionar()
	{
		document.location="index.php";
	}
$(document).on({
    "pageshow": function () {
		tinymce.init({
            selector: "textarea#detalles",
			setup : function(ed) {
			  ed.on('keyup', function(e) {
				  desaparecermensajedeerror('errordetalles');
			  });
		   },
            language : 'es',
			  content_css: [
				'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
				'//www.tinymce.com/css/codepen.min.css'
			  ],
			 theme: 'modern',
  plugins: [
    'advlist autolink lists link image preview hr',
    'searchreplace wordcount code fullscreen',
    'insertdatetime media save contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  		 toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  	toolbar2: 'forecolor backcolor emoticons',
         });
    }
}, "#dialogootarea");
$(document).on({
    "pageshow": function () {
		tinymce.init({
            selector: "textarea#detailss",
			setup : function(ed) {
			  ed.on('keyup', function(e) {
				  desaparecermensajedeerror('errordetailsmod');
			  });
		   },
            language : 'es',
			  content_css: [
				'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
				'//www.tinymce.com/css/codepen.min.css'
			  ],
			 theme: 'modern',
  plugins: [
    'advlist autolink lists link image preview hr',
    'searchreplace wordcount code fullscreen',
    'insertdatetime media save contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  		 toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  	toolbar2: 'forecolor backcolor emoticons',
         });
    }
}, "#dialogotarea");
/*
$(document).on({
    "pageshow": function () {
		
    }
}, "#dialogotarea");
$(document).on({
    "pagehide": function () {
		tinymce.execCommand('mceRemoveControl', true, 'detailss');
		alert("S esta por eliminar");
		$("#detailstarea").html('');;
    }
}, "#dialogotarea");
*/
var tareaasel=0;
	$(document).ready(function(e) {
		cantivisto=<? echo $canttvisto;?>;
		obtenertareas();
		$("#dialogotarea").bind("pagehide",function(){
										tareaasel=0;
								});
		if (cantivisto==0)
		{
			 $("#popupBasic").popup('open');
		}
		else
		{
			informarmanana();
		}
		$("#agregar").click(verificarfecha);
    });
	function informarmanana()
	{
		//Esta funcion es llamada en la primera carga de un dia para informar 
		//de todas las tareas que deberan ser entregadas el dia posterio
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
					url:"scriptsphp/consultatareamana.php?Usuario="+Usuario,
					success: function(data)
						{
							if (data!=1)
							{
								$("#notificacion").html(data);
								$("#notificacion").enhanceWithin();
								$("#notificacion").popup('open');
							}
							else
							{
								conscantnewn();
							}
						}
				}
			);
			
	}
	var caantnottac=0;
	function conscantnewn()
	{
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenercantnotifi.php?Usuario="+Usuario,
					success: function(data)
						{
							if (data!=0)
							{
								if (data!=caantnottac)
								{
									obtenertareas();
									$("#dialogotarea").bind("pagehide",function(){
											obtenereventos();
									});
									//Si ya hay un pop de notificacion abierto agrega el contenido actual al mismo
									$( "#caantnot" ).css("display","block");
									$("#caantnot").html('<span id="notcc" style=\'position:absolute;top:-0.02em;right: 0.5em;width: 1.5em;height: 1.5em;line-height:1.5em;text-align:center;font-family:"Helvetica Neue";font-weight:bold;color:#000000;text-shadow:0px 1px 0px rgba(0,0,0,.15);-webkit-box-shadow:inset 0px 1px 0px rgba(255,255,255,35),0px 1px 1px rgba(0,0,0,.2);-moz-box-shadow:inset 0px 1px 0px rgba(255,255,255,.35), 0px 1px 1px rgba(0,0,0,.2);box-shadow:inset 0px 1px 0px rgba(255,255,255,.35),0px 1px 1px rgba(0,0,0,.2);-webkit-border-radius:4em; -moz-border-radius:4em;border-radius:4em;opacity:1;background-color:#0284c5;border:1px solid #79b5cb;z-index:100\'>'+data+'</span>');							
										$( "#notcc" ).css("background-color","#3201AA");
										 $( "#notcc" ).css("color","#FFFFFF");
									   caantnottac=data;
									   setTimeout('regrestnot()',"1000");
								}
							}
							else
							{
								$( "#caantnot" ).css("display","none");
							}
							setTimeout("conscantnewn()","1000");
						}
				}
			);
	}
	function regrestnot()
	{
		$( "#notcc" ).css("background-color","#0284c5");
		$( "#notcc" ).css("color","#000000");
	}
	function consultarnotificaciones()
	{
		Usuario=<? echo $idusuario;?>;
		var w = window.innerWidth;
		var h = window.innerHeight;
		if (w>h)
		{
			wid=(20*w)/100;
		}
		else
		{
			wid=(10*w)/100;
		}
		//Esta funcion se encarga de realizar una solicitud ajax en un intervalo de 10 segundos 
		//para determinar si no se agregan nuevas tareas
		$("#notificacion").popup('close');
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenernotifi.php?Usuario="+Usuario+"&wid="+wid,
					success: function(data)
						{
							if (data!=1)
							{
								$( "#caantnot" ).css("display","none");
								//Si ya hay un pop de notificacion abierto agrega el contenido actual al mismo
								$("#textonotif").html(data);
								$("#textonotif").enhanceWithin();
								//Cierra cualquier dialogo que este abierto al encontrar una notificacion
								$('#dialogotarea').dialog();
								$('#dialogootarea').dialog();
								$('#dialogotarea').dialog('close');
								$('#dialogootarea').dialog('close');
								$('#notificacion2').popup('open');
							} else
							{
								$('#dialogotarea').dialog();
								$('#dialogootarea').dialog();
								$('#dialogotarea').dialog('close');
								$('#dialogootarea').dialog('close');
								$('#notificacion2').popup('open');
							}
						}
				}
			);
			
		
	}
	function cerrarnotificaciones()
	{
		$("#notificacion2").popup('close');
	} 
	function defcom(tipo)
	{
		tareasm=tipo;
	}
	function obtenertareas()
	{
		if (tareasm==null)
		{
			tareasm="Personales";
		}
		Rango=$("select[name=Rango]").val();
		Criterio=$("select[name=Criterio]").val();
		if (tareasm=="Personales")
		{
			cajamensaje=$("#contenidolib");
		}
		else if (tareasm=="Compartidas")
		{
			cajamensaje=$("#boxshtare");
		}
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenertareas.php?Usuario="+Usuario+"&Rango="+Rango+"&Criterio="+Criterio+"&Tipocom="+tareasm,
					success: function(data)
						{
							cajamensaje.html(data);
							cajamensaje.enhanceWithin();
						}
				}
			);
	 }
	var cantidaderr=0;
	function verificarfecha()
	{
		cantidaderr=0;
		var tipofecha=$("input[name=tipofecha]:checked").val();
		var fecha=$("#fecha").val();
		var fechaini=$("#fechaini").val();
		var fechafin=$("#fechafin").val();
		if (tipofecha!=undefined)
		{
			switch(tipofecha)
			{
				case "esp":
					var direccion="scriptsphp/verificarfecha.php?Tipofec=ESP&Fechaunica="+fecha;
					break;
				case "vari":
					var direccion="scriptsphp/verificarfecha.php?Tipofec=VAR&Fechainicio="+fechaini+"&Fechafin="+fechafin;
					break;
			}
			$.ajax(
				{
					async:true,
					type:"GET",
					url:direccion,
					cache:false,
					error:function()
					{
						alert("Error");
					},
					success: function(datos)
					{
						if (datos!=1)
						{
							switch(tipofecha)
							{
								case "esp":
									aparecermensajedeerror("errorfechaunica",datos);
									$("#fecha").attr("onchange","desaparecermensajedeerror('errorfechaunica')");
									cantidaderr++;
									break;
								case "vari":
									aparecermensajedeerror("errorfechafin",datos);
									$("#fechaini").attr("onchange","desaparecermensajedeerror('errorfechafin')");
									$("#fechafin").attr("onchange","desaparecermensajedeerror('errorfechafin')");
									cantidaderr++;
									break;
							}
						}
						verificarcamposestaticos();
					}
				}
			);
		}
		else
		{
			verificarcamposestaticos();
		}
			
	}
	function verificarcamposestaticos()
	{
		tinyMCE.triggerSave();
		var tipofecha=$("input[name=tipofecha]:checked").val();
		var fecha=$("#fecha").val();
		var fechaini=$("#fechaini").val();
		var fechafin=$("#fechafin").val();
		var hora=$("#horant").val();
		var minuto=$("#minutont").val();
		nombre=$("#nombre").val();
		 tipota=$("select[name=tipota]").val();
		 materia=$("select[name=materia]").val();
		 detalles=$("#detalles").val();
		 var fechamala=false;
		 if (tipofecha=="esp")
				{
					if (fecha=="" || hora=="" || minuto=="")
					{
						fechamala=true;
					}
				}
				else if (tipofecha=="vari")
				{
					if (fechaini=="")
					{
						fechamala=true;
					}
					if (fechafin=="")
					{
						fechamala=true;
					}	
				}
		 if (nombre=="" || detalles=="" || tipofecha==undefined || fechamala)
		{
			if (nombre=="")
			{
				aparecermensajedeerror("errornombre","<p>No se ha ingresado el nombre</p>");
				$("#nombre").attr("onkeyup","desaparecermensajedeerror('errornombre')");
			}
			if (tipofecha==undefined)
			{
				aparecermensajedeerror("errorfechageneral","<p>No se ha ingresado la fecha</p>");
			}
			else
			{
				if (tipofecha=="esp")
				{
					if (fecha=="")
					{
						aparecermensajedeerror("errorfechaunica","<p>No se ha ingresado la fecha</p>");
						$("#fecha").attr("onchange","desaparecermensajedeerror('errorfechaunica')");
					}
					if (hora=="")
					{
						aparecermensajedeerror("errorhorafu","<p>No se ha ingresado la hora</p>");
						$("#horant").attr("onchange","desaparecermensajedeerror('errorhorafu')");
					}
					if (minuto=="")
					{
						aparecermensajedeerror("errorminutofu","<p>No se ha ingresado el minuto</p>");
						$("#minutont").attr("onchange","desaparecermensajedeerror('errorminutofu')");
					}
				}
				else
				{
					if (fechaini=="")
					{
						aparecermensajedeerror("errorfechainicio","<p>No se ha ingresado la fecha de inicio</p>");
						$("#fechaini").attr("onchange","desaparecermensajedeerror('errorfechainicio')");
					}
					if (fechafin=="")
					{
						aparecermensajedeerror("errorfechafin","<p>No se ha ingresado la fecha final</p>");
						$("#fechafin").attr("onchange","desaparecermensajedeerror('errorfechafin')");
					}	
				}
			}
			if (detalles=="")
			{
				aparecermensajedeerror("errordetalles","<p>No se han ingresado los detalles</p>");
			}
			cantidaderr++;
		}
		agregartareas();
	}
	
	 function agregartareas()
	 {
		Usuario=<? echo $idusuario;?>;
		/*
		Anio=
		Comision*/
		var tipofecha=$("input[name=tipofecha]:checked").val();
		var fecha=$("#fecha").val();
		var fechaini=$("#fechaini").val();
		var fechafin=$("#fechafin").val();
		var hora=$("#horant").val();
		var minuto=$("#minutont").val();
		 var nombre=$("#nombre").val();
		 var tipota=$("select[name=tipota]").val();
		 var materia=$("select[name=materia]").val();
		 var detalles=$("#detalles").val();
		 nombre=encodeURIComponent(nombre);
		 tipota=encodeURIComponent(tipota);
		 materia=encodeURIComponent(materia);
		 detalles=encodeURIComponent(detalles);
		 fecha=encodeURIComponent(fecha);
		 fechaini=encodeURIComponent(fechaini);
		 fechafin=encodeURIComponent(fechafin);
		 dialogomensaje=$("#mensajeokn");
		 direccion="scriptsphp/agregartarea.php?Nombre="+nombre+"&Tipo="+tipota+"&Materia="+materia+"&Detalles="+detalles+"&Usuarioagre="+Usuario+"&Tipofecha="+tipofecha+"&Fechaunica="+fecha+"&Fechainicio="+fechaini+"&Fechafinal="+fechafin+"&Hora="+hora+"&Minuto="+minuto;
		if (cantidaderr>0)
		{
			aparecermensajedeerror("mensajeokn","<p>Corrija los errores para poder continuar</p>");
		}
		else
		{
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direccion,
					success: function(data)
						{
							dialogomensaje.html(data);
							$("#titulookn").html('Correcto');
							$("#mensajeokagt").popup('open');
							dialogomensaje.css("color","#090");
							$("#nombre").val("");
							tinyMCE.get('detalles').setContent("");
							 $("#fechaini").val("");
							 $("#fechafin").val("");
							 $("#fecha").val("");
							obtenertareas();
							$("#dialogootarea").bind("pagehide",function(){
									obtenereventos();
							});
						}
				}
			);
		}
	}
	var cantidaddtm=0;
	function obtenerdetallestarea(idtarea)
	{
		dialogotarea=$("#detailstarea");
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
url:"scriptsphp/obtenertarea.php?idtarea="+idtarea+"&Usuario="+Usuario,
					success: function(data)
						{
							dialogotarea.html(data);
							tareaasel=idtarea;
							anioactual=<? echo $aniohoy;?>;
							aniosiguiente=anioactual+1;
								$(function(){
									$( "#fecham" ).datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
		$("#fechamini").datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
		$("#fechamfin").datepicker({showAnim: "slideDown",changeMonth: true,changeYear: true,yearRange: anioactual+":"+aniosiguiente});
								})
							dialogotarea.enhanceWithin();
							tinyMCE.execCommand('mceRemoveEditor', true, 'detailss');
							tinyMCE.execCommand('mceAddControl', false, 'detailss');
							obtenercom(idtarea,Usuario,false);
							obtenercantcom(idtarea,Usuario,false);
							cargareditor();
						}
				}
			)
	}
	
	function cargareditor()
	{
		tinymce.init({
										selector: "textarea#detailss",
										language : 'es',
										content_css: "css/content.css",
										plugins: [
									"advlist autolink lists autoresize",
									"insertdatetime paste"
									],
									setup : function(ed) {
									  ed.on('keyup', function(e) {
										  desaparecermensajedeerror('errordetailsmod');
									  });
								   },
									toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
									});
	}
	function noseguirtarea(idtarea)
	{
		$("#nosiguiendt").popup("open");
		$( "#sisegtar" ).attr("onclick","nosiguiendotarea("+idtarea+")");
	}
	function nosiguiendotarea(idtarea)
	{
		var direcc="scriptsphp/noseguirtarea.php?Tarea="+idtarea+"&Usuario="+Usuario;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#nosiguiendt").popup("close");
							obtenertareas();obtenereventos();
						}
				}
			);
	}
	function seguirtarea(idtarea)
	{
			var direcc="scriptsphp/seguirtarea.php?Tarea="+idtarea+"&Usuario="+Usuario;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#siguiendt").popup("open");
						}
				}
			);
	}
	function definirtareaael(idtarea)
	{
		$( "#confirmado" ).attr("onclick","eliminartarea("+idtarea+")");
		var divconfirmadores=$("#confirmadores");
		var divmensajeeliminado=$("#mensajeeliminado");
		divconfirmadores.css("display","block");
		divmensajeeliminado.css("display","none");
	}
	function eliminartarea(idtarea)
{
	Usuario=<? echo $idusuario;?>;
		/*
		Carrera=
		Anio=
		Comision*/
	var divconfirmadores=$("#confirmadores");
	var divmensajeeliminado=$("#mensajeeliminado");
	$.ajax(
		{
			async:true,
			type:"GET",
			url:"scriptsphp/eliminartareas.php?idtarea="+idtarea+"&Usuario="+Usuario,
			cache:false,
			success: function(data)
			{
				if (data==1)
				{
					divconfirmadores.css("display","none");
					divmensajeeliminado.css("display","block");
					divmensajeeliminado.html("La tarea ha sido eliminada de forma satisfactoria");
					divmensajeeliminado.css("color","#31BF49");
					obtenertareas();
					$("#confirmar").bind("pagehide",function(){
							obtenereventos();
					});
					setTimeout('$("#confirmar" ).dialog( "close" )','3000');
				}
			}
		}
	);
	
}

//Modificacion de una tarea
var cantidaderr2=0;

function verificarfecha2(idtarea)
	{
		cantidaderr2=0;
		var tipofecha=$("input[name=tipomodfecha]:checked").val();
		var fecha=$("#fecham").val();
		var fechaini=$("#fechamini").val();
		var fechafin=$("#fechamfin").val();
		if (tipofecha!=undefined)
		{
			switch(tipofecha)
			{
				case "esp":
					var direccion="scriptsphp/verificarfecha.php?Tipofec=ESP&Fechaunica="+fecha;
					break;
				case "vari":
					var direccion="scriptsphp/verificarfecha.php?Tipofec=VAR&Fechainicio="+fechaini+"&Fechafin="+fechafin;
					break;
			}
			$.ajax(
				{
					async:true,
					type:"GET",
					url:direccion,
					cache:false,
					error:function()
					{
						alert("Error");
					},
					success: function(datos)
					{
						if (datos!=1)
						{
							switch(tipofecha)
							{
								case "esp":
									aparecermensajedeerror("errorfechaum",datos);
									$("#fecham").attr("onchange","desaparecermensajedeerror('errorfechaunica')");
									cantidaderr2++;
									break;
								case "vari":
									aparecermensajedeerror("errorfechamf",datos);
									$("#fechamini").attr("onchange","desaparecermensajedeerror('errorfechamf')");
									$("#fechamfin").attr("onchange","desaparecermensajedeerror('errorfechamf')");
									cantidaderr2++;
									break;
							}
						}
						verificarcamposestaticos2(idtarea);
					}
				}
			);
		}
		else
		{
			verificarcamposestaticos2(idtarea);
		}
	}
	function verificarcamposestaticos2(idtarea)
	{
		nombre=$("#nombremod").val();
		 materia=$("#materiamod").val();
		 tinyMCE.triggerSave();
		 detalles=$("#detailss").val();
		 var tipofecha=$("input[name=tipomodfecha]:checked").val();
		 var fecha=$("#fecham").val();
		 var hora=$("#horamt").val();
		 var minuto=$("#minutomt").val();
		 var fechaini=$("#fechaentedi").val();
		 var fechafin=$("#fechaentedi").val();
		 var fechamala=false;
		 if (tipofecha=="esp")
				{
					if (fecha=="" || hora=="" || minuto=="")
					{
						fechamala=true;
					}
				}
				else if (tipofecha=="vari")
				{
					if (fechaini=="")
					{
						fechamala=true;
					}
					if (fechafin=="")
					{
						fechamala=true;
					}	
				}
		 if (nombre=="" || detalles=="" || tipofecha==undefined || fechamala)
		{
			cantidaderr2++;
			if (tipofecha==undefined)
			{
				aparecermensajedeerror("errorfechamgen","<p>No se ha ingresado la fecha</p>");
			}
			else
			{
				if (tipofecha=="esp")
				{
					if (fecha=="")
					{
						aparecermensajedeerror("errorfechaum","<p>No se ha ingresado la fecha</p>");
						$("#fecham").attr("onchange","desaparecermensajedeerror('errorfechaum')");
					}
					if (hora=="")
					{
						aparecermensajedeerror("errorhoramt","<p>No se ha ingresado la hora</p>");
						$("#horamt").attr("onchange","desaparecermensajedeerror('errorhoramt')");
					}
					if (minuto=="")
					{
						aparecermensajedeerror("errorminutomt","<p>No se ha ingresado el minuto</p>");
						$("#minutomt").attr("onchange","desaparecermensajedeerror('errorminutomt')");
					}
				}
				else
				{
					if (fechaini=="")
					{
						aparecermensajedeerror("errorfechamin","<p>No se ha ingresado la fecha de inicio</p>");
						$("#fechamini").attr("onchange","desaparecermensajedeerror('errorfechamin')");
					}
					if (fechafin=="")
					{
						aparecermensajedeerror("errorfechamf","<p>No se ha ingresado la fecha final</p>");
						$("#fechamfin").attr("onchange","desaparecermensajedeerror('errorfechamf')");
					}	
				}
			}
			if (detalles=="")
			{
				aparecermensajedeerror("errordetailsmod","<p>No se han ingresado los detalles</p>");
				$("#detailss").attr("onkeyup","desaparecermensajedeerror('errordetailsmod')");
			}
			if (nombre=="")
			{
				aparecermensajedeerror("errornombremod","<p>No se ha ingresado el nombre de la tarea</p>");
				$("#nombremod").attr("onkeyup","desaparecermensajedeerror('errornombremod')");
			}
		}
		modificartarea(idtarea);
	}
	function modificartarea(idtarea)
	{
		Usuario=<? echo $idusuario;?>;
		/*
		Carrera=
		Anio=
		Comision*/
		var nombre=$("#nombremod").val();
		 var materia=$("#materiamod").val();
		 tinyMCE.triggerSave();
		 var tipofecha=$("input[name=tipomodfecha]:checked").val();
		 var detalles=$("#detailss").val();
		 var tipota=$("select[name=tipotaed]").val();
		 var fecha=$("#fecham").val();
		 var hora=$("#horamt").val();
		 var minuto=$("#minutomt").val();
		 var fechaini=$("#fechamini").val();
		 var fechafin=$("#fechamfin").val();
		 nombre=encodeURIComponent(nombre);
		 materia=encodeURIComponent(materia);
		 tipota=encodeURIComponent(tipota);
		 detalles=encodeURIComponent(detalles);
		 fecha=encodeURIComponent(fecha);
		 fechaini=encodeURIComponent(fechaini);
		 fechafin=encodeURIComponent(fechafin);
		 direccion="Usuario="+Usuario+"&Detalles="+detalles+"&Fechaunica="+fecha+"&idTarea="+idtarea+"&Nombre="+nombre+"&Materia="+materia+"&Fechainicio="+fechaini+"&Fechafinal="+fechafin+"&Tipofecha="+tipofecha+"&Tipotarea="+tipota+"&Hora="+hora+"&Minuto="+minuto;
		 newurl="scriptsphp/modificartarea.php";
		if (cantidaderr2!=0)
		{
			aparecermensajedeerror("errormodgen","<p>Debe corregir todos los errores para poder continuar</p>");
		}
		else
		{
			$.ajax(
				{
					async:true,
					type:"POST",
					cache:false,
					data:direccion,
					url:newurl,
					error: function()
					{alert("Error");},
					success: function(data)
						{
							$("#fecham").val("");
							$("#fechamini").val("");
							$("#fechamfin").val("");
							 $("#nombremod").val("");
							 tinyMCE.get('detailss').setContent("");
							 obtenertareas();
							 $("#dialogotarea").bind("pagehide",function(){
							obtenereventos();
					});
							obtenerdetallestarea(idtarea);
						}
				}
			);
		}
		
	}
	function compchange(idtarea,valorselect)
	{
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
url:"scriptsphp/editarrealizado.php?Estado="+valorselect+"&idtarea="+idtarea+"&idusuario="+Usuario
				}
			);
		
	}
	function determinartexto(valoractual)
	{
		if (valoractual=="TP" || valoractual=="OP")
		{
			$("#detalless").html("Detalles");
			$("#fechas").html("Fecha de entrega");
		}
		else
		{
			$("#detalless").html("Temas a estudiar");
			$("#fechas").html("Fecha de mesa");
		}
		
	}
	function obtenerdatosusuario()
	{
		Usuario=<? echo $idusuario;?>;
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenedatosuser.php?Usuario="+Usuario,
					success: function(data)
						{
							$("#datosconff").html(data);
							$("#datosconff").enhanceWithin();
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
function mostrarinpfecha(valorradio)
{
	desaparecermensajedeerror('errorfechageneral');
	//Esta funcion se encarga de mostrar los campos de texto de fechas de acuerdo a si es un rango de tiempo o una fecha especifica
	switch(valorradio)
	{
		case "esp":
			$("#fecha1").css("display","block");
			$("#fecha2").css("display","none");
			break;
		case "vari":
			$("#fecha1").css("display","none");
			$("#fecha2").css("display","block");
			break;
	}

}
function mostrarinpfecha2(valorradio)
{
	desaparecermensajedeerror('errorfechamgen');
	//Esta funcion se encarga de mostrar los campos de texto de fechas de acuerdo a si es un rango de tiempo o una fecha especifica
	switch(valorradio)
	{
		case "esp":
			$("#fechamod2").css("display","block");
			$("#fechamod22").css("display","none");
			break;
		case "vari":
			$("#fechamod2").css("display","none");
			$("#fechamod22").css("display","block");
			break;
	}

}
function guiadeinicio()
{
	$("#popupBasic").popup('close');
	$("#guiadeinicio").popup('open');
}
function mostrarcalendario()
{
	$("#calendarioac").slideDown();
	$("#botmost").attr("onclick","ocultarcalendario()");
	obtenereventos();
}
function ocultarcalendario()
{
	$("#calendarioac").slideUp();
	$("#botmost").attr("onclick","mostrarcalendario()");
}

	/*-----------------------Links de utilidad--------------------*/
	function mostrarinslink(idtarea,idusuario)
	{
		$("#agregenlace").popup('open');
		$("#botagreglink").attr("onclick","agregarlink("+idtarea+","+idusuario+")");
	}
	function esurl(url) {
	/*http://code.tutsplus.com/tutorials/8-regular-expressions-you-should-know--net-6149*/
	return /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/.test(url);
	}
	function agregarlink(idtarea,idusuario)
	{
		nombrelink=$("#nombreurl").val();
		notaslink=$("#notasurl").val();
		urllink=$("#urld").val();
		if (nombrelink=="" || notaslink=="" || urllink=="" || !esurl(urllink))
		{
			if (nombrelink=="")
			{
				aparecermensajedeerror("errornombreurl","<p>No se ha ingresado el nombre del enlace</p>");
				$("#nombreurl").attr("onkeyup","desaparecermensajedeerror('errornombreurl')");
			}
			if (notaslink=="")
			{
				aparecermensajedeerror("errornotasurl","<p>No se ha ingresado ninguna nota</p>");
				$("#notasurl").attr("onkeyup","desaparecermensajedeerror('errornotasurl')");
			}
			if (!esurl(urllink))
			{
				aparecermensajedeerror("errorurld","<p>Esto no es una url</p>");
				$("#urld").attr("onkeyup","desaparecermensajedeerror('errorurld')");
			}
			if (urllink=="")
			{
				aparecermensajedeerror("errorurld","<p>No se ha ingresado el enlace</p>");
				$("#urld").attr("onkeyup","desaparecermensajedeerror('errorurld')");
			}
		}
		else
		{
			nombrelink=encodeURIComponent(nombrelink);
			notaslink=encodeURIComponent(notaslink);
			urllink=encodeURIComponent(urllink);
			direcc="scriptsphp/agregarlinks.php?Nombre="+nombrelink+"&Notas="+notaslink+"&Tarea="+idtarea+"&Usuarioagre="+idusuario+"&Enlace="+urllink;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#nombreurl").val("");
							$("#notasurl").val("");
							$("#urld").val("");
							$("#agregenlace").popup('close');
							obtenerdetallestarea(idtarea);
						}
				}
			);
		}
	}
	function eliminarlink(idlink)
	{
		$("#confirmacion"+idlink).popup('open');
	}
	function eliminandolink(idlink,idtarea)
	{
		//Recibe al id de la tarea como parametro para poder recargarla cuando se completa la solicitud ajax
		direcc="scriptsphp/eliminarinks.php?idlink="+idlink;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#okellin"+idlink).html('Se ha eliminado con exito');
							$("#preguntellin"+idlink).slideUp();
							$("#okellin"+idlink).slideDown();
							obtenerdetallestarea(idtarea);
						}
				}
			);
	}
	function modificarlink(idlink)
	{
		//Muestra la seccion correspondiente a la edicion dek link 
		$("#linkmain"+idlink).slideUp();
		$("#linkedit"+idlink).slideDown();
	}
	function modificandolink(idlink,idtarea)
	{
		var enlacee=$("#enlacedit"+idlink).val();
		var notase=$("#notasedit"+idlink).val();
		if (notase=="" || enlacee=="" || !esurl(enlacee))
		{
			if (notase=="")
			{
				aparecermensajedeerror("errornotalink"+idlink,"<p>No se ha ingresado ninguna nota</p>");
				$("#notasedit"+idlink).attr("onkeyup","desaparecermensajedeerror('errornotalink"+idlink+"')");
			}
			if (!esurl(enlacee))
			{
				aparecermensajedeerror("errorlink"+idlink,"<p>Esto no es una url</p>");
				$("#enlacedit"+idlink).attr("onkeyup","desaparecermensajedeerror('errorlink"+idlink+"')");
			}
			if (enlacee=="")
			{
				aparecermensajedeerror("errorlink"+idlink,"<p>No se ha ingresado el enlace</p>");
				$("#enlacedit"+idlink).attr("onkeyup","desaparecermensajedeerror('errorlink"+idlink+"')");
			}
		}
		else
		{
			notase=encodeURIComponent(notase);
			enlacee=encodeURIComponent(enlacee);
			direcc="scriptsphp/modificarlinks.php?idlink="+idlink+"&Notas="+notase+"&Enlace="+enlacee;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							obtenerdetallestarea(idtarea);
						}
				}
			);
		}
	}
	function vernotas(idlink)
	{
		//Muestra el div oculto donde se encuentras los detalles adicionales de los links
		$("#linkedit"+idlink).css("display","none");
		$("#linkmain"+idlink).css("display","block");
		$("#link"+idlink).slideDown();
		$("#bot"+idlink).attr("onclick","ocultarnotas("+idlink+")");
	}
	function ocultarnotas(idlink)
	{
		$("#link"+idlink).slideUp();
		$("#bot"+idlink).attr("onclick","vernotas("+idlink+")");
	}
/*----------------------------------------------------------------*/
/*------------------Archivos compartidos-------------------------*/
function mostrarinsarchivo(idtarea,idusuario)
	{
		$("#pieagarchivo").css("display","none");
		$("#agregarchivoo").popup('open');
		$("#botagreglink").attr("onclick","agregararchivo("+idtarea+","+idusuario+")");
	}
	var archivoselec=0;
	function seleccionado(idarchivo,rutaimagen,nombrear,peso)
	{
		archivoselec=idarchivo;
		$("#prevar").html('<p>&nbsp;</p><ul data-role="listview" id="listathear"><li><a href="#"><img src="'+rutaimagen+'"/><h1>'+nombrear+'</h1><p>'+peso+'</p></a></li></ul><p><label>Insertar notas<input type="checkbox" name="notarc" id="notarc_0" class="custom" value="" onclick="mostrarcajaar()"/></label></p><div data-role="fieldcontain" id="cajsnotaarc" style="display:none"><textarea cols="40" rows="8" name="textarea" id="textnotaar" placeholder="Inserte una nota aqui"></textarea></div><span id="errornarr"></span>');
		$("#prevar").css("display","block");
		$("#boxfil").enhanceWithin();
		$("#listathear").css('display','block');
		$("#confagarchivo").css('display','block');	
		$("#agrarchivo").html("Cambiar archivo");
		$("#agregarchivoo").popup('close');
	}
	function esurl(url) {
	/*http://code.tutsplus.com/tutorials/8-regular-expressions-you-should-know--net-6149*/
	return /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/.test(url);
	}
	function buscararchivo(busqueda)
	{
			var direcc="scriptsphp/buscararchivos.php?Usuario="+Usuario+"&Busqueda="+busqueda;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#listaarchivos").html(data);
							$("#listaarchivos").enhanceWithin();
						}
				}
			);
	}
	function mostrarcajaar()
	{
		if($("#notarc_0").is(':checked'))
		{
			$("#cajsnotaarc").slideDown();
		}
		else
		{
			$("#cajsnotaarc").slideUp();
		}
	}
	function agregararchivo(idtarea,idusuario)
	{
		var estt=$("#notarc_0").is(':checked');
		var ernar=false;
		notasarchivo=$("#textnotaar").val();
		if ($("#notarc_0").is(':checked'))
		{
			if (notasarchivo=="")
			{
				ernar=true;
				aparecermensajedeerror("errornarr","<p>No se ha ingresado ninguna nota</p>");
				$("#textnotaar").attr("onkeyup","desaparecermensajedeerror('errornarr')");
			}
		}
		if (!ernar)
		{
			direcc="scriptsphp/agregararccom.php?idarchivo="+archivoselec+"&Notas="+notasarchivo+"&Tarea="+idtarea+"&Usuarioagre="+idusuario;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#listaarchivos").html("");
							$("#nombrefilee").val("");
							if (data==1)
							{
								$("#notificacionar").html('<div data-role="header"><h3>Correcto</h3></div><p>El archivo se ha agregado de forma exitosa</p>');
								$("#notificacionar").enhanceWithin();
								$("#notificacionar").popup('open');
								obtenerdetallestarea(idtarea);
							}else if (data==2)
							{
								$("#notificacionar").html('<div data-role="header"><h3>Error</h3></div><p>Este archivo ya ha sido compartido en la tarea</p>');
								$("#notificacionar").enhanceWithin();
								$("#notificacionar").popup('open');
							}
						}
				}
			);
		}
	}
	function eliminararchivo(idarchivo)
	{
		$("#confirmacionar"+idarchivo).popup('open');
	}
	function eliminandoar(idarchivo,idtarea)
	{
		//Recibe al id de la tarea como parametro para poder recargarla cuando se completa la solicitud ajax
		direcc="scriptsphp/eliminararcom.php?idarchivo="+idarchivo;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#okearr"+idarchivo).html('Se ha eliminado con exito');
							$("#preguntearr"+idarchivo).slideUp();
							$("#okearr"+idarchivo).slideDown();
							obtenerdetallestarea(idtarea);
						}
				}
			);
	}
	function modificararchivo(idarchivo)
	{
		$("#filemain"+idarchivo).slideUp();
		$("#fileedit"+idarchivo).slideDown();
	}
	function modificandoar(idarchivo,idtarea)
	{
		var notasar=$("#notaseditarar"+idarchivo).val();
		if (notasar=="")
			{
				aparecermensajedeerror("errornotaar"+idarchivo,"<p>No se ha ingresado ninguna nota</p>");
				$("#notaseditarar"+idarchivo).attr("onkeyup","desaparecermensajedeerror('errornotaar"+idarchivo+"')");
			}
		else
		{
			notasar=encodeURIComponent(notasar);
			direcc="scriptsphp/modificararchivoscom.php?idarchivo="+idarchivo+"&Notas="+notasar;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							obtenerdetallestarea(idtarea);
						}
				}
			);
		}
	}
	function vernotasar(idarchivo)
	{
		//Muestra el div oculto donde se encuentras los detalles adicionales de los links
		$("#fileedit"+idarchivo).css("display","none");
		$("#filemain"+idarchivo).css("display","block");
		$("#arch"+idarchivo).slideDown();
		$("#botar"+idarchivo).attr("onclick","ocultarnotasar("+idarchivo+")");
	}
	function ocultarnotasar(idarchivo)
	{
		$("#arch"+idarchivo).slideUp();
		$("#botar"+idarchivo).attr("onclick","vernotasar("+idarchivo+")");
	}
/*----------------------------Comentarios--------------------------------*/
function agregarcom(idtarea,idusuario)
	{
		textcome=$("#textcome").val();
		if (textcome=="")
			{
				aparecermensajedeerror("errorcomen","<p>No se ha ingresado ninguna nota</p>");
				$("#textcome").attr("onkeyup","desaparecermensajedeerror('errorcomen')");
			}
		else
		{
				textcome=encodeURIComponent(textcome);																			direcc="scriptsphp/agregarcomen.php?Comentario="+textcome+"&Tarea="+idtarea+"&Usuarioagre="+idusuario;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							$("#textcomenc").html('<textarea id="textcome" placeholder="Ingresa el texto del comentario"></textarea>');
							$("#textcomenc").enhanceWithin();
							obtenercantcom(idtarea,idusuario,true);
							obtenercom(idtarea,idusuario,true);
						}
				}
			);
		}
	}
	var cantactcom=0;
	function obtenercantcom(idtarea,idusuario,det)
	{
		if (tareaasel!=0)
		{
			direcc="scriptsphp/obtenercantcoment.php?Tarea="+idtarea+"&Usuarioagre="+idusuario;
			$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:direcc,
					success: function(data)
						{
							if (cantactcom!=data)
							{
								cantactcom=data;
								$("#canttcome").slideUp();
								$("#canttcome").html(data);
								$("#canttcome").slideDown();
							}
							
							if (!det)
							{
							 setTimeout("obtenercantcom("+idtarea+","+idusuario+",false)","1000");
							}
						}
				}
			);
		}
		
	}
	function obtenercom(idtarea,idusuario,det)
	{
		if (tareaasel!=0)
		{
			direcc="scriptsphp/obtenercoment.php?Tarea="+idtarea+"&Usuarioagre="+idusuario;
			$.ajax(
					{
						async:true,
						type:"GET",
						cache:false,
						url:direcc,
						success: function(data)
							{
								$("#listacoment").html(data);
								$("#listacoment").enhanceWithin();
								if (!det)
								{
								 setTimeout("obtenercom("+idtarea+","+idusuario+",false)","1000");
								}
							}
					}
				);
		}
	}
/*----------------------------------------------------------------*/
</script>
<style type="text/css">
</style></head>
<? 
	//Obtiene todas las materias a las que esta 'inscripto' el usuario
	//Es decir aquellas que esta cursando
	$aa="select * from suscmaterias where idusuario=$idusuario ORDER BY Nombremateria ASC";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	$materias1="";
	 while ($mref=mysqli_fetch_array($bb)) {
					  //De cada materia a la que esta suscrito el usuario se obtiene 
					  //la abreviacion correspondiente al nombre de la misma
					  $idmateria=$mref['idmateria'];
					 	 $ae="select * from materias where idmateria=$idmateria";	
						$ea=mysqli_query($con,$ae) or die ("error buscando ".$ae);
						$mrem=mysqli_fetch_array($ea);
						$Abrevmateria=$mrem['Abrevmateria'];
                  
                  	$materias1.='<option value="'.$idmateria.'">'.$Abrevmateria.'</option>';
	 }
	//Revistas y folletos
	/*
	$aa="select * from materias where Carrera=$Carrera AND Anio=$Anio ORDER BY Nombremateria Asc";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	*/
?>
<body>

<div data-role="page" id="paginai" data-fullscreen="true">
		<div data-role="panel" id="mypanel" data-position-fixed="true" data-display="push" data-theme="b">
        <div class="ui-grid-a" style="background-color:#12abf8; border-radius:30%">
          <div class="ui-block-a" style="vertical-align:middle" align="center"><h3><? echo $usuario;?></h3></div>
          <div class="ui-block-b" style="vertical-align:middle" align="right" ><img src="imagenes/Fotosperfil/<? echo $fp;?>" width="100%" alt=""/></div>
        </div>
<a href="#" data-role="button" data-icon="calendar-o" class="ui-btn-active">Mis tareas</a>
         <a href="misarchivos.php" data-role="button" data-icon="folder" data-ajax="false">Mis archivos</a>
         <div data-role="collapsible" data-collapsed-icon="gear" data-expanded-icon="gear" data-inset="true">
           <h3>Configuracion</h3>
            <a href="modificacionmaterias.php" data-role="button" data-icon="list-alt" data-ajax="false">Materias</a>
            <a href="modificardetalles.php" data-role="button" data-icon="user" data-ajax="false">Datos de usuario</a>
        </div>
        <div data-role="collapsible" data-collapsed-icon="code" data-expanded-icon="code" data-inset="true">
           <h3>App</h3>
            <a href="#" data-role="button" data-icon="hand-o-left" onclick="obtenersug()">Sugerir</a>
             <a href="ayuda.php" data-role="button" data-icon="question-circle" data-ajax="false">Ayuda</a>
        </div>
        <a href="#" data-role="button" data-icon="power" onclick="cerrarses()">Cerrar sesion</a>
        
		</div>
        <div data-role="header" data-position="fixed" data-theme="a">
        	<table width="100%" border="0" cellpadding="3">
          <tr>
            <td align="left" width="33%"><a href="#mypanel" data-role="button" data-icon="bars" data-iconpos="notext">Panel</a> </td>
            <td align="center" width="33%"><a href="#dialogootarea" data-role="button" data-icon="plus" data-rel="dialog" data-iconpos="notext">Agregar tarea</a> </td>
             <td align="right" width="33%"><div style="width:auto; height:auto"><a href="" id="botmost" onclick="consultarnotificaciones()" data-role="button" data-icon="stack-exchange" style="position:relative; z-index:0" data-iconpos="notext">Notificaciones</a><span id="caantnot"></span></div></td>
          </tr> 
        </table>
    	</div>
        
        <div data-role="content">
        <div class="g6" id="calendarioac">
				
			</div>
            <div data-role="tabs" id="tabs">
              <div data-role="navbar">
                <ul>
                  <li><a href="#contenidolib" data-ajax="false" onclick="defcom('Personales');obtenertareas();obtenereventos();" data-theme="a" class="ui-btn-active">Personales</a></li>
                  <li><a href="#boxshtare" data-ajax="false" onclick="defcom('Compartidas');obtenertareas();obtenereventos();" data-theme="a">Compartidas</a></li>
                </ul>	
              </div>
            <div id="contenidolib"></div>
            <div id="boxshtare"></div>
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
    <div data-role="popup" id="siguiendt" data-position="fixed">
        <div data-role="header" data-theme="a">
        <h2 id="tituloseguir">Siguiendo</h2>
    	</div>
        <div data-role="content" data-theme="a">
        	<p>Ahora estas siguiendo la tarea y puedes verla en la seccion de tareas personales</p>
    	</div>
    </div>
    <div data-role="popup" id="nosiguiendt" data-position="fixed">
        <div data-role="header" data-theme="a">
        <h2 id="titulonoseguir">Dejar de seguir</h2>
    	</div>
        <div data-role="content" data-theme="a">
        	<p>¿Esta seguro de que desea dejar de seguir esta tarea?</p>
             <a data-role="button" data-icon="check" data-theme="a" onclick="" id="sisegtar">Si</a>
        <a data-role="button" data-icon="delete" data-theme="a" onclick="$('#nosiguiendt').popup('close');">No</a>
    	</div>
    </div>
         <div data-role="popup" id="popupBasic" data-overlay-theme="a">
        <div data-role="header">
        <a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="guiadeinicio()">Close</a>
                 <h3>Bienvenido!!</h3>
            </div>
  		<p>Hola <? echo $Nombre;?> bienvenido/a a la agenda utniana. Espero que esta aplicacion te ayude en la organizacion de tus tareas y asi aprovechar al maximo todos los conocimientos transimitidos durante la carrera que estes cursando. </p>
        <p>Que la disfrutes</p>	
        
        <p style="text-align:right">Augusto Romero</p>
	</div>
    <div data-role="popup" id="guiadeinicio" data-overlay-theme="a">
        <div data-role="header">
        <a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="$( '#guiadeinicio' ).popup( 'close' )">Close</a>
                 <h3>Guia rapida</h3>
            </div>
  			<table width="100%" align="center">
                  <tr>
                    <td><img src="imagenes/wp_ss_20150319_0001.png" width="25" height="25" alt="conff" /></td>
                    <td>Datos de cuenta y sugerencias para el desarrollador</td>
                  </tr>
                   <tr>
                    <td><img src="imagenes/agregar.png" width="40" height="25" alt="conff" /></td>
                    <td>Insercion de nuevas tareas</td>
                  </tr>
                   <tr>
                    <td><img src="imagenes/sliders.png" width="35" height="35" alt="conff" /></td>
                    <td>Marcar actividad como realizada</td>
                  </tr>
                   <tr>
                    <td><img src="imagenes/detallestarea.png" width="60" height="30" alt="conff" /></td>
                    <td>Ver todos los detalles de la tarea</td>
                  </tr>
                </table>

	</div>
    
    <div data-role="popup" id="notificacion" data-overlay-theme="a">
        
	</div>
    <div data-role="popup" id="notificacion2" data-overlay-theme="a">
     <div data-role="header">
				<a href="#" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right" onclick="cerrarnotificaciones()">Close</a>
              <h3 id="titulonot">Notificaciones</h3>
          </div>
          <span id="textonotif"><p>No hay notificaciones que mostrar</p></span>
	</div>
    
    	</div>
        <div data-role="footer" data-position="fixed" data-theme="a">
        <div class="ui-grid-a">
                    <div class="ui-block-a" style="text-align:center"> 
                         <select name="Rango" data-native-menu="false" onchange="obtenertareas();obtenereventos()"> 
                          <option value="Todas">Todas</option>
                          <? echo $materias1;?>
                        </select>
                	</div>
                    <div class="ui-block-b" style="text-align:center">
                    	<select name="Criterio" onchange="obtenertareas();obtenereventos()" data-native-menu="false"> 
                        <option value="Todos">Todos</option>
                       	 <option value="PC">Parciales</option>
                          <option value="FL">Finales</option>
                          <option value="RE">Recuper.</option>
                          <option value="TP">Trabajos</option>
                        </select>
                    </div>
                </div>
    	</div>
    </div>
    <div data-role="page" id="dialogootarea" class="ui-dialog">
      <div data-role="header">
        <h1>Agregar detalles de tarea</h1>
      </div>
      <div data-role="content">
      		 <div data-role="popup" id="mensajeokagt" data-position="fixed">
                <div data-role="header" data-theme="a">
                <h2 id="titulookn">Nueva ubicacion</h2>
                </div>
                <div data-role="content" data-theme="a">
                     <span id="mensajeokn">
                     </span>
                </div>
            </div>
      <? 
	  $aa="select * from suscmaterias where idusuario=$idusuario ORDER BY Nombremateria ASC";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
	  ?>
        <label>Nombre<input type="text" name="nombre" id="nombre" /></label>
        <span id="errornombre"></span>
        <label>Materia<select name="materia" data-native-menu="false" onchange="obtenertareas();"> 
                  <? while ($mref=mysqli_fetch_array($bb)) {
					  $idmateria=$mref['idmateria'];
					 	 $ae="select * from materias where idmateria=$idmateria";	
						$ea=mysqli_query($con,$ae) or die ("error buscando ".$ae);
						$mrem=mysqli_fetch_array($ea);
						$Abrevmateria=$mrem['Abrevmateria'];
					  ?>
                  	<option value="<? echo $idmateria;?>"><? echo $Abrevmateria;?></option>
                  <? }?>
          		</select></label>
          <span id="errormateria"></span>
         <label>Tipo<select name="tipota" data-native-menu="false"> 
                  <option value="TP">Trabajo Practico</option>
                  <option value="OP">Trab. Prac. opcional</option>
                  <option value="PC">Parcial</option>
                  <option value="FL">Final</option>
                  <option value="RE">Recuperatorio</option>
          		</select></label>
         <span id="errortipo"></span>
        <label><span id="detalless">Detalles</span><textarea name="detalles" id="detalles" style="position: relative; z-index: 100000;"></textarea></label>
        <span id="errordetalles"></span>
        <span id="fechas">Fecha de entrega</span>
        <fieldset data-role="controlgroup">
        <label><input name="tipofecha" id="tipofecha" type="radio" value="esp" onchange="mostrarinpfecha(this.value)"/>Fecha especifica</label>
         <label><input name="tipofecha" id="tipofecha" type="radio" value="vari" onchange="mostrarinpfecha(this.value)"/>Rango de tiempo</label>
        </fieldset>
        <span id="fecha1" style="display:none">
        <input type="text" class="date-input-css" id="fecha" name="fecha" style="position: relative; z-index: 100000;">
        <span id="errorfechaunica"></span>
        <label for="slider-fill">Hora:</label>
<input type="range" name="slider-fill" id="horant" value="12" min="0" max="23" data-highlight="true" />
		<span id="errorhorafu"></span>
		<label for="slider-fill">Minuto:</label>
<input type="range" name="slider-fill" id="minutont" value="30" min="0" max="59" data-highlight="true" />
		<span id="errorminutofu"></span>
        </span>
        <span id="fecha2" style="display:none">
        <label>Fecha inicio<input type="text" class="date-input-css" id="fechaini" name="fechaini" style="position: relative; z-index: 100000;"></label>
        <span id="errorfechainicio"></span>
        <label>Fecha fin<input type="text" class="date-input-css" id="fechafin" name="fechafin" style="position: relative; z-index: 100000;"></label>
        <span id="errorfechafin"></span>
        </span>
        <span id="errorfechageneral"></span>
        <input name="agregar" id="agregar" type="button" value="Agregar tarea"/>
      </div>
    </div>
    <div data-role="page" id="dialogoconfig">
    <div data-role="header">
        <h1>Detalles de cuenta</h1>
      </div>
      <span id="datosconff"></span>
    </div>
    <div data-role="page" id="dialogotarea" class="ui-dialog">
      <div data-role="header">
        <h1>Detalles de tarea</h1>
      </div>
      <div data-role="content" id="detailstarea">
      </div>
      <div data-role="popup" id="agregenlace" data-overlay-theme="a">
     <div data-role="header">
              <h3>Agregar link</h3>
          </div>
         <table width="100%" border="0">
          <tr>
            <td>Nombre</td>
            <td><input name="nombreurl" id="nombreurl" type="text" /><span id="errornombreurl"></span></td>
          </tr>
          <tr>
            <td>URL</td>
            <td><input name="urld" id="urld" type="text" /><span id="errorurld"></span></td>
          </tr>
          <tr>
            <td>Notas</td>
            <td><textarea name="notasurl" id="notasurl"></textarea><span id="errornotasurl"></span></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><a data-role="button" id="botagreglink" data-icon="plus">Agregar</a></td>
          </tr>
        </table>
	</div>
    
    <div data-role="popup" id="agregarchivoo" data-overlay-theme="a">
     <div data-role="header">
              <h3>Agregar archivo</h3>
          </div>
         <input name="nombreurl" id="nombrefilee" type="search" placeholder="Buscar archivo" onkeyup="buscararchivo(this.value)"/><span id="errornombreurl">
         <div id="listaarchivos">
         </div>
         <div data-role="footer" id="pieagarchivo">
              <p style="align-content:center"><a data-role="button" id="botagreglink" data-icon="plus">Agregar archivo</a>
          </div>
	</div>
    
    </div>
   <div data-role="page" id="confirmar">
        <div data-role="header">
          <h1>Confirmacion</h1>
        </div>
        <div data-role="content">
        <span id="confirmadores">
        <p>¿Estás completamente seguro que deseas eliminar esta tarea?</p>
        <a data-role="button" data-icon="check" data-theme="b" data-inline="true" href="#" id="confirmado">Si</a>
        <a data-role="button" data-icon="delete" data-theme="b" data-inline="true" href="#" onclick='$( "#confirmar" ).dialog( "close" );'>No</a>
        </span>
        <span id="mensajeeliminado"></span>
        </div>
      </div> 
   </div>
    
</body>
<!-- plugin has dependency of moment.js to show dates -->
<script src="js/moment.js" type="text/javascript"></script>
<!--
	development version
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
-->
<!--
	minify version
-->
	<script src="js/jquery.eventCalendar.js" type="text/javascript"></script>
</html>
