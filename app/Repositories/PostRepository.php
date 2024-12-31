<?php
namespace App\Repositories;
use App\Models\Post;
use App\Repositories\Interface\PostRepositoryInterface;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
