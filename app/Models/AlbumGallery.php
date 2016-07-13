<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumGallery extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'album_galleries';

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

    public function album()
    {
        return $this->belongsTo('App\Models\Album', 'album_id');
    }
}
