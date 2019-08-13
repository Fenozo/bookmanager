<?php
namespace App\Helpers;

class Route {

    public static function set_active_route ($route) {
        return Route::is($route) ?? 'active';
    }

}