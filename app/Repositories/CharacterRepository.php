<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function all($columns = ['id','name','status','gender','race','description'])
    {
        return Character::all($columns);
    }
    public function getById($id)
    {
        return Character::findOrFail($id, $columns = array('id','name','status','gender','race','description'));
    }

    public function create($data)
    {
        Character::query()->updateOrCreate($data);

        return response()->json(
            [
            "message" => "Персонаж сохранен"
            ]
        );
    }

    public function delete($id)
    {
        $character = Character::query()->findOrFail($id);
        $character->delete();

        return response()->json(
            [
                "message" => "Персонаж удален"
            ]
        );
    }

    public function update($id, $data)
    {
        $character = Character::query()->findOrFail($id);
        $character->update($data);

        return response()->json(
            [
                "message" => "Персонаж обновлен"
            ]
        );
    }

}
