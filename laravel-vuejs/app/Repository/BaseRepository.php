<?php


namespace App\Repository;


use App\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed|void
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|mixed|null
     */
    public function getOne($id)
    {
        return $this->model->query()->find($id);
    }

}
