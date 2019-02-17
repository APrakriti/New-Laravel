<?php 
namespace App;
   
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\Sluggable;

class Module extends Model
//    implements SluggableInterface
{
    use  Sluggable;
//    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'module', 'slug', 'is_active', 'editable'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are used by Sluggable.
     *
     * @var array-
     */
//    protected $sluggable = [
//        'build_from' => 'module_name',
//        'save_to'    => 'slug',
//    ];
      public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'module'
            ]
        ];
    }

    /**
     * The modules that have children modules.
     */
    public function childrens()
    {
        return $this->hasMany('App\Module', 'parent_id');
    }

    /**
     * The parent module of the module.
     */
    public function parent()
    {
        return $this->belongsTo('App\Module', 'parent_id');
    }
}