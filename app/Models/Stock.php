<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'average_price',
        'ceiling_price',
        'quantity',
        'wallet_id',
        'sector_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
