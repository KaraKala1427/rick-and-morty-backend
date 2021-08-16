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

    public function index()
    {
        return $this->characterRepository->index();
    }
    public function get($id)
    {
        return $this->characterRepository->get($id);
    }
    public function store($data)
    {
        return $this->characterRepository->store($data);
    }
    public function update($id, $data)
    {
        return $this->characterRepository->update($id, $data);
    }
    public function destroy($id)
    {
        return $this->characterRepository->destroy($id);
    }
}
