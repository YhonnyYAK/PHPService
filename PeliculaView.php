<?php
require_once("PeliculaController.php");
require_once("PeliculaModel.php");

	/*Instanciar Controlador*/
	$Controlador = New PeliculaController();
	
	$Datos = $Controlador->ListarPeliculasJSON();

	/*Permiso de Acceso*/
	header("Access-Control-Allow-Origin: *");
	
	/*Vista json*/
	//header('Content-Type: application/json');
	//print $Datos;
	
	
	$Datos2 = $Controlador->ListarPeliculasXML();
	
	/*Vista XML*/
	header('Content-Type: application/xml; charset=utf-8');
	print $Datos2;

?>