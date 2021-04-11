@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div>
        <h1>Nova tarefa</h1>
        @include('components.alert')
        <form action="{{route('tarefas.store')}}" method="POST">
            @csrf
            <label for="name">Nome</label>
            <input name="name" type="text" value="{{old('name')}}"> <br />
            <label for="description">Descrição</label>
            <input name="description" type="text" value="{{old('description')}}"> <br />
            
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
    
</div>

@endsection