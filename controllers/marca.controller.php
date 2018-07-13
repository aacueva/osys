<?php

require_once '../models/marca.entidad.php';
require_once '../models/marca.models.php';

$objMarca = new Marca();
$objMarcaModel = new MarcaModel();
$Contador = 1;

if (isset($_GET['operacion'])) {
	
	if ($_GET['operacion'] == 'listar') {
		
		$datos = $objMarcaModel->ListarMarca();

		echo '<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>ID</th>
					<th>Marca</th>
					<th style="text-align:center">Eliminar</th>
					<th style="text-align:center">Modificar</th>
				</tr>
		';

		foreach ($datos as $fila) {
			echo '<tr>';
				echo '<td>' . $Contador++ . '</td>';
				echo '<td>' . $fila->__GET('NOMBREMARCA') . '</td>';
				echo '<td style="text-align:center"><a href="#" class="eliminar" data-idmarca="' . $fila->__GET('IDMARCA') . '"><i class="fa fa-trash-o"></i></a></td>';
				echo '<td style="text-align:center"><a href="#" class="modificar" data-idmarca="' . $fila->__GET('IDMARCA') . '"><i class="fa fa-pencil"></i></a></td>';
			echo '</tr>';
		}

		echo '</table></div>';
	}


	if ($_GET['operacion'] == 'registrar') {
		$objMarcaModel->RegistrarMarca($_GET['nom']);
	}

	if ($_GET['operacion'] == 'eliminar') {
		$objMarcaModel->EliminarMarca($_GET['idmarca']);
	}

	if ($_GET['operacion'] == 'obtener') {
		echo json_encode($objMarcaModel->getDatosMarca($_GET['idmarca']));
	}

	if ($_GET['operacion'] == 'modificar') {
		$objMarcaModel->ModificarMarca($_GET['nom'],$_GET['idm']);
	}

}


?>