<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'harga_beli',
        'total_bayar',
        'status',
    ];

    public function offer(): BelongsTo{
        return $this->belongsTo(TbsOffer::class);
    }

    public function invoice(): HasOne{
        return $this->hasOne(Invoice::class);
    }
}
