<?php

namespace App\Models;

use App\Models\Traits\{Sluggable, SlugRoutable};
use Illuminate\Database\Eloquent\Model;
use App\Models\Livre;
use App\Models\Page;
class Livre extends Model
{
    use SlugRoutable, Sluggable;


	protected $guarded = ['id'];

	protected $dates = ['created_at'];
	protected $fillable = ['name','description', 'author','date_publication',];

	protected static function boot () 
	{
		parent::boot();

		static::deleting(function($event){

		});
	}

	public function chapiters ()
	{
		return $this->hasMany('App\Models\Chapiter', 'book_id', 'id');
	}

	public function pages ()
	{
		return $this->hasMany(Page::class, 'book_id', 'id');
	}
}
