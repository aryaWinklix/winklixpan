<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";

    protected $fillable = [
    	'user_id', 'selected_snacks', 'how_often','comments'
    ];
    protected $casts = [
        'selected_snacks' => 'array'
    ];

}
