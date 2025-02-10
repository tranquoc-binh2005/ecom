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

    public function pagination(
        array $column = ['*'],
        array $condition = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = []
    ) {
        $query = $this->model->query();

        $this->applySelectColumns($query, $column);
        $this->applyConditions($query, $condition);
        $this->applyOrdering($query, $orderBy);
        $this->applyJoins($query, $join);

        return $query->paginate($perPage)
            ->withQueryString()
            ->withPath(env('APP_URL') . ($extend['path'] ?? ''));
    }

    private function applySelectColumns($query, array $column)
    {
        if (!empty($column) && is_array($column)) {
            $query->select($column);
        }
    }

    private function applyConditions($query, array $condition): void
    {
        if (!empty($condition['keyword'])) {
            $query->where(function ($query) use ($condition) {
                $query->where('name', 'like', '%' . $condition['keyword'] . '%')
                    ->orWhere('slug', 'like', '%' . $condition['keyword'] . '%');
            });
        }

        foreach (['parent_id', 'product_catalogue_id'] as $field) {
            if (!empty($condition[$field])) {
                $query->where($field, $condition[$field]);
            }
        }

        if (isset($condition['publish']) && $condition['publish'] != -1) {
            $query->where('publish', $condition['publish']);
        }
    }

    private function applyOrdering($query, array $orderBy): void
    {
        if (!empty($orderBy) && count($orderBy) === 2) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
    }

    private function applyJoins($query, array $join): void
    {
        if (!empty($join) && count($join) === 3) {
            $query->join($join[0], $join[1], '=', $join[2]);
        }
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function createBatch(array $data)
    {
        return $this->model->insert($data);
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
