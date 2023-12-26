<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateApiOrdersTest extends TestCase
{
    /** @test */
    public function it_can_api_update_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');
        $orderStateCreate = OrderState::create([
            'name' => 'CREATE'
        ]);
        $orderStatePending = OrderState::create([
            'name' => 'PENDING'
        ]);

        $user = User::factory(1)->create()->first();

        $order = Order::create([
            'seller_id' => $user->id,
            'order_state_id' => $orderStateCreate->id,
            'amount' => 50.00,
            'description' => 'Description Test one',
            'date_expiration' => today()->addDays(7)
        ]);

        // actions
        $response = $this->put(route('api.orders.update'), [
            'seller_id' => $user->id,
            'order_id' => $order->id,
            'amount' => 99.00,
        ])->assertSuccessful()->json();

        $this->assertEquals(true, $response['data']['status']);
    }
}
