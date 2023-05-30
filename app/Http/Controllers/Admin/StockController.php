<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;


class StockController extends Controller
{
    //

    protected $stock;

    public function __construct(Stock $stock)
    {
        $this->stock     = $stock;
    }

    public function index()
    {
        $stock = Stock::latest()->get();

        return view('admin.stock.index', compact('stock'));
    }

    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view('admin.stock.staock_add', compact('products'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'type' => 'required',
            'qty' => 'required',
        ]);

        $stockStore = $this->stock->putStore($request);

        if($stockStore['status'] == 0) {
            Toastr::info($stockStore['msg'], 'Info');
            return redirect()->back();
        }
            
        Toastr::success($stockStore['msg'], 'Success');
        return redirect()->route('admin.stocks.index');

    }

    public function delete($id)
    {

        $stockDelete = $this->stock->putDelete($id);

        if($stockDelete['status'] == 0) {
            Toastr::info($stockDelete['msg'], 'Info');
            return redirect()->back();
        }
            
        Toastr::success($stockDelete['msg'], 'Success');
        return redirect()->back();
        
    }

}
