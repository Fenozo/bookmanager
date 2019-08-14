<?php
namespace App\Models\Traits;


trait Sluggable
{
    
	protected static function bootSluggable() 
	{
		static::creating(function ($event) {
			$event->slug = \App\Helpers\Slug::create($event->title, self::class);
		});
	}
}


?>