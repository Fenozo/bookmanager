<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['id','title','content','chapiter_id','book_id'];


    /**
    *
    * Recevoir la livre
    * A l'aide de la file on liste les différents chapitre
    *
    */
    public function livre ()
    {
    	$this->belongsTo("App\Models\Livre", 'book_id');
    }
}
