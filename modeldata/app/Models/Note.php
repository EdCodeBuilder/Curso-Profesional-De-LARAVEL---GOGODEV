<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = "notes";

    protected $fillable = [
        "title",
        "description",
        "deadline",
        "done"
    ];

    protected $casts = [
        "deadline" => "date" // fuerza a que los datos que ingresan al modelo cumplan con la característica especificada.
    ];
    
    protected $hidden = ['password']; // evita entregar password cuando se serializan los datos en el modelo para entregarlo.
}
