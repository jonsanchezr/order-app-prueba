<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrdersTest extends TestCase
{
    /** @test */
    public function it_can_create_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');
        $orderState = OrderState::create([
            'name' => 'CREATE'
        ]);

        $user = User::factory(1)->create()->first();

        $ordersInit = Order::all();


        // actions
        $response = $this->post(route('orders.store'), [
            'seller_id' => $user->id,
            'order_state_id' => $orderState->id,
            'amount' => 50.00,
            'description' => 'Description Test',
            'date_expiration' => today()->addDays(7)
        ]);

        $ordersFinish = Order::all();

        $response->assertRedirect();
        $this->assertEquals(0, $ordersInit->count());
        $this->assertEquals(1, $ordersFinish->count());

        $this->assertEquals($user->id,          $ordersFinish->first()->seller_id);
        $this->assertEquals($orderState->id,    $ordersFinish->first()->order_state_id);
        $this->assertEquals(50.00,              $ordersFinish->first()->amount);
        $this->assertEquals('Description Test', $ordersFinish->first()->description);
    }
}
