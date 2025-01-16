<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'parent_id',
        'user_id',
        'publish',
        'order',
        'slug',
        'name',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'tags',
        'time_read',
        'image',

    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_UNPUBLISHED = 'unpublished';
    const STATUS_PUBLISHED = 'published';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post_catalogues()
    {
        return $this->belongsTo(PostCatalogue::class, 'parent_id', 'id');
    }
}
