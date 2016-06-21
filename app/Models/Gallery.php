<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'package_gallery';

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
     * Get the package that owns the package gallery.
     */
    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id');
    }
}
