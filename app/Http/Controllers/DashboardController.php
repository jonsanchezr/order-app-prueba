<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderState;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderStateResource;
use App\Http\Resources\UserResource;
use App\Repositories\Eloquent\EloquentOrderRepository;
use App\Repositories\Eloquent\EloquentOrderStateRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(
        private EloquentOrderRepository $eloquentOrderRepository,
        private EloquentOrderStateRepository $eloquentOrderStateRepository,
        private EloquentUserRepository $eloquentUserRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countOrdersAll = $this->eloquentOrderRepository->all();
        $countOrdersPending = $this->eloquentOrderRepository->filter(['order_state_id' => OrderState::PENDING]);
        $countOrdersSuccess = $this->eloquentOrderRepository->filter(['order_state_id' => OrderState::SUCCESS]);
        $countSellersAll = $this->eloquentUserRepository->all();
        $ordersLatest = $this->eloquentOrderRepository->latest(3);

        return view('dashboard', [
            'countOrdersAll' => $countOrdersAll->count(),
            'countOrdersPending' => $countOrdersPending->count(),
            'countOrdersSuccess' => $countOrdersSuccess->count(),
            'countSellersAll' => $countSellersAll->count(),
            'ordersLatest' => $ordersLatest,
        ]);
    }
}
