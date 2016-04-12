<? 
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
if(!isset($_COOKIE['tiposesutnd']))
{
	//En caso de que el tipo de sesion no este definido lo establece por defecto como tvemporal
	setcookie('tiposesutnd',"sesionUTNtempp", time() + 365 * 24 * 60 * 60); 
}
$_SESSION["dbservidor"]="mysql.hostinger.com.ar";
$_SESSION["dbnusuario"]="u376876484_agen2";
$_SESSION["dbpass"]="utniano2";
$_SESSION["dbnombre"]="u376876484_agen2";
$_SESSION["dbmensaje"]="no se ha podido encontrar la base de datos";
$tiposes=$_COOKIE['tiposesutnd'];
$fechahoy=date("Y-m-d");
$hora=date("G:i:s");
$fechahoy.=" ".$hora;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no" />
<title>Inicio de sesion</title>
<link rel="stylesheet" href="themes/temab/themes/utnianob.min.css" />
<link rel="stylesheet" href="themes/temab/themes/jquery.mobile.icons.min.css" />

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        var boton=$("input[name=boton]");
		boton.click(iniciar);
		var input1=$("input[name=user]");
		input1.change(ocultar);
		input1.keyup(ocultar);
		var input2=$("input[name=pass]");
		input2.change(ocultar);
		input2.keyup(ocultar);
    });
	function ocultar()
	{
		var mensaje=$("#mensaje");
		mensaje.css("display","none");
		mensaje.html("");
	}
	function redireccionar()
	{
		document.location="index.php";
	}
	function desaparecermensajedeerror(elemento)
	{
		$("#"+elemento).css("display","none");
	}
	function iniciar()
	{
		var mensaje=$("#mensaje");
		var usuario=$("input[name=user]").val();
		var pass=$("input[name=pass]").val();
		var tiposes=$("#tiposesion").is(":checked");
		if (tiposes)
		{
			tiposes="sesionUTNprol";
		}
		else
		{
			tiposes="sesionUTNtempp";
		}
		if (usuario=="" || pass=="")
		{
		mensaje.css("display","block");
		mensaje.css("color","#F00");
		mensaje.css("text-align","center");
			if (usuario=="" && pass=="")
			{
			mensaje.html("<p>No se ha ingresado ningun dato</p>");
			}else if (usuario=="")
			{
			mensaje.html("<p>No se ha ingresado el usuario</p>");	
			}else if (pass=="")
			{
			mensaje.html("<p>No se ha ingresado la contraseña</p>");
			}
		}
		else
		{
			$.ajax(
			{
				async:true,
				type:"GET",
				url:"iniciandolases.php?usuario="+usuario+"&pass="+pass+"&tiposesion="+tiposes,
				cache:false,
				success: function(data)
				{
					if (data=="ok")
					{
						mensaje.css("display","block");
						mensaje.html("<p>Los datos ingresados son correctos</p><p>Espere unos segundos y sera redireccionado</p>");
						mensaje.css("color","#26822B");
						mensaje.css("text-align","center");
						setTimeout("redireccionar()","5000");
					} else if (data=="no")
					{
						mensaje.css("display","block");
						mensaje.html("<p>Nombre de usuario o contraseña incorrectos</p>");
						mensaje.css("color","#F00");
						mensaje.css("text-align","center");
						}
					}
				}
			);
		}
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
	function contrasenasegura(pass)
	{
		/*
		Comprueba
		Contraseñas que contengan al menos una letra mayúscula.
		Contraseñas que contengan al menos una letra minúscula.
		Contraseñas que contengan al menos un número o caracter especial.
		Contraseñas cuya longitud sea como mínimo 8 caracteres.
		Contraseñas cuya longitud máxima no debe ser arbitrariamente limitada.
		*/
		segura=/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(pass);
		if (pass=="")
		{
			$("#errorpass").css("display","none");
		}
		else
		{
			if (segura)
			{
				$("#errorpass").html("<p>Contraseña segura</p>");
				$("#errorpass").css("display","block");
				$("#errorpass").css("color","#090");
			}
			else
			{
				$("#errorpass").html("<p>Contraseña no segura</p><p>Consejos:</p><p>8 caracteres de longitud</p><p>Incluir mayusculas y minusculas</p><p>Incluir numeros y/o caracteres especiales</p>");
				$("#errorpass").css("display","block");
				$("#errorpass").css("color","#F90");
			}
		}
	}
	function emailvalido(mail)
	{
		return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
	}
	var cantidaderr=0;
	function validarusuario()
	{
		cantidaderr=0;
		var username=$("#username").val();
		$.ajax(
			{
				async:true,
				type:"GET",
				url:"scriptsphp/consultarusuarionn.php?Nombre="+username,
				cache:false,
				success: function(datos)
				{
					if (datos==0)
					{
						aparecermensajedeerror("erroruser","<p>Este usuario ya existe</p>");
						$("#username").attr("onkeyup","desaparecermensajedeerror('erroruser')");
						cantidaderr++;
					}
					validarcorreo();
				}
			}
		);
	}
	function validarcorreo()
	{
		var email=$("#email").val();
		$.ajax(
			{
				async:true,
				type:"GET",
				url:"scriptsphp/consultaemailnn.php?Email="+email,
				cache:false,
				success: function(datos)
				{
					if (datos==0)
					{
						aparecermensajedeerror("erroremail","<p>Ya existe un usuario con este email</p>");
						$("#email").attr("onkeyup","desaparecermensajedeerror('erroremail')");
						cantidaderr++;
					}
					verificarcamposestaticos();
				}
			}
		);
	}
	function verificarcamposestaticos()
	{
		var username=$("#username").val();
		var pass=$("#passs").val();
		var reppass=$("#reppass").val();
		var email=$("#email").val();
		var name=$("#name").val();
		var surname=$("#surname").val();
		var carrera=$("#carrera").val();
		var anio;
		var comision;
		if ((pass != reppass) || pass=="" || username=="" || reppass=="" || name==""  || surname=="" || email=="" || !emailvalido(email) || carrera=="Seleccionar carrera")
		{
			if (carrera=="Seleccionar carrera")
			{
					aparecermensajedeerror("errorcarrera","<p>No se ha seleccionado la carrera</p>");
			}
			if (pass=="" || reppass=="")
			{
				if (pass=="")
				{
					aparecermensajedeerror("errorpass","<p>No se ha ingresado la contraseña</p>");
				}
				if (reppass=="")
				{
					aparecermensajedeerror("errorpasswords","<p>Debe volver a ingresar la contraseña</p>");
					$("#reppass").attr("onkeyup","desaparecermensajedeerror('errorpasswords')");
				}
			}else 
			{
				if (pass != reppass)
				{
					aparecermensajedeerror("errorpasswords","<p>Las contraseñas no coinciden</p>");
					$("#reppass").attr("onkeyup","desaparecermensajedeerror('errorpasswords')");
				}
			}
			if (username=="")
			{
				aparecermensajedeerror("erroruser","<p>Debe ingresar su nombre de usuario</p>");
				$("#username").attr("onkeyup","desaparecermensajedeerror('erroruser')");
			}
			if (!emailvalido(email))
			{
				aparecermensajedeerror("erroremail","<p>Email invalido</p>");
				$("#email").attr("onkeyup","desaparecermensajedeerror('erroremail')");
			}
			if (email=="")
			{
				aparecermensajedeerror("erroremail","<p>Debe ingresar su email</p>");
				$("#email").attr("onkeyup","desaparecermensajedeerror('erroremail')");
			}
			if (name=="")
			{
				aparecermensajedeerror("errornombre","<p>No ha ingresado su nombre</p>");
				$("#name").attr("onkeyup","desaparecermensajedeerror('errornombre')");
			}
			if (surname=="")
			{
				aparecermensajedeerror("errorapellido","<p>No ha ingresado su apellido</p>");
				$("#surname").attr("onkeyup","desaparecermensajedeerror('errorapellido')");
			}
			cantidaderr++;
		}
		agregarusuario();
	}
	function obteneremail()
	{
		$.ajax(
			{
				async:true,
				type:"GET",
				url:"scriptsphp/solicemail.php",
				cache:false,
				success: function(data)
					{
						$("#textoemail").html(data);
						$("#textoemail").enhanceWithin();
						 $("#emaill").popup('open');
					}
				}
			);
	}
	function enviardatos()
	{
		var mensaje=$("#mensajerespem");
		var Email=$("#Emailsol").val();
		$.ajax(
			{
				async:true,
				type:"GET",
				url:"scriptsphp/enviandoemail.php?Email="+Email,
				cache:false,
				success: function(data)
					{
						if (data==1)
						{
							mensaje.css("display","block");
							mensaje.html("<p>Los datos de tu cuenta han sido enviados a tu correo de forma exitosa</p><p>El mensaje sera agregado a su bandeja de entrada en unos instantes</p>");
							mensaje.css("color","#090");
							mensaje.css("text-align","center");
						} else if (data==0)
						{
							mensaje.css("display","block");
							mensaje.html("<p>No existe este correo en la base de datos.</p><p>Revise la ortografia y si el bloqueador de mayusculas no esta activado</p>");
							mensaje.css("color","#F00");
							mensaje.css("text-align","center");
						}
					}
				}
			);
	}
	function agregarusuario()
	{
		var mensaje=$("#errorgeneral");
		var username=$("#username").val();
		var pass=$("#passs").val();
		var reppass=$("#reppass").val();
		var email=$("#email").val();
		var name=$("#name").val();
		var surname=$("#surname").val();
		var carrera=$("#carrera").val();
		if (cantidaderr>0)
		{
			aparecermensajedeerror("errorgeneral","<p>Corrija los errores para poder continuar</p>");
		}
		else
		{
			var direccion="scriptsphp/registrarusuario.php?Usuario="+username+"&Pass="+pass+"&Nombre="+name+"&Apellido="+surname+"&Email="+email+"&Carrera="+carrera;
			direccion=encodeURI(direccion);
			$.ajax(
			{
				async:true,
				type:"GET",
				url:direccion,
				cache:false,
				error: function()
				{
					alert("error");
				},
				success: function(data)
				{
					if (data==1)
					{
						mensaje.css("display","block");
						mensaje.html("<p>Has sido registrado con exito</p>");
						mensaje.css("color","#26822B");
						mensaje.css("text-align","center");
						setTimeout("redireccionar()","3000");
					}
				}
			}
		);
		}
}
/*
function obteneraniosycom(carrera)
{
	cajadestinoan=$("#aniosycoms");
	$.ajax(
			{
				async:true,
				type:"GET",
				url:"scriptsphp/obteneraniosycom.php?Carrera="+carrera,
				cache:false,
				error: function(data)
				{
					alert("Error al obtener anios y comisiones");
				},
				success: function(data)
				{
					cajadestinoan.html(data);
					cajadestinoan.enhanceWithin();
				}
			}
		);
}
*/
</script>
</head>

<body>
<? 

$con=mysqli_connect("mysql.hostinger.com.ar","u376876484_agen2","utniano2");
mysqli_select_db($con,"u376876484_agen2") or die ("no se ha podido encontrar la base de datos");
	//Materias
	$aa="select * from carrera ORDER BY Nombrecarrera";	
	$bb=mysqli_query($con,$aa) or die ("error buscando ".$aa);
?>
<div data-role="page" id="page" data-theme="b">
  <div data-role="header" data-theme="b" data-position="fixed">
    <h1>Inicio de sesion</h1>
  </div>
  <div data-role="content" data-theme="b" data-position="fixed">
  <h2>Ingrese sus credenciales</h2>
    <label>Nombre de usuario<input name="user" type="text" /></label>
  <label>Contraseña<input name="pass" type="password" /></label>
  <span id="mensaje" style="display:none"></span>
  <? 
  if ($tiposes=="sesionUTNtempp")
  {
 ?>
  <label>Mantener sesion iniciada<input name="tiposesion" id="tiposesion" type="checkbox" data-theme="a"/></label>
  <? 
  }
  else if ($tiposes=="sesionUTNprol")
  {
 ?>
  <label>Mantener sesion iniciada<input name="tiposesion" id="tiposesion" type="checkbox" checked="checked" data-theme="a"/></label>
 <? 
  }
 ?>
  <input name="boton" type="button" value="Ingresar"/>
  
  <a href="#pageregistro" data-role="button" data-transition="slidedown">Crea tu cuenta</a></p>
  <a data-role="button" onclick="obteneremail()">¿Olvidaste tu contraseña?</a></p>
  <a href="#descripcionapp" data-role="button" data-transition="slidedown">Descripcion de la app</a></p>
  </div>
   <div data-role="popup" id="emaill" data-overlay-theme="a">
         <div data-role="header">
              <h3 id="tituloemaill">Tu email?</h3>
          </div>
          <span id="textoemail"></span>
	</div>
</div>
<div data-role="page" id="pageregistro" data-theme="b">
  <div data-role="header" data-theme="b" data-position="fixed">
    <h1>Registro de usuario</h1>
  </div>
  <div data-role="content" data-theme="b" data-position="fixed">
  <h2>Ingrese los datos de su nueva cuenta</h2>
    <label>Nombre de usuario<input name="username" id="username" type="text" maxlength="50"/></label>
    <span id="erroruser" style="display:none"></span>
  <label>Contraseña<input name="passs" type="password"  id="passs" onkeyup="contrasenasegura(this.value)" maxlength="50"/></label>
   <span id="errorpass" style="display:none"></span>
   <label>Repetir contraseña<input name="reppass" type="password" id="reppass" maxlength="50"/></label>
   <span id="errorpasswords" style="display:none"></span>
   <label>Correo electronico<input name="email" type="text" id="email" maxlength="50"/></label>
   <span id="erroremail" style="display:none"></span>
   <label>Nombre<input name="name" type="text" id="name" maxlength="50"/></label>
   <span id="errornombre" style="display:none"></span>
   <label>Apellido<input name="surname" type="text" id="surname" maxlength="50"/></label>
  <span id="errorapellido" style="display:none"></span>
  <label>Carrera<select name="carrera" id="carrera" data-native-menu="false"> 
  					<option data-placeholder="true">Seleccionar carrera</option>
                  <? while ($mref=mysqli_fetch_array($bb)) {?>
                  	<option value="<? echo $mref['idcarrera'];?>"><? echo $mref['Nombrecarrera'];?></option>
                  <? }?>
          		</select></label>
       <span id="aniosycoms"><span id="errorcarrera" style="display:none"></span></span>
  <input name="boton2" type="button" value="Registrarme" onclick="validarusuario()" data-theme="a"/>
  <span id="errorgeneral" style="display:none"></span>
  </div>
</div>
<div data-role="page" id="descripcionapp" data-fullscreen="true" data-theme="b">
        <div data-role="header" data-position="fixed">
        <h2>Descripcion</h2>
    	</div>
            <div style="margin-right:1%; margin-left:1%">
            <p style="text-align: justify;">Esta aplicacion tiene como objetivo la organizacion de nuestras actividades
durante el cursado de la carrera que estemos cursando en la FRRE. Una vez que
estemos registrados y hayamos seleccionado las materias de cursado podremos
ir agregando los diferentes trabajos, parciales o recuperatorios a la lista 
de tareas y la aplicacion se encargara de organizarlos segun su fecha limite.
Ahora bien parte del objetivo de la app también es facilitar esta organizacion de forma 
colaborativa.Es decir, que aquellos alumnos que esten cursando materias comunes 
con nosotros en la misma comision podran ver las tareas que hayamos agregado. De esta forma
cada uno podra aportar detalles adicionales en caso de que sea necesario o agregar
recursos como por ejemplo enlaces. Espero que puedas sacarle el maximo provecho
a esta herramienta y que te ayude a cumplir tus objetivos.</p>
            </div>
        <div data-role="content" >
        <div id="contenidotutoriales">
      	
        </div>
   	  </div>
    </div>
</body>
</html>
