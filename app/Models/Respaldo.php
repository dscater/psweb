<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Respaldo extends Model
{
    use HasFactory;

    protected $fillable = ["ruta"];

    public function crearBackup()
    {

        $respaldos = Respaldo::all();

        $dbhost = config('database.connections.mysql.host');
        $dbport = config('database.connections.mysql.port');
        $dbname = config('database.connections.mysql.database');
        $dbuser = config('database.connections.mysql.username');
        $dbpass = config('database.connections.mysql.password');

        $fecha = date("Y-m-d");
        $hora = date("H:i");

        $ruta_mysql = "C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin";
        $file_name = $dbname . '_' . str_replace("-", "_", $fecha) . "_" . str_replace(":", "_", $hora) . '.sql';
        $dbfile = public_path("/backups/" . $file_name);
        Log::debug($dbfile);
        Log::debug("----------------------------");


        if (count($respaldos) > 0) {
            if ($respaldos[0]) {
                $ruta_mysql = $respaldos[0]->ruta;
            }
            if ($respaldos[1]) {
                $dbfile = $respaldos[1]->ruta;
                $dbfile .= "\\" . $file_name;
            }
        }

        //save file
        $path_mysqldump = $ruta_mysql;
        Log::debug($dbfile);
        $mysqldump = $path_mysqldump . "\mysqldump";
        if ($path_mysqldump == "") {
            $mysqldump = "mysqldump";
        }
        $command = "$mysqldump -u$dbuser $dbname > $dbfile";
        if ($dbpass != "") {
            $command = "$mysqldump -u$dbuser -p$dbpass $dbname > $dbfile";
        }
        exec($command, $output, $worked);
        switch ($worked) {
            case 0:
                Log::debug('La base de datos <b>' . $dbname . '</b> se ha almacenado correctamente en la siguiente ruta ' .  $dbfile . '</b>');
                break;
            case 1:
                Log::debug('Se ha producido un error al exportar <b>' . $dbname . '</b> a ' .  $dbfile . '</b>');
                break;
            case 2:
                Log::debug('Se ha producido un error de exportación, compruebe la siguiente información: <br/><br/><table><tr><td>Nombre de la base de datos:</td><td><b>' . $dbname . '</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' . $dbuser . '</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' . $dbhost . '</b></td></tr></table>');
                break;
        }

        if ($worked == 0) {
            RespaldoDb::create([
                "nombre" => $file_name,
                "fecha" => $fecha,
                "hora" => $hora,
            ]);
            return true;
        }
        return false;
    }
}
