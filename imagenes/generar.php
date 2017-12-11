<?php

	require('../fpdf/fpdf.php');
	
	// CONEXION CON LA BASE DE DATOS
	$link = 		mysql_connect('localhost', 'imcrea_admin', 'Caracter15');
	mysql_select_db('imcrea_boletines', $link);
	
	//include ("conexion.php");	// archivo de conexión con la base de datos
	//$link = conectar();			//  se conecta con la base de datos
	
	$fecha = '2015';				// carga el valor  en la variable fecha
	$periodo = 1;




	class PDF extends FPDF

	{
   	//Cabecera de página
   	function Header()
   	{

       	$this->Image('../imagenes/Logo_colegio.png',10,8,90,30);
			$this->Cell(90,30,"",1);
			$this->Cell(90,30,"",1);
   	}
   
   	//Pie de página
   	function Footer()
   	{
    	//Posición: a 1,5 cm del final
    	$this->SetY(-15);
    	//Arial italic 8
    	$this->SetFont('Arial','',8);
    	//Número de página
    	$txt = "Otros servicios: Programas técnicos – cursos cortos y Programas tecnológicos (Tecnológica Autónoma del Pacifico)
    	\n Info: 	Cel.3166288374    Whatsaap. 3164469532    Email:imcreativo@hotmail.com          www.imcreativo.edu.co ";
    	$this->MultiCell(0,5,$txt,0,'C',false);
    	
    	$this->Ln(1);
		$this->Ln(1);	    
    	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    
   	}
   
   
		//Tabla simple
   	function TablaSimple($header)
   	{
    	//Cabecera
    	foreach($header as $col)
		$this->SetFont('Arial','',8);    
    	
    	$this->Cell(40,7,$col,1);
    	$this->Ln();
   	
      $this->Cell(40,5,"hola",1);
      $this->Cell(40,5,"hola2",1);
      $this->Cell(40,5,"hola3",1);
      $this->Cell(40,5,"hola4",1);
      $this->Ln();
      $this->Cell(40,5,"linea ",1);
      $this->Cell(80,5,"linea 2",1);
      $this->Cell(40,5,"linea 3",1);
      $this->Cell(80,5,"linea 4",1);
   	}   
   
	}
	
	$pdf=new PDF();
	

	$q1 = "SELECT DISTINCT matricula.grado FROM 
			((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
			INNER JOIN logros ON calificaciones.id_logro = logros.id) 
			INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
			INNER JOIN materia ON calificaciones.id_materia = materia.id) 
			INNER JOIN matricula ON calificaciones.id_alumno = matricula.id_alumno";

	$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;	

