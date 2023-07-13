<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alats extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    // public function laborAlat()
    // {
    //     return $this->belongsTo('App\Alats');
    // }
}
