<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Ingreso;
use App\Models\Salida;

use PDF;

class Reporte extends Model
{
    public static function kardex($fecha_ini, $fecha_fin, $producto = 0)
    {
        $empresa = Empresa::first();
        //obtener las fechas de los ingresos
        $ingresos_fecha = Ingreso::whereBetween('fecha_ingreso', [$fecha_ini, $fecha_fin])
            ->orderBy('fecha_ingreso', 'ASC')->get();
        //obtener las fechas de las salidas
        $salidas_fecha = Salida::whereBetween('fecha_salida', [$fecha_ini, $fecha_fin])
            ->orderBy('fecha_salida', 'ASC')->get();
        $fechas = [];
        foreach ($ingresos_fecha as $value) {
            $fechas[] = $value->fecha_ingreso;
        }
        foreach ($salidas_fecha as $value) {
            $fechas[] = $value->fecha_salida;
        }
        //convertir el array con las fechas unicas
        $fechas = array_unique($fechas);
        usort($fechas, ['App\Models\Reporte', 'ordenar']);

        $productos = Producto::where('status', '=', 1)->get();
        if ($producto != 0) {
            $productos = Producto::where('status', '=', 1)
                ->where('id', '=', $producto)->get();
        }

        $array_kardex = [];
        foreach ($productos as $prod) {
            $saldo_cantidad = 0;
            $saldo_precio = 0;
            foreach ($fechas as $key => $fecha) {
                //OBTENER SALDO ANTERIOR
                $reporte = new Reporte();
                $saldo_anterior = $reporte->obtiene_saldoAnterior(date('Y-m-d', strtotime($fecha . '- 1 day')), $prod->id);
                if ($saldo_anterior['cantidad'] > 0 && $key == 0) {
                    $saldo_cantidad = $saldo_anterior['cantidad'];
                    $saldo_precio = $saldo_anterior['precio'];
                    $array_kardex[$prod->id][] = [
                        'fecha' => date('Y-m-d', strtotime($fecha . '- 1 day')),
                        'detalle' => 'SALDO ANTERIOR',
                        'ingreso' => '',
                        'salida' => '',
                        'saldo' => $saldo_cantidad,
                        'cu' => $prod->precio,
                        'ingreso2' => '',
                        'salida2' => '',
                        'saldo2' => number_format($saldo_precio, 2, '.', ','),
                    ];
                }

                // obtener los registros de esta fecha
                $ingresos = Ingreso::where('producto_id', '=', $prod->id)
                    ->where('fecha_ingreso', '=', $fecha)
                    ->orderBy('fecha_ingreso', 'ASC')->get();
                $salidas = Salida::where('producto_id', '=', $prod->id)
                    ->where('fecha_salida', '=', $fecha)
                    ->orderBy('fecha_salida', 'ASC')->get();

                // armar el array con la inforamción
                foreach ($ingresos as $value) {
                    $saldo_cantidad = $saldo_cantidad + $value->cantidad;
                    $saldo_precio = $saldo_precio + $value->cantidad * $prod->precio;
                    $array_kardex[$prod->id][] = [
                        'fecha' => $value->fecha_ingreso,
                        'detalle' => 'INGRESO DE ' . $prod->nom,
                        'ingreso' => $value->cantidad,
                        'salida' => '0',
                        'saldo' => $saldo_cantidad,
                        'cu' => $prod->precio,
                        'ingreso2' => number_format($value->cantidad * $prod->precio, 2, '.', ','),
                        'salida2' => '0',
                        'saldo2' => number_format($saldo_precio, 2, '.', ','),
                    ];
                }
                foreach ($salidas as $value) {
                    $saldo_cantidad = $saldo_cantidad - $value->cantidad;
                    $saldo_precio = $saldo_precio - $value->cantidad * $prod->precio;
                    $array_kardex[$prod->id][] = [
                        'fecha' => $value->fecha_salida,
                        'detalle' => 'SALIDA DE ' . $prod->nom,
                        'ingreso' => '0',
                        'salida' => $value->cantidad,
                        'saldo' => $saldo_cantidad,
                        'cu' => $prod->precio,
                        'ingreso2' => '0',
                        'salida2' => number_format($value->cantidad * $prod->precio, 2, '.', ','),
                        'saldo2' => number_format($saldo_precio, 2, '.', ','),
                    ];
                }
            }
        }

        $pdf = PDF::loadView('reportes.r_kardexInventario', compact('productos', 'array_kardex', 'empresa', 'fecha_ini', 'fecha_fin'))->setPaper('letter', 'landscape');
        return $pdf->stream('KardexInventario.pdf');
    }

    public function obtiene_saldoAnterior($fecha, $producto)
    {
        $prod = Producto::where('id', $producto)->get()->first();
        $ingreso1 = Ingreso::where('producto_id', '=', $producto)->get()->first();
        $fecha1 = $ingreso1->fecha_ingreso;
        //obtener las fechas de los ingresos
        $ingresos_fecha = Ingreso::whereBetween('fecha_ingreso', [$fecha1, $fecha])->get();
        //obtener las fechas de las salidas
        $salidas_fecha = Salida::whereBetween('fecha_salida', [$fecha1, $fecha])->get();
        $fechas = [];
        foreach ($ingresos_fecha as $value) {
            $fechas[] = $value->fecha_ingreso;
        }
        foreach ($salidas_fecha as $value) {
            $fechas[] = $value->fecha_salida;
        }

        $fechas = array_unique($fechas);

        $saldo_cantidad = 0;
        $saldo_precio = 0;
        foreach ($fechas as $fecha) {
            // obtener los registros de esta fecha
            $ingresos = Ingreso::where('producto_id', '=', $prod->id)
                ->where('fecha_ingreso', '=', $fecha)
                ->orderBy('fecha_ingreso', 'ASC')->get();
            $salidas = Salida::where('producto_id', '=', $prod->id)
                ->where('fecha_salida', '=', $fecha)
                ->orderBy('fecha_salida', 'ASC')->get();

            // armar el array con la inforamción
            foreach ($ingresos as $value) {
                $saldo_cantidad = $saldo_cantidad + $value->cantidad;
                $saldo_precio = $saldo_precio + $value->cantidad * $prod->precio;
            }
            foreach ($salidas as $value) {
                $saldo_cantidad = $saldo_cantidad - $value->cantidad;
                $saldo_precio = $saldo_precio - $value->cantidad * $prod->precio;
            }
        }
        $array_saldo = [
            'cantidad' => $saldo_cantidad,
            'precio' => $saldo_precio,
        ];
        return $array_saldo;
    }

    private static function ordenar($a, $b)
    {
        return strtotime($a) - strtotime($b);
    }
}
