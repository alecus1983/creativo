<?php
	//echo "Cargando ...";
	//conexion con la base de datos
	
	$link = 	mysql_connect('localhost', 'imcrea_admin', 'Caracter15');
	mysql_select_db('imcrea_boletines', $link);	
	

	// se  recupera el nombre por el método POST
	$nombre = $_POST["nombres"];


	$data = array();
	
	
	// se crea el texto de la consulta
	$q1 = "SELECT * FROM alumnos WHERE id =".$nombre;

	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se encuentra el nombre: ' . mysql_error());; 
	
	//recupero el arreglo generado en el resultado	
	$dato1 = mysql_fetch_array($q1x);
	// recupero el nombre	
														
	// estos valores son los valores a entrar por el método JSON
	// aqui recupero el nombre del alumno
	$data['nombres'] = utf8_encode($dato1["nombres"]);
	// aqui se recupera el apellido
	$data['apellidos'] = utf8_encode($dato1["apellidos"]);
	// aqui se recupera la fecha de nacimiento
	$data['fecha'] = $dato1["fecha"];
	// aqui se recupera el telefono de la casa
	$data['telefono'] = $dato1["telefono"];
	// aqui se recupra el correo del estudiante
	$data['correo'] = $dato1["correo"];
	// aqui se recupera el documento de identidad
	$data['cedula'] = $dato1["cedula"];		
	 	
	echo json_encode($data);
   
   exit ();
   
   

?>