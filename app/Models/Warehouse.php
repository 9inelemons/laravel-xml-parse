<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = false;

    public $keyType = 'string';

    protected $fillable = ['id', 'region'];
}
