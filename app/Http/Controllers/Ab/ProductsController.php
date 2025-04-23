<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\StockProducts;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public $perPage;

    public function __construct() {
        $this->perPage = config('app.perPage');
    }

    //index
    public function index(Request $request)
    {
        $search = $request->search;
        $user = auth()->user();

        $products = Products::where('store_id', $user->store_id)
        ->with('productCurrentStock')
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate($this->perPage);

        return view('ab.products.index', compact('products'));
    }

    //create
    public function create()
    {
        return view('ab.products.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required',
            'name' => 'required|string|max:255',
            // 'unit' => 'required',
            // 'kg' => 'required',
            // 'price' => 'required',
            'status' => 'required',
		]);

        $user = auth()->user();
        //...
        $store = new Products();
        $store->user_id = $user->id;
        $store->store_id = $user->store_id;
        $store->sku = $request->sku;
        $store->name = $request->name;
        $store->slug = Str::of($request->name)->slug('-');
        // $store->unit = $request->unit;
        // $store->kg = $request->kg;
        // $store->price = $request->price;
        $store->status = $request->status;

        //...files
        if($request->hasFile('files'))
        {
            $filesArray = [];

            $files = $request->file('files');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension, imagesMime());

                if($check){
                    //$file->store('files');
                    $path = $file->storeAs('files', $filename, 'public');
                   
                    array_push($filesArray, $filename);
                }
            }

            //...
            $store->images = json_encode($filesArray);
        }

        $store->save();

        $request->session()->flash('success', "Product added successfully");
        return redirect()->route('ab.products');
    }

    //edit
    public function edit(Products $product)
    {
        return view('ab.products.edit', compact('product'));
    }

    //update
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'sku' => 'required',
            'name' => 'required|string|max:255',
            // 'unit' => 'required',
            // 'kg' => 'required',
            // 'price' => 'required',
            'status' => 'required',
		]);


        //...
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        // $product->unit = $request->unit;
        // $product->kg = $request->kg;
        // $product->price = $request->price;
        $product->status = $request->status;

        $filesArray = [];

        if(@$request->attachment){
            $filesArray = $request->attachment;
        }
            
        if($request->hasFile('files'))
        {
            $files = $request->file('files');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension, imagesMime());

                if($check){
                    //$file->store('files');
                    $path = $file->storeAs('files', $filename, 'public');
                   
                    array_push($filesArray, $filename);
                }
            }
        }

        if($filesArray){
            $product->files = json_encode($filesArray);
        }

        $product->save();

        $request->session()->flash('success', "Product updated successfully");

        return redirect()->route('ab.products');
    }

    //show
    public function show(Request $request, Products $product)
    {
        $stockProducts = StockProducts::where('product_id', $product->id)
            ->with('stock')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        $product->load('productCurrentStock');

        return view('ab.products.show', compact('product', 'stockProducts'));
    }

    //Delete
    public function destroy(Request $request, Products $product)
    {
		$product->delete();
		$request->session()->flash('success', 'Product deleted successfully');
		return redirect()->route("ab.products");
    }
}
