<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

	date_default_timezone_set("America/Mexico_City");

	function calcularfecha($fecha, $fecha_entrega)
	{
		$datetime1 = date_create($fecha);
		$datetime2 = date_create($fecha_entrega);
		//Nos devuelve la diferencia que hay entre dos distintas fechas en un arreglo
		$interval = date_diff($datetime1, $datetime2);
		
		$tiempo = array();

		foreach($interval as $valor)
		{
			$tiempo[] = $valor;
		}

		return $tiempo;
	}

	function resultBlockRecupera($errors){
		if(count($errors) > 0)
		{
			//Se agrega un salto de línea para una mejor visualización de los posibles errores
			echo "<br> </br>";
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">No se pudo enviar el correo electrónico ingresado, verifique los errores: </a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	//Función dedicada a los errores de inicio de sesión (index.php)
	function resultBlockInicioSesion($errors){
		if(count($errors) > 0)
		{
			//Se agrega un salto de línea para una mejor visualización de los posibles errores
			echo "<br> </br>";
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">No se pudo iniciar sesión, verifique los errores: </a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	//Solo se agrega un salto de línea para que no esté tan pegado el bloque de errores al botón
	function resultBlock($errors){
		if(count($errors) > 0)
		{
			//Se agrega un salto de línea para una mejor visualización de los posibles errores
			echo "<br> </br>";
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">No se pudo crear la cuenta, verifique los errores: </a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}



	function validafecha($fecha)
	{
		$exp = '#^(?:3[01]|[12][0-9]|0?[1-9])([\-/.])(0?[1-9]|1[1-2])\1\d{4}$#';
		if(preg_match($exp, $fecha)){
			return true;
		}else{
			return false;
		}
	}

	function tamanioContrasena($contrasena)
	{
		if (strlen(trim($contrasena)) >= 8) 
		{
			return true;
		}else
		{
			return false;
		}
	}

	function isNullMateria($clave_materia, $nombre_materia, $nombre_profesor, $aula, $seccion, $detalles)
	{
		if(strlen(trim($clave_materia)) < 1 || strlen(trim($nombre_materia)) < 1 || strlen(trim($nombre_profesor)) < 1 || strlen(trim($aula)) < 1 || strlen(trim($seccion)) < 1 || strlen(trim($detalles)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function usuarioExisteConf($nombre_usuario, $id_usuario){
		
		global $conection;

		$query = "SELECT * FROM usuario WHERE nombre_usuario = '{$nombre_usuario}' LIMIT 1";
		$consulta = pg_query($conection, $query);
		$num = pg_num_rows($consulta);
		$obj = pg_fetch_object($consulta);

		if ($num > 0 && $obj->id_usuario == $id_usuario){
			return false;
		}else if($num > 0 && $obj->id_usuario != $id_usuario){
			return true;
		}else{
			return false;	
		}
	}

	function emailExisteConf($email, $id_usuario){
		
		global $conection;

		$query = "SELECT * FROM usuario WHERE email_usuario = '{$email}' LIMIT 1";
		$consulta = pg_query($conection, $query);
		$num = pg_num_rows($consulta);
		$obj = pg_fetch_object($consulta);

		if ($num > 0 && $obj->id_usuario == $id_usuario){
			return false;
		}else if($num > 0 && $obj->id_usuario != $id_usuario){
			return true;
		}else{
			return false;	
		}
	}

	
	function validaClaveMateria($clave_materia)
	{
		$exp = '#^[iI]\d{4}$#';

		if(preg_match($exp, $clave_materia) && strlen($clave_materia) == 5){
			return true;
		}else{
			return false;
		}
	}

	function validaNombreMateria($nombre_materia)
	{
		if(strlen($nombre_materia) <= 50){
			return true;
		}else{
			return false;
		}
	}

	function validaNombreProfesor($nombre_profesor)
	{
		if(strlen($nombre_profesor) <= 60){
			return true;
		}else{
			return false;
		}
	}

	function validaAula($aula)
	{
		$exp = '#^[a-z,A-Z]{1}\d{1,2}$#';

		if(preg_match($exp, $aula) && strlen($aula) <= 3){
			return true;
		}else{
			return false;
		}
	}

	function validaSeccion($seccion)
	{
		$exp = '#^[a-z,A-Z]{1}\d{2}$#';

		if(preg_match($exp, $seccion) && strlen($seccion) == 3)
		{
			return true;
		}else
		{
			return false;
		}
	}

	function validaDetalles($detalles)
	{
		if(strlen($detalles) <= 150){
			return true;
		}else{
			return false;
		}
	}

	function isNullAct($titulo, $fecha, $descripcion, $id_materia){
		if(strlen(trim($titulo)) < 1 || strlen(trim($fecha)) < 1 || strlen(trim($descripcion)) < 1 || strlen(trim($id_materia)) < 1){
			return true;
		}else{
			return false;
		}
	}

	function tamanoTitulo($titulo){
		if(strlen($titulo) <= 60){
			return true;
		}else{
			return false;
		}
	}

	function tamanoDescripcion($descripcion){
		if(strlen($descripcion) <= 100){
			return true;
		}else{
			return false;
		}
	}

	function isNullPerfil($nombre_c, $nombre_u, $email, $telefono){
		if(strlen(trim($nombre_c)) < 1 || strlen(trim($nombre_u)) < 1 || strlen(trim($email)) < 1 || strlen(trim($telefono)) < 1){
			return true;
		}else{
			return false;
		}
	}

	function tamanoNombreC($nombre_c){
		if(strlen($nombre_c) <= 60){
			return true;
		}else{
			return false;
		}
	}

	function tamanoNombreU($nombre_u){
		if(strlen($nombre_u) <= 25){
			return true;
		}else{
			return false;
		}
	}

	function isNullPassw($password, $conf_password){
		if(strlen(trim($password)) < 1 || strlen(trim($conf_password)) < 1){
			return true;
		}else{
			return false;
		}
	}

	function isNullContactos($nombre_contacto, $etiqueta, $telefono_contacto, $email_contacto)
	{
		//Mide la longitud de la cadena y elimina espacios en blanco
		if(strlen(trim($nombre_contacto)) < 1 || strlen(trim($etiqueta)) < 1 || strlen(trim($telefono_contacto)) < 1 || 
        strlen(trim($email_contacto)) < 1)
		{
			return true;

		}
		else
		{
			return false;
		}

	}

	function tamanoNombreContacto($nombre_contacto)
	{
		if (strlen($nombre_contacto) <= 60) 
		{
			return true;
		}else
		{
			return false;
		}
	}

	function tamanoEmail($email_contacto)
	{
		if (strlen($email_contacto) <= 50) 
		{
			return true;
		}else
		{
			return false;
		}
	}


	function isNull($nombre, $usuario, $correo, $telefono, $contrasena, $confirm)
	{
		//Mide la longitud de la cadena y elimina espacios en blanco
		if(strlen(trim($nombre)) < 1 || strlen(trim($usuario)) < 1 || strlen(trim($correo)) < 1 || 
        strlen(trim($telefono)) < 1 || strlen(trim($contrasena)) < 1 || strlen(trim($confirm)) < 1)
        {
            return true;
        }
		else
		{
			return false;
		}
				
	}

	function isTelefono($telefono)
	{
		// # = Inicia y termina la ER
		// \d = puros digitos
		// $ = Para darle un final a la linea 
		$ref = '#\d$#';
		if(preg_match($ref, $telefono) && strlen($telefono) == 10)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function materiaExiste($materia)
	{
		global $conection;

		//Query almacena la consulta
		$query = "SELECT id_materia FROM materia WHERE id_materia= '{$materia}' LIMIT 1";
		//pg_query ejecuta la consulta
		$consulta = pg_query($conection, $query);
		//Se retorna el numero de registros que coincide con la consulta
		$num = pg_num_rows($consulta);
		//Se cierra la sesión en la BD
		pg_close();
		
		if ($num > 0)
		{
			return true;
		} 
		else 
		{
			return false;
		}

	}
	
	function usuarioExiste($usuario)
	{
		global $conection;
		
		//Query almacena la consulta
		$query = "SELECT id_usuario FROM usuario WHERE nombre_usuario = '{$usuario}' LIMIT 1";
		//pg_query ejecuta la consulta
		$consulta = pg_query($conection, $query);
		//Se retorna el numero de registros que coincide con la consulta
		$num = pg_num_rows($consulta);
		//Se cierra la sesión en la BD
		pg_close();
		
		if ($num > 0)
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	
	function emailExiste($email)
	{
		global $conection;
		
		$query = "SELECT id_usuario FROM usuario WHERE email_usuario = '{$email}' LIMIT 1";
		$consulta = pg_query($conection, $query);
		$num = pg_num_rows($consulta);
		
		
		if ($num > 0)
		{
			return true;
		} 
		else 
		{
			return false;	
		}
	}
	
	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) 
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	

	function registraUsuario($nombre_c, $nombre_u, $correo, $telefono, $contrasena){
		
		global $conection;
		
		$query = "INSERT INTO usuario (nombre_completo, nombre_usuario, email_usuario, telefono_usuario, contrasena) VALUES('{$nombre_c}','{$nombre_u}','{$correo}','{$telefono}','{$contrasena}')";
		$consulta = pg_query($conection, $query);


		if($consulta)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
		
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //Modificar
		$mail->Host = 'smtp.gmail.com; smtp-mail.outlook.com; smtp.live.com; smtp.mail.me.com;'; //Modificar
		$mail->Port = 587; //Modificar
		
		//Email desde donde se enviará el correo al usuario
		$mail->Username = 'focus.estudiantil@gmail.com'; //Modificar
		$mail->Password = 'Focus321.'; //Modificar
		
		$mail->setFrom('focus.estudiantil@gmail.com', 'FOCUS'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function validaIdToken($id, $token){
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($usuario, $password){
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($usuario, $password)
	{
		global $mysqli;
		$errors = '';
		$stmt = $mysqli->prepare("SELECT id, id_tipo, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param("ss", $usuario, $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['id_usuario'] = $id;
					$_SESSION['tipo_usuario'] = $id_tipo;
					
					header("location: welcome.php");
					} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
				} else {
				$errors = 'El usuario no esta activo';
			}
			} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=0 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($usuario)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $conection;
		
		$query = "SELECT $campo FROM usuario WHERE $campoWhere = '{$valor}' LIMIT 1";
		$consulta = pg_query($conection, $query);
		$num = pg_num_rows($consulta);
		
		if ($consulta) 
		{
			if ($num > 0) 
			{
				//Se recorre la base de datos en busca del objeto
				//y los campos que se desean
				while ($obj = pg_fetch_object($consulta))
				{
					$value = $obj->$campo;

				}
				
				return $value;
			}
	
		}
		else
		{
			return null;
		}
	
	}

	function getPasswordRequest($id)
	{
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		global $mysqli;
		
		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($password, $user_id){
		
		global $conection;
		
		$query = "UPDATE usuario SET contrasena = '{$password}' WHERE id_usuario = '{$user_id}'";
		$consulta = pg_query($conection, $query);
		
		if($consulta)
		{
			return true;
		}
		else
		{
			return false;
		}
	}		

?>