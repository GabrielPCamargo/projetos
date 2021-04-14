@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div style="min-width: 400px;">
        <h1>Nova tarefa</h1>
        @include('components.alert')
        <form action="{{route('tarefas.store')}}" method="POST">
            @csrf
            <label for="name">Nome</label>
            <input name="name" type="text" value="{{old('name')}}"> <br />
            <label for="description">Descrição</label>
            <input name="description" type="text" value="{{old('description')}}"> <br />

            <label for="example-date-input" class="col-form-label">Data de finalização:</label>
            <div>
                <input name="date" class="form-control" type="date" value="{{date('Y-m-d')}}" id="example-date-input">
            </div>
            
            <button class="btn btn-primary mt-4" type="submit">Criar</button>
            <a class="btn btn-dark ml-5 mt-3" href="{{route('tarefas.index')}}">Voltar</a>
        </form>
    </div>
    
</div>

@endsection