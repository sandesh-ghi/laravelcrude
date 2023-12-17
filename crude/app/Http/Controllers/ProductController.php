<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$products = Product::get();
        return view('products.index',['products'=> Products::get() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate data
        $request->validate(['name' => 'required', 'description' => 'required',
            'image'=> 'required|mimes:jpeg,jpg,png,gif|max:1000']);
        //image upload
        //dd($request->all());
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
            $Product = new Products;
            $Product->image = $imageName;
            $Product->name = $request->input('name');
            $Product->description = $request-> input('description');

            $Product->save();
            return back()->withSuccess('Product created !!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = Products::where('id',$id)->first();
        return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       // dd($id);
        $product = Products::where('id',$id)->first();
        return view('products.edit',['product' => $product]);
       // return view('products.edit');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //dd($request->all());
        //validate data
        $request->validate([
            'name' => 'required', 'description' => 'required',
            'image'=> 'nullable|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        $product = Products::where('id',$id)->first();

        if(isset($request->image)){
            //image upload
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image =$imageName;
        }

        //dd($request->all());

        $product->name = $request->input('name');
        $product->description = $request-> input('description');
        $product->save();
        return back()->withSuccess('Product update !!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         $product = Products::where('id',$id)->first();
         $product->delete();
        return back()->withSuccess('Product deleted !!');


    }
}
