<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Biblioteca extends Model
{
    use HasFactory;


    // app/Models/Biblioteca.php
public function user()
{
    return $this->belongsTo(User::class);
}


    public function nomUsuari() {
    $usuari = User::find($this->user_id); 
    return $usuari;
}


}
