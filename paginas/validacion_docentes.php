<?php
    
    require_once 'conexion.php';
            
	/*caturamos nuestros datos que fueron enviados desde el formulario mediante el metodo POST
	**y los almacenamos en variables.*/
	
        $link = conectar();
        
        $usuario = $_POST["cedula"];
	
	$password = $_POST["login"];
        $query = "select * from docentes where cedula ='".$usuario."'";
        echo $query;
	$registro=mysql_query ($query, $link) or
  	die("Problemas  encontrar el usuario:".mysql_error());
	
	
	//Validamos si el nombre del administrador existe en la base de datos o es correcto
	if($row = mysql_fetch_array($registro))
	
                {     
		//Si el usuario es correcto ahora validamos su contrase�a
		
		
 		if($row["login"] == $password)
 			{
  			//Creamos sesi�n
  			session_start();  
  			
  			//Almacenamos el nombre de usuario en una variable de sesi�n usuario
  			$_SESSION['usuario'] = $usuario;  
  			$_SESSION['id'] = $row['id'];
  			
  			header("Location:formulario_boletin.php");  
  			}
 		else
 			{
  			//En caso que la contrase�a sea incorrecta enviamos un msj y redireccionamos a login.php
  			?>
   		<script >
    			alert("Contrase�a Incorrecta");
    			location.href = "login_boletines.php";
   		</script>
  			<?
            
 			}
		}
else
    {
 		//en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
		?>
 			<script >
  				alert("El nombre de usuario es incorrecto!");
  				location.href = "login_boletines.php";
 			</script>
		<?   
		        
		}

		//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
		mysql_free_result($result);

		/*Mysql_close() se usa para cerrar la conexi�n a la Base de datos y es 
		**necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
		**programar una aplicaci�n que tendr� muchas visitas ;) .*/
		//mysql_close();
                
    desconectar($link);

 ?>