<?php
	echo "Cargando ...";
	//conexion con la base de datos
	$link = 	mysql_connect('localhost', 'imcrea_admin', 'Caracter15');
	mysql_select_db('imcrea_boletines', $link);	
	
	// se  recupera el nombre por el método POST
	$nombre = $_POST["nombres"];
	// se crea el texto de la consulta
	$q1 = "SELECT nombre FROM alumnos WHERE id =".$nombre;
	// se realiza la  consulta en la base de datos
	$q1x = mysql_query($q1, $link) or die('no se encuentra el nombre: ' . mysql_error());; 
	//recupero el arreglo generado en el resultado	
	$dato1 = mysql_fetch_array($q1x);
	// recupero el nombre	
	echo $dato1["nombre"];														
	//mysql_close($link_identifier = null);

?>