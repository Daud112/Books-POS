<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'publisher' => 'required',
            'published_date' => 'required',
            'buy_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust the validation rules as needed
        ]);
        $data = $request->all();
        
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
            
            $request->file('cover_image')->move($path, $imageName);

            $product_data['cover_image_path'] = $imageName;
        }else{
            $product_data['cover_image_path'] = "default_cover.png";
        }
        
        Product::create($product_data);
        return view('admin.product.create')->withSuccess('Product is created successfully');;
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
