<?php
include "../conexion.php";
session_start();
$empresa=$_SESSION['empresa'];
//print_r($_POST);exit;

//COMIENZO AJAX//
if(!empty($_POST)){
	

	//extraer datos de productos
	if($_POST['action'] == 'infoProducto'){
		
		$producto_id = $_POST['producto'];
		
		$query = mysqli_query($conection,"SELECT * FROM cartas
											WHERE id = $producto_id AND estatus = 1 AND empresa='$empresa' ");
		
		mysqli_close($conection);
		
		$result=mysqli_num_rows($query);
		if($result > 0){
			$data = mysqli_fetch_assoc($query);
			//esto decodifica la cadena para q no devuelva caracteres raros como tildes
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			exit;
		}
		echo 'error';
		exit;
	}

	//Eliminar productos
	if($_POST['action'] == 'delProduct'){
		if(empty($_POST['producto_id']) || !is_numeric($_POST['producto_id'])){
			echo 'error';
		}else{
			$idproducto = $_POST['producto_id'];
			$query_delete = mysqli_query($conection,"UPDATE cartas SET estatus = 0 WHERE id = $idproducto ");
			mysqli_close($conection);

			if($query_delete){
				echo "OK";
			}else{
				echo "Error al eliminar";
			}
		}
		echo "Error al eliminar";
		exit;
	}
	
//FINAL AJAX//
}
exit;

?>