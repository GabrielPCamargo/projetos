@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-100 px-4">
        <h1 class="text-dark">Minhas finanças</h1>
        

        @auth
             <ul>
                    <li style="font-size: large;" ><a href="{{route('tarefas.index')}}">Lista de tarefas</a></li>
                    <li style="font-size: large;" ><a href="{{route('finance.index')}}">Gerenciamento financeiro</a></li>
                    <li style="font-size: large;" >Mini loja</li>
                    <li style="font-size: large;" >Mini rede social</li>
                    <li style="font-size: large;" >Blog</li>
                    
                </ul>

                <a class="btn btn-primary mt-4 text-center" href="{{route('finance.create')}}">Criar nova atividade</a>
        @endauth

        @guest
            <h4 class="mt-3">*Para mais funções você deve se logar</h4>
        @endguest
        
    </div>
</div>
@endsection