<?php
namespace App\Repositories\Interface;

interface BaseRepositoryInterface
{
    public function pagination
    (
        array $column = ['*'],
        array $condition = [],
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = []
    );
    public function create(array $data);
    public function findById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
