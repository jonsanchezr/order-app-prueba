<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateOrdersTest extends TestCase
{
    /** @test */
    public function it_can_update_returns_a_successful_response(): void
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
        $response = $this->put(route('orders.update', $order->id), [
            'seller_id' => $user->id,
            'order_state_id' => $orderStatePending->id,
            'amount' => 99.00,
            'description' => 'Description Test two',
            'date_expiration' => today()->addDays(9)
        ]);


        $response->assertRedirect();

        $this->assertEquals($orderStatePending->id, $order->fresh()->order_state_id);
        $this->assertEquals(99.00,                  $order->fresh()->amount);
        $this->assertEquals('Description Test two', $order->fresh()->description);
    }
}
