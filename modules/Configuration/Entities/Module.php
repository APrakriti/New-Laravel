<?php namespace Modules\Configuration\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Module extends Model
//    implements SluggableInterface
{
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
    protected $fillable = ['parent_id', 'module_name', 'slug', 'is_active', 'editable'];

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

    /**
     * The modules that have children modules.
     */
    public function childrens()
    {
        return $this->hasMany('Modules\Configuration\Entities\Module', 'parent_id');
    }

    /**
     * The parent module of the module.
     */
    public function parent()
    {
        return $this->belongsTo('Modules\Configuration\Entities\Module', 'parent_id');
    }
}