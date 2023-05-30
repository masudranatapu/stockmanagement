<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
        'price',
        'created_at',
        'updated_at',
    ];


    public function putStore($request)
    {
        DB::beginTransaction();
            try {
                
                $existsProudct = Product::where('slug', strtolower(str_replace(' ', '-', $request->name)))->first();

                if($existsProudct) {
                    $slug = strtolower(str_replace(' ', '-', $request->name)).'-'.uniqid();
                }else {
                    $slug = strtolower(str_replace(' ', '-', $request->name));
                }

                $product = new Product();
                $product->name = $request->name;
                $product->slug = $slug;
                $product->status = $request->status;
                $product->price = $request->price;
                
                $product_image = $request->file('image');

                if($product_image) {
                    $slug = 'product';
                    $product_image_name = $slug.'-'.uniqid().'.'.$product_image->getClientOriginalExtension();
                    $upload_path = 'media/product/';
                    $product_image->move($upload_path, $product_image_name);
                    $image_url = $upload_path.$product_image_name;
                }else {
                    $image_url = null;
                }
                
                $product->image = $image_url;

                $product->created_at = Carbon::now();
                $product->save();

            } catch (\Throwable $th) {

                DB::rollback();
                dd($th);
                $data['status'] = 0;
                $data['msg'] = "Unable to create product";
                return $data;
            }

        DB::commit();

        $data['status'] = 1;
        $data['msg'] = "Product successfully created";
        return $data;  
    }

    public function putUpdate($request, $id)
    {
        DB::beginTransaction();
            try {
                
                $existsProudct = Product::where('slug', strtolower(str_replace(' ', '-', $request->name)))->first();

                if($existsProudct) {
                    $slug = strtolower(str_replace(' ', '-', $request->name)).'-'.uniqid();
                }else {
                    $slug = strtolower(str_replace(' ', '-', $request->name));
                }

                $product = Product::findOrfail($id);

                $product->name = $request->name;
                $product->slug = $slug;
                $product->status = $request->status;
                $product->price = $request->price;
                
                $product_image = $request->file('image');

                if($product_image) {
                    $slug = 'product';
                    $product_image_name = $slug.'-'.uniqid().'.'.$product_image->getClientOriginalExtension();
                    $upload_path = 'media/product/';
                    $product_image->move($upload_path, $product_image_name);

                    if(file_exists($product->image)) {
                        unlink($product->image);
                    }

                    $image_url = $upload_path.$product_image_name;

                }else {

                    $image_url = $product->image;
                }
                
                $product->image = $image_url;

                $product->created_at = Carbon::now();

                $product->save();

            } catch (\Throwable $th) {
                
                DB::rollback();
                dd($th);

                $data['status'] = 0;
                $data['msg'] = "Unable to update product";
                return $data;
            }

        DB::commit();

        $data['status'] = 1;
        $data['msg'] = "Product successfully update";
        return $data;
    }

    public function putDelete($id)
    {
        DB::beginTransaction();
            try {

                $product = Product::findOrfail($id);

                if(file_exists($product->image)) {
                    unlink($product->image);
                }

                $product->delete();

            } catch (\Throwable $th) {
                
                DB::rollback();
                dd($th);

                $data['status'] = 0;
                $data['msg'] = "Unable to delete product";
                return $data;
            }

        DB::commit();

        $data['status'] = 1;
        $data['msg'] = "Product successfully delete";
        return $data;
    }


}
