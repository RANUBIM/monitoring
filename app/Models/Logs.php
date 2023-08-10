<?php

namespace App\Models;

use App\Models\Users;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    
    public function dataUser()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
