<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
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

    public function index()
    {
        return $this->service->index();
    }

    public function get($id)
    {
        return  $this->service->get($id);
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
