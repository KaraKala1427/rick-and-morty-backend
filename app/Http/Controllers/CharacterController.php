<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
{
    private $repository;

    public function __construct(CharacterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCharacters()
    {
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

    public function getCharacterById($id)
    {
        try {
            return response()->json(
                [
                    'success' => true,
                    'data' => $this->repository->getById($id)
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

    public function createCharacter(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'status' => 'required',
                    'gender' => 'required',
                    'race' => 'required',
                ]
            );

            if ($validation->fails()) {
                return [
                    "success" => false,
                    "errors" => $validation->errors()
                ];
            }
            $character = $this->repository->create($request->all());

            return response()->json(
                [
                    'success' => true,
                    'data' => $character
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

    public function updateCharacter($id, Request $request) {
        try {

            return response()->json(
                [
                    'success'   => true,
                    'data'      => $this->repository->update($id, $request->all())
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

    public function deleteCharacter($id) {
        try {

            return response()->json(
                [
                    'success'   => false,
                    'data'      => $this->repository->delete($id)
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
