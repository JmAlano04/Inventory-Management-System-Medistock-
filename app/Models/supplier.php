<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Batch;
use App\Models\Expiries;

class Supplier extends Model
{
    //
    protected $fillable = [
        'supplier_name',
        'contact_person',
        'phone',
        'email',
        'address',
    ];
    public function batches()
{
    return $this->hasMany(Batches::class);
}
    public function Expiries()
{
    return $this->hasMany(Expiries::class);
}
}
