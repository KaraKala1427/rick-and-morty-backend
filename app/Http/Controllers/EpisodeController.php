<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterIndexRequest;
use App\Http\Requests\CharacterRequest;
use App\Http\Requests\EpisodeCharacterRequest;
use App\Http\Requests\EpisodeRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Http\Resources\EpisodeCollection;
use App\Http\Resources\EpisodeResource;
use App\Services\CharacterService;
use App\Services\EpisodeService;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    private $service, $characterService;

    public function __construct(EpisodeService $service, CharacterService $characterService)
    {
        $this->service = $service;
        $this->characterService = $characterService;
    }

    public function index(EpisodeRequest $request)
    {
        $characters = $this->service->indexPaginate($request->validated());
        return $this->resultCollection(EpisodeCollection::class,$characters);
    }

    public function show($id)
    {
        $model = $this->service->get($id);
        return $this->resultResource(EpisodeResource::class,$model);
    }

    public function store(EpisodeRequest $request)
    {
        $model = $this->service->store($request->validated());
        return $this->result($model);
    }

    public function update($id, EpisodeRequest $request)
    {
        $model = $this->service->update($id, $request->validated());
        return $this->result($model);
    }

    public function destroy($id)
    {
        $model =  $this->service->destroy($id);
        return $this->result($model);
    }

    public function storeImage($id, ImageRequest $request)
    {
        $data = $request->validated();
        return $this->result($this->service->storeImage($id,$data['file']));
    }

    public function destroyImage($id)
    {
        return $this->result($this->service->destroyImage($id));
    }

    public function getCharacters(CharacterIndexRequest $request, $id)
    {
        $characters = $this->service->getCharactersPaginate($request->validated(), $id);
        return $this->resultCollection(CharacterCollection::class,$characters);
    }

    public function storeCharacter(EpisodeCharacterRequest $request, $id){
        $model = $this->service->storeCharacter($request->validated(),$id);
        return $this->result($model);
    }

    public function deleteCharacter($id, $characterId)
    {
        $model =  $this->service->destroyCharacter($id, $characterId);
        return $this->result($model);
    }
}
