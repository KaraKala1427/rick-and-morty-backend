<?php

namespace App\Repositories\Interfaces;

use App\Models\Character;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CharacterRepositoryInterface
{

    public function index($data);

    public function get(int $id);

    public function store($data);

    public function update($id, $data);

    public function destroy($id);

    public function paginate($per_page);


}
