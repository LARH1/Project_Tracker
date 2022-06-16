<?php

namespace App\Http\Controllers\Utils;

use Exception;

class Fecha
{

    /**
     * Obtiene el nombre del mes a partir del numero
     * @param int $n_mes No. del mes
     */
    public static function NombreMesNumero($n_mes)
    {
        try
        {
            $n = intval($n_mes);
            $meses = [
                "", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                "Octubre", "Noviembre", "Diciembre"
            ];
            return $meses[$n];
        }
        catch (Exception $e)
        {
            dd($e);
            return "ERROR";
        }
    }

    /**
     * Obtiene el nombre del mes a partir de una fecha
     * @param int $n_mes No. del mes
     */
    public static function NombreMesFecha($fecha)
    {
        try
        {
            $n_mes = substr($fecha, 5, 2);
            return self::NombreMesNumero($n_mes);
        }
        catch (Exception $e)
        {
            dd($e);
            return "ERROR";
        }
    }

    /**
     * Convertir la fecha ingresada en texto
     * @param $fecha Fecha a mostrar en formato YYY-mm-dd
     * @param $separador string Carcater para usar como separador (Ejem: / - )
     * @param $conector1 string palabra para unir el día y el mes
     * @param $conector2 string palabra para unir el mes y el año
     */
    public static function FechaCompleta($fecha, $separador = "/", $conector1 = "-", $conector2 = "-")
    {
        $dts = explode($separador, $fecha, 3);
        $mes = self::NombreMesNumero($dts[1]);
        $f = $dts[2] . $conector1 . $mes . $conector2 . $dts[0];
        return $f;
    }
}
