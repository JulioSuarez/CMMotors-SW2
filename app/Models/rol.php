<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function User()
    {
        //rol da su PK a la tabla users
        return $this->hasMany(User::class);
    }
}
