<?php
	
	//conexion con la base de datos
	require_once 'conexion.php';
	$link = conectar();	
	

	// se  recupera el nombre por el método POST
	$grado = $_POST["grados"];
	$year = $_POST["year"];


	$data = array();
	
	
	// se crea el texto de la consulta
	$q1 = "SELECT A.id, A.nombres, A.apellidos, M.year  FROM alumnos A INNER JOIN matricula M ON A.id = M.id_alumno
			WHERE M.grado = ".$grado." AND M.year = '".$year."'";
	//echo $q1;
	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se encuentra el nombre: ' . mysql_error());; 
	
	
	//recupero el arreglo generado en el resultado	
	while($dato1 = mysql_fetch_array($q1x))
	{
	// recupero el nombre	
	$id = $dato1["id"];
	$nombres = utf8_encode($dato1["nombres"]);
	$apellidos = utf8_encode($dato1["apellidos"]);
	//echo $id."  ".$nombres." ".$apellidos."\n";														
	// estos valores son los valores a entrar por el método JSON
	// aqui recupero el nombre del alumno
	$data[$id] = $nombres."  ".$apellidos;
	}
	
	echo json_encode($data);
	//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);
   
   exit ();
   
   

?>