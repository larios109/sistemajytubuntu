<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

//Controllers personas
use App\Http\Controllers\personas\personasController;
use App\Http\Controllers\personas\clienteController;
use App\Http\Controllers\personas\direccionController;
use App\Http\Controllers\personas\companiaController;
use App\Http\Controllers\personas\correosController;
use App\Http\Controllers\personas\telefonosController;

// Controllers materia prima
use App\Http\Controllers\materiaprima\materiaentranteController;
use App\Http\Controllers\materiaprima\materiasalienteController;

// Controllers productos
use App\Http\Controllers\productos\categoriaController;
use App\Http\Controllers\productos\otrosinsumosController;
use App\Http\Controllers\productos\listaproductoController;
use App\Http\Controllers\productos\inventarioController;

// Controllers ventas
use App\Http\Controllers\solicitudpedidos\detallesolicitudController;
use App\Http\Controllers\solicitudpedidos\solicitudpedidosController;

// Controllers empleado
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\empleados\pagosalarioController;

// Controllers seguridad
use App\Http\Controllers\seguridad\bitacoraController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\seguridad\preguntasController;

// Controllers reportes
use App\Http\Controllers\reportes\rsolicitudpedidosController;
use App\Http\Controllers\reportes\rproductosController;
use App\Http\Controllers\reportes\rotrosinsumosController;
use App\Http\Controllers\reportes\rmateriasalienteController;
use App\Http\Controllers\reportes\rempleadosController;
use App\Http\Controllers\reportes\rsalariosController;
use App\Http\Controllers\reportes\rtelefonoscorreosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route personas
Route::resource('personas',personasController::class)->names('personas');
Route::resource('cliente',clienteController::class)->names('cliente');
Route::resource('direccion',direccionController::class)->names('direccion');
Route::resource('compania',companiaController::class)->names('compania');
Route::resource('correos',correosController::class)->names('correos');
Route::resource('telefonos',telefonosController::class)->names('telefonos');

// Route Materia Prima
Route::resource('materiaentrante',materiaentranteController::class)->names('materiaentrante');
Route::resource('materiasaliente',materiasalienteController::class)->names('materiasaliente');

// Route productos
Route::resource('categoria',categoriaController::class)->names('categoria');
Route::resource('otrosinsumos',otrosinsumosController::class)->names('otrosinsumos');
Route::resource('listaproductos',listaproductoController::class)->names('listaproductos');
Route::resource('inventario',inventarioController::class)->names('inventario');

// Route ventas
Route::resource('detallesolicitud',detallesolicitudController::class)->names('detallesolicitud');
Route::resource('solicitudpedidos',solicitudpedidosController::class)->names('solicitudpedidos');

// Route empleados
Route::resource('pagosalario',pagosalarioController::class)->names('pagosalario');
Route::resource('usuarios',UsuarioController::class)->names('usuarios');

// Route seguridad
Route::resource('bitacora',bitacoraController::class)->names('bitacora');
Route::resource('roles',RolController::class)->names('roles');
Route::resource('preguntas',preguntasController::class)->names('preguntas');

// Route reportes
Route::resource('reportesolicitud',rsolicitudpedidosController::class)->names('reportesolicitud');
Route::resource('reporteproductos',rproductosController::class)->names('reporteproductos');
Route::resource('reportempleado',rempleadosController::class)->names('reportempleado');
Route::resource('reportesalarios',rsalariosController::class)->names('reportesalarios');
Route::resource('rmateriasaliente',rmateriasalienteController::class)->names('rmateriasaliente');
Route::resource('rotrosinsumos',rotrosinsumosController::class)->names('rotrosinsumos');
Route::resource('telefonoscorreos',rtelefonoscorreosController::class)->names('telefonoscorreos');