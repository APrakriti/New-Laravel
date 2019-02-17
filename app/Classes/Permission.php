<?php namespace App\Classes;

use App\AccessList;
use App\UserType;

use Auth;



class Permission
{
    public function hasAccess($slug, $action)
    {
        $flag = false;

        $modules = session()->get('modules');

       if(count($modules)>0)
        foreach ($modules as $module) {
            if ($module->slug == $slug) {
                $flag = ($module->pivot->$action == '1') ? true : false;
            }
            if ($flag) break;
        }
         return $flag;
    }

       
    }
