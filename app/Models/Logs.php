<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Logs extends Model
{
    use HasFactory;

    public function description(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function category(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value),
        );
    }

    public function scopeCari($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('category','LIKE','%'.$search.'%');
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
