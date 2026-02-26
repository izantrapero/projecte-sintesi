@extends('layout')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div>
      <img src="{{ asset ('img/logo.png') }}" alt="">
      <h2>Tema 2</h2>
      <hr>
      <h3>Pràctica per iniciar-se en els conceptes bàsics de Laravel</h3>
      @if (Cookie::has('autor'))
        <a href="{{ route('esborra_cookies') }}">Esborrar cookies</a>
      @endif
    </div>
@endsection