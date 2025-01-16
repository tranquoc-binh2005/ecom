<?php
namespace App\Repositories;
use App\Models\Attribute;
use App\Repositories\Interface\AttributeRepositoryInterface;
use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }
}
