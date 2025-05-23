<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'file_path',
    ];

    public function transaksi(): BelongsTo{
        return $this->belongsTo(Transaksi::class);
    }
}
