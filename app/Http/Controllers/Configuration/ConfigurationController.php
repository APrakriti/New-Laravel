<?php namespace App\Http\Controllers\Configuration;

use Pingpong\Modules\Routing\Controller;

class ConfigurationController extends Controller {
	
	public function index()
	{
		return view('configuration::index');
	}
	
}