<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Item;
use App\User;
use App\Http\Resources\Item\AllItemResource as AllItemResource;
use App\Http\Resources\Item\ItemResource as ItemResource;

class ItemController extends Controller
{
    public function index($floor_no)
    {
    	// return AllItemResource::collection(Item::all());
        $vendor = User::where('type','vendor')->where('floor_no',$floor_no)->first();
        // return $vendor->items;
        $res = [
            'status' => 'success',
            'message' => 'Items Returns Successfully',
            'itemsList' => $vendor->items,
        ];
        return $res;
        // return (new AllItemResource(Item::all()))
        //         ->additional(['message' => "success",
        //                         'response' => [
        //                             'key' => 'value',
        //                         ]]);
    }

    public function show($slug)
    {
        $res = [
            'status' => 'success',
            'message' => 'Item Info Returns Successfully',
            'itemDetails' => Item::where('slug',str_slug($slug))->get(),
        ];
        return $res;
    	// return ItemResource::collection(Item::where('slug',str_slug($slug))->get());
    }

    public function getItemsByCategory($cat,$floor_no)
    {
        $vendor = User::where('type','vendor')->where('floor_no',$floor_no)->first();
        // return $vendor->items()->where('category',$cat)->get();
        $res = [
            'status' => 'success',
            'message' => 'Category wise Items Returns Successfully',
            'itemsList' => $vendor->items()->where('category',$cat)->get(),
        ];
        return $res;
    	// return Item::where('category',$cat)->get();
    }
}
