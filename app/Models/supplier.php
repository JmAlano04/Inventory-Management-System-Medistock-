<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Batch;

class supplier extends Model
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
    return $this->hasMany(Batch::class);
}
}
