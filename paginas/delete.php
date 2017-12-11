<?php
	require_once 'conexion.php';
	//conexion con la base de datos
	
	$link = conectar();	
	

	// se  recupera el nombre por el método POST
	
	//$year = $_GET["year"];

	$tabla = $_GET['tabla'];
	$codigo = $_GET['id'];
	
	echo "<br>tabla : $tabla";
	echo "<br>id : $id";
        
	// se crea el texto de la consulta
	$q1 = "DELETE FROM ".$tabla." WHERE id =".$codigo;  
			
	//echo $q1;
	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se pudo eliminar el registro: ' . mysql_error());; 
	
	echo "se elimino el registro exitosamente";
	
	//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar();
   
  
   

?>