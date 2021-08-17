<?php


namespace App\Services;


use App\Repositories\CharacterRepository;
use phpDocumentor\Reflection\Types\Integer;

class CharacterService
{
    protected $characterRepository;

    public function __construct(CharacterRepository $characterRepository){
        $this->characterRepository = $characterRepository;
    }

    public function index($request)
    {
        return $this->characterRepository->index($request);
    }
    public function get($id)
    {
        return $this->characterRepository->get($id);
    }
    public function store($data)
    {
        $character =  $this->characterRepository->store($data);
        if($character) return ["message" => "Персонаж сохранен"];

    }
    public function update($id, $data)
    {
        $character = $this->characterRepository->update($id, $data);
        if($character) return ["message" => "Персонаж обновлен"];
    }
    public function destroy($id)
    {
        $character =  $this->characterRepository->destroy($id);
        if($character) return ["message" => "Персонаж удален"];
    }
}
