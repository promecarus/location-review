<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Utilities\QueryFilter;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LocationResource::collection(
            Location::where(QueryFilter::buildQuery([
                'id',
                'latitude',
                'longitude',
                'created_at',
                'updated_at'
            ], request()))
                ->when(request('with_reviews') == 'true', fn ($query) => $query->with('reviews'))
                ->paginate(request('per_page'))
                ->appends(request()->query())
        );
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
    public function store(StoreLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return new LocationResource($location->loadMissing('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
