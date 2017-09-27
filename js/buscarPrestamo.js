function buscarPrestamos (){
	var textoBusqueda = $("input#busqueda").val();

	if (textoBusqueda != "") {
		$.post("buscarPrestamo.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
			$("#resultadoBusqueda").html(mensaje);
		});
	} else {
		("#resultadoBusqueda").html('');
	}
}