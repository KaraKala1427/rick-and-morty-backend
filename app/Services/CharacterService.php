<?php


namespace App\Services;


use App\Repositories\CharacterRepository;
use App\Repositories\ImageRepository;
use phpDocumentor\Reflection\Types\Integer;

class CharacterService extends BaseService
{
    protected $repository;
    protected $imageRepository;
    protected $imageService;

    public function __construct(CharacterRepository $characterRepository, ImageRepository $imageRepository, ImageService $imageService){
        $this->repository = $characterRepository;
        $this->imageRepository = $imageRepository;
        $this->imageService = $imageService;
    }

    /**
     * список с пагинацией
     */
    public function indexPaginate($params) : ServiceResult
    {
        $collection = $this->repository->indexPaginate($params);
        $collection->each(function ($model){
            $model['image'] = isset($model->image_id) ? $this->imageRepository->get($model->image_id) : null;
        });

        return $this->result($collection);
    }
    /**
     * Персонаж
     */
    public function get($id) : ServiceResult
    {
        $model = $this->repository->get($id);

        if(is_null($model))
        {
            return $this->errNotFound('Персонаж не найден');
        }
        $model['image'] = isset($model->image_id) ? $this->imageRepository->get($model->image_id) : null;
        return $this->result($model);
    }
    /**
     * Сохранить персонажа
     */
    public function store($data) : ServiceResult
    {
        if($this->repository->existsName($data['name']))
        {
            return $this->errValidate("Персонаж с таким именем уже существует");
        }

        if (isset($data['image_id'])){
            $model = $this->imageRepository->get($data['image_id']);
            if(is_null($model))
            {
                return $this->errNotFound('Картинка с такой id не найден');
            }
            if($this->repository->busyImage($data['image_id']))
            {
                return $this->errValidate("Картинка занята");
            }
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
        if(is_null($model))
        {
            return $this->errNotFound('Персонаж не найден');
        }
        if($this->repository->existsName($data['name'],$id))
        {
            return $this->errValidate("Персонаж с таким именем уже существует");
        }
        if (isset($data['image_id'])){
            $model = $this->imageRepository->get($data['image_id']);
            if(is_null($model))
            {
                return $this->errNotFound('Картинка с такой id не найден');
            }
            if($this->repository->existsImage($data['image_id'], $id))
            {
                return $this->errValidate("Картинка занята");
            }
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
        if(is_null($model))
        {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->repository->destroy($model);
        return $this->ok('Персонаж удален');
    }
}
