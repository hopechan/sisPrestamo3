<?php
Class ControladorContrato {
    function numerosDocALetras ($docEnNumeros) {
        $docEnLetras = '';
        $lengthDocEnNumeros = strlen($docEnNumeros);

        for ($i = 0; $i < $lengthDocEnNumeros; $i++) {
            switch (substr($docEnNumeros,$i,1)) {
                case '0':
                    $docEnLetras .= 'CERO';
                    break;
                case '1':
                    $docEnLetras .= 'UNO';
                    break;
                case '2':
                    $docEnLetras .= 'DOS';
                    break;
                case '3':
                    $docEnLetras .= 'TRES';
                    break;
                case '4':
                    $docEnLetras .= 'CUATRO';
                    break;
                case '5':
                    $docEnLetras .= 'CINCO';
                    break;
                case '6':
                    $docEnLetras .= 'SEIS';
                    break;
                case '7':
                    $docEnLetras .= 'SIETE';
                    break;
                case '8':
                    $docEnLetras .= 'OCHO';
                    break;
                case '9': 
                    $docEnLetras .= 'NUEVE';
                    break;
                default:
                    $docEnLetras .= 'guión';
            }

            if ($i != ($lengthDocEnNumeros - 1)) {
                $docEnLetras .= ' ';
            }
        }

        return $docEnLetras;
    }

    function numeros1Al9EnLetras ($numero) {
        $numeroEnLetras = '';
        
        switch($numero) {
            case '1':
                $numeroEnLetras = 'un ';
                break;
            case '2':
                $numeroEnLetras = 'dos ';
                break;
            case '3':
                $numeroEnLetras = 'tres ';
                break;
            case '4':
                $numeroEnLetras = 'cuatro ';
                break;
            case '5':
                $numeroEnLetras = 'cinco ';
                break;
            case '6':
                $numeroEnLetras = 'seis ';
                break;
            case '7':
                $numeroEnLetras = 'siete ';
                break;
            case '8':
                $numeroEnLetras = 'ocho ';
                break;
            case '9': 
                $numeroEnLetras = 'nueve ';
        }

        return $numeroEnLetras;
    }

    function numeros1Al9EnLetrasCuotasFechas ($numero) {
        $numeroEnLetras = '';
        
        switch($numero) {
            case '1':
                $numeroEnLetras = 'uno ';
                break;
            case '2':
                $numeroEnLetras = 'dos ';
                break;
            case '3':
                $numeroEnLetras = 'tres ';
                break;
            case '4':
                $numeroEnLetras = 'cuatro ';
                break;
            case '5':
                $numeroEnLetras = 'cinco ';
                break;
            case '6':
                $numeroEnLetras = 'seis ';
                break;
            case '7':
                $numeroEnLetras = 'siete ';
                break;
            case '8':
                $numeroEnLetras = 'ocho ';
                break;
            case '9': 
                $numeroEnLetras = 'nueve ';
        }

        return $numeroEnLetras;
    }

    //$prefijo es si se quiere poner una palabra antes de los números ("con"), $unión es para treinta "y" tantos, ...
    //... $unidadSingular "centavo", $unidadPlural "centavos"
    function numeros1Al99EnLetras ($numero, $prefijo, $unidadSingular, $unidadPlural) {
        $cContrato = new ControladorContrato();
        
        $decenas = substr($numero, 0, 1);
        $unidades = substr($numero, 1, 1);

        $numeroEnLetras = '';

        if ($decenas != '0' || $unidades != '0') {
            $numeroEnLetras .= $prefijo;
            $numeroEnLetras .= ' ';

            switch($decenas) {
                case '0':
                    $numeroEnLetras .= $cContrato->numeros1Al9EnLetras($unidades);
                    break;
                case '1':
                    switch ($unidades) {
                        case '0':
                            $numeroEnLetras .= 'diez ';
                            break;
                        case '1':
                            $numeroEnLetras .= 'once ';
                            break;
                        case '2':
                            $numeroEnLetras .= 'doce ';
                            break;
                        case '3':
                            $numeroEnLetras .= 'trece ';
                            break;
                        case '4':
                            $numeroEnLetras .= 'catorce ';
                            break;
                        case '5':
                            $numeroEnLetras .= 'quince ';
                            break;
                        case '6':
                            $numeroEnLetras .= 'dieciséis ';
                            break;
                        case '7':
                            $numeroEnLetras .= 'diecisiete ';
                            break;
                        case '8':
                            $numeroEnLetras .= 'dieciocho ';
                            break;
                        case '9': 
                            $numeroEnLetras .= 'diecinueve ';
                    }
                    break;
                case '2':
                    switch ($unidades) {
                        case '0':
                            $numeroEnLetras .= 'veinte ';
                            break;
                        case '1':
                            $numeroEnLetras .= 'veintiún ';
                            break;
                        case '2':
                            $numeroEnLetras .= 'veintidós ';
                            break;
                        case '3':
                            $numeroEnLetras .= 'veintitrés ';
                            break;
                        case '4':
                            $numeroEnLetras .= 'veinticuatro ';
                            break;
                        case '5':
                            $numeroEnLetras .= 'veinticinco ';
                            break;
                        case '6':
                            $numeroEnLetras .= 'veintiséis ';
                            break;
                        case '7':
                            $numeroEnLetras .= 'veintisiete ';
                            break;
                        case '8':
                            $numeroEnLetras .= 'veintiocho ';
                            break;
                        case '9':
                            $numeroEnLetras .= 'veintinueve ';
                            break;
                    }
                    break;
                case '3':
                    $numeroEnLetras .= 'treinta ';
                    break;
                case '4':
                    $numeroEnLetras .= 'cuarenta ';
                    break;
                case '5':
                    $numeroEnLetras .= 'cincuenta ';
                    break;
                case '6':
                    $numeroEnLetras .= 'sesenta ';
                    break;
                case '7':
                    $numeroEnLetras .= 'setenta ';
                    break;
                case '8':
                    $numeroEnLetras .= 'ochenta ';
                    break;
                case '9':
                    $numeroEnLetras .= 'noventa ';
                    break;
            } 

            //añade los números del 1 al 9 en las decenas mayores: [30, 40, ...]
            if ($decenas != '0' && $decenas != '1' && $decenas != '2' && $unidades != 0) {
                $numeroEnLetras .= 'y ';
                $numeroEnLetras .= $cContrato->numeros1Al9EnLetras($unidades);
            }

            //añade "centavo" o "centavos" dependiendo si es uno o más centavos
            if ($decenas == '0' && $unidades == '1') {
                $numeroEnLetras .= $unidadSingular;
                $numeroEnLetras .= ' ';
            } else {
                $numeroEnLetras .= $unidadPlural;
                $numeroEnLetras .= ' ';
            }
        }

        return $numeroEnLetras;
    }

    //$prefijo es si se quiere poner una palabra antes de los números ("con"), $unión es para treinta "y" tantos, ...
    //... $unidadSingular "centavo", $unidadPlural "centavos"
    function numeros1Al99EnLetrasCuotasFechas ($numero, $prefijo, $unidadSingular, $unidadPlural) {
        $cContrato = new ControladorContrato();
        
        $decenas = substr($numero, 0, 1);
        $unidades = substr($numero, 1, 1);

        $numeroEnLetras = '';

        if ($decenas != '0' || $unidades != '0') {
            $numeroEnLetras .= $prefijo;
            $numeroEnLetras .= ' ';

            switch($decenas) {
                case '0':
                    $numeroEnLetras .= $cContrato->numeros1Al9EnLetrasCuotasFechas($unidades);
                    break;
                case '1':
                    switch ($unidades) {
                        case '0':
                            $numeroEnLetras .= 'diez ';
                            break;
                        case '1':
                            $numeroEnLetras .= 'once ';
                            break;
                        case '2':
                            $numeroEnLetras .= 'doce ';
                            break;
                        case '3':
                            $numeroEnLetras .= 'trece ';
                            break;
                        case '4':
                            $numeroEnLetras .= 'catorce ';
                            break;
                        case '5':
                            $numeroEnLetras .= 'quince ';
                            break;
                        case '6':
                            $numeroEnLetras .= 'dieciséis ';
                            break;
                        case '7':
                            $numeroEnLetras .= 'diecisiete ';
                            break;
                        case '8':
                            $numeroEnLetras .= 'dieciocho ';
                            break;
                        case '9': 
                            $numeroEnLetras .= 'diecinueve ';
                    }
                    break;
                case '2':
                    switch ($unidades) {
                        case '0':
                            $numeroEnLetras .= 'veinte ';
                            break;
                        case '1':
                            $numeroEnLetras .= 'veintiún ';
                            break;
                        case '2':
                            $numeroEnLetras .= 'veintidós ';
                            break;
                        case '3':
                            $numeroEnLetras .= 'veintitrés ';
                            break;
                        case '4':
                            $numeroEnLetras .= 'veinticuatro ';
                            break;
                        case '5':
                            $numeroEnLetras .= 'veinticinco ';
                            break;
                        case '6':
                            $numeroEnLetras .= 'veintiséis ';
                            break;
                        case '7':
                            $numeroEnLetras .= 'veintisiete ';
                            break;
                        case '8':
                            $numeroEnLetras .= 'veintiocho ';
                            break;
                        case '9':
                            $numeroEnLetras .= 'veintinueve ';
                            break;
                    }
                    break;
                case '3':
                    $numeroEnLetras .= 'treinta ';
                    break;
                case '4':
                    $numeroEnLetras .= 'cuarenta ';
                    break;
                case '5':
                    $numeroEnLetras .= 'cincuenta ';
                    break;
                case '6':
                    $numeroEnLetras .= 'sesenta ';
                    break;
                case '7':
                    $numeroEnLetras .= 'setenta ';
                    break;
                case '8':
                    $numeroEnLetras .= 'ochenta ';
                    break;
                case '9':
                    $numeroEnLetras .= 'noventa ';
                    break;
            } 

            //añade los números del 1 al 9 en las decenas mayores: [30, 40, ...]
            if ($decenas != '0' && $decenas != '1' && $decenas != '2' && $unidades != 0) {
                $numeroEnLetras .= 'y ';
                $numeroEnLetras .= $cContrato->numeros1Al9EnLetrasCuotasFechas($unidades);
            }

            //añade "centavo" o "centavos" dependiendo si es uno o más centavos
            if ($decenas == '0' && $unidades == '1') {
                $numeroEnLetras .= $unidadSingular;
                $numeroEnLetras .= ' ';
            } else {
                $numeroEnLetras .= $unidadPlural;
                $numeroEnLetras .= ' ';
            }
        }

        return $numeroEnLetras;
    }

    function numeros1Al999EnLetras($numero) {
        $cContrato = new ControladorContrato();
        
        $centenas = substr($numero, 0, 1);
        $decenas = substr($numero, 1, 1);
        $unidades = substr($numero, 2, 1);

        $numeroEnLetras = '';
        
        if ($centenas != '0') {
            switch ($centenas) {
                case '1':
                    if ($decenas == '0' && $unidades == '0') {
                        $numeroEnLetras .= 'cien ';
                    } else {
                        $numeroEnLetras .= 'ciento ';
                    }
                    break;
                case '2':
                    $numeroEnLetras .= 'doscientos ';
                    break;
                case '3':
                    $numeroEnLetras .= 'trescientos ';
                    break;
                case '4':
                    $numeroEnLetras .= 'cuatrocientos ';
                    break;
                case '5':
                    $numeroEnLetras .= 'quinientos ';
                    break;
                case '6':
                    $numeroEnLetras .= 'seiscientos ';
                    break;
                case '7':
                    $numeroEnLetras .= 'setecientos ';
                    break;
                case '8':
                    $numeroEnLetras .= 'ochocientos ';
                    break;
                case '9':
                    $numeroEnLetras .= 'novecientos ';
                    break;
            }
        }

        $numeroEnLetras .= $cContrato->numeros1Al99EnLetras($decenas . $unidades, '', '', '');

        return $numeroEnLetras;
    }

    function numeros1Al999EnLetrasCuotasFechas($numero) {
        $cContrato = new ControladorContrato();
        
        $centenas = substr($numero, 0, 1);
        $decenas = substr($numero, 1, 1);
        $unidades = substr($numero, 2, 1);

        $numeroEnLetras = '';
        
        if ($centenas != '0') {
            switch ($centenas) {
                case '1':
                    if ($decenas == '0' && $unidades == '0') {
                        $numeroEnLetras .= 'cien ';
                    } else {
                        $numeroEnLetras .= 'ciento ';
                    }
                    break;
                case '2':
                    $numeroEnLetras .= 'doscientos ';
                    break;
                case '3':
                    $numeroEnLetras .= 'trescientos ';
                    break;
                case '4':
                    $numeroEnLetras .= 'cuatrocientos ';
                    break;
                case '5':
                    $numeroEnLetras .= 'quinientos ';
                    break;
                case '6':
                    $numeroEnLetras .= 'seiscientos ';
                    break;
                case '7':
                    $numeroEnLetras .= 'setecientos ';
                    break;
                case '8':
                    $numeroEnLetras .= 'ochocientos ';
                    break;
                case '9':
                    $numeroEnLetras .= 'novecientos ';
                    break;
            }
        }

        $numeroEnLetras .= $cContrato->numeros1Al99EnLetrasCuotasFechas($decenas . $unidades, '', '', '');

        return $numeroEnLetras;
    }

    function cantidadDineroALetras($cantidadDinero) {
        $cContrato = new ControladorContrato();
        
        $numeroEnLetras = '';

        $hayPuntoEnLaCantidad = strpos($cantidadDinero, '.');

        $tempCantidadDinero = $cantidadDinero;
        
        if ($hayPuntoEnLaCantidad === false) {
            $cantidadDinero = str_pad($tempCantidadDinero, 6, '0', STR_PAD_LEFT);
            $unidades = substr($cantidadDinero, 5, 1);
            $decenas = substr($cantidadDinero, 4, 1);
            $centenas = substr($cantidadDinero, 3, 1);
            $unidadesDeMillar = substr($cantidadDinero, 2, 1);
            $decenasDeMillar = substr($cantidadDinero, 1, 1);
            $centenasDeMillar = substr($cantidadDinero, 0, 1);
        } else {
            $cantidadDinero = str_pad($tempCantidadDinero, 9, '0', STR_PAD_LEFT);
            $unidades = substr($cantidadDinero, 5, 1);
            $decenas = substr($cantidadDinero, 4, 1);
            $centenas = substr($cantidadDinero, 3, 1);
            $unidadesDeMillar = substr($cantidadDinero, 2, 1);
            $decenasDeMillar = substr($cantidadDinero, 1, 1);
            $centenasDeMillar = substr($cantidadDinero, 0, 1);
            $decenasCentavos = substr($cantidadDinero, 7, 1);
            $unidadesCentavos = substr($cantidadDinero, 8, 1);
        }

        $numeroEnLetras .= $cContrato->numeros1Al999EnLetras($centenasDeMillar . $decenasDeMillar . $unidadesDeMillar);

        if ($centenasDeMillar != '0' || $decenasDeMillar != '0' || $unidadesDeMillar != '0') {
            $numeroEnLetras .= 'mil ';
        }

        $numeroEnLetras .= $cContrato->numeros1Al999EnLetras($centenas . $decenas . $unidades);

        if ($centenasDeMillar == '0' && $decenasDeMillar == '0' && $unidadesDeMillar == '0' && $centenas == '0' && $decenas == '0' &&  $unidades== '1') {
            $unidadMoneda = 'dolar ';
        } else if($centenasDeMillar == '0' && $decenasDeMillar == '0' && $unidadesDeMillar == '0' && $centenas == '0' && $decenas == '0' &&  $unidades== '0') {
            $unidadMoneda = '';
        } else {
            $unidadMoneda = 'dólares ';
        }

        $numeroEnLetras .= $unidadMoneda;

        if ($hayPuntoEnLaCantidad != false) {
            if ($unidadMoneda == 'dolar ' || $unidadMoneda == 'dólares ') {
                $numeroEnLetras .= $cContrato->numeros1Al99EnLetras($decenasCentavos . $unidadesCentavos, 'con', 'centavo', 'centavos');
            } else {
                $numeroEnLetras .= $cContrato->numeros1Al99EnLetras($decenasCentavos . $unidadesCentavos, '', 'centavo', 'centavos');
            }
        }

        return $numeroEnLetras; 
    }

    function cantidadDineroALetrasCuotasFechas($cantidadDinero) {
        $cContrato = new ControladorContrato();
        
        $numeroEnLetras = '';

        $tempCantidadDinero = $cantidadDinero;
        
        $cantidadDinero = str_pad($tempCantidadDinero, 6, '0', STR_PAD_LEFT);
        $unidades = substr($cantidadDinero, 5, 1);
        $decenas = substr($cantidadDinero, 4, 1);
        $centenas = substr($cantidadDinero, 3, 1);
        $unidadesDeMillar = substr($cantidadDinero, 2, 1);
        $decenasDeMillar = substr($cantidadDinero, 1, 1);
        $centenasDeMillar = substr($cantidadDinero, 0, 1);

        $numeroEnLetras .= $cContrato->numeros1Al999EnLetrasCuotasFechas($centenasDeMillar . $decenasDeMillar . $unidadesDeMillar);

        if ($centenasDeMillar != '0' || $decenasDeMillar != '0' || $unidadesDeMillar != '0') {
            $numeroEnLetras .= 'mil ';
        }

        $numeroEnLetras .= $cContrato->numeros1Al999EnLetrasCuotasFechas($centenas . $decenas . $unidades);

        return $numeroEnLetras; 
    }

    //formato: AAAA-MM-DD
    function fechaALetras($fecha) {
        $cContrato = new ControladorContrato();

        $fechaEnLetras = '';

        $day = substr($fecha, -2, 2);
        $month = substr($fecha, -5, 2);
        $year = substr($fecha, -10, 4);

        $fechaEnLetras .= $cContrato->numeros1Al99EnLetrasCuotasFechas($day, '', '', '');
        $fechaEnLetras .= 'de ';

        switch($month) {
            case '01':
                $monthInLetters = 'enero ';
                break;
            case '02':
                $monthInLetters = 'febrero ';
                break;
            case '03':
                $monthInLetters = 'marzo ';
                break;
            case '04':
                $monthInLetters = 'abril ';
                break;
            case '05':
                $monthInLetters = 'mayo ';
                break;
            case '06':
                $monthInLetters = 'junio ';
                break;
            case '07':
                $monthInLetters = 'julio ';
                break;
            case '08':
                $monthInLetters = 'agosto ';
                break;
            case '09':
                $monthInLetters = 'septiembre ';
                break;
            case '10':
                $monthInLetters = 'octubre ';
                break;
            case '11':
                $monthInLetters = 'noviembre ';
                break;
            case '12':
                $monthInLetters = 'diciembre ';
                break;
        }
        
        $fechaEnLetras .= $monthInLetters;

        $fechaEnLetras .= 'de ';

        $fechaEnLetras .= $cContrato->cantidadDineroALetrasCuotasFechas($year);


        return $fechaEnLetras;
    }
}