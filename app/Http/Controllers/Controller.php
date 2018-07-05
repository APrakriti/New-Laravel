<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function __construct() {

        $last_segment = last(request()->segments());

        if ($last_segment == 'outbound') 
        {
            Session::pull( 'bound_type');
            Session::set( 'bound_type', 'outbound' );

        } 
        elseif ($last_segment == 'inbound' || !Session::get( 'bound_type')) {
            Session::pull( 'bound_type');
            Session::set( 'bound_type', 'inbound' );
        }
    }
}
