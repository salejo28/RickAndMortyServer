<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class episodes extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'air_date', 'episode', 'characters', 'url', 'created'];

    protected function characters(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !$value || $value === '[]' ? array() : json_decode($value)
        );
    }
}
