<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utilities\QueryFilter;

class UserController extends Controller
{
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

    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    public function show(User $user)
    {
        return new UserResource($user->loadMissing('reviews'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
