<?php


namespace App\Services;


use App\Repositories\CharacterRepository;
use phpDocumentor\Reflection\Types\Integer;

class CharacterService extends BaseService
{
    protected $repository;
    protected $imageService;

    public function __construct(CharacterRepository $characterRepository, ImageService $imageService)
    {
        $this->repository = $characterRepository;
        $this->imageService = $imageService;
    }

    /**
     * список с пагинацией
     */
    public function indexPaginate($params) : ServiceResult
    {
        $collection = $this->repository->indexPaginate($params);
        return $this->result($collection);
    }
    /**
     * Персонаж
     */
    public function get($id) : ServiceResult
    {
        $model = $this->repository->get($id);

        if(is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        return $this->result($model);
    }
    /**
     * Сохранить персонажа
     */
    public function store($data) : ServiceResult
    {
        if($this->repository->existsName($data['name'])) {
            return $this->errValidate("Персонаж с таким именем уже существует");
        }

        $this->repository->store($data);
        return $this->ok('Персонаж сохранен');

    }

    /**
     * Изменить персонажа
     */
    public function update($id, $data) : ServiceResult
    {
        $model = $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        if($this->repository->existsName($data['name'],$id)) {
            return $this->errValidate("Персонаж с таким именем уже существует");
        }

        $this->repository->update($id,$data);
        return $this->ok('Персонаж обновлен');
    }

    /**
     * Удалить персонажа
     */
    public function destroy($id)
    {
        $model =  $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->repository->destroy($model);
        return $this->ok('Персонаж удален');
    }

    /**
     * Персонажи эпизода
     */
//    public function getCharactersPaginate($params, $id) : ServiceResult
//    {
//
//        $collection = $this->repository->indexPaginate($params, $query);
//        return $this->result($collection);
//    }
}
