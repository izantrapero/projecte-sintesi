@extends('layout')

@section('title', 'Llistat de llibres')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat de llibres</h1>

    <form action="{{route('llibre_cerca')}}">
        Cercar autor: <input type="text" name="cerca" required>
        <button type="submit">Cercar</button>
    </form>
    <a href="{{ route('llibre_new') }}">+ Nou llibre</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Títol</th><th>Data de publicació</th><th>Vendes</th><th>Autor</th><th>Bibliotecas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($llibres as $llibre)
                <tr>
                    <td>{{ $llibre->titol }}</td><td>{{ $llibre->dataP->format('d-m-Y') }}</td><td>{{ $llibre->vendes }}</td>
                    <td>@isset($llibre->autor) {{ $llibre->autor->nomCognoms() }} @endisset</td> <td>@foreach($llibre->bibliotecas as $biblioteca){{$biblioteca->nom}}  ({{ $biblioteca->pivot->exemplars ?? 0 }} exemplars)<br>@endforeach</td>
                    <td>
                        <a href="{{ route('llibre_edit', ['id' => $llibre->id]) }}">Editar</a>
                        <a href="{{ route('llibre_delete', ['id' => $llibre->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection