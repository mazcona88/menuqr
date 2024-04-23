<?php 
	session_start();
	include "../conexion.php";	
	$empresa=$_SESSION['empresa'];
	
	
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['ingredientes']) ||($_POST['precio']) <=0)
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			//$idproducto = $_POST['id'];
			$categoria  = $_POST['categoria'];
			$producto   = $_POST['producto'];
			$ingredientes   = $_POST['ingredientes'];
			$precio  	= $_POST['precio'];
			
			//var fotos//
			$foto    	= $_FILES['foto'];
			$nombre_foto= $foto['name'];
			$type		= $foto['type'];
			$url_temp	= $foto['tmp_name'];
			$imgProducto = 'img_producto.png';
			//var fotos//

			if($nombre_foto != ''){
				$destino = '../img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}
				$query_insert = mysqli_query($conection,"INSERT INTO cartas (categoria,producto,ingredientes,precio,foto,empresa)
																	VALUES('$categoria','$producto','$ingredientes','$precio','$imgProducto','$empresa')");
				$idProductoNew = mysqli_insert_id($conection);
				if($query_insert){

					/////////////////////////Generar QR/////////////////////////
					/*
						require 'phpqrcode/qrlib.php';

						$carpeta = 'img/uploads/QR/';
						if(!file_exists($carpeta))
							mkdir($carpeta);

						$filename = $carpeta.$idProductoNew.'.jpg';
						$size = 10;
						$level = 'M';
						$framesize = 3;
						//$conenido = 'PRODUCTO: '.$producto.' PRECIO: $'.$precio.' CANTIDAD: '.$cantidad;
						$conenido = 'http://theblackfox.ddns.net/facturacion/preciosQR.php?id='.$idProductoNew;


						QRcode::png($conenido,$filename,$level,$size,$framesize);
					*/
					/////////////////////////Generar QR/////////////////////////

					if($nombre_foto != ''){
						move_uploaded_file($url_temp,$src);
					}
					$alert='<p class="msg_save">Producto creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el producto.</p>';
				}

			


		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Black FOX</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
		</br>
			<h1><i class="fas fa-box-open"></i> Agregar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">

				<label for="producto">Categoria</label>
				<input type="text" name="categoria" id="categoria" placeholder="Categoria a la que asociara el producto">
				<label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Ingrese el nombre del producto">
				<label for="producto">Ingredientes</label>
				<input type="text" name="ingredientes" id="ingredientes" placeholder="Ingrese los ngredientes o descripcion breve">
				<label for="precio">Precio</label>
				<input type="text" name="precio" id="precio" placeholder="Precio del producto">
				
				<div class="photo">
					<label for="foto">Foto</label>
						<div class="prevPhoto">
						<span class="delPhoto notBlock">X</span>
						<label for="foto"></label>
						</div>
						<div class="upimg">
						<input type="file" name="foto" id="foto">
						</div>
						<div id="form_alert"></div>
				</div>
							
				<button type="submit" class="btn_save"><i class="fas fa-save"></i> Crear Producto</button>
				<a href='lista_productos.php' name="btn_cancel" class="btn_save"><i class="fas fa-window-close"></i> Cancelar</a>

			</form>


		</div>


	</section>
	<?php //include "includes/footer.php"; ?>
</body>
</html>