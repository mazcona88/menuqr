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
			
			$idproducto = $_POST['id'];
			$categoria  = $_POST['categoria'];
			$producto   = $_POST['producto'];
			$ingredientes   = $_POST['ingredientes'];
			$precio  	= $_POST['precio'];
			
			//var fotos//
			$imgProducto= $_POST['foto_actual'];
			$imgRemove	= $_POST['foto_remove'];			
			$foto    	= $_FILES['foto'];
			$nombre_foto= $foto['name'];
			$type		= $foto['type'];
			$url_temp	= $foto['tmp_name'];
			$upd = '';
			//var fotos//

			if($nombre_foto != ''){
				$destino 	= '../img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto= $img_nombre.'.jpg';
				$src 		= $destino.$imgProducto;
			}else{
				if($_POST['foto_actual'] != $_POST['foto_remove']){
					$imgProducto = 'img_producto.png';
				}
			}
				$query_update = mysqli_query($conection,"UPDATE cartas SET	categoria='$categoria',
																			producto='$producto',
																			ingredientes='$ingredientes',
																			precio=$precio,
																			foto='$imgProducto'
																			WHERE id = $idproducto");
				if($query_update){

					if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual']) != ($_POST['foto_remove']))
					{
						unlink('../img/uploads/'.$_POST['foto_actual']);
					}

					if($nombre_foto != ''){
						move_uploaded_file($url_temp,$src);
					}
					$alert='<p class="msg_save">Producto actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el producto.</p>';
				}

			


		}

	}

	//validar producto
	if(empty($_REQUEST['id'])){
		header('Location: lista_productos.php');
	}else{
		$idproducto = $_REQUEST['id'];
		if(!is_numeric($idproducto)){
			header('Location: lista_productos.php');	
		}	

	$query_producto= mysqli_query($conection,"SELECT * FROM cartas
												WHERE id='$idproducto' and estatus = 1 ");
	$result_producto = mysqli_num_rows($query_producto);

	//validar img
	$foto='';
	$classRemove = 'notBlock';

	if($result_producto > 0){
		
		$data_producto = mysqli_fetch_assoc($query_producto);

		if($data_producto['foto'] != 'img_producto.png'){
			$classRemove = '';
			$foto = '<img id="img" src="../img/uploads/'.$data_producto['foto'].'" alt="Producto">';
		}
			
		}else{
			header('Location: lista_productos.php');
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
			<h1><i class="fas fa-box-open"></i> Editar producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $data_producto['id'];?>">
				<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto'];?>">
				<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto'];?>">				
				
				<label for="producto">Categoria</label>
				<input type="text" name="categoria" id="categoria" value="<?php echo $data_producto['categoria'];?>">
				<label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" value="<?php echo $data_producto['producto'];?>">
				<label for="producto">Ingredientes</label>
				<input type="text" name="ingredientes" id="ingredientes" value="<?php echo $data_producto['ingredientes'];?>">
				<label for="precio">Precio</label>
				<input type="text" name="precio" id="precio" value="<?php echo $data_producto['precio'];?>">

				<div class="photo">
					<label for="foto">Foto</label>
						<div class="prevPhoto">
						<span class="delPhoto <?php echo $classRemove; ?>">X</span>
						<label for="foto"></label>
						<?php echo $foto; ?>
						</div>
						<div class="upimg">
						<input type="file" name="foto" id="foto">
						</div>
						<div id="form_alert"></div>
				</div>
							
				<button type="submit" class="btn_save"><i class="fas fa-save"></i> Actualizar</button>
				<a href='lista_productos.php' name="btn_cancel" class="btn_save"><i class="fas fa-window-close"></i> Cerrar</a>

			</form>


		</div>


	</section>
	<?php //include "includes/footer.php"; ?>
</body>
</html>u