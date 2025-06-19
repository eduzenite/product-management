<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sale_price', 'cost_price', 'description'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
