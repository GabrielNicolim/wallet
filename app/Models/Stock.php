<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ceiling_price',
        'wallet_id',
        'sector_id',
    ];

    protected $appends  = [
        'formatted_average_price',
        'formatted_ceiling_price',
        'formatted_quantity'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function getFormattedCeilingPriceAttribute()
    {
        return number_format($this->ceiling_price, 2, ',', '.');
    }

    public function getFormattedAveragePriceAttribute()
    {
        $operations = $this->operations()
            ->where('type', Operation::PURCHASE)
            ->get();

        $price = 0;
        $total = $operations->sum('quantity');
        collect($operations)->map(function ($operation) use ($price) {
            $price += $operation->price * $operation->quantity;
        });

        $averagePrice = $total ? ($price/$total) : 0;

        return number_format($averagePrice, 2, ',', '.');
    }

    public function getFormattedQuantityAttribute()
    {
        $operations = $this->operations()
            ->get();

        $total = 0;
        collect($operations)->map(function ($operation) use ($total) {
            $total += $operation->quantity * ($operation->type == Operation::PURCHASE ? 1 : -1);
        });

        return number_format($total, 0, ',', '.');
    }
}
