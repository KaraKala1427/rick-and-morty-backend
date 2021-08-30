<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserReqisterRequest;
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
        return $this->result($this->service->login($request->validated()));
    }

    public function register(UserReqisterRequest $request)
    {
        return $this->result($this->service->register($request->validated()));
    }
    public function logout(Request $request)
    {
        return $this->result($this->service->logout($request->user()));
    }
}
