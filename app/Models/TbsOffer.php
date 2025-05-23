<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TbsOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'berat',
        'kualitas',
        'lokasi',
        'status',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function transaksi(): HasOne{
        return $this->hasOne(Transaksi::class);
    }
}
