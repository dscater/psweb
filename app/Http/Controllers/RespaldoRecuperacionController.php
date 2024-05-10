<?php

namespace App\Http\Controllers;

use App\Models\Respaldo;
use App\Models\RespaldoDb;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PDO;

class RespaldoRecuperacionController extends Controller
{
    public function index()
    {
        $respaldos_db = RespaldoDb::orderBy("created_at", "desc")->paginate(20);
        // return $respaldos_db;
        return view("respaldo_recuperacions.index", compact("respaldos_db"));
    }

    public function cargaRecuperacion(RespaldoDb $respaldoDb)
    {
        $respaldos = Respaldo::all();
        $ruta_backups =  public_path("/backups/");
        if ($respaldos[1]) {
            $ruta_backups =  $respaldos[1];
        }

        $ruta = $ruta_backups->ruta . "\\" . $respaldoDb->nombre;
        $file = new File($ruta);
        $extension = '.' . pathinfo($ruta, PATHINFO_EXTENSION);
        $delimiter = ';';

        $db_host = env('DB_HOST', '127.0.0.1');
        $user = env('DB_USERNAME', 'root');
        $pass = env('DB_PASSWORD', '');
        $dbname = config('database.connections.mysql.database');

        $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        $cadena_conexion = "mysql:host=" . $db_host . ";dbname=" . $dbname;
        $conexion = new PDO($cadena_conexion, $user, $pass, $opciones);

        if ($extension == '.sql') {
            set_time_limit(0);

            try {
                $proceso = "";
                if (is_file($file) === true) {
                    $file = fopen($file, 'r');

                    if (is_resource($file) === true) {
                        $query = array();

                        while (feof($file) === false) {
                            $query[] = fgets($file);

                            if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {
                                $query = trim(implode('', $query));

                                if ($conexion->query($query)) {
                                    $proceso .= '<p><strong class="text-green">CORRECTO:</strong> ' . $query . '</p>';
                                } else {
                                    $proceso .= '<p><strong class="text-red">FALLO:</strong> ' . $query . '</p>';
                                }

                                while (ob_get_level() > 0) {
                                    ob_end_flush();
                                }

                                flush();
                            }

                            if (is_string($query) === true) {
                                $query = array();
                            }
                        }

                        fclose($file);
                        return response()->JSON(["sw" => true, 'message' => 'La base de datos se importo correctamente', 'proceso' => $proceso]);
                    }
                }
            } catch (\Exception $e) {
                return response()->JSON(["sw" => false, 'message', 'Algo salio mal intente nuevamente. ' . $e->getMessage()], 500);
            }
        }
        return response()->JSON([
            "sw" => false,
            'message', 'Algo salio mal. Parece que no esta enviando un archivo correcto, por favor revise que la extensión del archivo sea correcto'
        ], 401);
    }
}
