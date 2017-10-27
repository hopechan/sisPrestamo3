function anadirEtiqueta() {
    var plantillaContrato = document.getElementById("plantillaContrato")
    var etiqueta = '<' + document.activeElement.value + '>'

    plantillaContrato.value += etiqueta

    plantillaContrato.focus()
}