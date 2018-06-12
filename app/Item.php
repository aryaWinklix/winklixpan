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
    	return $this->belongsToMany('App\Order','item_order','order_id','item_id')->withPivot(['quantity','status','buying_price'])->withTimestamps();
    }

    public function getNameAttribute($value)
    {
        return strtolower($value);
    }

    // public function getIdAttribute($value)
    // {
    // 	return (string)$value;
    // }

    public function vendors()
    {
        return $this->belongsToMany('App\User','item_order','item_id','vendor_id')->withPivot(['price','stock','minimal_stock'])->withTimestamps();
    }
}
