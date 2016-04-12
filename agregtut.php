
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=no"/>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/git/jquery.mobile-git.css" /> 
<title>Agenda UTN</title>
<link rel="stylesheet"  href="http://code.jquery.com/mobile/git/jquery.mobile-git.css" /> 
	<link rel="stylesheet" href="jquery.mobile.datepicker.css" />
	<link rel="stylesheet" href="jquery.mobile.datepicker.theme.css" />
    <link rel="stylesheet" href="themes/utniano.min.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="external/jquery-ui/datepicker.js"></script>
	<script src="jquery.mobile.datepicker.js"></script>
    <script language="javascript" type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"> </script>
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
     <script type="text/javascript">
		//TinyMCE Mision
        tinymce.init({
            selector: "textarea#mision",
            theme: "modern",
            language : 'es',
            content_css: "css/content.css",
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ]
         });
        </script>
    
    <script type="text/javascript">
	$(document).ready(function(e) {
       
    });
    </script>
    <style type="text/css">
	#dialogocarisma
	{
		display:none;
	}
	#dialogoubicaciones
	{
		display:none;
	}
	#dialogoreflexion
	{
		display:none;
	}
	#dialogomaterial
	{
		display:none;
	}
	.prueba
	{
		color:#0F6;
	}
	#listareflexxioness li:nth-child(odd)
	{
		background-color:#333;
		color:#CCC;
		font-style:italic;
	}
	#listareflexxioness li:nth-child(even)
	{
		background-color:#CCC;
		color:#333;
		font-style:italic;
	}
	</style>
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
	<!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        	<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page2">
	<textarea id="mision" name="mision"></textarea>
</body>
</html>
