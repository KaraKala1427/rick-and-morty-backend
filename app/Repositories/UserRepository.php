<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function getUserByPhone($phone)
    {
        return User::where('phone',$phone)->first();
    }
    public function store($data)
    {
        return User::create($data);
    }
}
