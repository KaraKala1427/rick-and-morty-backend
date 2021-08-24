<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['type','dimension','name','description','image_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class,'current_location_id','id');
    }
}
