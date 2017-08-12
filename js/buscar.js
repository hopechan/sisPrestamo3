function buscar() {
	var textoBusqueda = $("input#busqueda").val();

	if (textoBusqueda != "") {
		$.post("buscar.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
			$("#resultadoBusqueda").html(mensaje);
		});
	} else {
		("#resultadoBusqueda").html('');
	};
};