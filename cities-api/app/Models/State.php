<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function cities()
    {
        return $this->hasMany(City::class, 'id', 'city_id');
    }
}
