	<?php
        
        require_once 'conexion.php';
	$link = conectar();
	
	
	
	// Pagina transitoria para generar los resultados a actualizar
	// RECUPERO DATOS DE EL FORMULARIO 
	// DE ACTUACCION
	
	
	
	$edi = $_POST["edi"];
	$nombres = $_POST["i_nombres"];
	$apellidos = $_POST["apellidos"];	
	$logros = $_POST["Logros"];
	$year = $_POST["years"];
	$grados = $_POST["grados"];
	$fecha = $_POST["fechas"];
	$cedula = $_POST["cedulas"];
	$correo = $_POST["correos"];
	$telefono = $_POST["telefonos"];
	$area = $_POST["areas"];
	$id_g = $_POST["id_gs"];
	$id_l = $_POST["id_ls"];
	$curso = $_POST["cursos"];
	$docente = $_POST["docentes"];  
	$periodo = $_POST["periodos"];
	$estudiante = $_POST["estudiantes"];
	$mes = date("m");
	$fecha_fin = $_POST["fecha_fins"];
	$id_e = $_POST["id_es"];
	$id_d = $_POST["id_ds"];
	$id_m = $_POST["id_ms"];
	$materia = $_POST[""];
	$jornada = utf8_encode("Mañana");
	$bk= "#FFFFFF";// variable de color de fondo de tabla
	$fondo = true;
	$logro_1 = $_POST['logro_1'];
	$logro_2 = $_POST['logro_2'];
	$logro_3 = $_POST['logro_3'];
	$nota = $_POST['nota'];
	$faltas = $_POST['faltas'];
	$id_docente = $_POST['id_docentes'];
	
	
	//echo "Cargando ...".$edi;
	
	// COMIENZO A GENERAR TABLA
	
	

	// VERIFICO LA OPCION SELECCIONADA EN LA TABLA PARA INGREASAR 
	// 1 - CONSULTAR
	// 2 - ADICCIONAR
	// 3 - ELIMINAR
	// 4 - EDITAR
	
	 
	
	switch($edi) {
		// estructura para insertar  el listado de estudiantes registrados en la base de datos									
		//echo "Se ingreso el alumno ".$nombres." ".$apellidos."\nCon documento de identidad No:".$cedula."\telefono : ".$telefono."\ correo electronico :".$correo
		case 1:
		
			$q1 = "UPDATE alumnos SET nombres = '".utf8_decode($nombres)."', apellidos = '".utf8_decode($apellidos)."', cedula = '".$cedula."', fecha = '".$fecha."',telefono = '".$telefono."', correo = '".$correo."' WHERE id = ".$id_e;
			
			//echo $q1;											
			$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla alumnos: ' . mysql_error());
														
			
			
			echo "Se actualizo el alumno :".$nombres." ".$apellidos."\n Codigo: ".$id_e."\n Con documento de identidad No:".$cedula."\n telefono : ".$telefono."\n correo electronico :".$correo;
														
														
		break;
											
		case 2:
			$q1 = "UPDATE docentes SET nombres = '".utf8_decode($nombres)."', apellidos = '".utf8_decode($apellidos)."', cedula = '".$cedula."', fecha = '".$fecha."',celular = '".$telefono."'
			, correo = '".$correo."', materias = '".utf8_decode($area)."'	WHERE id = ".$id_d;
														
			$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla docentes: ' . mysql_error());
														
			
			
			echo "Se ingreso el docente :".$nombres." ".$apellidos."\n Codigo: ".$id_d."\n Con documento de identidad No:".$cedula."\n telefono : ".$telefono."\n correo electronico :".$correo." Areas : ".utf8_decode($area);
		
		break;
											
		
		case 3:
											
											
		case 4:
											
											
											
		case 5: // insertar logro
		
			$q1 = "UPDATE logros SET logro = '".utf8_decode($logros)."' WHERE id = ".$id_l; 
			
			//echo $q1;
			$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar el logro: ' . mysql_error());
														
			echo "Se actualizo  el logro : ".$id_l;
		
		break;
											
		/////////////////////////////////////////////////////////////////////////////////
											
		
				
		case 11:
			
			$q1 = "UPDATE calificaciones SET id_logro = ".$logro_1.", nota = ".$nota.", id_docente = ".$id_docente.", faltas =".$faltas."
			WHERE id_alumno = ".$estudiante." AND id_materia =".$id_m." AND periodo =".$periodo." AND year =".$year;
														
			//echo $q1;
			
			$q1x = mysql_query($q1, $link) or die('Error al actualizar calificaciones : ' . mysql_error());
			
		break;			
		
		
		case 12:
			
			$q1 = "UPDATE calificaciones SET id_logro = ".$logro_1.", nota = ".$nota.", id_docente = ".$id_docente.", faltas =".$faltas."
			WHERE id_alumno = ".$estudiante." AND id_materia =".$id_m." AND periodo =".$periodo." AND year =".$year;
														
			//echo $q1;
			
			$q1x = mysql_query($q1, $link) or die('Error al actualizar calificaciones : ' . mysql_error());
			
		break;
	}
					
						
	
 	
	//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);
   
   exit ();
 		
	?>