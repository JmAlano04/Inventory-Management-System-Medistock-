<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine;
use App\Models\Supplier;
use Carbon\Carbon;

class Batches extends Model
{
    //
     protected $fillable = [
        'medicine_name',
        'batch_code',
        'quantity',
        'expiry_date',
        'unit_cost',
        'supplier_id',
        'status',
    ];

      // ✅ Define relationship to the Medicine model
    public function medicine()
    {
        return $this->hasMany(Medicine::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

     public function expiries()
    {
        return $this->hasMany(Expiries::class);
    }

    public function getIsExpiredAttribute()
    {
        return Carbon::now()->gt(Carbon::parse($this->expiration_date));
    }

}
