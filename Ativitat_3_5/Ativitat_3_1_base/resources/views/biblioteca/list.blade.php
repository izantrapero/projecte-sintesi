@extends('layout')

@section('title', 'Llistat de bibliotecas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat de bibliotecas</h1>
    <a href="{{ route('biblioteca_new') }}">+ Nova Biblioteca</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Nom</th><th>Adressa</th><th>Usuari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bibliotecas as $biblioteca)
                <tr>
                    <td>{{ $biblioteca->nom }}</td><td>{{ $biblioteca->adresa }}</td><td>{{ $biblioteca->user?->name ?? 'Sense usuari' }}</td>
                    <td>
                        <a href="{{ route('biblioteca_edit', ['id' => $biblioteca->id]) }}">Editar</a>
                        <a href="{{ route('biblioteca_delete', ['id' => $biblioteca->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection