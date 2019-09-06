<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Helpers\Str;
use DB;

class FindersController extends Controller{
	
	public function find () {
		// header ( 'content-type:text/html; charset=utf-8') ;

        return \App\Helpers\FinderPage::like(Page::class);
	}
}

?>