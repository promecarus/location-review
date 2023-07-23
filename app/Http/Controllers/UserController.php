<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Utilities\QueryFilter;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(
            User::where(QueryFilter::buildQuery([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ], request()))
                ->when(request('with_reviews') == 'true', fn ($query) => $query->with('reviews'))
                ->paginate(request('per_page'))
                ->appends(request()->query())
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user->loadMissing('reviews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
