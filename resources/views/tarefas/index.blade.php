@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-100 px-4">
        <h1 class="text-dark">Minhas tarefas @guest Públicas @endguest </h1>

        @include('components.alert')
        @foreach($tarefas as $tarefa)
            <div class="border p-3 @if($tarefa->done) bg-secondary @endif">
                <h3 class="mr-4" style="display:inline; @if($tarefa->done) text-decoration: line-through; @endif"><a href="{{route('tarefas.show', $tarefa->id)}}">{{$tarefa->name}}</a></h3>
                <p>Prazo: {{$tarefa->date}}</p>
                @if($tarefa->done)
                    <a onclick="if(confirm('A Tarefa não foi completa?')){document.querySelector('#changestate{{$tarefa->id}}').submit()}" class="btn btn-success">Realizada</a>
                @else
                    
                    <a onclick="if(confirm('A Tarefa foi completa?')){document.querySelector('#changestate{{$tarefa->id}}').submit()}" class="btn btn-warning">Não realizada</a>
                @endif

                <form id="changestate{{$tarefa->id}}" style="display: inline;" action="{{route('tarefas.state', $tarefa->id)}}" method="POST">
                    @csrf
                    @method('put')
                        
                </form>

                @if($tarefa->description)
                    <p>Descrição:</p>
                    <p>{{$tarefa->description}}</p>
                @endif
                
                <a class="btn btn-warning" href="{{route('tarefas.edit', $tarefa->id)}}">Editar</a>
                <a onclick="if(confirm('Você tem certeza que deseja excluir esta tarefa?')){document.querySelector('#delete{{$tarefa->id}}').submit()}" class="btn btn-danger">Deletar</a>
                <form id="delete{{$tarefa->id}}" style="display: inline;" action="{{route('tarefas.destroy', $tarefa->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    
                </form>
            </div>
        @endforeach

        @auth
            <a class="btn btn-primary mt-4 text-center" href="{{route('tarefas.create')}}">Criar tarefa</a>
        @endauth

        @guest
            <h4 class="mt-3">*Para mais funções você deve se logar</h4>
        @endguest
        
    </div>
</div>
@endsection