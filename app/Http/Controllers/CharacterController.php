<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterIndexRequest;
use App\Http\Requests\CharacterRequest;
use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Repositories\CharacterRepository;
use App\Services\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
{
    private $service;

    public function __construct(CharacterService $service)
    {
        $this->service = $service;
    }

    public function index(CharacterIndexRequest $request)
    {
        $characters = $this->service->indexPaginate($request->validated());
        return $this->resultCollection(CharacterCollection::class,$characters);
    }

    public function show($id)
    {
        $model = $this->service->get($id);
        return $this->resultResource(CharacterResource::class,$model);
    }

    public function store(CharacterRequest $request)
    {
        $model = $this->service->store($request->validated());
        return $this->result($model);
    }

    public function update($id, CharacterRequest $request)
    {
        $model = $this->service->update($id, $request->validated());
        return $this->result($model);
    }

    public function destroy($id)
    {
        $model =  $this->service->destroy($id);
        return $this->result($model);
    }
}
