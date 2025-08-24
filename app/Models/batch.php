<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;
use Carbon\Carbon;
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
    public function getIsExpiredAttribute()
    {
        return Carbon::now()->gt(Carbon::parse($this->expiration_date));
    }

}
