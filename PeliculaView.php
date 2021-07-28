<?php
require_once("PeliculaController.php");
require_once("PeliculaModel.php");

	/*Instanciar Controlador*/
	$Controlador = New PeliculaController();
	
	$DatosJSON = $Controlador->ListarPeliculasJSON();
	$DatosXML = $Controlador->ListarPeliculasXML();

	/*Permiso de Acceso*/
	header("Access-Control-Allow-Origin: *");
	
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET' :

			/*Vista json*/
			header('Content-Type: application/json');
			print $DatosJSON;

			/*Vista XML*/
			//header('Content-Type: application/xml; charset=utf-8');
			//print $DatosXML;

			break;

		case 'POST' :

			/*Recuperar trama Json/Xml*/
			$Trama = file_get_contents('php://input');

			/*Vista json*/
			$Respuesta = $Controlador->GrabarPeliculaJSON($Trama);
			header('Content-Type: application/json');
			print $Respuesta;

			/*Vista XML*/
			//$Respuesta = $Controlador->GrabarPeliculaXML($Trama);
			//header('Content-Type: application/xml; charset=utf-8');
			//print $Respuesta;

			break;

	}

?>