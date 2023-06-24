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

    protected $appends  = [
        'formatted_average_price',
        'formatted_ceiling_price',
        'formatted_quantity'
    ];

    public function getFormattedAveragePriceAttribute()
    {
        return number_format($this->average_price, 2, ',', '.');
    }

    public function getFormattedCeilingPriceAttribute()
    {
        return number_format($this->ceiling_price, 2, ',', '.');
    }

    public function getFormattedQuantityAttribute()
    {
        return number_format($this->quantity, 0, ',', '.');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
