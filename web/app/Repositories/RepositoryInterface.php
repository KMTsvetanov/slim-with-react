<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}