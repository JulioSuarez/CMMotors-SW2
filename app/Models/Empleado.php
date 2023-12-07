<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "ci",
        "nombre",
        "estado",
        "telefono",
        "foto",
        "id_usuario",
    ];

    protected $primaryKey = 'ci';

    public function user(){
    return $this->belongsTo(User::class,);
    }

    public function cotizaciones(){
    return $this->hasMany(Cotizacion::class);
    }

    public function ventas(){
    return $this->hasMany(Venta::class);
    }
}
