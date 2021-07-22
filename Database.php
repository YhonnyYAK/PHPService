<?php 
	//Abrir conexion a la base de datos
	function ConnectDB()
	{
	  try {
		   $db = [
				'host' => 'localhost',
				'username' => 'root',
				'password' => '',
				'db' => 'cinedb' 
			];
		  
		  $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']};charset=utf8", $db['username'], $db['password']);
		  // set the PDO error mode to exception
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  return $conn;
	  } catch (PDOException $exception) {
		  exit($exception->getMessage());
	  }
	}

?>