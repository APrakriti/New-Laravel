<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Album extends Model implements SluggableInterface
{
    use SoftDeletes, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at','deleted_at'];

    /**
     * The attributes used for create unique slug.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'caption',
        'save_to'    => 'slug',
    ];

    public function galleries()
    {
        return $this->hasMany('App\Models\AlbumGallery', 'album_id');
    }
}
