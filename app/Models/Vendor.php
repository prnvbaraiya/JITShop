<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table= 'vendor';

    protected $fillable= [
        'name',
        'mobile',
        'email',
        'password',
        'image',
        'shop_name',
        'shop_address',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
