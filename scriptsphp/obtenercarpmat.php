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
	$Cadenacom=$_GET['Comision'];
	//Muestra todas las comisiones en la que esta cursando el usuario sus materias
	$Anio=substr($Cadenacom,0,1);
	$Comision=substr($Cadenacom,2,1);
	$tamCadcom=strlen($Cadenacom);
	$Abrevcarrera=substr($Cadenacom,4,$tamCadcom-4);
	switch($Comision)
	{
	case "A":
		$Comisioncur=1;
		break;
	case "B":
		$Comisioncur=2;
		break;
	case "C":
		$Comisioncur=3;
		break;
	case "D":
		$Comisioncur=4;
		break;
	case "E":
		$Comisioncur=5;
		 break;
	case "F":
		$Comisioncur=6;
		 break;
	}
	
	$ab="select * from carrera where Abrevcarrera='$Abrevcarrera'";	
	$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
	$mref=mysqli_fetch_array($ba);
	$idcarrera=$mref['idcarrera'];

	$af="select * from materias where Carrera=$idcarrera AND Anio=$Anio";	
	$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
	$cadenamat="";
	while ($mmat=mysqli_fetch_array($fa))
	{
		$idmateria=$mmat['idmateria'];
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
	$af="select * from suscmaterias where ($cadenamat) AND comisioncursado=$Comisioncur AND idusuario=$Usuario ORDER BY Nombremateria ASC";	
	$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
	$listamat='<ul data-role="listview" data-inset="true">';
	$listamat.='<li onclick="obtenercarpcom()"><a href="#" id="carpeta'.$ubicacraiz.'"><img src="../imagenes/iconosprogramas/carpeta.png"/><h1>..</h1></a></li>';
	//En caso afirmativo muestra estas materias dentro de un div inicialmente oculto con un header del nombre de la comision en la que esta cursando estas materias
	while ($msusc=mysqli_fetch_array($fa))
	{
		$idmateria=$msusc['idmateria'];
		//Comprueba si hay archivos compartidos de la materia y comision actual 
		$ac="select * from filescomp where idmateria=$idmateria AND Comision=$Comisioncur";	
		$ca=mysqli_query($con,$ac) or die ("error buscando ".$ac);
		$cantshfiles=mysqli_num_rows($ca);
		
		$Nombremat=$msusc['Nombremateria'];
		$cadenamatcom=$Comisioncur." ".$idmateria;
		//Le pasa nuevamente como argumento la cadena de la comision para poder volver al raiz
		$listamat.='<li onclick="obteneropcionescomp(\'MATERIA\',\''.$cadenamatcom.'\',\''.$Cadenacom.'\')">';
		$listamat.='<a href="#"><img src="../imagenes/iconosprogramas/carpeta.png"/>';	
		$listamat.='<h1>'.$Nombremat.'</h1>';
		$listamat.='<span class="ui-li-count">'.$cantshfiles.'</span>';
		$listamat.='</a></li>';
	}				
	$listamat.='</ul>';
echo $listamat;
?>


	