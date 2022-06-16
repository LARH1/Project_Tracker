<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function ()
{
    return view('welcome');
});

Route::get("project/status/{id}", [ProjectController::class, "Status"]);
Route::post("project/inipay", [ProjectController::class, "PagoInicial"]);
Route::post("project/cambiar", [ProjectController::class, "Cambiar"]);
Route::post("project/secondpay", [ProjectController::class, "PagoDos"]);
Route::post("project/finalpay", [ProjectController::class, "FinalPay"]);
Route::get("project/download/f1/{clave}", [ProjectController::class, "DescargarFase1"]);
Route::get("project/download/f2/{clave}", [ProjectController::class, "DescargarFinal"]);
Route::resource("project", ProjectController::class);
