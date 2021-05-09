<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

//tarefas
Route::resource('tarefas', TarefaController::class);
Route::put('tarefas/{tarefa}/edit/state', [TarefaController::class, 'editstate'])->name('tarefas.state');

//lojaRoute::get('/loja', LojaController::class)


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dia das mães
Route::get('/dia-das-maes-2021', function () {
    return view('specials.dia-das-maes-2021');
});
