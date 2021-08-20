<?php


namespace App\Services;


use App\Repositories\CharacterRepository;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Integer;

class ImageService extends BaseService
{
    protected $repository;

    public function __construct(ImageRepository $imageRepository){
        $this->repository = $imageRepository;
    }

    /**
     * Картинка
     */
    public function get($id) : ServiceResult
    {
        $model = $this->repository->get($id);
        if(is_null($model))
        {
            return $this->errNotFound('Картинка не найдена');
        }
        return $this->result($model);
    }
    /**
     * Сохранить картинку
     */
    public function store($data) : ServiceResult
    {
        $file = $data['image'];
        $newName = $file->hashName();
        Storage::putFileAs('public/images',$file,$newName);

        $data = ['path' => Storage::url('images/'.$newName)];
        $model =  $this->repository->store($data);
        return $this->result($model);

    }


    /**
     * Удалить картинку
     */
    public function destroy($id)
    {
        $model =  $this->repository->get($id);
        if(is_null($model))
        {
            return $this->errNotFound('Картинка не найдена');
        }
        Storage::disk('public')->delete('images/');

        $this->repository->destroy($model);
        return $this->ok('Картинка удалена');
    }
}
