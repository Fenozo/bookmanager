<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Response;
use DB;


class StoriesController extends Controller 
{

	public function index() {


		/**
		* Lister les 3 dérnier cliques du show
		*/
		$story_pages = DB::table("pages")
						->join("stories", "pages.id", "stories.index_object")
						->select("pages.*","stories.action_type","stories.id as story_id")
						->orderBy('stories.id','desc')
						->Paginate(3);

		return new Response(json_encode($story_pages));
	}

}