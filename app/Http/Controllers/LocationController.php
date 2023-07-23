<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Utilities\QueryFilter;

class LocationController extends Controller
{
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

    public function store(StoreLocationRequest $request)
    {
        return new LocationResource(Location::create($request->all()));
    }

    public function show(Location $location)
    {
        return new LocationResource($location->loadMissing('reviews'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
