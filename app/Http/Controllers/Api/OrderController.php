<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\Api\OrderResource;
use App\Repositories\Eloquent\EloquentOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    public function __construct(
        private EloquentOrderRepository $eloquentOrderRepository,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $this->eloquentOrderRepository->filter($request->all());

        return response()->json([
            'data' => OrderResource::collection($orders),
            'message' => 'Lists Orders',
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = $this->eloquentOrderRepository->create($request->validated());

        return response()->json([
            'data' => new OrderResource($order),
            'message' => 'Created Order',
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request)
    {
        $this->eloquentOrderRepository->updateConfirm($request->validated(), $request->get('order_id'));

        return response()->json([
            'data' => ['status' => true],
            'message' => 'Updated Order',
        ], Response::HTTP_ACCEPTED);
    }
}
