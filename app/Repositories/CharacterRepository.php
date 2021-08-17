<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function index()
    {
        return Character::all();
    }
    public function get($id)
    {
        return Character::findOrFail($id);
    }

    public function store($data)
    {
        Character::Create($data);

        return ["message" => "Персонаж сохранен"];
    }

    public function update($id, $data)
    {
        $character = Character::query()->findOrFail($id);
        $character->update($data);

        return ["message" => "Персонаж обновлен"];
    }
    public function destroy($id)
    {
        $character = Character::query()->findOrFail($id);
        $character->delete();

        return ["message" => "Персонаж удален"];
    }

    public function paginate($per_page = 3)
    {
        return Character::paginate($per_page);
    }
}
