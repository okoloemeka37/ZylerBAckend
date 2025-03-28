<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        
        return [
            'name' => fake()->name(),
            'Description'=>fake()->sentence,
            'price'=>fake()->randomFloat(2,5,500),
            'stock'=>fake()->numberBetween(40,100),
            'gender'=>fake()->randomElement(['Male','Female','Unisex','Babies']),
            'tag'=>fake()->randomElement(["Hats","Scarves","Belts","Bags","Jewelry"]),
            'category'=>'Accessories',
            'image'=>'0900c624-bc52-4f44-9ec5-f2c42c24caa6.jpg'
        ];
    }
//php artisan db:seed --class=DatabaseSeeder
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
