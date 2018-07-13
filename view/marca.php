<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MARCAS</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">


	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<style>
	#tabla-datos{
		margin-top: 1em;
	}
	</style>
</head>
<body>
	
	<div class="container" style="margin-top: 2em;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="panel-title">Control de Marcas</h2>
			</div>
			<div class="panel-body">
				<button class="btn btn-success" type="button" id="btnAgregar" data-toggle="modal" data-target="#formulario">Agregar Marca</button>

				<div id="tabla-datos">
					
				</div>

			</div>
			<div class="panel-footer">
				<span>Osys 2018 ©</span>
			</div>
		</div>
	</div>

	<div id="formulario" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Registro de Marcas</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="frmMarca">

						<div class="form-group">
							<label for="txtMarca">Nombre de la Marca</label>
							<input type="text" id="txtMarca" class="form-control">
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" id="btnGuardar">Guardar Marca</button>
					<button class="btn btn-info" type="button" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>

	</div>

<script>
	
	$(document).ready(function(){

		var datosNuevos = true;
		var idmarca = "";

		function ActualizarTabla(){
			$.ajax({
				url:'../controllers/marca.controller.php',
				data:'operacion=listar',
				type:'GET',
				success:function(e){
					$("#tabla-datos").html(e);
				}
			});
		}

		ActualizarTabla();

		$("#btnAgregar").click(function(){
			$("#frmMarca")[0].reset();
			datosNuevos = true;
			$(".modal-title").html("Registro de Marca");
		});

		$("#btnGuardar").click(function(){

			if (datosNuevos) {
				var datos = {
					"operacion"	:"registrar",
					"nom"		: $("#txtMarca").val()
				};
			}else{
				var datos = {
					"operacion"	: "modificar",
					"nom"		: $("#txtMarca").val(),
					"idm"		: idmarca
				};
			}

			$.ajax({
				url:'../controllers/marca.controller.php',
				type:'GET',
				data:datos,
				success:function(e){
					ActualizarTabla();
					$("#frmMarca")[0].reset();
					$("#formulario").modal("hide");
				}
			});
		});

		$("#tabla-datos").on("click","a[class=eliminar]",function(){

			idmarca = $(this).attr("data-idmarca");

			if (confirm("¿Está seguro de eliminar?")) {
				$.ajax({
					url:'../controllers/marca.controller.php',
					type:'GET',
					data:'operacion=eliminar&idmarca='+idmarca,
					success:function(e){
						ActualizarTabla();
					}
				});
			}
		});

		$("#tabla-datos").on("click","a[class=modificar]",function(){
			idmarca = $(this).attr("data-idmarca");
			var campo = new Array();

			$.ajax({
				url: '../controllers/marca.controller.php',
				type:'GET',
				data:'operacion=obtener&idmarca=' + idmarca,
				success:function(e){
					campo = JSON.parse(e);

					$("#txtMarca").val(campo.NOMBREMARCA);

					datosNuevos = false;
				}
			});


			$(".modal-title").html("Modificando datos de la Marca");

			$("#formulario").modal();

		});
	});

</script>



</body>
</html>