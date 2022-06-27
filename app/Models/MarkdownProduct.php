<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkdownProduct extends Model
{
    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'product_id',
        'warehouse_id',
        'price',
        'reason',
        'condition',
        'performance',
        'kit',
        'warranty_expire_at',
        'updated_at'
    ];
}
