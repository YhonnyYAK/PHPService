<?php

require_once("Database.php");
require_once("PeliculaModel.php");

Class PeliculaController{
	
	public function ListarPeliculasJSON(){
		
		$db = ConnectDB();
		$Peliculas = array();
		
		$Consulta = "SELECT * FROM Peliculas";
		
		$Respuesta = $db->query($Consulta);
		
		$Respuesta->execute();
		
		while ($filas = $Respuesta->fetch(PDO::FETCH_ASSOC)){
			
			$Pelicula = new PeliculaModel();
			$Pelicula->id = $filas["id"];
			$Pelicula->nombre = $filas["nombre"];
			$Pelicula->director = $filas["director"];
			$Pelicula->fecha = $filas["fecha"];
			
			$Peliculas [] = $Pelicula;
		}

		return json_encode($Peliculas);
		
	}
	
	public function ListarPeliculasXML(){
		
		$db = ConnectDB();
		$Peliculas = array();
		
		$Consulta = "SELECT * FROM Peliculas";
		
		$Respuesta = $db->query($Consulta);
		
		$Respuesta->execute();
		
		while ($filas = $Respuesta->fetch(PDO::FETCH_ASSOC)){
			
			$Pelicula = new PeliculaModel();
			$Pelicula->id = $filas["id"];
			$Pelicula->nombre = $filas["nombre"];
			$Pelicula->director = $filas["director"];
			$Pelicula->fecha = $filas["fecha"];
			
			$Peliculas [] = $Pelicula;
		}

		
		$ObjXML = new DOMDocument('1.0', 'utf-8');
		$ObjXML->preserveWhiteSpace = false;
		$ObjXML->formatOutput = true;

		$Elementos = $ObjXML->appendChild($ObjXML->createElement('Peliculas'));
		
		foreach($Peliculas as $Item){
			
			$Elemento = $Elementos->appendChild($ObjXML->createElement('Pelicula'));
			
			foreach($Item as $key=>$val){
				
				$Elemento->appendChild($ObjXML->createElement($key,$val));
				
			}
		}
		
		Return $ObjXML->saveXML();
		
	}
	
}

?>
