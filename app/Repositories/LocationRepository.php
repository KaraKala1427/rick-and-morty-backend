<?php


namespace App\Repositories;


use App\Models\Character;
use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class LocationRepository
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
        $query = Location::with(['image']);
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
        if(isset($params['type'])){
            if(is_array($params['type'])){
                $query->whereIn('type',$params['type']);
            }
            else {
                $query->where('type',$params['type']);
            }
        }
        if(isset($params['dimension'])){
            if(is_array($params['dimension'])){
                $query->whereIn('dimension',$params['dimension']);
            }
            else {
                $query->where('dimension',$params['dimension']);
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

    public function get(int $id) : ?Location
    {
        return Location::find($id);
    }
    public function getCharacters(int $id)
    {
        return Location::find($id)->characters;
    }

    public function store($data)
    {
        return Location::Create($data);
    }

    public function update($id, $data)
    {
        return $this->get($id)->update($data);
    }
    public function destroy($model)
    {
        return $model->delete();
    }

    public function existsName(string $name, int $id = null)
    {
        $model = Location::find($id);

        if(isset($model->name) && $model->name == $name) return false;
        elseif(Location::where('name',$name)->first() === null) return false;

        return true;
    }

}
