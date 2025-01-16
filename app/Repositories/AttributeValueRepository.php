<?php
namespace App\Repositories;
use App\Models\AttributeValue;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\AttributeValueRepositoryInterface;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{
    public function __construct(AttributeValue $model)
    {
        parent::__construct($model);
    }
}
