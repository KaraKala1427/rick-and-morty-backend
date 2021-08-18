<?php


namespace App\Services;


use App\Repositories\CharacterRepository;
use phpDocumentor\Reflection\Types\Integer;

class CharacterService extends BaseService
{
    protected $repository;

    public function __construct(CharacterRepository $characterRepository){
        $this->repository = $characterRepository;
    }

    /**
     * список с пагинацией
     */
    public function indexPaginate($params) : ServiceResult
    {
        return $this->result($this->repository->indexPaginate($params));
    }
    /**
     * Персонаж
     */
    public function get($id) : ServiceResult
    {
        $model =  $this->repository->get($id);
        if(is_null($model)){
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }
    /**
     * Сохранить персонажа
     */
    public function store($data)
    {
        $model =  $this->repository->store($data);
        if($model) return ["message" => "Персонаж сохранен"];

    }

    /**
     * Изменить персонажа
     */
    public function update($id, $data)
    {
        $model = $this->repository->update($id, $data);
        if($model) return ["message" => "Персонаж обновлен"];
    }

    /**
     * Удалить персонажа
     */
    public function destroy($id)
    {
        $model =  $this->repository->destroy($id);
        if($model) return ["message" => "Персонаж удален"];
    }
}
