<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dimension', 'type', 'residents', 'url', 'created'];

    protected function residents(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !$value || $value === '[]' ? array() : json_decode($value)
        );
    }
}
