<?php
require_once("PeliculaController.php");
require_once("PeliculaModel.php");

	//Instanciar Controlador
	$Controlador = New PeliculaController();
	
	$Datos = $Controlador->ListarPeliculas();

	//Vista json
	header('Content-Type: application/json');
	return $Datos;
	//

?>