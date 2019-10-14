<?php
namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;

class CoursController extends Controller
{


	public function list()
	{
		return view("backOffice.cours.list");
	}
}
?>