<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Item;
use App\User;
use App\Order;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Http\Middleware\CheckAdmin;

use Illuminate\Http\UploadedFile;

use Auth;

class ItemController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(CheckAdmin::class)->except(['index', 'show','itemsAttrUpdate','uploadCsv','addItemToMenu','storeItemToMenu','itemStatusUpdate','removeItemFromMenu','downloadCurrentInventry']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type === "admin") {
            $items = Item::all();
        }else{
            $vendor = Auth::user();
            $items = $vendor->items;
        }
        return view('admin.item.index')->with('items',$items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('cover')->store('products', ['disk' => 'public']);
        $item = new Item;
        $item->name = $request->name;
        $item->slug = str_slug($request->name);
        $item->cover = $request->file('cover')->store('products', ['disk' => 'public']);
        $item->description = $request->description;
        $item->calories = $request->calories;
        $item->category = $request->category;

        if ($item->save()) {
            $request->session()->flash('message','Item Uploaded Successfully');
            return redirect()->back();
        }else {
            $request->session()->flash('error','failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('front.item.show')->with('item',Item::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.item.edit')->with('item',Item::where('id',$id)->first());
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
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->slug = str_slug($request->name);
        $item->cover = $request->file('cover');
        $item->description = $request->description;
        $item->calories = $request->calories;
        $item->category = $request->category;


        if ($item->update()) {
            $request->session()->flash('message','Item Updated Successfully');
            return redirect()->back();
        }else {
            $request->session()->flash('error','failed');
            return redirect()->back();
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
        // return "HJ";
        $item = Item::findOrFail($id);
        if ($item->delete()) {
            session()->flash('message','Item Deleted Successfully');
            return redirect()->back();
        }else {
            session()->flash('error','failed');
            return redirect()->back();    
        }   
    }

    public function itemsAttrUpdate(Request $request)
    {
        // return $request;
        $vendor = Auth::user();
        $vendor->items()->updateExistingPivot($request->item_id,[
                                                        'price' => $request->price,
                                                        'stock' => $request->stock,
                                                        'minimal_stock' => $request->minimal_stock,
                                                    ]);
        session()->flash('message','Updated Successfully');
        return redirect()->back();
    }

    public function addItemToMenu()
    {
        $vendor = Auth::user();
        $items = Item::all();
        return view('admin.item.addItemsToMenu')->with([
                                                        'items' => Item::all(),
                                                    ]);
    }

    public function storeItemToMenu(Request $request)
    {
        $vendor = Auth::user();
        if ($vendor->items()->where('item_id',$request->item_id)->first()) {
            session()->flash('error','Item already added in menu');
        }else{
            $vendor->items()->attach($request->item_id, [
                                                    'price' => $request->price,
                                                    'stock' => $request->stock,
                                                    'minimal_stock' => $request->minimal_stock,
                                                    ]);
            session()->flash('message','Item added successfully in menu');
        }
        return redirect(route('items.index'));
    }

    public function removeItemFromMenu(Request $request)
    {
        $vendor = Auth::user();
        // $vendor->items()->detach($request->item_id);
        if ($vendor->items()->detach($request->item_id)) {
            session()->flash('message','Item removed from menu Successfully');
        }else{
            session()->flash('error','Error Occured');
        }
        return redirect()->back();
    }


    public function itemStatusUpdate(Request $request)
    {
        // $order = Order::findOrFail($request->order_id);
        $order = Order::withCount('items')->where('id',$request->order_id)->first();
        $order->items()->updateExistingPivot($request->item_id,[
                                                                'quantity' => $request->quantity,
                                                                'status' => $request->status,
                                                            ]);
        if ($request->status === 'delivered' && ($order->items()->where('item_id',$request->item_id)->first()->pivot->status) != 'delivered') {
            $this->addInPurchaseReport($request->order_id,$request->item_id);
        }
        // $item_count = $order->items_count;
        $i = 0;
        // $order = Order::withCount('items')->where('id',3)->first();
        // return $order->items_count;
        foreach ($order->items as $item) {
            $status = $order->items()->where('item_id',$item->id)->first()->pivot->status;
            if ($status === 'delivered' || $status === 'rejected' || $status === 'cancelled') {
                $i++;
            }
        }
        // return $order->items_count;
        if ($i === $order->items_count) {
            $order->status = 'completed';
        }else{
            $order->status = 'processed';
        }
        if ($order->update()) {
            session()->flash('message','Item Status in Order updated successfully');
        }else{
            session()->flash('error','Item Status in Order updated successfully but Order Status not updated successfully');
        }
        return redirect(route('orders.edit',$order->id));
    }

    public function addInPurchaseReport($order_id,$item_id)
    {
        $order = Order::findOrFail($order_id);
        $user = User::findOrFail($order->user_id);
        if ($user->type == 'admin' || $user->type == 'vendor') {
            $user_category = 'internal_staff';
        }else{
            $user_category = $user->type;
        }
        $vendor = User::where('type','vendor')->where('floor_no',$user->floor_no)->first();
        $item = Item::findOrFail($item_id);
        $item_name = $item->name;
        //get item desc
        $item_desc = $item->description;
        $price = $order->items()->where('item_id',$item_id)->first()->pivot->buying_price;
        $qty = $order->items()->where('item_id',$item->id)->first()->pivot->quantity;
        $total_sales = $price*$qty;
        //get item_order updated at
        $timestamp = $order->items()->where('item_id',$item_id)->first()->pivot->updated_at;
        try {
            DB::table('purchase_report')->insert([
                'vendor_id' => $vendor->id,
                'item_id' => $item->id,
                'user_id' => $user->id,
                'customer_category' => $user_category,
                'item_name' => $item_name,
                'description' => $item_desc,
                'quantity' => $qty,
                'price' => $price,
                'total_sales' => $total_sales,
                'delivered_at' => $timestamp,
            ]);
            return "true";  
        } catch (Exception $e) {
            return $e->message();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function uploadCsv(Request $request)
    {
        $vendor = Auth::user();
        $file = fopen($request->file('csv'),"r");
        while($data = fgetcsv($file))
        {
            if ($data[0] != "ID") {
                $item_id = $data[0];
                $name = $data[1];
                $price = $data[2];
                $stock = $data[3];
                $minimal_stock = $data[4];
                $vendor->items()->updateExistingPivot($item_id,[
                                                            'price' => $price,
                                                            'stock' => $stock,
                                                            'minimal_stock' => $minimal_stock,
                                                        ]);
                // echo $data[0]." ".$data[1]." ".$data[2]." ".$data[3]." ".$data[4];
                // echo "<br/>";
            }
        }
        fclose($file);
        session()->flash('message','Inventry Updated Successfully');
        return redirect()->back();
    }

    public function downloadCurrentInventry()
    {
        //get data
        $vendor = Auth::user();
        $vendor->items();
        $data = "ID,Name,Price,Stock,Minimal_stock\n";
        foreach($vendor->items as $item){
            $name = Item::findOrFail($item->id)->name;
            $price = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
            $stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->stock;
            $minimal_stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->minimal_stock;
            $data .= $item->id.",".$name.",".$price.",".$stock.",".$minimal_stock."\n";
        }
        Storage::disk('local')->put($vendor->name.'.csv', $data);
        return Storage::download($vendor->name.'.csv');
    }

    public function downloadItemsCSV()
    {
        $admin = Auth::user();
        $data = "ID,Name,Description,Cover,Calories,Category\n";
        $items = Item::all();
        foreach($items as $item){
            $id = $item->id;
            $name = $item->name;
            $description = '"'.$item->description.'"';
            $cover = $item->cover;
            $calories = $item->calories;
            $category = $item->category;
            // $description = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
            // $stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->stock;
            // $minimal_stock = $vendor->items()->where('item_id',$item->id)->first()->pivot->minimal_stock;
            $data .= $item->id.",".$name.",".$description.",".$cover.",".$calories.",".$category."\n";
        }
        Storage::disk('local')->put('all_items.csv', $data);
        return Storage::download('all_items.csv');
    }

    public function uploadItemsCSV(Request $request)
    {
        $vendor = Auth::user();
        $file = fopen($request->file('csv'),"r");
        $i = 0;
        while($data = fgetcsv($file))
        {
            if ($i != 0) {
                if ($data[1] != "") {
                    $item = new Item;
                    $item->name = $data[1];
                    $item->slug = str_slug($data[1]);
                    $item->description = $data[2];
                    $item->cover = $data[3];
                    $item->calories = (int)$data[4];
                    $item->category = $data[5];
                    $item->save();
                }
                // $name = $data[1];
                // $desc = $data[2];
                // $cover = $data[3];
                // $calories = (int)$data[4];
                // $category = $data[5];

                // $item = Item::updateOrCreate([
                //     'name' => $name,
                //     'slug' => str_slug($name),
                //     'description' => $desc,
                //     'cover' => $cover,
                //     'calories' => $calories,
                // ]);
                // $item = new Item;
                // $item->name = $data[1];
                // $item->slug = str_slug($data[1]);
                // $item->description = $data[2];
                // $item->cover = $data[3];
                // $item->calories = (int)$data[4];
                // $item->category = $data[5];
                // $item->save();
                // $item = Item::create([
                //     'name' => $name,
                //     'slug' => str_slug($name),
                //     'description' => $desc,
                //     'cover' => $cover,
                //     'calories' => $calories,
                //     'category' => $category,
                // ]);
                // echo $data[0]." ".$data[1]." ".$data[2]." ".$data[3]." ".$data[4];
                // echo "<br/>";
            }
            $i++;
        }
        fclose($file);
        session()->flash('message','Items List Updated Successfully');
        return redirect()->back();
    }
}
