@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center">
    <div>
        <h1 class="text-dark">Minhas tarefas</h1>

        @include('components.alert')
        @foreach($tarefas as $tarefa)
            <div class="border p-2">
                <h3><a href="{{route('tarefas.show', $tarefa->id)}}">{{$tarefa->name}}</a></h3>
                @if($tarefa->done)
                    <p class="text-success">Completed</p>
                @endif
                <a class="btn btn-alert" href="{{route('tarefas.edit', $tarefa->id)}}">Editar</a>
                <form action="{{route('tarefas.destroy', $tarefa->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">Deletar</button>
                </form>
            </div>
        @endforeach

        <a class="btn btn-primary mt-4" href="{{route('tarefas.create')}}">Criar tarefa</a>
        
    </div>
</div>
@endsection