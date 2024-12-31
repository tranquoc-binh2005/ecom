<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class PostCatalogue extends Model
{
    use HasFactory, NodeTrait, SoftDeletes;

    protected $table = 'post_catalogue';
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'user_id',
        '_lft',
        '_rgt',
        'publish',
        'slug'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'parent_id', 'id');
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            if ($category->isForceDeleting()) {
                $category->posts()->forceDelete();
            } else {
                $category->posts()->delete();
            }
        });
        static::restoring(function ($category) {
            $category->posts()->restore();
        });
    }
}
