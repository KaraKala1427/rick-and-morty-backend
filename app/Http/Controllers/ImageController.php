<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function show($id)
    {
        $model = $this->service->get($id);
        return $this->resultResource(ImageResource::class,$model);
    }
    public function store(ImageRequest $request)
    {
        $model = $this->service->store($request->validated());
        return $this->resultResource(ImageResource::class,$model);
    }
    public function destroy($id)
    {
        $model =  $this->service->destroy($id);
        return $this->result($model);
    }
}
