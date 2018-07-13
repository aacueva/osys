<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CATEGORIAS</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">


	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body>

<style>
	#tabla-datos{
		margin-top: 1em;
	}
</style>

<div class="container" style="margin-top: 2em;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2 class="panel-title">Control de Categoria</h2>
		</div>
		<div class="panel-body">
			<button class="btn btn-success" type="button" id="btnAgregar" data-toggle="modal" data-target="#formulario">Agregar Categoria</button>

			<!-- La tabla se cargará por AJAX -->
			<div id="tabla-datos">
				
			</div>

		</div>
		<div class="panel-footer">
			<span>Todos los derechos reservados Rusia 2018 - Qatar 2022 :v</span>
		</div>
	</div>
</div>


<div id="formulario" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Registro de Categorias</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="frmCategorias">
					<div class="form-group">
						<label for="txtCategoria">Nombre de la Categoria</label>
						<input type="text" id="txtCategoria" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="button" id="btnGuardar">Guardar datos</button>
				<button class="btn btn-info" type="button" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>

</div>

<script>
	$(document).ready(function(){

		var datosNuevos = true;
		var idcategoria = "";

		function ActualizarTabla(){
			$.ajax({
				url:'../controllers/categoria.controller.php',
				data:'operacion=listar',
				type:'GET',
				success:function(e){
					$("#tabla-datos").html(e);
				}
			});
		}

		ActualizarTabla();

		$("#btnAgregar").click(function(){
			$("#frmCategorias")[0].reset();
			datosNuevos = true;
			$(".modal-title").html("Registro de Categorias");
		});

		$("#btnGuardar").click(function(){

			if (datosNuevos){
				var datos = {
					"operacion"	: "registrar",
					"nom"		: $("#txtCategoria").val()
				};
			}else{
				var datos = {
					"operacion"	: "modificar",
					"nom"		: $("#txtCategoria").val(),
					"idc"		: idcategoria
				};
			}

			$.ajax({
				url:'../controllers/categoria.controller.php',
				type:'GET',
				data:datos,
				success:function(e){
					ActualizarTabla();
					$("#frmCategorias")[0].reset();
					$("#formulario").modal("hide");
				}
			});
		});

		$("#tabla-datos").on("click","a[class=eliminar]",function(){
			idcategoria = $(this).attr("data-idcategoria");

			if (confirm("¿Está seguro de elminar?")){
				$.ajax({
					url:'../controllers/categoria.controller.php',
					type:'GET',
					data:'operacion=eliminar&idcategoria='+idcategoria,
					success:function(e){
						ActualizarTabla();
					}
				});
			}
		});

		$("#tabla-datos").on("click","a[class=modificar]",function(){
			idcategoria = $(this).attr("data-idcategoria");
			var campo = new Array();

			$.ajax({
				url: '../controllers/categoria.controller.php',
				type:'GET',
				data:'operacion=obtener&idcategoria=' + idcategoria,
				success:function(e){
					campo = JSON.parse(e);

					$("#txtCategoria").val(campo.NOMBRECATEGORIA);

					datosNuevos = false;
				}
			});

			$(".modal-title").html("Modificando Categoria");

			$("#formulario").modal();

		});
	});
</script>

</body>
</html>