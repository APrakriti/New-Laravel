<?php namespace Modules\Configuration\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class AccessList extends Controller {
	
	public function index()
	{
		return view('configuration::index');
	}
	
}