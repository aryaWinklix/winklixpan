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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::findOrFail(Auth::user()->id);
        // return $user->getRoleNames();
        // if ($user->getRoleNames()[] === "Vendor") {
        //     return view('admin.orders.index');
        // }else {
        //     return "Not Permission";
        // }
        return view('admin.orders.index')->with('orders',Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->amount = $request->amount;
        $order->payment_id = $request->payment_id;

        if ($order->save()) {
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
        return view('admin.orders.edit')->with('order',Order::findOrFail($id));
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
        $order = Order::findOrFail($id);
        $order->user_id = $request->user_id;
        $order->amount = $request->amount;
        $order->payment_id = $request->payment_id;

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

        if ($order->delete()) {
            session()->flash('message','Order Deleted Successfully');
            return redirect(route('orders.index'));
        }else {
            session()->flash('error','failed');
            return redirect(route('orders.index'));
        }
    }
}
