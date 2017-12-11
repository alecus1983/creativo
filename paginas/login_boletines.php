
				
<html>

<head>
		<meta charset="utf-8" />
	 	<title>Validacion</title>
</head>


<body>
		<table align= 'center' width = '60%'><tr><td colspan='3'>
		<h1> FORMULARIO PARA VALIDAR DOCENTES</h1></td></tr>
		
		
		<tr><td colspan='3'>
		Introduzca su nombre de usuario y contrase&ntilde;a<!-- &oacute;n requerida  del siguiente men&uacute; -->		
		</td></tr>
		
		<form action="validacion_docentes.php" method="post">
		
		
			<tr><td>Usuario:</td> <td><input type="text" name="cedula" required="required"></td></tr>
		
			<tr><td>Contrase&ntilde;a:</td> <td> <input type="password" name="login" required="required"></td></tr>
			<tr><td></td></tr>
		
			<tr><td><input type="submit" value="CARGAR"> </td></tr>
		
			
		</form>	
		</table>
</body>
</html>