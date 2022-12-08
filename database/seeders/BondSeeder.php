<?php

namespace Database\Seeders;

use App\Models\Bond;
use App\Models\Order;
use Illuminate\Database\Seeder;

class BondSeeder extends Seeder
{
    public function run()
    {
        Bond::factory(5)
            ->has(Order::factory(),'orders')
            ->create();
    }
}
