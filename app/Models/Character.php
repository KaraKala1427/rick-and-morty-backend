<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','status','gender','race','description','image_id','birth_location_id','current_location_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function birthLocation()
    {
        return $this->belongsTo(Location::class,'birth_location_id' , 'id');
    }
    public function currentLocation()
    {
        return $this->belongsTo(Location::class,'current_location_id' , 'id');
    }
    public function episodes()
    {
        return $this->belongsToMany(Episode::class);
    }
}
