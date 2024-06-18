<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'cost'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product__categories', 'product_id', 'category_id');
    }

    public function stones()
    {
        return $this->belongsToMany(Stone::class, 'product__stones', 'product_id', 'stone_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product__materials', 'product_id', 'material_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
