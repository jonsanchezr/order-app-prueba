<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function __construct(
        private EloquentUserRepository $eloquentUserRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->eloquentUserRepository->filter($request->all());

        return view('pages.sellers.index', [
            'sellers' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sellers.createForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->eloquentUserRepository->create($request->validated());

        return redirect(route('sellers.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $seller)
    {
        return view('pages.sellers.editForm', [
            'seller' => new UserResource($seller),
            'show' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $seller)
    {
        return view('pages.sellers.editForm', [
            'seller' => new UserResource($seller),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $seller)
    {
        $this->eloquentUserRepository->update($request->validated(), $seller->id);

        return redirect(route('sellers.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $seller)
    {
        $this->eloquentUserRepository->delete($seller->id);

        return redirect(route('sellers.index'));
    }
}
