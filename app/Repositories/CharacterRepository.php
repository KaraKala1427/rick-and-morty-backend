<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function index($columns = ['id','name','status','gender','race','description'])
    {
        return Character::all($columns);
    }
    public function get($id)
    {
        return Character::findOrFail($id, $columns = array('id','name','status','gender','race','description'));
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


}
