<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\annonces>
 */
class annoncesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(1,3),
            'products_id'=>$this->faker->numberBetween(1,5),
            'minday'=>$this->faker->text(200),
            'city'=>$this->faker->text(10),
            'from'=>$this->faker->date(),
            'to'=>$this->faker->date(),
            'regular_price'=>$this->faker->unique()->numberBetween(100,500),
            'sale_price'=>$this->faker->unique()->numberBetween(100,500),
            'premium' => $this->faker->randomElement(['0', '1']),
            'premium_duration' => $this->faker->numberBetween(0, 30),
            'stat' => $this->faker->numberBetween(0, 1),
        ];
    }
}
