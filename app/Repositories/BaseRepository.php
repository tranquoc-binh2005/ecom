<?php
namespace App\Repositories;
use App\Repositories\Interface\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function pagination
    (
        array $column = ['*'],
        array $condition = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
    )
    {
        $query = $this->model->query();
        if(!empty($column) && is_array($column)){
            $query->select($column);
        }

        if (!empty($condition['keyword'])) {
            $query->where(function ($query) use ($condition) {
                $query->where('name', 'like', '%' . $condition['keyword'] . '%')
                    ->orWhere('description', 'like', '%' . $condition['keyword'] . '%');
            });
        }

        if (!empty($condition['parent_id'])) {
            $query->where(function ($query) use ($condition) {
                $query->where('parent_id', $condition['parent_id']);
            });
        }

        if(!empty($condition['publish']) && $condition['publish'] != -1){
            $query->where('publish', $condition['publish']);
        }
        if(!empty($orderBy) && is_array($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        if(!empty($join) && is_array($join)){
            $query->join($join[0], $join[1], '=' , $join[2]);
        }
        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->update($data);
        }
        return $model;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function detachPivot(int $id)
    {
        return $this->model->find($id);
    }
}
