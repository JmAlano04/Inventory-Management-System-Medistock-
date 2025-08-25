<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Batch;

class supplier extends Model
{
    //
    public function batches()
{
    return $this->hasMany(Batch::class);
}
}
