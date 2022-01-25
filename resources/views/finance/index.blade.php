@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="w-100 px-4">
        <h1 class="text-dark">Minhas finanças</h1>
        

        @auth
            <div id="month">
                <select id="monthselect">
                    <option value="1" @if($month == 1) {{'selected'}} @endif>Janeiro</option>
                    <option value="2" @if($month == 2) {{'selected'}} @endif>Fevereiro</option>
                    <option value="3" @if($month == 3) {{'selected'}} @endif>Março</option>
                    <option value="4" @if($month == 4) {{'selected'}} @endif>Abril</option>
                    <option value="5" @if($month == 5) {{'selected'}} @endif>Maio</option>
                    <option value="6" @if($month == 6) {{'selected'}} @endif>Junho</option>
                    <option value="7" @if($month == 7) {{'selected'}} @endif>Julho</option>
                    <option value="8" @if($month == 8) {{'selected'}} @endif>Agosto</option>
                    <option value="9" @if($month == 9) {{'selected'}} @endif>Setembro</option>
                    <option value="10" @if($month == 10) {{'selected'}} @endif>Outubro</option>
                    <option value="11" @if($month == 11) {{'selected'}} @endif>Novembro</option>
                    <option value="12" @if($month == 12) {{'selected'}} @endif>Dezembro</option>
                </select>
            </div>

            <script>
                var select = document.getElementById("monthselect");
                select.addEventListener("change", function(event){
                    window.location.replace(`/finance/view/${event.target.value}`);
                })
            </script>

            <table class="activities mb-5">
                <tr>
                    <th>
                        <input type="checkbox" />
                    </th>

                    <th>
                        <p>Ganhos</p>
                        <input type="text" placeholder="Procurar" />
                    </th>

                    <th>
                        <p>Categoria</p>
                        <select>
                            <option>Teste</option>
                        </select>
                    </th>

                    <th>
                        <p>Valor</p>
                        <select>
                            <option>Teste</option>
                        </select>
                    </th>

                    <th>
                        Action
                        <div></div>
                    </th>
                </tr>

                @foreach($earnings as $activity)
                <tr>
                    <td>
                        <input type="checkbox" />
                    </td>

                    <td>
                        {{$activity->name}}
                    </td>

                    <td>
                        {{($activity->category->name)}}
                    </td>

                    <td>
                        {{$activity->price}}
                    </td>

                    <td style="text-align: center">
                        <div class="toggleActionOptions">
                            <a href="{{route('finance.edit', $activity->id)}}" class="btn btn-warning">Editar</a>
                            <a onclick="if(confirm('Você tem certeza que deseja excluir esta atividade?')){document.querySelector('#delete{{$activity->id}}').submit()}" class="btn btn-danger">Deletar</a>
                            <form id="delete{{$activity->id}}" style="display: inline;" action="{{route('finance.destroy', $activity->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                
                            </form>
                        </div>  
                    </td>
                </tr>
                @endforeach

                
            </table>

            <table class="activities mb-5">
                <tr>
                    <th>
                        <input type="checkbox" />
                    </th>

                    <th>
                        <p>Gasto</p>
                        <input type="text" placeholder="Procurar" />
                    </th>

                    <th>
                        <p>Categoria</p>
                        <select>
                            <option>Teste</option>
                        </select>
                    </th>

                    <th>
                        <p>Valor</p>
                        <select>
                            <option>Teste</option>
                        </select>
                    </th>

                    <th>
                        Action
                        <div></div>
                    </th>
                </tr>

                @foreach($activities as $activity)
                <tr>
                    <td>
                        <input type="checkbox" />
                    </td>

                    <td>
                        {{$activity->name}}
                    </td>

                    <td>
                        {{($activity->category->name)}}
                    </td>

                    <td>
                        {{$activity->price}}
                    </td>

                    <td style="text-align: center">
                        <div class="toggleActionOptions">
                            <a href="{{route('finance.edit', $activity->id)}}" class="btn btn-warning">Editar</a>
                            <a onclick="if(confirm('Você tem certeza que deseja excluir esta atividade?')){document.querySelector('#delete{{$activity->id}}').submit()}" class="btn btn-danger">Deletar</a>
                            <form id="delete{{$activity->id}}" style="display: inline;" action="{{route('finance.destroy', $activity->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                
                            </form>
                        </div>  
                    </td>
                </tr>
                @endforeach

                
            </table>

            
            <table class="activities text-center">
                <tr>
                    <th>
                        Categoria
                    </th>
                    <th>
                        Saldo total
                    </th>
                    <th>
                        Saldo disponível
                    </th>
                </tr>
            @foreach ($categoriesBalance as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                        {{$category->value}}
                    </td>
                    <td>
                        {{$category->balance}}
                    </td>
                </tr>
            @endforeach
            </table>
            

            <style>
                #month {
                    padding: 1em;
                    margin-left: 5em;
                    font-size: 1.7rem;
                }

                .activities th, td{
                    width: fit-content;
                    padding: 1em;
                }

                .activities tr{
                    border: 1px solid #7C9EAF
                }

                .activities input[type=text], select {
                    background-color: inherit;
                    border: 0;
                }

                .toggleActionOptions {
                    position: relative;
                }
            </style>
            

            

            <a class="btn btn-primary ml-5 mt-3" href="{{route('finance.create')}}">Nova Atividade</a>

            

            

        @endauth

        @guest
            <h4 class="mt-3">*Para mais funções você deve se logar</h4>
        @endguest
        
    </div>
</div>
@endsection