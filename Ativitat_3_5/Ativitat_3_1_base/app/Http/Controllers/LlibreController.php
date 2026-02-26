<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Llibre;
use App\Models\Autor;
use App\Models\Biblioteca;

class LlibreController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list()
  {
    $llibres = Llibre::all();


    return view('llibre.list', ['llibres' => $llibres]);
  }

  function new(Request $request)
  {
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte llibre

      $llibre = new Llibre;
      $llibre->titol = $request->titol;
      $llibre->dataP = $request->dataP;
      $llibre->vendes = $request->vendes;

      // comprovem el checkbox crear autor
      if (isset($request->crear_autor)) {
        // hem de crear un nou autor, a més del llibre
        $autor = new Autor;
        $autor->nom = $request->nom;
        $autor->cognoms = $request->cognoms;

        // cridem al mètode per persistir el llibre i el seu autor
        $llibre->insertLlibreAutor($autor);
      } else {
        // recollim l'autor del llibre del desplegable
        $llibre->autor_id = $request->autor_id;
        // persistim el llibre
        $llibre->save();
      }

      $bibliotecaIds = $request->input('checked', []);

      foreach ($bibliotecaIds as $bibliotecaId) {
        $llibre->bibliotecas()->attach($bibliotecaId);
      }

      $dades = [];
      foreach ($request->checked as $bibliotecaId) {
        $dades[$bibliotecaId] = ['exemplars' => $request->exemplars[$bibliotecaId] ?? 0];
      }

      $llibre->bibliotecas()->sync($dades);

      // si l'autor no és null hem de crear o sobreescriure la cookie autor
      // si és null hem d'esborrar la cookie
      if (isset($llibre->autor_id)) {
        return redirect()->route('llibre_list')->with('status', 'Nou llibre ' . $llibre->titol . ' creat!')
          ->cookie('autor', $llibre->autor_id, 60);
      } else {
        return redirect()->route('llibre_list')->with('status', 'Nou llibre ' . $llibre->titol . ' creat!')
          ->withoutCookie('autor');
      }
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $autors = Autor::all();
    $bibliotecas = Biblioteca::all();

    // llegim el valor de la cookie autor
    // l'enviarem com un parametre al template llibre.new
    $selectedAutor = $request->cookie('autor');

    return view('llibre.new', ['autors' => $autors, 'selectedAutor' => $selectedAutor, 'bibliotecas' => $bibliotecas]);
  }

  function edit(Request $request, $id)
  {
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte llibre

      $llibre = Llibre::find($id);
      $llibre->titol = $request->titol;
      $llibre->dataP = $request->dataP;
      $llibre->vendes = $request->vendes;
      $llibre->autor_id = $request->autor_id;
      $llibre->save();

      $bibliotecaIds = $request->input('checked', []);

      $llibre->bibliotecas()->sync($bibliotecaIds);

      $dades = [];
      foreach ($request->checked as $bibliotecaId) {
        $dades[$bibliotecaId] = ['exemplars' => $request->exemplars[$bibliotecaId] ?? 0];
      }

      $llibre->bibliotecas()->sync($dades);

      return redirect()->route('llibre_list')->with('status', 'Llibre ' . $llibre->titol . ' desat!');
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $llibre = Llibre::find($id);
    $autors = Autor::all();
    $bibliotecas = Biblioteca::all();

    return view('llibre.edit', ['llibre' => $llibre, 'autors' => $autors, "bibliotecas" => $bibliotecas]);
  }

  function delete($id)
  {
    $llibre = Llibre::find($id);
    $llibre->delete();

    return redirect()->route('llibre_list')->with('status', 'Llibre ' . $llibre->titol . ' eliminat!');
  }

  function cercar(Request $request)
  {
    $paraula = $request->input('cerca');


    $llibres = Llibre::cercarAutor($paraula);

    return view('llibre.list', ['llibres' => $llibres]);
  }
}
