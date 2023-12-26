<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function order_relation()
    {
        // setUp
        $orderStateCreate = OrderState::create([
            'name' => 'CREATE'
        ]);

        $user = User::factory(1)->create()->first();

        $order = Order::create([
            'seller_id' => $user->id,
            'order_state_id' => $orderStateCreate->id,
            'amount' => 50.00,
            'description' => 'Description Test one',
            'date_expiration' => today()->addDays(7)
        ]);

        $this->assertInstanceOf(BelongsTo::class, $order->seller());
        $this->assertInstanceOf(BelongsTo::class, $order->orderState());
    }
}
