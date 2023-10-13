<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
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
        if(!Auth::check()){
            return view('auth.login');
        }

        $sales = Sale::where('status', 'completed')
                ->with('productSales', 'customer', 'user')
                ->get();

        return view('pos.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $user_id = Auth::user()->id;
        $currentDateTime = Carbon::now();
        $DateTime = $currentDateTime->toDateTimeString();
        $products = Product::all();

        $draft_sale = DB::table('sales')
                        ->where([
                            ['status', '=', 'draft'],
                            ['user_id', '=', $user_id],
                        ])->first();
        $saletotal = [
            "total_product_price" => 0,
            "total_disc" => 0,
            "total_qty" => 0,
            "total_sale_price" => 0,
        ];
        if($draft_sale){
            $sale_products = DB::table('product_sales')
                                ->where([
                                        ['sale_id', '=', $draft_sale->id],
                                ])->get();         

            foreach($sale_products as $sale){
                $total_sale_price_raw = ($sale->sale_price-$sale->disc)*$sale->quantity;
                $saletotal['total_product_price'] += $sale->sale_price;
                $saletotal['total_disc'] += $sale->disc;
                $saletotal['total_qty'] += $sale->quantity;
                $saletotal['total_sale_price'] += $total_sale_price_raw;
            }
        }else{
            $draft_sale = $this->create_draft_sale($user_id, $DateTime);
            $sale_products = "";
        }

        return view('pos.create', compact('products','sale_products','draft_sale','saletotal'));
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
            $sale = $this->create_draft_sale($user_id, $DateTime);
            
            $is_add_saleProduct = $this->create_sale_product($product, $data['productQty'], $sale->id);
            if($is_add_saleProduct){
                return redirect("sale/create")->withSuccess('Successfully add product in Bill');
            }
        }
    }

    public function create_draft_sale($id, $date){
        $sale_data = [
            'status'  => 'draft',
            'sale_datetime' => $date,
            'user_id' => $id,
        ];

        return Sale::create($sale_data);
    }
    public function create_sale_product($product, $qty, $sale_id)
    {  
        if($product->disc == null){
            $product->disc = 0;
        }
    
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
    public function show(Request $request, string $id)
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $saletotal = [
            "total_buy_price" => 0,
            "total_price" => 0,
            "total_disc" => 0,
            "total_qty" => 0,
            "total_sale_price" => 0,
            "total_profilt" => 0,
        ];
        $sale = Sale::where('id', $id)
                    ->with('productSales', 'customer', 'user')
                    ->get();
        foreach ($sale[0]->productSales as $sale_product) {
            $total_sale_price_raw = ($sale_product->sale_price-$sale_product->disc)*$sale_product->quantity;
            $total_profilt_raw = (($sale_product->sale_price-$sale_product->disc)-$sale_product->buy_price)*$sale_product->quantity;
            $saletotal['total_buy_price'] += $sale_product->buy_price;
            $saletotal['total_price'] += $sale_product->sale_price;
            $saletotal['total_disc'] += $sale_product->disc;
            $saletotal['total_qty'] += $sale_product->quantity;
            $saletotal['total_sale_price'] += $total_sale_price_raw;
            $saletotal['total_profilt'] += $total_profilt_raw;
        }

        return view('pos.view', compact('sale','saletotal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function completeSale(Request $request, string $id)
    {
        $data = $request->all();
        $sale_id = $data['saleId'];
        $currentDateTime = Carbon::now();
        $DateTime = $currentDateTime->toDateTimeString();
        $customer_id = null;

        if($data['selectedCustomerId'] && $data['selectedCustomerId']>0){
            $customer_id = $data['selectedCustomerId'];
        }
        
        if (!$customer_id && (!$data['customer_name'] || !$data['customer_phone'])) {
            // Handle the case where the user with the given ID is not found.
            return back()->with('error', 'Please select a customer or give its info!');
        }
        
        $sale_products = ProductSale::where('sale_id', '=', "$sale_id")->get();
        
        foreach($sale_products as $sale_product){
            $productSale = ProductSale::find($sale_product->id);  
            $productSale->disc = $data['saleproductDisc_' . $sale_product->id];
            $productSale->quantity = $data['saleproductQty_' . $sale_product->id];
            $productSale->save();
        }
        
        if(!$customer_id){
            $customer_data = [
                "name" => $data['customer_name'],
                "phone" => $data['customer_phone'],
            ];
            $customer = $this->createCustomer($customer_data);
            if($this->updateSale($sale_id, $customer->id, $DateTime)){
                return redirect("sale/create")->withSuccess('Successfully sale created');
            }
        }
 
        if($customer_id !== null){
            if($this->updateSale($sale_id, $customer_id, $DateTime)){
                
                return redirect("sale/create")->withSuccess('Successfully sale created');
            }
        }
    }

    public function createCustomer($data)
    {   
        $customer_data = [
            'name'  => $data['name'],
            'phone' => $data['phone'],
        ];

        return Customer::create($customer_data);
    }

    public function updateSale($id, $customer_id, $date)
    {   
        $sale = Sale::find($id);  
        $sale->status  = "completed";
        $sale->sale_datetime = $date;
        $sale->customer_id = $customer_id;
        return $sale->save();
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
