<?php


namespace App\Services;


use App\Repositories\UserRepository;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserService extends BaseService
{
    protected $repository;

    public function __construct(UserRepository $userRepository){
        $this->repository = $userRepository;
    }
    public function login($data) : ServiceResult
    {
        $user = $this->repository->get($data['phone']);
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'user' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($user->name)->plainTextToken;
        $user['token'] = $token;
        return $this->result($user);
    }
    public function register($data) : ServiceResult
    {
        $data['password'] = Hash::make($data['password']);
        $this->repository->store($data);
        return $this->ok('Пользователь зарегистрирован');
    }

    public function logout($user): ServiceResult
    {
        $user->tokens()->delete();
        return $this->ok('Пользователь разлогинен');
    }

    public function profile() : ServiceResult
    {
        return $this->result(Auth::user());
    }

}
