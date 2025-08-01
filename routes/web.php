<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bandacontroller;
use App\Http\Controllers\sesioncontroller;
use App\Http\Controllers\ventbolcontroller;
use App\Http\Controllers\boletoscontroller;


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
    return view('welcome');
});
Route::get('formulario',[bandacontroller::class,'formulario'])->name('formulario');
Route::POST('guardargrupo',[bandacontroller::class,'guardargrupo'])->name('guardargrupo');
Route::get('reportegrupo',[bandacontroller::class,'reportegrupo'])->name('reportegrupo');
Route::get('modificarban/{idb}',[bandacontroller::class,'modificarban'])->name('modificarban');
Route::POST('cambio',[bandacontroller::class,'cambio'])->name('cambio');
Route::get('eliminabanda/{idb}',[bandacontroller::class,'eliminabanda'])->name('eliminabanda');
//------------------------------------------------
Route::get('inicio',[sesioncontroller::class,'inicio'])->name('inicio');
Route::get('login',[sesioncontroller::class,'login'])->name('login');
Route::POST('verificar',[sesioncontroller::class,'verificar'])->name('verificar');
Route::get('cerrarsesion',[sesioncontroller::class,'cerrarsesion'])->name('cerrarsesion');
//-----------------------------------------------------------------------------------------------------
Route::get('nuevaventa',[ventbolcontroller::class,'nuevaventa'])->name('nuevaventa');
Route::get('hacerventa', [ventbolcontroller::class, 'hacerventa'])->name('hacerventa');
Route::get('artistaInfo', [ventbolcontroller::class, 'artistaInfo'])->name('artistaInfo');
Route::get('filtrarfecha', [ventbolcontroller::class, 'filtrarfecha'])->name('filtrarfecha');
//Route::get('boletosInfo', [ventbolcontroller::class, 'boletosInfo'])->name('boletosInfo');
Route::get('guardar', [ventbolcontroller::class, 'guardar'])->name('guardar');
//------------------------------------------
Route::get('form1', [boletoscontroller::class, 'form1'])->name('form1');
Route::get('boletosinfo', [boletoscontroller::class, 'boletosinfo'])->name('boletosinfo');
Route::get('tiposboletos', [boletoscontroller::class, 'tiposboletos'])->name('tiposboletos');
Route::get('preciosboletos', [boletoscontroller::class, 'preciosboletos'])->name('preciosboletos');
Route::get('promociones', [boletoscontroller::class, 'promociones'])->name('promociones');
Route::get('cargapromociones', [boletoscontroller::class, 'cargapromociones'])->name('cargapromociones');
Route::get('promocionesprecio', [boletoscontroller::class, 'promocionesprecio'])->name('promocionesprecio');
Route::get('tipoasiento', [boletoscontroller::class, 'tipoasiento'])->name('tipoasiento');
Route::POST('confirmarconcierto', [boletoscontroller::class, 'confirmarconcierto'])->name('confirmarconcierto');
Route::get('registracarrito', [boletoscontroller::class, 'registracarrito'])->name('registracarrito');

Route::get('agregarasientos', [boletoscontroller::class, 'agregarasientos'])->name('agregarasientos');
Route::match(['get', 'post'], '/guardanuevoasiento', [boletoscontroller::class, 'guardanuevoasiento'])->name('guardanuevoasiento');
Route::get('tablaboletos', [boletoscontroller::class, 'tablaboletos'])->name('tablaboletos');
Route::get('reporteboletos', [boletoscontroller::class, 'reporteboletos'])->name('reporteboletos');


