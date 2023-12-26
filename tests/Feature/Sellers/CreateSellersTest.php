<?php

namespace Tests\Feature;

use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSellersTest extends TestCase
{
    /** @test */
    public function it_can_create_returns_a_successful_response(): void
    {
        // setUp
        $this->artisan('migrate:fresh');

        $usersInit = User::all();

        // actions
        $response = $this->post(route('sellers.store'), [
            'name' => 'Test Name',
            'email' => 'test@mail.com',
        ]);

        $usersFinish = User::all();

        $response->assertRedirect();
        $this->assertEquals(0, $usersInit->count());
        $this->assertEquals(1, $usersFinish->count());

        $this->assertEquals('Test Name',     $usersFinish->first()->name);
        $this->assertEquals('test@mail.com', $usersFinish->first()->email);
    }
}
