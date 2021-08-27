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

    public function store(ImageRequest $request)
    {
        $data = $request->validated();
        $model = $this->service->store($data['file']);
        return $this->resultResource(ImageResource::class,$model);
    }
    public function destroy($id)
    {
        $model =  $this->service->destroy($id);
        return $this->result($model);
    }
}
