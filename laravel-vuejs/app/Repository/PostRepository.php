<?php


namespace App\Repository;


use App\Contracts\IPostRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements IPostRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     */
    public function deletePost($id)
    {
        $this->model->query()->find($id)->delete();
    }

    public function updatePost($data, $id)
    {
        $this->model->query()->find($id)->update($data);
    }

}
