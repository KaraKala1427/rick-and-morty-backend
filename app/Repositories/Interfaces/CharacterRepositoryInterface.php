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
    public function index($columns = ['*']);

    /**
     * @param $id
     * @return Character|null
     * @throws ModelNotFoundException
     */
    public function get($id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);


}
