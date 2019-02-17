<?php namespace Modules\Configuration\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_types';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_type_name', 'is_active', 'deletable'];    

    /**
     * The modules that belong to the usertype.
     */
    public function modules()
    {
        return $this->belongsToMany('Modules\Configuration\Entities\Module', 'access_lists', 'user_type', 'module_id')
                    ->withPivot('id','access_view', 'access_add', 'access_publish', 'access_update', 'access_delete', 'access_trash', 'access_reterive');
    }

}