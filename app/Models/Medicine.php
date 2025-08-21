<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
    'medicine_name', 'brand_name', 'dosage', 'catergory'
];

}
