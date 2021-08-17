<?php

namespace App\Http\Controllers;

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

    public function index(Request $request)
    {
        $characters = $this->service->index($request);
        return new CharacterCollection($characters);
    }

    public function show($id)
    {
        $character = $this->service->get($id);
        return new CharacterResource($character);
    }

    public function store(CharacterRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update($id, CharacterRequest $request)
    {
        return $this->service->update($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
