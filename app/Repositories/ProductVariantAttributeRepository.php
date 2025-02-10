<?php
namespace App\Repositories;
use App\Models\ProductVariantAttribute;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\ProductVariantAttributeRepositoryInterface;

class ProductVariantAttributeRepository extends BaseRepository implements ProductVariantAttributeRepositoryInterface
{
    public function __construct(ProductVariantAttribute $model)
    {
        parent::__construct($model);
    }
}
