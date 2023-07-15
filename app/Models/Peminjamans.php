<?php

namespace App\Models;

use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjamans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function dataUser()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
