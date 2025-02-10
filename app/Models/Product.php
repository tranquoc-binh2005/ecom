<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_catalogue_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'content',
        'album',
        'image',
        'price',
        'discount',
        'stock',
        'publish',
        'sold',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    public function catalogues()
    {
        return $this->belongsTo(ProductCatalogue::class, 'product_catalogue_id', 'id');
    }

    public function product_variant()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }
}
