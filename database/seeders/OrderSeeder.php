<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderStates = OrderState::all();

        $orderStates->each(fn (OrderState $orderState) => Order::create([
            'seller_id' => rand(1, 5),
            'order_state_id' => $orderState->id,
            'amount' => rand(50, 99),
            'description' => 'Description test order state: ' . $orderState->name,
            'date_expiration' => today()->addDay(7),
        ]));
    }
}
