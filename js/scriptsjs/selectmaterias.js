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
		obtenercomisiones();
    });
	function obtenercomisiones()
	{
		//Esta funcion es llamada en la primera carga de un dia para informar 
		//de todas las tareas que deberan ser entregadas el dia posterio
		Carrera=<? echo $Carrera;?>;
		
		/*
		Carrera=
		Anio=
		Comision*/
		$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/obtenercomsisiones.php?Carrera="+Carrera,
					success: function(data)
						{
							$("#comisiones").html(data);
							$("#comisiones").enhanceWithin();
						}
				}
			);
			
	}
	function mostrarmaterias()
	{
		$("#materias").html('');
		var selectt=$("#listacomisiones").val();
		var cantidad=selectt.length;
		//Si no hay ninguna comision seleccionada no muestra el boton de insercion de materias 
		if (cantidad==0)
		{
			$("#agregmat").slideUp();
		}
		else
		{
			$("#agregmat").slideDown();
		}
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
					url:"scriptsphp/obtenermaterias.php?Comision="+Comision+"&Usuario="+Usuario+"&NumCom="+num,
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
	function agregarmaterias()
	{
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
			for (x=0;x<cantidadcom;x++)
			{
				selectmatt=$("#listamaterias"+x).val();
				cantidadmat=selectmatt.length;
				for (y=0;y<cantidadmat;y++)
				{
					agregandomaterias(selecttcom[x],selectmatt[y]);
				}	
			}
			$("#mensajeok").html("Las materias han sido agregadas con exito a tu lista de materias cursadas.Espera unos segundos mientras tu cuenta es configurada");
			$("#mensajeok").css("display","block");
			$("#contenidoseleccion").css("display","none");
			$("#ajaxloader").css("display","block");
			setTimeout("redireccionar()","10000");
		}	
	}
	function agregandomaterias(comision,materia)
	{
		Usuario=<? echo $idusuario;?>;
	$.ajax(
				{
					async:true,
					type:"GET",
					cache:false,
					url:"scriptsphp/agregarmaterias.php?Comision="+comision+"&Usuario="+Usuario+"&Materia="+materia
				}
			);
	}