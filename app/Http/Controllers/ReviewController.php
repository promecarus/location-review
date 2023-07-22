<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Utilities\QueryFilter;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = QueryFilter::buildQuery([
            'id' => 'id',
            'locationId' => 'location_id',
            'userId' => 'user_id',
            'rating' => 'rating',
            'message' => 'message',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at'
        ], $request);
        $per_page = request()->per_page ?? 10;

        return count($filter) == 0
            ? ReviewResource::collection(Review::paginate($per_page))
            : ReviewResource::collection(Review::where($filter)->paginate($per_page)->appends(request()->query()));
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
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
