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

	public function GrabarPeliculaJSON($Trama){

		$db = ConnectDB();
		$Data = json_decode($Trama, true);

		$Pelicula = new PeliculaModel();
		$Pelicula->id = $Data["id"];
		$Pelicula->nombre = $Data["nombre"];
		$Pelicula->director = $Data["director"];
		$Pelicula->fecha = $Data["fecha"];

		$Consulta = "INSERT INTO Peliculas(nombre,director,fecha) 
					 VALUES('$Pelicula->nombre','$Pelicula->director','$Pelicula->fecha')";

		$Respuesta = $db->query($Consulta);

		$Id = $db->lastInsertId();
		$Mensaje = "Producto creado correctmente";

		$Salida = "{'id':'$Id', 'Mensaje': '$Mensaje'}";

		return $Salida;
	}

	public function GrabarPeliculaXML($Trama){

		$db = ConnectDB();
		$TramaXML = simplexml_load_string($Trama);

		$DataJson = json_encode($TramaXML);
		$Data = json_decode($DataJson, true);

		$Pelicula = new PeliculaModel();
		$Pelicula->id = $Data["id"];
		$Pelicula->nombre = $Data["nombre"];
		$Pelicula->director = $Data["director"];
		$Pelicula->fecha = $Data["fecha"];

		$Consulta = "INSERT INTO Peliculas(nombre,director,fecha) 
					 VALUES('$Pelicula->nombre','$Pelicula->director','$Pelicula->fecha')";

		$Respuesta = $db->query($Consulta);

		$Id = $db->lastInsertId();
		$Mensaje = "Producto creado correctmente";

		$ObjXML = new DOMDocument('1.0', 'utf-8');
		$ObjXML->preserveWhiteSpace = false;
		$ObjXML->formatOutput = true;

		$Salida = $ObjXML->appendChild($ObjXML->createElement('Respuesta'));
		$Salida->appendChild($ObjXML->createElement('id',$Id));
		$Salida->appendChild($ObjXML->createElement('Mensaje',$Mensaje));

		return $ObjXML->saveXML();

	}
	
}

?>
