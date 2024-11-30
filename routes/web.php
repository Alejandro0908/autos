<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutoController;

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


Route::post('/auto' , [AutoController::class, 'store']);

//Route::get('/auto' , [AutoController::class, 'index']);

Route::get('/auto', [AutoController::class, 'index'])->name('automovil.index');

Route::put('/auto/{auto}' , [AutoController::class, 'update']);

Route::put('/auto/{auto}', [AutoController::class, 'update'])->name('automovil.update');;

Route::get('/auto/{auto}' , [AutoController::class, 'show'])->name('automovil.show');;

Route::delete('/auto/{auto}', [AutoController::class, 'destroy']);
