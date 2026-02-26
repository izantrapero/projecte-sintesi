@extends('layout')

@section('title', 'Editar biblioteca')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Editar biblioteca</h1>
<a href="{{ route('biblioteca_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('biblioteca_edit', ['id' => $biblioteca->id]) }}">
        @csrf
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="{{ $biblioteca->nom }}" />
        </div>
        <div>
            <label for="adresa">Adresa</label>
            <input type="text" name="adresa" value="{{ $biblioteca->adresa }}" />
        </div>

        <div>
            <select name="user_id" id="user_id">
                <option value="">Sense usuari</option>
                @foreach ($usuaris as $usuari)
                <option value="{{ $usuari->id }}"
                    {{ $biblioteca->user_id == $usuari->id ? 'selected' : '' }}>
                    {{ $usuari->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Desar</button>
    </form>
</div>
@endsection