<?php
namespace App\Model\Traits;


trait SlugRoutable {

	/**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}


?>