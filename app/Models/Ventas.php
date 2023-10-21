<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $table = "ventas";

    protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'estado',
        'fecha',
        'total'
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }

    public function vendedor()
    {
        return $this->belongsTo(Clientes::class, 'id_vendedor');
    }
}
