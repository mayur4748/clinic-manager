<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory
{
    /**
     * Define model state.
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'category' => 'Medicine',
            'subcategory' => 'Tablet',
            'product_name' => fake()->word(),
            'price' => 100,
            'quantity' => 10,
            'status' => 'active'
        ];
    }
}