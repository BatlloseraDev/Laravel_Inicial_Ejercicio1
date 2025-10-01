<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class ControlladorEjercicio extends Controller
{
    function calcularMonedasGetJSON(Request $request)
    {
        $cantidad = $request->get('cantidad');
        $cantidad = abs($cantidad * 100);
        $monedas = [];

        if ($cantidad > 200) {
            $monedas["monedas2€"] = intval($cantidad / 200);
            $cantidad = $cantidad % 200;
        }

        if ($cantidad > 100) {
            $monedas["monedas1€"] = intval($cantidad / 100);
            $cantidad = $cantidad % 100;
        }

        if ($cantidad > 50) {
            $monedas["monedas50cent"] = intval($cantidad / 50);
            $cantidad = $cantidad % 50;
        }
        if ($cantidad > 20) {
            $monedas["monedas20cent"] = intval($cantidad / 20);
            $cantidad = $cantidad % 20;
        }
        if ($cantidad > 10) {
            $monedas["monedas10cent"] = intval($cantidad / 10);
            $cantidad = $cantidad % 10;
        }
        if ($cantidad > 5) {
            $monedas["monedas5cent"] = intval($cantidad / 5);
            $cantidad = $cantidad % 5;
        }
        if ($cantidad > 2) {
            $monedas["monedas2cent"] = intval($cantidad / 2);
            $cantidad = $cantidad % 2;
        }
        if ($cantidad >= 1) {
            $monedas["monedas1cent"] = intval($cantidad / 1);

        }

        return response()->json($monedas);
    }

    function calcularEdad(Request $request, $fechaNacimiento, $fechaActual = null)
    {
        try {
            if ($fechaActual == null) {
                $fechaActual = date('Y-m-d');
            }
            $nacimiento = new DateTime($fechaNacimiento);
            $actual = new DateTime($fechaActual);

            $diferencia = $actual->diff($nacimiento);
            $edad = $diferencia->y;


            return response()->json(["fecha_nacimiento" => $fechaNacimiento, "fecha_actual" => $fechaActual, "edad" => $edad]);
        } catch (\Exception $e) {
            return response()->json(["error" => "Formato de fecha incorrecto. Usa el formato YYYY-MM-DD"], 400);
        }
    }


    function sumaDigitos(Request $request, $numero1, $numero2 = null)
    {
        try{
            if($numero2== null){
                $suma = $this->sumarLosDigitos($numero1);
                return response()->json(["Resultado"=> $suma],200);
            }
            else{
                $suma1 = $this->sumarLosDigitos($numero1);
                $suma2 = $this->sumarLosDigitos($numero2);
                $mayor = $suma1> $suma2 ? $numero1 : $numero2;
                $resultado = $suma1 > $suma2 ? $suma1 : $suma2 ;

                return response()->json(["El numero mayor es"=>$mayor,"resultado"=> $resultado],200);
            }


        }
        catch (\Exception $e) {
            return response()->json(["error"=> "Algo sucedio mal"], 400);
        }
    }

    private function sumarLosDigitos($numero)
    {
        $numero = ((int) $numero)*10;
        $valores = [];

        while ($numero > 0) {
            $valores[] = $numero % 10;
            $numero = $numero / 10;
        }

        $resultado= 0;

        foreach ($valores as $value) {
            $resultado += $value;
        }
        return $resultado;
    }    
}
