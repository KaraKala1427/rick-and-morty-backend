<?php


namespace App\Repositories;


use App\Models\Character;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
    public function get($id)
    {
        return Image::find($id);
    }
    public function store($data)
    {
        return Image::Create($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }


}
