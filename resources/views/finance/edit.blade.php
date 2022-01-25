@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div style="min-width: 400px;">
        <h1>Editar atividade financeira</h1>
        @include('components.alert')
        <form action="{{route('finance.update', $activity->id)}}" method="POST">
            @csrf
            @method('put')
            <label for="name">Nome</label>
            <input name="name" type="text" value="{{$activity->name}}"> <br />
            <label for="description">Descrição</label>
            <input name="description" type="text" value="{{$activity->description}}"> <br />
            <label for="category">Categoria</label> 
            <select name="category_id" type="text" value="{{old('description')}}">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            
            <a class="btn btn-primary ml-5 mt-3" href="{{url('/category')}}">Nova Categoria</a>

            <br />
            <select name="spend" id="">
                
                <option value="1" @if($activity->spend === 1){{'selected'}} @endif>Gasto</option>
                <option value="0" @if($activity->spend === 0){{'selected'}} @endif>Ganho</option>
            </select>

            <br />

            <label for="price">Valor</label>
            <input name="price" type="integer" value="{{$activity->price}}"> <br />

            <label for="example-date-input" class="col-form-label">Data de finalização:</label>
            <div>
                <input name="date" class="form-control" type="date" value="{{$activity->date}}" id="example-date-input">
            </div>
            
            <button class="btn btn-primary mt-4" type="submit">Salvar</button>
            <a class="btn btn-dark ml-5 mt-3" href="{{url('/finance/view/' . date('m'));}}">Voltar</a>
        </form>
    </div>
    
</div>

@endsection