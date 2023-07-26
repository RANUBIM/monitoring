<?php

namespace App\Models;

use App\Models\Alats;
use App\Models\Bahans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Labors extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = ['nama'];

    public function dataAlat()
    {
        return $this->hasMany(Alats::class, 'labor_id', 'id');
    }
    
    public function dataBahan()
    {
        return $this->hasMany(Bahans::class, 'labor_id', 'id');
    }
}
