<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\batch;
use App\Models\Expiries;

class Medicine extends Model
{
    protected $fillable = [
        'batches_id', 'brand_name', 'dosage', 'category'
    ];
    public function batches()
    {
        return $this->belongsTO(batches::class);
    }
    public function Expiries()
    {
        return $this->hasMany(Expiries::class);
    }
}
