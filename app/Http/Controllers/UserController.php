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
    public function index(Request $request)
    {
        $filter = QueryFilter::buildQuery([
            'id' => 'id',
            'name' => 'name',
            'email' => 'email',
            'createdAt' => 'created_at',
            'updatedAt' => 'updated_at'
        ], $request);
        $per_page = request()->per_page ?? 10;

        return count($filter) == 0
            ? UserResource::collection(User::paginate($per_page))
            : UserResource::collection(User::where($filter)->paginate($per_page));
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
        return new UserResource($user);
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
