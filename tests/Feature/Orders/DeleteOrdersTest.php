<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteOrdersTest extends TestCase
{
    /** @test */
    public function it_can_delete_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');
        $orderState = OrderState::create([
            'name' => 'CREATE'
        ]);

        $user = User::factory(1)->create()->first();

        $order = Order::create([
            'seller_id' => $user->id,
            'order_state_id' => $orderState->id,
            'amount' => 50.00,
            'description' => 'Description Test',
            'date_expiration' => today()->addDays(7)
        ]);

        // actions
        $response = $this->delete(route('orders.destroy', $order->id));
        
        $ordersFinish = Order::all();

        $response->assertRedirect();
        $this->assertEquals(0, $ordersFinish->count());

    }
}
