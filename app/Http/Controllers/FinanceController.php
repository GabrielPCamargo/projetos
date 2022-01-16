<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyCategory;
use Illuminate\Support\Facades\Validator;


class FinanceController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['store','create','destroy','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('finance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //Recuperar as categorias.
        
        $categories = MoneyCategory::all();
        
        return view('finance.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:activities|max:100',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.unique' => 'Já existe uma categoria com esse nome, por favor escolha outro!',
            'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        ])->validate();
    
        auth()->user()->activities()->create($request->all());
    
    
        $request->session()->flash('message', 'Atividade criada com sucesso');
        return back()->withInput();
    
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
