<?php
	
	session_start();
	
	//conexion con la base de datos
	require_once 'conexion.php';
	$link = conectar();
        
	

	// se  recupera el nombre por el método POST
	$grado = $_POST["grados"];
	

	// se  recupera el nombre por el método POST

	$admin = $_SESSION['admin'];
	$id = $_SESSION['code'];
	$year = date('Y');
	
	$data = array();
	
	if ($admin) {
		// se crea el texto de la consulta
		$q1 = "SELECT M.id, M.materia  FROM requisitos R INNER JOIN materia M ON M.id = R.id_m
		WHERE R.id_g = ".$grado;	
	}
	else {
		$q1 = "SELECT DISTINCT M.id, M.materia FROM materia M INNER JOIN matricula_docente D ON M.id = D.id_m  WHERE D.year = '".$year."' 
		AND  D.id_d = ".$id." AND D.id_g =".$grado;
		
	}
	
	
	
	

	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se encuentra el nombre: ' . mysql_error());; 
	
	
	//recupero el arreglo generado en el resultado	
	while($dato1 = mysql_fetch_array($q1x))
	{
	// recupero el nombre	
	$id = $dato1["id"];
	$materia = utf8_encode($dato1["materia"]);
	// estos valores son los valores a entrar por el método JSON
	// aqui recupero el nombre del alumno
	$data[$id] = $materia;
	}
	
	echo json_encode($data);
   
	//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);


   
   exit ();
   
   

?>