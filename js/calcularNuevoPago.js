function calcularNuevoPago() {
    var monto = eval(document.getElementById("monto").value);
    var saldo_anterior = eval(document.getElementById("saldo_anterior").value);
    var cuota = eval(document.getElementById("cuota").value);
    var tasa = eval(document.getElementById("tasa").value);
    var capitalizacion = document.getElementById("capitalizacion").value;
    var fecha_ultimo_pago = document.getElementById("fecha_ultimo_pago").value;
    var tasa_mora = document.getElementById("tasa_mora").value;
    var num_cuota = document.getElementById("num_cuota").value;
    var hoy = new Date(document.getElementById("fecha").value).getTime(); //fecha de hoy
    var fecha = new Date(document.getElementById("fecha_ultimo_pago").value).getTime();

    var fecha_inicio = new Date(document.getElementById("fecha_inicio").value);
    var hoy2 = new Date(document.getElementById("fecha").value); //fecha de hoy
    var fecha2 = new Date(document.getElementById("fecha_ultimo_pago").value);

    var hoy2_month = hoy2.getMonth() + 1;
    var fecha_inicio_month = fecha_inicio.getMonth() + 1;
    var hoy2_year = hoy2.getFullYear();
    var fecha2_month = fecha2.getMonth() + 1;
    var fecha2_year = fecha2.getFullYear();
    var fecha_inicio_year = fecha_inicio.getFullYear();

    var meses=0;
    var anios=0;
    if (fecha2_year == hoy2_year) {
      meses = hoy2_month - fecha2_month;
    } else {
      anios = hoy2_year - fecha2_year;
      meses = (12*anios-fecha2_month)+hoy2_month;
    }


    var n = (hoy-fecha)/(1000*60*60*24);

    var m = Math.ceil(n/30);
    var t = tasa/100;
    //Sale igual que en excel :v
    var tasa_diaria = (t*12)/365;
    var porcentaje_mora = tasa_mora/100;
    var mora_diaria = (porcentaje_mora*12)/365;
    var dias_mora = 0;
    if (n>30) {
      dias_mora = n - 30;
    }


    if (capitalizacion == "D") {
      if (n > 0) {
        //Para la capitalizacion diaria aun tengo dudas con la formula
        var interes = (saldo_anterior * tasa_diaria) * n;
        var mora = (saldo_anterior * mora_diaria) * dias_mora;
        var capital = cuota - interes - mora;
        var saldo_actualizado = saldo_anterior - capital;
        mora = mora.toFixed(2);
        saldo_actualizado = saldo_actualizado.toFixed(2)
        interes = interes.toFixed(2);
        capital = capital.toFixed(2);
        if (capital > saldo_anterior) {
          document.getElementById("cuota").value = (saldo_anterior*(1 + (tasa_diaria * n)+(mora_diaria*dias_mora))).toFixed(2);
          document.getElementById("saldoNuevo").value = 0;
          cuota = document.getElementById("cuota").value;
          interes = (saldo_anterior * tasa_diaria) * n;
          interes = interes.toFixed(2);
          //mora = (saldo_anterior * mora_diaria) * dias_mora;
          //mora = mora.toFixed(2);
          capital = cuota - interes - mora;
          capital = capital.toFixed(2);
          saldo_actualizado = 0;
        }
      } else {
         //Si se da mas de un pago el mismo día solo se cobra interes al primer pago
        var saldo_actualizado = saldo_anterior - cuota;
        var interes = 0;
        var mora = 0;
        var capital = cuota;
        if (capital > saldo_anterior) {
          capital = saldo_anterior;
          cuota = capital;
          document.getElementById("cuota").value = capital;
          document.getElementById("saldoNuevo").value = 0;
          saldo_actualizado = 0;
        }
      }
    }

    if (capitalizacion == 'M') {
      if (meses != 0) {
        var interes = (saldo_anterior * t) * meses;
        var mora = (saldo_anterior * mora_diaria) * (dias_mora);
        var capital = cuota - interes - mora;
        var saldo_actualizado = saldo_anterior - capital;

        mora = mora.toFixed(2);
        saldo_actualizado = saldo_actualizado.toFixed(2)
        interes = interes.toFixed(2);
        capital = capital.toFixed(2);
        if (capital > saldo_anterior) {
          document.getElementById("cuota").value = (saldo_anterior *(1 + (t * meses)+(mora_diaria*dias_mora))).toFixed(2);
          document.getElementById("saldoNuevo").value = 0;
          cuota = document.getElementById("cuota").value;
          interes = (saldo_anterior * t) * meses;
          interes = interes.toFixed(2);
          capital = cuota - interes - mora;
          capital = capital.toFixed(2);
          saldo_actualizado = 0;
        }
      } else {
        //Si se da mas de un pago el mismo mes solo se cobra interes al primer pago
        if((hoy2_month == fecha_inicio_month) && (hoy2_year == fecha_inicio_year) && (num_cuota == 1)) {
          var interes = (saldo_anterior * t);
          var mora = 0;
          var capital = cuota - interes - mora;
          var saldo_actualizado = saldo_anterior - capital;

          saldo_actualizado = saldo_actualizado.toFixed(2)
          interes = interes.toFixed(2);
          capital = capital.toFixed(2);
          if (capital > saldo_anterior) {
            document.getElementById("cuota").value = (saldo_anterior *(1 + (t)+(mora_diaria*dias_mora))).toFixed(2);
            document.getElementById("saldoNuevo").value = 0;
            cuota = document.getElementById("cuota").value;
            interes = (saldo_anterior * t);
            interes = interes.toFixed(2);
            capital = cuota - interes - mora;
            capital = capital.toFixed(2);
            saldo_actualizado = 0;
          }
        } else {
          var saldo_actualizado = saldo_anterior - cuota;
          saldo_actualizado = saldo_actualizado.toFixed(2);

          interes = 0;
          mora = 0;
          var capital = cuota;
          if (capital > saldo_anterior) {
          capital = saldo_anterior;
          cuota = capital;
          document.getElementById("cuota").value = capital;
          document.getElementById("saldoNuevo").value = 0;
          saldo_actualizado = 0;
        }
       }
      }
    }

    //Mostrar las Operaciones
    document.getElementById("saldoNuevo").value = saldo_actualizado;
    document.getElementById("interes").value = interes;
    document.getElementById("capital").value = capital;
    document.getElementById("mora").value = mora;
  }
