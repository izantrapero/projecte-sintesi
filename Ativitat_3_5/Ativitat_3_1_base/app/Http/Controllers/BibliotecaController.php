<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Biblioteca;
use App\Models\User;

class BibliotecaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
      $bibliotecas = Biblioteca::all();
      

      return view('biblioteca.list', ['bibliotecas' => $bibliotecas]);
    }

    public function new(Request $request)
    {
      if ($request->isMethod('post')) {
          $biblioteca = new Biblioteca();
          $biblioteca->nom = $request->nom;
          $biblioteca->adresa = $request->adresa;
          $biblioteca->user_id = $request->user_id ?: null;
          $biblioteca->save();

          return redirect()->route('biblioteca_list')->with('status', 'Nova biblioteca '.$biblioteca->nom.' creada!');
      }

      $usuaris = User::findNoAssignats();

      return view('biblioteca.new', ['usuaris' => $usuaris]);
    }

    public function edit(Request $request, $id)
    {
      $biblioteca = Biblioteca::findOrFail($id);

      if ($request->isMethod('post')) {
          $biblioteca->nom = $request->nom;
          $biblioteca->adresa = $request->adresa;
          $biblioteca->user_id = $request->user_id ?: null;
          $biblioteca->save();

          return redirect()->route('biblioteca_list')->with('status', 'Biblioteca actualitzada!');
      }

      $usuaris = User::findNoAssignatsAmbActual($id);

      return view('biblioteca.edit', ['biblioteca' => $biblioteca,'usuaris' => $usuaris]);
    }


    function delete($id) 
    { 
      $biblioteca = Biblioteca::find($id);
      $biblioteca->delete();

      return redirect()->route('biblioteca_list')->with('status', 'biblioteca eliminada!');
    }
}
