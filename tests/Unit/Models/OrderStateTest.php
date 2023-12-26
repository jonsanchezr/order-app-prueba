<?php

namespace Tests\Unit\Models;

use App\Models\OrderState;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class OrderStateTest extends TestCase
{
    /** @test */
    public function order_state_relation()
    {
        // setUp
        $orderState = OrderState::create([
            'name' => 'CREATE'
        ]);

        $this->assertInstanceOf(HasMany::class, $orderState->orders());
    }
}
