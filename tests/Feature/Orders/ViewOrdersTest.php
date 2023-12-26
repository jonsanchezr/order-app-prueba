<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewOrdersTest extends TestCase
{
    /** @test */
    public function it_can_view_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');

        // actions
        $response = $this->get(route('orders.index'));

        $response->assertOk();
    }
}
