<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;


    protected $table = "stocks";

    protected $fillable = [
        'product_id',
        'qty',
        'type',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function putStore($request)
    {
          DB::beginTransaction();
            try {

                $products = $request->product_id;

                foreach($products as $key => $id) {

                    Stock::insert([
                        'product_id' => $id,
                        'qty' => $request->qty[$key],
                        'type' => $request->type[$key],
                        'created_at' => Carbon::now(),
                    ]);

                }

            } catch (\Throwable $th) {

                DB::rollback();
                dd($th);
                $data['status'] = 0;
                $data['msg'] = "Unable to stock data";
                return $data;
            }

        DB::commit();

        $data['status'] = 1;
        $data['msg'] = "Product successfully added on stock";
        return $data;

    }

    public function putDelete($id)
    {
          DB::beginTransaction();
            try {
                
                $stock = Stock::findOrfail($id);

                $stock->delete();

            } catch (\Throwable $th) {

                DB::rollback();
                dd($th);
                $data['status'] = 0;
                $data['msg'] = "Unable to delete stock product";
                return $data;
            }

        DB::commit();

        $data['status'] = 1;
        $data['msg'] = "Product successfully delete form stock";
        return $data;
    }

}
