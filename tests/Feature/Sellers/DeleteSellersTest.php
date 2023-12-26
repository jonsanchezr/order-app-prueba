<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteSellersTest extends TestCase
{
    /** @test */
    public function it_can_delete_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');

        $user = User::factory(1)->create()->first();

        // actions
        $response = $this->delete(route('sellers.destroy', $user->id));
        
        $usersFinish = User::all();

        $response->assertRedirect();
        $this->assertEquals(0, $usersFinish->count());

    }
}
