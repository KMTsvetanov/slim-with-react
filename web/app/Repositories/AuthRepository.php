<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class AuthRepository
 * @package App\Repositories
 */
class AuthRepository implements RepositoryInterface
{
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return User::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return User::create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return User::findOrFail($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }
}