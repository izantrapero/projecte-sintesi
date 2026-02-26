@extends('layout')

@section('title', 'Nou Llibre')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou Llibre</h1>
<a href="{{ route('llibre_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('llibre_new') }}">
        @csrf
        <div>
            <label for="titol">Títol</label>
            <input type="text" name="titol" />
        </div>
        <div>
            <label for="dataP">Data de publicació</label>
            <input type="date" name="dataP" value="{{ date_create()->format('Y-m-d') }}" />
        </div>
        <div>
            <label for="vendes">Vendes</label>
            <input type="number" name="vendes" />
        </div>
        <div>
            <label for="autor_id">Autor</label>
            <select name="autor_id">
                <option value="">-- selecciona un autor --</option>
                @foreach ($autors as $autor)
                <option value="{{ $autor->id }}" @selected($selectedAutor==$autor->id)>{{ $autor->nomCognoms()}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="crear_autor">Crear autor:</label>
            <input type='checkbox' name='crear_autor' />
            <label for="nom">Nom:</label>
            <input type='text' name='nom' />
            <label for="cognoms">Cognoms:</label>
            <input type='text' name='cognoms' />
        </div>

        <div>
            Biblioteques <br>
            @foreach($bibliotecas as $biblioteca)
            <label>
                <input type="checkbox" name="checked[]" value="{{ $biblioteca->id }}">
                {{ $biblioteca->nom }} <input type="number" name="exemplars[]"> Exemplars
            </label><br>
            @endforeach
        </div>

        <button type="submit">Crear Llibre</button>
    </form>
</div>
@endsection