<?php

namespace App\Models;

use App\Models\Labors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bahans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['tgl_pengadaan','deleted_at'];

    public function dataLabor()
    {
        return $this->belongsTo(Labors::class, 'labor_id', 'id');
    }
}
