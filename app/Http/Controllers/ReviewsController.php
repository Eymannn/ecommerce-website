<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Http\Requests\StoreReviewsRequest;
use App\Http\Requests\UpdateReviewsRequest;

class ReviewsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewsRequest $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

       $review = Reviews::create([
            'content' => $request->content,
            'rating' => $request->rating,
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);
        
        if($request->hasFile('image') && $request->file('image')->isValid()){
           
            $review->addMediaFromRequest('image')->toMediaCollection('reviews');

        }

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewsRequest $request, Reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $reviews)
    {
        //
    }
}
