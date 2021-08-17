<?php


namespace App\Repositories;


use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CharacterRepository implements CharacterRepositoryInterface
{
    public function index($request)
    {
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
        if ($request->has('name')){
            $characters = Character::query()->where('name','LIKE',"%{$request->name}%")->get();
//            $characters = $characters->where('name','LIKE',"%{$request->name}%");
        }
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
        $character = $this->get($id)->update($data);
        return $character;

    }
    public function destroy($id)
    {
        $character = $this->get($id)->delete();
        return $character;
    }

    public function paginate($per_page)
    {
        // TODO: Implement paginate() method.
    }

}
