<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Item;
use App\Http\Resources\Item\AllItemResource as AllItemResource;
use App\Http\Resources\Item\ItemResource as ItemResource;

class ItemController extends Controller
{
    public function index()
    {
    	return AllItemResource::collection(Item::all());
    }

    public function show($slug)
    {
    	return ItemResource::collection(Item::where('slug',str_slug($slug))->get());
    }

    public function getItemsByCategory($cat)
    {
    	return Item::where('category',$cat)->get();
    }
}
