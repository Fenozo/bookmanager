<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('infoConfig', function() {
    dd(config('database.connections.mysql'));
});
/**
 * Commande pour créer une base de données
 * 
 */
Artisan::command('createDatabase', function() {
    
    $username = config('database.connections.mysql.username');
    $password = config('database.connections.mysql.password');
    $host     = config('database.connections.mysql.host');
    $database = config('database.connections.mysql.database');

    \App\Helpers\Database::init($host, $username, $password);
    
    if (\App\Helpers\Database::create($database)) 
    {
        $this->comment( 'created database : '.$database );
    } else 
        {
            $this->comment( 'Nothing Database created' );
        }
});