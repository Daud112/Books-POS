<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $products = Product::all();

        return view('pos.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        if(!Auth::check()){
            return view('auth.login');
        }

        $request->validate([
            'productId' => 'required',
            'productQty' => 'required',
        ]);
        $data = $request->all();
        $currentDateTime = Carbon::now();
        $DateTime = $currentDateTime->toDateTimeString();
        
        $product = Product::find($data['productId']);
        $user_id = Auth::user()->id;
        
        if (!$product) {
            return back()->with('error', 'Product not found!');
        }

        $draft_sale = DB::table('sales')
                        ->where([
                            ['status', '=', 'draft'],
                            ['user_id', '=', $user_id],
                        ])->first();
        
        if($draft_sale){
            $productSaleRaw = DB::table('product_sales')
                            ->where([
                                ['sale_id', '=', $draft_sale->id],
                                ['product_id', '=', $product->id],
                            ])->first();

            if($productSaleRaw){
                    $productSale = ProductSale::find($productSaleRaw->id);  
                    $productSale->title  = $product->title;
                    $productSale->buy_price = $product->buy_price;
                    $productSale->sale_price = $product->sale_price;
                    $productSale->disc = $product->disc;
                    $productSale->quantity = $data['productQty'];
                    if($productSale->save()){
                        return redirect("sale/create")->withSuccess('Successfully update product in Bill');
                    }
            }else{

                $is_add_saleProduct = $this->create_sale_product($product, $data['productQty'], $draft_sale->id);
                if($is_add_saleProduct){
                    return redirect("sale/create")->withSuccess('Successfully add product in Bill');
                }
            }
        }else{
            $sale_data = [
                'status'  => 'draft',
                'sale_datetime' => $DateTime,
                'user_id' => $user_id,
            ];

            $sale = Sale::create($sale_data);
            
            $is_add_saleProduct = $this->create_sale_product($product, $data['productQty'], $sale->id);
            if($is_add_saleProduct){
                return redirect("sale/create")->withSuccess('Successfully add product in Bill');
            }
        }
    }

    public function create_sale_product($product, $qty, $sale_id)
    {
        $sale_product_data = [
            'title'  => $product->title,
            'buy_price' => $product->buy_price,
            'sale_price' => $product->sale_price,
            'disc' => $product->disc,
            'quantity' => $qty,
            'product_id' => $product->id,
            'sale_id' => $sale_id,
        ];
        return ProductSale::create($sale_product_data);
    }    

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
