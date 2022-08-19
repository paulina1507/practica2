<?php
	// http/producto2/pmvc2.php?ancho=500&alto=500&n=1&x1=200&y1=0&x2=0&y2=400&x3=400&y3=200
	header("Content-type: image/png");
	require_once("Punto.php");
	require_once("Modelo.php");
	require_once("Vista.php");
	require_once("Controlador.php");
	$v = new Vista($_GET['ancho'], $_GET['alto'], $_GET['n']);
	$m = new Modelo(new Punto($_GET['x1'], $_GET['y1']), new Punto($_GET['x2'],$_GET['y2']), new Punto($_GET['x3'],$_GET['y3']));
	$c = new Controlador();
	$c->exhibir($m, $v);
?>