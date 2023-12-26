<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\OrderState;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateApiOrdersTest extends TestCase
{
    /** @test */
    public function it_can_api_create_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');
        $orderState = OrderState::create([
            'name' => 'CREATE'
        ]);

        $user = User::factory(1)->create()->first();

        $ordersInit = Order::all();

        // actions
        $response = $this->postJson(route('api.orders.store'), [
            'seller_id' => $user->id,
            'amount' => 50.00,
            'description' => 'Description Test',
        ])->assertSuccessful()->json();

        $ordersFinish = Order::all();

        $this->assertEquals(0, $ordersInit->count());
        $this->assertEquals(1, $ordersFinish->count());

        $this->assertEquals(1,                                       $response['data']['order_id']);
        $this->assertEquals(route('orders.show', 1),                 $response['data']['url_redireccion']);
        $this->assertEquals(today()->addDays(7)->toDateTimeString(), $response['data']['date_expiration']);
    }
}
