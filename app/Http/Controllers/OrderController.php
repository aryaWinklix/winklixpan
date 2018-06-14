<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

use App\User;
use App\Role;
use App\Permission;
use App\Authorizable;

use App\Order;
use App\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type === 'admin') {
            $orders = Order::all();
        }else{
            $users_ids = User::where('floor_no',Auth::user()->floor_no)->get(['id']);
            // $orders = Order::where('user_id',Auth::user()->id)->get();
            // $orders = Order::find($users_ids->toArray());
            $orders = Order::whereIn('user_id',$users_ids)->get();
        }
        // return $orders;
        // $user = User::findOrFail(Auth::user()->id);
        // return $user->getRoleNames();
        // if ($user->getRoleNames()[] === "Vendor") {
        //     return view('admin.orders.index');
        // }else {
        //     return "Not Permission";
        // }
        return view('admin.orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floor_no = Auth::user()->floor_no;
        $vendor = User::where('type','vendor')->where('floor_no',$floor_no)->first();
        // return $vendor->items;
        // return $vendor;
        // $users = User::all();
        return view('admin.orders.create')->with([
            'items' => $vendor->items,
            'users' => User::where('floor_no',$floor_no)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $order = new Order;
        // $order->user_id = $request->user_id;
        // $order->amount = $request->amount;
        // $order->payment_id = $request->payment_id;

        // if ($order->save()) {
        //     session()->flash('message','Order Created Successfully');
        //     return redirect()->back();
        // }else {
        //     session()->flash('error','failed');
        //     return redirect()->back();
        // }

        $user = User::findOrFail($request->user_id);
        $total =0;
        $itemIdWithQuantity= array();
        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
        $itemIdWithQuantity = array_combine($request->item_id,$request->quantity);
         foreach ($itemIdWithQuantity as $key => $value) {
            $price = $vendor->items()->where('item_id',$key)->first()->pivot->price;
            $total+=$price*($value);
         }
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->amount = $total;
        $order->payment_id = "";
        $order->status = "processed";
        // $order = new Order;
        // $order->user_id = $request->user_id;
        // $order->amount = $request->amount;
        // $order->payment_id = $request->payment_id;

        if ($order->save()) {
            foreach ($itemIdWithQuantity as $key => $value) {
                $order->items()->attach($key, ['quantity' => $value,
                                                'status' => 'inprocess',
                                                'buying_price' => $vendor->items()->where('item_id',$key)->first()->pivot->price
                                            ]);
            }
            session()->flash('message','Order Created Successfully');
            return redirect()->back();
        }else {
            session()->flash('error','failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.orders.show')->with('order',Order::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->payment_id;
        $order = Order::findOrFail($id);
        $order->user_id = $request->user_id;
        $order->amount = $request->amount;
        $order->payment_id = $request->payment_id;
        $order->status = $request->status;

        if ($order->update()) {
            session()->flash('message','Order Updated Successfully');
            return redirect(route('orders.index'));
        }else {
            session()->flash('error','failed');
            return redirect(route('orders.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->detach();

        if ($order->delete()) {
            session()->flash('message','Order Deleted Successfully');
            return redirect(route('orders.index'));
        }else {
            session()->flash('error','failed');
            return redirect(route('orders.index'));
        }
    }

    public function searchOrders($status)
    {
        if (Auth::user()->type === 'admin') {
            $orders = Order::where('status',$status)->get();
        }else{
            $users_ids = User::where('floor_no',Auth::user()->floor_no)->get(['id']);
            // $orders = Order::where('user_id',Auth::user()->id)->get();
            // $orders = Order::find($users_ids)->where('status',$status);
            $orders = Order::whereIn('user_id',$users_ids)->where('status',$status)->get();
        }
        return view('admin.orders.index')->with('orders',$orders);
    }

    public function updateOrderStatus($order_id,$item_id,$status_id)
    {
        $order = Order::findOrFail($order_id);
        try{
            $order->items()->updateExistingPivot($item_id,['status'=> $status_id]);
            return "true";
        }catch(Exception $e) {
            return 'Message: ' .$e->getMessage();
        }
        // DB::table('item_order')->where('order_id',$order_id)->where('item_id',$item_id)->update(['options->status',$status_id]);
        // return 'true';
    }

    public function updateQuantity($order_id,$item_id,$quantity)
    {
        $order = Order::findOrFail($order_id);
        try{
            $order->items()->updateExistingPivot($item_id,['quantity'=> $quantity]);
            return "true";
        }catch(Exception $e) {
            return 'Message: ' .$e->getMessage();
        }   
    }

    public function getCart($user_id)
    {
        $order = Order::where('user_id',$user_id)->where('status','cart')->first();
        if ($order) {
            $res = [
                'status' => 'success',
                'itemsInOrder' => $order->items()->get(),
            ];
            return $res;
        }else {
            return "false";
        }
        // $order = Order::where('user_id',$user_id)->where('status','cart')->first();
        // // return $order->items()->get();
        // // return DB::table('item_order')->where('order_id',1)->get();
        // $res = [
        //     'status' => 'Success',
        //     'message' => 'Cart Successfully Returned',
        //     'itemList' => $order->items()->get(),
        // ];
        // return $res;
        // return DB::table('item_order')->where('user_id',$user_id)->where('status','temp')->get();
    }

    public function getAddToCart()
    {
        return view('admin.item.addToCart');
    }

    public function addToCart(Request $request)
    {
        // return $request;
        $order = Order::where('user_id',$request->user_id)->where('status','cart')->first();
        if ($order) {
            $order->items()->attach($request->item_id, ['quantity' => 1,
                                                'status' => 'temp']);
            $res = [
                'status' => 'success',
                'message' => 'Item added Successfully',
            ];
            return $res;
        }else {
            // return "false";
            $order = new Order;
            $order->user_id = $request->user_id;
            $order->amount = Item::where('id',$request->item_id)->get('price');
            $order->payment_id = "";
            $order->status = "cart";
            if ($order->save()) {
                // return "true";
                $res = [
                    'status' => 'success',
                    'message' => 'Cart created Successfully',
                    'cartDetails' => $order,
                ];
                return $res;
            }else{
                // return "false";
                $res = [
                    'status' => 'success',
                    'message' => 'Cart Not Created'
                ];
                return $res;
            }
        }
    }
}
