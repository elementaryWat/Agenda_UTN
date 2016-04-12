<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
 <?  
 	$boton=$_REQUEST['agregarchivo'];
 	if ($boton=="Ver nombre tipo")
		{
			echo "<p>Hola</p>";
			echo "<p>El tipo es ".$_FILES['archivodestin']['type']."<</p>";
			echo $Men;
		}
		?>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	<input name="archivodestin" id="archivodestin" type="file" />
                <input name="agregarchivo" type="submit" value="Ver nombre tipo"/>
        </form>
</body>
</html>
