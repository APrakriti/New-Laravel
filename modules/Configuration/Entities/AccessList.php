<?php namespace Modules\Configuration\Entities;
   
use Illuminate\Database\Eloquent\Model;

class AccessList extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'access_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_type', 'module_id', 'access_view', 'access_add', 'access_publish', 'access_update', 'access_delete', 'access_upload', 'access_download', 'is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}