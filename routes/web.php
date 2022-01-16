<?php

use App\Http\Controllers\TarefaController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
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

Route::get('/category', function () {
    return view('category');
})->middleware('auth');


Route::get('/', function () {
    return view('welcome');
});

//tarefas
Route::resource('tarefas', TarefaController::class);
Route::resource('finance', FinanceController::class);
Route::put('tarefas/{tarefa}/edit/state', [TarefaController::class, 'editstate'])->name('tarefas.state');

//Route::get('/loja', LojaController::class)


Route::post('/category', function (Request $request) {
    $rules = [
        'name' => 'required|unique:money_categories|max:100',
        'percentage' => 'digits_between:1,99',
    ];

    $validator = Validator::make($request->all(), $rules, $messages = [
        'name.required' => 'O campo nome é obrigatório!',
        'name.unique' => 'Já existe uma categoria com esse nome, por favor escolha outro!',
        'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        'percentage.digits_between' => 'Você deve inserir um número entre 1 e 99'
    ])->validate();

    auth()->user()->categories()->create($request->all());


    $request->session()->flash('message', 'Categoria criada com sucesso');
    return redirect()->route('finance.create')->withInput();
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dia das mães
Route::get('/dia-das-maes-2021', function () {
    return view('specials.dia-das-maes-2021');
});
