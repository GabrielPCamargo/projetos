@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div>
        <h1>Editar tarefa</h1>
        @include('components.alert')
        <form action="{{route('tarefas.update', $tarefa->id)}}" method="POST">
            @csrf
            @method('put')
            <label for="name">Nome: </label>
            <input name="name" type="text" value="{{$tarefa->name}}"> <br />
            <label for="description">Descrição: </label>
            <input name="description" type="text" value="{{$tarefa->description}}"> <br />
            
            Completo: 
            <input name="done" type="radio" value="0" @if(!$tarefa->done)checked @endif>Não
            <input name="done" type="radio" value="1" @if($tarefa->done)checked @endif>Sim <br />
            <label for="example-date-input" class="col-form-label">Data de finalização:</label>
            <div>
                <input name="date" class="form-control" type="date" value="{{$tarefa->date}}" id="example-date-input">
            </div>
            
            <button class="btn btn-primary mr-auto mt-3" type="submit">Salvar</button>
            <a class="btn btn-dark ml-5 mt-3" href="{{route('tarefas.index')}}">Voltar</a>
        </form>
    </div>
    
</div>

@endsection