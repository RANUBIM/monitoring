<?php

namespace App\Models;

use App\Models\Labors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alats extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function dataLaborGmana()
    {
        return $this->belongsTo(Labors::class);
    }

    // public function dataLabor()
    // {
    //     return $this->belongsTo('App\Models\Labors', 'labor_id', 'id');
    // }

    public function dataLabor()
    {
        return $this->belongsTo(Labors::class, 'labor_id', 'id');
    }
}
