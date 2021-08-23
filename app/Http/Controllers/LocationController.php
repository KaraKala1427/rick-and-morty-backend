<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationIndexRequest;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\LocationResource;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }

    public function index(LocationIndexRequest $request)
    {
        $characters = $this->service->indexPaginate($request->validated());
        return $this->resultCollection(LocationCollection::class,$characters);
    }

    public function show($id)
    {
        $model = $this->service->get($id);
        return $this->resultResource(LocationResource::class,$model);
    }

    public function store(LocationRequest $request)
    {
        $model = $this->service->store($request->validated());
        return $this->result($model);
    }

    public function update($id, LocationRequest $request)
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
