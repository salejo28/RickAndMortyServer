<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class characters extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'species', 'type', 'gender', 'origin', 'location', 'image', 'episode', 'created', 'url'];

    protected function origin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true)
        );
    }

    protected function location(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true)
        );
    }

    protected function episode(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !$value || $value === '[]' ? array() : json_decode($value)
        );
    }
}
