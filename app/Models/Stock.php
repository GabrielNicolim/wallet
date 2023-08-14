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
        'formatted_quantity',
        'average_price',
        'quantity',
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

    public function getAveragePriceAttribute()
    {
        $operations = $this->operations()
        ->where('type', Operation::PURCHASE)
        ->get();

        $price = 0;
        $quantity = $operations->sum('quantity');
        
        foreach($operations as $operation) {
            $price += $operation->price * $operation->quantity;
        }

        $averagePrice = $quantity ? ($price/$quantity) : 0;

        return $averagePrice;
    }

    public function getFormattedAveragePriceAttribute()
    {
        return number_format($this->average_price, 2, ',', '.');
    }

    public function getQuantityAttribute()
    {
        $operations = $this->operations()
            ->get();

        $quantity = 0;
        foreach($operations as $operation) {
            $quantity += $operation->quantity * ($operation->type == Operation::PURCHASE ? 1 : -1);
        }

        return $quantity;
    }

    public function getFormattedQuantityAttribute()
    {
        return number_format($this->quantity, 0, ',', '.');
    }
}
