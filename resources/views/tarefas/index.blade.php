@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-100 px-4">
        <h1 class="text-dark">Minhas tarefas</h1>

        @include('components.alert')
        @foreach($tarefas as $tarefa)
            <div class="border p-3">
                <h3 class="mr-4" style="display:inline"><a href="{{route('tarefas.show', $tarefa->id)}}">{{$tarefa->name}}</a></h3>
                @if($tarefa->done)
                    <p class="btn btn-success">Completed</p>
                @else
                    <p class="btn btn-warning">Not completed</p>
                @endif
                <p>Descrição:</p>
                <p>{{$tarefa->description}}</p>
                <a class="btn btn-warning" href="{{route('tarefas.edit', $tarefa->id)}}">Editar</a>
                <form style="display: inline;" action="{{route('tarefas.destroy', $tarefa->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" type="submit">Deletar</button>
                </form>
            </div>
        @endforeach

        @auth
            <a class="btn btn-primary mt-4 text-center" href="{{route('tarefas.create')}}">Criar tarefa</a>
        @endauth
        
    </div>
</div>
@endsection