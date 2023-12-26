<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderStateResource;
use App\Http\Resources\UserResource;
use App\Repositories\Eloquent\EloquentOrderRepository;
use App\Repositories\Eloquent\EloquentOrderStateRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(
        private EloquentOrderRepository $eloquentOrderRepository,
        private EloquentOrderStateRepository $eloquentOrderStateRepository,
        private EloquentUserRepository $eloquentUserRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->eloquentOrderRepository->filter($request->all());
        $orderStates = $this->eloquentOrderStateRepository->all();
        $users = $this->eloquentUserRepository->all();

        return view('pages.orders.index', [
            'orders' => OrderResource::collection($orders),
            'sellers' => UserResource::collection($users),
            'orderStates' => OrderStateResource::collection($orderStates)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderStates = $this->eloquentOrderStateRepository->all();
        $users = $this->eloquentUserRepository->all();

        return view('pages.orders.createForm', [
            'sellers' => UserResource::collection($users),
            'orderStates' => OrderStateResource::collection($orderStates)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $this->eloquentOrderRepository->create($request->validated());

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $orderStates = $this->eloquentOrderStateRepository->all();
        $users = $this->eloquentUserRepository->all();

        return view('pages.orders.editForm', [
            'order' => new OrderResource($order),
            'sellers' => UserResource::collection($users),
            'orderStates' => OrderStateResource::collection($orderStates),
            'show' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $orderStates = $this->eloquentOrderStateRepository->all();
        $users = $this->eloquentUserRepository->all();

        return view('pages.orders.editForm', [
            'order' => new OrderResource($order),
            'sellers' => UserResource::collection($users),
            'orderStates' => OrderStateResource::collection($orderStates)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $this->eloquentOrderRepository->update($request->validated(), $order->id);

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->eloquentOrderRepository->delete($order->id);

        return redirect(route('orders.index'));
    }
}
