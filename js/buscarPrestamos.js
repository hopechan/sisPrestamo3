function buscarPrestamos (){
	var textoBusqueda = $("input#busqueda").val();

	if (textoBusqueda != "") {
		$.post("buscarPrestamos.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
			$("#resultadoBusqueda").html(mensaje);
			$("#inactivos").html('');
		});
	} else {
		("#resultadoBusqueda").html('');
		("#inactivos").html('');
	}
}