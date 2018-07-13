<?php
	require_once '../config/conexionn.php';

	require_once '../models/marca.entidad.php'; // Propiedades
	require_once '../models/marca.models.php';// Metodos



?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<title>PRODUCTOS</title>

	<style>
		#tabla-datos{
			margin-top: 1em;
		}
	</style>

</head>
<body>
	<h1 style="margin-top: 75px; text-align: center; margin-bottom: 20px;">P R O D U C T O S</h1>
	
	<div class="container" style="margin-top: 2em;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="panel-title">Control de Productos</h2>
			</div>
			<div class="panel-body">
				<button class="btn btn-success" type="button" id="btnAgregar" data-toggle="modal" data-target="#formulario">Agregar Producto</button>

				<div id="tabla-datos">
					<!-- AQUI SE CARGA LA TABLA -->
				</div>

			</div>
			<div class="panel-footer">
				<span>Java es mejor :v</span>
			</div>
		</div>
	</div>


	<div id="formulario" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Registro de Producto</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="frmProductos">
						
						<div class="form-group">
							<label for="txtCategoria">IdCategoria</label>
							<!--<input type="text" id="txtCategoria" class="form-control">-->
							<select name="" id="txtCategoria" class="form-control">
						<?php
						   
							$con = Conectar();
							$sql ="SELECT * FROM CATEGORIAS";
							$stmt = $con->prepare($sql);
							$result = $stmt->execute();
							$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);

							foreach($rows as $row)
							{
							?>
								<option value="<?php print($row->IDCATEGORIA);?>"><?php print($row->NOMBRECATEGORIA);?></option>	
							<?php
							}
						
							?>
							</select>
						</div>

						<div class="form-group">
							<label for="txtMarca">IdMarca</label>
							<!--<input type="text" id="txtMarca" class="form-control">-->
							<select name="" id="txtMarca" class="form-control">
							<?php
							$objMarcaModel = new MarcaModel();
							$objMarca = new Marca();
								
								$datosmarca = $objMarcaModel->ListarMarca();
								foreach($datosmarca as $row){
								echo '<option value="'.$row->__GET('IDMARCA').'">'.$row->__GET('NOMBREMARCA').'</option>';
								}
							?>
							</select>
						
						</div>

						<div class="form-group">
							<label for="txtDescripcion">Descripcion</label>
							<input type="text" id="txtDescripcion" class="form-control">
						</div>

						<div class="form-group">
							<label for="txtPrecio">Precio</label>
							<input type="number" step="0.01" id="txtPrecio" class="form-control">
						</div>

						<div class="form-group">
							<label for="txtImagen">Imagen</label>
							<input type="text" id="txtImagen" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" id="btnGuardar">Guardar Producto</button>
					<button class="btn btn-info" type="button" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

<script>
	$(document).ready(function(){

		var datosNuevos = true;
		var idproducto = "";

		function ActualizarTabla(){
			$.ajax({
				url:'../controllers/producto.controller.php',
				data:'operacion=listarpa',
				type:'GET',
				success:function(e){
					$("#tabla-datos").html(e);
				}
			});
		}

		ActualizarTabla();

		$("#btnAgregar").click(function(){
			$("#frmProductos")[0].reset();
			datosNuevos = true;
			$(".modal-title").html("Registro de Productos");
		});

		$("#btnGuardar").click(function(){

			// Se prepara el array para enviar los datos
			if (datosNuevos) {
				var datos = {
					"operacion"	: "registrar",
					"cat"		: $("#txtCategoria").val(),
					"mar"		: $("#txtMarca").val(),
					"des"		: $("#txtDescripcion").val(),
					"pre"		: $("#txtPrecio").val(),
					"ima"		: $("#txtImagen").val()
				};
			}else{
				var datos = {
					"operacion"	: "modificar",
					"cat"		: $("#txtCategoria").val(),
					"mar"		: $("#txtMarca").val(),
					"des"		: $("#txtDescripcion").val(),
					"pre"		: $("#txtPrecio").val(),
					"ima"		: $("#txtImagen").val(),
					"idp"		: idproducto
				};
			}

			$.ajax({
				url:'../controllers/producto.controller.php',
				type:'GET',
				data:datos,
				success:function(e){
					ActualizarTabla();
					$("#frmProductos")[0].reset();
					$("#formulario").modal("hide");
				}
			});
		});

		$("#tabla-datos").on("click","a[class=eliminar]",function(){
			idproducto = $(this).attr("data-idproducto");

			if (confirm("¿Esta seguro de eliminar?")){
				$.ajax({
					url:'../controllers/producto.controller.php',
					type:'GET',
					data:'operacion=eliminar&idproducto='+idproducto,
					success:function(e){
						ActualizarTabla();
					}
				});
			}
		});

		$("#tabla-datos").on("click","a[class=modificar]",function(){
			idproducto = $(this).attr("data-idproducto");
			var campo = new Array();

			$.ajax({
				url: '../controllers/producto.controller.php',
				type:'GET',
				data:'operacion=obtener&idproducto=' + idproducto,
				success:function(e){
					campo = JSON.parse(e);

					$("#txtCategoria").val(campo.IDCATEGORIA);
					$("#txtMarca").val(campo.IDMARCA);
					$("#txtDescripcion").val(campo.DESCRIPCION);
					$("#txtPrecio").val(campo.PRECIO);
					$("#txtImagen").val(campo.IMAGEN);

					datosNuevos = false;
				}
			});

			$(".modal-title").html("Modificando datos del Producto");

			$("#formulario").modal();
		
		});
	});
</script>

</body>
</html>