<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'quantity',
        'inventoryStatus',
        'category',
        'image',
        'rating',
    ];

    protected $appends = [
        'inventoryStatus',
    ];

    public function getInventoryStatusAttribute()
    {
        if ($this->quantity >= 10) return 'INSTOCK';
        if ($this->quantity > 0) return 'LOWSTOCK';
        return 'OUTOFSTOCK';
    }
}
