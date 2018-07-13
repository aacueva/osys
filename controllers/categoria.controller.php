<?php
 //Invocar a entidad + modelo
require_once '../models/categoria.entidad.php'; // Propiedades
require_once '../models/categoria.model.php';// Metodos

$objCategoria = new Categoria();
$objCategoriaModel = new CategoriaModel();
$contador = 1;

//PRIMERO DEFINICION QUE ACCION SE HARA EN ESTE CASO SERA LISTAR

if(isset($_GET['operacion'])){
	if($_GET['operacion'] =='listar'){

		$datos = $objCategoriaModel->ListarCategoria();

		//VAMOS A ESTRUCTURAR COMO SE VERAN LOS DATOS
		echo'<div class="table-responsive">
			<table class="table table-striped table-hover">
			<tr>
				<th>ID</th>
				<th>CATEGORIA</th>
				<th style="text-align:center">ELIMINAR</th>
				<th style="text-align:center">MODIFICAR</th>
			</tr>
		';

		foreach ($datos as $fila){
			echo '<tr>';
				echo '<td>' . $contador++ . '</td>';
				echo '<td>' . $fila->__GET('NOMBRECATEGORIA') . '</td>';
				echo '<td style="text-align:center"><a href="#" class="eliminar" data-idcategoria="' . $fila->__GET('IDCATEGORIA') . '"><i class="fa fa-trash-o"></i></a></td>';
				echo '<td style="text-align:center"><a href="#" class="modificar" data-idcategoria="' . $fila->__GET('IDCATEGORIA') . '"><i class="fa fa-pencil"></i></a></td>';
				echo '</tr>';
		}

		echo '</table></div>';
	}


	if ($_GET['operacion'] == 'registrar') {
		$objCategoriaModel->RegistrarCategoria($_GET['nom']);
	}

	if ($_GET['operacion'] == 'eliminar') {
		$objCategoriaModel->EliminarCategoria($_GET['idcategoria']);
	}

	if ($_GET['operacion'] == 'obtener') {
		echo json_encode($objCategoriaModel->getDatosCategoria($_GET['idcategoria']));
	}

	if ($_GET['operacion'] == 'modificar') {
		$objCategoriaModel->ModificarCategoria($_GET['nom'], $_GET['idc']);
	}


}

?>