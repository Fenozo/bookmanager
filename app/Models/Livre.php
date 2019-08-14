<?php

namespace App\Models;

use App\Model\Traits\{Sluggable, SlugRoutable};
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use SlugRoutable, Sluggable;


	protected $guarded = ['id'];

	protected $dates = ['created_at'];
	protected $fillable = ['title','description'];

	protected static function boot () 
	{
		parent::boot();

		static::deleting(function($event){

		});
	}
}
