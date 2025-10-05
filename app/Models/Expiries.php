<?php

namespace App\Models;
use App\Models\Batches;
use App\Models\Supplier;
use App\Models\medicine;
use Illuminate\Database\Eloquent\Model;

class Expiries extends Model
{
      protected $fillable = [
        'batches_id',
        'supplier_id',
        'days_remaining',
       
    ];
    //
     public function batches()
    {
        return $this->belongsTo(Batches::class);

    }
     public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
