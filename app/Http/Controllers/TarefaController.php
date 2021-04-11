<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::all();
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
        $validated = $request->validate([
            'name' => 'required|unique:tarefas|max:100',
            'description' => 'required',
        ]);

        Tarefa::create($request->all());

        $request->session()->flash('message', 'tarefa criada com sucesso');
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
        $validated = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
        ]);

        $tarefa->name = $request->name;
        $tarefa->description = $request->description;

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
}
