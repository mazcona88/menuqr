<?php 
	session_start();
	include "../conexion.php";	
	$empresa=$_SESSION['empresa'];
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
		
		<h1>Lista de productos</h1>
		<a href="registro_producto.php" class="btn_new"><i class="fas fa-plus"></i> Agregar producto nuevo</a>

		<table>
			<tr>
				<th>Categoria</th>
				<th>Producto</th>
				<th>Ingredientes</th>
				<th>Precio</th>
				<th>Foto</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) AS total_registro
													 FROM cartas
													 WHERE estatus = 1 AND empresa='$empresa'");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 20;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"
							SELECT * FROM cartas
							WHERE estatus = 1 AND empresa='$empresa' ORDER BY id DESC LIMIT $desde,$por_pagina 
				");
				
			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					if($data['foto'] !='img_producto.jpg'){
						$foto = '../img/uploads/'.$data['foto'];
					}else{
						$foto = 'img/'.$data['foto'];
					}
					
			?>
				<tr class="row<?php echo $data["id"]; ?>">
					<td><?php echo $data["categoria"]; ?></td>
					<td class="celPrecio"><?php echo $data["producto"]; ?></td>
					<td class="celExistencia"><?php echo $data["ingredientes"]; ?></td>
					<td class="celExistencia"><?php echo $data["precio"]; ?></td>
					<td class="imgProdcutos"><img src="<?php echo $foto; ?>" alt="<?php echo $data["producto"]; ?>"/></td>
					<td>
						<a class="link_edit" href="editar_producto.php?id=<?php echo $data["id"]; ?>"><i class="far fa-edit"></i> Editar</a>
						|
						<a class="link_delete del_product" href="#" product="<?php echo $data["id"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>				
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-backward"></i></a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fas fa-forward"></i></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> "><i class="fas fa-step-forward"></i></a></li>
			<?php } ?>
			</ul>
		</div>

	</section>
	<?php //include "includes/footer.php"; ?>	
</body>
</html>