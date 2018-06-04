<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class WelcomeController extends Controller
{
    public function welcome()
    {
    	return view('front.item.index')->with('items',Item::all());
    }
}
