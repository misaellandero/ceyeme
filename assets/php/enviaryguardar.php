<?php 
 
	 
	$conn = require_once('conexion.php');
 
 	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$mensaje = $_POST['mensaje']; 
	$permiso = $_POST['guardar_db']; 

	 
//enviar mensaje de correo y guardar datos de usuario

	//verficar capchat 

	if ($_POST["g-recaptcha-response"]) {

		 	$url = "https://www.google.com/recaptcha/api/siteverify";
			$clave_secreta = "6LdymlcUAAAAAOZMAAF14D9J3cAjDigFhWEP5s6e";
			$respuesta = $_POST["g-recaptcha-response"];
			$ip = $_SERVER['REMOTE_ADDR'];
			$respuesta_google = file_get_contents($url."?secret=".$clave_secreta."&response=".$respuesta."&remoteip=".$ip);
			$respuesta_json = json_decode($respuesta_google);

   		//enviar correo electronico 

				if ($respuesta_json->success) {

						  			  $mensaje="Mensaje del formulario de contacto de Ceyeme.mx";
									  $mensaje.= "\nNombre: ".$nombre;
									  $mensaje.= "\nEmail: ".$email;
									  $mensaje.= "\nTelefono: ".$telefono;
									  $mensaje.= "\nMensaje: \n".$mensaje;
									  $destino= "ventas@ceyeme.mx";
									  $remitente = 
									  $asunto = "Mensaje enviado por: ".$nombre;
									  mail($destino,$asunto,$mensaje,"FROM: $remitente"); 
									  echo "Mensaje enviado ";
									  


  					//guardar en base de datos 
									   if ( $permiso == "si") {
									  		try { 
													
													$sql = " INSERT INTO 
														`clientes`(
														`nombre`,
														`correo`, 
														`telefono`, 
														`mensaje`) VALUES 
														('$nombre',
														'$email',
														'$telefono',
														'$mensaje')";
													 
													if ($conn->query($sql) == TRUE) {
														echo "Te avisaremos de ofertas.";
													}else{

														echo "error";
													}
											
											} catch (PDOException $e) {
												echo 'Error: '. $e->getMessage(); 
											}
										} 
				}
	}else{
		echo 0;
	}  		 
?>

