<?php


namespace App\Repositories;


use App\Models\Character;
use App\Models\Image;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class EpisodeRepository
{
    public function indexPaginate($params, $query = null)
    {
        $perPage = $params['per_page'] ?? 4;
        return $this->prepareQuery($params, $query)->paginate($perPage);
    }
    public function index($params): Collection
    {
        return $this->prepareQuery($params)->get();
    }

    private function prepareQuery($params, $query = null)
    {
        if(!$query){
          $query = Episode::select('*');
        }
        $query = $query->with(['image']);
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

    public function get(int $id) : ?Episode
    {
        return Episode::find($id);
    }

    public function store($data)
    {
        return Episode::Create($data);
    }

    public function update($id, $data)
    {
        return $this->get($id)->update($data);
    }
    public function destroy($model)
    {
        return $model->delete();
    }

    public function existsName($name, $id = null) : bool
    {
        return !is_null(Episode::where('name',$name)
            ->when($id, function ($query) use ($id) {
                return $query->where('id','<>',$id);
            })
            ->first());
    }

    public function updateImageEpisode($id, $imageId)
    {
        return Episode::where('id', $id)->update(array('image_id' => $imageId));
    }
    public function destroyImage($id)
    {
        return Episode::where('id', $id)->update(array('image_id' => null));
    }

}
