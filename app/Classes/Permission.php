<?php namespace App\Classes;

use Auth;

/**
 * @auther Sunil Adhikari <adhikarysunil.1@gmail.com>
 */
class Permission
{
    public function hasAccess($slug)
    {
        $flag = false;
        $modules = session()->get('access_modules');
        if($modules){
        	$flag = in_array($slug, $modules);
        }
        return $flag;
    }
}