while($dato1 = mysql_fetch_array($q1x)) { //extrae los datos de la consulta q1x en la variable tipo arrelo dato
		
				
	// SE ALMACENA EL GRADO EN LA VARAIABLE $grado
			
	$grado = "'".$dato1['grado']."'";		// guarda en grado el string del grado  rodeado por comillas simples
	$nivel = "".$dato1['grado']."";
			
	// DENTRO DEL GRADO SE REALIZA LA CONSULTA PARA  DETERMINAR LOS ESTUDIANTES DEL GRADO
	// 			
						
	$q3 = "SELECT DISTINCT  alumnos.id, alumnos.nombres, alumnos.apellidos  
	FROM ((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
	INNER JOIN logros ON calificaciones.id_logro = logros.id) 
	INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
	INNER JOIN materia ON calificaciones.id_materia = materia.id) 
	INNER JOIN matricula ON (calificaciones.id_alumno = matricula.id_alumno AND matricula.grado =".$grado.")
	"; 
	
	$q3x = mysql_query($q3, $link) or die('Consulta fallida q3: ' . mysql_error());;	
	
	//
	//	ENCABEZADO DE NOMBRE
	//
			
	// CICLO DE REPETICION PARA EXPLORAR LOS ESTUDIANTES
			
			
	while($dato2 = mysql_fetch_array($q3x)) { //extrae los datos de la consulta q3x en la variable tipo arrelo dato
		
							
	// VARIABLES PARA GUARDAR LOS NOMBRES DE LOS ESTUDIANTES
				
		$id_n = "".$dato2['id']."";		// guarda en grado el string del grado  rodeado por comillas simples
		$nombres = $dato2['nombres'];
		$apellidos = $dato2['apellidos'];
		
		
		// ENCABEZADO DE CELDAS	//////////////////////////////
		
		$pdf->AddPage();
		$pdf->Ln(30);
		$pdf->SetFillColor(172, 172, 172);
		$pdf->SetFont('Arial','B',10,true);
		$pdf->Cell(20,5,utf8_decode('No'),1,0,'C',true);
		$pdf->Cell(80,5,utf8_decode('NOMBRE DEL ESTUDIANTE'),1,0,'C',true);
		$pdf->Cell(25,5,utf8_decode('GRADO'),1,0,'C',true);
		$pdf->Cell(25,5,utf8_decode('JORNADA'),1,0,'C',true);
		$pdf->Cell(30,5,utf8_decode('AÑO LECTIVO'),1,0,'C',true);
		$pdf->Ln();
		$pdf->Cell(20,5,utf8_decode(''),1,0,'C');
		$pdf->Cell(80,5,utf8_decode($nombres." ".$apellidos),1,0,'C');
		$pdf->Cell(25,5,utf8_decode($nivel),1,0,'C');
		$pdf->Cell(25,5,utf8_decode('Mañana'),1,0,'C');
		$pdf->Cell(30,5,utf8_decode($fecha),1,0,'C');
		$pdf->Ln(7);
		
		//////////////////////////////////////////////////////
			
	 	$q4 = "SELECT  DISTINCT materia.id_a, materia.area
				FROM ((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
				INNER JOIN logros ON calificaciones.id_logro = logros.id) 
				INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
				INNER JOIN materia ON calificaciones.id_materia = materia.id) 
				INNER JOIN matricula ON calificaciones.id_alumno = matricula.id_alumno 
				AND matricula.grado =".$grado."
				WHERE calificaciones.id_alumno=" .$id_n
				;
				
		$q4x = mysql_query($q4, $link) or die('Consulta fallida q3: ' . mysql_error());;
		
		while($dato3 = mysql_fetch_array($q4x)) {
		
			$area = $dato3['area'];
			$id_a = $dato3['id_a'];
			
			// ENCABEZADO DE AREA
			/////////////////////////////////////////////
						
			$pdf->Ln(3);
			$pdf->SetFillColor(230, 230, 230);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(180,3,utf8_decode('Aréa : '.$area),1,0,'L',true);
			
			
			$q5 = "SELECT  DISTINCT materia.id, materia.materia
			FROM ((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
			INNER JOIN logros ON calificaciones.id_logro = logros.id) 
			INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
			INNER JOIN materia ON calificaciones.id_materia = materia.id) 
			INNER JOIN matricula ON calificaciones.id_alumno = matricula.id_alumno 
			AND matricula.grado =".$grado."
			WHERE calificaciones.id_alumno=" .$id_n. "
			AND materia.id_a =".$id_a
			;
					
			$q5x = mysql_query($q5, $link) or die('Consulta fallida q3: ' . mysql_error());;
				
			while($dato4 = mysql_fetch_array($q5x)) {
					
				$id_m = $dato4['id'];
				
				$q6 = "SELECT  DISTINCT materia.id, materia.materia, calificaciones.nota, docentes.nombres, docentes.apellidos
				FROM ((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
				INNER JOIN logros ON calificaciones.id_logro = logros.id) 
				INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
				INNER JOIN materia ON calificaciones.id_materia = materia.id) 
				INNER JOIN matricula ON calificaciones.id_alumno = matricula.id_alumno 
				AND	 matricula.grado =".$grado."
				WHERE (calificaciones.id_alumno=" .$id_n. "
				AND materia.id_a =".$id_a."
				AND materia.id =".$id_m.						
				")";
						
				$q6x = mysql_query($q6, $link) or die('Consulta fallida q3: ' . mysql_error());;
					
					while($dato5 = mysql_fetch_array($q6x)) {
							
						$materia = $dato5['materia'];
						$nota = $dato5['nota'];
						
						if($nota > 4.7) {$valor = "Superior";}	
							else {
							if($nota > 4.0) {$valor = "Alto";}
								else {
									if($nota > 2.9) {$valor = "Básico";}
										else {$valor = "Bajo";
										}
								}
							}	


							$pdf->Ln(3);
							$pdf->Cell(50,3,utf8_decode($materia),1,0,'L');
							$pdf->Cell(40,3,utf8_decode("Prof:".$dato5['nombres']." ".$dato5['apellidos']),1,0,'L');
							$pdf->Cell(20,3,utf8_decode("Faltas"),1,0,'L');
							$pdf->Cell(20,3,utf8_decode("Nota : ".$nota),1,0,'L');
							$pdf->Cell(50,3,utf8_decode("Nivel de desempeño : ".$valor),1,0,'L');
							
							
							
							
							$q7 = "SELECT  logros.logro
							FROM ((((calificaciones INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id) 
							INNER JOIN logros ON calificaciones.id_logro = logros.id) 
							INNER JOIN docentes ON calificaciones.id_docente = docentes.id) 
							INNER JOIN materia ON calificaciones.id_materia = materia.id) 
							INNER JOIN matricula ON calificaciones.id_alumno = matricula.id_alumno 
							AND	 matricula.grado =".$grado."
							WHERE (calificaciones.id_alumno=" .$id_n. "
							AND materia.id_a =".$id_a."
							AND materia.id =".$id_m.						
							")";
						
					
					
							$q7x = mysql_query($q7, $link) or die('Consulta fallida q3: ' . mysql_error());;
					
					
					
							while($dato6 = mysql_fetch_array($q7x)) {
						
								$pdf->Ln(3);
								$pdf->SetFont('Arial','',8);
								$pdf->Cell(180,3, $dato6['logro'],1,0,'L');
								
								//echo "<tr><td colspan='4', width = '100%' ><font size = 2>".$dato6['logro']."</font></td></tr>\n";
						
						
							}	
							
							
					}		
	
				}
			
			//echo "</td></tr></table>";			
				
			}
			$pdf->Ln(5);s
			$pdf->Cell(180,5,utf8_decode("Observaciones : "),0,0,'C');

			$pdf->Ln(5);
			$pdf->Cell(180,5,utf8_decode("______________________________________________________________________________"),0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(180,5,utf8_decode("______________________________________________________________________________"),0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(180,5,utf8_decode("______________________________________________________________________________"),0,0,'C');
			
				/*
				
				echo "<tr><td colspan='2', width = '100%', height=4>&nbsp;</td> </tr>\n";
				echo 	"<tr><td colspan='2', width = '100%'>0BSERVARCIONES</td></tr>"; 				
				echo 	"<tr><td colspan='2', width = '100%', align='center' >_________________________________________________________________________________________</td></tr>";
				echo 	"<tr><td colspan='2', width = '100%',  align='center' >_________________________________________________________________________________________</td></tr>";
				echo 	"<tr><td colspan='2', width = '100%', align='center' >_________________________________________________________________________________________</td></tr>";
				echo 	"<tr><td colspan='2', width = '100%', align='center' >_________________________________________________________________________________________</td></tr>";
				echo "<tr><td colspan='2', width = '100%', height=8>&nbsp;</td> </tr>\n";
				echo "<tr><td colspan='2', width = '100%', height=8>&nbsp;</td> </tr>\n";
				echo 	"<tr><td  width = '50%', align='center'>_________________________</td><td colspan='2', width = '50%', align='center' >_________________________</td></td>";
				echo 	"<tr><td  width = '50%', align='center' >Docente</td><td colspan='2', width = '50%', align='center' >Director</td></tr>";
				echo "<tr><td colspan='2', width = '100%', height=8>&nbsp;</td> </tr>\n";
				*/
			}
			
		}
		

$pdf->Output();

?> 