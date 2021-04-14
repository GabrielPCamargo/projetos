<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store','create','destroy','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()){
            $tarefas = auth()->user()->tarefas->sortBy('done');
        }else{
            $tarefas = Tarefa::where('user_id', 2)->orderBy('done')->get();
        }
        
        return view('tarefas.index', compact('tarefas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefas.create');
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
            'name' => 'required|unique:tarefas|max:100',
            'description' => 'sometimes',
        ];

        $validator = Validator::make($request->all(), $rules, $messages = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.unique' => 'Já existe uma tarefa com esse nome, por favor escolha outro!',
            'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        ])->validate();

        auth()->user()->tarefas()->create($request->all());


        $request->session()->flash('message', 'Tarefa criada com sucesso');
        return redirect('/tarefas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $Tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $Tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        return view('tarefas.edit', compact('tarefa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $Tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $rules = [
            'name' => 'required|max:100',
            'description' => 'sometimes',
        ];

        $validator = Validator::make($request->all(), $rules, $messages = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.unique' => 'Já existe uma tarefa com esse nome, por favor escolha outro!',
            'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        ])->validate();

        $tarefa->name = $request->name;
        $tarefa->description = $request->description;
        $tarefa->date = $request->date;

        if(isset($request->done)){
            $tarefa->done = $request->done;
        }

        $tarefa->save();
        

        return redirect('/tarefas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $Tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect('/tarefas');
    }

    public function editstate(Tarefa $tarefa){

        $tarefa->done = !$tarefa->done;
        $tarefa->save();

        return redirect('/tarefas');
    }
}
