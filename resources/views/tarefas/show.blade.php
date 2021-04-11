@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center">
    <div>

        @include('components.alert')
        <div class="border p-2">
            <h1>{{$tarefa->name}}</h1>
            <p>{{$tarefa->description}}</p>

            @if($tarefa->done)
                <button class="btn btn-success">Completo</button>
            @else
                <button class="btn btn-alert">Não completo</button>
            @endif
        </div>
       
    </div>
</div>
@endsection