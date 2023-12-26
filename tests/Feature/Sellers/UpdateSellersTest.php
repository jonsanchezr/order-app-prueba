<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateSellersTest extends TestCase
{
    /** @test */
    public function it_can_update_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');

        $user = User::factory(1)->create()->first();

        // actions
        $response = $this->put(route('sellers.update', $user->id), [
            'name' => 'Test Name two',
            'email' => 'two@mail.com'
        ]);


        $response->assertRedirect();

        $this->assertEquals('Test Name two', $user->fresh()->name);
        $this->assertEquals('two@mail.com',  $user->fresh()->email);
    }
}
