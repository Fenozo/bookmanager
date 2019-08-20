<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapiter extends Model
{
    protected $fillable = ['name','book_id'];


    public function livre ()
    {
    	return $this->belongsTo("App\Models\Livre", 'book_id');
    }
}
