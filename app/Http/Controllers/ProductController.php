<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, Product $product)
    {  
        $product = Product::create($request->all()+['user_id'=> auth()->id()]);
       
  
        if($request->hasFile('images') && $request->file('images')->isValid()){
            $product->addMediaFromRequest('images')->toMediaCollection('products');

        }
        
        return redirect('/dashboard/seller');
        
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('edite');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product , $id)
    {
        $product = Product::findOrFail($id);

        
        $product->update($request->all());
        

        if($request->hasFile('images') && $request->file('images')->isValid()){
            $product->addMediaFromRequest('images')->toMediaCollection('products');

        }
        
        return redirect('/')->with('success', 'Product updated successfully');
    }



    public function statusToPublish($id)
    {
        $product = Product::findOrFail($id);
        $product->update([$product->status = 'published']);
        return back();
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return back();

    }
    
    public function restore($id)
    {
        // Find the soft-deleted product by its ID
        $product = Product::onlyTrashed()->findOrFail($id);

        // Restore the product
        $product->restore();

        // Update the product's status to "pending"
        $product->status = 'pending';

        // Save the updated product
        $product->save();

        // Redirect back with a success message (or return a JSON response)
        return back()->with('success', 'Product restored and status updated to pending successfully');
    }


    public function softDelete($id)
    {
        $product = Product::findOrFail($id);
        $product->update([$product->status = 'archived']);
        $product->delete();
        
        return back();
    }
   


}