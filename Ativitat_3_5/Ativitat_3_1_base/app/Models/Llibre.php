<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Llibre extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dataP' => 'datetime:Y-m-d',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class);
    }

    public function insertLlibreAutor($autor)
    {
        DB::transaction(function () use ($autor) {
            $autor->save();
            // quan hem persistit l'autor, la base de dades li ha assignat una id autoincrement
            // recollim la id de l'objecte autor i l'assignem al llibre
            $this->autor_id = $autor->id;

            // persistim el llibre
            return $this->save();
        });
    }

    public function bibliotecas(): BelongsToMany
    {
        return $this->belongsToMany(
            Biblioteca::class,
            'bibliotecas_llibres',
            'llibre_id',
            'biblioteca_id'
        )->withPivot('exemplars');;
    }

    public static function cercarAutor(string $cadena) {
         return self::join('autors', 'llibres.autor_id', '=', 'autors.id')
        ->where('autors.nom', 'like', '%' . $cadena . '%')
        ->orWhere('autors.cognoms', 'like', '%'. $cadena . '%')
        ->select('llibres.*')
        ->get();
    }
}
