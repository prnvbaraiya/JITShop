<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $table='Order_items';
    protected  $fillable = [
        'user_id',
        'product_ids',
        'quantity',
        'total'
    ];
}
