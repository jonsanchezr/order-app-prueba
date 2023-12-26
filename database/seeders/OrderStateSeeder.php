<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = collect(['CREATE', 'PENDING', 'SUCCESS', 'EXPIRED', 'REJECTED']);

        // create OrderStates
        $states->each(fn (string $state) => OrderState::create(['name' => $state]));
    }
}
