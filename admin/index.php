<?php 

$alert = '';
session_start();

if(!empty($_SESSION['active']))
{
	header('location: index.php');
	$alert = 'El usuario o la clave son incorrectos';
	session_destroy();

}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y su clave';
		}else{

			require_once "../conexion.php";
			error_reporting(0);
			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection,"SELECT 	u.idusuario,
														u.nombre,
														u.correo,
														u.usuario,
														u.empresa,
														r.idrol,
														r.rol
											FROM usuario u
											INNER JOIN rol r
											ON u.rol = r.idrol
											WHERE u.usuario= '$user' AND u.clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['empresa']  = $data['empresa'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['email']   = $data['correo'];
				$_SESSION['rol']    = $data['idrol'];
				$_SESSION['rol_name']    = $data['rol'];

				header('location: lista_productos.php');
				/*
				echo 
				 "<script type='text/javascript'>
					window.onload =  
                    window.open('inicio.php','nuevaVentana','height=800,width=950,location=no'); 
 				</script>" ;
				*/
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}


		}

	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Black FOX</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<section id="container">
		
		<form action="" method="post">
			
			<h3>Iniciar Sesión</h3>
			<img src="../img/fox.png" alt="Login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>

	</section>
</body>
</html>