<?php

namespace Database\Factories;

use App\Models\Bond;
use Illuminate\Database\Eloquent\Factories\Factory;

class BondFactory extends Factory
{
    protected $model = Bond::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nominal_price" => $this->faker->numberBetween(100, 1000),
            "frequency_of_payment_coupons" => $this->faker->randomElement([1,2,4,12]),
            "interest_calculation_period" => $this->faker->randomElement([360, 364, 365]),
            "coupon_percent" => $this->faker->numberBetween(0, 100),
            "currency" => 'AZN',
            "issue_date" => $this->faker->date('Y-m-d'),
            "last_circulation_date" => $this->faker->date('Y-m-d'),
        ];
    }
}
