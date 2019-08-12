<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $guarded = ['id'];

	protected $dates = ['created_at'];
    protected $fillable = ['title', 'description'];
}
