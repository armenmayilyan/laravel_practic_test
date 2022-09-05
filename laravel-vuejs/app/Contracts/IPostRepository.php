<?php


namespace App\Contracts;


interface IPostRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id);

    public function UpdatePost($data, $id);
}
