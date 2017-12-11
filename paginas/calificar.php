<?php
	require_once 'conexion.php';	
	$link = conectar();	
	
	
	
	// Pagina transitoria para generar los resultados a actualizar
	// RECUPERO DATOS DE EL FORMULARIO 
	// DE ACTUACCION
	
	
	

	$id_m = $_POST["id_ms"];
	
	$bk= "#FFFFFF";// variable de color de fondo de tabla
	$fondo = true;

	echo "<table align= 'center' width = '800' border='0'>";
									
				$q1 = "SELECT * FROM logros WHERE  id_materia = ".$id_m." ORDER BY id";
				$q1x = mysql_query($q1, $link) or die('Consulta fallida q1: ' . mysql_error());;

				$tabla = "logros";				
				echo "<tr bgcolor = '#01DF01'><td  colspan='1', width = '10%' ><font size = 3>CODIGO</font></td>";													
				echo "<td colspan='1', width = '80%' ><font size = 3>LOGRO</font></td>";
				echo "<td colspan='1', width = '10%' ><font size = 3>CALIFICAR</font size = 3></td></tr>";
				
				
				while($dato1 = mysql_fetch_array($q1x)) {
				echo "<tr bgcolor = '".$bk."' ><td colspan='1', width = '10%' ><font size = 3>".$dato1['id']."</font></td>\n";													
				echo "<td colspan='1', width = '80%' ><font size = 3>".utf8_encode($dato1['logro'])."</font></td>\n";
				echo "<td colspan='1', width = '10%' > <input type='checkbox' id = '".$dato1['id']."'></td></tr>\n";
						if($fondo) { $fondo = false;
							$bk= "#C0C0C0";	}
						else {$fondo = true;
							$bk= "#FFFFFF";}													
				}
								
		
		
		
	echo	"</table>";	
		
		//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
	desconectar($link);
   
   exit ();
?>