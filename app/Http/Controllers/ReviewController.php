<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Utilities\QueryFilter;

class ReviewController extends Controller
{
    public function index()
    {
        return ReviewResource::collection(
            Review::where(QueryFilter::buildQuery([
                'id',
                'location_id',
                'user_id',
                'rating',
                'message',
                'created_at',
                'updated_at'
            ], request()))
                ->when(request('with_location') == 'true', fn ($query) => $query->with('location'))
                ->when(request('with_user') == 'true', fn ($query) => $query->with('user'))
                ->paginate(request('per_page'))
                ->appends(request()->query())
        );
    }

    public function store(StoreReviewRequest $request)
    {
        return new ReviewResource(Review::create($request->all()));
    }

    public function show(Review $review)
    {
        return new ReviewResource($review->loadMissing('location', 'user'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->all());
    }

    public function destroy(Review $review)
    {
        $review->delete();
    }
}
