<?php

namespace App\Repositories\Interfaces;

use App\Models\Character;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CharacterRepositoryInterface
{
    /**
     * @param string[] $columns
     * @return array
     */
    public function all($columns = ['*']);

    /**
     * @param $id
     * @return Character|null
     * @throws ModelNotFoundException
     */
    public function getById($id);

    public function create($data);

    public function delete($id);

    public function update($id, $data);

}
