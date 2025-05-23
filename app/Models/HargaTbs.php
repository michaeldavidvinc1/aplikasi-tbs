<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaTbs extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga_per_kilo',
        'berlaku',
    ];
}
