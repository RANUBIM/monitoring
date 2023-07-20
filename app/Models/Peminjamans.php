<?php

namespace App\Models;

use App\Models\Alats;
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

    public function dataAlat()
    {
        return $this->belongsToMany(Alats::class, 'peminjaman_alats', 'peminjaman_id', 'alat_id')
        ->withPivot(['id','uuid','jumlah']);
    }
}
