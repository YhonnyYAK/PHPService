<?php

require_once("Database.php");
require_once("PeliculaModel.php");

Public Class PeliculaController{
	
	public function ListarPeliculas(){
		
		$db = ConnectDB();
		$Peliculas = array();
		
		$Consulta = "SELECT * FROM Peliculas";
		
		$Respuesta = $db->query($Consulta);
		
		$Respuesta->execute();
		
		while ($filas = $Respuesta->fetch(PDO::FETCH_ASSOC)){
			
			$Pelicula = new PeliculaModel();
			$Pelicula->id = $filas["Id"];
			$Pelicula->nombre = $filas["nombre"];
			$Pelicula->director = $filas["director"];
			$Pelicula->fecha = $filas["fecha"];
			
			$Peliculas [] = $Pelicula;
		}

		return json_encode($Peliculas);
		
	}
	
	public function NombreFuncion(){
		
		//
		
	}
	
}

?>
