<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\OrderState;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    protected $model;

    /**
     * EloquentOrderRepository constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order
    {
        return $this->model->create([
            'seller_id' => $data['seller_id'],
            'order_state_id' => $data['order_state_id'] ?? OrderState::CREATE,
            'amount' => $data['amount'],
            'description' => $data['description'],
            'date_expiration' => $data['date_expiration'] ?? today()->addDays(7),
        ]);
    }

    /**
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, $id): int
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return int
     */
    public function updateconfirm(array $data, $id): int
    {
        $data['order_state_id'] = OrderState::SUCCESS;
        unset($data['order_id']);

        return $this->model->where('id', $id)
            ->update($data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $id
     * @return Order
     */
    public function find(int $id): Order
    {
        return $this->model->find($id);
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function latest(int $count): Collection
    {
        return $this->model->latest()
            ->take($count)
            ->get();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function filter(array $data): Collection
    {
        if (empty($data)) return $this->model->all();

        $model = $this->model;
        if (isset($data['seller_id'])) $model = $this->filterBySellerId($data['seller_id'], $model);

        if (isset($data['order_state_id'])) $model = $this->filterByOrderStateId($data['order_state_id'], $model);

        if (isset($data['date_expiration'])) $model = $this->filterByDateExpiration($data['date_expiration'], $model);

        if (isset($data['id'])) $model = $this->filterById($data['id'], $model);

        return $model->get();
    }

    /**
     * @param int $sellerId
     * @param Builder|Order $model
     * @return Builder
     */
    public function filterBySellerId(int $sellerId, Builder|Order $model): Builder
    {
        return $model->where('seller_id', $sellerId);
    }

    /**
     * @param int $orderStateId
     * @param Builder|Order $model
     * @return Builder
     */
    public function filterByOrderStateId(int $orderStateId, Builder|Order $model): Builder
    {
        return $model->where('order_state_id', $orderStateId);
    }

    /**
     * @param string $dateExpiration
     * @param Builder|Order $model
     * @return Builder
     */
    public function filterByDateExpiration(string $dateExpiration, Builder|Order $model): Builder
    {
        return $model->where('date_expiration', '<=', $dateExpiration);
    }

    /**
     * @param int $id
     * @param Builder|Order $model
     * @return Builder
     */
    public function filterById(int $id, Builder|Order $model): Builder
    {
        return $model->where('id', $id);
    }
}