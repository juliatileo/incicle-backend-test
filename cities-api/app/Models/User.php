<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'cpf',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function City()
    {
        $this->belongsTo(City::class, 'city_id', 'id', 'City');
    }
}
