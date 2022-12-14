<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Spatie\Backup\BackupDestination\BackupDestination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\bitacora;

class backupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar backup|borrar backup',['only'=>['index']]);
        $this->middleware('permission:borrar backup',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $file_name = str_replace(config('backup.backup.name') . '/', '', $f);
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($f)),
                    'created_at' => Carbon::parse($disk->lastModified($f))->diffForHumans(),
                    'download_link' => action([backupController::class, 'download'], [$file_name]),
                ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view ('seguridad.backups.index', compact('backups'));
    }

    private function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Artisan::queue('backup:run', ['--only-db' => 1]);
        $bitacora = new bitacora;
        $bitacora -> usr = auth()->user()->name;
        $bitacora -> tabla = 'Backup';
        $bitacora -> evento = 'Registro';
        $bitacora -> fecha_registro = now();
        $bitacora -> campo_1 = 'Se registro un nuevo backup';
        $bitacora -> save();
        return back();
    }

    public function download($file_name)
    {
        $path = Storage::disk('public')->path($file_name);

        return response()->download($path);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cod_detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
        }
        return back();
    }
    private function isBackupDisk(string $diskName)
    {
        return in_array($diskName, config('backup.backup.destination.disks'));
    }

    public function exportar()
    {
        $ubicacionArchivoTemporal = getcwd() . DIRECTORY_SEPARATOR . "Respaldo_" . uniqid(date("Y-m-d") . "_", true) . ".sql";
        
        $salida = "";
        
        $codigoSalida = 0;
        
        $comando = sprintf("%s --user=\"%s\" --password=\"%s\" %s > %s", env("UBICACION_MYSQLDUMP"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_DATABASE"), $ubicacionArchivoTemporal);
        
        exec($comando, $salida, $codigoSalida);
        if ($codigoSalida !== 0) {
            return "C??digo de salida distinto de 0, se obtuvo c??digo (" . $codigoSalida . "). Revise los ajustes e intente de nuevo";
        }

        return response()->download($ubicacionArchivoTemporal)->deleteFileAfterSend(true);
    }

    public function importar()
    {
        return redirect()->route('backups.index')->with('succes', 'Ok');
    }
}