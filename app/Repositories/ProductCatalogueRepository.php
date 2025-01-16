<?php
namespace App\Repositories;
use App\Models\ProductCatalogue;
use App\Repositories\Interface\ProductCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductCatalogueRepository extends BaseRepository implements ProductCatalogueRepositoryInterface
{
    public function __construct(ProductCatalogue $model)
    {
        parent::__construct($model);
    }
}
