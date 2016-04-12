<?
session_start();
$Carrera=$_GET['Carrera'];
$Usuario=$_GET['Usuario'];
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
$ab="select * from catutoriales ORDER BY Nomcategoria DESC";	
$ba=mysqli_query($con,$ab) or die ("error buscando ".$ab);
$cadenatut="";
//Variable que contendra cada uno de los options del select de comisiones
$cadenatut.='<div data-role="collapsibleset">';
$contcat=0;
while ($mref=mysqli_fetch_array($ba))
{
	$contcat++;
	$idcategoria=$mref['idcategoria'];
	$Nomcategoria=$mref['Nomcategoria'];
	$af="select * from tutoriales where Categoria=$idcategoria ORDER BY Nombre ASC";	
	$fa=mysqli_query($con,$af) or die ("error buscando ".$af);
	$canttut=mysqli_num_rows($fa);
	if ($canttut!=0)
	{
		if ($contcat==1)
		{
			$colapsible='data-collapsed="false"';
		}
		else
		{
			$colapsible='data-collapsed="true"';
		}
		$cadenatut.='<div data-role="collapsible" data-theme="a" '.$colapsible.'>'
						.'<h1>'.$Nomcategoria.'</h1>';
				while ($mtut=mysqli_fetch_array($fa))
				{
					$idtutorial=$mtut['idtutorial'];
					$Nombre=$mtut['Nombre'];
					$Texto=$mtut['Texto'];
					$cadenatut.='<div><a onclick="mostrartutorial('.$idtutorial.')" id="mostrtut'.$idtutorial.'">'.$Nombre.'</a>';
					$cadenatut.='<span id="tutorial'.$idtutorial.'" style="display:none;width:100%">'.$Texto.'</span></div>';
				}
		$cadenatut.='</div>';
		
	}
}
$cadenatut.='</div>';
echo $cadenatut;
?>


	