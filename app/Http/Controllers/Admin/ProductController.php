<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    //

    protected $product;

    public function __construct(Product $product)
    {
        $this->product     = $product;
    }

    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);

        $productStore = $this->product->putStore($request);

        if($productStore['status'] == 0) {
            Toastr::info($productStore['msg'], 'Info');
            return redirect()->back();
        }
            
        Toastr::success($productStore['msg'], 'Success');
        return redirect()->route('admin.products.index');

    }

    public function edit($id)
    {
        $products = Product::findOrfail($id);
        return view('admin.products.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);

        $productUpdate = $this->product->putUpdate($request, $id);

        if($productUpdate['status'] == 0) {
            Toastr::info($productUpdate['msg'], 'Info');
            return redirect()->back();
        }
            
        Toastr::success($productUpdate['msg'], 'Success');
        return redirect()->route('admin.products.index');

    }

    public function delete($id)
    {

        $productDelete = $this->product->putDelete($id);

        if($productDelete['status'] == 0) {
            Toastr::info($productDelete['msg'], 'Info');
            return redirect()->back();
        }
            
        Toastr::success($productDelete['msg'], 'Success');
        return redirect()->back();
    }

}
