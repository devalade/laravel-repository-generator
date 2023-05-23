<?php

namespace App\Sample\Base\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', array $relations = [], array $wheres = []);

    /**
     * @param  string  $id
     * @return mixed
     */
    public function find($id);

    /**
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneOrFail($id);

    /**
     * @return Collection
     */
    public function findBy(array $data);

    /**
     * @return mixed
     */
    public function findOneBy(array $data);

    /**
     * @return mixed
     *
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data);

    /**
     * @return mixed
     */
    public function create(array $attributes);

    public function update(array $data, Model $model = null): bool;

    /**
     * @throws \Exception
     */
    public function delete(): bool;
}
