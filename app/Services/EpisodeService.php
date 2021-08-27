<?php


namespace App\Services;


use App\Models\Character;
use App\Repositories\CharacterEpisodeRepository;
use App\Repositories\CharacterRepository;
use App\Repositories\EpisodeRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\UploadedFile;

class EpisodeService extends BaseService
{
    protected $repository;
    protected $imageService;
    protected $characterRepository;
    protected $characterEpisodeRepository;

    public function __construct(EpisodeRepository $episodeRepository, ImageService $imageService, CharacterRepository $characterRepository,CharacterEpisodeRepository $characterEpisodeRepository)
    {
        $this->repository = $episodeRepository;
        $this->imageService = $imageService;
        $this->characterRepository = $characterRepository;
        $this->characterEpisodeRepository = $characterEpisodeRepository;
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
     * Эпизод
     */
    public function get($id) : ServiceResult
    {
        $model = $this->repository->get($id);

        if(is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        return $this->result($model);
    }
    /**
     * Сохранить эпизод
     */
    public function store($data) : ServiceResult
    {
        if($this->repository->existsName($data['name'])) {
            return $this->errValidate("Эпизод с таким именем уже существует");
        }

        $this->repository->store($data);
        return $this->ok('Эпизод сохранен');

    }

    /**
     * Изменить эпизод
     */
    public function update($id, $data) : ServiceResult
    {
        $model = $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        if($this->repository->existsName($data['name'],$id)) {
            return $this->errValidate("Эпизод с таким именем уже существует");
        }

        $this->repository->update($id,$data);
        return $this->ok('Эпизод обновлен');
    }

    /**
     * Удалить эпизод
     */
    public function destroy($id)
    {
        $model =  $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        $this->repository->destroy($model);
        return $this->ok('Эпизод удален');
    }


    /**
     * Сохранить картинку эпизода
     */
    public function storeImage($id, UploadedFile $file): ServiceResult
    {
        $model = $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }

        $result = $this->imageService->store($file);
        if(!$result->isSuccess()) {
            return $result;
        }
        $this->repository->updateImageEpisode($id, $result->data['id']);
        return $this->ok('Картинка сохранена');
    }

    /**
     * Удалить картинку эпизода
     */
    public function destroyImage($id)
    {
        if(is_null($this->repository->get($id))) {
            return $this->errNotFound('Эпизод не найден');
        }
        $this->repository->destroyImage($id);
        return $this->ok('Картинка удалена');
    }
    /**
     * Персонажи эпизода
     */
    public function getCharactersPaginate($params, $id) : ServiceResult
    {
        $model = $this->repository->get($id);
        if(is_null($model)) {
            return $this->errNotFound('Эпизод не найден');
        }
        $queryCharacters = $model->characters();
//        dd($queryCharacters);
        $collection = $this->characterRepository->indexPaginate($params, $queryCharacters);
        return $this->result($collection);
    }

    /**
     * Сохранить персонажа в эпизод
     */
    public function storeCharacter($data, $id) : ServiceResult
    {
        if(!is_null($this->characterEpisodeRepository->existsCharacter($data['character_id']))) {
            return $this->errValidate("Персонаж в этом эпизоде уже существует");
        }
        $data['episode_id'] = $id;
        $this->characterEpisodeRepository->store($data);
        return $this->ok('Персонаж эпизода сохранен');

    }

    /**
     * Удалить персонажа из эпизода
     */
    public function destroyCharacter($id, $characterId)
    {
        if(is_null($this->repository->get($id))) {
            return $this->errNotFound('Эпизод не найден');
        }
        if(is_null($this->characterEpisodeRepository->get($characterId))) {
            return $this->errNotFound('Персонаж не найден');
        }
        $this->characterEpisodeRepository->destroy($characterId);
        return $this->ok('Персонаж из эпизода удален');
    }
}
