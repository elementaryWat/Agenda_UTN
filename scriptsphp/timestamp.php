<?
	$a = strtotime("2015-03-26 08:06:11");
	$a2 = strtotime("2015-03-26 21:05:05");
	
	$segundos = ($a2 - $a);
	$horas = floor($segundos/3600);
	echo $horas;
	?>
