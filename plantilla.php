<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Menu Resto</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<section class="wrap">
<?php
include "conexion.php";

// Obtener las categorías distintas de la tabla 'cartas'
$query_categorias = mysqli_query($conection, "SELECT DISTINCT categoria FROM cartas");
while ($categoria = mysqli_fetch_array($query_categorias)) {
    $categoria_nombre = $categoria['categoria'];
?>
		  <div class="wrap-title-section">
			<h2><?php echo $categoria_nombre; ?></h2>
		  </div>
		  <div class="wrap column-2 carta">
<?php
    // Obtener los productos de la categoría actual
    $query_productos = mysqli_query($conection, "SELECT * FROM cartas WHERE categoria = '$categoria_nombre'");
    while ($data = mysqli_fetch_array($query_productos)) {
        $foto = 'img/' . $data['foto'];
?>
			<div class="plato-carta">
			  <div class="img-plato-carta">
				<img src="<?php echo $foto; ?>" alt="">
			  </div>
			  <div class="title-plato-carta">
				<h4><?php echo $data["producto"]; ?></h4>
				<p><?php echo $data["ingredientes"]; ?></p>
			  </div>
			  <div class="precio-plato-carta">
				<span><?php echo $data["precio"]; ?></span>
			  </div>
			</div>
<?php
    }
?>
		  </div>
<?php
}
mysqli_close($conection);
?>
		</section>
	</body>
</html>
