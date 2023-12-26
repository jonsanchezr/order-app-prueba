<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderState;
use App\Repositories\OrderStateRepositoryInterface;

class EloquentOrderStateRepository implements OrderStateRepositoryInterface
{
    protected $model;

    /**
     * EloquentOrderStateRepository constructor.
     *
     * @param OrderState $orderState
     */
    public function __construct(OrderState $orderState)
    {
        $this->model = $orderState;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}