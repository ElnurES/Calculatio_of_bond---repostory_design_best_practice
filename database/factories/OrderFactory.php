<?php

namespace Database\Factories;

use App\Models\Bond;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "number_received"  =>$this->faker->numberBetween(1,5),
            "order_date"=>$this->faker->date('Y-m-d'),
        ];
    }
}
