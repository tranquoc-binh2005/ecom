<?php
namespace App\Repositories;
use App\Repositories\Interface\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
