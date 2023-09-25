<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_name=$this->faker->unique()->words($nb=6,$asText=true);
        $slug= Str::slug($product_name,'-');
        return [
            'user_id'=>$this->faker->numberBetween(1,3),
            'title'=>$product_name,
            'slug'=>$slug,
            'short_description'=>$this->faker->text(200),
            'description'=>$this->faker->text(500),
            'stock_status'=>'instock',
            'images'=>'product-'.$this->faker->text(),
            'category_id'=>$this->faker->numberBetween(1,5)
        ];
    }
}
