<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','season','series','premiere','description','image_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class)->withPivot('created_at', 'updated_at');
    }
}
