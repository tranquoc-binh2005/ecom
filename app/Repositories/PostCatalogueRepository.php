<?php
namespace App\Repositories;
use App\Repositories\Interface\PostCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\PostCatalogue;

class PostCatalogueRepository extends BaseRepository implements PostCatalogueRepositoryInterface
{
    public function __construct(PostCatalogue $model)
    {
        parent::__construct($model);
    }
}
