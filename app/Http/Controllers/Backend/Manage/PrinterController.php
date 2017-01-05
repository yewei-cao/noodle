<?php

namespace App\Http\Controllers\Backend\Manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Prints\Printer;

class PrinterController extends Controller
{
	public function index(){
		
		$printer = new Printer;
		$result = $printer->queryPrinterStatus();
    	return view('backend.pages.manage.printer')
    	->withprinter($result); 
    }
}
