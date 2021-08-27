<?php


namespace App\Repositories;


use App\Models\Character;
use App\Models\CharacterEpisode;
use App\Models\Image;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CharacterEpisodeRepository
{

    public function get($id)
    {
        return CharacterEpisode::find($id);
    }
    public function store($data)
    {
        return CharacterEpisode::Create($data);
    }

    public function destroy($id)
    {
        return $this->get($id)->delete();
    }
    public function existsCharacter($characterId,$episodeId)
    {
        return CharacterEpisode::where('character_id',$characterId)->where('episode_id',$episodeId)->first();
    }
}
