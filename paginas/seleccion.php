	<?php
	
	session_start();
	require_once 'conexion.php';
	$link = conectar();	
	
	
	
	// Pagina transitoria para generar los resultados a actualizar
	// RECUPERO DATOS DE EL FORMULARIO 
	// DE ACTUACCION
	
	
	
	$opcion = $_POST["opcion"];
	$add = $_POST["add"];
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
	$bk= "#FFFFFF";// variable de color de fondo de tabla
	$fondo = true;
	$admin = $_SESSION['admin'];

	
	
	// COMIENZO A GENERAR TABLA
	
	

	// VERIFICO LA OPCION SELECCIONADA EN LA TABLA PARA INGREASAR 
	// 1 - CONSULTAR
	// 2 - ADICCIONAR
	// 3 - ELIMINAR
	// 4 - EDITAR
	
	echo "<table align= 'center' width = '800' border='0'>"; 
	
	// mediante las condiciones aqui descritas se hace un cruze entre las opciones para  seleccionar y para adiccionar campos	
	// y todo de guarda en la variable $opcion
	
	if ($opcion < $add) {
		$opcion = $add;}
		
	// 		
	switch($opcion) {
		// estructura para consultar el listado de estudiantes registrados en la base de datos									
		case 1:
				$q1 = "SELECT * 
				FROM alumnos a
				WHERE a.nombres like '%".$nombres."%' 
				AND a.apellidos like '%".$apellidos."%' ORDER BY apellidos";
				
				//echo $q1;

	 			$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;
				$tabla = "alumnos";									
				echo "<tr bgcolor = '#FFBF00'><td colspan='1', width = '10%' ><font size = 3>CODIGO</font></td>";													
				echo "<td colspan='1', width = '40%' ><font size = 3>NOMBRE</font size = 3></td>";
				echo "<td colspan='1', width = '40%' ><font size = 3>APELLIDOS</font size = 3></td>";
				
				if($admin) {
					echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";									
				} 
				else {
				echo "</tr>";}
					
				while($dato1 = mysql_fetch_array($q1x)) {
					
					
					echo "<tr bgcolor = '".$bk."'><td colspan='1', width = '10%' ><font size = 3>".$dato1['id']."</font></td>\n";
					echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['nombres'])."</font></td>\n";
					echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['apellidos'])."</font></td>\n";
					
					if($admin) {
					echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['id'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
					}
					else {
					echo "</tr>";}
					
					if($fondo) { $fondo = false;
						$bk= "#C0C0C0";	}
					else {$fondo = true;
						$bk= "#FFFFFF";}
				}
		break;
													
		case 2:
		/// se consulta el listado de docentes
											
			$q1 = "SELECT * FROM docentes WHERE nombres like '%".$nombres."%' AND apellidos like '%".$apellidos."%'";
			$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;
			$tabla = "docentes";
			echo "<tr bgcolor = '#FF9000'><td  colspan='1', width = '10%' ><font size = 3>CODIGO</font></td>";													
			echo "<td colspan='1', width = '45%' ><font size = 3>NOMBRE</font></td>";
			echo "<td colspan='1', width = '45%' ><font size = 3>APELLIDOS</font></td>";
			
			if($admin) {
			echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";
			}
			else {
			echo "</tr>";}										

			while($dato1 = mysql_fetch_array($q1x)) {
					echo "<tr bgcolor = '".$bk."'><td colspan='1', width = '10%' ><font size = 3>".$dato1['id']."</font></td>\n";													
					echo "<td colspan='1', width = '45%' ><font size = 3>".utf8_encode($dato1['nombres'])."</font></td>\n";
					echo "<td colspan='1', width = '45%' ><font size = 3>".utf8_encode($dato1['apellidos'])."</font></td>\n";
					
					if($admin) {
					echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['id'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";													
					}
					else {
					echo "</tr>";}
																		
					if($fondo) { $fondo = false;
						$bk= "#C0C0C0";	}
					else {$fondo = true;
						$bk= "#FFFFFF";}
			}
													
		break;		
											
											
		case 3:
											//echo "\n a materias";
											
		$q1 = "SELECT * FROM materia";
													$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;

			$tabla = "materia";			
			echo "<tr bgcolor = '#FF8000' ><td  colspan='1', width = '4%' ><font size = 3>CODIGO</font></td>";													
			echo "<td colspan='1', width = '24%' ><font size = 3>MATERIA</font></td>";
			echo "<td colspan='1', width = '24%' ><font size = 3>AREA</font></td>";
			echo "<td colspan='1', width = '24%' ><font size = 3>CODIGO DE AREA</font></td>";
			echo "<td colspan='1', width = '24%' ><font size = 3>INTENSIDAD HORARIA</font></td></tr>";
													
													
			while($dato1 = mysql_fetch_array($q1x)) {
					echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '20%' ><font size = 3>".$dato1['id']."</font></td>\n";													
					echo "<td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['materia'])."</font></td>\n";
					echo "<td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['area'])."</font></td>\n";
					echo "<td colspan='1', width = '20%' ><font size = 3>".$dato1['id_a']."</font></td>\n";
					echo "<td colspan='1', width = '20%' ><font size = 3>".$dato1['ih']."</font></td></tr>\n";
													
					if($fondo) { $fondo = false;
						$bk= "#C0C0C0";	}
						else {$fondo = true;
						$bk= "#FFFFFF";}													
												
			}
													
		break;
													
													
		case 4:
											//Areas
											
				$q1 = "SELECT DISTINCT area , id_a FROM materia";
				$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;

				echo "<tr bgcolor = '#FF7000' ><td  colspan='1', width = '30%' ><font size = 3>CODIGO</font></td>";													
				echo "<td colspan='1', width = '70%' ><font size = 3>AREA</font></td></tr>";
																										
				while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['id_a'])."</font></td>\n";													
				echo "<td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['area'])."</font></td></tr>\n";
													
						if($fondo) { $fondo = false;
							$bk= "#C0C0C0";	}
							else {$fondo = true;
							$bk= "#FFFFFF";}													
				}
													
		break;	
													
													
											
		case 5:
											//echo "\n a logros";
											
				$q1 = "SELECT * FROM logros WHERE logro like '%".$logros."%' 
				AND id_materia = ".$curso." ORDER BY id";
				$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;

				$tabla = "logros";				
				echo "<tr bgcolor = '#FFF700'><td  colspan='1', width = '10%' ><font size = 3>CODIGO</font></td>";													
				echo "<td colspan='1', width = '80%' ><font size = 3>LOGRO</font></td>";
				
				if($admin) {
				echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";
				}
				else {
				echo "</tr>";}
				
				while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '10%' ><font size = 3>".$dato1['id']."</font></td>\n";													
				echo "<td colspan='1', width = '80%' ><font size = 3>".utf8_encode($dato1['logro'])."</font></td>\n";
				
				if($admin) {
				echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['id'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
				}
				else {
				echo "</tr>";}

						if($fondo) { $fondo = false;
							$bk= "#C0C0C0";	}
						else {$fondo = true;
							$bk= "#FFFFFF";}													
				}
													
		break;
													
		case 7:
		// matriculas de alumnos
		
		
			$q1 = "SELECT M.id i, A.id, nombres, apellidos, grado, year FROM matricula M INNER JOIN alumnos A ON 
			A.id = M.id_alumno WHERE M.year = '".$year."' AND M.grado = ".$id_g." ORDER BY A.apellidos"; 
			
			$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;
			
			$tabla = "matricula";
			
			echo "<tr bgcolor = '#FFB000'><td  colspan='1', width = '20%' ><font size = 3>CODIGO</font></td>";													
			echo "<td colspan='1', width = '40%' ><font size = 3>NOMBRE</font></td>";
			echo "<td colspan='1', width = '40%' ><font size = 3>APELLIDO </font></td>";
			
			if($admin) {
			echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";
			}
			else {
			echo "</tr>";}			
			
													
			while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['id'])."</font></td>\n";													
				echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['nombres'])."</font></td>\n";
				echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['apellidos'])."</font></td>\n";
				
				
				if($admin) {				
				echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['i'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
				}
				else {
				echo "</tr>";}
												
													
				if($fondo) { $fondo = false;
					$bk= "#C0C0C0";	}
					else {$fondo = true;
					$bk= "#FFFFFF";}													
			}
													
		break;
		
		
		
		
		case 8:
		// matriculas de alumnos
		
		
			$q1 = "SELECT M.id i, D.id, nombres, apellidos, id_g, year, T.materia FROM (matricula_docente M INNER JOIN docentes D ON 
			D.id = M.id_d) INNER JOIN materia T ON T.id = M.id_m WHERE M.year = '".$year."' AND M.id_g = ".$id_g." ORDER BY D.nombres"; 
			
			$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;
			
			$tabla = "matricula_docente";
			
			echo "<tr bgcolor = '#FFB000'><td  colspan='1', width = '20%' ><font size = 3>NOMBRE</font></td>";													
			echo "<td colspan='1', width = '40%' ><font size = 3>APELLIDO</font></td>";
			echo "<td colspan='1', width = '40%' ><font size = 3>MATERIA</font></td>";
			
			if($admin) {
			echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";
			}
			else {
			echo "</tr>";}
			
													
			while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '20%' ><font size = 3>".utf8_encode($dato1['nombres'])."</font></td>\n";													
				echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['apellidos'])."</font></td>\n";
				echo "<td colspan='1', width = '40%' ><font size = 3>".utf8_encode($dato1['materia'])."</font></td>\n";
				
				if($admin) {				
				echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['i'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
				}
				else {
				echo "</tr>";}
													
													
				if($fondo) { $fondo = false;
					$bk= "#C0C0C0";	}
					else {$fondo = true;
					$bk= "#FFFFFF";}													
			}
													
		break;
		
		
													
		case 9:
		// Requisitos de la materia
											
		$q1 = "SELECT R.id, grado, materia FROM ( requisitos R INNER JOIN grados G ON R.id_g = G.id) 
		INNER JOIN  materia M ON M.id = R.id_m WHERE id_g =".$id_g." ORDER BY id_m" ;
		
		$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;

		$tabla = "requisitos";
		echo "<tr bgcolor = '#FFA000'><td  colspan='1', width = '10%' ><font size = 3>GRADO</font></td>";													
		echo "<td colspan='1', width = '10%' ><font size = 3>MATERIA</font></td>";
		
		if($admin) {
		echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";											
		}
		else {
		echo "</tr>";}		
		
													
		while($dato1 = mysql_fetch_array($q1x)) {
			echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '10%' ><font size = 3>".utf8_encode($dato1['grado'])."</font></td>\n";													
			echo "<td colspan='1', width = '10%' ><font size = 3>".utf8_encode($dato1['materia'])."</font></td>\n";
			if($admin) {
			echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['id'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
			}
			else {
			echo "</tr>";}

		
			if($fondo) { $fondo = false;
				$bk= "#C0C0C0";	}
			else {$fondo = true;
				$bk= "#FFFFFF";}	
		
		}
													
		break;
											
											
		case 11:
											// Requisitos de la materia
											
			$q1 = "SELECT C.id i, L.id, C.nota, L.logro, C.faltas FROM ( calificaciones C INNER JOIN logros L ON L.id = C.id_logro) 
			WHERE C.year ='".$year."' AND C.periodo =".$periodo." AND id_alumno =".$estudiante." AND C.id_materia =".$id_m." ORDER BY C.id_materia" ;
													
			$q1x = mysql_query($q1, $link) or die('Consulta fallida, no se encontraron logros: ' . mysql_error());;
			
			$tabla = "calificaciones";										
			echo "<tr bgcolor = '#F0F000'><td  colspan='1', width = '10%' ><font size = 3>CODIGO</font></td>";													
			echo "<td colspan='1', width = '80%' ><font size = 3>LOGRO</font></td>";
			echo "<td colspan='1', width = '10%' ><font size = 3>NOTA</font></td>";
			echo "<td colspan='1', width = '10%' ><font size = 3>FALTAS</font></td>";
			
			if($admin) {
			echo "<td colspan='1', width = '10%' ><font size = 3>BORRAR</font size = 3></td></tr>";
			}
			else {
			echo "</tr>";}										
													
			while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '10%' ><font size = 3>".utf8_encode($dato1['id'])."</font></td>\n";													
				echo "<td colspan='1', width = '80%' ><font size = 3>".utf8_encode($dato1['logro'])."</font></td>\n";
				echo "<td colspan='1', width = '10%' ><font size = 3>".utf8_encode($dato1['nota'])."</font></td>\n";
				echo "<td colspan='1', width = '10%' ><font size = 3>".utf8_encode($dato1['faltas'])."</font></td>\n";
				
				if($admin) {
				echo "<td colspan='1', width = '10%' ><font color = 'red' size = 3> <a href = '#'  onclick = 'borrar(".$dato1['i'].", \"".$tabla."\");'>Borrar</a></font></td></tr>\n";
				}
				else {
				echo "</tr>";}
				
													
				if($fondo) { $fondo = false;
					$bk= "#C0C0C0";	}
				else {$fondo = true;
					$bk= "#FFFFFF";}													
			}
		break;
	}
											
											/*
									break;
						
						case 2:
						
							switch($opcion) {
											
											
														
											// rutina para insertar los alumnos 
											
											//echo "Se ingreso el alumno ".$nombres." ".$apellidos."\nCon documento de identidad No:".$cedula."\telefono : ".$telefono."\ correo electronico :".$correo
											case 1:
														$q1 = "INSERT INTO alumnos (nombres, apellidos, cedula, fecha,telefono, correo) 
														VALUES ('".$nombres."', '".$apellidos."', '".$cedula."', '".$fecha."', '".$telefono."', '".$correo."')";
														
														//VALUES (".$nombres.", ".$apellidos.", ".$cedula.", ".$fecha.", ".$telefono.", ".$correo.")";
														
														$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla alumnos: ' . mysql_error());
														

														$q1 = "Select MAX(id) id From alumnos";
														$q1x = mysql_query($q1, $link);
														$codigo = mysql_fetch_array($q1x);


														echo "Se ingreso el alumno :".$nombres." ".$apellidos."\n Codigo: ".$codigo['id']."\n Con documento de identidad No:".$cedula."\n telefono : ".$telefono."\n correo electronico :".$correo;
														
														
											break;
											case 2:
														$q1 = "INSERT INTO docentes (nombres, apellidos, cedula, fecha,celular, correo, materias) 
														VALUES ('".$nombres."', '".$apellidos."', '".$cedula."', '".$fecha."', '".$telefono."', '".$correo."', '".$area."')";
														
														$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla docentes: ' . mysql_error());
														
														echo "Se ingreso el docente : ".$nombres." ".$apellidos."\n Cedula : ".$cedula."\n fecha : ".$fecha."\n Telefono: ".$telefono."\n Correo :".$correo;
											break;
											
											case 3:
											
											case 4:
											
											case 5: // insertar nota
													$q1 = "INSERT INTO logros (logro, id_materia) 
													VALUES ('".$logros."', '".$curso."')";
													$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar el logro: ' . mysql_error());
														
													
													$q1 = "Select MAX(id) id From logros";
													$q1x = mysql_query($q1, $link);
													$codigo = mysql_fetch_array($q1x);	
														
													echo "Se inserto  el logro : ".$logros." \n con el codigo :".$codigo['id'];
											break;
											
											/////////////////////////////////////////////////////////////////////////////////
											
											case 6:											
											
											case 8: // en este caso se inserta los estudiantes en matricula docente
													$q1 = "INSERT INTO matricula_docente (id_g, id_m , id_d, year,mes, fecha) 
													VALUES ('".$id_g."', '".$curso."', '".$docente."', '".$year."', '".$mes."', '".$fecha_fin."')";
														
														$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla matricula docentes: ' . mysql_error());
														
														echo "Codigo del grado ".$id_g." Grado ".$curso." Docente ".$docente." Años ".$year." mes ".$mes." fecha finalizacion ".$fecha_fin;
											break;
											
											
											case 9:
													$q1 = "INSERT INTO requisitos (id_g, id_m )
															VALUES ('".$id_g."', '".$curso."')";
														
														$q1x = mysql_query($q1, $link) or die('Consulta fallida al insertar tabla matricula docentes: ' . mysql_error());
														
														echo "Se ingreso el requisito para el grado: ".$id_g." en el curso ".$curso;
											break;			
										}
										
								
								break;
						case 3:
								//$p3 = $nota;
								break;
						case 4:
								// se actualiza información
						
							switch($opcion) {
								case 1: // caso actualizar estudiantes
								
									$q1 = "UPDATE alumnos SET nombres = '".$nombres."' , apellidos = '".$apellidos.
									"' , cedula =  '".$cedula."' , fecha = ".$fecha.", telefono =  '".$telefono."' , correo = '".$correo
									."' WHERE id = ".$id_e; 
												
									//echo $q1;
														
									//VALUES 
									$q1x = mysql_query($q1, $link) or die('Consulta fallida al actualizar tabla alumnos: ' . mysql_error());
														
									echo "Se actualizo el alumno :".$nombres." ".$apellidos."\n Codigo: ".$id_e."\n Con documento de identidad No:".$cedula."\n telefono : ".$telefono."\n correo electronico :".$correo;
								break;
								
								case 2: // caso actualizar estudiantes
								
									$q1 = "UPDATE docentes SET nombres = '".$nombres."' , apellidos = '".$apellidos.
									"' , cedula =  '".$cedula."' , fecha = ".$fecha.", telefono =  '".$telefono."' , correo = '".$correo
									."' WHERE id = ".$id_d; 
												
									//echo $q1;
														
									//VALUES 
									$q1x = mysql_query($q1, $link) or die('Consulta fallida al actualizar tabla alumnos: ' . mysql_error());
														
									echo "Se actualizo el alumno :".$nombres." ".$apellidos."\n Codigo: ".$id_d."\n Con documento de identidad No:".$cedula."\n telefono : ".$telefono."\n correo electronico :".$correo;
								break;								
								
							}
								break;
						}	*/
						
	echo	"</table>";
 	
 //Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);
   
   exit ();
 		
	?>