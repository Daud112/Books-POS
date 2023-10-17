<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products',
            'isbn' => 'required|unique:products|min:13|max:13',
            'buy_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->all();

        if($data['buy_price'] == $data['sale_price'] || $data['buy_price'] > $data['sale_price']){
            return back()->with('error', 'Sale price should be greater than Buy price!');
        }

        $product_data = [
            'title'  => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'],
            'genre' => $data['genre'],
            'buy_price' => $data['buy_price'],
            'sale_price' => $data['sale_price'],
            'disc' => $data['disc'],
            'quantity' => $data['quantity'],
            'published_date' => $data['published_date'],
            'publisher' => $data['publisher'],
        ];

        if ($request->hasFile('cover_image')) {
            $path = public_path('cover_images/');
            !is_dir($path) && mkdir($path, 0777, true);
           
            $imageName = $data['isbn'] . '.' . $request->file('cover_image')->getClientOriginalExtension();
            
            if (file_exists($path . $imageName)) {
                // If it exists, delete the old image
                unlink($path . $imageName);
            }
            $request->file('cover_image')->move($path, $imageName);

            $product_data['cover_image_path'] = $imageName;
        }else{
            $product_data['cover_image_path'] = "default_cover.png";
        }
        
        Product::create($product_data);

        $products = Product::all();
        return view('admin.product.index', compact('products'))->withSuccess('Product is created successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'isbn' => 'required|min:13|max:13',
            'buy_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();
        $product = Product::find($id);
        $product_validate = DB::table('products')
                                ->where([
                                    ['title', '=', $data['title']],
                                    ['id', '!=', $id],
                                ])
                                ->orWhere([
                                    ['isbn', '=', $data['isbn']],
                                    ['id', '!=', $id],
                                ])
                                ->first();
        if ($product_validate !== null) {
            return back()->with('error', 'Product Title & ISBN has already been taken.');
        }
        
        if (!$product) {
            return back()->with('error', 'Product not found!');
        }
        
        if($product->buy_price == $product->sale_price || $product->buy_price > $product->sale_price){
            return back()->with('error', 'Sale price should be greater than Buy price!');
        }

        $product->title = $data['title'];
        $product->author = $data['author'];
        $product->isbn = $data['isbn'];
        $product->genre = $data['genre'];
        $product->buy_price = $data['buy_price'];
        $product->sale_price = $data['sale_price'];
        $product->disc = $data['disc'];
        $product->quantity = $data['quantity'];
        $product->published_date = $data['published_date'];
        $product->publisher = $data['publisher'];

        if ($request->hasFile('cover_image')) {
            if($product->isbn !== $data['isbn']){
                $path = public_path('cover_images/');
                !is_dir($path) && mkdir($path, 0777, true);
               
                $imageName = $product->isbn . '.' . $request->file('cover_image')->getClientOriginalExtension();
                
                if (file_exists($path . $imageName)) {
                    // If it exists, delete the old image
                    unlink($path . $imageName);
                }
                $request->file('cover_image')->move($path, $imageName);
                $product->cover_image_path = $imageName;
            }
        }else{
            // $product->cover_image_path = "default_cover.png";
        }

        if($product->save()){
            return redirect("products")->withSuccess('Successfully update the product');
        }else{
            return back()->with('error', 'Product is not updated!');
        }
    }

    public function createCustomProduct(Request $request)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        
        return view('admin.product.create_custom');
    }
    
    public function storeCustomProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products',
            'isbn' => 'required|unique:products|min:12|max:12', //ISBN is barcode for custom products
            'cost_price' => 'required',
            'sale_price' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->all();

        if($data['cost_price'] == $data['sale_price'] || $data['cost_price'] > $data['sale_price']){
            return back()->with('error', 'Sale price should be greater than Cost price!');
        }

        $product_data = [
            'title'  => $data['title'],
            'isbn' => $data['isbn'], //ISBN is barcode for custom products
            'buy_price' => $data['cost_price'],
            'sale_price' => $data['sale_price'],
            'quantity' => -1,
            'disc' => $data['disc'],
        ];

        if ($request->hasFile('cover_image')) {
            $path = public_path('cover_images/');
            !is_dir($path) && mkdir($path, 0777, true);
           
            $imageName = $data['barcode'] . '.' . $request->file('cover_image')->getClientOriginalExtension();
            
            if (file_exists($path . $imageName)) {
                // If it exists, delete the old image
                unlink($path . $imageName);
            }
            $request->file('cover_image')->move($path, $imageName);

            $product_data['cover_image_path'] = $imageName;
        }else{
            $product_data['cover_image_path'] = "default_cover.png";
        }
        
        Product::create($product_data);

        $products = Product::all();
        return view('admin.product.index', compact('products'))->withSuccess('Product is created successfully');
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('term');
        // Query the database to find matching products
        $products = Product::where('title', 'like', "%$searchTerm%")
                        ->orWhere('isbn', 'like', "%$searchTerm%")
                        ->get();
        
        return response()->json($products);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
