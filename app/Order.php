<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
    	'user_id', 'amount', 'payment_id'
    ];

    public function items()
    {
    	return $this->belongsToMany('App\Item','item_order','order_id','item_id')->withPivot(['quantity','status','buying_price']);
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
