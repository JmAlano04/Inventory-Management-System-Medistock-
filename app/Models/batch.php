<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;

class Batch extends Model
{
    //
     protected $fillable = [
        'medicine_id',
        'batch_code',
        'quantity',
        'expiry_date',
        'unit_cost',
        'status',
    ];

      // ✅ Define relationship to the Medicine model
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
