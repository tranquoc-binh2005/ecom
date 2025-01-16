<?php
namespace App\Repositories;
use App\Models\Permission;
use App\Repositories\Interface\PermissionRepositoryInterface;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
