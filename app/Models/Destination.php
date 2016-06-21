<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Destination extends Model implements SluggableInterface
{
    use SoftDeletes, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'destinations';

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
     * Get the packages for the destination.
     */
    public function packages()
    {
        return $this->hasMany('App\Models\Package', 'destination_id');
    }

    /**
     * Get the active packages for the destination.
     */
    public function activePackages()
    {
        return $this->packages()
            ->with('coverGallery')
            ->where('is_active', 1)
            ->orderBy('order_position');
    }

    /**
     * Get the active packages for the destination at footer.
     */
    public function footerPackages()
    {
        return $this->packages()
            ->where('is_active', 1)
            ->orderBy('order_position')
            ->take(8);
    }
}
