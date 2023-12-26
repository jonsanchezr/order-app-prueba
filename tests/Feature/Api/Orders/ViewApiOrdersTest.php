<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewApiOrdersTest extends TestCase
{
    /** @test */
    public function it_can_api_view_returns_a_successful_response(): void
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
        $response = $this->get(route('api.orders.index'))->assertSuccessful()->json();

        $this->assertEquals(1, count($response['data']));
    }
}
