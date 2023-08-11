<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    public const SALE = 0;
    public const PURCHASE = 1;

    protected $fillable = [
        'price',
        'quantity',
        'type',
        'stock_id',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
