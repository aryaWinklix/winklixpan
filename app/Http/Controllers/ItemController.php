<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\User;
use App\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Http\Middleware\CheckAdmin;

use Maatwebsite\Excel\Facades\Excel;

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
        $this->middleware(CheckAdmin::class)->except(['index', 'show','itemsAttrUpdate','uploadCsv','addItemToMenu','storeItemToMenu','itemStatusUpdate']);
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
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->calories = $request->calories;
        $item->rating = $request->rating;

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
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->calories = $request->calories;
        $item->rating = $request->rating;

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
        $vendor->items()->attach($request->item_id, [
                                                'price' => $request->price,
                                                'stock' => $request->stock,
                                                'minimal_stock' => $request->minimal_stock,
                                                ]);
        session()->flash('message','Item added successfully in menu');
        return redirect(route('items.index'));
    }


    public function itemStatusUpdate(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->items()->updateExistingPivot($request->item_id,[
                                                                'quantity' => $request->quantity,
                                                                'status' => $request->status,
                                                            ]);
        session()->flash('message','Item Status in Order updated successfully');
        return redirect(route('orders.edit',$order->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function uploadCsv(Request $request)
    {
        return "upload csv";
        // return array_map('str_getcsv', $request->file('import_file'));
        // return Excel::export();

        // if($request->hasFile('import_file')){
        //     $path = $request->file('import_file')->getRealPath();
        //     $data = Excel::load($path, function($reader) {})->get();
        //     if(!empty($data) && $data->count()){
        //         foreach ($data as $key => $value) {
        //             $insert[] = ['title' => $value->title, 'description' => $value->description];
        //         }
        //         if(!empty($insert)){
        //             DB::table('items')->insert($insert);
        //             dd('Insert Record successfully.');
        //         }
        //     }
        // }
        // return back();

        //  try {
        //     Excel::load($request->file('file'), function ($reader) {

        //         foreach ($reader->toArray() as $row) {
        //             Item::firstOrCreate($row);
        //         }
        //     });
        //     session()->flash('success', 'Items uploaded successfully.');
        //     return redirect()->back();
        // } catch (\Exception $e) {
        //     session()->flash('error', $e->getMessage());
        //     return redirect()->back();
        // }
    }
}
