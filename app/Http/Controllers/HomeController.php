<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Item;
use App\User;
use App\Order;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function getClosingStock()
    {
        $vendor = Auth::user();
        $data = "ID,Name,Specification,Opening Qty,Purchase Qty,Closing Qty,MRP\n";
        foreach($vendor->items as $itm){
            $item = Item::findOrFail($itm->id);
            $id = $item->id;
            $name = $item->name;
            $specs = str_limit($item->description,20);
            $opening_qty = 50;
            $perchase_qty = 40;
            $closing_qty = 10;
            $mrp = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
            $data .= $id.",".$name.",".$specs.",".$opening_qty.",".$perchase_qty.",".$closing_qty.",".$mrp."\n";
        }
        // Storage::disk('local')->put($vendor->name.'_closing_stock.csv', $data);
        // return Storage::download($vendor->name.'_closing_stock.csv');
        return view('admin.report.closing_stock')->with('items',$vendor->items);
    }

    public function exportClosingStockCSV()
    {
        $vendor = Auth::user();
        $data = "ID,Name,Specification,Opening Qty,Purchase Qty,Closing Qty,MRP\n";
        foreach($vendor->items as $itm){
            $item = Item::findOrFail($itm->id);
            $id = $item->id;
            $name = $item->name;
            $specs = str_limit($item->description,20);
            $opening_qty = 50;
            $perchase_qty = 40;
            $closing_qty = 10;
            $mrp = $vendor->items()->where('item_id',$item->id)->first()->pivot->price;
            $data .= $id.",".$name.",".$specs.",".$opening_qty.",".$perchase_qty.",".$closing_qty.",".$mrp."\n";
        }
        Storage::disk('local')->put($vendor->name.'_closing_stock.csv', $data);
        return Storage::download($vendor->name.'_closing_stock.csv');
        // return "exportClosingStockCSV";
    }

    public function getPurchaseReport($subMonths = 0)
    {
        $now = Carbon::now();

        if ($subMonths == 0) {
            $reports = DB::table('purchase_report')->where('vendor_id',Auth::user()->id)->get();
        }else{
            $reports = DB::table('purchase_report')->where('vendor_id',Auth::user()->id)->where('delivered_at','>',$now->subMonths($subMonths))->get();
        }
        return view('admin.report.purchase_report')->with('reports',$reports);
    }

    public function exportPurchaseReportCSV()
    {
        $vendor = Auth::user();
        $data = "ID,Name,Specification,Quantity,Buying Price,Total Sales,Date of Purchase\n";
        $reports = DB::table('purchase_report')->where('vendor_id',Auth::user()->id)->get();
        foreach($reports as $report){
            $id = $report->item_id;
            $name = $report->item_name;
            $specs = str_limit($report->description,20);
            $quantity = $report->quantity;
            $buying_price = $report->price;
            $total_sales = $report->total_sales;
            $delivered_at = '"'.$report->delivered_at.'"';
            $data .= $id.",".$name.",".$specs.",".$quantity.",".$buying_price.",".$total_sales.",".$delivered_at."\n";
        }
        Storage::disk('local')->put($vendor->name.'_purchase_report.csv', $data);
        return Storage::download($vendor->name.'_purchase_report.csv');
        // return "exportPurchaseReportCSV";
    }

    public function getConsumptionReport($subMonths = 0)
    {
        $now = Carbon::now();

        if ($subMonths == 0) {
            $reports = DB::table('purchase_report')->get();
        }else{
            $reports = DB::table('purchase_report')->where('delivered_at','>',$now->subMonths($subMonths))->get();
        }
        // $reports = DB::table('purchase_report')->where('delivered_at','<',$now->subMonths(1))->get();
        // $reports = DB::table('purchase_report')->where('delivered_at','<',$now->subMonths(3))->get();
        // $reports = DB::table('purchase_report')->where('delivered_at','<',$now->subMonths(6))->get();
        // $reports = DB::table('purchase_report')->where('delivered_at','<',$now->subMonths(12))->get();
        return view('admin.report.consumption_report')->with('reports',$reports);
    }

    public function exportConsumptionReportCSV()
    {
        // $vendor = Auth::user();
        $data = "ID,Name,Specification,Customer Category,Quantity,MRP,Total Sales,Date Time\n";
        $reports = DB::table('purchase_report')->get();
        foreach($reports as $report){
            $id = $report->item_id;
            $name = $report->item_name;
            $specs = str_limit($report->description,20);
            $customer_category = $report->customer_category;
            $quantity = $report->quantity;
            $buying_price = $report->price;
            $total_sales = $report->total_sales;
            $delivered_at = '"'.(string)$report->delivered_at.'"';
            $data .= $id.",".$name.",".$specs.",".$customer_category.",".$quantity.",".$buying_price.",".$total_sales.",".$delivered_at."\n";
        }
        Storage::disk('local')->put('consumption_report.csv', $data);
        return Storage::download('consumption_report.csv');
        // return "exportConsumptionReportCSV";
    }
}
