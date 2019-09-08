<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
    					'index_object',
    					'table_name',
    					'action_type'
					];

	
}
