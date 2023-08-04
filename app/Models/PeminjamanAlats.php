<?php

namespace App\Models;

use App\Models\Users;
use App\Models\Peminjamans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanAlats extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dataUser()
    {
        return $this->belongsTo(Users::class, 'peminjaman_id', 'id');
    }

    public function dataUsers()
    {
        return $this->belongsToMany(Users::class, 'peminjaman_alats', 'peminjaman_id', 'user_id')
        ->withPivot(['id','uuid','jumlah','status']);
    }
}
