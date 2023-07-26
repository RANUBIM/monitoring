<?php

namespace App\Models;

use App\Models\Users;
use App\Models\Bahans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penggunaans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['tgl_permintaan'];
    
    public function dataUser()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function dataBahan()
    {
        return $this->belongsToMany(Bahans::class, 'penggunaan_bahans', 'penggunaan_id', 'bahan_id')
        ->withPivot(['id','uuid','jumlah']);
    }
}
