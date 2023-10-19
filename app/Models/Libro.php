<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'sinopsis',
        'portada',
        'id_genero',
        'id_autor',
        'fecha',
        'stock',
        'precio',
        'idioma'
    ];

    public $timestamps = false;

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero');
    }

    public function autor()
    {
        return $this->belongsTo(Autores::class, 'id_autor');
    }
}
