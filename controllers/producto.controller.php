<?php

// Llamar a la entidad + modelo
require_once '../models/producto.entidad.php';
require_once '../models/producto.models.php';

// Intancia de clases
$objProducto = new Producto();
$objProductoModel = new ProductoModel();
$contador = 1;

// Definir la accion a realizar
if (isset($_GET['operacion'])) {
	
	if ($_GET['operacion'] == 'listar') {
		
		$datos = $objProductoModel->ListarProducto();

		// Estructuramos la salida hacia VISTA
		echo '<div class="table-responsive">
		<table class="table table-striped table-hover"
		<tr>
			<th>ID</th>
			<th>Categoria</th>
			<th>Marca</th>
			<th>Descripcion</th>
			<th>Precio</th>
			<th>Imagen</th>
			<th style="text-aling:center">Eliminar</th>
			<th style="text-aling:center">Modificar</th>
		</tr>
		';
		foreach ($datos as $fila) {
			echo '<tr>';
				echo '<td>' . $contador++ . '</td>';
				echo '<td>' . $fila->__GET('IDCATEGORIA') . '</td>';
				echo '<td>' . $fila->__GET('IDMARCA') . '</td>';
				echo '<td>' . $fila->__GET('DESCRIPCION') . '</td>';
				echo '<td>' . $fila->__GET('PRECIO') . '</td>';
				echo '<td>' . $fila->__GET('IMAGEN') . '</td>';
				echo '<td style="text-align:center"><a href="#" class="eliminar" data-idproducto="' . $fila->__GET('IDPRODUCTO') . '"><i class="fa fa-trash-o"></i></a></td>';
				echo '<td style="text-align:center"><a href="#" class="modificar" data-idproducto="' . $fila->__GET('IDPRODUCTO') . '"><i class="fa fa-pencil"></i></a></td>';
			echo '</tr>';
		}

		echo '</table></div>';
	}


	if ($_GET['operacion'] == 'listarpa') {
		
		$datos = $objProductoModel->ListarProductoPA();

		// Estructuramos la salida hacia VISTA
		echo '<div class="table-responsive">
		<table class="table table-striped table-hover"
		<tr>
			<th>ID</th>
			<th>Categoria</th>
			<th>Marca</th>
			<th>Descripcion</th>
			<th>Precio</th>
			<th>Imagen</th>
			<th style="text-aling:center">Eliminar</th>
			<th style="text-aling:center">Modificar</th>
		</tr>
		';
		foreach ($datos as $fila) {
			echo '<tr>';
				echo '<td>' . $contador++ . '</td>';
				echo '<td>' . $fila->__GET('NOMBRECATEGORIA') . '</td>';
				echo '<td>' . $fila->__GET('NOMBREMARCA') . '</td>';
				echo '<td>' . $fila->__GET('DESCRIPCION') . '</td>';
				echo '<td>' . $fila->__GET('PRECIO') . '</td>';
				echo '<td>' . $fila->__GET('IMAGEN') . '</td>';
				echo '<td style="text-align:center"><a href="#" class="eliminar" data-idproducto="' . $fila->__GET('IDPRODUCTO') . '"><i class="fa fa-trash-o"></i></a></td>';
				echo '<td style="text-align:center"><a href="#" class="modificar" data-idproducto="' . $fila->__GET('IDPRODUCTO') . '"><i class="fa fa-pencil"></i></a></td>';
			echo '</tr>';
		}

		echo '</table></div>';
	}


	if ($_GET['operacion'] == 'registrar') {
		$objProductoModel->RegistrarProducto($_GET['cat'], $_GET['mar'], $_GET['des'], $_GET['pre'], $_GET['ima']);
	}


	if ($_GET['operacion'] == 'eliminar') {
		$objProductoModel->EliminarProducto($_GET['idproducto']);
	}


	if ($_GET['operacion'] == 'obtener') {
		echo json_encode($objProductoModel->getDatosProducto($_GET['idproducto']));
	}


	if ($_GET['operacion'] == 'modificar') {
		$objProductoModel->ModificarProducto($_GET['cat'], $_GET['mar'], $_GET['des'], $_GET['pre'], $_GET['ima'], $_GET['idp']);
	}

}

?>