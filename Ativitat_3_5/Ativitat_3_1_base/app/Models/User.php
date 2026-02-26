<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function biblioteca(): HasOne
    {
        return $this->hasOne(Biblioteca::class);
    }

    public static function findNoAssignats(): Collection
    {
        return self::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('bibliotecas')
                ->whereColumn('bibliotecas.user_id', 'users.id');
        })->get();
    }

    public static function findNoAssignatsAmbActual(int $bibliotecaId): Collection
    {
    // Obtenir l'usuari actual de la biblioteca
    $biblioteca = \App\Models\Biblioteca::find($bibliotecaId);
    $usuariActualId = $biblioteca ? $biblioteca->user_id : null;

    // Consulta usuaris sense biblioteca
    $queryNoAssignats = self::whereNotExists(function ($query) {
        $query->select(DB::raw(1))
              ->from('bibliotecas')
              ->whereColumn('bibliotecas.user_id', 'users.id');
    });

    // Si hi ha usuari actual, fem union amb aquest usuari
    if ($usuariActualId) {
        return $queryNoAssignats
                ->orWhere('id', $usuariActualId)
                ->get();
    }

    return $queryNoAssignats->get();
    }   


}
