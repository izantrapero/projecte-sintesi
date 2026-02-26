@extends('layout')

@section('title', 'Nova biblioteca')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nova biblioteca</h1>
    <a href="{{ route('biblioteca_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('biblioteca_new') }}">
            @csrf
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" />
            </div>
            <div>            
                <label for="adresa">Adresa</label>
                <input type="text" name="adresa"  />
            </div>

            <div>
                <label for="usuari">Usuari:</label>
                <select name="usuari" id="usuari">
                    <option value="">Sense usuari</option>
                    @foreach($usuaris as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Crear biblioteca</button>
        </form>
	</div>
@endsection