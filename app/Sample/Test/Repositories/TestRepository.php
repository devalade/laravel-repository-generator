<?php

namespace App\Sample\Test\Repositories;

use Illuminate\Database\Eloquent\Model;

class TestRepository
{
    /**
     *  @var Model
     */
    protected $model;

    /**
     * TestRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all(array $columns = ['*'], string $orderBy = 'id', string $sortBy = 'asc', array $relations = [], array $wheres = [])
    {
        return $this->model->with($relations)->where($wheres)->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param  string  $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @return mixed
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    }

    /**
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * @return mixed
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $data, Model $model = null): bool
    {
        if (! is_null($model)) {
            return $model->update($data);
        }

        return $this->model->update($data);
    }

    /**
     * @throws \Exception
     */
    public function delete(): bool
    {
        return $this->model->delete();
    }
}
