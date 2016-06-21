<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Package extends Model implements SluggableInterface
{
    use SoftDeletes, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'packages';

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
        'build_from' => 'heading',
        'save_to'    => 'slug',
    ];

    /**
     * Get the destination that owns the package.
     */
    public function destination()
    {
        return $this->belongsTo('App\Models\Destination','destination_id');
    }

    /**
     * Get the galleries for the package.
     */
    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery', 'package_id');
    }

    /**
     * Get the cover gallery for the package.
     */
    public function coverGallery()
    {
        return $this->galleries()
            ->where('is_cover', 1)
            ->where('is_active', 1);        
    }

    /**
     * Get the active galleries for the package.
     */
    public function activeGalleries()
    {
        return $this->galleries()
            ->where('is_active', 1);        
    }

    /**
     * Get the bookings for the package.
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'package_id');
    }
}
