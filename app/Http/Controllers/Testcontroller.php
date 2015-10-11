<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Testcontroller extends Controller
{
	
    //
	public function index() {
		$task = [
				[
						'name' => 'Design New Dashboard',
						'progress' => '87',
						'color' => 'danger'
				],
				[
						'name' => 'Create Home Page',
						'progress' => '76',
						'color' => 'warning'
				],
				[
						'name' => 'Some Other Task',
						'progress' => '32',
						'color' => 'success'
				],
				[
						'name' => 'Start Building Website',
						'progress' => '56',
						'color' => 'info'
				],
				[
						'name' => 'Develop an Awesome Algorithm',
						'progress' => '10',
						'color' => 'success'
				]
		];
// 		return view('admin.pages.test')->with($data);
		
		return view('backend.pages.test',compact('task'));
	}
}
