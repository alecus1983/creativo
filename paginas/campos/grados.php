<?php
	session_start();
	
	//conexion con la base de datos
	require_once 'conexion.php';
	$link = conectar();	
	

	// se  recupera el nombre por el método POST
	

	$admin = $_SESSION['admin'];
	$id = $_SESSION['code'];
	$year = date('Y');
	
	$data = array();
	
	if ($admin) {
		// se crea el texto de la consulta
		$q1 = "SELECT * FROM grados ORDER BY grado";	
	}
	else {
		$q1 = "SELECT DISTINCT G.id, G.grado FROM grados G INNER JOIN matricula_docente D ON G.id = D.id_g  WHERE D.year = '".$year."' AND  D.id_d = ".$id;
		
	}
	
	
	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se encuentra el grado: ' . mysql_error());; 
	
	
	//recupero el arreglo generado en el resultado	
	while($dato1 = mysql_fetch_array($q1x))
	{
	// recupero el nombre	
	$id = $dato1["id"];
	$grado = utf8_encode($dato1["grado"]);
															
	// estos valores son los valores a entrar por el método JSON
	// aqui recupero el nombre del alumno
	$data[$id] = $grado;
	}
	
	echo json_encode($data);
	
	//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);
   exit ();
   
   

?>