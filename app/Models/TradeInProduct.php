<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeInProduct extends Model
{
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'product_id',
        'warehouse_id',
        'price',
        'comment',
        'reason',
        'condition',
    ];
}
