<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function State()
    {
        return $this->belongsTo(State::class, 'state_id', 'id', 'State');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'city_id');
    }
}
