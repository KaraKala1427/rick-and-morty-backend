<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function all($columns = ['*'])
    {
        return Character::all($columns);
    }
    public function getById($id)
    {
        return Character::findOrFail($id);
    }

}
