<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function index()
    {
        $nameFilter = request('name');

        $characters = Character::query()
            ->where('name','LIKE',"%{$nameFilter}%")
            ->get();
        return $characters;
    }
    public function get($id)
    {
        return Character::findOrFail($id);
    }

    public function store($data)
    {
        return Character::Create($data);

    }

    public function update($id, $data)
    {
        $character = Character::query()->findOrFail($id);
        $character->update($data);
        return $character;

    }
    public function destroy($id)
    {
        $character = Character::query()->findOrFail($id);
        $character->delete();
        return $character;

    }

    public function paginate($per_page = 3)
    {
        return Character::paginate($per_page);
    }
}
