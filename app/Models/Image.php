<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
    protected $guarded = ['created_at'];
    protected $fillable = ['size','name','type','cripted_name'];

    
}
