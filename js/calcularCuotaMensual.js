 //Metodo para sumar meses al prestamo
Date.prototype.sumar = function(year, month, day, meses) {
  f = new Date(year, month, day);
  f.setMonth(f.getMonth() + meses);
  return f;
}

function calcularCuotaMensual() {
	var monto = eval(document.getElementById("monto").value);
	var num_cuotas = eval(document.getElementById("num_cuotas").value);
	var interes = eval(document.getElementById("interes").value);
  	var year = new Date(document.getElementById("fecha_inicio").value).getFullYear();
    var month = new Date(document.getElementById("fecha_inicio").value).getMonth() + 1;
    var day = new Date(document.getElementById("fecha_inicio").value).getDate() + 1;
	var interes_real = interes / 100;
	var numerador =interes_real*Math.pow(interes_real + 1,num_cuotas);
	var denominador = Math.pow(interes_real + 1,num_cuotas) - 1;
	var valorcuota = monto*(numerador/denominador);
	valorcuota = valorcuota.toFixed(2);
	var meses = num_cuotas;

	//Se toma la fecha actual y se le suma la cantidad de dias del prestamo
	var f = new Date();
	var fecha = f.sumar(year, month, day, meses);
	//Recupero el valor del dia-mes-año de la finalizacion del prestamo
	var mes = fecha.getMonth() + 1; //El mes se maneja [0-11]
	var dia = fecha.getDate();
	var anio = fecha.getFullYear();

	//String con la fecha de finalizacion con formato MM/DD/YYYY
	var fecha_fin = anio + "-" + mes + "-" + dia;

	document.getElementById("valor_cuota").value=valorcuota;
	document.getElementById("fecha_fin").value=fecha_fin ;
}
