<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserReqisterRequest;
use App\Http\Resources\UserLoginResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    public function login(UserLoginRequest $request)
    {
        $model = $this->service->login($request->validated());
        return $this->resultResource(UserLoginResource::class, $model);
    }

    public function register(UserReqisterRequest $request)
    {
        $model = $this->service->register($request->validated());
        return $this->result($model);
    }
    public function logout(Request $request)
    {
        $model = $this->service->logout($request->user());
        return $this->result($model);
    }
}
