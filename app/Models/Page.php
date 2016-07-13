<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug','title','meta_tags','meta_description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at'];
}