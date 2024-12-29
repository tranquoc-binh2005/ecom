<?php
namespace App\Repositories;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
