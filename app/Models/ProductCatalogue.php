<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class ProductCatalogue extends Model
{
    use HasFactory, nodeTrait, SoftDeletes;

    protected $table = 'product_catalogue';

    protected $fillable = [
        'name',
        'parent_id',
        'user_id',
        '_lft',
        '_rgt',
        'publish',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_catalogue_id', 'id');
    }
}
