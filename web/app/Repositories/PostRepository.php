<?php

namespace App\Repositories;

use App\Models\Post;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository implements RepositoryInterface
{
    /**
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Post::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Post::create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return Post::findOrFail($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Post::findOrFail($id)->delete();
    }
}