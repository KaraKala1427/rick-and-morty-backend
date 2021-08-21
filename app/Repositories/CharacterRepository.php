<?php


namespace App\Repositories;


use App\Models\Character;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CharacterRepository
{
    public function indexPaginate($params)
    {
        $perPage = $params['per_page'] ?? 4;
        return $this->prepareQuery($params)->paginate($perPage);
    }
    public function index($params): Collection
    {
        return $this->prepareQuery($params)->get();
    }

    private function prepareQuery($params)
    {
        $query = Character::select("*");
        $query = $this->queryApplyFilter($query,$params);
        $query = $this->queryApplySort($query,$params);
        return $query;
    }
    private function queryApplyFilter($query,$params)
    {
        if(isset($params['name'])){
            $query->where(function ($subQuery) use ($params){
               $subQuery->where('name','LIKE',"%{$params['name']}%")
                   ->orWhere('description','LIKE',"%{$params['name']}%");
            });
        }
        if(isset($params['status'])){
            if(is_array($params['status'])){
                $query->whereIn('status',$params['status']);
            }
            else {
                $query->where('status',$params['status']);
            }
        }
        if(isset($params['gender'])){
            if(is_array($params['gender'])){
                $query->whereIn('gender',$params['gender']);
            }
            else {
                $query->where('gender',$params['gender']);
            }
        }
        if(isset($params['race'])){
            if(is_array($params['race'])){
                $query->whereIn('race',$params['race']);
            }
            else {
                $query->where('race',$params['race']);
            }
        }
        return $query;
    }

    private function queryApplySort($query,$params){
        if(isset($params['sort']) && isset($params['order'])){
            $query->orderBy($params['sort'],$params['order']);
        }
        elseif (isset($params['sort']) && !isset($params['order'])){
            $query->orderBy($params['sort']);
        }
        return $query;
    }

    /**
     * Получить персонажа
     */
    public function get(int $id) : ?Character
    {
        return Character::find($id);
    }

    public function store($data)
    {
        return Character::Create($data);
    }

    public function update($id, $data)
    {
        return $this->get($id)->update($data);
    }
    public function destroy($model)
    {
        return $model->delete();
    }

    public function existsName(string $name, int $id = null){
        $model = Character::find($id);

        if(isset($model->name) && $model->name == $name) return false;
        elseif(Character::where('name',$name)->first() === null) return false;

        return true;
    }
    public function existsImage(int $imageId , int $id = null)
    {
        $model = Character::find($id);
        if (isset($id) && $model->image_id == $imageId) return false;
        elseif(Character::where('image_id',$imageId)->first() === null) return false;
        return true;
    }


}
