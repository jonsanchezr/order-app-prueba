<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function user_relation()
    {
        // setUp
        $user = User::factory(1)->create()->first();

        $this->assertInstanceOf(HasMany::class, $user->orders());
    }
}
