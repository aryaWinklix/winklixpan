<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = [
    	'name', 'slug', 'description', 'cover', 'price', 'quantity', 'rating', 'calories'
    ];


    public function orders()
    {
    	return $this->belongsToMany('App\Order','item_order','order_id','item_id')->withPivot(['quantity','status']);
    }
}
