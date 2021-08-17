<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function index($request)
    {
//        $characters = Character::query()->where('name','LIKE',"%{$nameFilter}%")->get();
        $characters = Character::all();
        if ($request->has('status')){
            $characters = $characters->whereIn('status',$request->status);
        }
        if($request->has('gender')){
            $characters = $characters->whereIn('gender',$request->gender);
        }
        if($request->has('race')){
            $characters = $characters->whereIn('race',$request->race);
        }
        if($request->has('per_page')){
            $characters = $characters->paginate($request->per_page);
        }
//        if ($request->has('name')){
//            $characters = $characters->where('name','LIKE',"%{$request->name}%")->get();
//        }
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
