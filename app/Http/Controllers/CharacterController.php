<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    private $repository;

    public function __construct(CharacterRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getCharacters(){
        try {
            return response()->json(
                [
                    'success' => true,
                    'data' => $this->repository->all()
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            );
        }
    }
}
